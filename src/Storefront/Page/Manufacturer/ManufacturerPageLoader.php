<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Storefront\Page\Manufacturer;

use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\ManufacturerDetailRoute;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\SalesChannelManufacturerEntity;
use Shopware\Core\Content\Cms\Exception\PageNotFoundException;
use Shopware\Core\Content\Product\SalesChannel\Listing\AbstractProductListingRoute;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Routing\RoutingException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\HttpFoundation\Request;

class ManufacturerPageLoader
{
    public function __construct(
        private readonly GenericPageLoaderInterface $genericLoader,
        private readonly ManufacturerDetailRoute $manufacturerDetailRoute,
        private readonly AbstractProductListingRoute $productListingRoute
    ){}

    public function load(Request $request, SalesChannelContext $salesChannelContext): ManufacturerPage
    {
        $manufacturerId = $request->attributes->get('manufacturerId');
        if (!$manufacturerId) {
            throw RoutingException::missingRequestParameter('manufacturerId');
        }
        
        $criteria = new Criteria();
        $criteria->addAssociation('tags');
        $criteria->addAssociation('categories');
        $result = $this->manufacturerDetailRoute->load($manufacturerId, $request, $salesChannelContext, $criteria);
        /** @var SalesChannelManufacturerEntity $manufacturer */
        $manufacturer = $result->getManufacturer();
        if (!$manufacturer->isActive()) {
            throw new PageNotFoundException($manufacturer->getId());
        }

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('manufacturerId', $manufacturer->getProductManufacturerId()));
        $result = $this->productListingRoute->load(
            $salesChannelContext->getSalesChannel()->getNavigationCategoryId(),
            $request,
            $salesChannelContext,
            $criteria
        );
        $products = $result->getResult();

        $page = $this->genericLoader->load($request, $salesChannelContext);

        /** @var ManufacturerPage $page */
        $page = ManufacturerPage::createFrom($page);
        $page->setManufacturer($manufacturer);
        $page->setCmsPage($manufacturer->getCmsPage());
        $page->setProducts($products);
        $this->loadMetaData($page);

        return $page;
    }

    private function loadMetaData(ManufacturerPage $page): void
    {
        $metaInformation = $page->getMetaInformation();
        if (!$metaInformation) {
            return;
        }

        $metaDescription = $page->getManufacturer()->getTranslation('teaser')
            ?? $page->getManufacturer()->getTranslation('teaser');
        $metaInformation->setMetaDescription((string) $metaDescription);

        if ((string) $page->getManufacturer()->getTranslation('name') !== '') {
            $metaInformation->setMetaTitle((string) $page->getManufacturer()->getTranslation('name'));
            return;
        }

        $metaTitleParts = [$page->getManufacturer()->getTranslation('name')];
        $metaInformation->setMetaTitle(implode(' | ', $metaTitleParts));
    }
}
