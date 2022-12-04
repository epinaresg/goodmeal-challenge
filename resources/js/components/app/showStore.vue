<script>
import StoreBar from "@/components/app/showStore/storeBar.vue";
import StoreBackground from "@/components/app/showStore/storeBackground.vue";
import StoreDetail from "@/components/app/showStore/storeDetail.vue";
import ListProducts from "@/components/app/showStore/listProducts.vue";

import axios from "axios";

export default {
    data() {
        return {
            store: {},
            products: [],
        };
    },
    mounted() {
        this.getStore();
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
    },
    components: {
        StoreBar,
        StoreBackground,
        StoreDetail,
        ListProducts,
    },
};
</script>

<template>
    <StoreBar :store="store" />

    <StoreBackground :store="store" />

    <StoreDetail :store="store" />

    <ListProducts :products="products" />

    <div class="px-3">
        <button type="button" class="btn btn-primary btn-block mb-2" disabled>
            Comprar
        </button>
    </div>
</template>
