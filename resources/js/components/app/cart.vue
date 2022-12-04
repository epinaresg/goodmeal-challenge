<script>
import TitleBar from "@/components/app/titleBar.vue";
import StoreDetail from "@/components/app/cart/storeDetail.vue";
import CartDetail from "@/components/app/cart/cartDetail.vue";
import CartForm from "@/components/app/cart/cartForm.vue";

export default {
    data() {
        return {
            store: {},
            cart: {},
            form: {
                type: "",
            },
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
        closeCart() {
            axios
                .post(
                    "/stores/" + this.$route.params.storeId + "/carts/close",
                    {
                        type: this.form.type,
                    }
                )
                .then((response) => {
                    this.$router.push("/cart/close/success");
                })
                .catch((error) => {
                    console.log(error);
                    alert(error.response.data.message);
                });
        },
    },
    components: {
        TitleBar,
        StoreDetail,
        CartDetail,
        CartForm,
    },
};
</script>

<template>
    <TitleBar
        :title="'Carrito de compra'"
        :backUrl="'/store/' + this.$route.params.storeId"
    />
    <StoreDetail :store="store" />

    <hr />

    <CartForm :form="form" :cart="cart" />

    <hr />

    <CartDetail :form="form" :cart="cart" />

    <hr />
    <div class="px-3">
        <button
            v-on:click="closeCart"
            type="button"
            class="btn btn-primary btn-block mb-2"
        >
            Registrar orden
        </button>
    </div>
</template>
