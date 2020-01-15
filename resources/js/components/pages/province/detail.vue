<template lang="pug">
div
    h1 {{ province.title }}

    a.btn.btn-warning(@click.prevent="backPressed") بازگشت
</template>

<script>
export default {
    name: "ProvinceDetail",

    data: () => ({
        province: {
            id: null,
            title: null,
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
         * Load an province detail
         */
        loadProvince(provinceId, returnAsValue = false) {
            return new Promise((resolve, reject) => {
                const url = this.showUrl.replace(`_ID_`, provinceId);

                axios.get(url).then(res => {
                    const data = res.data;

                    if (returnAsValue) {
                        resolve(data);
                    } else {
                        if (data.success) {
                            Vue.set(this, "province", data.data);
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
