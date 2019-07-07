<template>
    <div class="container-fluid">
        <table class="table datatable">
            <thead class="thead-info bg-info text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Author name</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(comment, index) in comments">
                <th scope="row">{{ index + 1}}</th>
                <td class="text-center">{{ comment.author_email }}</td>
                <td class="text-center">{{ comment.author_name }}</td>
                <td class="text-center">
                    {{ comment.description }}
                </td>
                <td class="text-center">
                    <a href="#" class="btn btn-outline-info rounded-circle round" @click.prevent="openModal(comment)"  data-toggle="modal" >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-outline-danger rounded-circle round" @click.prevent="deleteComment(comment)">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <comment-modal :comment="comment" :show="showModal" @close="hideModal" @delete="deleteComment"></comment-modal>
    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";
    import AddToken from "../../../mixins/AddToken";
    import CommentModal from "../../../components/Comments/CommentModal";

    export default {
        name: "CommentsIndex",
        mixins: [authenticated, AuthMiddleware, AddToken],
        data() {
            return {
                comments: [],
                comment: {
                    author_email: "",
                    author_name: "",
                    content: "",
                    id: ""
                },
                showModal: false,
                endpoint: "/api/comments"
            }
        },
        components: { CommentModal },
        mounted() {
            this.setDocumentTitle("Manage comments | SPA Blog");
            this.loadComments();
        },
        methods: {
            deleteComment({ id : comment_id }) {
                if(! confirm("Are you sure to delete this comment ?")) {
                    return;
                }

                this.showModal = false;

                axios.delete( "/api/comments/"+ comment_id)
                    .then(() => {
                        this.comments = this.comments.filter(comment => comment.id !== comment_id);
                        this.$store.dispatch("alert", {
                            type: "success",
                            message: "Comment deleted successfully"
                        })
                    })
                    .catch(error => {
                        this.$store.dispatch("alert", {
                            type: "danger",
                            message: "An error occured during the request"
                        })

                    })
            },
            loadComments() {
                axios.get(this.endpoint)
                    .then(({ data : comments}) => this.comments = comments.data)
                    .catch(() => this.$store.dispatch("alert", {
                        type: "danger",
                        message: "An error occured during the request"
                    }))
            },
            openModal(comment) {
                this.comment = comment;
                this.showModal = true;
            },
            hideModal() {
                if(this.showModal) {
                    this.showModal = false;
                }
                this.comment = {
                    author_email: "",
                    author_name: "",
                    content: "",
                    id: ""
                }
            }
        }
    }
</script>

<style scoped>

</style>