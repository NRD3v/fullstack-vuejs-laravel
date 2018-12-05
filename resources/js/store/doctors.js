import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export const doctors = new Vuex.Store({
    state: {
        doctors: []
    },
    getters: {
        doctors: state => state.doctors
    },
    mutations: {
        setDoctorsList(state, payload) {
            return window.axios.post('/search', payload).then(response => {
                state.doctors = !response.data.empty ? response.data : []
            });
        }
    },
    actions: {
        setDoctors: (context, payload) => context.commit('setDoctorsList', payload)
    }
});
