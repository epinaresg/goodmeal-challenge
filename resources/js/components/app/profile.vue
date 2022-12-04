<script>
import HomeBottomMenu from "@/components/app/homeBottomMenu.vue";

export default {
    components: {
        HomeBottomMenu,
    },
};
</script>

<template>
    <div class="container-fluid">
        <HomeBottomMenu :active="'profile'" />
    </div>
</template>
