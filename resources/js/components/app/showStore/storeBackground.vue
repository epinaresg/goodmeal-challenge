<script>
export default {
    props: ["store"],
};
</script>

<template>
    <div
        class="storeBackground"
        :style="{ backgroundImage: 'url(' + store.background + ')' }"
    >
        <div class="logo">
            <img :src="store.logo" alt="Logo" />
        </div>
    </div>
</template>
