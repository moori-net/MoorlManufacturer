<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Shopware\Core\Framework\Struct\ArrayStruct;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class ManufacturerDetailRouteResponse extends StoreApiResponse
{
    public function __construct(ManufacturerEntity $manufacturer)
    {
        parent::__construct(new ArrayStruct([
            'moorl_manufacturer' => $manufacturer,
        ], 'moorl_manufacturer_detail'));
    }

    public function getResult(): ArrayStruct
    {
        return $this->object;
    }

    public function getManufacturer(): ManufacturerEntity
    {
        return $this->object->get('moorl_manufacturer');
    }
}
