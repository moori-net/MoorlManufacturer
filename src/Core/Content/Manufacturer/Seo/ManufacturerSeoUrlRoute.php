<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Seo;

use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlMapping;
use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlRouteConfig;
use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlRouteInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;

class ManufacturerSeoUrlRoute implements SeoUrlRouteInterface
{
    final public const ROUTE_NAME = 'frontend.moorl.manufacturer.detail';
    final public const DEFAULT_TEMPLATE = 'manufacturer/{{ manufacturer.translated.name }}';

    public function __construct(private readonly ManufacturerDefinition $entityDefinition)
    {
    }

    public function getConfig(): SeoUrlRouteConfig
    {
        return new SeoUrlRouteConfig(
            $this->entityDefinition,
            self::ROUTE_NAME,
            self::DEFAULT_TEMPLATE,
            true
        );
    }

    public function getMapping(Entity $entity, ?SalesChannelEntity $salesChannel): SeoUrlMapping
    {
        if (!$entity instanceof ManufacturerEntity) {
            throw new \InvalidArgumentException('Expected ManufacturerEntity');
        }

        return new SeoUrlMapping(
            $entity,
            ['manufacturerId' => $entity->getId()],
            ['manufacturer' => $entity->jsonSerialize()]
        );
    }

    public function prepareCriteria(Criteria $criteria, SalesChannelEntity $salesChannel): void
    {
    }
}
