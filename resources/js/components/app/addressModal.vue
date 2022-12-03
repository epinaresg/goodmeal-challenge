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
                            <label for="address">Dirección</label>
                            <input
                                class="form-control"
                                id="address"
                                placeholder="Calle Cristobal Colon Mz.A Lt ..."
                            />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="latitude">Latitud</label>
                            <input
                                class="form-control"
                                id="latitude"
                                aria-describedby="latitudeHelp"
                                placeholder="xx.xxxx"
                            />
                            <small
                                id="latitudeHelp"
                                class="form-text text-muted"
                                >Dato para calculo de distancia.</small
                            >
                        </div>
                        <div class="form-group">
                            <label for="latitude">Longitud</label>
                            <input
                                class="form-control"
                                id="longitude"
                                aria-describedby="latitudeHelp"
                                placeholder="-xx.xxxx"
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
                    <button type="button" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
