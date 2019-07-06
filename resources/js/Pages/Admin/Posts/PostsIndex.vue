<template>
    <div class="container-fluid">
        <div class="my-2 d-flex justify-content-end">
            <router-link :to="{name: 'admin.posts.create'}" class="btn btn-info mb-2">
                Add a new post <i class="fa fa-plus-circle"></i>
            </router-link>
        </div>
        <posts :posts="posts" @deleted="removePost"></posts>
    </div>
</template>

<script>
    import Posts from "../../../components/admin/Posts";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";
    import AddToken from "../../../mixins/AddToken";
    import authenticated from "../../../mixins/authenticated";
    export default {
        components: {Posts},
        mixins: [AuthMiddleware, AddToken, authenticated],
        data() {
            return {
                posts: [],
                endpoint: "/api/posts/all"
            }
        },
        created() {
            this.fetchPosts(this.endpoint)
        },
        methods: {
            fetchPosts(endpoint) {
                axios.get(endpoint)
                    .then(({ data : posts }) => {
                        this.posts = posts.data;
                    })
                    .catch(error => {
                        this.$store.dispatch("alert", {
                            message: "Error occured during fetching data",
                            type: "danger"
                        })
                    })
            },
            removePost({id : post_id, category}) {

                this.posts = this.posts.filter(post => post.id !== post_id);

                this.$store.dispatch("removeCategoryPostsCount", category)
                            .then(() => this.$store.dispatch("alert", {message: "The post has been deleted successfully"}))
            }
        }
    }
</script>