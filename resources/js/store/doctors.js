import ApiService from "../services/ApiService";
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
            ApiService.search(payload).then((response) => {
                state.doctors = !response.empty ? response : [];
            });
        }
    },
    actions: {
        setDoctors: (context, payload) => context.commit('setDoctorsList', payload)
    }
});
