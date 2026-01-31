<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Cms;

use MoorlFoundation\Core\Content\Cms\SalesChannel\Struct\ListingStruct;

class ManufacturerListingStruct extends ListingStruct
{
    public function getApiAlias(): string
    {
        return 'cms_manufacturer_listing';
    }
}
