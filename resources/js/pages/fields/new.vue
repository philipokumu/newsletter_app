<template>
    <AuthenticatedLayout>
        <div>
            <title-bar page-title="New field" back />
            <div class="container mx-auto">
                <form
                    autocomplete="off"
                    class="py-4 px-4 md:px-8"
                    @submit.prevent="submitForm"
                >
                    <div class="mb-4">
                        <label for="name" class="block leading-8">
                            Value
                        </label>
                        <input
                            id="name"
                            v-model="data.value"
                            type="text"
                            class="py-3 px-6 border block w-full ring-secondary-500 focus:ring-2 transition rounded focus:outline-none"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label for="unit" class="block leading-8"> Type </label>
                        <select
                            id="unit"
                            required
                            v-model="data.type"
                            class="px-6 h-12 w-full bg-white border block ring-secondary-500 focus:ring-2 transition rounded-md focus:outline-none"
                        >
                            <option selected disabled>- Select type -</option>
                            <option value="string">String</option>
                            <option value="boolean">Boolean</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                    <button
                        class="mt-6 ml-auto py-3 px-6 block w-full md:w-max text-white shadow-md transition rounded bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' focus:outline-none"
                    >
                        <span v-if="!isBusy"> Create </span>
                        <spinner v-else class="mx-auto" />
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { storeToRefs } from "pinia";
import { ref } from "vue";
import { useRouter } from "vue-router";
import TitleBar from "../../components/Navigation/TitleBar.vue";
import Spinner from "../../components/Widgets/Spinner.vue";
import { useFieldStore } from "../../store/useFields";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

export default {
    components: { TitleBar, Spinner, AuthenticatedLayout },
    setup() {
        const changed = ref(false);
        let data = ref({ value: "", type: "- Select type -" });
        const router = useRouter();

        const store = useFieldStore();

        const { isBusy } = storeToRefs(store);

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
            store.createField(data.value);
            router.push("/fields");
        };

        return { changed, data, isBusy, submitForm };
    },
};
</script>
