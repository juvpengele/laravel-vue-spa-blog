<template>

    <!-- Layout section -->
    <component :is="layout"></component>
    <!-- End layout section -->

</template>

<script>
   import BlogLayout from "./BlogLayout"
   import AdminLayout from "../Layouts/AdminLayout"

    export default {
        name: "App",
        components: { AdminLayout, BlogLayout },
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