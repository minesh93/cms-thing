import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    mutations: {
        set_initial_state(state, initialState) {
            for (const key in initialState) {
                if (initialState.hasOwnProperty(key)) {
                    state[key] = initialState[key];
                }
            }
        }
    }
});