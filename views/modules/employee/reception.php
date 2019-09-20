<div class="content-main" id="reception">
    <div class="row" id="content-card"></div>
</div>
<div class="row" id="invoices">
    <div class="content-main-recep left col-8">
        <div class="subcontent p-4">
            <h4 class="pricipal-title">Facturar</h4>
            <p class="mb-4">Para cambiar el estado de la habitación debes ingresar los que a continuación se muestran.</p>
            <form id="form-invoices">
                <div class="row">
                    <div class="form-group col">
                        <label for="courtesy">Cortesías:</label>
                        <select id="courtesy" class="form-control">
                            <option>N/A</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="select-person">Persona adicional:</label>
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
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Reservar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="content-main-recep col-4 ">
        <div class="subcontent p-4">
            <h5>TOTAL: <strong id="total"></strong></h5>
        </div>
    </div>

</div>

<?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
<div id="init-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
<script src="views/assets/js/reception.js"></script>