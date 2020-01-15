<template lang="pug">
div
    h2(v-if='(! hasRecord)') اطلاعاتی وجود ندارد


    .itemsboxes(
            v-for='article in documentCategories', :v-key='article'
        )
        h2.item-category.pt-5.pb-2.text-center {{ article.title }}
        .itemsbox.p-5.m-5
            .itembox.p-3.d-flex.justify-content-between.align-items-center(
                v-for="item in article.data", :v-key="item.id"
                )
                .itembox-title
                    | {{item.title}}

                .itembox-link.d-flex
                    a.linkbtn.d-flex.align-items-center(href='#', @click.prevent='showArticle(item)')
                        .linktext.ml-3 مشاهده
                        .linkicon
</template>

<script>
module.exports = {
    name: "DocumentsCenter",
    data: () => ({
        articles: [],
        documents: []
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
        hasRecord: state => (state.articles || []).length,

        documentCategories() {
            let result = {};

            this.articles.forEach(article => {
                const category = article.document_category.title;

                if (result[category] == null) {
                    result[category] = [];
                }

                result[category].push(article);
            });

            /* Convert to array */
            let resultArray = [];
            Object.keys(result || {}).map(key =>
                resultArray.push({
                    title: key,
                    data: result[key]
                })
            );

            return resultArray;
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
        }

    }
};
</script>

<style scoped>
</style>
