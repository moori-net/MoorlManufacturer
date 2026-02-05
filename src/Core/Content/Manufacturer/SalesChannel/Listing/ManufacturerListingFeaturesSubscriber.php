<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Listing;

use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSuggestCriteriaEvent;
use MoorlFoundation\Core\System\EntityListingFeaturesSubscriberExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ManufacturerListingFeaturesSubscriber extends EntityListingFeaturesSubscriberExtension implements EventSubscriberInterface
{
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
}
