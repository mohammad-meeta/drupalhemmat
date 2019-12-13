'use strict';

/**
 * Article Index class
 */
function ArticleIndex() {}
module.exports = ArticleIndex;

/**
 * Init function
 */
ArticleIndex.init = function init() {
    import ArticleList from '@components/pages/articles/list.vue';

    window.v =
        new Vue({
            el: '#app',

            components: {
                ArticleList
            },

            data: {
                FORM_MODES: {
                    LIST: 0,
                    CREATE: 1,
                    EDIT: 2,
                    DELETE: 3
                },

                articles: [],
                articleTypes: [],
                newArticle: {},

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                hasRecord() {
                    return this.articles.length;
                },

                isListMode() {
                    return this.formMode == this.FORM_MODES.LIST;
                },

                isCreateMode() {
                    return this.formMode == this.FORM_MODES.CREATE;
                },

                isEditMode() {
                    return this.formMode == this.FORM_MODES.EDIT;
                }
            },

            created() {
                this.clearNewArticle();
                this.changeFormMode(this.FORM_MODES.LIST);
            },

            mounted() {
                this.init();
            },

            methods: {
                /**
                 * Show article
                 */
                showArticle(article) {
                    const url = document.pageData.url.articleShow.replace(`_ID_`, article.id);

                    window.location.href = url;
                },

                /**
                 * Save new article data
                 */
                saveNewArticle() {
                    this.showLoading();

                    let newArticle = {
                        id: this.newArticle.id,
                        title: this.newArticle.title,
                        body: this.newArticle.body,
                        type: this.newArticle.type
                    };

                    let url = "";
                    let method = "";
                    let registerType = "";

                    if (newArticle.id == null) {
                        registerType = "Registration";
                        url = document.pageData.url.articleStore;
                        method = "post";
                    } else {
                        registerType = "Update";
                        url = document.pageData.url.articleUpdate.replace("_ID_", newArticle.id);
                        method = "patch";
                    }

                    axios[method](url, newArticle)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                let index;

                                if (newArticle.id == null) {
                                    index = this.articles.length;
                                } else {
                                    index = this.articles.findIndex(article => article.id == newArticle.id);
                                }

                                Vue.set(this.articles, index, data.data);
                                const sorted = this.articles.sort((a, b) => a.title.localeCompare(b.title));
                                Vue.set(this, 'articles', sorted);

                                Vue.set(this, 'savingSuccess', true);
                                setTimeout(() => {
                                    Vue.set(this, 'savingSuccess', false);
                                }, 2000);
                                this.changeFormMode(this.FORM_MODES.LIST);
                            } else {
                                alert(`${registerType} failed!`);
                            }
                        })
                        .catch(err => {
                            console.log(err);
                        })
                        .then(() => {
                            this.hideLoading();
                        });
                },

                /**
                 * Clear new articles
                 */
                clearNewArticle(data) {
                    if (null == data) {
                        data = {
                            id: null,
                            title: null,
                            body: null,
                            type: null
                        };
                    }

                    Vue.set(this, 'newArticle', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.clearNewArticle(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                showEditForm(data) {
                    const newData = {
                        id: data.id,
                        title: data.title,
                        body: data.body,
                        type: data.type_id,
                        oldTitle: data.title
                    };

                    this.showCreateForm(newData);
                },

                /**
                 * Hdie the create form
                 */
                hideCreateForm() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                },

                /**
                 * Load data
                 */
                loadData() {
                    this.showLoading();

                    /* Load Data */
                    const articleLoader = axios.get(document.pageData.url.articleList);
                    const articleTypeLoader = axios.get(document.pageData.url.articleTypeList);

                    Promise.all([articleLoader, articleTypeLoader])
                        .then(res => {
                            /* article */
                            const articleData = res[0];
                            Vue.set(this, 'articles', articleData.data.data);

                            /* article type  */
                            const articleTypeData = res[1];
                            Vue.set(this, 'articleTypes', articleTypeData.data);

                            this.hideLoading();
                        });
                },

                showLoading() {
                    Vue.set(this, 'isLoading', true);
                },

                hideLoading() {
                    Vue.set(this, 'isLoading', false);
                },

                changeFormMode(mode) {
                    switch (mode) {
                        case this.FORM_MODES.LIST:
                            Vue.set(this, 'pageTitle', 'مطالب');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت مطلب');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش مطلب');
                            break;
                    }

                    Vue.set(this, 'formMode', mode);
                },

                /**
                 * Init
                 */
                init() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                    this.loadData();
                }
            }
        });
};

/* Start Point */
ArticleIndex.init();
