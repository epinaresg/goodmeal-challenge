<script>
import axios from "axios";

export default {
    props: ["item", "store"],
    methods: {
        addProduct(productId) {
            axios
                .post("/stores/" + this.$route.params.storeId + "/carts", {
                    product_id: productId,
                })
                .then((response) => {
                    this.$parent.$parent.getCart();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<template>
    <div class="card position-relative">
        <span
            v-if="store.products_with_stock > 0"
            v-on:click="addProduct(item.id)"
            class="position-absolute btnAddToCart"
        >
            <i class="fa-solid fa-circle-plus"></i>
        </span>
        <img class="card-img-top" :src="item.image" />
        <div class="card-body">
            <div>
                <div class="priceDiscount mb-2">
                    <span class="withoutDiscount fs-15">
                        <strong> ${{ item.price_with_discount }} </strong>
                    </span>
                    <span
                        v-if="item.price_without_discount > 0"
                        class="withDiscount fs-14"
                    >
                        <strong> ${{ item.price_without_discount }} </strong>
                    </span>
                </div>
            </div>

            <div class="card-title fs-15">
                {{ item.name }}
            </div>
        </div>
    </div>
</template>
