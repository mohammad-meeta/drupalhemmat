'use strict';

import ProvinceList from '@components/pages/province/list.vue';
import ProvinceCreate from '@components/pages/province/create.vue';
import ProvinceDetail from '@components/pages/province/detail.vue';

/**
 * province Index class
 */
function ProvinceIndex() {}
export default ProvinceIndex;

/**
 * Init function
 */
ProvinceIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                ProvinceList,
                ProvinceCreate,
                ProvinceDetail
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
                 * On edit province result
                 * @param {Object} result
                 */
                editProvince(result) {

                    if (result.success) {
                        this.$refs.provinceList.updateProvince(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);

                    } else {
                        alert('Update province failed!');
                    }
                },

                /**
                 * New province saved event
                 */
                newProvince(result) {
                    if (result.success) {
                        this.$refs.provinceList.insertNewProvince(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show province
                 */
                showProvince(province) {
                    this.$refs.provinceDetail.loadProvince(province.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.$refs.provinceCreate.clearNewProvince(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const provinceData = await this.$refs.provinceDetail.loadProvince(data.id, true);

                    this.showCreateForm(provinceData.data);
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

                changeFormMode(mode) {
                    switch (mode) {
                        case this.FORM_MODES.LIST:
                            Vue.set(this, 'pageTitle', 'استان ها');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت استان');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش استان');
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
ProvinceIndex.init();
