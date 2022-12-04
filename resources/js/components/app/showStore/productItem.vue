<script>
export default {
    props: ["item"],
};
</script>

<template>
    <div class="card position-relative">
        <span class="position-absolute btnAddToCart">
            <i class="fa-solid fa-circle-plus"></i>
        </span>
        <img class="card-img-top" :src="item.image" />
        <div class="card-body">
            <div>
                <div class="priceDiscount mb-2">
                    <span class="withoutDiscount fs-15">
                        <strong> ${{ item.price_with_discount }} </strong>
                    </span>
                    <span
                        v-if="item.price_without_discount > 0"
                        class="withDiscount fs-14"
                    >
                        <strong> ${{ item.price_without_discount }} </strong>
                    </span>
                </div>
            </div>

            <div class="card-title fs-15">
                {{ item.name }}
            </div>
        </div>
    </div>
</template>
