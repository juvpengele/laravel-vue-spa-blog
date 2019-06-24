<template>
    <div class="row h-100 ">
        <div class="col-sm-8 col-md-2 mx-auto my-auto">
            <form class="form-signin " @submit.prevent="login">
                <p class="text-center">
                    Access reserved to the admin
                </p>
                <h1 class="h3 mb-3 font-weight-normal text-center">
                    Blog administration
                </h1>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address"  autofocus="" v-model="form.email" @keydown="errors.clear('email')">
                    <span class="text-danger" v-if="errors.has('email')">{{ errors.get('email') }}</span>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password"  v-model="form.password" @keydown="errors.clear('password')">
                    <span class="text-danger mt-1" v-if="errors.has('password')">{{ errors.get('password') }}</span>
                </div>

                <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Login</button>
                <router-link to="/" class="btn btn-success btn-lg btn-block">Go home</router-link>
                <p class="mt-5 mb-3 text-muted text-center">© 2019</p>
            </form>
        </div>
    </div>
</template>

<script>
    import Errors from "../../Utilities/Errors";
    import authenticated from "../../mixins/authenticated";
    import RedirectIfAuthenticated from "../../mixins/RedirectIfAuthenticated";

    export default {
        name: "Login",
        data() {
            return {
                form : {
                    email: '',
                    password: "",
                },
                endpoint: "/api/auth/login",
                errors: new Errors()
            }
        },
        mixins: [authenticated, RedirectIfAuthenticated],
        created() {
            document.title = "Login | SPA Blog";
        },
        methods: {
            login() {
                axios.post(this.endpoint, this.form)
                    .then(({ data }) => {
                        return this.$store.dispatch("login", data)
                    })
                    .then(() => {
                        this.$store.dispatch("alert", {
                            message: "You are logged in successfully"
                        });
                        this.redirect("admin.dashboard");
                    })
                    .catch(error => {
                        this.errors.record(error.response.data.errors)
                    })
            },
            redirect(route) {
                this.$router.push({
                    name: route
                })
            }
        }
    }
</script>

<style lang="scss">
    /*@import "../../../sass/login";*/
    #app {
        width: 100%;
        height: 100%;
    }
    html,
    body {
        height: 100%;
    }
</style>