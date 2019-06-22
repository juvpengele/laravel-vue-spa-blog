<template>
    <transition name="slide-fade">
        <div class="alert flash" :class="'alert-'+flash.type" role="alert" v-if="flash.show">
            {{ flash.message }}
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Flash",
        computed: {
            flash() {
                return this.$store.getters.flash
            }
        }
    }
</script>

<style scoped>
    .flash {
        position: fixed;
        right: 20px;
        bottom: 20px;
    }
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>