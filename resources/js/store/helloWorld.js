import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export const helloWorld = new Vuex.Store({
    state: {
        message: 'Hello world'
    },
    getters: {
        message: state => state.message
    },
    mutations: {
        setMessage: (state, payload) => state.message = payload
    }
});
