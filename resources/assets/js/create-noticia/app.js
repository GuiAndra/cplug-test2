window.Vue = require('vue');

import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        categorias: [],
        tags: []
    },
    mutations: {
        FETCHCATEGORIAS(state, data) {
            state.categorias = data
        },
        FETCHTAGS(state, data) {
            state.tags = data
        }
    },
    actions: {
        fetchCategorias({ commit }) {
            return axios.get('/categorias')
                .then(response => commit('FETCHCATEGORIAS', response.data))
                .catch();
        },
        fetchTags({ commit }) {
            return axios.get('/tags')
                .then(response => commit('FETCHTAGS', response.data))
                .catch();
        },
        addCategoria({ dispatch }, payload) {
            return axios.post('/categorias', payload)
                .then(response => dispatch('fetchCategorias'))
                .catch();
        },
        addTag({ dispatch }, payload) {
            return axios.post('/tags', payload)
                .then(response => dispatch('fetchTags'))
                .catch();
        }
    }
});

Vue.component('Container', require('./components/Container'));

new Vue({
    el: '#root',
    store
});