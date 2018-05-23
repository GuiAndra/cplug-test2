<template>
    <div>
        <div class="row m-5">
            <div class="col">
                <h4 class="text-center">Adicionar Tag</h4>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="form.titulo" placeholder="Tag" />
                </div>
                <button class="btn btn-success float-right" @click="addTag">Adicionar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CreateTag',

        data () {
            return {
                form: {
                    titulo: ''
                }
            }
        },
        
        methods: {
            addTag () {
                this.$store.dispatch('addTag', this.form)
                this.$emit('closeTag')
            }
        }
    }
</script>

<style>
    h4{
        color: white;
    }
</style>

