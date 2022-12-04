<script>
import axios from "axios";

export default {
    data() {
        return {
            address: "",
            latitude: "",
            longitude: "",
        };
    },
    mounted() {},
    methods: {
        saveAddress() {
            axios
                .post("/addresses", {
                    address: this.address,
                    latitude: this.latitude,
                    longitude: this.longitude,
                })
                .then((response) => {
                    this.$parent.getAddress();
                    this.address = "";
                    this.latitude = "";
                    this.longitude = "";
                    $("#btnClose").click();
                })
                .catch((error) => {
                    console.log(error);
                    alert(error.response.data.message);
                });
        },
    },
};
</script>

<template>
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
                        Ingrese su dirección
                    </h5>
                    <button
                        id="btnClose"
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="address">Dirección (*)</label>
                            <input
                                class="form-control"
                                id="address"
                                v-model="address"
                                placeholder="Calle Cristobal Colon Mz.A Lt ..."
                                required
                            />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="latitude">Latitud (*)</label>
                            <input
                                class="form-control"
                                id="latitude"
                                v-model="latitude"
                                aria-describedby="latitudeHelp"
                                placeholder="xx.xxxx"
                                required
                            />
                            <small
                                id="latitudeHelp"
                                class="form-text text-muted"
                                >Dato para calculo de distancia.</small
                            >
                        </div>
                        <div class="form-group">
                            <label for="latitude">Longitud (*)</label>
                            <input
                                class="form-control"
                                id="longitude"
                                v-model="longitude"
                                aria-describedby="latitudeHelp"
                                placeholder="-xx.xxxx"
                                required
                            />
                            <small
                                id="longitudeHelp"
                                class="form-text text-muted"
                                >Dato para calculo de distancia.</small
                            >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Cancelar
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        v-on:click="saveAddress"
                    >
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
