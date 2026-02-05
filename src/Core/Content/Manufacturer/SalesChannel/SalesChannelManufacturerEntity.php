<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Moorl\Manufacturer\MoorlManufacturer;

class SalesChannelManufacturerEntity extends ManufacturerEntity
{
    public function getCmsPageId(): ?string
    {
        return $this->cmsPageId ?: MoorlManufacturer::CMS_PAGE_MANUFACTURER_DEFAULT_ID;
    }
}
