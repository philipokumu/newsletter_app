<template>
    <div
        class="spinner rounded-full animate-spin"
        :class="{
            'border-white': !color,
            [`border-${color}-500`]: color,
            'h-5 w-5 border-2': size === 'mini',
            'h-8 w-8 border-2': size === 'medium',
            'h-10 w-10 border-4': size === 'large',
        }"
    ></div>
</template>

<script>
export default {
    name: "Spinner",
    props: {
        size: {
            type: String,
            default: "large",
        },
        color: {
            type: String,
            default: null,
        },
    },
};
</script>

<style scoped>
.spinner {
    border-top-color: blue;
}
</style>
