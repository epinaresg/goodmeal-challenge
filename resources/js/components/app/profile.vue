<script>
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";

export default {
    components: {
        HomeBottomMenu,
    },
};
</script>

<template>
    <div class="container-fluid h-100">
        <div class="titleHeaderBar py-4">
            <span class="title fs-16"> Perfil </span>
        </div>

        <div class="orderContainer">
            <div class="text-center fs-18">Coming soon!</div>
        </div>

        <HomeBottomMenu :active="'profile'" />
    </div>
</template>
