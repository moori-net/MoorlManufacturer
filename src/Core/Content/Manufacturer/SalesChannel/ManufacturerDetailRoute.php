<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\EntityResolverContext;
use Shopware\Core\Content\Cms\Exception\PageNotFoundException;
use Shopware\Core\Content\Cms\SalesChannel\SalesChannelCmsPageLoaderInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsAnyFilter;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: ['_routeScope' => ['store-api']])]
class ManufacturerDetailRoute
{
    public function __construct(
        private readonly SalesChannelRepository $manufacturerRepository,
        private readonly SalesChannelCmsPageLoaderInterface $cmsPageLoader,
        private readonly ManufacturerDefinition $manufacturerDefinition
    ){}

    public function getDecorated(): never
    {
        throw new DecorationPatternException(self::class);
    }

    public function load(string $manufacturerId, Request $request, SalesChannelContext $context, Criteria $criteria): ManufacturerDetailRouteResponse
    {
        $criteria->setIds([$manufacturerId]);

        $criteria->addAssociation('productManufacturer.media');

        /** @var SalesChannelManufacturerEntity $manufacturer */
        $manufacturer = $this->manufacturerRepository
            ->search($criteria, $context)
            ->first();

        $pageId = $manufacturer->getCmsPageId();

        $slotConfig = $manufacturer->getTranslation('slotConfig');
        $resolverContext = new EntityResolverContext($context, $request, $this->manufacturerDefinition, $manufacturer);

        $pages = $this->cmsPageLoader->load(
            $request,
            $this->createCriteria($pageId, $request),
            $context,
            $slotConfig,
            $resolverContext
        );

        if (!$pages->has($pageId)) {
            throw new PageNotFoundException($pageId);
        }

        $manufacturer->setCmsPage($pages->get($pageId));

        return new ManufacturerDetailRouteResponse($manufacturer);
    }

    private function createCriteria(string $pageId, Request $request): Criteria
    {
        $criteria = new Criteria([$pageId]);
        $criteria->setTitle('manufacturer_detail::cms-page');

        $slots = $request->get('slots');

        if (\is_string($slots)) {
            $slots = explode('|', $slots);
        }

        if (!empty($slots) && \is_array($slots)) {
            $criteria
                ->getAssociation('sections.blocks')
                ->addFilter(new EqualsAnyFilter('slots.id', $slots));
        }

        return $criteria;
    }
}
