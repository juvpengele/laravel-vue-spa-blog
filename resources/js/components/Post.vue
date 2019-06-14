<template>
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-custom h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static col-md-8">
            <strong class="d-inline-block mb-2 text-primary">{{ post.category.name }}</strong>
            <h3 class="mb-0">{{ post.title }}</h3>
            <div class="mb-1 text-muted">{{ post.created_at }}</div>
            <p class="card-text">{{ post.description}}</p>
            <div class="d-flex justify-content-between">
                <router-link
                    :to="{
                        name: 'posts.show',
                        params: {
                            category: post.category.slug,
                            slug: post.slug
                        }
                    }"
                    class="stretched-link"
                >Continue reading</router-link>
                <span> {{ post.visits_count }} views </span>
            </div>
        </div>
        <div class="col-auto d-none d-lg-block col-md-4">
            <img :src="post.cover_path" :alt="post.title" >
        </div>
    </div>
</template>

<script>
    export default {
        name: "Post",
        props: {
            post: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>