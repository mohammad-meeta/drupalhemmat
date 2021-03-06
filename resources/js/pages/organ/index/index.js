'use strict';

/**
 * Organ Index class
 */
function OragnIndex() {}
module.exports = OragnIndex;

/**
 * Init funciton
 */
OragnIndex.init = function init() {
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

                organs: [],
                cities: [],
                newOrgan: {},

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                hasRecord() {
                    return this.organs.length;
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
                this.clearNewOrgan();
                this.changeFormMode(this.FORM_MODES.LIST);
            },

            mounted() {
                this.init();
            },

            methods: {
                /**
                 * Show organization
                 */
                showOrganization(organ) {
                    const url = document.pageData.url.organShow.replace(`_ID_`, organ.id);

                    window.location.href = url;
                },

                /**
                 * Save new organization data
                 */
                saveNewOrgan() {
                    this.showLoading();

                    let newOrgan = {
                        id: this.newOrgan.id,
                        title: this.newOrgan.title,
                        city: this.newOrgan.city
                    };

                    let url = "";
                    let method = "";
                    let registerType = "";

                    if (newOrgan.id == null) {
                        registerType = "Registration";
                        url = document.pageData.url.organStore;
                        method = "post";
                    } else {
                        registerType = "Update";
                        url = document.pageData.url.organUpdate.replace("_ID_", newOrgan.id);
                        method = "patch";
                    }

                    axios[method](url, newOrgan)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                let index;

                                if (newOrgan.id == null){
                                    index = this.organs.length;
                                }
                                else {
                                    index = this.organs.findIndex(organ => organ.id == newOrgan.id);
                                }

                                Vue.set(this.organs, index, data.data);
                                const sorted = this.organs.sort((a, b) => a.title.localeCompare(b.title));
                                Vue.set(this, 'organs', sorted);

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
                 * Clear new organization
                 */
                clearNewOrgan(data) {
                    if (null == data) {
                        data = {
                            id: null,
                            title: null,
                            city: null
                        };
                    }

                    Vue.set(this, 'newOrgan', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.clearNewOrgan(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                showEditForm(data) {
                    const newData = {
                        id: data.id,
                        title: data.title,
                        city: data.city_id,
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
                    const organLoader = axios.get(document.pageData.url.organList);
                    const cityLoader = axios.get(document.pageData.url.cityList);

                    Promise.all([organLoader, cityLoader])
                        .then(res => {
                            /* organizations */
                            const organData = res[0];
                            Vue.set(this, 'organs', organData.data.data);

                            /* city  */
                            const cityData = res[1];
                            Vue.set(this, 'cities', cityData.data);

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
                            Vue.set(this, 'pageTitle', 'دستگاه‌های اجرایی');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت دستگاه‌ اجرایی');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش دستگاه اجرایی');
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
OragnIndex.init();
