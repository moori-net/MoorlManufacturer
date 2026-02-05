<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Product\SalesChannel;

use Shopware\Storefront\Page\Product\ProductPageCriteriaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ProductPageCriteriaEvent::class => 'processCriteria',
        ];
    }

    public function processCriteria(ProductPageCriteriaEvent $event): void
    {
        $criteria = $event->getCriteria();
        $criteria->addAssociation('manufacturer.moorlManufacturers');
    }
}
