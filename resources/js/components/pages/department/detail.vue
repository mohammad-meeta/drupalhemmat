<template lang="pug">
div
    h1 {{ department.title }}

    a.btn.btn-warning(@click.prevent="backPressed") بازگشت
</template>

<script>
export default {
    name: "DepartmentDetail",

    data: () => ({
        department: {
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
         * Load an department detail
         */
        loadDepartment(departmentId, returnAsValue = false) {
            return new Promise((resolve, reject) => {
                const url = this.showUrl.replace(`_ID_`, departmentId);

                axios.get(url).then(res => {
                    const data = res.data;

                    if (returnAsValue) {
                        resolve(data);
                    } else {
                        if (data.success) {
                            Vue.set(this, "department", data.data);
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
