<template lang="pug">
    div
        input.hidden(type="file", ref="fileInput", @input="onFileSelected")
        button.btn.btn-primary(@click.prevent="showDialog") +
        ul.files-list
            li(v-for="(file, index) in filesList", :key="file")
                | {{ file }}
                a.btn.btn-danger(@click.prevent="removeFile(file, index)") &times;
</template>

<script>
export default {
    name: "FileUpload",

    props: {
        uploadUrl: {
            type: String,
            default: ""
        }
    },

    data: () => ({
        files: []
    }),

    computed: {
        filesList() {
            return this.files.map(file => {
                if (typeof file == "string") {
                    return file;
                } else {
                    return file.name;
                }
            });
        }
    },

    methods: {
        /**
         * Reset files
         */
        resetFiles(data) {
            Vue.set(this, "files", data || []);
        },

        /**
         * Get all selected files
         */
        getFiles() {
            return this.files;
        },

        /**
         * Upload a file
         */
        uploadFile(index) {
            return new Promise((resolve, reject) => {
                setTimeout(async () => {
                    const file = this.files[index];
                    const formData = new FormData();

                    formData.append("file", file);

                    const res = await axios.post(this.uploadUrl, formData, {
                        headers: { "content-type": "multipart/form-data" }
                    });

                    resolve(res.data);
                }, 100);
            });
        },

        removeFile(file, index) {
            Vue.delete(this.files, index);
        },

        showDialog() {
            this.$refs.fileInput.click();
        },

        onFileSelected(sender) {
            const files = sender.target.files;

            for (let i = 0; i < files.length; ++i) {
                const file = files[i];

                Vue.set(this.files, this.files.length, file);
            }
        }
    }
};
</script>

<style scoped>
.hidden {
    display: none;
}

.files-list {
    list-style: none;
}
</style>
