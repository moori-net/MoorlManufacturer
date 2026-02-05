<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldAddressCollection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldContactCollection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldEntityCollection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldMultiEntityCollection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Collection\FieldThingCollection;
use Shopware\Core\Content\Product\Aggregate\ProductManufacturer\ProductManufacturerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\WriteProtected;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ManufacturerDefinition extends EntityDefinition
{
    final public const ENTITY_NAME = 'moorl_manufacturer';
    final public const PROPERTY_NAME = 'manufacturer';
    final public const EXTENSION_COLLECTION_NAME = 'moorlManufacturers';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ManufacturerCollection::class;
    }

    public function getEntityClass(): string
    {
        return ManufacturerEntity::class;
    }

    public function getDefaults(): array
    {
        return [
            'active' => false
        ];
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(array_merge(
            FieldEntityCollection::getFieldItems(
                localClass: self::class,
                translationReferenceClass: ManufacturerTranslationDefinition::class
            ),
            [
                (new IntField('product_count', 'productCount'))->addFlags(new WriteProtected())
            ],
            FieldThingCollection::getFieldItems(thingBanner: true, thingAvatar: true, media: false),
            FieldAddressCollection::getFieldItems(),
            FieldContactCollection::getFieldItems(),
            FieldMultiEntityCollection::getManyToOneFieldItems([
                [ProductManufacturerDefinition::class, [new Required()], []],
            ]),
        ));
    }
}
