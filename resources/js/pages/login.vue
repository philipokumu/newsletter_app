<template>
    <GuestLayout>
        <div class="min-h-screen lg:grid grid-cols-2">
            <div
                class="py-4 px-4 md:px-8 min-h-screen flex flex-col items-center justify-between"
            >
                <div></div>
                <div class="max-w-sm w-full">
                    <div class="mb-6">
                        <logo />
                    </div>
                    <div class="mb-6">
                        <h1 class="mb-2 text-4xl font-poppins font-semibold">
                            Welcome
                        </h1>
                        <p class="text-sm"></p>
                    </div>
                    <form
                        autocomplete="off"
                        class="w-full"
                        @submit.prevent="submitForm"
                    >
                        <div class="mb-4">
                            <label for="email" class="block leading-8">
                                Email
                            </label>
                            <input
                                id="email"
                                v-model="data.email"
                                type="email"
                                class="py-3 px-6 border block w-full ring-primary-600 focus:ring-2 transition rounded focus:outline-none"
                                required
                            />
                            <!-- :class="{
                                'border-red-500':
                                    errors.email ||
                                    (serverErrors && serverErrors.email),
                            }" -->
                            <!-- <div class="text-sm text-red-500">
                            <span v-if="errors.email">{{ errors.email }}</span>
                            <span v-if="serverErrors && serverErrors.email">
                                {{ serverErrors.email[0] }}
                            </span>
                        </div> -->
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block leading-8">
                                Password
                            </label>
                            <input
                                id="password"
                                v-model="data.password"
                                type="password"
                                class="py-3 px-6 border block w-full ring-primary-600 focus:ring-2 transition rounded focus:outline-none"
                                :class="{
                                    'border-red-500':
                                        serverErrors && serverErrors.password,
                                }"
                                required
                            />
                            <div class="text-sm text-red-500">
                                <span
                                    v-if="serverErrors && serverErrors.password"
                                >
                                    {{ serverErrors.password[0] }}
                                </span>
                            </div>
                        </div>
                        <button
                            class="my-6 py-3 px-6 block w-full bg-green-700 text-white shadow-md hover:bg-primary-700 focus:bg-primary-700 transition rounded focus:outline-none"
                            :disabled="isBusy"
                            :class="{ 'pointer-events-none': isBusy }"
                        >
                            <span v-if="!isBusy"> Login </span>
                            <spinner v-else class="mx-auto" />
                        </button>
                    </form>
                </div>
                <p class="text-sm text-gray-500"></p>
            </div>
            <div class="hightlight hidden lg:block"></div>
        </div>
    </GuestLayout>
</template>

<script>
import Spinner from "../components/Widgets/Spinner.vue";
import Logo from "../components/Icons/Logo.vue";
import { useAuthStore } from "../store/useAuth";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import { useRouter } from "vue-router";
import GuestLayout from "../layouts/GuestLayout.vue";

export default {
    components: { Spinner, Logo, GuestLayout },
    setup() {
        const store = useAuthStore();
        const router = useRouter();
        const { getErrors, isBusy, isAuthenticated } = storeToRefs(store);
        let data = ref({ email: "user@example.com", password: "password" });
        let serverErrors = ref({ email: null });

        const validate = () => {
            let valid = true;
            // const re = /\S+@\S+\.\S+/;
            // this.clearErrors();
            // if (!re.test(data.email)) {
            //     serverErrors.value.email = "Invalid email address";
            //     valid = false;
            // }
            return valid;
        };

        const submitForm = () => {
            const valid = validate();
            if (!valid) return;
            store.login(data.value);

            // window.location.href = "/subscribers";
            window.location.replace("/subscribers");

            // router.push("/subscribers");
            // if (store.isAuthenticated) {
            //     router.push("/subscribers");
            // } else {
            //     // console.log(getErrors);
            //     console.log("getErrors");
            // }
        };

        return { isBusy, serverErrors, submitForm, data };
    },
};
</script>

<style lang="scss" scoped>
.hightlight {
    background-image: url("../assets/images/login-bg.svg");
}
</style>
