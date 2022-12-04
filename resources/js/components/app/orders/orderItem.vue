<script>
export default {
    props: ["order"],
};
</script>

<template>
    <span class="orderState position-absolute fs-14">
        {{ order.state }}
    </span>

    <div class="fs-16 mb-1">
        <strong class="fc-primary">{{ order.order_date }}</strong>
    </div>
    <div class="fs-15">
        <strong>Tipo de orden: </strong>
        {{ order.order_type == "delivery" ? "Delivery" : "Retiro en tienda" }}
    </div>
    <div class="fs-15"><strong>Tienda: </strong> {{ order.store_name }}</div>
    <div class="fs-15">
        <strong>Nº de orden: </strong>
        <span class="fs-14"> {{ order.code }}</span>
    </div>
    <div class="fs-15">
        <strong>Monto total: </strong>
        <span class="fs-14"> ${{ order.total }}</span>
    </div>
    <div class="fs-15">
        <strong>Horario: </strong>
        <span class="fs-14"> {{ order.order_time }}</span>
    </div>
    <router-link class="position-absolute goToOrder" :to="'orders/' + order.id">
        <i class="fa-solid fa-circle-chevron-right"></i>
    </router-link>
</template>
