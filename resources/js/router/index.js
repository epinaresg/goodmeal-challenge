import { createRouter, createWebHistory } from "vue-router";

import appIndex from "@/components/app/index.vue";
import notFound from "@/components/app/notFound.vue";

const routes = [
    {
        path: "/",
        component: appIndex,
    },
    {
        path: "/:pathMatch(.*)*",
        component: notFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
