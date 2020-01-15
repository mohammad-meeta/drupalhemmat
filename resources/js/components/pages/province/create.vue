<template lang="pug">
form(method='POST', action='/province')
    .form-group
        label(for='my-input') عنوان
        input.form-control(type='text', required='', v-model='newProvince.title')

    .form-group.custom-control.custom-switch
        input#switch1.custom-control-input(type='checkbox', checked,
                            v-model='newProvince.status', :value='1')
        label.custom-control-label(for='switch1') انتشار

    .form-group
        button.btn.btn-primary(type='submit', @click.prevent='saveNewProvince') ذخیره
        button.btn.btn-danger(type='button', @click.prevent='cancelCreateProvince') لغو
</template>

<script>

export default {
    name: "ProvinceCreate",

    data: () => ({
        newProvince: {},
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
        this.clearNewProvince();
    },

    methods: {

        /**
         * Cancel create province
         */
        cancelCreateProvince() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new province data
         */
        saveNewProvince() {
            let newProvince = {
                id: this.newProvince.id,
                title: this.newProvince.title,
                status: this.newProvince.status
            };

            let url = "";
            let method = "";
            let registerType = "";

            if (newProvince.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";

                url = this.updateUrl.replace("_ID_", newProvince.id);
                method = "patch";
            }

            axios[method](url, newProvince)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;

                        if (newProvince.id == null) {
                            this.$emit("on-new-province", newRecord);
                        } else {
                            this.$emit("on-edit-province", newRecord);
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
         * Clear new province
         */
        clearNewProvince(data) {

            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    status: null
                };
            }

            Vue.set(this, "newProvince", data);
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
