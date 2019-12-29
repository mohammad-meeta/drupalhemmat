<template lang="pug">
form(method='POST', action='/article')
    .form-group
        label(for='my-input') عنوان
        input.form-control(type='text', required='', v-model='newArticle.title')

    .form-group
        label(for='articleType') نوع مطلب
        select.form-control(required='', v-model='newArticle.articleType' )
            option(v-for='articleType in articleTypes', :key='articleType.id', :value='articleType.id')
                | {{ articleType.title }}
    .form-group
        label(for='editor') توضیحات
        <textarea class="form-control" id="editor" name="editor" ref='editor' v-model="newArticle.title"></textarea>
    .form-group
        label(for="fileUpload") پیوست فایل
        file-upload(ref="fileUpload", :upload-url="articleUploadUrl")

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

export default {
    name: "ArticleCreate",

    components: {
        FileUpload
    },

    data: () => ({
        newArticle: {},
        articleTypes: [],
        attachments: [],
        percentCompleted: 0,
        data: {},
        articleUploadUrl: ""
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
        }
    },

    created() {
        this.init();
    },

    mounted() {
        this.clearNewArticle();
    },

    methods: {
        /**
         * Cancel create article
         */
        cancelCreateArticle() {
            this.$emit("on-cancel-create");
        },

        /**
         * Get the selected type data
         */
        selectedArticle(articleType) {
            let result = {
                id: articleType,
                title: ""
            };

            result.title = this.articleTypes.find(
                x => x.id == articleType
            ).title;

            return result;
        },

        /**
         * Save new article data
         */
        saveNewArticle() {
            let newArticle = {
                id: this.newArticle.id,
                title: this.newArticle.title,
                body: CKEDITOR.instances.editor.getData(),
                type: this.newArticle.articleType,
                status: this.newArticle.status
            };

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
                    console.log(err);
                });
        },

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

                try {
                    const res = await fileUpload.uploadFile(i);
                } catch (err) {
                    console.log(err);
                }
            }
        },

        /**
         * Clear new articles
         */
        clearNewArticle(data) {
            this.$refs.fileUpload.resetFiles();

            if (null == data) {
                data = {
                    id: null,
                    title: null,
                    body: null,
                    articleType: null,
                    status: null
                };
            }
            if (data.articleType == null && this.articleTypes.length > 0) {
                // this.$refs.uploadFile.resetFiles();
                data.articleType = this.articleTypes[0].id;
            }

            Vue.set(this, "newArticle", data);
        },

        /**
         * Load articles types
         */
        loadArticleTypes() {
            axios
                .get(this.articleTypesUrl)
                .then(res => {
                    const data = res.data;

                    Vue.set(this, "articleTypes", data);
                })
                .catch(err => console.error(err));
        },

        /**
         * Initialization
         */
        init() {
            this.loadArticleTypes();
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
