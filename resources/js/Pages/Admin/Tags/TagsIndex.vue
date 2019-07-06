<template>
    <div class="container-fluid">
        <table class="table datatable">
            <thead class="thead-info bg-info text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Posts</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(tag, index) in tags">
                <th scope="row">{{ index + 1}}</th>
                <td class="text-center">{{ tag.name }}</td>
                <td class="text-center">
                    <span class="badge badge-pill badge-info py-1 px-2">{{ tag.posts_count }} {{ pluralize("post", tag.posts_count)}}</span>
                </td>
                <td class="text-center">
                    <router-link href="#" class="btn btn-outline-info rounded-circle round"
                     :to="{
                        name: 'admin.tags.edit',
                        params: {
                            tag: tag.slug
                        }
                    }"
                    >
                        <i class="fa fa-pencil"></i>
                    </router-link>
                    <a href="#" class="btn btn-outline-danger rounded-circle round" @click.prevent="deleteTags(tag)">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";

    export default {
        name: "TagsIndex",
        mixins: [ authenticated, AuthMiddleware ],
        data() {
            return {
                endpoint: "/api/tags",
                tags: []
            }
        },
        mounted() {
            document.title = "Manage tags | SPA Blog";
            this.loadTags();
        },
        methods: {
            loadTags() {
                axios.get(this.endpoint)
                    .then(({ data : tags}) => this.tags = tags.data)
                    .catch((error) => this._flashErrors(error))
            },
            deleteTags(tag) {
                if(confirm("Are you sure to delete this tag ?")) {
                    return;
                }

                let endpoint = this.endpoint + `/${tag.slug}`;

                axios.delete(endpoint)
                    .then(() => this._removeTag(tag))
                    .catch(error => this._flashErrors(error))
            },
            _flashErrors(error) {
                this.$store.dispatch("alert",
                    {
                        message:"An error occured during the request",
                        type:"danger"
                    }
                )
            },
            _removeTag({ id }) {
                this.tags = this.tags.filter(tag => tag.id !== id);
            }
        }
    }
</script>
