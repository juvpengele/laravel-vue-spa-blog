<template>
    <!-- Aside -->
    <div class="col-md-4">
        <h3 class="aside--title mb-4">Categories</h3>
        <div class="list-group list-group-flush shadow-sm" id="list-tab" role="tablist">
            <router-link class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" v-for="(category, index) in categories"
                :key="index" :to="{name: 'categories.index', params: {category: category.slug} }"
            >
                {{ category.name }}
                <span class="badge badge-primary badge-pill">{{ category.posts_count}}</span>
            </router-link>
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
        name: "Aside",
        computed : {
            categories() {
                return this.$store.getters.categories;
            }
        }
    }
</script>

<style scoped>

</style>