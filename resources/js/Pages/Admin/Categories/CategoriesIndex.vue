<template>
    <div>

    </div>
</template>

<script>
    import authenticated from "../../../mixins/authenticated";
    import AuthMiddleware from "../../../mixins/AuthMiddleware";

    export default {
        name: "CategoriesIndex",
        mixins: [authenticated, AuthMiddleware],
        components: { mdbDatatable },
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>