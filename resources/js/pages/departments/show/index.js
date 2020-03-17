'use strict';

import DepartmentDetail from '@components/pages/department/detail.vue';

/**
 * department Show class
 */
function DepartmentShow() {}
export default DepartmentShow;

/**
 * Init function
 */
DepartmentShow.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                DepartmentDetail
            },

            data: {
                isLoading: true,
                pageTitle: '',
            },

            mounted() {

                const depDetail = this.$refs.departmentDetail;
                const el = depDetail.$el;
                const id = el.attributes['data-dep-id'].value;

                depDetail.loadDepartment(id);
            },

            methods: {
                showLoading() {
                    Vue.set(this, 'isLoading', true);
                },

                hideLoading() {
                    Vue.set(this, 'isLoading', false);
                }
            }
        });
}

DepartmentShow.init();
