<template>
    <div>
        <FormNoticias />
    </div>
</template>

<script>
    import FormNoticias from './FormNoticias';

    export default {
        name: 'Container',

        components: {
            'FormNoticias': FormNoticias
        },

        mounted () {
            this.$store.dispatch('fetchCategorias')
            this.$store.dispatch('fetchTags')
        }
    }
</script>

<style>

</style>

