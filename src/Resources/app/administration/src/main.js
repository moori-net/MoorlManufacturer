function onMoorlFoundationReady(callback) {
    if (window.MoorlFoundation) return callback();

    const t = setTimeout(() => {
        console.error('[MoorlFoundation] Object/Event not loaded.');
        window.removeEventListener('MoorlFoundationReady', onReady);
    }, 5000);

    function onReady() {
        clearTimeout(t);
        if (!window.MoorlFoundation) {
            return console.error('[MoorlFoundation] Event exists, Object failed.');
        }
        callback();
    }

    window.addEventListener('MoorlFoundationReady', onReady, { once: true });
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
        },
        cmsElements: [
            {
                name: 'moorl-manufacturer-listing',
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
