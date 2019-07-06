<template>
    <div class="container-fluid">
        <form action="" @submit.prevent="updatePost">
            <div class="card mb-3">
                <cover-uploader @loaded="updateCover" :cover="post.cover_path"></cover-uploader>
                <small class="post-text text-danger" v-if="errors.has('cover')">{{ errors.get('cover') }}</small>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="custom-select" id="category" v-model="form.category_id" @change="errors.clear('category_id')">
                    <option selected="" disabled></option>
                    <option :value="category.id" v-for="category in categories"
                        :selected="category.id === form.category_id"
                    >{{ category.name }}</option>
                </select>
                <small class="post-text text-danger" v-if="errors.has('category_id')">{{ errors.get('category_id') }}</small>
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
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" v-model="form.title" @keydown="errors.clear('title')">
                    <small class="post-text text-danger" v-if="errors.has('title')">{{ errors.get('title') }}</small>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <markdown-editor v-model="form.content" id="content" @keydown="errors.clear('content')"></markdown-editor>
                <small class="post-text text-danger" v-if="errors.has('content')">{{ errors.get('content') }}</small>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg" type="submit">Edit <i class="fa fa-check"></i></button>
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
        name: "PostEdit",
        components: {CoverUploader, MarkdownEditor, InputTag},
        mixins: [AuthMiddleware, authenticated, AddToken],
        data() {
            return {
                endpoint: "/api/posts",
                post: {},
                errors: new Errors(),
                form: {
                    cover: "",
                    category_id: "",
                    title: "",
                    content: "",
                    online: "",
                    tags: ""
                },
            }
        },
        mounted() {
            this.endpoint = `${this.endpoint}/${this.$route.params.post}`;
            this.loadPost(this.endpoint);
        },
        methods: {
            loadPost(endpoint) {
                axios.get(endpoint)
                    .then(({ data : post}) => {
                        this.post = post.data;
                        this.setForm(this.post);
                    })
                    .catch(error => this.$store.dispatch("alert", { message: "An error occured", type: "danger" }))
            },
            updateCover(cover) {
                this.form.cover = cover;
            },
            setForm(post) {
                let tagNames = post.tags.map((tag) => tag.name)

                this.form = {
                    cover: null,
                    category_id: post.category.id,
                    title: post.title,
                    content: post.content,
                    online: post.online,
                    tags: tagNames.join(",")
                }
            },
            updatePost() {
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
                formData.append("tags", this.form.tags);
                formData.append('_method', 'PUT');

                this.store(formData, config);
            },
            store(data, config) {

                axios.post(this.endpoint, data, config)
                    .then(({ data : post }) => {

                        if(post.data.category.id !== this.post.category.id) {
                            this.$store.dispatch("changeCategoriesPostsCount", { old: this.post.category, new: post.data.category});
                        }

                        return this.$store.dispatch("alert", {
                            message: "Post edited successfully"
                        })
                    })
                    .then(() => {
                        this.$router.push({
                            name: "admin.posts.index"
                        })
                    })
                    .catch(error => {
                        let formErrors = error.response.data.errors;

                        if(formErrors) {
                            this.errors.record(formErrors);
                        } else {
                            this.$store.dispatch("alert", {
                                message: "An error occured during the request",
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

</style>