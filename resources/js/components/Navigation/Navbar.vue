<template>
    <nav
        class="px-4 h-20 md:px-8 flex items-center justify-between bg-white shadow-md sticky top-0 z-20"
    >
        <div>
            <logo class="hidden lg:block" />
        </div>
        <div class="flex items-center">
            <span
                @click="logout"
                class="text-lg font-poppins font-bold text-secoundary-500 cursor-pointer"
            >
                Logout
            </span>
        </div>
    </nav>
</template>

<script>
import { useRouter } from "vue-router";
import { useAuthStore } from "../../store/useAuth";
import Logo from "../Icons/Logo.vue";

export default {
    components: {
        Logo,
    },
    setup() {
        const store = useAuthStore();
        const router = useRouter();

        const logout = () => {
            store.logout();
            router.push("/login");
        };
        return { logout };
    },
};
</script>
