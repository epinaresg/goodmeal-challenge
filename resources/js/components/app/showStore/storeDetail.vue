<script>
export default {
    props: ["store"],
};
</script>

<template>
    <div class="storeDetail px-4 mb-2">
        <div class="mt-3 mb-2"><strong>Acerda de la tienda</strong></div>

        <div class="d-flex flex-row mb-1">
            <span class="pr-2 w-icon align-middle">
                <i class="fa-solid fa-location-dot"></i>
            </span>

            <span class="fs-14 fc-primary align-middle">{{
                store.address
            }}</span>
        </div>

        <div class="d-flex flex-row mb-1">
            <span class="pr-2 w-icon">
                <i class="fs-13 fa-solid fa-clock"></i>
            </span>

            <span class="fs-14">
                <span
                    class="d-block fs-14"
                    v-for="schedule in store.schedules"
                    :key="schedule.id"
                >
                    Horario de
                    <span class="fs-14" v-if="schedule.type === 'take_out'"
                        >retiro</span
                    >
                    <span class="fs-14" v-else>delivery</span>: Hoy
                    {{ schedule.start_hour }} a {{ schedule.end_hour }}
                    hrs
                </span>
            </span>
        </div>

        <div class="storeRating">
            <strong class="pr-3 fs-15">Calificación</strong>
            <span class="pr-1 fs-14">
                <i class="fa-solid fa-star fc-primary"></i>
            </span>
            <span class="fs-14"> {{ store.rating }} / 5 </span>
        </div>
    </div>
</template>
