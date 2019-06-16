import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const store = {
    state : {
        categories: []
    },
    mutations : {
        FETCH_CATEGORIES(state, categories) {
            state.categories = [...state.categories, ...categories ];
        },
    },
    actions : {
        fetchCategories(store) {
            axios.get("/api/categories")
                .then(({data : categories}) => {
                    store.commit("FETCH_CATEGORIES", categories.data);
                })
                .catch(error => console.log(error));
        }
    },
    getters : {
        categories(state) {
            return state.categories;
        }
    }

};



export default new Vuex.Store(store);