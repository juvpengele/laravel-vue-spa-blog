<template>
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your name" id="name" v-model="form.author_name">
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your email" id="email" v-model="form.author_email">
        </div>
        <div class="form-group col-md-12">
            <textarea class="form-control" id="Your comment" rows="3" v-model="form.content"></textarea>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success" @click="store">Comment</button>
        </div>
    </div>
</template>

<script>
    import Errors from "../../Utilities/Errors";

    export default {
        name: "CommentForm",
        data() {
            return {
                errors: new Errors(),
                form: {
                    author_name: "",
                    author_email: "",
                    content: ""
                },
                endpoint: "/api" + window.location.pathname + "/comments"
            }
        },
        methods: {
            store() {
                axios.post(this.endpoint, this.form)
                    .then(({ data : comment}) => {
                        this.clearForm();
                        this.$emit("submit", comment.data)
                    })
                    .catch(error => {
                        console.log(error.response.data.errors)
                    })
            },
            clearForm() {
                this.form = {
                    author_name: "",
                    author_email: "",
                    content: ""
                }
            }
        }
    }
</script>

<style scoped>

</style>