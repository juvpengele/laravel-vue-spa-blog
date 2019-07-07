<template>
    <div class="row col-md-8">
        <div class="col-sm-12 col-md-12 row mt-2">
            <div class="col-md-12 blog-main">
                <div class="blog-img mb-4 text-center">
                    <img :src="post.cover_path" alt="" class="w-100" style="max-height: 300px;">
                </div>

                <div class="blog-post">
                    <h2 class="blog-post-title">{{ post.title }}</h2>
                    <p class="blog-post-meta">{{ post.created_at }} by <a href="#">{{ post.creator.name }}</a></p>

                    <div v-html="post.content">
                    </div>

                </div><!-- /.blog-post -->
            </div>
           <Comments :items="post.comments" />
        </div>

    </div>

</template>

<script>
    import moment from "moment";
    import Comments from "../../components/Comments";

    export default {
        name: "PostShow",
        components: {Comments},
        data() {
            return {
                post: {
                    creator: "",
                    comments: []
                }
            }
        },
        created() {
            this.fetchPost(this.$route.params);
        },
        methods: {
            fetchPost({ category, slug : postSlug}) {
                let url = `/api/${category}/${postSlug}`;

                axios.get(url)
                    .then(({ data : post}) => this.post = post.data)
                    .catch(error => console.log(error));
            }
        },
        watch: {
            '$route.params'(value) {
                this.fetchPost(value);
            }
        }
    }
</script>

<style scoped>

</style>