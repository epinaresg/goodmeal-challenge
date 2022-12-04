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
    <div class="container-fluid h-100">
        <TitleBar :title="'Perfil'" :backUrl="'/'" />

        <HomeBottomMenu :active="'profile'" />
    </div>
</template>
