<template>
    <div class="row col-md-8">
        <div class="col-md-12 ">
            <h3 class="pb-4 mb-4 font-italic border-bottom">
                Tag
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
        name: "TagIndex",
        components: { Pagination, Post },
        data() {
            return {
                tags: [],
                endpoint: "/api/tags",
                pagination: {},
                posts:[]
            }
        },
        created() {
            let endpoint = this.getEndpoint(this.$route.params.tag);
            this.loadPosts(endpoint);
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
            getEndpoint(params) {
                return this.endpoint + `/${params}/posts`;
            },
            paginate(page) {
                let endpoint = `${this.endpoint}?page=${page}`;
                this.loadPosts(endpoint);
            }
        },
        watch: {
            '$route.params'(newParam, oldParam) {
                let endpoint = this.getEndpoint(newParam.tag);
                this.loadPosts(endpoint);
            }
        }
    }
</script>

<style scoped>

</style>