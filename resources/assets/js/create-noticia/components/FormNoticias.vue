<template>
    <div>
        <div class="row mt-2">
            <div class="col"></div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" v-model="form.titulo" placeholder="Título">
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" class="form-control" v-model="form.descricao" placeholder="Descrição">
                </div>
                <div class="form-group">
                    <label>Categoria <button :class="addCategoria ? 'btn btn-outline-danger' : 'btn btn-outline-success'" @click="addCategoria = !addCategoria">{{ addCategoria ? 'x' : '+' }}</button></label>
                    <transition name="slide-fade">
                        <div class="container-add" v-if="addCategoria" style="z-index: 9999;">
                            <div class="add">
                                <CreateCategoria @closeCategoria="addCategoria = false"/>
                            </div>
                        </div>
                    </transition>
                    <select class="form-control" v-model="form.categoria_id">
                        <option value=""></option>
                        <option v-for="categoria in this.$store.state.categorias" :key="categoria.id" :value="categoria.id">{{ categoria.titulo }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags <button :class="addTag ? 'btn btn-outline-danger' : 'btn btn-outline-success'" @click="addTag = !addTag">{{ addTag ? 'x' : '+' }}</button></label>
                    <transition name="slide-fade">
                        <div class="container-add" v-if="addTag">
                            <div class="add">
                                <CreateTag  @closeTag="addTag = false" />
                            </div>
                        </div>
                    </transition>
                    <select multiple class="form-control" v-model="form.tags">
                        <option value=""></option>
                        <option v-for="tag in this.$store.state.tags" :key="tag.id" :value="tag.id">{{ tag.titulo }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Imagens</label>
                    <input type="file" multiple @change="onFileChange">
                </div>
                <button class="btn btn-success float-right" @click="addNoticia">Adicionar</button>
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
    import CreateCategoria from './CreateCategoria';
    import CreateTag from './CreateTag';

    export default {
        name: 'FormNoticias',

        components: {
            'CreateCategoria': CreateCategoria,
            'CreateTag': CreateTag,
        },

        data () {
            return {
                form: {
                    titulo: '',
                    descricao: '',
                    categoria_id: '',
                    tags: [],
                    imagens: []
                },
                addCategoria: false,
                addTag: false
            }
        },

        methods: {
            addNoticia () {
                if(this.form.titulo == '' || this.form.descricao == '' || this.form.categoria_id == ''){
                    alert('Preencha corretamente os campos')
                    return
                }
                axios.post('/noticias', this.form)
                .then(function (response) {
                    if(response.data.created === 'success'){
                        window.location = '/noticias'
                    }
                })
                .catch(err => console.log(err))
            },
            onFileChange(e) {
                this.form.imagens = []
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length){
                    return;
                }
                for (let i = 0; i < files.length; i++) {
                    this.createImage(files[i]);
                }
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    console.log('entrei')
                    vm.form.imagens.push(e.target.result);
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>

<style lang="scss">
    .container-add{
        position: relative;
        
        .add{
            box-shadow: 1px 1px 1px 5px rgba(0,0,0,0.3);
            background-color: rgba(0,0,0,0.5);
            position: absolute;
            width: 30em;
            height: 15em;
            top: 0;
        }
    }

    .slide-fade-enter-active {
	  	transition: all .3s ease;
	}
	.slide-fade-leave-active {
	  	transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
	}
	.slide-fade-enter, .slide-fade-leave-to{
		transform: translateX(10px);
		opacity: 0;
	}
</style>

