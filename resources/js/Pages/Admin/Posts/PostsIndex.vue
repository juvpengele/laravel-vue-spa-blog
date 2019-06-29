<template>
    <div class="container-fluid">
        <div class="my-2 d-flex justify-content-end">
            <router-link :to="{name: 'admin.posts.create'}" class="btn btn-info mb-2">
                Add a new post <i class="fa fa-plus-circle"></i>
            </router-link>
        </div>
        <posts :posts="posts"></posts>
    </div>
</template>

<script>
    import Posts from "../../../components/admin/Posts";
    export default {
        components: {Posts},
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
            }
        }
    }
</script>