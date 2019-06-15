<template>
    <div class="row">
        <div class="card mb-3 col-md-12 p-0 shadow-sm">
            <div class="card-header d-flex justify-content-between m-0">
                <span>{{ data.author_name}}</span>
                <span class="text-secondary">{{ data.created_at }}</span>
            </div>
            <div class="card-body">
                <p class="card-text">{{ data.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ["data"]
    }
</script>

<style scoped>

</style>