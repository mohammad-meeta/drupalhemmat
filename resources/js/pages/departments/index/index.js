'use strict';

import DepartmentList from '@components/pages/department/list.vue';
import DepartmentCreate from '@components/pages/department/create.vue';
import DepartmentDetail from '@components/pages/department/detail.vue';

/**
 * department Index class
 */
function DepartmentIndex() {}
export default DepartmentIndex;

/**
 * Init function
 */
DepartmentIndex.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                DepartmentList,
                DepartmentCreate,
                DepartmentDetail
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
                 * On edit department result
                 * @param {Object} result
                 */
                editDepartment(result) {

                    if (result.success) {
                        this.$refs.departmentList.updateDepartment(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);

                    } else {
                        alert('Update department failed!');
                    }
                },

                /**
                 * New department saved event
                 */
                newDepartment(result) {
                    if (result.success) {
                        this.$refs.departmentList.insertNewDepartment(result.data);
                        this.changeFormMode(this.FORM_MODES.LIST);
                    } else {
                        alert('Register new record failed!');
                    }
                },

                /**
                 * Show department
                 */
                showDepartment(department) {
                    this.$refs.departmentDetail.loadDepartment(department.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                /**
                 * Show the create form
                 */
                showCreateForm(data) {
                    this.$refs.departmentCreate.clearNewDepartment(data);
                    this.changeFormMode(this.FORM_MODES.CREATE);
                },

                /**
                 * Show the edit form
                 */
                async showEditForm(data) {
                    const departmentData = await this.$refs.departmentDetail.loadDepartment(data.id, true);

                    this.showCreateForm(departmentData.data);
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
                            Vue.set(this, 'pageTitle', 'قسمت ها');
                            break;

                        case this.FORM_MODES.CREATE:
                            Vue.set(this, 'pageTitle', 'ثبت قسمت');
                            break;

                        case this.FORM_MODES.EDIT:
                            Vue.set(this, 'pageTitle', 'ویرایش قسمت');
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
DepartmentIndex.init();
