<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1770399837MoorlManufacturerCategory extends MigrationStep
{
    public const OPERATION_HASH = '8d46265bf4ebc8b1b6cb8d9e8764ca2e';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770399837;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE moorl_manufacturer_category (category_id BINARY(16) NOT NULL, moorl_manufacturer_id BINARY(16) NOT NULL, category_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425 NOT NULL, PRIMARY KEY (moorl_manufacturer_id, category_id, category_version_id)) DEFAULT CHARACTER SET utf8mb4;
ALTER TABLE moorl_manufacturer_category ADD CONSTRAINT `fk.moorl_manufacturer_category.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE moorl_manufacturer_category ADD CONSTRAINT `fk.moorl_manufacturer_category.category_id` FOREIGN KEY (category_id, category_version_id) REFERENCES category (id, version_id) ON UPDATE CASCADE ON DELETE CASCADE;
SQL;

        // Try to execute all queries at once
        try {
            $connection->executeStatement($sql);
            return;
        } catch (\Exception) {}

        // Try to execute all queries step by step
        if (!EntityDefinitionQueryHelper::tableExists($connection, 'moorl_manufacturer_category', '')) {
            $sql = "CREATE TABLE moorl_manufacturer_category (category_id BINARY(16) NOT NULL, moorl_manufacturer_id BINARY(16) NOT NULL, category_version_id BINARY(16) DEFAULT 0x0FA91CE3E96A4BC2BE4BD9CE752C3425 NOT NULL, PRIMARY KEY (moorl_manufacturer_id, category_id, category_version_id)) DEFAULT CHARACTER SET utf8mb4;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_category');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_category', 'fk.moorl_manufacturer_category.moorl_manufacturer_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_category ADD CONSTRAINT `fk.moorl_manufacturer_category.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_category');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_category', 'fk.moorl_manufacturer_category.category_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_category ADD CONSTRAINT `fk.moorl_manufacturer_category.category_id` FOREIGN KEY (category_id, category_version_id) REFERENCES category (id, version_id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_category');
        }
    }
}
