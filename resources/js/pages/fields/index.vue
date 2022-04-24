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
                <div v-if="fields && fields.length > 0">
                    <div class="mb-4 flex items-center justify-end">
                        <router-link
                            to="/fields/new"
                            class="py-2 px-4 flex items-center bg-secondary-600 text-white shadow-md hover:bg-secondary-700 focus:bg-secondary-700 transition rounded focus:outline-none"
                        >
                            Add New
                        </router-link>
                    </div>
                    <div class="w-full shadow-md rounded overflow-x-auto">
                        <table class="w-full divide-y">
                            <thead class="bg-gray-100 text-gray-500">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Value
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Type
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                <tr
                                    v-for="(field, index) in fields"
                                    :key="index"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ field.data.attributes.value }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ field.data.attributes.type }}
                                        </p>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm whitespace-nowrap text-right"
                                    >
                                        <router-link
                                            :to="`/fields/${field.data.attributes.slug}`"
                                            class="ml-2 inline-block text-green-500 hover:text-green-600 focus:text-green-600 focus:outline-none"
                                        >
                                            View
                                        </router-link>
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
                            No fields yet.
                        </p>
                    </div>
                    <router-link
                        to="/fields/new"
                        class="py-3 px-6 flex items-center bg-secondary-600 text-white shadow-md hover:bg-secondary-700 focus:bg-secondary-700 transition rounded focus:outline-none"
                    >
                        Add New
                    </router-link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { storeToRefs } from "pinia";
import { useFieldStore } from "../../store/useFields";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";
export default {
    components: { AuthenticatedLayout },
    setup() {
        const store = useFieldStore();
        store.fetchFields();
        const { fields, isBusy } = storeToRefs(store);
        return { fields, isBusy };
    },
    components: { AuthenticatedLayout },
};
</script>
