const {Criteria} = Shopware.Data;

Shopware.Component.override('moorl-manufacturer-detail', {
    computed: {
        productManufacturerRepository() {
            return this.repositoryFactory.create('product_manufacturer');
        },
    },

    watch: {
        'item.productManufacturerId': {
            handler() {
                const criteria = new Criteria();
                criteria.setIds([this.item.productManufacturerId]);

                this.productManufacturerRepository.search(criteria).then((result) => {
                    this.item.name = result[0].translated.name;
                    this.item.description = result[0].translated.description;
                    this.item.merchantUrl = result[0].translated.link;
                });
            },
            deep: false
        },
    }
});
