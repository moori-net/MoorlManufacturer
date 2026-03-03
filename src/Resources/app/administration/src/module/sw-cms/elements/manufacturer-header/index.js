import './component';

Shopware.Service('cmsService').registerCmsElement({
    plugin: 'MoorlManufacturer',
    icon: 'regular-user',
    color: '#df9fdf',
    previewComponent: true,
    name: 'moorl-manufacturer-header',
    label: 'sw-cms.elements.manufacturer-header.name',
    component: 'sw-cms-el-manufacturer-header',
    disabledConfigInfoTextKey: 'sw-cms.elements.manufacturer-header.tooltipSettingDisabled',
});
