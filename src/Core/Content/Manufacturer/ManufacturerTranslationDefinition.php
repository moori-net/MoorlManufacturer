<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldThingCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ManufacturerTranslationDefinition extends EntityTranslationDefinition
{
    final public const ENTITY_NAME = 'moorl_manufacturer_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return ManufacturerTranslationEntity::class;
    }

    public function getCollectionClass(): string
    {
        return ManufacturerTranslationCollection::class;
    }

    protected function getParentDefinitionClass(): string
    {
        return ManufacturerDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(
            FieldThingCollection::getTranslatedFieldItems()
        );
    }
}
