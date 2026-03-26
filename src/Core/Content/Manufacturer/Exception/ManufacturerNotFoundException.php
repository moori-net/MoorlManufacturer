<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Exception;

use Shopware\Core\Framework\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ManufacturerNotFoundException extends HttpException
{
    public function __construct(string $manufacturerId)
    {
        parent::__construct(
            Response::HTTP_NOT_FOUND,
            'CONTENT__MOORL_MANUFACTURER_NOT_FOUND',
            self::$couldNotFindMessage,
            ['entity' => 'moorl_manufacturer', 'field' => 'id', 'value' => $manufacturerId]
        );
    }
}
