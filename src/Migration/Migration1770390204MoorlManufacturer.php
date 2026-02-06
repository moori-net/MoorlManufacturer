<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Migration;

use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Dbal\EntityDefinitionQueryHelper;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Plugin\Requirement\Exception\MissingRequirementException;

class Migration1770390204MoorlManufacturer extends MigrationStep
{
    public const OPERATION_HASH = '7aff2ea6e83dd0efb1a1420d44135473';
    public const PLUGIN_VERSION = '1.7.0';

    public function getCreationTimestamp(): int
    {
        return 1770390204;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
ALTER TABLE moorl_manufacturer DROP FOREIGN KEY `fk.moorl_manufacturer.media_id`;
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
        if (EntityDefinitionQueryHelper::constraintExists($connection, 'moorl_manufacturer', 'fk.moorl_manufacturer.media_id')) {
            $sql = "ALTER TABLE moorl_manufacturer DROP FOREIGN KEY `fk.moorl_manufacturer.media_id`;";
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
