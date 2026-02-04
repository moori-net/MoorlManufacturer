<?php declare(strict_types=1);

namespace Moorl\Manufacturer;

use MoorlFoundation\Core\PluginLifecycleHelper;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;

class MoorlManufacturer extends Plugin
{
    final public const CMS_PAGE_MANUFACTURER_DEFAULT_ID = 'e48001efe482dda2a1970ff518a15eb7';
    final public const NAME = 'MoorlManufacturer';
    final public const DATA_CREATED_AT = '2025-01-29 00:00:00.000';
    final public const PLUGIN_TABLES = [
        'moorl_manufacturer',
        'moorl_manufacturer_translation',
        'moorl_manufacturer_media',
    ];
    final public const SHOPWARE_TABLES = [
        'cms_page',
        'cms_page_translation',
        'cms_section',
        'cms_block',
        'category',
        'category_translation',
        'seo_url',
        'property_group',
        'product_stream', /* Insert before products because indexing */
        'product',
        'product_translation',
        'product_category',
        'product_visibility',
        'product_option',
        'product_configurator_setting',
        'custom_field_set',
        'promotion'
    ];

    public function activate(ActivateContext $activateContext): void
    {
        parent::activate($activateContext);

        PluginLifecycleHelper::update(self::class, $this->container);
    }

    public function update(UpdateContext $updateContext): void
    {
        parent::update($updateContext);

        PluginLifecycleHelper::update(self::class, $this->container);
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);
        if ($uninstallContext->keepUserData()) {
            return;
        }

        PluginLifecycleHelper::uninstall(self::class, $this->container);
    }
}
