function onMoorlFoundationReady(callback) {
    if (window.MoorlFoundation) {
        callback();
    } else {
        window.addEventListener('MoorlFoundationReady', callback, { once: true });
    }
}

onMoorlFoundationReady(() => {
    MoorlFoundation.ModuleHelper.registerModule({
        entity: 'moorl_manufacturer',
        name: 'moorl-manufacturer',
        navigationParent: 'sw-catalogue',
        pageType: 'manufacturer_detail',
        properties: [
            {name: 'active', visibility: 100},
            {name: 'name', visibility: 200},
            {name: 'merchantUrl', visibility: 100},
            {name: 'phoneNumber', visibility: 100},
            {name: 'email', visibility: 100},
            {name: 'productCount', visibility: 100},
            {name: 'city', visibility: 100},
        ],
        pluginName: 'MoorlManufacturer',
        demoName: 'standard',
        entityMapping: {
            productManufacturer: {tab: 'general', card: 'general', order: 'first'},
            marker: {hidden: true},
            locationCache: {hidden: true},
            bannerColor: {hidden: true},
        },
        cmsElements: [
            {
                name: 'manufacturer-listing',
                parent: 'listing',
                icon: 'regular-view-grid',
                cmsElementEntity: {
                    associations: ['productManufacturer'],
                    propertyMapping: {
                        media: 'productManufacturer.media',
                        name: ['translated.name', 'name'],
                        description: ['translated.teaser', 'teaser'],
                    },
                }
            }
        ]
    });
});

import './module';
