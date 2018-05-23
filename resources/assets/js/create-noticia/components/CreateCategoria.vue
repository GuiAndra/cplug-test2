<template>
    <div>
        <div class="row m-5">
            <div class="col">
                <h4 class="text-center">Adicionar Categoria</h4>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="form.titulo" placeholder="Categoria" />
                </div>
                <button class="btn btn-success float-right" @click="addCategoria">Adicionar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CreateCategoria',
        
        data () {
            return {
                form: {
                    titulo: ''
                }
            }
        },

        methods: {
            addCategoria () {
                this.$store.dispatch('addCategoria', this.form)
                this.$emit('closeCategoria')
            }
        }
    }
</script>

<style>
    h4{
        color: white;
    }
</style>

