<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\ProductManufacturer;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Shopware\Core\Content\Product\Aggregate\ProductManufacturer\ProductManufacturerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductManufacturerExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField(
                ManufacturerDefinition::EXTENSION_COLLECTION_NAME,
                ManufacturerDefinition::class,
                'product_manufacturer_id'
            ))->addFlags(new ApiAware(), new CascadeDelete())
        );
    }

    public function getEntityName(): string
    {
        return ProductManufacturerDefinition::ENTITY_NAME;
    }
}
