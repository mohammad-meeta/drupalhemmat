<template lang="pug">
div

    .card.border-info.mb-3
        .card-header.bg-transparent.border-info {{ monitoring.indicator.title }}
        .card-body.text-info
            h5.card-title {{ monitoring.province.title }}
            p.card-text
            | {{ monitoring.year }}
        .card-footer.bg-transparent.border-info {{ monitoring.amount }}


    a.btn.btn-warning(@click.prevent="backPressed") بازگشت
</template>

<script>
export default {
    name: "MonitoringDetail",

    data: () => ({
        monitoring: {
            id: null,
            amount: null,
            year: null,
            indicator: {
                id: null,
                title: null
            },
            province: {
                id: null,
                title: null
            }

        }
    }),

    props: {
        showUrl: {
            type: String,
            default: ""
        }
    },

    methods: {
        /**
         * Back button pressed
         */
        backPressed() {
            this.$emit("on-back-pressed");
        },

        /**
         * Load an monitoring detail
         */
        loadMonitoring(monitoringId, returnAsValue = false) {
            return new Promise((resolve, reject) => {
                const url = this.showUrl.replace(`_ID_`, monitoringId);

                axios.get(url).then(res => {
                    const data = res.data;

                    if (returnAsValue) {
                        resolve(data);
                    } else {
                        if (data.success) {
                            Vue.set(this, "monitoring", data.data);
                        }

                        resolve();
                    }
                });
            });
        }
    }
};
</script>

<style scoped>
</style>
