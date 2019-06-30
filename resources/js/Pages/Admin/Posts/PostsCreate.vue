<template>
    <div class="container-fluid">
        <form action="" @submit.prevent="post">
            <div class="card mb-3">
                <cover-uploader @loaded="updateCover"></cover-uploader>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="custom-select" id="category" v-model="form.category_id">
                    <option selected="" disabled></option>
                    <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="form.title">
                    <!--<small id="emailHelp" class="form-text text-danger">We'll never share your email with anyone else.</small>-->
                </div>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <markdown-editor v-model="form.content" id="content"></markdown-editor>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg" type="submit">Post <i class="fa fa-check"></i></button>
            </div>
        </form>
    </div>
</template>

<script>
    import CoverUploader from "../../../components/CoverUploader";
    import MarkdownEditor from 'vue-simplemde/src/markdown-editor';
    import AddToken from "../../../mixins/AddToken";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";
    import authenticated from "../../../mixins/authenticated";

    export default {
        components: {CoverUploader, MarkdownEditor},
        mixins: [AuthMiddleware, authenticated, AddToken],
        data() {
            return {
                form: {
                    cover: "",
                    category_id: "",
                    title: "",
                    content: ""
                },
                endpoint: "/api/posts"
            }
        },
        methods: {
            updateCover(cover) {
                this.form.cover = cover;
            },
            post() {
                const config = {
                    headers: {
                        "content-type": "multipart/form-data"
                    }
                };

                let formData = new FormData();

                formData.append("cover", this.form.cover);
                formData.append("title", this.form.title);
                formData.append("content", this.form.content);
                formData.append("category_id", this.form.category_id);

                this.store(formData, config);
            },
            store(data, config) {
                axios.post(this.endpoint, data, config)
                    .then((response) => {
                        return this.$store.dispatch("addCategoryPostCount", {
                            category_id: this.form.category_id
                        });
                    })
                    .then(() => {
                        this.$store.dispatch("alert", {
                            message: "Your post has been saved successfully"
                        });
                        this.$router.push({
                            name: "admin.posts.index"
                        });
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        },
        computed: {
            categories() {
                return this.$store.getters.categories;
            }
        }
    }
</script>

<style scoped>
    @import '~simplemde/dist/simplemde.min.css';
</style>