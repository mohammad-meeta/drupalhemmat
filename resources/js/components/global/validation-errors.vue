<template lang="pug">
    div(v-if='validationErrors')
        ul.alert.alert-danger
            li(v-for='(value, key, index) in validationErrors') @{{ value }}
</template>

<script>
export default {
    name: "ValidationErrors",

    props:
        ['errors'],

    computed: {
        validationErrors(){
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    }


};
</script>
