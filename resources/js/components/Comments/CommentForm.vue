<template>
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your name" id="name">
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your email" id="email">
        </div>
        <div class="form-group col-md-12">
            <textarea class="form-control" id="Your comment" rows="3"></textarea>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success">Comment</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentForm"
    }
</script>

<style scoped>

</style>