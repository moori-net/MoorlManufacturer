<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                           add(ManufacturerEntity $entity)
 * @method void                           set(string $key, ManufacturerEntity $entity)
 * @method ManufacturerEntity[]    getIterator()
 * @method ManufacturerEntity[]    getElements()
 * @method ManufacturerEntity|null get(string $key)
 * @method ManufacturerEntity|null first()
 * @method ManufacturerEntity|null last()
 */
class ManufacturerCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'moorl_manufacturer_collection';
    }

    protected function getExpectedClass(): string
    {
        return ManufacturerEntity::class;
    }
}
