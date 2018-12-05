import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export const links = new Vuex.Store({
    state: {
        links: []
    },
    getters: {
        links: state => state.links
    },
    mutations: {
        setLinksList(state) {
            return window.axios.get('/links').then(response => {
                state.links = !response.data.empty ? response.data : []
            });
        }
    },
    actions: {
        setLinks: (context) => context.commit('setLinksList')
    }
});
