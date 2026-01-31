<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelDefinitionInterface;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class SalesChannelManufacturerDefinition extends ManufacturerDefinition implements SalesChannelDefinitionInterface
{
    public function getEntityClass(): string
    {
        return SalesChannelManufacturerEntity::class;
    }

    public function processCriteria(Criteria $criteria, SalesChannelContext $context): void
    {
        $criteria->addAssociation('media');
        $criteria->addAssociation('cover.media');
        $criteria->addAssociation('productManufacturer.media');
        $criteria->addAssociation('manufacturerProductStreams');

        if (!$this->hasAvailableFilter($criteria)) {
            $criteria->addFilter(
                new ManufacturerAvailableFilter($context)
            );
        }
    }

    private function hasAvailableFilter(Criteria $criteria): bool
    {
        foreach ($criteria->getFilters() as $filter) {
            if ($filter instanceof ManufacturerAvailableFilter) {
                return true;
            }
        }

        return false;
    }
}
