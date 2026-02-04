<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Data;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\Seo\ManufacturerSeoUrlRoute;
use Moorl\Manufacturer\MoorlManufacturer;
use MoorlFoundation\Core\System\DataExtension;
use MoorlFoundation\Core\System\DataInterface;

class Data extends DataExtension implements DataInterface
{
    public function getTables(): ?array
    {
        return array_merge(
            $this->getShopwareTables(),
            $this->getPluginTables()
        );
    }

    public function getShopwareTables(): ?array
    {
        return MoorlManufacturer::SHOPWARE_TABLES;
    }

    public function getPluginTables(): ?array
    {
        return MoorlManufacturer::PLUGIN_TABLES;
    }

    public function getPluginName(): string
    {
        return MoorlManufacturer::NAME;
    }

    public function getCreatedAt(): string
    {
        return MoorlManufacturer::DATA_CREATED_AT;
    }

    public function getName(): string
    {
        return 'data';
    }

    public function getType(): string
    {
        return 'data';
    }

    public function getPath(): string
    {
        return __DIR__;
    }

    public function getLocalReplacers(): array
    {
        return [
            '{CMS_PAGE_MANUFACTURER_DEFAULT_ID}' => MoorlManufacturer::CMS_PAGE_MANUFACTURER_DEFAULT_ID,
            '{SEO_ROUTE_NAME}' => ManufacturerSeoUrlRoute::ROUTE_NAME,
            '{SEO_DEFAULT_TEMPLATE}' => ManufacturerSeoUrlRoute::DEFAULT_TEMPLATE,
            '{MAIN_ENTITY}' => ManufacturerDefinition::ENTITY_NAME,
        ];
    }

    public function getPreInstallQueries(): array
    {
        return [
            "UPDATE `cms_page` SET `locked` = '0' WHERE `id` = UNHEX('{CMS_PAGE_MANUFACTURER_DEFAULT_ID}');"
        ];
    }

    public function getInstallQueries(): array
    {
        return [
            "INSERT IGNORE INTO `seo_url_template` (`id`,`is_valid`,`route_name`,`entity_name`,`template`,`created_at`) VALUES (UNHEX('{ID:SEO_URL_1}'),1,'{SEO_ROUTE_NAME}','{MAIN_ENTITY}','{SEO_DEFAULT_TEMPLATE}','{DATA_CREATED_AT}');"
        ];
    }
}
