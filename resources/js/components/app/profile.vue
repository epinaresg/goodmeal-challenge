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
    <TitleBar :title="'Perfil'" :backUrl="'/'" />

    <HomeBottomMenu :active="'profile'" />
</template>
