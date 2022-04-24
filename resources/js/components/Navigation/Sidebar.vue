<template>
    <div
        class="sidebar fixed transform lg:transform-none lg:sticky top-0 lg:top-20 h-screen w-72 lg:w-auto left-0 bg-white lg:shadow-md transition-all duration-300 z-30 lg:z-10 overflow-x-auto"
    >
        <div
            class="px-4 md:px-8 h-20 flex items-center justify-between bg-white sticky top-0 lg:hidden"
        >
            <router-link to="/" class="text-primary-500">
                <logo />
            </router-link>
        </div>
        <menu class="m-0 p-0 py-3 lg:py-0">
            <ul>
                <li class="border-b">
                    <p
                        class="py-2 px-4 md:px-8 text-sm uppercase text-gray-400"
                    >
                        Subscriber management
                    </p>
                </li>
                <li>
                    <router-link
                        to="/subscribers"
                        class="py-4 px-4 md:px-8 whitespace-nowrap flex items-center border-primary-500 hover:text-primary-500 focus:text-primary-500 transition select-none focus:outline-none"
                        :class="{
                            'border-r-2 text-primary-500':
                                $route.name === 'subscribers',
                        }"
                    >
                        <span class="mr-3 h-6 w-6 block"> </span>
                        <span>Subscribers</span>
                    </router-link>
                </li>
                <li class="border-b">
                    <p
                        class="py-2 px-4 md:px-8 text-sm uppercase text-gray-400"
                    >
                        Fields management
                    </p>
                </li>
                <li>
                    <router-link
                        to="/fields"
                        class="py-4 px-4 md:px-8 whitespace-nowrap flex items-center border-primary-500 hover:text-primary-500 focus:text-primary-500 transition select-none focus:outline-none"
                        :class="{
                            'border-r-2 text-primary-500':
                                $route.name === 'fields',
                        }"
                    >
                        <span class="mr-3 h-6 w-6 block"> </span>
                        <span>Fields</span>
                    </router-link>
                </li>
            </ul>
        </menu>
    </div>
</template>

<script>
import Logo from "../Icons/Logo.vue";

export default {
    name: "Sidebar",
    components: {
        Logo,
    },
};
</script>

<style lang="scss" scoped>
@media screen and (min-width: 1024px) {
    .sidebar {
        height: calc(100vh - 5rem);

        &::-webkit-scrollbar {
            width: 0.5rem;
            background: transparent;
        }

        &::-webkit-scrollbar-thumb {
            background: #f3e8ff;
        }
    }
}
</style>
