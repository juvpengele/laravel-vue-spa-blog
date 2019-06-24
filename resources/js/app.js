import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes/routes";
import store from "./store/store";
require('./bootstrap');

Vue.use(VueRouter);

Vue.component('App', require('./App').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter({ routes, mode: "history" }),
    store
});
