<template lang="pug">
form(method='POST', action='/monitoring')

    .form-group
        label(for='indicator') شاخص
        select.form-control(required='', v-model='newMonitoring.indicator' )
            option(v-for='indicator in indicators', :key='indicator.id', :value='indicator.id')
                | {{ indicator.title }}

    .form-group
        label(for='province') استان
        select.form-control(required='', v-model='newMonitoring.province' )
            option(v-for='province in provinces', :key='province.id', :value='province.id')
                | {{ province.title }}

    .form-group
        label(for='year') سال
        select.form-control(required='', v-model='newMonitoring.year' )
            option( :key='1398', :value='1398') 1398
            option( :key='1399', :value='1399') 1399

    .form-group
        label(for='amount') مقدار
        input.form-control(type='number', required='', v-model='newMonitoring.amount')

    .form-group.custom-control.custom-switch
        input#switch1.custom-control-input(type='checkbox', checked,
                            v-model='newMonitoring.status', :value='1')
        label.custom-control-label(for='switch1') انتشار

    .form-group
        button.btn.btn-primary(type='submit', @click.prevent='saveNewMonitoring') ذخیره
        button.btn.btn-danger(type='button', @click.prevent='cancelCreateMonitoring') لغو
</template>

<script>

export default {
    name: "MonitoringCreate",

    data: () => ({
        newMonitoring: {},
        indicators: [],
        provinces: [],
        data: {}
    }),

    props: {
        showUrl: {
            type: String,
            default: ""
        },

        storeUrl: {
            type: String,
            default: ""
        },

        updateUrl: {
            type: String,
            default: ""
        },

        indicatorsUrl: {
            type: String,
            default: ""
        },

        provincesUrl: {
            type: String,
            default: ""
        }
    },

    created() {
        this.init();
    },

    mounted() {
        this.clearNewMonitoring();
    },

    methods: {

        /**
         * Cancel create monitoring
         */
        cancelCreateMonitoring() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new monitoring data
         */
        saveNewMonitoring() {
            let newMonitoring = {
                id: this.newMonitoring.id,
                indicator: this.newMonitoring.indicator,
                province: this.newMonitoring.province,
                amount: this.newMonitoring.amount,
                year: this.newMonitoring.year,
                status: this.newMonitoring.status
            };

            let url = "";
            let method = "";
            let registerType = "";

            if (newMonitoring.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";

                url = this.updateUrl.replace("_ID_", newMonitoring.id);
                method = "patch";
            }

            axios[method](url, newMonitoring)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;

                        if (newMonitoring.id == null) {
                            this.$emit("on-new-monitoring", newRecord);
                        } else {
                            this.$emit("on-edit-monitoring", newRecord);
                        }
                    } else {
                        alert(`${registerType} failed!`);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Clear new monitoring
         */
        clearNewMonitoring(data) {
            if (null == data) {
                data = {
                    id: null,
                    indicator: null,
                    province: null,
                    amount: null,
                    year: null,
                    status: null
                };
            }

            if (data.indicator == null && this.indicators.length > 0) {
                data.indicator = this.indicators[0].id;
            }

            if (data.province == null && this.provinces.length > 0) {
                data.province = this.provinces[0].id;
            }

            Vue.set(this, "newMonitoring", data);
        },

        /**
        * Load indicators
        */
        loadIndicators() {
            console.log(this.indicatorsUrl);
            axios
                .get(this.indicatorsUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "indicators", data.data);
                })
                .catch(err => console.error(err));
        },

        /**
        * Load provinces
        */
        loadProvinces() {
            console.log(this.provincesUrl);
            axios
                .get(this.provincesUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "provinces", data.data);
                })
                .catch(err => console.error(err));
        },

        /**
         * Initialization
         */
        init() {
            this.loadIndicators();
            this.loadProvinces();
        }
    }
};

</script>


<style scoped>
</style>
