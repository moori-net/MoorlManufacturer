<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                           add(ManufacturerTranslationEntity $entity)
 * @method void                           set(string $key, ManufacturerTranslationEntity $entity)
 * @method ManufacturerTranslationEntity[]    getIterator()
 * @method ManufacturerTranslationEntity[]    getElements()
 * @method ManufacturerTranslationEntity|null get(string $key)
 * @method ManufacturerTranslationEntity|null first()
 * @method ManufacturerTranslationEntity|null last()
 */
class ManufacturerTranslationCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'moorl_manufacturer_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return ManufacturerTranslationEntity::class;
    }
}
