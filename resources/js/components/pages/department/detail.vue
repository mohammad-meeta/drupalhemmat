<template lang="pug">
div
    h1 {{ department.title }}
    department-article(ref='departmentArticle', :url="articlesUrl", :department-id="departmentId")

    a.btn.btn-warning(v-show="showBackButton", @click.prevent="backPressed") بازگشت
</template>

<script>
import DepartmentArticle from "@components/pages/department/department-article.vue";

export default {
    name: "DepartmentDetail",

    components: {
        DepartmentArticle
    },

    data: () => ({
        department: {
            id: null,
            title: null
        }
    }),

    props: {
        articlesUrl: {
            type: String,
            default: ""
        },
        departmentId: {
            type: String,
            default: "0"
        },
        showBackButton: true,
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

                    if (!returnAsValue && data.success) {
                        Vue.set(this, "department", data.data || {});

                        this.$refs.departmentArticle.loadArticle(departmentId);
                    }
                    resolve(data);
                });
            });
        }
    }
};
</script>

<style scoped>
</style>
