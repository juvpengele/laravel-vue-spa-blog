<template>
    <!-- comments -->
    <div class="comment-form col-md-12 border-top pt-4">
        <CommentForm></CommentForm>
        <Comment v-for="comment in items" :data="comment" :key="comment.id"></Comment>

    </div>
    <!-- End comments -->
</template>

<script>
    import CommentForm from "./Comments/CommentForm";
    import Comment from "./Comments/Comment";
    export default {
        name: "Comments",
        components: { Comment, CommentForm },
        props: ["items"]
    }
</script>

<style scoped>

</style>