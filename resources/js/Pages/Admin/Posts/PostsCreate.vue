<template>
    <div class="container-fluid">
        <div class="card mb-3">
            <cover-uploader @loaded="updateCover"></cover-uploader>
        </div>
            
    </div>
</template>

<script>
    import CoverUploader from "../../../components/CoverUploader";
    export default {
        components: {CoverUploader},
        data() {
            return {
                form: {
                    cover: ""
                }
            }
        },
        methods: {
            updateCover(cover) {
                this.form.cover = cover;
            }
        },
        computed: {
            categories() {
                return this.$store.getters.categories;
            }
        }
    }
</script>