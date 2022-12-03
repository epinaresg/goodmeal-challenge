<script>
export default {
    props: ["address"],
};
</script>

<template>
    <div
        class="addressBar pt-4 pb-2"
        data-toggle="modal"
        data-target="#exampleModal"
    >
        <span class="icon p-2">
            <i class="fa-solid fa-location-dot"></i>
        </span>
        <span class="addressText">
            {{ address }}
        </span>
        <span class="icon p-2">
            <i class="fa-solid fa-angle-right"></i>
        </span>
    </div>
</template>
