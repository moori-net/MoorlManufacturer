<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Service;

use Psr\Log\LoggerInterface;
use Shopware\Core\Framework\DataAbstractionLayer\DefinitionInstanceRegistry;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;

class ManufacturerService
{
    public function __construct(
        private readonly DefinitionInstanceRegistry $definitionInstanceRegistry,
        private readonly LoggerInterface $logger,
    )
    {
    }

    public function getRepository(string $name): EntityRepository
    {
        return $this->definitionInstanceRegistry->getRepository($name);
    }

    public function debug(string|\Stringable $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }

    public function getPartsListCalculators(): array
    {
        $config = [];
        return $config;
    }
}
