<template>
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 bg-info">
        <router-link to="/admin" class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">SPA Blog Administration</router-link>
        <ul class="navbar-nav px-3 d-flex flex-row">
            <li class="nav-item mr-2">
                <router-link to="/" class="nav-link text-white" >Home</router-link>
            </li>
            <li class="nav-item text-nowrap">
                <a class="nav-link text-white" href="#" @click.prevent="logOut">Sign out</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";

    export default {
        name: "Navbar.vue",
        mixins: [ authenticated ],
        methods: {
            logOut() {
                this.auth.logOut();
                this.$router.push("/");
                this.$store.dispatch("alert", { message: "You are logged out successfully"})
            }
        }
    }
</script>

<style scoped>

</style>