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
                pageTitle: ''
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
                        title: this.newOrgan.title,
                        city: this.newOrgan.city
                    };

                    axios.post(document.pageData.url.organStore, newOrgan)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                Vue.set(this.organs, this.organs.length, data.data);

                                this.changeFormMode(this.FORM_MODES.LIST);
                            } else {
                                alert('Registration failed!');
                            }
                        })
                        .catch(err => {
                            console.log(err.response.data);
                        })
                        .then(() => {
                            this.hideLoading();
                        })
                },

                /**
                 * Clear new organization
                 */
                clearNewOrgan() {
                    let data = {
                        title: null,
                        city: null
                    };

                    Vue.set(this, 'newOrgan', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm() {
                    this.clearNewOrgan();
                    this.changeFormMode(this.FORM_MODES.CREATE);
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
