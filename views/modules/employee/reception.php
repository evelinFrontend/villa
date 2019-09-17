<div class="content-main" id="reception">
    <div class="row" id="content-card">
        <div class="cards room">
            <div class="linear-room green"></div>
            <div class="body-room-card d-flex">
                <div>
                    <h1 class="card-number green">1</h1>
                </div>
                <div>
                    <small id="type-room">Suite presidencial</small>
                    <p id="time-room">1:00:00</p>
                    <p class="status-room green goInvoices">RESERVAR</p>
                </div>
            </div>
        </div>
        <div class="cards room">
            <div class="linear-room red"></div>
            <div class="body-room-card d-flex">
                <div>
                    <h1 class="card-number red">3</h1>
                </div>
                <div>
                    <small id="type-room">Suite presidencial</small>
                    <p id="time-room">1:00:00</p>
                    <p class="status-room red goInvoices">FACTURAR</p>
                </div>
            </div>
        </div>
        <div class="cards room">
            <div class="linear-room blue"></div>
            <div class="body-room-card d-flex">
                <div>
                    <h1 class="card-number blue">2</h1>
                </div>
                <div>
                    <small id="type-room">Suite presidencial</small>
                    <p id="time-room">1:00:00</p>
                    <p class="status-room blue">HABILITAR</p>
                </div>
            </div>
        </div>
        <div class="cards room">
            <div class="linear-room orange"></div>
            <div class="body-room-card d-flex">
                <div>
                    <h1 class="card-number orange">2</h1>
                </div>
                <div>
                    <small id="type-room">Suite presidencial</small>
                    <p id="time-room">1:00:00</p>
                    <p class="status-room orange">FINALIZAR</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-main">
    <div class="subcontent p-4" id="invoices">
		<h4 class="pricipal-title mb-4">Facturar</h4>
		<p>Para cambiar el estado de la habitación debes ingresar los que a continuación se muestran.</p>
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
				<div class="form-group col" id="content-additional">
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

<?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
<div id="init-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<p class="text-center">Ingresa el cantidad de dinero que se encuentra en caja en este momento</p>
				<form id="turn">
					<div class="form-group">
						<label for="value">Valor en caja</label>
						<input id="value" class="form-control" type="number">
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