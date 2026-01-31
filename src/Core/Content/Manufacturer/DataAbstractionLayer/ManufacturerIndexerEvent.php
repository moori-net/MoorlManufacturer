<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\DataAbstractionLayer;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Event\NestedEvent;

class ManufacturerIndexerEvent extends NestedEvent
{
    public function __construct(private readonly array $ids, private readonly Context $context)
    {
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
