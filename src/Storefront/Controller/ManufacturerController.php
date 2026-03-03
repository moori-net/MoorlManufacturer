<?php declare(strict_types=1);

namespace Moorl\Manufacturer\Storefront\Controller;

use Moorl\Manufacturer\Storefront\Page\Manufacturer\ManufacturerPageLoader;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class ManufacturerController extends StorefrontController
{
    public function __construct(private readonly ManufacturerPageLoader $manufacturerPageLoader)
    {}

    #[Route(path: '/manufacturer/{manufacturerId}', name: 'frontend.moorl.manufacturer.detail', methods: ['GET'], defaults: ['XmlHttpRequest' => true])]
    public function detail(SalesChannelContext $salesChannelContext, Request $request): Response
    {
        $page = $this->manufacturerPageLoader->load($request, $salesChannelContext);

        return $this->renderStorefront('@MoorlManufacturer/plugin/moorl-manufacturer/page/content/manufacturer-detail.html.twig', [
            'page' => $page
        ]);
    }

    #[Route(path: '/manufacturer/{manufacturerId}/products', name: 'frontend.moorl.manufacturer.products', methods: ['GET'], defaults: ['XmlHttpRequest' => true])]
    public function products(SalesChannelContext $salesChannelContext, Request $request): Response
    {
        $page = $this->manufacturerPageLoader->load($request, $salesChannelContext);

        return $this->renderStorefront('@Storefront/storefront/element/cms-element-moorl-manufacturer-product-listing.html.twig', [
            'page' => $page
        ]);
    }

    #[Route(path: '/manufacturer/{manufacturerId}/filter', name: 'frontend.moorl.manufacturer.filter', methods: ['GET'], defaults: ['XmlHttpRequest' => true])]
    public function filter(SalesChannelContext $context, Request $request): JsonResponse
    {
        return new JsonResponse([]);
    }
}
