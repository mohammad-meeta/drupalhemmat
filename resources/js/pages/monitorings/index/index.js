'use strict';

import MonitoringList from '@components/pages/monitorings/list.vue';
import MonitoringCreate from '@components/pages/monitorings/create.vue';
import MonitoringDetail from '@components/pages/monitorings/detail.vue';

/**
 * monitoring Index class
 */
function MonitoringIndex() {}
export default MonitoringIndex;

/**
 * Init function
 */
MonitoringIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                MonitoringList,
                MonitoringCreate,
                MonitoringDetail
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
                 * On edit monitoring result
                 * @param {Object} result
                 */
                editMonitoring(result) {

                    if (result.success) {
                        this.$refs.monitoringList.updateMonitoring(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);

                    } else {
                        alert('Update monitoring failed!');
                    }
                },

                /**
                 * New monitoring saved event
                 */
                newMonitoring(result) {
                    if (result.success) {
                        this.$refs.monitoringList.insertNewMonitoring(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show monitoring
                 */
                showMonitoring(monitoring) {
                    this.$refs.monitoringDetail.loadMonitoring(monitoring.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {

                    if (null != data) {
                        data = {
                            id: data.id,
                            indicator: data.indicator_id,
                            province: data.province_id,
                            year: data.year,
                            amount: data.amount,
                            status: data.status
                        };
                    }
                    this.$refs.monitoringCreate.clearNewMonitoring(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const monitoringData = await this.$refs.monitoringDetail.loadMonitoring(data.id, true);

                    this.showCreateForm(monitoringData.data);
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
                            Vue.set(this, 'pageTitle', 'دیده بانی سلامت');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت دیده بانی سلامت');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش دیده بانی سلامت');
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
MonitoringIndex.init();
