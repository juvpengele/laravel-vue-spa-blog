<template>
    <div class="container-fluid">
        <div class="my-2 d-flex justify-content-end">
            <router-link :to="{name: 'admin.categories.create'}" class="btn btn-info mb-2">
                Add a category <i class="fa fa-plus-circle"></i>
            </router-link>
        </div>
        <categories :categories="categories"></categories>
    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";
    import Categories from "../../../components/Categories";

    export default {
        name: "CategoriesIndex",
        components: {Categories},
        mixins: [ authenticated, AuthMiddleware ],
        data() {
            return {
                endpoint: "/api/categories"
            }
        },
        mounted() {
            document.title = "Manage categories | SPA Blog"
        },
        computed: {
            categories() {
                return this.$store.getters.categories;
            }
        }
    }
</script>
