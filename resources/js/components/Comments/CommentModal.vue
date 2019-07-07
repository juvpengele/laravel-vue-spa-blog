<template>
    <!-- Modal -->
    <div class="modal fade" ref="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ comment.author_name}}
                    <small>{{ comment.author_email }}</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ comment.content }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="deleteComment">Delete <i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentModal",
        props: ["comment", "show"],
        data() {
            return {
                modalElement: null
            }
        },
        mounted() {
           this.modalElement = this.$refs.modal;

            $(this.modalElement).on('hidden.bs.modal',  (e) => {
                this.$emit("close");
            })
        },
        methods: {
            showModal() {
                $(this.modalElement).modal('show');
            },
            closeModal() {
                $(this.modalElement).modal("hide");
            },
            deleteComment() {
                this.$emit("delete", this.comment)
            }
        },
        watch: {
            show(value){
                if(value) {
                    this.showModal();
                } else {
                    this.closeModal();
                }
            }
        }
    }
</script>

<style scoped>

</style>