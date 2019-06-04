<template>
    <!-- Blog conotent -->
    <div class="container my-4">
        <div class="row">
            <router-view></router-view>
            <layout-aside></layout-aside>
        </div>
    </div>
    <!-- End blog content -->
</template>

<script>
    import LayoutAside from "./BlogPartials/Aside"

    export default {
        name: "BlogLayout",
        components: { LayoutAside }
    }
</script>

<style scoped>

</style>