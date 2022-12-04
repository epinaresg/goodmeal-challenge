<script>
export default {
    props: ["title", "backUrl"],
};
</script>

<template>
    <div class="titleHeaderBar py-4">
        <router-link class="backButton" :to="backUrl">
            <span class="icon pl-4 float-left fs-18">
                <i class="fa-solid fa-left-long"></i>
            </span>
        </router-link>
        <span class="title fs-16">
            {{ title }}
        </span>
    </div>
</template>
