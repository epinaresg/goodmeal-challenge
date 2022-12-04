<script>
export default {
    props: ["store", "cart"],

    methods: {
        goTo() {
            if (this.store.products_with_stock > 0)
                this.$router.push("/cart/" + this.store.id);
        },
    },
};
</script>

<template>
    <div class="storeHeaderBar py-4">
        <router-link to="/">
            <span class="icon pl-4 float-left fs-18">
                <i class="fa-solid fa-left-long"></i>
            </span>
        </router-link>
        <span class="title fs-16">
            {{ store.name }}
        </span>
        <a class="btnCart" v-on:click="goTo">
            <span class="icon pr-4 float-right fs-18 position-relative">
                <i class="fa-solid fa-cart-shopping"></i>
                <span v-if="cart.qty_products" class="qtyProducts">
                    {{ cart.qty_products }}
                </span>
            </span>
        </a>
    </div>
</template>
