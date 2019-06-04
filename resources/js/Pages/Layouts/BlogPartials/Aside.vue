<template>
    <!-- Aside -->
    <div class="col-md-4">
        <h3 class="aside--title mb-4">Categories</h3>
        <div class="list-group list-group-flush shadow-sm" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="#">
                PHP
                <span class="badge badge-primary badge-pill">14</span>
            </a>
            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="#">
                Javascript
                <span class="badge badge-primary badge-pill">14</span>
            </a>
            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="#">
                Java
                <span class="badge badge-primary badge-pill">14</span>
            </a>
        </div>
        <div class="mt-4">
            <h3 class="aside--title mb-4">Tags</h3>
            <div class="row">
                <a class="badge badge-pill badge-info col-md-2 m-2 py-2 text-center" href="#">Info</a>
                <a class="badge badge-pill badge-info col-md-2 m-2 py-2 text-center" href="#">Info</a>
                <a class="badge badge-pill badge-info col-md-2 m-2 py-2 text-center" href="#">Info</a>
            </div>
        </div>
    </div>
    <!-- End aside -->
</template>

<script>
    export default {
        name: "Aside"
    }
</script>

<style scoped>

</style>