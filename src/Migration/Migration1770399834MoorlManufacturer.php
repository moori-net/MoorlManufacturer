<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1770399834MoorlManufacturer extends MigrationStep
{
    public const OPERATION_HASH = '48eea6f129e0bde6a319386a4d3ef6fa';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770399834;
    }

    public function update(Connection $connection): void
    {
        if (!EntityDefinitionQueryHelper::tableExists($connection, 'moorl_manufacturer', '')) {
            $sql = "CREATE TABLE moorl_manufacturer (id BINARY(16) NOT NULL, avatar_id BINARY(16) DEFAULT NULL, banner_id BINARY(16) DEFAULT NULL, cms_page_id BINARY(16) DEFAULT NULL, country_id BINARY(16) DEFAULT NULL, country_state_id BINARY(16) DEFAULT NULL, moorl_marker_id BINARY(16) DEFAULT NULL, product_manufacturer_id BINARY(16) NOT NULL, cms_page_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425, product_manufacturer_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425 NOT NULL, active TINYINT(1) DEFAULT 0, auto_location TINYINT(1) DEFAULT 0, product_count INT DEFAULT NULL, location_lat DOUBLE PRECISION DEFAULT NULL, location_lon DOUBLE PRECISION DEFAULT NULL, additional_address_line1 VARCHAR(255) DEFAULT NULL, additional_address_line2 VARCHAR(255) DEFAULT NULL, banner_color VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, location_place_id VARCHAR(255) DEFAULT NULL, merchant_url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, shop_url VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, street_number VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id, product_manufacturer_version_id)) DEFAULT CHARACTER SET utf8mb4;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.cms_page_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.cms_page_id` FOREIGN KEY (cms_page_id, cms_page_version_id) REFERENCES cms_page (id, version_id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.banner_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.banner_id` FOREIGN KEY (banner_id) REFERENCES media (id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.avatar_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.avatar_id` FOREIGN KEY (avatar_id) REFERENCES media (id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.moorl_marker_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.moorl_marker_id` FOREIGN KEY (moorl_marker_id) REFERENCES moorl_marker (id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.country_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.country_id` FOREIGN KEY (country_id) REFERENCES country (id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.country_state_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.country_state_id` FOREIGN KEY (country_state_id) REFERENCES country_state (id) ON UPDATE CASCADE ON DELETE SET NULL;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.product_manufacturer_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.product_manufacturer_id` FOREIGN KEY (product_manufacturer_id, product_manufacturer_version_id) REFERENCES product_manufacturer (id, version_id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }
    }
}
