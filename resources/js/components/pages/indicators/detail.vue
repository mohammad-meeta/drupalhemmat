<template lang="pug">
div
    h1 {{ indicator.title }}

    div#graph-container
        canvas#results-graph(ref='chart')

    a.btn.btn-warning(@click.prevent="backPressed") بازگشت
</template>

<script>
import { Bar } from "vue-chartjs";

export default {
    name: "IndicatorDetail",

    extends: Bar,

    data: () => ({
        indicator: {
            id: null,
            title: null
        },
        list: {
            id: null,
            province: null,
            amount: null,
            year: null
        }
    }),

    props: {
        showUrl: {
            type: String,
            default: ""
        }
    },

    mounted() {

    },

    methods: {
        /**
         * Back button pressed
         */
        backPressed() {
            this.$emit("on-back-pressed");
        },

        /**
         * Load an indicator detail
         */
        loadIndicator(indicatorId, returnAsValue = false) {
            return new Promise((resolve, reject) => {
                const url = this.showUrl.replace(`_ID_`, indicatorId);

                axios.get(url).then(res => {
                    const data = res.data;

                    if (returnAsValue) {
                        resolve(data);
                    } else {
                        if (data.success) {
                            Vue.set(this, "indicator", data.data[0]);
                            Vue.set(this, "list", data.data[1]);
                        }

                        this.drawChart();

                        resolve();
                    }
                });
            });
        },

        drawChart() {

            /* clear old chart */
            $('#results-graph').remove();
            $('#graph-container').append('<canvas id="results-graph">');
            var chart = document.querySelector('#results-graph');

           // var chart = this.$refs.chart;
            var ctx = chart.getContext("2d");

            const data = this.list.data;
            const dataLabels = data.map(x => x.province_title);
            const dataList = data.map(x => x.amount);
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: dataLabels,
                    datasets: [
                        {
                            label: this.indicator.title,
                            data: dataList,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            });
        }
    }
};
</script>

<style scoped>
</style>
