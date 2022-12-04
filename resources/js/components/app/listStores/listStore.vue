<script>
import StoreItem from "@/components/app/listStores/storeItem.vue";

export default {
    props: ["storesWithStock", "storesWithoutStock"],
    components: {
        StoreItem,
    },
};
</script>

<template>
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
                >Con stock</a
            >
            <a
                class="nav-link"
                id="v-pills-profile-tab"
                data-toggle="pill"
                href="#v-pills-profile"
                role="tab"
                >Sin stock</a
            >
        </div>
    </div>

    <div class="itemsContainer">
        <div class="tab-content mt-2" id="v-pills-tabContent">
            <div
                class="tab-pane fade show active"
                id="v-pills-home"
                role="tabpanel"
            >
                <div v-for="item in storesWithStock" :key="item.id">
                    <router-link :to="'/store/' + item.id">
                        <StoreItem :item="item" />
                    </router-link>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel">
                <div
                    class="mb-4"
                    v-for="item in storesWithoutStock"
                    :key="item.id"
                >
                    <router-link :to="'/store/' + item.id">
                        <StoreItem :item="item" />
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
