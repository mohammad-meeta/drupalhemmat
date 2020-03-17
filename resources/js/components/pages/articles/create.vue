<template lang="pug">
div
    validation-errors(:errors='validationErrors', v-if='validationErrors')

    form(method='POST', action='/article')

        .form-group
            label(for='my-input') عنوان
            input.form-control(type='text', required='', v-model='newArticle.title')

        .form-group
            label(for='articleType') نوع مطلب
            select.form-control(required='', v-model='newArticle.articleType', @change="onChangeFormType($event)", name='articleType' )
                option(v-for='articleType in articleTypes', :key='articleType.id', :value='articleType.id')
                    | {{ articleType.title }}

        .form-group(v-if='isDocumentType')
            label(for='documentCategory') دسته بندی اسناد
            select.form-control(v-model='newArticle.documentCategory')
                option.disabled-opt(value='-1', selected='') --دسته بندی مورد نظر را انتخاب کنید--
                option(v-for='documentCategory in documentCategories', :key='documentCategory.id', :value='documentCategory.id')
                    | {{ documentCategory.title }}

        .form-group(v-if='isIntroductionType')
            label(for='department') قسمت
            select.form-control(v-model='newArticle.department')
                option.disabled-opt(value='-1', selected='') --قسمت مورد نظر را انتخاب کنید--
                option(v-for='department in departments', :key='department.id', :value='department.id')
                    | {{ department.title }}

        .form-group
            label(for='editor') توضیحات
            <textarea class="form-control" id="editor" name="editor" ref='editor' v-model="newArticle.title"></textarea>
        .form-group
            label(for="fileUpload") پیوست فایل
            file-upload(ref="fileUpload", :upload-url="articleUploadUrl", @on-file-remove="articleFileRemove")

        .form-group.custom-control.custom-switch
            input#switch1.custom-control-input(type='checkbox', checked,
                                v-model='newArticle.status', :value='1')
            label.custom-control-label(for='switch1') انتشار

        .form-group
            button.btn.btn-primary(type='submit', @click.prevent='saveNewArticle') ذخیره
            button.btn.btn-danger(type='button', @click.prevent='cancelCreateArticle') لغو
</template>

<script>
import FileUpload from "@components/global/file-upload.vue";
import ValidationErrors from '@components/global/validation-errors.vue';

export default {
    name: "ArticleCreate",

    components: {
        FileUpload,
        ValidationErrors
    },

    data: () => ({
        FORM_TYPES: {
            DOCUMENT: 1,
            EVENTS: 2,
            INTRODUCTION: 3
        },
        formType: null,
        newArticle: {},
        articleTypes: [],
        documentCategories: [],
        departments: [],
        attachments: [],
        percentCompleted: 0,
        data: {},
        articleUploadUrl: "",
        validationErrors: ''
    }),

    props: {
        showUrl: {
            type: String,
            default: ""
        },

        uploadUrl: {
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

        articleTypesUrl: {
            type: String,
            default: ""
        },

        documentCategoriesUrl: {
            type: String,
            default: ""
        },

        departmentsUrl: {
            type: String,
            default: ""
        }
    },

    computed: {
        isIntroductionType: state => state.formType == state.FORM_TYPES.INTRODUCTION,

        isEventsType: state => state.formType == state.FORM_TYPES.EVENTS,

        isDocumentType: state => state.formType == state.FORM_TYPES.DOCUMENT,

    },

    created() {
        if(this.formType == null) {
            Vue.set(this, 'formType', 1);
        }
        this.init();
    },

    mounted() {
        this.clearNewArticle();
    },

    methods: {
        /**
         * Remove file
         */
        articleFileRemove(payload) {
            const file = payload.file;

            if (file.id){
                Vue.set(this.newArticle.deletedFiles, this.newArticle.deletedFiles.length, file.id);
            }
        },

        /**
         * Cancel create article
         */
        cancelCreateArticle() {
            this.$emit("on-cancel-create");
        },

        /**
         * Save new article data
         */
        saveNewArticle() {
            if (this.newArticle.documentCategory == -1) {
                this.newArticle.documentCategory = null;
            }
            if (this.newArticle.department == -1) {
                this.newArticle.department = null;
            }
            let newArticle = {
                id: this.newArticle.id,
                title: this.newArticle.title,
                body: CKEDITOR.instances.editor.getData(),
                type: this.newArticle.articleType,
                documentCategory: this.newArticle.documentCategory,
                department: this.newArticle.department,
                status: this.newArticle.status,
                deletedFiles: this.newArticle.deletedFiles
            };
            console.log(this.newArticle.documentCategory);

            let url = "";
            let method = "";
            let registerType = "";

            if (newArticle.id == null) {
                registerType = "Registration";
                url = this.storeUrl;
                method = "post";
            } else {
                registerType = "Update";
                url = this.updateUrl.replace("_ID_", newArticle.id);
                method = "patch";
            }

            axios[method](url, newArticle)
                .then(async res => {
                    const data = res.data;

                    if (data.success) {
                        await this.uploadFiles(data);

                        // Get new data from server
                        url = this.showUrl.replace("_ID_", data.data.id);
                        let newRecord = await axios.get(url);
                        newRecord = newRecord.data;
                        if (newArticle.id == null) {
                            this.$emit("on-new-article", newRecord);
                        } else {
                            this.$emit("on-edit-article", newRecord);
                        }
                    } else {
                        alert(`${registerType} failed!`);
                    }
                })
                .catch(err => {
                    if (err.response.status == 422){
                        this.validationErrors = err.response.data.errors;
                    }
                    console.log(err);
                });
        },

        /**
         * Upload files
         */
        async uploadFiles(data) {
            data = data.data;
            const id = data.id;
            const fileUpload = this.$refs.fileUpload;

            Vue.set(
                this,
                "articleUploadUrl",
                this.uploadUrl.replace("_ID_", id)
            );

            const files = fileUpload.getFiles();

            for (let i = 0; i < files.length; ++i) {
                const file = files[i];

                if ((file.size || 0) > 0) {
                    try {
                        const res = await fileUpload.uploadFile(i);
                    } catch (err) {
                        console.log(err);
                    }
                }
            }
        },

        /**
         * Clear new articles
         */
        clearNewArticle(data) {
            this.$refs.fileUpload.resetFiles((data || {}).files || []);

            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    body: null,
                    articleType: null,
                    documentCategory: -1,
                    department: -1,
                    status: null
                };
            }
            data.deletedFiles = [];

            if (data.articleType == null && this.articleTypes.length > 0) {
                data.articleType = this.articleTypes[0].id;
            }

            if (data.documentCategory == null && this.documentCategories.length > 0) {
                //data.documentCategory = this.documentCategories[0].id;
            }

           /* if (data.department == null && this.department.length > 0) {
                //data.documentCategory = this.documentCategories[0].id;
            }*/

            Vue.set(this, 'formType', data.articleType);
            Vue.set(this, "newArticle", data);
        },

        /**
         * Load articles types
         */
        loadArticleTypes() {
            console.log(this.articleTypesUrl);
            axios
                .get(this.articleTypesUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "articleTypes", data);
                })
                .catch(err => console.error(err));
        },

        /**
         * Load document categories
         */
        loadDocumentCategories() {
            console.log(this.documentCategoriesUrl);
            axios
                .get(this.documentCategoriesUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "documentCategories", data);
                })
                .catch(err => console.error(err));
        },

        /**
         * Load department
         */
        loadDepartments() {
            console.log(this.departmentsUrl);
            axios
                .get(this.departmentsUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "departments", data);
                })
                .catch(err => console.error(err));
        },

        onChangeFormType(event) {
            Vue.set(this, 'formType', event.target.value);
        },

        /**
         * Initialization
         */
        init() {
            this.loadArticleTypes();
            this.loadDocumentCategories();
            this.loadDepartments();
        }
    }
};

$(document).ready(() => {
    CKEDITOR.replace("editor", {
        contentsLangDirection: "rtl",
        filebrowserUploadUrl:
            "/ckeditor/upload?_token=" +
            document.querySelector('meta[name="csrf-token"]').content,
        filebrowserUploadMethod: "form"
    });
});
</script>


<style scoped>
</style>
