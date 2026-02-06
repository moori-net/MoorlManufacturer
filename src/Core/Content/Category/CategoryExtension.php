<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Category;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerCategoryDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Shopware\Core\Content\Category\CategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CategoryExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new ManyToManyAssociationField(
                ManufacturerDefinition::EXTENSION_COLLECTION_NAME,
                ManufacturerDefinition::class,
                ManufacturerCategoryDefinition::class,
                'category_id',
                'moorl_manufacturer_id'
            ))
        );
    }
    public function getEntityName(): string
    {
        return CategoryDefinition::ENTITY_NAME;
    }
}
