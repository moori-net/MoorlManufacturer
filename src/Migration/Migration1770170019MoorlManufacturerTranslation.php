<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Plugin\Requirement\Exception\MissingRequirementException;

class Migration1770170019MoorlManufacturerTranslation extends MigrationStep
{
    public const OPERATION_HASH = '7425cf704f19d005109b75263dcd39c5';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770170019;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE moorl_manufacturer_translation (language_id BINARY(16) NOT NULL, moorl_manufacturer_id BINARY(16) NOT NULL, slot_config JSON DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_keywords LONGTEXT DEFAULT NULL, meta_title LONGTEXT DEFAULT NULL, teaser LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (moorl_manufacturer_id, language_id)) DEFAULT CHARACTER SET utf8mb4;
ALTER TABLE moorl_manufacturer_translation ADD CONSTRAINT `fk.moorl_manufacturer_translation.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE moorl_manufacturer_translation ADD CONSTRAINT `fk.moorl_manufacturer_translation.language_id` FOREIGN KEY (language_id) REFERENCES language (id) ON UPDATE CASCADE ON DELETE CASCADE;
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
        if (!EntityDefinitionQueryHelper::tableExists($connection, 'moorl_manufacturer_translation', '')) {
            $sql = "CREATE TABLE moorl_manufacturer_translation (language_id BINARY(16) NOT NULL, moorl_manufacturer_id BINARY(16) NOT NULL, slot_config JSON DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_keywords LONGTEXT DEFAULT NULL, meta_title LONGTEXT DEFAULT NULL, teaser LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (moorl_manufacturer_id, language_id)) DEFAULT CHARACTER SET utf8mb4;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_translation');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_translation', 'fk.moorl_manufacturer_translation.moorl_manufacturer_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_translation ADD CONSTRAINT `fk.moorl_manufacturer_translation.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_translation');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_translation', 'fk.moorl_manufacturer_translation.language_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_translation ADD CONSTRAINT `fk.moorl_manufacturer_translation.language_id` FOREIGN KEY (language_id) REFERENCES language (id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_translation');
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
