<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Product\SalesChannel;

use Moorl\Manufacturer\Storefront\Page\Manufacturer\ManufacturerPageLoader;
use Shopware\Core\System\SalesChannel\Event\SalesChannelProcessCriteriaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'sales_channel.product.process.criteria' => 'processCriteria'
        ];
    }

    public function processCriteria(SalesChannelProcessCriteriaEvent $event): void
    {
        $criteria = $event->getCriteria();
        if (!$criteria->hasState(ManufacturerPageLoader::CRITERIA_STATE)) {
            return;
        }

        $criteria->resetGroupFields();
    }
}
