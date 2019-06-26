import auth from "../../Utilities/Auth";

const AuthModule = {
    state : {
        auth
    },
    namespace: true,
    mutations : {
        LOGIN_AUTH(state, payload) {
            state.auth.login(payload);

        }
    },
    actions : {
        login(store, payload) {
            return new Promise(function(resolve, reject) {
                store.commit("LOGIN_AUTH", payload);
                resolve();
            });
        }
    },
    getters : {
        auth(state) {
            return state.auth
        }
    }
};

export default AuthModule;