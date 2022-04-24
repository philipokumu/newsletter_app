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
                <div v-if="subscriber">
                    <TitleBar page-title="Back to list" back />
                    <div class="w-full shadow-md rounded overflow-x-auto">
                        <table class="w-full divide-y">
                            <thead class="bg-gray-100 text-gray-500">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Title
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Value
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                <!-- <tr
                                v-for="(subscriber, index) in categories"
                                :key="index"
                            > -->
                                <tr>
                                    <td
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Name
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ subscriber.attributes.name }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Email
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ subscriber.attributes.email }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        Address
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ subscriber.attributes.address }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        State
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{ subscriber.attributes.state }}
                                        </p>
                                    </td>
                                </tr>
                                <span
                                    v-if="
                                        subscriber.attributes.fieldDetails.data
                                            .length > 0
                                    "
                                >
                                </span>
                                <tr
                                    v-for="(subFields, index) in subscriber
                                        .attributes.fieldDetails.data"
                                    :key="index"
                                >
                                    <td
                                        class="px-6 py-3 text-left text-sm font-normal uppercase tracking-wider whitespace-nowrap"
                                    >
                                        {{ subFields.data.attributes.value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>
                                            {{
                                                subFields.data.attributes
                                                    .field_value
                                            }}
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
                            No subscriber with this ID.
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
import { useSubscriberStore } from "../../store/useSubscribers";
import TitleBar from "../../components/Navigation/TitleBar.vue";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

export default {
    components: { TitleBar, AuthenticatedLayout },
    setup() {
        const route = useRoute();
        const store = useSubscriberStore();

        const subscriber_id = route.params.id;

        store.fetchSubscriber(subscriber_id);

        const { subscriber, isBusy } = storeToRefs(store);

        return {
            subscriber,
            isBusy,
        };
    },
};
</script>
