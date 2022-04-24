require("./bootstrap");

import { createApp } from "vue";
import App from "./app.vue";
import router from "./router";
import { createPinia } from "pinia";

const app = createApp({});

app.component("App", App);

app.use(router).use(createPinia()).mount("#app");
