import Vuex from "vuex";
import Vue from "vue";
import AuthModule from "./modules/auth"
import CategoriesModule from "./modules/categories"

Vue.use(Vuex);

const store = {
    state : {
        flash: {
            show: false,
            message: "",
            type: "success"
        },
    },
    modules: {
        auth: AuthModule,
        categories: CategoriesModule
    },
    mutations : {
        SHOW_FLASH(state,payload) {
            let {message, type = "success"} = payload;

            state.flash = { message, type, show: true };

            setTimeout(() => {
                state.flash.show = false;
            }, 3000)
        },
    },
    actions : {
        alert(store, payload) {
            return new Promise(function (resolve, reject) {
                store.commit("SHOW_FLASH", payload);
                resolve();
            })
        },
    },
    getters : {
        flash(state) {
            return state.flash;
        },
    }
};

export default new Vuex.Store(store);