<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class ManufacturerAvailableFilter extends EqualsFilter
{
    public function __construct(SalesChannelContext $salesChannelContext)
    {
        parent::__construct('moorl_manufacturer.active', true);
    }
}
