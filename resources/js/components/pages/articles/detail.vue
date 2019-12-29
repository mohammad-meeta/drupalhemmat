<template lang="pug">
div
    h1 {{ article.title }}
    h3 {{ article.type.title }}
    div(v-html="article.body")

    a.btn.btn-warning(@click.prevent="backPressed") بازگشت
</template>

<script>
export default {
    name: "ArticleDetail",

    data: () => ({
        article: {
            id: null,
            title: null,
            body: null,
            type: {
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
         * Load an article detail
         */
        loadArticle(articleId) {
            const url = this.showUrl.replace(`_ID_`, articleId);

            axios.get(url).then(res => {
                const data = res.data;

                if (data.success) {
                    Vue.set(this, "article", data.data);
                }
            });
        }
    }
};
</script>

<style scoped>
</style>
