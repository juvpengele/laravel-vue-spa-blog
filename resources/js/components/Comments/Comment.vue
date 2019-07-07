<template>
    <div class="row col-md-12">
        <div class="card mb-3 col-md-12 p-0 shadow-sm">
            <div class="card-header d-flex justify-content-between m-0">
                <span>{{ data.author_name}}</span>
                <span class="text-secondary">{{ data.created_at }}</span>
            </div>
            <div class="card-body">
                <p class="card-text">{{ data.content }}</p>
            </div>
            <div class="card-footer d-flex justify-content-end" v-if="auth.loggedIn">
                <button class="btn btn-danger" @click="deleteComment">
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ["data"],
        methods: {
            deleteComment() {
                if(! confirm("Are you sure to delete this comment ?")) {
                    return;
                }

                let endpoint =  `/api/comments/${this.data.id}`;

                axios.defaults.headers.common['Authorization'] = `Bearer ${ this.auth.token }`;
                axios.delete(endpoint)
                    .then(() => {
                        this.$store.dispatch("alert", {
                            type: "success",
                            message: "Comment deleted successfully"
                        });
                        this.$emit("delete", this.data);
                    })
                    .catch(error => {
                        this.$store.dispatch("alert", {
                            type: "danger",
                            message: "An error occured during the request"
                        })
                    })

            }
        },
        computed: {
            auth() {
                return this.$store.getters.auth;
            }
        }
    }
</script>

<style scoped>

</style>