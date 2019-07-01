<template>
    <table class="table datatable">
        <thead class="thead-info bg-info text-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Views</th>
            <th scope="col" class="text-center">Online ?</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(post, index) in posts">
            <th scope="row">{{ index + 1}}</th>
            <td >{{ post.title }}</td>
            <td >{{ post.description }}</td>
            <td class="text-center">{{ post.category.name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-info py-1 px-2">{{ post.visits_count }} {{ pluralize("visit", post.visits_count)}}</span>
            </td>
            <td class="text-center">
                <span class="badge p-2" :class="post.online ? 'badge-success': 'badge-danger'" style="border-radius: 50%"></span>
            </td>
            <td class="text-center">
                <router-link href="#" class="btn btn-outline-info rounded-circle round"
                    :to="{
                        name: 'admin.posts.edit',
                        params: {
                            post: post.slug
                        }
                    }"
                >
                    <i class="fa fa-pencil"></i>
                </router-link>
                <a href="#" class="btn btn-outline-danger rounded-circle round" @click.prevent="deletePosts(post)">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>

        </tbody>
    </table>
</template>

<script>
    export default {
        name: "Posts",
        props: ["posts"],
        methods: {
            deletePosts(post) {
                const endpoint = `/api/posts/${post.slug}`;

                if(! confirm("Are you sure to delete this post ?")) {
                    return false;
                }

                axios.delete(endpoint)
                    .then(() => this.$emit("deleted", post))
                    .catch(error => this.$store.dispatch("alert", {message: "An error occured with the request", type: "danger"}))
            }
        }
    }
</script>


<style scoped>
    .round {
        width: 30px;
        height: 30px;
        position: relative;
    }
    .round i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .badge:empty {
        display: inline-block;
    }
</style>