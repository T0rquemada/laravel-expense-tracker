import { createStore } from 'vuex';
import { request } from './functions.js';

const store = createStore({
    state() {
        return {
            isAuth: false
        };
    },
    mutations: {
        setAuth(state, isAuth) {
            state.isAuth = isAuth;
        },
    },
    actions: {
        login({ commit }) {
            commit('setAuth', true);
        },
        logout({ commit }) {
            commit('setAuth', false);
        },
        async tryAutoLogin({ commit }) {
            try {
                const csrf = document.head.querySelector('meta[name="csrf-token"]').content;

                let response = await request('GET', '/auto-login', csrf);
                commit('setAuth', response.status);
                console.log(response.message);
            } catch (err) {
                console.error('Failed to fetch user:', err);
                commit('setAuth', false);
                console.error('Error while fetching user!');
            }
        }
    },
});

export default store;
