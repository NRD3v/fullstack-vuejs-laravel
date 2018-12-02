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
            if (payload) {
                window.axios.post('/search', payload).then(response => {
                    state.doctors = response.data
                });
            } else {
                state.doctors = []
            }
        }
    },
    actions: {
        setDoctors: (context, payload) => context.commit('setDoctorsList', payload)
    }
});
