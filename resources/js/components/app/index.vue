<script>
import StoreItem from "@/components/app/storeItem.vue";

import axios from "axios";

export default {
    data() {
        return {
            storesWithStock: [],
            storesWithoutStock: [],
        };
    },
    mounted() {
        this.listStores();
    },
    methods: {
        listStores() {
            axios
                .get("/stores")
                .then((response) => {
                    this.storesWithStock = response.data.with_stock;
                    this.storesWithoutStock = response.data.without_stock;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        StoreItem,
    },
};
</script>

<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="addressBar pt-4 pb-2">
                    <span class="icon p-2">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <span class="addressText">
                        Calle Cristobal Colon Mz.A Lt.20 Urb. Pablo Canepa, La
                        Molina
                    </span>
                    <span class="icon p-2">
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="tabsContainer">
                    <div
                        class="nav nav-pills"
                        id="v-pills-tab"
                        role="tablist"
                        aria-orientation="horizontal"
                    >
                        <a
                            class="nav-link active"
                            id="v-pills-home-tab"
                            data-toggle="pill"
                            href="#v-pills-home"
                            role="tab"
                            aria-controls="v-pills-home"
                            aria-selected="true"
                            >Con stock</a
                        >
                        <a
                            class="nav-link"
                            id="v-pills-profile-tab"
                            data-toggle="pill"
                            href="#v-pills-profile"
                            role="tab"
                            aria-controls="v-pills-profile"
                            aria-selected="false"
                            >Sin stock</a
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="itemsContainer">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="v-pills-home"
                            role="tabpanel"
                            aria-labelledby="v-pills-home-tab"
                        >
                            <div v-for="item in storesWithStock" :key="item.id">
                                <StoreItem :item="item" />
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="v-pills-profile"
                            role="tabpanel"
                            aria-labelledby="v-pills-profile-tab"
                        >
                            <div
                                class="mb-4"
                                v-for="item in storesWithoutStock"
                                :key="item.id"
                            >
                                <StoreItem :item="item" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bottomMenuContainer">
            <div class="col-4">
                <a class="active" href="">
                    <i class="fa-regular fa-user"></i>
                    <span>Inicio</span>
                </a>
            </div>
            <div class="col-4">
                <a href="">
                    <i class="fa-regular fa-user"></i>
                    <span>Ordenes</span>
                </a>
            </div>
            <div class="col-4">
                <a href="">
                    <i class="fa-regular fa-user"></i>
                    <span>Perfil</span>
                </a>
            </div>
        </div>
    </div>
</template>
