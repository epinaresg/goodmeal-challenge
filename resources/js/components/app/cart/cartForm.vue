<script>
export default {
    props: ["form", "cart"],
};
</script>
<template>
    <div class="px-4 mb-3 cartFormContainer">
        <form>
            <div class="form-group">
                <label for="type">Tipo de pedido (*)</label>
                <select v-model="form.type" required class="form-control">
                    <option value="">-- SELECCIONE --</option>
                    <option value="delivery">Delivery</option>
                    <option value="take_out">Retiro en tienda</option>
                </select>
            </div>
        </form>
    </div>
</template>
