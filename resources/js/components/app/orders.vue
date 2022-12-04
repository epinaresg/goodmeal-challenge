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
        <HomeBottomMenu :active="'orders'" />
    </div>
</template>
