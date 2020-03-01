<template lang="pug">
div
    h2(v-if='! hasRecord') اطلاعاتی وجود ندارد

    table.pp-striped-table(v-if='hasRecord')
        thead
            tr
                th عنوان
                th عملکردها
        tbody
            tr(v-for='department in departments', :key='department.id')
                td {{ department.title }}
                td
                    a.btn.btn-primary(href='#', @click.prevent='showDepartment(department)') مشاهده
                    a.btn.btn-primary(href='#', @click.prevent='showEditForm(department)') ویرایش
</template>

<script>
export default {
    name: "DepartmentList",

    data: () => ({
        departments: []
    }),

    props: {
        url: {
            type: String,
            default: ""
        }
    },

    computed: {
        /**
         * Check for records exists
         */
        hasRecord() {
            return (this.departments || []).length;
        }
    },

    /**
     * Load departments
     */
    created() {
        this.loadDepartment();
    },

    methods: {
        /**
         * Load departments
         */
        loadDepartment() {
            axios.get(this.url).then(res => {
                const data = res.data;

                Vue.set(this, "departments", data.data || []);
            });
        },

        /**
         * Show departments content
         */
        showDepartment(department) {
            this.$emit('on-show-department', department);
        },

        /**
         * Edit an provi\nces
         */
        showEditForm(department) {

            this.$emit('on-edit-department', department);
        },

        /**
         * Insert new department
         */
        insertNewDepartment(department) {
            Vue.set(this.departments, this.departments.length, department);
        },

        /**
         * Update an departments
         */
        updateDepartment(department) {
            let index = this.departments.findIndex(item => item.id == department.id);

            if (index > -1) {
                Vue.set(this.departments, index, department);
            }
        }
    }
};
</script>

<style scoped>
</style>
