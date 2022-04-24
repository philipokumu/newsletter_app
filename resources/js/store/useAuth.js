import axios from "axios";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("mainAuth", {
    state: () => ({
        errors: [],
        busy: false,
        authenticated: false,
    }),
    getters: {
        serverErrors: (state) => state.errors,
        isBusy: (state) => state.busy,
        isAuthenticated: (state) => state.authenticated,
    },
    actions: {
        login(data) {
            this.busy = true;

            axios
                .post(`${process.env.MIX_APP_URL}/api/login`, data)
                .then((response) => {
                    localStorage.setItem("token", response.data.token);
                    this.authenticated = true;
                    this.busy = false;
                })
                .catch((e) => {
                    localStorage.removeItem("token");
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors.meta;
                        this.busy = false;
                    }
                });
        },
        logout() {
            this.busy = true;

            axios
                .post(`${process.env.MIX_APP_URL}/api/logout`)
                .then((response) => {
                    localStorage.removeItem("token");
                    this.busy = false;
                    this.authenticated = false;
                })
                .catch((e) => {
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors.meta;
                        this.busy = false;
                    }
                });
        },
    },
});
