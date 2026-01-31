<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Cms;

use MoorlFoundation\Core\Content\Cms\FoundationListingCmsElementResolver;
use Shopware\Core\Content\Cms\Aggregate\CmsSlot\CmsSlotEntity;
use Shopware\Core\Content\Cms\DataResolver\Element\ElementDataCollection;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\EntityResolverContext;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\ResolverContext;
use Shopware\Core\Content\Product\SalesChannel\SalesChannelProductEntity;
use Shopware\Core\Content\Property\Aggregate\PropertyGroupOption\PropertyGroupOptionCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsAnyFilter;

class ManufacturerListingCmsElementResolver extends FoundationListingCmsElementResolver
{
    public function getType(): string
    {
        return 'manufacturer-listing';
    }

    public function enrich(CmsSlotEntity $slot, ResolverContext $resolverContext, ElementDataCollection $result): void
    {
        $data = new ManufacturerListingStruct();
        $slot->setData($data);

        $request = $resolverContext->getRequest();
        $salesChannelContext = $resolverContext->getSalesChannelContext();

        $navigationId = $this->getNavigationId($resolverContext);

        $criteria = new Criteria();
        $criteria->addAssociation('cover');

        $this->enrichCmsElementResolverCriteriaV2($slot, $criteria, $resolverContext);

        if ($resolverContext instanceof EntityResolverContext) {
            $entity = $resolverContext->getEntity();

            if ($entity instanceof SalesChannelProductEntity) {
                if ($entity->getStreamIds()) {
                    $criteria->addFilter(
                        new EqualsAnyFilter('filters.productStreams.id', $entity->getStreamIds())
                    );

                    $merged = new PropertyGroupOptionCollection();
                    if ($entity->getProperties()) {
                        $merged->merge($entity->getProperties());
                    }
                    if ($entity->getOptions()) {
                        $merged->merge($entity->getOptions());
                    }
                    if ($merged->count() > 0) {
                        $data->setQueryParams([
                            'options' => implode("|", array_keys($merged->getIds()))
                        ]);
                    }
                }
            }
        }

        $listing = $this->listingRoute
            ->load($navigationId, $request, $salesChannelContext, $criteria)
            ->getResult();

        $data->setListing($listing);
    }
}
