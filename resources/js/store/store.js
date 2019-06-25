import Vuex from "vuex";
import Vue from "vue";
import AuthModule from "./modules/auth"

Vue.use(Vuex);

const store = {
    state : {
        categories: [],
        flash: {
            show: false,
            message: "",
            type: "success"
        },
    },
    modules: {
        auth: AuthModule
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
        ADD_CATEGORIES(state, categories) {
            state.categories = [...state.categories, ...categories ];
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
        storeCategories(store, payload) {
            return new Promise((resolve, reject) => {
                store.commit("ADD_CATEGORIES", payload)
                resolve();
            })
        },
        alert(store, payload) {
            store.commit("SHOW_FLASH", payload);
        },
    },
    getters : {
        categories(state) {
            return state.categories;
        },
        flash(state) {
            return state.flash;
        },
    }
};

export default new Vuex.Store(store);