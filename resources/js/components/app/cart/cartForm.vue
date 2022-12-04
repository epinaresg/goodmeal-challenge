<script>
export default {
    props: ["form", "cart", "store"],
};
</script>
<template>
    <div class="px-4 mb-3 cartFormContainer">
        <form>
            <div class="form-group">
                <label for="type">Tipo de pedido (*)</label>
                <select v-model="form.type" required class="form-control">
                    <option value="">-- SELECCIONE --</option>
                    <option
                        v-for="schedule in store.schedules"
                        :key="schedule.id"
                        :value="schedule.type"
                    >
                        {{
                            schedule.type === "delivery"
                                ? "Delivery"
                                : "Retiro en tienda"
                        }}
                        {{
                            "(" +
                            schedule.start_hour +
                            " - " +
                            schedule.end_hour +
                            " hrs)"
                        }}
                    </option>
                </select>
            </div>
        </form>
    </div>
</template>
