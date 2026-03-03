import template from './index.html.twig';
import './index.scss';

Shopware.Component.register('sw-cms-el-manufacturer-header', {
    template,

    mixins: [
        Shopware.Mixin.getByName('cms-element'),
        Shopware.Mixin.getByName('placeholder'),
    ],

    computed: {
        manufacturerAvatarUrl() {
            const item = this.getDemoValue('moorl_manufacturer.avatar')
            if (item?.url) {
                return item.url;
            }
            return this.assetFilter('administration/administration/static/img/cms/preview_mountain_large.jpg');
        },
        manufacturerBannerUrl() {
            const item = this.getDemoValue('moorl_manufacturer.banner')
            if (item?.url) {
                return item.url;
            }
            return this.assetFilter('administration/administration/static/img/cms/preview_mountain_large.jpg');
        },
        manufacturerName() {
            return this.getDemoValue('moorl_manufacturer.translated.name');
        },
        manufacturerDescription() {
            return this.getDemoValue('moorl_manufacturer.translated.teaser');
        },
        assetFilter() {
            return Shopware.Filter.getByName('asset');
        },
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('moorl-manufacturer-header');
            this.initElementData('moorl-manufacturer-header');
        },
    },
});
