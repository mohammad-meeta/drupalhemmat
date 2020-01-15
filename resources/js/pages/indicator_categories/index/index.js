'use strict';

import IndicatorCategoryList from '@components/pages/indicator_categories/list.vue';
import IndicatorCategoryCreate from '@components/pages/indicator_categories/create.vue';
import IndicatorCategoryDetail from '@components/pages/indicator_categories/detail.vue';

/**
 * Indicator Category Index class
 */
function IndicatorCategoryIndex() {}
export default IndicatorCategoryIndex;

/**
 * Init function
 */
IndicatorCategoryIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                IndicatorCategoryList,
                IndicatorCategoryCreate,
                IndicatorCategoryDetail
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
                 * On edit Indicator Category result
                 * @param {Object} result
                 */
                editIndicatorCategory(result) {

                    if (result.success) {
                        this.$refs.indicatorCategoryList.updateIndicatorCategory(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);

                    } else {
                        alert('Update Indicator Category failed!');
                    }
                },

                /**
                 * New Indicator Category saved event
                 */
                newIndicatorCategory(result) {
                    if (result.success) {
                        this.$refs.indicatorCategoryList.insertNewIndicatorCategory(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show Indicator Category
                 */
                showIndicatorCategory(indicatorCategory) {
                    this.$refs.indicatorCategoryDetail.loadIndicatorCategory(indicatorCategory.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.$refs.indicatorCategoryCreate.clearNewIndicatorCategory(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const indicatorCategoryData = await this.$refs.indicatorCategoryDetail.loadIndicatorCategory(data.id, true);

                    this.showCreateForm(indicatorCategoryData.data);
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
                            Vue.set(this, 'pageTitle', 'دسته بندی شاخص ها');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت دسته بندی شاخص');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش دسته بندی شاخص');
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
IndicatorCategoryIndex.init();
