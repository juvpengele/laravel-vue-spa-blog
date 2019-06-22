import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const store = {
    state : {
        categories: [],
        flash: {
            show: false,
            message: "",
            type: "success"
        }
    },
    mutations : {
        FETCH_CATEGORIES(state, categories) {
            state.categories = [...state.categories, ...categories ];
        },
        SHOW_FLASH(state, message, type = "success") {
            state.flash = { message, type, show: true };

            setTimeout(() => {
                state.flash.show = false;
            }, 3000)
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
        alert(store, message, type = "success") {
            store.commit("SHOW_FLASH", message, type);
        }
    },
    getters : {
        categories(state) {
            return state.categories;
        },
        flash(state) {
            return state.flash;
        }
    }
};

export default new Vuex.Store(store);