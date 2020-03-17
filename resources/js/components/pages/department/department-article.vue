<template lang="pug">
    div
            div(v-for="article in articles" :key="article.id")
                div(v-html="article.body")
                div
                    ul
                        li(v-for="file in article.files" :key="file.id")
                            a(:href="file.url") {{ file.name }}

</template>

<script>
module.exports = {
    name: "DepartmentArticle",
    data: () => ({
        articles: [],
        departments: []
    }),

    props: {
        url: {
            type: String,
            default: ""
        },
        departmentId: {
            type: String,
            default: 0
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
        loadArticle(departmentId) {
            const url = this.url.replace("_ID_", departmentId || this.departmentId);

            axios.get(url).then(res => {
                const data = res.data;
                Vue.set(this, "articles", data.data || []);
            });
        },

    }
};
</script>
