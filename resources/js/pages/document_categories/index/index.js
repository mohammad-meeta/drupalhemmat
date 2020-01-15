'use strict';

/**
 * Document Category Index class
 */
function DocumentCategoryIndex() {}
module.exports = DocumentCategoryIndex;

/**
 * Init function
 */
DocumentCategoryIndex.init = function init() {
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

                documentCategories: [],
                newDocumentCategory: {},

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                hasRecord() {
                    return this.documentCategories.length;
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
                this.clearnewDocumentCategory(),
                    this.changeFormMode(this.FORM_MODES.LIST);
            },

            mounted() {
                this.init();
            },

            methods: {
                /**
                 * Show document category
                 */
                showDocumentCategory(documentCategory) {
                    const url = document.pageData.url.documentCategoryShow.replace(`_ID_`, documentCategory.id);
                    window.location.href = url;
                },

                /**
                 * Save new document category data
                 */
                saveNewDocumentCategory() {
                    this.showLoading();

                    let newDocumentCategory = {
                        id: this.newDocumentCategory.id,
                        title: this.newDocumentCategory.title
                    };

                    let url = "";
                    let method = "";
                    let registerType = "";

                    if (newDocumentCategory.id == null) {
                        registerType = "Registration";
                        url = document.pageData.url.documentCategoryStore;
                        method = "post";
                    } else {
                        registerType = "Update";
                        url = document.pageData.url.documentCategoryUpdate.replace("_ID_", newDocumentCategory.id);
                        method = "patch";
                    }
                    console.log(method);
                    axios[method](url, newDocumentCategory)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                let index;

                                if (newDocumentCategory.id == null) {
                                    index = this.documentCategories.length;
                                } else {
                                    index = this.documentCategories.findIndex(documentCategory => documentCategory.id == newDocumentCategory.id);
                                }

                                Vue.set(this.documentCategories, index, data.data);
                                const sorted = this.documentCategories.sort((a, b) => a.title.localeCompare(b.title));
                                Vue.set(this, 'documentCategories', sorted);

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
                 * Clear new document category
                 */
                clearnewDocumentCategory(data) {
                    if (null == data) {
                        data = {
                            id: null,
                            title: null,
                            oldTitle: null
                        };
                    }

                    Vue.set(this, 'newDocumentCategory', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.clearnewDocumentCategory(data);
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
                    const documentCategoryLoader = axios.get(document.pageData.url.documentCategoryList);
                    Promise.all([documentCategoryLoader])
                        .then(res => {
                            const documentCategoryData = res[0];
                            Vue.set(this, 'documentCategories', documentCategoryData.data);

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
                            Vue.set(this, 'pageTitle', 'دسته بندی اسناد');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت دسته بندی اسناد');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش دسته بندی اسناد');
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
DocumentCategoryIndex.init();
