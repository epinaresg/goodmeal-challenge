<script>
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
    components: {},
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
        <span class="icon pr-4 float-right fs-18">
            <i class="fa-solid fa-cart-shopping"></i>
        </span>
    </div>

    <div
        class="storeBackground"
        :style="{ backgroundImage: 'url(' + store.background + ')' }"
    >
        <div class="logo">
            <img :src="store.logo" alt="Logo" />
        </div>
    </div>

    <div class="storeDetail px-4 mb-2">
        <div class="mt-3 mb-2"><strong>Acerda de la tienda</strong></div>

        <div class="d-flex flex-row mb-1">
            <span class="pr-2 w-icon align-middle">
                <i class="fa-solid fa-location-dot"></i>
            </span>

            <span class="fs-14 fc-primary align-middle">{{
                store.address
            }}</span>
        </div>

        <div class="d-flex flex-row mb-1">
            <span class="pr-2 w-icon">
                <i class="fs-13 fa-solid fa-clock"></i>
            </span>

            <span class="fs-14">
                <span
                    class="d-block fs-14"
                    v-for="schedule in store.schedules"
                    :key="schedule.id"
                >
                    Horario de
                    <span class="fs-14" v-if="schedule.type === 'take_out'"
                        >retiro</span
                    >
                    <span class="fs-14" v-else>delivery</span>: Hoy
                    {{ schedule.start_hour }} a {{ schedule.end_hour }}
                    hrs
                </span>
            </span>
        </div>

        <div class="storeRating">
            <strong class="pr-3 fs-15">Calificación</strong>
            <span class="pr-1 fs-14">
                <i class="fa-solid fa-star fc-primary"></i>
            </span>
            <span class="fs-14"> {{ store.rating }} / 5 </span>
        </div>
    </div>

    <div class="listProductsContainer">
        <div class="categoryTabsContainer">
            <div class="slideContainer">
                <div
                    class="nav nav-pills mb-2"
                    id="v-pills-tab"
                    role="tablist"
                    aria-orientation="horizontal"
                >
                    <a
                        v-for="(product, key) in products"
                        :key="product.category_id"
                        class="nav-link"
                        :class="key == 0 ? 'active' : ''"
                        :id="'v-' + product.category_id + '-tab'"
                        data-toggle="pill"
                        :href="'#v-' + product.category_id"
                        role="tab"
                        >{{ product.category_name }}</a
                    >
                </div>
            </div>
        </div>

        <div class="productItemsContainer px-3 mt-2">
            <div class="tab-content mt-2" id="v-pills-tabContent">
                <div
                    v-for="(product, key) in products"
                    :key="product.category_id"
                    class="tab-pane fade show"
                    :class="key == 0 ? 'active' : ''"
                    :id="'v-' + product.category_id"
                    role="tabpanel"
                >
                    <div class="row w-100 mx-auto">
                        <div
                            class="col-lg-3 col-md-4 col-6 px-2 mt-2 mb-3"
                            v-for="item in product.items"
                            :key="item.id"
                        >
                            <div class="card position-relative">
                                <span class="position-absolute btnAddToCart">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </span>
                                <img class="card-img-top" :src="item.image" />
                                <div class="card-body">
                                    <div>
                                        <div class="priceDiscount mb-2">
                                            <span class="withoutDiscount fs-15">
                                                <strong>
                                                    ${{
                                                        item.price_with_discount
                                                    }}
                                                </strong>
                                            </span>
                                            <span
                                                v-if="
                                                    item.price_without_discount >
                                                    0
                                                "
                                                class="withDiscount fs-14"
                                            >
                                                <strong>
                                                    ${{
                                                        item.price_without_discount
                                                    }}
                                                </strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="card-title fs-15">
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-3">
        <button type="button" class="btn btn-primary btn-block mb-2" disabled>
            Comprar
        </button>
    </div>
</template>
