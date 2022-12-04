<script>
import OrderItem from "@/components/app/orders/orderItem.vue";

export default {
    props: ["orders"],
    components: {
        OrderItem,
    },
};
</script>

<template>
    <div v-if="orders.length == 0" class="orderContainer">
        <div class="pt-4 text-center">
            <strong> No tiene ordenes registradas.</strong>
        </div>
    </div>
    <div v-else class="orderContainer">
        <div class="py-3" v-for="order in orders" :key="order.id">
            <div class="position-relative orderItem py-3 px-4">
                <OrderItem :order="order" />
            </div>
        </div>
    </div>
</template>
