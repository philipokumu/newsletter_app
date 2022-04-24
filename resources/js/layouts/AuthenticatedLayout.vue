<template>
    <div class="font-sourcesans min-h-screen bg-gray-50 text-gray-800">
        <navbar />
        <div class="lg:grid grid-cols-12">
            <div class="col-span-3 2xl:col-span-2">
                <sidebar />
            </div>
            <div class="col-span-9 2xl:col-span-10">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../components/Navigation/Sidebar.vue";
import Navbar from "../components/Navigation/Navbar.vue";

export default {
    components: {
        Sidebar,
        Navbar,
    },
};
</script>
