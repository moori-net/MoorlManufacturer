<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Moorl\Manufacturer\MoorlManufacturer;
use Shopware\Core\Content\ProductStream\ProductStreamCollection;

class SalesChannelManufacturerEntity extends ManufacturerEntity
{
    protected array $currentOptionIds = [];
    public function getCmsPageId(): ?string
    {
        return $this->cmsPageId ?: MoorlManufacturer::CMS_PAGE_MANUFACTURER_DEFAULT_ID;
    }

    public function getCurrentOptionIds(): array
    {
        return $this->currentOptionIds;
    }

    public function setCurrentOptionIds(array $currentOptionIds): void
    {
        $this->currentOptionIds = $currentOptionIds;
    }

    public function mergeCurrentOptionIds(array $currentOptionIds): void
    {
        $this->currentOptionIds = array_merge($this->currentOptionIds, $currentOptionIds);
    }

    public function findOptionTechnicalName(string $groupTechnicalName): ?string
    {
        foreach ($this->getFilters() as $filter) {
            foreach ($filter->getPropertyGroupOptions() as $option) {
                if (!in_array($option->getId(), $this->currentOptionIds)) {
                    continue;
                }

                if ($this->getMappingName($option->getGroupId()) === $groupTechnicalName) {
                    return $this->getMappingName($option->getId());
                }
            }
        }

        return null;
    }

    public function getAccessoryProductStreamIds(): array
    {
        $productStreamIds = [];

        $productStreams = new ProductStreamCollection();
        foreach ($this->getFilters() as $filter) {
            $productStreams->merge($filter->getProductStreams());
        }

        foreach ($productStreams as $productStream) {
            if (in_array('optional', $productStream->getTranslation('flags') ?? [])) {
                $productStreamIds[] = $productStream->getId();
            }
        }

        return array_unique($productStreamIds);
    }
}
