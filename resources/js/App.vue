<template>
    <div class="h-100">
        <!-- Layout section -->
        <component :is="layout"></component>
        <!-- End layout section -->
        <Flash></Flash>
    </div>
</template>

<script>
   import BlogLayout from "./Pages/Layouts/BlogLayout"
   import AdminLayout from "./Pages/Layouts/AdminLayout"
   import LoginLayout from "./Pages/Layouts/LoginLayout"
   import Flash from "./Utilities/Flash";

    export default {
        name: "App",
        components: { Flash, AdminLayout, BlogLayout, LoginLayout },
        data() {
            return {
                defaultLayout: "blog-layout"
            }
        },
        computed: {
            layout() {
                return this.$route.meta.layout ? this.$route.meta.layout : this.defaultLayout;
            }
        },
        mounted() {
            this.$store.dispatch("fetchCategories")
        }
    }
</script>

<style scoped>

</style>