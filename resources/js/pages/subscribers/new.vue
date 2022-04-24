<template>
    <AuthenticatedLayout>
        <div>
            <title-bar page-title="New subcriber" back />
            <div class="container mx-auto">
                <form
                    autocomplete="off"
                    class="py-4 px-4 md:px-8"
                    @submit.prevent="submitForm"
                >
                    <div class="mb-4">
                        <label for="name" class="block leading-8"> Name </label>
                        <input
                            id="name"
                            v-model="data.name"
                            type="text"
                            class="py-3 px-6 border block w-full ring-secondary-500 focus:ring-2 transition rounded focus:outline-none"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block leading-8">
                            Email
                        </label>
                        <input
                            id="email"
                            v-model="data.email"
                            type="text"
                            class="py-3 px-6 border block w-full ring-secondary-500 focus:ring-2 transition rounded focus:outline-none"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block leading-8">
                            Address
                        </label>
                        <input
                            id="address"
                            v-model="data.address"
                            type="text"
                            class="py-3 px-6 border block w-full ring-secondary-500 focus:ring-2 transition rounded focus:outline-none"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label for="state" class="block leading-8">
                            State
                        </label>
                        <select
                            id="state"
                            required
                            v-model="data.state"
                            class="px-6 h-12 w-full bg-white border block ring-secondary-500 focus:ring-2 transition rounded-md focus:outline-none"
                        >
                            <option selected disabled>- Select state -</option>
                            <option value="active">Active</option>
                            <option value="bounced">Bounced</option>
                            <option value="unsubscribed">Unsubscribed</option>
                            <option value="junk">Junk</option>
                            <option value="unkconfirmed">Unconfirmed</option>
                        </select>
                    </div>
                    <!-- Dynamic fields start -->
                    <div
                        class="mb-4"
                        v-for="(field, index) in formFields"
                        :key="index"
                    >
                        <label for="fields[]" class="block leading-8">
                            {{ field.data.attributes.slug }}
                        </label>

                        <input
                            id="fields[]"
                            v-model="data.fields[field.data.attributes.slug]"
                            type="text"
                            class="py-3 px-6 border block w-full ring-secondary-500 focus:ring-2 transition rounded focus:outline-none"
                            required
                        />
                    </div>
                    <!-- Dynamic fields end -->
                    <button
                        class="mt-6 ml-auto py-3 px-6 block w-full md:w-max text-white shadow-md transition rounded bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' focus:outline-none"
                    >
                        <span v-if="!isBusy"> Create </span>
                        <spinner v-else class="mx-auto" />
                    </button>
                    <div v-if="dynamicFields && dynamicFields.length > 0">
                        <p class="font-bold text-lg">Add extra field</p>
                        <span
                            v-for="(field, index) in dynamicFields"
                            :key="index"
                            class="inline-grid gap-4"
                        >
                            <span
                                class="cursor-pointer mt-2 ml-auto py-3 px-2 text-sm text-white shadow-md transition rounded bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' focus:outline-none"
                                @click="addNewField(field)"
                            >
                                <span v-if="!busy">
                                    {{ field.data.attributes.slug }}
                                </span>
                                <spinner v-else class="mx-auto" />
                            </span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { storeToRefs } from "pinia";
import { computed, ref, watch } from "vue";
import { useRouter } from "vue-router";
import TitleBar from "../../components/Navigation/TitleBar.vue";
import Spinner from "../../components/Widgets/Spinner.vue";
import { useFieldStore } from "../../store/useFields";
import { useSubscriberStore } from "../../store/useSubscribers";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

export default {
    components: { TitleBar, Spinner, AuthenticatedLayout },
    setup() {
        const storeField = useFieldStore();
        const router = useRouter();
        const store = useSubscriberStore();
        let dynamicFields = ref([]);
        let formFields = ref([]);

        let data = ref({
            name: "",
            address: "",
            email: "",
            fields: [{ country: "Geneva" }],
            state: "- Select state -",
        });

        //Fetch fields
        storeField.fetchFields();

        const { fields, busy } = storeToRefs(storeField);

        watch(fields, (fetchedFields) => {
            fetchedFields.forEach((field) => {
                dynamicFields.value.push(field);
            });
        });

        const { isBusy } = storeToRefs(store);

        const addNewField = (field) => {
            // push to form field array to collect user values from form
            const slug = field.data.attributes.slug;
            let fieldObject = {};
            fieldObject[slug] = "";
            data.value.fields.push(fieldObject);

            // For use in creating the actual input field
            formFields.value.push(field);

            // Remove from dynamic fields so as not to be added twice
            const fieldIndex = dynamicFields.value.indexOf(field);
            dynamicFields.value.splice(fieldIndex, 1);
        };

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
            if (!data.value.fields.length > 0) {
                delete data.value.fields;
            }
            console.log(data.value.fields);
            const valid = validate();
            if (!valid) return;
            store.createSubscriber(data.value);
            router.push("/subscribers");
        };

        return {
            data,
            isBusy,
            busy,
            submitForm,
            dynamicFields,
            addNewField,
            formFields,
        };
    },
};
</script>
