<template>
    <div class="container-fluid">
        <div class="my-2">
            <router-link :to="{name: 'admin.categories.create'}" class="btn btn-info float-right mb-2">
                Add a category <i class="fa fa-plus-circle"></i>
            </router-link>
        </div>

        <table class="table">
            <thead class="thead-info">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(category, index) in categories">
                <th scope="row">{{ index + 1}}</th>
                <td>{{ category.name }}</td>
                <td>#</td>
            </tr>

            </tbody>
        </table>

    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";

    export default {
        name: "CategoriesIndex",
        mixins: [authenticated, AuthMiddleware],
        data() {
            return {
                endpoint: "/api/categories"
            }
        },
        mounted() {
            console.log(this.$store.getters.categories)
        },
        computed: {
            categories() {
                return this.$store.getters.categories;
            }
        }
    }
</script>

<style scoped>

</style>