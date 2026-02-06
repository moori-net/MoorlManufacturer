<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Listing;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSuggestCriteriaEvent;
use MoorlFoundation\Core\System\EntityListingFeaturesSubscriberExtension;
use Shopware\Core\Content\Product\SalesChannel\Listing\FilterCollection;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

class ManufacturerListingFeaturesSubscriber extends EntityListingFeaturesSubscriberExtension implements EventSubscriberInterface
{
    protected string $entityName = ManufacturerDefinition::ENTITY_NAME;

    public static function getSubscribedEvents(): array
    {
        return [
            ManufacturerListingCriteriaEvent::class => [
                ['handleListingRequest', 100],
                ['handleFlags', -100],
            ],
            ManufacturerSuggestCriteriaEvent::class => [
                ['handleFlags', -100],
            ],
            ManufacturerSearchCriteriaEvent::class => [
                ['handleSearchRequest', 100],
                ['handleFlags', -100],
            ],
            ManufacturerListingResultEvent::class => [
                ['handleResult', 100]
            ],
            ManufacturerSearchResultEvent::class => 'handleResult',
        ];
    }

    protected function getFilters(Request $request, SalesChannelContext $salesChannelContext): FilterCollection
    {
        $filters = new FilterCollection();

        $filters->add($this->getTagFilter($request));
        $filters->add($this->getCategoryFilter($request));
        $filters->add($this->getCountryFilter($request));
        $filters->add($this->getFirstCharFilter($request));

        return $filters;
    }
}
