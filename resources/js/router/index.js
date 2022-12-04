import { createRouter, createWebHistory } from "vue-router";

import appIndex from "@/components/app/index.vue";
import notFound from "@/components/app/notFound.vue";

import orders from "@/components/app/orders.vue";
import showOrder from "@/components/app/showOrder.vue";

import profile from "@/components/app/profile.vue";

import cart from "@/components/app/cart.vue";
import cartSuccess from "@/components/app/cartSuccess.vue";

import store from "@/components/app/store.vue";

const routes = [
    {
        path: "/",
        component: appIndex,
    },
    {
        path: "/store/:storeId",
        component: store,
    },
    {
        path: "/orders",
        component: orders,
    },
    {
        path: "/orders/:orderId",
        component: showOrder,
    },
    {
        path: "/profile",
        component: profile,
    },
    {
        path: "/cart/close/success",
        component: cartSuccess,
    },
    {
        path: "/cart/:storeId",
        component: cart,
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
