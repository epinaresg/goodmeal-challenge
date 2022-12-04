<script>
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";
import TitleBar from "@/components/app/titleBar.vue";

export default {
    components: {
        HomeBottomMenu,
        TitleBar,
    },
};
</script>

<template>
    <TitleBar :title="'Ordenes'" :backUrl="'/'" />

    <HomeBottomMenu :active="'orders'" />
</template>
