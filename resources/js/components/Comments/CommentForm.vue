<template>
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your name" id="name" v-model="form.author_name" @keyup="errors.clear('author_name')">
            <div class="text-danger" v-if="errors.has('author_name')">{{ errors.get("author_name") }}</div>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Your email" id="email" v-model="form.author_email" @keyup="errors.clear('author_email')">
            <div class="text-danger" v-if="errors.has('author_email')">{{ errors.get("author_email")}}</div>
        </div>
        <div class="form-group col-md-12">
            <textarea class="form-control" id="Your comment" rows="3" v-model="form.content" @keyup="errors.clear('content')"></textarea>
            <div class="text-danger" v-if="errors.has('content')">{{ errors.get("content")}}</div>
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
                        this.$emit("submit", comment.data);
                        this.$store.dispatch("alert",{ message: "Your comment has been saved successfully"} )
                    })
                    .catch(error => this.errors.record(error.response.data.errors))
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