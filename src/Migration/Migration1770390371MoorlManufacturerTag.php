<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Plugin\Requirement\Exception\MissingRequirementException;

class Migration1770390371MoorlManufacturerTag extends MigrationStep
{
    public const OPERATION_HASH = '8e11f19f685da9be32f700c91960aed9';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770390371;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE moorl_manufacturer_tag (moorl_manufacturer_id BINARY(16) NOT NULL, tag_id BINARY(16) NOT NULL, PRIMARY KEY (moorl_manufacturer_id, tag_id)) DEFAULT CHARACTER SET utf8mb4;
ALTER TABLE moorl_manufacturer_tag ADD CONSTRAINT `fk.moorl_manufacturer_tag.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE moorl_manufacturer_tag ADD CONSTRAINT `fk.moorl_manufacturer_tag.tag_id` FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE;
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
        if (!EntityDefinitionQueryHelper::tableExists($connection, 'moorl_manufacturer_tag', '')) {
            $sql = "CREATE TABLE moorl_manufacturer_tag (moorl_manufacturer_id BINARY(16) NOT NULL, tag_id BINARY(16) NOT NULL, PRIMARY KEY (moorl_manufacturer_id, tag_id)) DEFAULT CHARACTER SET utf8mb4;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_tag');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_tag', 'fk.moorl_manufacturer_tag.moorl_manufacturer_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_tag ADD CONSTRAINT `fk.moorl_manufacturer_tag.moorl_manufacturer_id` FOREIGN KEY (moorl_manufacturer_id) REFERENCES moorl_manufacturer (id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_tag');
        }

        if (!EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer_tag', 'fk.moorl_manufacturer_tag.tag_id')) {
            $sql = "ALTER TABLE moorl_manufacturer_tag ADD CONSTRAINT `fk.moorl_manufacturer_tag.tag_id` FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE;";
            EntityDefinitionQueryHelper::tryExecuteStatement($connection, $sql, 'moorl_manufacturer_tag');
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
