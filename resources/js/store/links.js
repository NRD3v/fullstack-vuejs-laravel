import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export const links = new Vuex.Store({
    state: {
        list: []
    },
    getters: {
        list: state => state.list
    },
    mutations: {
        setList: (state, payload) => state.list = payload
    }
});
