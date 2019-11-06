<div id="modal-type-pay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <h3 class="text-center mt-3">Saldo total: <b id="modalTotal"></b></h3>
            <div class="modal-body">
                <div class="alert alert-danger a-modal-danger" role="alert">
                </div>
                <div class="form-group">
                    <label for="type-pay">Selecciona un metodo de pago</label>
                    <select id="type-pay" class="form-control" name="">
                        <option value="efectivo">Efectivo</option>
                        <option value="credito">Credito</option>
                        <option value="transferencia">Transferencia</option>
                        <option value="mixto" id="opcionMixtoPay">Mixto</option>
                    </select>
                </div>
                <div class="form-group" id="efectivo">
                    <label for="input-efectivo">Efectivo</label>
                    <input id="input-efectivo" class="form-control" type="number" onkeyup="currecy(this.id)" require>
                    <small class="input-efectivo ml-2 font-weight-bold"></small>
                </div>
                <div class="form-group" id="credito">
                    <label for="input-credito">Credito</label>
                    <input id="input-credito" class="form-control" type="number" onkeyup="currecy(this.id)" require>
                    <small class="input-credito ml-2 font-weight-bold"></small>
                </div>
                <div class="form-group" id="transferencia">
                    <label for="input-transferencia">Transferencia</label>
                    <input id="input-transferencia" class="form-control" type="number" onkeyup="currecy(this.id)" require>
                    <small class="input-transferencia ml-2 font-weight-bold"></small>
                </div>
                <div class="my-3 float-right d-flex">
                    <p class="ml-2" id="restar">RESTAN:</p>
                    <h6 id="restan-value"></h6>
                </div>
                <button class="btn btn-primary" type="button" id="btn-aceptar-metodo">Facturar</button>
            </div>
        </div>
    </div>
</div>