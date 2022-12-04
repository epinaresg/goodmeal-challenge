<script>
export default {
    props: ["item"],
};
</script>

<template>
    <div class="item mb-4">
        <div
            class="background"
            :style="{ backgroundImage: 'url(' + item.background + ')' }"
        >
            <div>
                <div class="takeOutOrDeliveryTime fs-15">
                    Hoy {{ item.opening_hours }}
                </div>
            </div>
            <div>
                <div class="takeOutOrDelivery fs-14">
                    {{ item.kind_of_attention }}
                </div>
            </div>
        </div>
        <div class="content">
            <div class="logo">
                <img :src="item.logo" alt="Logo" />
            </div>

            <div class="title fs-20 mt-4">
                <strong>{{ item.name }}</strong>
            </div>
            <div class="priceDiscount mb-2">
                <span class="withoutDiscount fs-15">
                    <strong>Desde ${{ item.price_with_discount }}</strong>
                </span>
                <span
                    v-if="item.price_without_discount > 0"
                    class="withDiscount fs-14"
                    ><strong>${{ item.price_without_discount }}</strong></span
                >
            </div>

            <div class="metaContainer">
                <div class="row">
                    <div class="col-8">
                        <span v-if="item.distance_walk" class="walkIcon"
                            ><i class="fa-solid fa-person-walking"></i
                        ></span>
                        <span v-if="item.distance_walk" class="walkText">{{
                            item.distance_walk
                        }}</span>
                        <span v-if="item.distance_km" class="distanceIcon">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <span v-if="item.distance_km" class="distanceText">{{
                            item.distance_km
                        }}</span>
                    </div>

                    <div class="col-4 text-right">
                        <span class="stockText">
                            {{
                                item.products_with_stock > 10
                                    ? "10+"
                                    : item.products_with_stock
                            }}
                        </span>
                        <span class="stockicon"
                            ><i class="fa-solid fa-bag-shopping"></i
                        ></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
