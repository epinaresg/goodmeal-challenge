<script>
import StoreItem from "@/components/app/storeItem.vue";
import AddressModal from "@/components/app/addressModal.vue";
import AddressBar from "@/components/app/addressBar.vue";
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";

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
        AddressModal,
        AddressBar,
        HomeBottomMenu,
    },
};
</script>

<template>
    <div class="container-fluid">
        <AddressBar />
        <AddressModal />

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

        <HomeBottomMenu />
    </div>
</template>
