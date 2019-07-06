<template>
    <div class="mt-4">
        <h3 class="aside--title mb-4">Tags</h3>
        <div class="row">
            <router-link class="badge badge-pill badge-info col-md-2 m-2 py-2 text-center" v-for="(tag, index) in tags"
                :to="{
                    name: 'tags.index',
                    params: {
                        tag: tag.slug
                    }
                }" :key="index"
            >{{ tag.name }}</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tag",
        data() {
            return {
                endpoint: "/api/tags",
                tags: []
            }
        },
        mounted() {
            this._loadTags();
        },
        methods: {
            _loadTags() {
                axios.get(this.endpoint)
                    .then(({ data :tags}) => this.tags = tags.data)
                    .catch(error => this.$store.dispatch("alert", {
                        type: "danger",
                        message: "An error occured during the request"
                    }))
            }
        }
    }
</script>

<style scoped>

</style>