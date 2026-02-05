<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerListingResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSearchResultEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSuggestCriteriaEvent;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\Events\ManufacturerSuggestResultEvent;
use MoorlFoundation\Core\System\EntityListingExtension;
use MoorlFoundation\Core\System\EntityListingInterface;
use Shopware\Core\Content\Product\Events\ProductSearchResultEvent;
use Shopware\Core\Content\Product\Events\ProductSuggestResultEvent;
use Shopware\Core\Content\Product\SalesChannel\Listing\ProductListingResult;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

class ManufacturerListing extends EntityListingExtension implements EntityListingInterface
{
    public function getEntityName(): string
    {
        return ManufacturerDefinition::ENTITY_NAME;
    }

    public function getTitle(): string
    {
        return 'manufacturer-listing';
    }

    public function getSnippet(): ?string
    {
        return 'moorl-manufacturer.manufacturers';
    }

    public function getElementConfig(): array
    {
        if ($this->isSearch() && $this->systemConfigService->get('MoorlManufacturer.config.searchConfigActive')) {
            return $this->systemConfigService->get('MoorlManufacturer.config.searchConfig') ?: parent::getElementConfig();
        } elseif ($this->isSuggest() && $this->systemConfigService->get('MoorlManufacturer.config.suggestConfigActive')) {
            return $this->systemConfigService->get('MoorlManufacturer.config.suggestConfig') ?: parent::getElementConfig();
        }

        return parent::getElementConfig();
    }

    public function isActive(): bool
    {
        if ($this->isSearch()) {
            return $this->systemConfigService->getBool('MoorlManufacturer.config.searchActive');
        } elseif ($this->isSuggest()) {
            return $this->systemConfigService->getBool('MoorlManufacturer.config.suggestActive');
        }

        return true;
    }

    public function getLimit(): int
    {
        if ($this->isSearch()) {
            return $this->systemConfigService->get('MoorlManufacturer.config.searchLimit') ?: 12;
        } elseif ($this->isSuggest()) {
            return $this->systemConfigService->get('MoorlManufacturer.config.suggestLimit') ?: 6;
        }

        return 1;
    }

    public function processCriteria(Criteria $criteria): void
    {
        $criteria->addFilter(new ManufacturerAvailableFilter($this->salesChannelContext));

        if ($this->event instanceof ProductSuggestResultEvent) {
            $eventClass = ManufacturerSuggestCriteriaEvent::class;
        } elseif ($this->event instanceof ProductSearchResultEvent) {
            $eventClass = ManufacturerSearchCriteriaEvent::class;
        } elseif ($this->isWidget()) {
            $eventClass = ManufacturerSearchCriteriaEvent::class;
        } else {
            $eventClass = ManufacturerListingCriteriaEvent::class;
        }

        $this->eventDispatcher->dispatch(
            new $eventClass($this->request, $criteria, $this->salesChannelContext)
        );
    }

    public function processSearchResult(ProductListingResult $searchResult): void
    {
        if ($this->event instanceof ProductSuggestResultEvent) {
            $eventClass = ManufacturerSuggestResultEvent::class;
        } elseif ($this->event instanceof ProductSearchResultEvent) {
            $eventClass = ManufacturerSearchResultEvent::class;
        } elseif ($this->isWidget()) {
            $eventClass = ManufacturerSearchResultEvent::class;
        } else {
            $eventClass = ManufacturerListingResultEvent::class;
        }

        $this->eventDispatcher->dispatch(
            new $eventClass($this->request, $searchResult, $this->salesChannelContext)
        );
    }
}
