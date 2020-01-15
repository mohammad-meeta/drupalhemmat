<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th عنوان
                th عملکردها
        tbody
            tr(v-for='indicator in indicators', :key='indicator.id')
                td {{ indicator.title }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showIndicator(indicator)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(indicator)') ویرایش
</template>

<script>
export default {
    name: "IndicatorList",

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
        hasRecord() {
            return (this.indicators || []).length;
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
         * Show indicators content
         */
        showIndicator(indicator) {
            this.$emit('on-show-indicator', indicator);
        },

        /**
         * Edit an provi\nces
         */
        showEditForm(indicator) {

            this.$emit('on-edit-indicator', indicator);
        },

        /**
         * Insert new indicator
         */
        insertNewIndicator(indicator) {
            Vue.set(this.indicators, this.indicators.length, indicator);
        },

        /**
         * Update an indicators
         */
        updateIndicator(indicator) {
            let index = this.indicators.findIndex(item => item.id == indicator.id);

            if (index > -1) {
                Vue.set(this.indicators, index, indicator);
            }
        }
    }
};
</script>

<style scoped>
</style>
