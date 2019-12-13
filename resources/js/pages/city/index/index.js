'use strict';

/**
 * city Index class
 */
function CityIndex() {}
module.exports = CityIndex;

/**
 * Init funciton
 */
CityIndex.init = function init() {
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

                cities: [],
                newCity: {},

                isLoading: true,
                formMode: null,
                pageTitle: '',
                savingSuccess: false
            },

            computed: {
                hasRecord() {
                    return this.cities.length;
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
                this.clearNewCity(),
                    this.changeFormMode(this.FORM_MODES.LIST);
            },

            mounted() {
                this.init();
            },

            methods: {
                /**
                 * Show city
                 */
                showCity(city) {
                    const url = document.pageData.url.cityShow.replace(`_ID_`, city.id);
                    window.location.href = url;
                },

                /**
                 * Save new city data
                 */
                saveNewCity() {
                    this.showLoading();

                    let newCity = {
                        id: this.newCity.id,
                        title: this.newCity.title
                    };

                    let url = "";
                    let method = "";
                    let registerType = "";

                    if (newCity.id == null) {
                        registerType = "Registration";
                        url = document.pageData.url.cityStore;
                        method = "post";
                    } else {
                        registerType = "Update";
                        url = document.pageData.url.cityUpdate.replace("_ID_", newCity.id);
                        method = "patch";
                    }
                    console.log(method);
                    axios[method](url, newCity)
                        .then(res => {
                            const data = res.data;

                            if (data.success) {
                                let index;

                                if (newCity.id == null) {
                                    index = this.cities.length;
                                } else {
                                    index = this.cities.findIndex(city => city.id == newCity.id);
                                }

                                Vue.set(this.cities, index, data.data);
                                const sorted = this.cities.sort((a, b) => a.title.localeCompare(b.title));
                                Vue.set(this, 'cities', sorted);

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
                 * Clear new city
                 */
                clearNewCity(data) {
                    if (null == data) {
                        data = {
                            id: null,
                            title: null,
                            oldTitle: null
                        };
                    }

                    Vue.set(this, 'newCity', data);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.clearNewCity(data);

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
                    const cityLoader = axios.get(document.pageData.url.cityList);

                    Promise.all([cityLoader])
                        .then(res => {
                            const cityData = res[0];
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
                            Vue.set(this, 'pageTitle', 'شهرها');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت شهر');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش شهر');
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
CityIndex.init();
