'use strict';

/**
 * Article type Index class
 */
function ArticleTypeIndex() {}
module.exports = ArticleTypeIndex;

/**
 * Init function
 */
ArticleTypeIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            data: {
                FORM_MODES: {
                    LIST: 0,
                    CREATE: 1,
                    EDIT: 2,
                    DELETE: 3
                },

                articleTypes: [],
                newArticleType: {},

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                hasRecord() {
                    return this.articleTypes.length;
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
                this.clearNewArticleType(),
                    this.changeFormMode(this.FORM_MODES.LIST);
            },

            mounted() {
                this.init();
            },

            methods: {
                /**
                 * Show article type
                 */
                showArticleType(articleType) {
                    const url = document.pageData.url.articleTypeShow.replace(`_ID_`, articleType.id);
                    window.location.href = url;
                },

                /**
                 * Save new article type data
                 */
                saveNewArticleType() {
                    this.showLoading();

                    let newArticleType = {
                        id: this.newArticleType.id,
                        title: this.newArticleType.title
                    };

                    let url = "";
                    let method = "";
                    let registerType = "";

                    if (newArticleType.id == null) {
                        registerType = "Registration";
                        url = document.pageData.url.articleTypeStore;
                        method = "post";
                    } else {
                        registerType = "Update";
                        url = document.pageData.url.articleTypeUpdate.replace("_ID_", newArticleType.id);
                        method = "patch";
                    }
                    console.log(method);
                    axios[method](url, newArticleType)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                let index;

                                if (newArticleType.id == null) {
                                    index = this.articleTypes.length;
                                } else {
                                    index = this.articleTypes.findIndex(articleType => articleType.id == newArticleType.id);
                                }

                                Vue.set(this.articleTypes, index, data.data);
                                const sorted = this.articleTypes.sort((a, b) => a.title.localeCompare(b.title));
                                Vue.set(this, 'articleTypes', sorted);

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
                 * Clear new article type
                 */
                clearNewArticleType(data) {
                    if (null == data) {
                        data = {
                            id: null,
                            title: null,
                            oldTitle: null
                        };
                    }

                    Vue.set(this, 'newArticleType', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.clearNewArticleType(data);
                    if (data.id != null) {
                        this.changeFormMode(this.FORM_MODES.EDIT);
                    } else {
                        this.changeFormMode(this.FORM_MODES.CREATE);
                    }
                },

                /**
                 * Show the edit form
                 */
                showEditForm(data) {
                    const newData = {
                        id: data.id,
                        title: data.title,
                        oldTitle: data.title
                    };
                    this.showCreateForm(newData);
                },

                /**
                 * Hide the create form
                 */
                hideCreateForm() {
                    this.changeFormMode(this.FORM_MODES.LIST);
                },

                /**
                 * Data load
                 */
                loadData() {
                    this.showLoading();

                    /* Load Data */
                    const articleTypeLoader = axios.get(document.pageData.url.articleTypeList);

                    Promise.all([articleTypeLoader])
                        .then(res => {
                            const articleTypeData = res[0];
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
                            Vue.set(this, 'pageTitle', 'انواع مطلب');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت نوع مطلب');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش نوع مطلب');
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


/* Start point */
ArticleTypeIndex.init();
