<template>
    <div class="post-search--wrapper">
        <div class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search an article"
                   @focus="showResults" @blur="removeResults" v-model="query" @keyup="loadResults">
        </div>
        <div class="list-group list-group-flush shadow-sm post-search--results" v-if="search">
            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center result" v-for="result in results" :key="result.id"
                @click.prevent="goTo(result)" href="#" :data-result="result.slug"
            >
                {{ result.title }}
            </a>
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
                let isResultClicked = event.relatedTarget.classList.contains("result");

                if(isResultClicked) {
                    this.goTo(event.relatedTarget.dataset.result);
                }

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
            },
            goTo(slug) {
                let result = this.results.find((result) => result.slug === slug);

                this.$router.push({
                    name: "posts.show",
                    params: {
                        category: result.category.slug,
                        slug: result.slug
                    }
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