<template>
    <div class="h-100">
        <!-- Layout section -->
        <component :is="layout"></component>
        <!-- End layout section -->
        <Flash></Flash>
    </div>
</template>

<script>
   import BlogLayout from "./BlogLayout"
   import AdminLayout from "../Layouts/AdminLayout"
   import LoginLayout from "../Layouts/LoginLayout"
   import Flash from "../../Utilities/Flash";

    export default {
        name: "App",
        components: {Flash, AdminLayout, BlogLayout, LoginLayout },
        data() {
            return {
                defaultLayout: "blog-layout"
            }
        },
        computed: {
            layout() {
                return this.$route.meta.layout ? this.$route.meta.layout : this.defaultLayout;
            }
        }
    }
</script>

<style scoped>

</style>