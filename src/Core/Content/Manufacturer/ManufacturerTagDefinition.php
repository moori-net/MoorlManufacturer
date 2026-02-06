<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;
use Shopware\Core\System\Tag\TagDefinition;

class ManufacturerTagDefinition extends MappingEntityDefinition
{
    final public const ENTITY_NAME = 'moorl_manufacturer_tag';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('moorl_manufacturer_id', 'manufacturerId', ManufacturerDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('tag_id', 'tagId', TagDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            new ManyToOneAssociationField('manufacturer', 'moorl_manufacturer_id', ManufacturerDefinition::class),
            new ManyToOneAssociationField('tag', 'tag_id', TagDefinition::class)
        ]);
    }
}
