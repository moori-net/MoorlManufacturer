<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ManufacturerMediaEntity extends Entity
{
    use EntityIdTrait;
    use EntityCustomFieldsTrait;

    protected string $manufacturerId = "";
    protected string $mediaId = "";
    protected int $position = 0;
    protected ?MediaEntity $media = null;
    protected ?ManufacturerEntity $manufacturer = null;

    public function getManufacturerId(): string
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(string $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }

    public function getMediaId(): string
    {
        return $this->mediaId;
    }

    public function setMediaId(string $mediaId): void
    {
        $this->mediaId = $mediaId;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getMedia(): ?MediaEntity
    {
        return $this->media;
    }

    public function setMedia(?MediaEntity $media): void
    {
        $this->media = $media;
    }

    public function getManufacturer(): ?ManufacturerEntity
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?ManufacturerEntity $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }
}
