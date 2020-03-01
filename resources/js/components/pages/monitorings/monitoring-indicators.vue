<template lang="pug">
div
    h2(v-if='(! hasRecord)') اطلاعاتی وجود ندارد


    .itemsboxes(
            v-for='indicator in indicatorCategories', :v-key='indicator'
        )
        h2.item-category.pt-5.pb-2.text-center {{ indicator.title }}
        .itemsbox.p-5.m-5
            .itembox.p-3.d-flex.justify-content-between.align-items-center(
                v-for="item in indicator.data", :v-key="item.id"
                )
                .itembox-title
                    | {{item.title}}

                .itembox-link.d-flex
                    a.linkbtn.d-flex.align-items-center(href='#', @click.prevent='showIndicator(item)')
                        .linktext.ml-3 مشاهده
                        .linkicon
</template>

<script>
module.exports = {
    name: "IndicatorMonitoringIndicators",
    data: () => ({
        indicators: []
    }),

    props: {
        url: {
            type: String,
            default: ""
        }
    },

    computed: {
        /**
         * Check for records exists
         */
        hasRecord: state => (state.indicators || []).length,

        indicatorCategories() {
            let result = {};

            this.indicators.forEach(indicator => {
                const category = indicator.indicator_category.title;

                if (result[category] == null) {
                    result[category] = [];
                }

                result[category].push(indicator);
            });

            /* Convert to array */
            let resultArray = [];
            Object.keys(result || {}).map(key =>
                resultArray.push({
                    title: key,
                    data: result[key]
                })
            );

            return resultArray;
        }
    },

    /**
     * Load indicators
     */
    created() {
        this.loadIndicator();
    },

    methods: {
        /**
         * Load indicators
         */
        loadIndicator() {
            axios.get(this.url).then(res => {
                const data = res.data;
                Vue.set(this, "indicators", data.data || []);
            });
        },

        /**
         * Show indicator content
         */
        showIndicator(indicator) {
            this.$emit('on-show-indicator', indicator);
        }

    }
};
</script>

<style scoped>
</style>
