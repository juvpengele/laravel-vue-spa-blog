<template>
    <div class="my-4">
        <div class="form-group">
            <label for="name">Edit a category</label>
            <input type="text" class="form-control" v-model="category.name" id="name">
        </div>
        <span class="text-danger d-block mb-2" v-if="errors.has('name')">{{ errors.get('name')}}</span>
        <div class="form-group">
            <button class="btn btn-lg btn-info" @click="update">Update <i class="fa fa-check"></i></button>
        </div>
    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";
    import AddToken from "../../../mixins/AddToken";
    import Errors from "../../../Utilities/Errors";

    export default {
        name: "CategoriesEdit",
        mixins: [authenticated, AuthMiddleware, AddToken],
        data() {
            return {
                category: {
                    name: ""
                },
                endpoint: "/api/categories",
                errors: new Errors()
            }
        },
        mounted() {
            document.title = "Edit category | SPA Blog";

            this.endpoint = this.endpoint + `/${this.$route.params.category}`;
            this.loadCategory(this.endpoint)
        },
        methods: {
            loadCategory(url) {
                axios.get(url)
                    .then(({ data : category}) => this.category = category.data)
            },
            update() {
                axios.put(this.endpoint, this.category)
                    .then(({ data: category}) => {
                        return this.$store.dispatch("updateCategory", category)
                    })
                    .then(() => {
                        this.$store.dispatch("alert", { message: "Category updated successfully"});
                        this.$router.push({
                            name: "admin.categories.index"
                        })
                    })
                    .catch((error) => {
                        if(error.response.data.errors) {
                            this.errors.record(error.response.data.errors)
                        } else {
                           this.$store.dispatch("alert", {
                               message: "There is an error with the request",
                               type: "dangerr"
                           })
                        }
                    })

            }
        }

    }
</script>

<style scoped>

</style>