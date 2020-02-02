'use strict';

import IndicatorList from '@components/pages/indicators/list.vue';
import IndicatorCreate from '@components/pages/indicators/create.vue';
import IndicatorDetail from '@components/pages/indicators/detail.vue';

/**
 * indicator Index class
 */
function IndicatorIndex() {}
export default IndicatorIndex;

/**
 * Init function
 */
IndicatorIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                IndicatorList,
                IndicatorCreate,
                IndicatorDetail
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
                    console.log("ggggggg");
                    this.changeFormMode(this.FORM_MODES.LIST);
                },

                /**
                 * On edit indicator result
                 * @param {Object} result
                 */
                editIndicator(result) {

                    if (result.success) {
                        this.$refs.indicatorList.updateIndicator(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);

                    } else {
                        alert('Update indicator failed!');
                    }
                },

                /**
                 * New indicator saved event
                 */
                newIndicator(result) {
                    if (result.success) {
                        this.$refs.indicatorList.insertNewIndicator(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show indicator
                 */
                showIndicator(indicator) {
                    this.$refs.indicatorDetail.loadIndicator(indicator.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {

                    if (null != data) {
                        data = {
                            id: data.id,
                            title: data.title,
                            indicatorCategory: data.indicator_category_id,
                            status: data.status
                        };
                    }

                    this.$refs.indicatorCreate.clearNewIndicator(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const indicatorData = await this.$refs.indicatorDetail.loadIndicator(data.id, true);

                    this.showCreateForm(indicatorData.data);
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
                            Vue.set(this, 'pageTitle', 'شاخص ها');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت شاخص');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش شاخص');
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
IndicatorIndex.init();
