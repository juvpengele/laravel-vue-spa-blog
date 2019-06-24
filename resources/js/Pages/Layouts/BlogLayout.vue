<template>
    <div>
        <layout-navbar></layout-navbar>
        <!-- Blog conotent -->
            <div class="container my-4">
                <div class="row">
                    <router-view></router-view>
                    <layout-aside></layout-aside>
                </div>
            </div>
        <!-- End blog content -->
        <layout-footer></layout-footer>
    </div>
</template>

<script>
    import LayoutAside from "./BlogPartials/Aside"
    import LayoutFooter from "./BlogPartials/Footer"
    import LayoutNavbar from "./BlogPartials/Navbar"

    export default {
        name: "BlogLayout",
        components: { LayoutAside, LayoutFooter, LayoutNavbar}
    }
</script>

<style scoped>

</style>