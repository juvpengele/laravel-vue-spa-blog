<template>
    <label for="cover" class="cover_label">
        <img style="height: 500px; width: 700px; display: block;" :src="image" alt="Card image" class="mx-auto">
        <input type="file" name="cover" ref="cover" hidden @change="upload" id="cover">
    </label>
</template>

<script>
    export default {
        name: "CoverUploader",
        props: {
            cover: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                image: "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3ECover%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
            }
        },
        methods: {
            upload() {
                this.showImage();
                this.dispatchImage();
            },
            showImage() {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.image = event.target.result;
                };
                reader.readAsDataURL(this.$refs.cover.files[0]);
            },
            dispatchImage() {
                this.$emit("loaded", this.$refs.cover.files[0]);
            }
        },
        watch: {
            "cover"(newValue, oldValue) {
                if(newValue !== "") {
                    this.image = newValue;
                }
            }
        }
    }
</script>

<style scoped>
    .cover_label {
        position: relative;
    }

    .cover_label:hover {
        cursor: pointer;
    }

    .cover_label:after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        transition: background-color 0.3s;
        top: 0;
    }

    .cover_label:hover:after {
        background-color: rgba(0, 0, 0, 0.5);
    }

</style>