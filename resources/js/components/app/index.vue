<script>
import AddressModal from "@/components/app/addressBar/addressModal.vue";
import AddressBar from "@/components/app/addressBar/addressBar.vue";
import ListStore from "@/components/app/listStores/listStore.vue";
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";

import axios from "axios";

export default {
    data() {
        return {
            storesWithStock: [],
            storesWithoutStock: [],
            address_id: "",
            address: "--------",
            latitude: "",
            longitude: "",
        };
    },
    mounted() {
        this.getAddress();
    },
    methods: {
        listStores() {
            axios
                .get("/stores?address_id=" + this.address_id)
                .then((response) => {
                    this.storesWithStock = response.data.with_stock;
                    this.storesWithoutStock = response.data.without_stock;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getAddress() {
            axios
                .get("/addresses")
                .then((response) => {
                    if (response.data.address) {
                        this.address_id = response.data.id;
                        this.address = response.data.address;
                        this.latitude = response.data.latitude;
                        this.longitude = response.data.longitude;
                    } else this.address = "Sin dirección";

                    this.listStores();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: {
        AddressModal,
        AddressBar,
        HomeBottomMenu,
        ListStore,
    },
};
</script>

<template>
    <div class="container-fluid h-100">
        <AddressBar :address="address" />
        <AddressModal />

        <ListStore
            :storesWithStock="storesWithStock"
            :storesWithoutStock="storesWithoutStock"
        />
        <HomeBottomMenu :active="'home'" />
    </div>
</template>
