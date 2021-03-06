'use strict';

import ArticleList from '@components/pages/articles/list.vue';
import ArticleCreate from '@components/pages/articles/create.vue';
import ArticleDetail from '@components/pages/articles/detail.vue';


/**
 * Article Index class
 */
function ArticleIndex() {}
export default ArticleIndex;

/**
 * Init function
 */
ArticleIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                ArticleList,
                ArticleCreate,
                ArticleDetail
            },

            data: {
                FORM_MODES: {
                    LIST: 0,
                    CREATE: 1,
                    EDIT: 2,
                    DELETE: 3,
                    DETAIL: 4
                },

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                isListMode: state => state.formMode == state.FORM_MODES.LIST,

                isCreateMode() {
                    return this.formMode == this.FORM_MODES.CREATE;
                },

                isEditMode() {
                    return this.formMode == this.FORM_MODES.EDIT;
                },

                isDetailMode() {
                    return this.formMode == this.FORM_MODES.DETAIL;
                }
            },

            created() {
                this.changeFormMode(this.FORM_MODES.LIST);
                this.hideLoading();
            },

            methods: {
                /**
                 * On detail form's back button pressed
                 */
                cancelDetailForm() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                },

                /**
                 * On edit article result
                 * @param {Object} result
                 */
                editArticle(result) {
                    if (result.success) {
                        result.data.type_id = result.data.type.id;

                        this.$refs.articleList.updateArticle(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Update article failed!');
                    }
                },

                /**
                 * New article saved event
                 */
                newArticle(result) {
                    if (result.success) {
                        this.$refs.articleList.insertNewArticle(result.data);

                        Vue.set(this, 'savingSuccess', true);
                        setTimeout(() => {
                            Vue.set(this, 'savingSuccess', false);
                        }, 2000);

                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show article
                 */
                showArticle(article) {
                    this.$refs.articleDetail.loadArticle(article.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL, article);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    if (null != data) {
                        data = {
                            id: data.id,
                            title: data.title,
                            articleType: data.type_id,
                            documentCategory: data.document_category_id,
                            department: data.department_id,
                            status: data.status,
                            body: data.body
                        };
                    }

                    CKEDITOR.instances.editor.setData((data || {}).body || '');
                    this.$refs.articleCreate.clearNewArticle(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const articleData = await this.$refs.articleDetail.loadArticle(data.id, true);

                    this.showCreateForm(articleData.data);
                },

                /**
                 * Hdie the create form
                 */
                hideCreateForm() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                },

                showLoading() {
                    Vue.set(this, 'isLoading', true);
                },

                hideLoading() {
                    Vue.set(this, 'isLoading', false);
                },

                changeFormMode(mode, article) {
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

                        case this.FORM_MODES.DETAIL:
                            Vue.set(this, 'pageTitle', article.title);
                        break;
                    }

                    Vue.set(this, 'formMode', mode);
                },

                /**
                 * Init
                 */
                init() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                }
            }
        });
};

/* Start Point */
ArticleIndex.init();
