<script>
export default {
    props: ["store"],
    mounted() {
        const interval = setInterval(() => {
            if (
                this.store.products_with_stock !== undefined &&
                this.store.products_with_stock == 0
            ) {
                clearInterval(interval);
                $("#btnOpen").click();
            }
        }, 100);
    },
};
</script>

<template>
    <!-- Button trigger modal -->
    <button
        id="btnOpen"
        type="button"
        class="btn btn-primary hide"
        data-toggle="modal"
        data-target="#exampleModal"
        data-backdrop="static"
        data-keyboard="false"
    >
        Launch demo modal
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Es una pena =(
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Esta tienda no cuenta con productos disponibles.
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-dismiss="modal"
                    >
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
