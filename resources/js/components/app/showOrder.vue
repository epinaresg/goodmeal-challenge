<script>
import TitleBar from "@/components/app/titleBar.vue";

export default {
    data() {
        return {
            order: {},
        };
    },
    mounted() {
        this.getOrder();
    },
    methods: {
        getOrder() {
            axios
                .get("/orders/" + this.$route.params.orderId)
                .then((response) => {
                    this.order = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        TitleBar,
    },
};
</script>

<template>
    <div class="container-fluid h-100">
        <TitleBar :title="'Detalle de la orden'" :backUrl="'/orders'" />

        <div class="orderContainer">
            <div class="py-3 mx-2">
                <div class="position-relative orderItem py-3 px-4">
                    <span class="orderState position-absolute fs-14">
                        {{ order.state }}
                    </span>

                    <div class="fs-18 mb-3 mt-4">
                        <strong>{{ order.store_name }}</strong>
                    </div>

                    <div class="fs-15">
                        <strong>Dirección: </strong> {{ order.store_address }}
                    </div>

                    <div class="fs-15">
                        <strong>Tipo de orden: </strong>
                        {{
                            order.order_type == "delivery"
                                ? "Delivery"
                                : "Retiro en tienda"
                        }}
                    </div>

                    <div class="fs-15">
                        <strong
                            >Fecha de
                            {{
                                order.order_type == "delivery"
                                    ? "entrega"
                                    : "retiro"
                            }}:
                        </strong>
                        <span class="fs-14"> {{ order.order_date }}</span>
                    </div>
                    <div class="fs-15">
                        <strong
                            >Hora de
                            {{
                                order.order_type == "delivery"
                                    ? "entrega"
                                    : "retiro"
                            }}:
                        </strong>
                        <span class="fs-14"> {{ order.order_time }}</span>
                    </div>

                    <div class="fs-15">
                        <strong>Nº de orden: </strong>
                        <span class="fs-14"> {{ order.code }}</span>
                    </div>

                    <hr />

                    <div>
                        <div class="mb-2"><strong>Productos</strong></div>
                        <div
                            class="row fs-14"
                            v-for="product in order.products"
                            :key="product.id"
                        >
                            <div class="col-1 text-left">{{ product.qty }}</div>
                            <div class="col-7">{{ product.name }}</div>
                            <div class="col-4 text-right">
                                ${{ product.total }}
                            </div>
                        </div>

                        <hr />

                        <div
                            v-if="order.order_type === 'delivery'"
                            class="row mt-2"
                        >
                            <div class="col-6 fs-14">Delivery</div>
                            <div class="col-6 text-right fs-14">
                                ${{ order.total_delivery }}
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-6 fs-15">
                                <strong>Monto total</strong>
                            </div>
                            <div class="col-6 text-right fs-15">
                                <strong>${{ order.total }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
