import Vuex from "vuex";
import Vue from "vue";
import auth from "../Utilities/Auth";

Vue.use(Vuex);

const store = {
    state : {
        categories: [],
        flash: {
            show: false,
            message: "",
            type: "success"
        },
        auth
    },
    mutations : {
        FETCH_CATEGORIES(state, categories) {
            state.categories = [...state.categories, ...categories ];
        },
        SHOW_FLASH(state,payload) {
            let {message, type = "success"} = payload;

            state.flash = { message, type, show: true };

            setTimeout(() => {
                state.flash.show = false;
            }, 3000)
        },
        LOGIN_AUTH(state, payload) {
            state.auth.login(payload);
        }
    },
    actions : {
        fetchCategories(store) {
            axios.get("/api/categories")
                .then(({data : categories}) => {
                    store.commit("FETCH_CATEGORIES", categories.data);
                })
                .catch(error => console.log(error));
        },
        alert(store, payload) {
            store.commit("SHOW_FLASH", payload);
        },
        login(store, payload) {
            return new Promise(function(resolve, reject) {
                store.commit("LOGIN_AUTH", payload);
                resolve();
            });
        }
    },
    getters : {
        categories(state) {
            return state.categories;
        },
        flash(state) {
            return state.flash;
        },
        auth(state) {
            return state.auth
        }
    }
};

export default new Vuex.Store(store);