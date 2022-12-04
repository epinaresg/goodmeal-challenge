<script>
export default {
    props: ["store"],
};
</script>

<template>
    <div class="storeHeaderBar py-4">
        <router-link to="/">
            <span class="icon pl-4 float-left fs-18">
                <i class="fa-solid fa-left-long"></i>
            </span>
        </router-link>
        <span class="title fs-16">
            {{ store.name }}
        </span>
        <span class="icon pr-4 float-right fs-18">
            <i class="fa-solid fa-cart-shopping"></i>
        </span>
    </div>
</template>
