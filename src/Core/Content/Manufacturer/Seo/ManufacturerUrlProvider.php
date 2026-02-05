<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Core\Content\Manufacturer\Seo;

use Doctrine\DBAL\Connection;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerCollection;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerDefinition;
use Moorl\Manufacturer\Core\Content\Manufacturer\ManufacturerEntity;
use Moorl\Manufacturer\Core\Content\Manufacturer\SalesChannel\ManufacturerAvailableFilter;
use Shopware\Core\Content\Sitemap\Provider\AbstractUrlProvider;
use Shopware\Core\Content\Sitemap\Service\ConfigHandler;
use Shopware\Core\Content\Sitemap\Struct\Url;
use Shopware\Core\Content\Sitemap\Struct\UrlResult;
use Shopware\Core\Framework\DataAbstractionLayer\Dbal\Common\IteratorFactory;
use Shopware\Core\Framework\DataAbstractionLayer\Doctrine\FetchModeHelper;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class ManufacturerUrlProvider extends AbstractUrlProvider
{
    final public const CHANGE_FREQ = 'weekly';
    private readonly EntityRepository $repository;

    public function __construct(
        private readonly ConfigHandler $configHandler,
        private readonly Connection $connection,
        private readonly ManufacturerDefinition $definition,
        private readonly IteratorFactory $iteratorFactory,
        private readonly RouterInterface $router,
        EntityRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function getDecorated(): AbstractUrlProvider
    {
        throw new DecorationPatternException(self::class);
    }

    public function getName(): string
    {
        return 'moorl_manufacturer_page';
    }

    public function getUrls(SalesChannelContext $salesChannelContext, int $limit, ?int $offset = null): UrlResult
    {
        $collection = $this->getCollection($salesChannelContext, $limit, $offset);
        if ($collection->count() === 0) {
            return new UrlResult([], null);
        }

        $seoUrls = $this->getSeoUrls($collection->getIds(), 'frontend.moorl.manufacturer.detail', $salesChannelContext, $this->connection);
        $seoUrls = FetchModeHelper::groupUnique($seoUrls);

        $urls = [];
        $url = new Url();
        foreach ($collection as $entity) {
            $lastMod = $entity->getUpdatedAt() ?: $entity->getCreatedAt();

            $newUrl = clone $url;
            if (isset($seoUrls[$entity->getId()])) {
                $newUrl->setLoc($seoUrls[$entity->getId()]['seo_path_info']);
            } else {
                $newUrl->setLoc($this->router->generate('frontend.moorl.manufacturer.detail', ['manufacturerId' => $entity->getId()], UrlGeneratorInterface::ABSOLUTE_PATH));
            }

            $newUrl->setLastmod($lastMod);
            $newUrl->setChangefreq(self::CHANGE_FREQ);
            $newUrl->setResource(ManufacturerEntity::class);
            $newUrl->setIdentifier($entity->getId());

            $urls[] = $newUrl;
        }

        if (\count($urls) < $limit) { // last run
            $nextOffset = null;
        } elseif ($offset === null) { // first run
            $nextOffset = $limit;
        } else { // 1+n run
            $nextOffset = $offset + $limit;
        }

        return new UrlResult($urls, $nextOffset);
    }

    private function getCollection(SalesChannelContext $salesChannelContext, int $limit, ?int $offset, Criteria $collectionCriteria = null): ManufacturerCollection
    {
        if (!$collectionCriteria) {
            $collectionCriteria = new Criteria();
            $collectionCriteria->addFilter(new ManufacturerAvailableFilter($salesChannelContext));
        }
        $collectionCriteria->setLimit($limit);

        if ($offset !== null) {
            $collectionCriteria->setOffset($offset);
        }

        /** @var ManufacturerCollection $collection */
        $collection = $this->repository->search($collectionCriteria, $salesChannelContext->getContext())->getEntities();

        return $collection;
    }
}
