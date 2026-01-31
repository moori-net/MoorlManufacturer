<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldMediaGalleryMediaCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ManufacturerMediaDefinition extends EntityDefinition
{
    final public const ENTITY_NAME = 'moorl_manufacturer_media';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ManufacturerMediaCollection::class;
    }

    public function getEntityClass(): string
    {
        return ManufacturerMediaEntity::class;
    }

    protected function getParentDefinitionClass(): ?string
    {
        return ManufacturerDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(FieldMediaGalleryMediaCollection::getMediaFieldItems(
            localClass: self::class,
            referenceClass: ManufacturerDefinition::class
        ));
    }
}
