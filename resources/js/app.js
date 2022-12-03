import "./bootstrap";

import { createApp } from "vue";

import app from "@/components/app.vue";

import router from "./router";

import axios from "axios";

axios.defaults.baseURL = "http://localhost/api/";

const appVue = createApp(app);
appVue.use(router);
appVue.mount("#app");
