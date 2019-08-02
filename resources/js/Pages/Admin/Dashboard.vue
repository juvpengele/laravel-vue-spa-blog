<template>
    <div v-if="data">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-primary mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="text-right">
                            <span class="card-title stats--title">All posts</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <i class="fa fa-newspaper-o text-primary stats--icon"></i>
                            <span class="stats--counter">
                        {{ data.postsCount }}
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="text-right">
                            <span class="card-title stats--title">All comments</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <i class="fa fa-comment text-primary stats--icon"></i>
                            <span class="stats--counter">
                        {{ data.commentsCount }}
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <div class="text-right">
                            <span class="card-title stats--title">All visits</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <i class="fa fa-eye text-primary stats--icon"></i>
                            <span class="stats--counter">
                        {{ data.viewsCount }}
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Latest comments</h4>
                <hr>
                <table class="table">
                    <thead class="thead-info bg-info text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Author name</th>
                        <th scope="col" class="text-center">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(comment, index) in data.latestComments">
                        <th scope="row">{{ index + 1}}</th>
                        <td class="text-center">{{ comment.author_email }}</td>
                        <td class="text-center">{{ comment.author_name }}</td>
                        <td class="text-center">
                            {{ comment.description }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Popular posts</h4>
                <hr>
                <table class="table datatable">
                    <thead class="thead-info bg-info text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">Category</th>
                        <th scope="col" class="text-center">Views</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(post, index) in data.popularPosts">
                        <th scope="row">{{ index + 1}}</th>
                        <td >{{ post.title }}</td>

                        <td class="text-center">{{ post.category.name }}</td>
                        <td class="text-center">
                            <span class="badge badge-pill badge-info py-1 px-2">{{ post.visits }} {{ pluralize("visit", post.visits)}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    import AuthMiddleware from "../../mixins/AuthMiddleware";
    import authenticated from "../../mixins/authenticated";

    export default {
        name: "Dashboard",
        mixins: [ AuthMiddleware, authenticated ],
        data() {
            return {
                data: {}
            }
        },
        created() {
            document.title = "Dashboard | SPA Blog";

            this.loadStats('/api/statistics');
        },
        methods: {
            loadStats(endpoint) {
                axios.get(endpoint)
                    .then(({ data : stats }) => {
                        this.data = stats.data
                    })
                    .catch(error => this.$store.dispatch('alert', {
                        type: 'danger',
                        message: 'Can not load data. Network connection...'
                    }))
            }
        }

    }
</script>

<style scoped>
    .stats--icon {
        font-size: 40px;
    }

    .stats--title {
        font-size: 20px ;
        text-align: right;
    }

    .stats--counter {
        font-size: 25px;
    }
</style>