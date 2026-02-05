<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\ProductManufacturer;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldMultiEntityCollection;
use Shopware\Core\Content\Product\Aggregate\ProductManufacturer\ProductManufacturerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductManufacturerExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $extensions = FieldMultiEntityCollection::getOneToManyFieldItems(
            localClass: ProductManufacturerDefinition::class,
            references: [[ManufacturerDefinition::class]],
            isExtension: true
        );

        foreach ($extensions as $item) {
            $collection->add($item);
        }
    }

    public function getEntityName(): string
    {
        return ProductManufacturerDefinition::ENTITY_NAME;
    }
}
