<script>
import StoreBar from "@/components/app/showStore/storeBar.vue";
import StoreBackground from "@/components/app/showStore/storeBackground.vue";
import StoreDetail from "@/components/app/showStore/storeDetail.vue";
import ListProducts from "@/components/app/showStore/listProducts.vue";
import NoStockModal from "@/components/app/showStore/noStockModal.vue";

import axios from "axios";

export default {
    data() {
        return {
            store: {},
            products: [],
            cart: {},
        };
    },
    mounted() {
        this.getStore();
        this.getCart();
    },
    methods: {
        getStore() {
            axios
                .get("/stores/" + this.$route.params.storeId)
                .then((response) => {
                    this.store = response.data.store;
                    this.products = response.data.products;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCart() {
            axios
                .get("/stores/" + this.$route.params.storeId + "/carts")
                .then((response) => {
                    this.cart = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        StoreBar,
        StoreBackground,
        StoreDetail,
        ListProducts,
        NoStockModal,
    },
};
</script>

<template>
    <div class="container-fluid h-100">
        <NoStockModal :store="store" />

        <StoreBar :store="store" :cart="cart" />

        <StoreBackground :store="store" />

        <StoreDetail :store="store" />

        <ListProducts :store="store" :products="products" />

        <div class="px-3">
            <router-link :to="'/cart/' + store.id">
                <button
                    type="button"
                    class="btn btn-primary btn-block mb-2"
                    :disabled="cart.qty_products > 0 ? false : true"
                >
                    Comprar
                </button>
            </router-link>
        </div>
    </div>
</template>
