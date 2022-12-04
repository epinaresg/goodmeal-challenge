<script>
import ProductItem from "@/components/app/showStore/productItem.vue";

export default {
    props: ["products", "store"],
    components: {
        ProductItem,
    },
};
</script>

<template>
    <div class="listProductsContainer">
        <div
            v-if="products.length == 0"
            class="categoryTabsContainer pt-4 text-center"
        >
            <strong> No tiene productos registrados.</strong>
        </div>
        <div v-else>
            <div class="categoryTabsContainer">
                <div class="slideContainer">
                    <div
                        class="nav nav-pills mb-2"
                        id="v-pills-tab"
                        role="tablist"
                        aria-orientation="horizontal"
                    >
                        <a
                            v-for="(product, key) in products"
                            :key="product.category_id"
                            class="nav-link"
                            :class="key == 0 ? 'active' : ''"
                            :id="'v-' + product.category_id + '-tab'"
                            data-toggle="pill"
                            :href="'#v-' + product.category_id"
                            role="tab"
                            >{{ product.category_name }}</a
                        >
                    </div>
                </div>
            </div>

            <div class="productItemsContainer px-3 mt-2">
                <div class="tab-content mt-2" id="v-pills-tabContent">
                    <div
                        v-for="(product, key) in products"
                        :key="product.category_id"
                        class="tab-pane fade show"
                        :class="key == 0 ? 'active' : ''"
                        :id="'v-' + product.category_id"
                        role="tabpanel"
                    >
                        <div class="row w-100 mx-auto">
                            <div
                                class="col-lg-3 col-md-4 col-6 px-2 mt-2 mb-3"
                                v-for="item in product.items"
                                :key="item.id"
                            >
                                <ProductItem :store="store" :item="item" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
