'use strict';

import IndicatorMonitoringIndicators from '@components/pages/monitorings/monitoring-indicators.vue';
import IndicatorDetail from '@components/pages/indicators/detail.vue';

/**
 * Indicator Class
 */
function IndicatorPage() {}
export default IndicatorPage;

/**
 * Init function
 */
IndicatorPage.init = function init() {
    window.v =
        new Vue({
            el: '#app',

            components: {
                IndicatorMonitoringIndicators,
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

                formMode: null,
                pageTitle: 'عنوان',
                isLoading: true
            },

            computed: {
               // isListMode: (state) => ! state.isLoading,
                isListMode: state => state.formMode == state.FORM_MODES.LIST,

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

                hideLoading() {
                    Vue.set(this, 'isLoading', false);
                },

                /**
                 * Show indicator
                 */
                showIndicator(indicator) {
                    this.$refs.indicatorDetail.loadIndicator(indicator.id);
                    this.changeFormMode(this.FORM_MODES.DETAIL);
                },

                changeFormMode(mode) {
                    switch (mode) {
                        case this.FORM_MODES.LIST:
                            Vue.set(this, 'pageTitle', 'شاخص دیدبانی');
                            break;

                        case this.FORM_MODES.DETAIL:
                            Vue.set(this, 'pageTitle', 'شاخص دیده بانی');
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
}

// Main loop
IndicatorPage.init();
