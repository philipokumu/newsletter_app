import axios from "axios";
import { defineStore } from "pinia";

export const useSubscriberStore = defineStore("mainSubscriber", {
    state: () => ({
        subscribers: [],
        subscriber: {},
        busy: false,
    }),
    getters: {
        getSubscribers: (state) => state.subscribers,
        getSubscriber: (state) => state.subscriber,
        isBusy: (state) => state.busy,
    },
    actions: {
        async fetchSubscribers() {
            // console.log(localStorage.getItem("token"));
            try {
                const response = await axios.get(
                    `${process.env.MIX_APP_URL}/api/subscribers`
                );
                this.subscribers = response.data.data;
                this.busy = false;
            } catch (error) {
                console.log(error);
            }
        },
        async fetchSubscriber(subscriber_id) {
            this.busy = true;
            try {
                const response = await axios.get(
                    `${process.env.MIX_APP_URL}/api/subscribers/${subscriber_id}`
                );
                this.subscriber = response.data.data;
                this.busy = false;
            } catch (error) {
                console.log(error);
            }
        },
        async createSubscriber(data) {
            this.busy = true;
            try {
                const response = await axios.post(
                    `${process.env.MIX_APP_URL}/api/subscribers`,
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
