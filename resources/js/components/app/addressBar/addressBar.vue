<script>
import AddressModal from "@/components/app/addressBar/addressModal.vue";

export default {
    props: ["address"],
    data() {
        return {
            force: false,
        };
    },
    mounted() {
        const interval = setInterval(() => {
            if (
                this.address !== undefined &&
                this.address == "Click aquí para registrar una dirección"
            ) {
                this.force = true;
                clearInterval(interval);
                $("#btnOpen").click();
            }
        }, 100);
    },
    components: {
        AddressModal,
    },
};
</script>

<template>
    <div
        id="btnOpen"
        class="addressBar pt-4 pb-2"
        data-toggle="modal"
        data-target="#exampleModal"
        data-backdrop="static"
        data-keyboard="false"
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

    <AddressModal :force="force" />
</template>
