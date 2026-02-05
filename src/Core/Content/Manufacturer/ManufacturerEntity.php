<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityActiveTrait;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityAvatarTrait;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\EntityBannerTrait;
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
    use EntityBannerTrait;
    use EntityAvatarTrait;

    protected int $productCount = 0;

    public function getProductCount(): int
    {
        return $this->productCount;
    }

    public function setProductCount(int $productCount): void
    {
        $this->productCount = $productCount;
    }
}
