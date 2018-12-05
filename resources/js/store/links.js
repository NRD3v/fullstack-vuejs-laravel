import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export const links = new Vuex.Store({
    state: {
        links: [],
        linkHighlighted: undefined
    },
    getters: {
        links: state => state.links,
        linkHighlighted: state => state.linkHighlighted
    },
    mutations: {
        setLinksList(state) {
            return window.axios.get('/links').then(response => {
                state.links = !response.data.empty ? response.data : []
            });
        },
        setLinkHighlighted: (state, payload) => state.linkHighlighted = payload

    },
    actions: {
        setLinks: (context) => context.commit('setLinksList'),
        setLinkHighlight: (context, payload) => context.commit('setLinkHighlighted', payload)
    }
});
