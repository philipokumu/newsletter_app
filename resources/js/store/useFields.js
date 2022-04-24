import axios from "axios";
import { defineStore } from "pinia";

export const useFieldStore = defineStore("mainField", {
    state: () => ({
        fields: [],
        field: {},
        busy: false,
        errors: null,
    }),
    getters: {
        getFields: (state) => state.fields,
        getField: (state) => state.field,
        isBusy: (state) => state.busy,
    },
    actions: {
        async fetchFields() {
            try {
                const response = await axios.get(
                    `${process.env.MIX_APP_URL}/api/fields`
                );
                this.fields = response.data.data;
                this.busy = false;
            } catch (error) {
                console.log(error);
            }
        },
        async fetchField(field_slug) {
            this.busy = true;
            try {
                const response = await axios.get(
                    `${process.env.MIX_APP_URL}/api/fields/${field_slug}`
                );
                this.field = response.data.data;
                this.busy = false;
            } catch (error) {
                console.log(error);
            }
        },
        async createField(data) {
            this.busy = true;
            try {
                const response = await axios.post(
                    `${process.env.MIX_APP_URL}/api/fields`,
                    data
                );
                this.busy = false;
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors.meta;
                    console.log(error.response.data.errors.meta);
                }
            }
        },
    },
});
