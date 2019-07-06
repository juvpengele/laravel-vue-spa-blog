<template>
    <div class="container-fluid">
        <form action="" @submit.prevent="post">
            <div class="card mb-3">
                <cover-uploader @loaded="updateCover"></cover-uploader>
                <small class="form-text text-danger" v-if="errors.has('cover')">{{ errors.get('cover') }}</small>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="custom-select" id="category" v-model="form.category_id" @change="errors.clear('category_id')">
                    <option selected="" disabled></option>
                    <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                </select>
                <small class="form-text text-danger" v-if="errors.has('category_id')">{{ errors.get('category_id') }}</small>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="online" checked="" v-model="form.online">
                    <label class="custom-control-label" for="online">Online</label>
                </div>
            </div>
            <div class="form-group">
                <input-tag name="Tags" v-model="form.tags"></input-tag>
                <small class="form-text text-danger" v-if="errors.has('tags')">{{ errors.get('tags') }}</small>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" v-model="form.title" @keydown="errors.clear('title')">
                <small class="form-text text-danger" v-if="errors.has('title')">{{ errors.get('title') }}</small>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <markdown-editor v-model="form.content" id="content" @keydown="errors.clear('content')"></markdown-editor>
                <small class="form-text text-danger" v-if="errors.has('content')">{{ errors.get('content') }}</small>
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
    import Errors from "../../../Utilities/Errors";
    import InputTag from "../../../Utilities/InputTag";

    export default {
        components: {CoverUploader, MarkdownEditor, InputTag },
        mixins: [AuthMiddleware, authenticated, AddToken],
        data() {
            return {
                form: {
                    cover: "",
                    category_id: "",
                    title: "",
                    content: "",
                    online: false,
                    tags: ""
                },
                endpoint: "/api/posts",
                errors: new Errors()
            }
        },
        methods: {
            updateCover(cover) {
                if(this.errors.has('cover')) {
                    this.errors.clear('cover');
                }
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
                formData.append("online", this.form.online);
                formData.append("tags", this.form.tags)

                this.store(formData, config);
            },
            store(data, config) {

                axios.post(this.endpoint, data, config)
                    .then(({ data : post}) => {

                        return this.$store.dispatch("addCategoryPostCount", post.data.category);
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
                        if(error.response.data.errors) {
                            this.errors.record(error.response.data.errors)
                        } else {
                            this.$store.dispatch("alert", {
                                message: "An error occured during request",
                                type: "danger"
                            })
                        }

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