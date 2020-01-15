<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th شاخص
                th استان
                th سال
                th مقدار
                th عملکردها
        tbody
            tr(v-for='monitoring in monitorings', :key='monitoring.id')
                td {{ monitoring.indicator.title }}
                td {{ monitoring.province.title }}
                td {{ monitoring.year }}
                td {{ monitoring.amount }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showMonitoring(monitoring)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(monitoring)') ویرایش
</template>

<script>
export default {
    name: "MonitoringList",

    data: () => ({
        monitorings: []
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
            return (this.monitorings || []).length;
        }
    },

    /**
     * Load monitorings
     */
    created() {
        this.loadMonitoring();
    },

    methods: {
        /**
         * Load monitorings
         */
        loadMonitoring() {
            axios.get(this.url).then(res => {
                const data = res.data;

                Vue.set(this, "monitorings", data.data || []);
            });
        },

        /**
         * Show monitorings content
         */
        showMonitoring(monitoring) {
            this.$emit('on-show-monitoring', monitoring);
        },

        /**
         * Edit an provi\nces
         */
        showEditForm(monitoring) {

            this.$emit('on-edit-monitoring', monitoring);
        },

        /**
         * Insert new monitoring
         */
        insertNewMonitoring(monitoring) {
            Vue.set(this.monitorings, this.monitorings.length, monitoring);
        },

        /**
         * Update an monitorings
         */
        updateMonitoring(monitoring) {
            let index = this.monitorings.findIndex(item => item.id == monitoring.id);

            if (index > -1) {
                Vue.set(this.monitorings, index, monitoring);
            }
        }
    }
};
</script>

<style scoped>
</style>
