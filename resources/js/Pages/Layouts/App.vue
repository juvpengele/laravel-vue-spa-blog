<template>
    <div>
        <layout-navbar></layout-navbar>

        <!-- Blog section layout -->
        <blog-layout></blog-layout>
        <!-- End blog section layout -->

        <layout-footer></layout-footer>
    </div>
</template>

<script>
   import BlogLayout from "./BlogLayout"
   import LayoutNavbar from "./Partials/Navbar";
   import LayoutFooter from "./Partials/Footer";

    export default {
        name: "App",
        components: {LayoutFooter, BlogLayout, LayoutNavbar, }
    }
</script>

<style scoped>

</style>