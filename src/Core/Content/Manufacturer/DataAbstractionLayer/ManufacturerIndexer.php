<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\DataAbstractionLayer;

use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Connection;
use MoorlFoundation\Core\Framework\DataAbstractionLayer\Indexer\EntityIndexerTrait;
use Shopware\Core\Framework\DataAbstractionLayer\Dbal\Common\IteratorFactory;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\EntityIndexer;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\EntityIndexingMessage;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ManufacturerIndexer extends EntityIndexer
{
    use EntityIndexerTrait;

    public function __construct(
        private readonly Connection $connection,
        private readonly IteratorFactory $iteratorFactory,
        private readonly EntityRepository $repository,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function getName(): string
    {
        return 'moorl_manufacturer.indexer';
    }

    public function handle(EntityIndexingMessage $message): void
    {
        $ids = $message->getData();
        $ids = array_unique(array_filter($ids));
        if (empty($ids)) {
            return;
        }

        $sql = <<<SQL
UPDATE moorl_manufacturer m
INNER JOIN (
    SELECT product_manufacturer_id, COUNT(*) AS cnt
    FROM product
    WHERE active = 1 AND parent_id IS NULL AND product_manufacturer_id IS NOT NULL
    GROUP BY product_manufacturer_id
) p ON p.product_manufacturer_id = m.product_manufacturer_id
SET m.product_count = p.cnt
WHERE m.id IN (:ids);
SQL;

        $this->connection->executeStatement(
            $sql,
            ['ids' => Uuid::fromHexToBytesList($ids)],
            ['ids' => ArrayParameterType::BINARY]
        );

        $this->eventDispatcher->dispatch(new ManufacturerIndexerEvent($ids, $message->getContext()));
    }
}
