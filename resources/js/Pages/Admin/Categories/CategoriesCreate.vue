<template>
    <div class="my-4">
        <tag-input label="Add categories" name="category" v-model="categories"></tag-input>
        <span class="text-danger d-block mb-2" v-if="errors.has('names')">{{ errors.get('names')}}</span>
        <div class="form-group">
            <button class="btn btn-lg btn-info" @click="create">Create <i class="fa fa-check"></i></button>
        </div>
    </div>
</template>

<script>
    import TagInput from "../../../Utilities/InputTag";
    import Errors from "../../../Utilities/Errors";
    import AddToken from "../../../mixins/AddToken";
    export default {
        name: "CategoriesCreate",
        components: { TagInput },
        mixins: [AddToken],
        data() {
            return {
                categories: "",
                endpoint: "/api/categories",
                errors: new Errors()
            }
        },
        created() {
            document.title = "Add categories | SPA Blog"
        },
        methods: {
            create() {
                axios.post(this.endpoint, { names: this.categories })
                    .then(({ data : categories}) => {
                        return this.$store.dispatch("removeCategory", categories.data)
                    })
                    .then(() => {
                        this.$store.dispatch("alert", { message:  "Categories deleted successfully"});
                    }).
                    catch(error => {
                        this.errors.record(error.response.data.errors)
                    })
            }
        }
    }
</script>

<style scoped>

</style>