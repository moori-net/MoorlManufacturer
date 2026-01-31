import './component';
import './config';

Shopware.Service('cmsService').registerCmsElement({
    plugin: 'MoorlCreator',
    icon: 'regular-view-grid',
    color: '#df9fdf',
    name: 'creator-product-listing',
    label: 'sw-cms.elements.creator-product-listing.name',
    component: 'sw-cms-el-creator-product-listing',
    previewComponent: true,
    configComponent: 'sw-cms-el-config-creator-product-listing',
    defaultConfig: {
        boxLayout: {
            source: 'static',
            value: 'standard',
        },
        showSorting: {
            source: 'static',
            value: true,
        },
        useCustomSorting: {
            source: 'static',
            value: false,
        },
        availableSortings: {
            source: 'static',
            value: {},
        },
        defaultSorting: {
            source: 'static',
            value: '',
        },
        filters: {
            source: 'static',
            value: 'manufacturer-filter,rating-filter,price-filter,shipping-free-filter,property-filter',
        },
        propertyWhitelist: {
            source: 'static',
            value: [],
        },
    }
});
