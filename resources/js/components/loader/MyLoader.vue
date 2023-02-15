<template>
    <div
        class="loader"
        :class="{ 'loader--visible': visible }"
    >
        <spinner name="pacman" color="#519ce8"></spinner>
    </div>
</template>
<script>
import Spinner from 'vue-spinkit'
export default {
    name: "MyLoader",
    components: {
        'spinner': Spinner
    },
    props: ["visible"]
};
</script>
<style lang="scss">
.loader {
    background: rgba(255, 255, 255, 0.8);
    transition: 0.15s ease-in opacity;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    opacity: 0;
    &--visible {
        opacity: 1;
        pointer-events: all;
    }
}
</style>
