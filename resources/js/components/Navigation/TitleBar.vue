<template>
    <nav
        class="py-4 px-4 md:px-8 sticky top-20 bg-white shadow-md flex items-center z-10"
    >
        <button
            v-if="back"
            class="mr-2 h-8 w-8 grid place-items-center rounded-full ring-primary-500 hover:bg-gray-100 focus:ring-2 focus:bg-gray-100 transition focus:outline-none"
            @click="$router.go(-1)"
        >
            <span class="h-2/3 w-2/3 block">
                <back-icon />
            </span>
        </button>
        <p class="font-poppins text-xl">{{ pageTitle }}</p>
    </nav>
</template>

<script>
import BackIcon from "../Icons/BackIcon.vue";

export default {
    name: "TitleBar",
    components: {
        BackIcon,
    },
    props: {
        back: {
            type: Boolean,
            default: false,
        },
        pageTitle: {
            type: String,
            default: null,
        },
    },
};
</script>
