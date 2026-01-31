<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Storefront\Page\Manufacturer;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Shopware\Core\Content\Cms\CmsPageEntity;
use Shopware\Core\Content\Product\SalesChannel\Listing\ProductListingResult;
use Shopware\Storefront\Page\Page;

class ManufacturerPage extends Page
{
    protected ManufacturerEntity $manufacturer;
    protected ?CmsPageEntity $cmsPage = null;
    protected ?ProductListingResult $products = null;

    public function getManufacturer(): ManufacturerEntity
    {
        return $this->manufacturer;
    }

    public function setManufacturer(ManufacturerEntity $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function getCmsPage(): ?CmsPageEntity
    {
        return $this->cmsPage;
    }

    public function setCmsPage(?CmsPageEntity $cmsPage): void
    {
        $this->cmsPage = $cmsPage;
    }

    public function getProducts(): ?ProductListingResult
    {
        return $this->products;
    }

    public function setProducts(?ProductListingResult $products): void
    {
        $this->products = $products;
    }
}
