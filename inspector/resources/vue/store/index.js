import {createStore} from 'vuex'
import axios from "axios";

const BACKEND_URL = `http://${self.location.hostname}:8000`;
const API_URL = `${BACKEND_URL}/api/`;
const AUTH_URL = `${BACKEND_URL}/module/crm-auth/crm-auth.php`;

export default createStore({
    state: {
        appReady: false,
        config: [],
        tests: [],
        isAuth: false,
        site: ''
    },
    getters: {
        isReady: state => {
            return state.appReady;
        },
        getConfig: state => {
            return state.config;
        },
        getTests: state => {
            return state.tests;
        },
        checkAuth: state => {
            return state.isAuth;
        },
        getSite: state => {
            return state.site;
        }
    },
    mutations: {
        SET_READY(state, isReady) {
            state.appReady = isReady;
        },
        FETCH_CONFIG(state, config) {
            state.config = config;
        },
        FETCH_TESTS(state, tests) {
            state.tests = tests;
        },
        AUTH(state, isAuth) {
            state.isAuth = isAuth;
            state.appReady = true;
        },
        SET_SITE(state, site) {
            state.site = site;
        }
    },
    actions: {
        changeReady({commit}, {isReady}) {
            commit("SET_READY", isReady);
        },
        async fetchConfig({commit}) {
            await axios.get(`${API_URL}config/`).then(
                (response) => commit("FETCH_CONFIG", response.data),
                (error) => console.log(error)
            );
        },
        async fetchTests({commit}) {
            await axios.get(`${API_URL}tests/`).then(
                (response) => commit("FETCH_TESTS", response.data),
                (error) => console.log(error)
            );
        },
        async auth({commit}, {key}) {
            await axios.get(`${AUTH_URL}?key=${key}`).then(
                (response) => commit("AUTH", response.data.success),
                (error) => console.log(error)
            );
        },
        logOut({commit}) {
            commit("AUTH", false);
        },
        setSite({commit}, {site}) {
            commit("SET_SITE", site);
        }
    },
    modules: {}
})
