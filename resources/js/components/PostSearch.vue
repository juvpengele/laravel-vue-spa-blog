<template>
    <div class="post-search--wrapper">
        <div class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search an article"
                   @focus="showResults" @blur="removeResults" v-model="query" @keyup="loadResults">
        </div>
        <div  id="search-tab" role="tablist" class="list-group list-group-flush shadow-sm post-search--results" v-if="search">
            <router-link
                :to="{
                    name: 'posts.show',
                    params: {
                        slug: result.slug,
                        category: result.category.slug
                    }
                }"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" v-for="result in results" :key="result.id">
                {{ result.title }}
            </router-link>
        </div>
    </div>

</template>

<script>
    export default {
        name: "PostSearch",
        data() {
            return {
                query: "",
                search: false,
                results: [],
                endpoint: "/api/posts?search="
            }
        },
        methods: {
            showResults() {
                this.search = true;
            },
            removeResults() {
                this.search = false;
            },
            loadResults() {
                if(this.query.length < 3) {
                    this.results = [];
                    return;
                }

                let endpoint = this.endpoint + this.query;

                axios.get(endpoint)
                .then(({data : results}) => {
                    this.results = results.data;
                })
            }
        }
    }
</script>

<style scoped>
    .post-search--wrapper {
        position: relative;
    }

    .post-search--results {
        position: absolute;
        width: 100%;
        z-index: 100;
        margin-top: 8px;
    }
</style>