<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Tag;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerTagDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Tag\TagDefinition;

class TagExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new ManyToManyAssociationField(
                ManufacturerDefinition::EXTENSION_COLLECTION_NAME,
                ManufacturerDefinition::class,
                ManufacturerTagDefinition::class,
                'tag_id',
                'moorl_manufacturer_id'
            ))
        );
    }

    public function getEntityName(): string
    {
        return TagDefinition::ENTITY_NAME;
    }
}
