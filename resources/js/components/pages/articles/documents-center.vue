<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th عنوان
                th نوع مطلب
                th عملکردها
        tbody
            tr(v-for='article in articles', :key='article.id')
                td {{ article.title }}
                td {{ article.type.title }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showArticle(article)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(article)') ویرایش
</template>

<script>
module.exports = {
    name: "ArticleList",

    data: () => ({
        articles: []
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
            return (this.articles || []).length;
        }
    },

    /**
     * Load articles
     */
    created() {
        this.loadArticle();
    },

    methods: {
        /**
         * Load articles
         */
        loadArticle() {
            axios.get(this.url).then(res => {
                const data = res.data;

                Vue.set(this, "articles", data.data || []);
            });
        },

        /**
         * Show article content
         */
        showArticle(article) {
            this.$emit('on-show-article', article);
        },

        /**
         * Edit an article
         */
        showEditForm(article) {
            this.$emit('on-edit-article', article);
        },

        /**
         * Insert new article
         */
        insertNewArticle(article) {
            Vue.set(this.articles, this.articles.length, article);
        },

        /**
         * Update an article
         */
        updateArticle(article) {
            let index = this.articles.findIndex(item => item.id == article.id);

            if (index > -1) {
                Vue.set(this.articles, index, article);
            }
        }
    }
};
</script>

<style scoped>
</style>
