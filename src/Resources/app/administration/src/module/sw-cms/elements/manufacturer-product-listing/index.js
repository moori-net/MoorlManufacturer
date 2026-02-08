import './component';
import './config';

Shopware.Service('cmsService').registerCmsElement({
    plugin: 'MoorlManufacturer',
    icon: 'regular-view-grid',
    color: '#df9fdf',
    name: 'manufacturer-product-listing',
    label: 'sw-cms.elements.manufacturer-product-listing.name',
    component: 'sw-cms-el-manufacturer-product-listing',
    previewComponent: true,
    configComponent: 'sw-cms-el-config-manufacturer-product-listing',
    defaultConfig: {
        boxLayout: {
            source: 'static',
            value: 'standard',
        },
        boxHeadlineLevel: {
            source: 'static',
            value: 2,
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
        // eslint-disable-next-line inclusive-language/use-inclusive-words
        propertyWhitelist: {
            source: 'static',
            value: [],
        },
    }
});
