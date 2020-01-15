<template lang="pug">
form(method='POST', action='/indicator-category')
    .form-group
        label(for='my-input') عنوان
        input.form-control(type='text', required='', v-model='newIndicatorCategory.title')

    .form-group.custom-control.custom-switch
        input#switch1.custom-control-input(type='checkbox', checked,
                            v-model='newIndicatorCategory.status', :value='1')
        label.custom-control-label(for='switch1') انتشار

    .form-group
        button.btn.btn-primary(type='submit', @click.prevent='saveNewIndicatorCategory') ذخیره
        button.btn.btn-danger(type='button', @click.prevent='cancelCreateIndicatorCategory') لغو
</template>

<script>

export default {
    name: "IndicatorCategoryCreate",

    data: () => ({
        newIndicatorCategory: {},
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
        }
    },

    created() {
        this.init();
    },

    mounted() {
        this.clearNewIndicatorCategory();
    },

    methods: {

        /**
         * Cancel create indicator category
         */
        cancelCreateIndicatorCategory() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new indicator category data
         */
        saveNewIndicatorCategory() {
            let newIndicatorCategory = {
                id: this.newIndicatorCategory.id,
                title: this.newIndicatorCategory.title,
                status: this.newIndicatorCategory.status
            };

            let url = "";
            let method = "";
            let registerType = "";

            if (newIndicatorCategory.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";

                url = this.updateUrl.replace("_ID_", newIndicatorCategory.id);
                method = "patch";
            }

            axios[method](url, newIndicatorCategory)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;

                        if (newIndicatorCategory.id == null) {
                            this.$emit("on-new-indicator-category", newRecord);
                        } else {
                            this.$emit("on-edit-indicator-category", newRecord);
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
        clearNewIndicatorCategory(data) {

            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    status: null
                };
            }

            Vue.set(this, "newIndicatorCategory", data);
        },

        /**
         * Initialization
         */
        init() {

        }
    }
};

</script>


<style scoped>
</style>
