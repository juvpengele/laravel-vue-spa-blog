<template>
    <!-- comments -->
    <div class="comment-form col-md-12 border-top pt-4">
        <CommentForm @submit="addComment"></CommentForm>
        <Comment v-for="comment in comments" :data="comment" :key="comment.id" @delete="removeComment"></Comment>
    </div>
    <!-- End comments -->
</template>

<script>
    import CommentForm from "./Comments/CommentForm";
    import Comment from "./Comments/Comment";
    export default {
        name: "Comments",
        components: { Comment, CommentForm },
        props: {
            items: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                comments: []
            }
        },
        methods: {
            addComment(comment) {
                this.comments.unshift(comment)
            },
            removeComment({ id : comment_id}) {
                this.comments = this.comments.filter(comment => comment.id !== comment_id);
            }
        },
        watch: {
            items(newComments, old) {
                this.comments = newComments;
            }
        }
    }
</script>

<style scoped>

</style>