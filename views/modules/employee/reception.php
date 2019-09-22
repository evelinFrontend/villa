<div class="content-main" id="reception">
    <div class="row" id="content-card"></div>
</div>
<div class="row" id="invoices">
    <div class="content-main-recep left col-8">
        <div class="subcontent p-4">
            <h4 class="pricipal-title">reservar</h4>
            <p class="mb-4">Para cambiar el estado de la habitación debes ingresar los que a continuación se muestran.
            </p>
            <form id="form-invoices">
                <div class="row border-bottom">
                    <div class="form-group col">
                        <label for="courtesy">Cortesías:</label>
                        <select id="courtesy" class="form-control">
                            <option value="n/a">N/A</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="select-person">Personas adicionales:</label>
                        <select id="select-person" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div>
                    <div class="form-group col-2" id="content-additional">
                        <label for="additional">¿Cuantas?</label>
                        <input id="additional" class="form-control" type="number">
                    </div>
                    <div class="form-group col">
                        <label for="decorated-room">habitación decorada:</label>
                        <select id="decorated-room" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                </div>

                <div class="m-4 border-bottom">
                    <h5>Seleccionar productos</h5>
                    <div id="modal-content-products" class="col">
                        <input class="form-control mb-2" type="search" placeholder="Buscar..." id="search">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" id="btn-reservar">Reservar</button>
                </div>
            </form>
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
            </button>>
            <button class="btn btn-primary" type="button" id="">Tiempo parcial</button> -->
        </div>
    </div>
    <div class="content-main-recep col-4 ">
        <div class="subcontent p-4">
            <h5>TOTAL: <strong id="total"></strong></h5>
            <div id="select-products"></div>
            <table class="table table-striped table-sm " id="cant-products-table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">cantidad</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
        </div>
    </div>

</div>

<?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
<div id="init-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">Ingresa el cantidad de dinero que se encuentra en caja en este momento</p>
                <div class="alert alert-danger" role="alert">
                </div>
                <form id="turn">
                    <div class="form-group">
                        <label for="value">Valor en caja</label>
                        <input id="value" class="form-control" type="number">
                        <div class="invalid-feedback" id="mss-err-username">
                            Llena este campo para continuar
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div id="modal-cancel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Cancelar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form id="cancelar-reserva">
                    <div class="form-group">
                        <label for="my-textarea">Motivo</label>
                        <textarea id="my-textarea" class="form-control" rows="3" require></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Cancelar reserva</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="views/assets/js/reception.js"></script>