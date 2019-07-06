<template>
    <div class="my-4">
        <div class="form-group">
            <label for="name">Edit a tag</label>
            <input type="text" class="form-control" v-model="tag.name" id="name">
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
        mixins: [ authenticated, AuthMiddleware, AddToken],
        data() {
            return {
                tag: {
                    name: ""
                },
                endpoint: "/api/tags",
                errors: new Errors()
            }
        },
        mounted() {
            document.title = "Edit a tag | SPA Blog";

            this.endpoint = this.endpoint + `/${this.$route.params.tag}`;
            this.loadTag(this.endpoint)
        },
        methods: {
            loadTag(url) {
                axios.get(url)
                    .then(({ data : tag}) => this.tag = tag.data)
            },
            update() {
                axios.put(this.endpoint, this.tag)
                    .then(() => {
                        this.$store.dispatch("alert", { message: "Tag updated successfully"});
                        this.$router.push({
                            name: "admin.tags.index"
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