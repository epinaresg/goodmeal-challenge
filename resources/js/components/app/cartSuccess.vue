<script>
import TitleBar from "@/components/app/titleBar.vue";

export default {
    components: {
        TitleBar,
    },
};
</script>

<template>
    <TitleBar :title="'Felicitaciones'" :backUrl="'/'" />

    <hr />

    <div class="successMessageContainer text-center">
        <h3><strong>¡En hora buena!</strong></h3>

        <h5>Su orden ha sido registrada con exito.</h5>
    </div>

    <hr />

    <div class="px-3">
        <router-link :to="'/orders'">
            <button type="button" class="btn btn-primary btn-block mb-2">
                Ver ordenes
            </button>
        </router-link>
    </div>
</template>
