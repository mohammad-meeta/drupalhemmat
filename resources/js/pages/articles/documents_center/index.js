'use strict';

import ArticleDocumentsCenter from '@components/pages/articles/documents-center.vue';
import ArticleDetail from '@components/pages/articles/detail.vue';

/**
 * Article Class
 */
function ArticlePage() {}
export default ArticlePage;

/**
 * Init function
 */
ArticlePage.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                ArticleDocumentsCenter,
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

                formMode: null,
                pageTitle: 'عنوان',
                isLoading: true
            },

            computed: {
               // isListMode: (state) => ! state.isLoading,
                isListMode: state => state.formMode == state.FORM_MODES.LIST,

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

                hideLoading() {
                    Vue.set(this, 'isLoading', false);
                },

                /**
                 * Show article
                 */
                showArticle(article) {
                    this.$refs.articleDetail.loadArticle(article.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                changeFormMode(mode) {
                    switch (mode) {
                        case this.FORM_MODES.LIST:
                            Vue.set(this, 'pageTitle', 'مطالب');
                            break;

                        case this.FORM_MODES.DETAIL:
                            Vue.set(this, 'pageTitle', 'ثبت مطلب');
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
}

// Main loop
ArticlePage.init();
