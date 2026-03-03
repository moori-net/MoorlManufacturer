<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Cms;

use MoorlFoundation\Core\Content\Cms\FoundationListingCmsElementResolver;
use Shopware\Core\Content\Cms\Aggregate\CmsSlot\CmsSlotEntity;
use Shopware\Core\Content\Cms\DataResolver\Element\ElementDataCollection;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\ResolverContext;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

class ManufacturerListingCmsElementResolver extends FoundationListingCmsElementResolver
{
    public function getType(): string
    {
        return 'moorl-manufacturer-listing';
    }

    public function enrich(CmsSlotEntity $slot, ResolverContext $resolverContext, ElementDataCollection $result): void
    {
        $data = new ManufacturerListingStruct();
        $slot->setData($data);

        $request = $resolverContext->getRequest();
        $salesChannelContext = $resolverContext->getSalesChannelContext();

        $navigationId = $this->getNavigationId($resolverContext);

        $criteria = new Criteria();

        $this->enrichCmsElementResolverCriteriaV2($slot, $criteria, $resolverContext);

        $listing = $this->listingRoute
            ->load($navigationId, $request, $salesChannelContext, $criteria)
            ->getResult();

        $data->setListing($listing);
    }
}
