<template>
    <AuthenticatedLayout>
        <div class="py-4 px-4 md:px-8">
            <div v-if="isBusy">
                <div
                    class="clone mb-4 relative h-12 rounded-lg bg-gray-100 overflow-hidden"
                ></div>
                <div
                    class="clone mb-4 relative bg-gray-100 rounded-lg overflow-hidden"
                >
                    <div class="h-12 border-b border-white"></div>
                    <div class="h-12"></div>
                    <div class="h-12"></div>
                </div>
                <div
                    class="clone mb-4 relative h-12 rounded-lg bg-gray-100 overflow-hidden"
                ></div>
            </div>
            <div v-else>
                <div v-if="field">
                    <TitleBar page-title="Back to list" back />
                    <div class="w-full shadow-md rounded overflow-x-auto">
                        <table class="w-full divide-y">
                            <thead class="bg-gray-100 text-gray-500">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Value
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Type
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ field.attributes.value }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ field.attributes.type }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-else class="flex flex-col items-center justify-center">
                    <div class="mb-4">
                        <p
                            class="text-center font-poppins text-2xl font-semibold"
                        >
                            No field with this ID.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { useRoute } from "vue-router";
import { storeToRefs } from "pinia";
import { useFieldStore } from "../../store/useFields";
import TitleBar from "../../components/Navigation/TitleBar.vue";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

export default {
    components: { TitleBar, AuthenticatedLayout },
    setup() {
        const route = useRoute();
        const store = useFieldStore();

        const field_slug = route.params.slug;

        store.fetchField(field_slug);

        const { field, isBusy } = storeToRefs(store);

        return {
            field,
            isBusy,
        };
    },
};
</script>
