<template>
    <div class="row col-md-8">
        <div class="col-md-12 ">
            <h3 class="pb-4 mb-4 font-italic border-bottom">
                SPA Blog
            </h3>
        </div>
        <div class="col-sm-12 col-md-12 row mt-2">
            <div class="col-md-12">
                <Post v-for="post in posts" :key="post.id" :post="post"/>
            </div>
        </div>
        <Pagination :meta="pagination" @changed="paginate"></Pagination>
    </div>
</template>

<script>
    import Post from "../../components/Post";
    import Pagination from "../../components/Pagination";
    export default {
        name: "PostsIndex",
        components: { Pagination, Post },
        data() {
            return {
                posts: [],
                endpoint: "/api/posts",
                pagination: {}
            }
        },
        created() {
            this.loadPosts(this.getEndpoint(this.$route.query.popular));
            document.title = "SPA Blog"
        },
        methods: {
            loadPosts(endpoint) {
                axios.get(endpoint)
                    .then(({data : posts}) => {
                        this.pagination = posts.meta;
                        this.posts = posts.data;
                    })
                    .catch(error => console.log(error.response));

            },
            getEndpoint(popular = null)  {
               return popular !== null ? `${this.endpoint}?popular=1` : this.endpoint;
            },
            paginate(page) {
                let endpoint = `${this.endpoint}?page=${page}`;
                this.loadPosts(endpoint);
            }
        },
        watch: {
            '$route.query'(newQuery, oldQuery) {
                let endpoint = this.getEndpoint(newQuery.popular);
                this.loadPosts(endpoint);
            }
        }
    }
</script>

<style scoped>

</style>