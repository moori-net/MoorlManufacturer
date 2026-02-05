<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityActiveTrait;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityProductManufacturerTrait;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityThingMetaTrait;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityThingPageTrait;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ManufacturerEntity extends Entity
{
    use EntityIdTrait;
    use EntityCustomFieldsTrait;
    use EntityThingMetaTrait;
    use EntityThingPageTrait;
    use EntityActiveTrait;
    use EntityProductManufacturerTrait;

    protected string $name = "";
}
