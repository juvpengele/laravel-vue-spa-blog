<template>
    <div>
        <ul class="pagination">
            <li class="page-item" :class="pagination.current_page == pagination.from ? 'disabled': ''">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">&laquo;</a>
            </li>
            <li class="page-item" :class="page == pagination.current_page ? 'active': '' " v-for="page in pages">
                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="pagination.current_page == pagination.last_page ? 'disabled': ''">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">&raquo;</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: ["meta"],
        data() {
            return {
                pagination: {},
            }
        },
        updated() {
            this.pagination = this.meta;
        },
        computed : {
            pages() {
                let pages = [];
                for(let i = 0; i < this.meta.last_page; i++) {
                    let page = i + 1;
                    pages.push(page);
                }
                return pages;
            }
        },
        methods: {
            changePage(page) {
                window.scroll({
                    behavior: 'smooth',
                    left: 0,
                    top: 0
                });

                this.pagination.current_page = page;
                this.$emit("changed", page);
            }
        }
    }
</script>

<style scoped>

</style>