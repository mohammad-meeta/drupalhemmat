<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th عنوان
                th عملکردها
        tbody
            tr(v-for='indicatorCategory in indicatorCategories', :key='indicatorCategory.id')
                td {{ indicatorCategory.title }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showIndicatorCategory(indicatorCategory)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(indicatorCategory)') ویرایش
</template>

<script>
export default {
    name: "IndicatorCategoryList",

    data: () => ({
        indicatorCategories: []
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
            return (this.indicatorCategories || []).length;
        }
    },

    /**
     * Load Indicator Categories
     */
    created() {
        this.loadIndicatorCategory();
    },

    methods: {
        /**
         * Load Indicator Categories
         */
        loadIndicatorCategory() {
            axios.get(this.url).then(res => {
                const data = res.data;

                Vue.set(this, "indicatorCategories", data.data || []);
            });
        },

        /**
         * Show indicator Category content
         */
        showIndicatorCategory(indicatorCategory) {
            console.log("llllllll");
            this.$emit('on-show-indicator-category', indicatorCategory);
        },

        /**
         * Edit an indicator Category
         */
        showEditForm(indicatorCategory) {

            this.$emit('on-edit-indicator-category', indicatorCategory);
        },

        /**
         * Insert new indicator Category
         */
        insertNewIndicatorCategory(indicatorCategory) {
            Vue.set(this.indicatorCategories, this.indicatorCategories.length, indicatorCategory);
        },

        /**
         * Update an Indicator Category
         */
        updateIndicatorCategory(indicatorCategory) {
            let index = this.indicatorCategories.findIndex(item => item.id == indicatorCategory.id);

            if (index > -1) {
                Vue.set(this.indicatorCategories, index, indicatorCategory);
            }
        }
    }
};
</script>

<style scoped>
</style>
