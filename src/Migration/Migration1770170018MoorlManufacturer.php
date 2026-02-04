<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Plugin\Requirement\Exception\MissingRequirementException;

class Migration1770170018MoorlManufacturer extends MigrationStep
{
    public const OPERATION_HASH = '2388ac27d5ef4dbd0b11b269397745d7';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770170018;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE moorl_manufacturer (id BINARY(16) NOT NULL, cms_page_id BINARY(16) DEFAULT NULL, country_id BINARY(16) DEFAULT NULL, country_state_id BINARY(16) DEFAULT NULL, moorl_manufacturer_media_id BINARY(16) DEFAULT NULL, product_manufacturer_id BINARY(16) NOT NULL, cms_page_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425, product_manufacturer_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425 NOT NULL, active TINYINT(1) DEFAULT 0, product_count INT DEFAULT NULL, additional_address_line1 VARCHAR(255) DEFAULT NULL, additional_address_line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, location_place_id VARCHAR(255) DEFAULT NULL, merchant_url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, shop_url VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, street_number VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id, product_manufacturer_version_id)) DEFAULT CHARACTER SET utf8mb4;
ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.cms_page_id` FOREIGN KEY (cms_page_id, cms_page_version_id) REFERENCES cms_page (id, version_id) ON UPDATE CASCADE ON DELETE SET NULL;
ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.country_id` FOREIGN KEY (country_id) REFERENCES country (id) ON UPDATE CASCADE ON DELETE SET NULL;
ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.country_state_id` FOREIGN KEY (country_state_id) REFERENCES country_state (id) ON UPDATE CASCADE ON DELETE SET NULL;
ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.product_manufacturer_id` FOREIGN KEY (product_manufacturer_id, product_manufacturer_version_id) REFERENCES product_manufacturer (id, version_id) ON UPDATE CASCADE ON DELETE CASCADE;
SQL;

        // Try to execute all queries at once
        try {
            $connection->executeStatement($sql);
            $this->additionalCustomUpdate($connection);
            return;
        } catch (\Exception) {
            if (!class_exists(EntityDefinitionQueryHelper::class)) {
                throw new MissingRequirementException('moorl/foundation', '1.6.50');
            }
        }

        // Try to execute all queries step by step
        if (!EntityDefinitionQueryHelper::tableExists($connection, 'moorl_manufacturer', '')) {
            $sql = "CREATE TABLE moorl_manufacturer (id BINARY(16) NOT NULL, cms_page_id BINARY(16) DEFAULT NULL, country_id BINARY(16) DEFAULT NULL, country_state_id BINARY(16) DEFAULT NULL, moorl_manufacturer_media_id BINARY(16) DEFAULT NULL, product_manufacturer_id BINARY(16) NOT NULL, cms_page_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425, product_manufacturer_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425 NOT NULL, active TINYINT(1) DEFAULT 0, product_count INT DEFAULT NULL, additional_address_line1 VARCHAR(255) DEFAULT NULL, additional_address_line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, location_place_id VARCHAR(255) DEFAULT NULL, merchant_url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, shop_url VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, street_number VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id, product_manufacturer_version_id)) DEFAULT CHARACTER SET utf8mb4;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.cms_page_id')) {
            $sql = "ALTER TABLE moorl_manufacturer ADD CONSTRAINT `fk.moorl_manufacturer.cms_page_id` FOREIGN KEY (cms_page_id, cms_page_version_id) REFERENCES cms_page (id, version_id) ON UPDATE CASCADE ON DELETE SET NULL;";
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

        $this->additionalCustomUpdate($connection);
    }

    public function updateDestructive(Connection $connection): void
    {
        // Add destructive update if necessary
    }

    private function additionalCustomUpdate(Connection $connection): void
    {
        // Add custom update if necessary
    }
}
