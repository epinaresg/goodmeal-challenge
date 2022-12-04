import { createRouter, createWebHistory } from "vue-router";

import appIndex from "@/components/app/index.vue";
import notFound from "@/components/app/notFound.vue";

import orders from "@/components/app/orders.vue";
import profile from "@/components/app/profile.vue";

import showStore from "@/components/app/showStore.vue";

const routes = [
    {
        path: "/",
        component: appIndex,
    },
    {
        path: "/store/:storeId",
        component: showStore,
    },
    {
        path: "/orders",
        component: orders,
    },
    {
        path: "/profile",
        component: profile,
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
