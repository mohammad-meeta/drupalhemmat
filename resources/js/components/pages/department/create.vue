<template lang="pug">
form(method='POST', action='/department')
    .form-group
        label(for='my-input') عنوان
        input.form-control(type='text', required='', v-model='newDepartment.title')

    .form-group.custom-control.custom-switch
        input#switch1.custom-control-input(type='checkbox', checked,
                            v-model='newDepartment.status', :value='1')
        label.custom-control-label(for='switch1') انتشار

    .form-group
        button.btn.btn-primary(type='submit', @click.prevent='saveNewDepartment') ذخیره
        button.btn.btn-danger(type='button', @click.prevent='cancelCreateDepartment') لغو
</template>

<script>

export default {
    name: "DepartmentCreate",

    data: () => ({
        newDepartment: {},
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
        this.clearNewDepartment();
    },

    methods: {

        /**
         * Cancel create department
         */
        cancelCreateDepartment() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new department data
         */
        saveNewDepartment() {
            let newDepartment = {
                id: this.newDepartment.id,
                title: this.newDepartment.title,
                status: this.newDepartment.status
            };

            let url = "";
            let method = "";
            let registerType = "";

            if (newDepartment.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";

                url = this.updateUrl.replace("_ID_", newDepartment.id);
                method = "patch";
            }

            axios[method](url, newDepartment)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;

                        if (newDepartment.id == null) {
                            this.$emit("on-new-department", newRecord);
                        } else {
                            this.$emit("on-edit-department", newRecord);
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
         * Clear new department
         */
        clearNewDepartment(data) {

            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    status: null
                };
            }

            Vue.set(this, "newDepartment", data);
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
