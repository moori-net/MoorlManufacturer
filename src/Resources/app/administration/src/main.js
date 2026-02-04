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
        ],
        pluginName: 'MoorlManufacturer',
        demoName: 'standard',
        entityMapping: {
            productManufacturer: {tab: 'general', card: 'general', order: 'first'}
        },
        cmsElements: [
            {
                name: 'manufacturer-listing',
                parent: 'listing',
                icon: 'regular-view-grid',
                cmsElementEntity: {
                    associations: ['cover.media'],
                    propertyMapping: {
                        media: 'cover.media',
                        name: ['translated.name', 'name'],
                        description: ['translated.teaser', 'teaser'],
                    },
                }
            }
        ]
    });
});

import './module';
