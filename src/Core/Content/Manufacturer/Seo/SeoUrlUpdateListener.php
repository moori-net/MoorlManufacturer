<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Seo;

use Moorl\Manufacturer\Core\Content\Manufacturer\DataAbstractionLayer\ManufacturerIndexerEvent;
use Shopware\Core\Content\Seo\SeoUrlUpdater;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SeoUrlUpdateListener implements EventSubscriberInterface
{
    public function __construct(private readonly SeoUrlUpdater $seoUrlUpdater)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ManufacturerIndexerEvent::class => 'onManufacturerIndexerEvent',
        ];
    }

    public function onManufacturerIndexerEvent(ManufacturerIndexerEvent $event): void
    {
        $this->seoUrlUpdater->update(ManufacturerSeoUrlRoute::ROUTE_NAME, $event->getIds());
    }
}
