<template lang="pug">
form(method='POST', action='/indicator')
    .form-group
        label(for='title') عنوان
        input.form-control(type='text', required='', v-model='newIndicator.title')

    .form-group
        label(for='indicatorCategory') دسته بندی شاخص
        select.form-control(required='', v-model='newIndicator.indicatorCategory' )
            option(v-for='indicatorCategory in indicatorCategories', :key='indicatorCategory.id', :value='indicatorCategory.id')
                | {{ indicatorCategory.title }}


    .form-group.custom-control.custom-switch
        input#switch1.custom-control-input(type='checkbox', checked,
                            v-model='newIndicator.status', :value='1')
        label.custom-control-label(for='switch1') انتشار

    .form-group
        button.btn.btn-primary(type='submit', @click.prevent='saveNewIndicator') ذخیره
        button.btn.btn-danger(type='button', @click.prevent='cancelCreateIndicator') لغو
</template>

<script>

export default {
    name: "IndicatorCreate",

    data: () => ({
        newIndicator: {},
        indicatorCategories: [],
        data: {}
    }),

    props: {
        showUrl: {
            type: String,
            default: ""
        },

        storeUrl: {
            type: String,
            default: ""
        },

        updateUrl: {
            type: String,
            default: ""
        },

        indicatorCategoriesUrl: {
            type: String,
            default: ""
        }
    },

    created() {
        this.init();
    },

    mounted() {
        this.clearNewIndicator();
    },

    methods: {

        /**
         * Cancel create indicator
         */
        cancelCreateIndicator() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new indicator data
         */
        saveNewIndicator() {
            let newIndicator = {
                id: this.newIndicator.id,
                title: this.newIndicator.title,
                indicatorCategory: this.newIndicator.indicatorCategory,
                status: this.newIndicator.status
            };

            let url = "";
            let method = "";
            let registerType = "";

            if (newIndicator.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";

                url = this.updateUrl.replace("_ID_", newIndicator.id);
                method = "patch";
            }

            axios[method](url, newIndicator)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;

                        if (newIndicator.id == null) {
                            this.$emit("on-new-indicator", newRecord);
                        } else {
                            this.$emit("on-edit-indicator", newRecord);
                        }
                    } else {
                        alert(`${registerType} failed!`);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Clear new indicator
         */
        clearNewIndicator(data) {
            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    indicatorCategory: null,
                    status: null
                };
            }

            if (data.indicatorCategory == null && this.indicatorCategories.length > 0) {
                // this.$refs.uploadFile.resetFiles();
                data.indicatorCategory = this.indicatorCategories[0].id;
            }

            Vue.set(this, "newIndicator", data);
        },

        /**
        * Load indicator categories
        */
        loadIndicatorCategories() {
            console.log(this.indicatorCategoriesUrl);
            axios
                .get(this.indicatorCategoriesUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "indicatorCategories", data.data);
                })
                .catch(err => console.error(err));
        },

        /**
         * Initialization
         */
        init() {
            this.loadIndicatorCategories();
        }
    }
};

</script>


<style scoped>
</style>
