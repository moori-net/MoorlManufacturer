<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use Shopware\Core\Content\Media\MediaCollection;
use Shopware\Core\Content\Product\Aggregate\ProductMedia\ProductMediaCollection;

/**
 * @method void                    add(ManufacturerMediaEntity $entity)
 * @method void                    set(string $key, ManufacturerMediaEntity $entity)
 * @method ManufacturerMediaEntity[]    getIterator()
 * @method ManufacturerMediaEntity[]    getElements()
 * @method ManufacturerMediaEntity|null get(string $key)
 * @method ManufacturerMediaEntity|null first()
 * @method ManufacturerMediaEntity|null last()
 */
class ManufacturerMediaCollection extends ProductMediaCollection
{
    public function getMedia(): MediaCollection
    {
        return new MediaCollection(
            $this->fmap(fn(ManufacturerMediaEntity $manufacturerMedia) => $manufacturerMedia->getMedia())
        );
    }

    public function getApiAlias(): string
    {
        return 'moorl_manufacturer_media_collection';
    }

    protected function getExpectedClass(): string
    {
        return ManufacturerMediaEntity::class;
    }
}
