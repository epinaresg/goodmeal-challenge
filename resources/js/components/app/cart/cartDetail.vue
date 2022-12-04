<script>
export default {
    props: ["form", "cart"],
};
</script>
<template>
    <div class="px-4 mb-3 cartDetailContainer">
        <div class="mb-2"><strong>Productos</strong></div>
        <div
            class="row fs-14"
            v-for="product in cart.products"
            :key="product.id"
        >
            <div class="col-1 text-left">{{ product.qty }}</div>
            <div class="col-7">{{ product.name }}</div>
            <div class="col-4 text-right">${{ product.total }}</div>
        </div>

        <hr />

        <div v-if="form.type === 'delivery'" class="row mt-2">
            <div class="col-6 fs-14">Delivery</div>
            <div class="col-6 text-right fs-14">${{ cart.total_delivery }}</div>
        </div>
        <div class="row mt-1">
            <div class="col-6 fs-15"><strong>Monto total</strong></div>
            <div class="col-6 text-right fs-15">
                <strong
                    >${{
                        form.type === "delivery"
                            ? cart.total_with_delivery
                            : cart.total
                    }}</strong
                >
            </div>
        </div>
    </div>
</template>
