import axios from "axios";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("mainAuth", {
    state: () => ({
        errors: [],
        busy: false,
        authenticated: false,
    }),
    getters: {
        getErrors: (state) => state.errors,
        isBusy: (state) => state.busy,
        isAuthenticated: (state) => state.authenticated,
    },
    actions: {
        async login(data) {
            this.busy = true;

            try {
                const response = await axios.post(
                    `${process.env.MIX_APP_URL}/api/login`,
                    data
                );

                localStorage.setItem("token", response.data.token);
                this.busy = false;
                this.authenticated = true;
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors.meta;
                    console.log(error.response.data.errors.meta);
                    this.busy = false;
                }
            }
        },
        async logout(data) {
            this.busy = true;
            try {
                const response = await axios.post(
                    `${process.env.MIX_APP_URL}/api/logout`
                );
                localStorage.removeItem("token");
                this.busy = false;
                this.authenticated = false;
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors.meta;
                    console.log(error.response.data.errors.meta);
                    this.busy = false;
                }
            }
        },
    },
});
