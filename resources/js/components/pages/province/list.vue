<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th عنوان
                th عملکردها
        tbody
            tr(v-for='province in provinces', :key='province.id')
                td {{ province.title }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showProvince(province)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(province)') ویرایش
</template>

<script>
export default {
    name: "ProvinceList",

    data: () => ({
        provinces: []
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
            return (this.provinces || []).length;
        }
    },

    /**
     * Load provinces
     */
    created() {
        this.loadProvince();
    },

    methods: {
        /**
         * Load provinces
         */
        loadProvince() {
            axios.get(this.url).then(res => {
                const data = res.data;

                Vue.set(this, "provinces", data.data || []);
            });
        },

        /**
         * Show provinces content
         */
        showProvince(province) {
            this.$emit('on-show-province', province);
        },

        /**
         * Edit an provi\nces
         */
        showEditForm(province) {

            this.$emit('on-edit-province', province);
        },

        /**
         * Insert new province
         */
        insertNewProvince(province) {
            Vue.set(this.provinces, this.provinces.length, province);
        },

        /**
         * Update an provinces
         */
        updateProvince(province) {
            let index = this.provinces.findIndex(item => item.id == province.id);

            if (index > -1) {
                Vue.set(this.provinces, index, province);
            }
        }
    }
};
</script>

<style scoped>
</style>
