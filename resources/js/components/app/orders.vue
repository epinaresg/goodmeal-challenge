<script>
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";
import ListOrders from "@/components/app/orders/listOrders.vue";
import TitleBar from "@/components/app/titleBar.vue";

export default {
    data() {
        return {
            orders: [],
        };
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders() {
            axios
                .get("/orders")
                .then((response) => {
                    this.orders = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        HomeBottomMenu,
        TitleBar,
        ListOrders,
    },
};
</script>

<template>
    <div class="container-fluid h-100">
        <div class="titleHeaderBar py-4">
            <span class="title fs-16"> Mis órdenes </span>
        </div>

        <ListOrders :orders="orders" />

        <HomeBottomMenu :active="'orders'" />
    </div>
</template>
