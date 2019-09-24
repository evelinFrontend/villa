<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50 border-slide" id="section-1">
            <p>Crear Habitación</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Tipo de Habitación</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Crear habitación</h4>
        <form id="create-room" class="border-bottom pb-4 mb-4">
            <div class="alert alert-success" role="alert"></div>
            <div class="alert alert-danger" role="alert"></div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="room-number">Numero de habitación:</label>
                    <input id="room-number" class="form-control" type="number" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="room-type">Tipo de Habitacion</label>
                    <select id="room-type" class="form-control">
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="room-detail">Detalles de la habitación:</label>
                    <textarea id="room-detail" class="form-control" rows="1"></textarea>
                </div>
            </div>
            <div class="form-group col-12 d-flex justify-content-end ">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </form>
        <h4 class="pricipal-title mb-4">Lista de habitaciones</h4>
        <table class="table table-striped col" id="table-create-room">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Descrpción</th>
                    <th>Tipo</th>
                    <th>Valor hora</th>
                    <th>Valor persona Adicional</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Crear tipo de habitación</h4>
        <form id="form-type-room" class="border-bottom pb-4 mb-5">
            <div class="row">
                <div class="form-group col">
                    <label for="room-type-name">Nombre:</label>
                    <input id="room-type-name" class="form-control" type="text" required>
                </div>
                <div class="form-group col">
                    <label for="room-type-detail">Detalles:</label>
                    <input id="room-type-detail" class="form-control" type="text" requiered>
                </div>
                <div class="form-group col-4">
                    <label for="people">Valor por persona adicional :</label>
                    <input id="people" class="form-control" type="number" required>
                </div>
            </div>
            <h4 class="pricipal-title mb-4">Precios:</h4>
            <div class="row">
                <div class="form-group col">
                    <label for="price_hora_1">Valor 1 hora transcurrida:</label>
                    <input id="price_hora_1" class="form-control" type="number" value="20000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_2">Valor 2 horas transcurridas:</label>
                    <input id="price_hora_2" class="form-control" type="number"  value="25000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_3">Valor 3 horas transcurridas:</label>
                    <input id="price_hora_3" class="form-control" type="number" value="30000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="price_hora_4">Valor 4 horas transcurridas:</label>
                    <input id="price_hora_4" class="form-control" type="number" value="35000" required>
                </div>  
                <div class="form-group col">
                    <label for="price_hora_5">Valor 5 horas transcurridas:</label>
                    <input id="price_hora_5" class="form-control" type="number"  value="40000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_6">Valor 6 horas transcurridas:</label>
                    <input id="price_hora_6" class="form-control" type="number" value="45000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="price_hora_7">Valor 7 horas transcurridas:</label>
                    <input id="price_hora_7" class="form-control" type="number"  value="40000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_8">Valor 8 horas transcurridas:</label>
                    <input id="price_hora_8" class="form-control" type="number" value="45000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_9">Valor 9 horas transcurridas:</label>
                    <input id="price_hora_9" class="form-control" type="number"  value="50000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="price_hora_10">Valor 10 horas transcurridas:</label>
                    <input id="price_hora_10" class="form-control" type="number" value="55000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_11">Valor 11 horas transcurridas:</label>
                    <input id="price_hora_11" class="form-control" type="number"  value="60000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_12">Valor 12 horas transcurridas:</label>
                    <input id="price_hora_12" class="form-control" type="number" value="65000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="price_hora_13">Valor 13 horas transcurridas:</label>
                    <input id="price_hora_13" class="form-control" type="number" value="70000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_14">Valor 14 horas transcurridas:</label>
                    <input id="price_hora_14" class="form-control" type="number"  value="75000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_15">Valor 15 horas transcurridas:</label>
                    <input id="price_hora_15" class="form-control" type="number" value="80000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="price_hora_16">Valor 16 horas transcurridas:</label>
                    <input id="price_hora_16" class="form-control" type="number" value="85000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_17">Valor 17 horas transcurridas:</label>
                    <input id="price_hora_17" class="form-control" type="number"  value="90000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_18">Valor 18 horas transcurridas:</label>
                    <input id="price_hora_18" class="form-control" type="number" value="95000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="price_hora_19">Valor 19 horas transcurridas:</label>
                    <input id="price_hora_19" class="form-control" type="number" value="100000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_20">Valor 20 horas transcurridas:</label>
                    <input id="price_hora_20" class="form-control" type="number"  value="105000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_21">Valor 21 horas transcurridas:</label>
                    <input id="price_hora_21" class="form-control" type="number" value="110000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="price_hora_22">Valor 22 horas transcurridas:</label>
                    <input id="price_hora_22" class="form-control" type="number" value="115000" required>
                </div>
                <div class="form-group col">
                    <label for="price_hora_23">Valor 23 horas transcurridas:</label>
                    <input id="price_hora_23" class="form-control" type="number"  value="120000" required>
                </div>
                <div class="form-group col-4">
                    <label for="price_hora_24">Valor 24 horas transcurridas:</label>
                    <input id="price_hora_24" class="form-control" type="number" value="125000" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="hour-value">Valor por hora despues del dia:</label>
                    <input id="hour-value" class="form-control" type="number" required value="20000">
                </div>
                <div class="form-group col-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </div>
        </form>
        <h4 class="pricipal-title mb-4">Lista de tipo de habitaciones</h4>
        <div class="alert alert-danger" role="alert"></div>
        <div class="alert alert-success" role="alert"></div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped col" id="table-type-room">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Detalles</th>
                            <th>Valor por hora</th>
                            <th>Valor persona adicional</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body-type">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- update type room -->
<div id="update-type" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Actualizar tipo de habitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger danger-modal" role="alert">
                </div>
                <form id="form-update-type-room">
                    <div class="row">
                        <div class="form-group col">
                            <label for="room-type-id-up">Id:</label>
                            <input id="room-type-id-up" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="room-type-status-up">Estado:</label>
                            <input id="room-type-status-up" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="room-type-name-up">Nombre:</label>
                            <input id="room-type-name-up" class="form-control" type="text" require>
                        </div>
                        <div class="form-group col">
                            <label for="people-up">Valor por persona adicional :</label>
                            <input id="people-up" class="form-control" type="number" require>
                        </div>
                        <div class="form-group col">
                            <label for="room-type-detail-up">Detalles:</label>
                            <input id="room-type-detail-up" class="form-control" type="text" requiere>
                        </div>
                    </div>
                    <h4 class="pricipal-title mb-4">Precios:</h4>
                    <div class="row">
                        <div class="form-group col">
                            <label for="update_price_hora_1">Valor 1 hora transcurrida:</label>
                            <input id="update_price_hora_1" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_2">Valor 2 horas transcurridas:</label>
                            <input id="update_price_hora_2" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_3">Valor 3 horas transcurridas:</label>
                            <input id="update_price_hora_3" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="update_price_hora_4">Valor 4 horas transcurridas:</label>
                            <input id="update_price_hora_4" class="form-control" type="number"  required>
                        </div>  
                        <div class="form-group col">
                            <label for="update_price_hora_5">Valor 5 horas transcurridas:</label>
                            <input id="update_price_hora_5" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_6">Valor 6 horas transcurridas:</label>
                            <input id="update_price_hora_6" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="update_price_hora_7">Valor 7 horas transcurridas:</label>
                            <input id="update_price_hora_7" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_8">Valor 8 horas transcurridas:</label>
                            <input id="update_price_hora_8" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_9">Valor 9 horas transcurridas:</label>
                            <input id="update_price_hora_9" class="form-control" type="number"   required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="update_price_hora_10">Valor 10 horas transcurridas:</label>
                            <input id="update_price_hora_10" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_11">Valor 11 horas transcurridas:</label>
                            <input id="update_price_hora_11" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_12">Valor 12 horas transcurridas:</label>
                            <input id="update_price_hora_12" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="update_price_hora_13">Valor 13 horas transcurridas:</label>
                            <input id="update_price_hora_13" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_14">Valor 14 horas transcurridas:</label>
                            <input id="update_price_hora_14" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_15">Valor 15 horas transcurridas:</label>
                            <input id="update_price_hora_15" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="update_price_hora_16">Valor 16 horas transcurridas:</label>
                            <input id="update_price_hora_16" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_17">Valor 17 horas transcurridas:</label>
                            <input id="update_price_hora_17" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_18">Valor 18 horas transcurridas:</label>
                            <input id="update_price_hora_18" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="update_price_hora_19">Valor 19 horas transcurridas:</label>
                            <input id="update_price_hora_19" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_20">Valor 20 horas transcurridas:</label>
                            <input id="update_price_hora_20" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_21">Valor 21 horas transcurridas:</label>
                            <input id="update_price_hora_21" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="update_price_hora_22">Valor 22 horas transcurridas:</label>
                            <input id="update_price_hora_22" class="form-control" type="number"  required>
                        </div>
                        <div class="form-group col">
                            <label for="update_price_hora_23">Valor 23 horas transcurridas:</label>
                            <input id="update_price_hora_23" class="form-control" type="number"   required>
                        </div>
                        <div class="form-group col-4">
                            <label for="update_price_hora_24">Valor 24 horas transcurridas:</label>
                            <input id="update_price_hora_24" class="form-control" type="number"  required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="hour-value-up">Valor por hora:</label>
                            <input id="hour-value-up" class="form-control" type="number" require>
                        </div>
                        <div class="form-group col-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- update room -->
<div id="update-room" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Actualizar Habitaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-update-room">
                    <div class="alert alert-danger danger-modal" role="alert"></div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="room-status-up">Estado:</label>
                            <input id="room-status-up" class="form-control" type="number" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="room-number-up">Numero de habitación:</label>
                            <input id="room-number-up" class="form-control" type="number" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="room-type-up">Tipo de Habitacion</label>
                            <select id="room-type-up" class="form-control" require>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="room-detail-up">Detalles de la habitación:</label>
                            <textarea id="room-detail-up" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-12 d-flex justify-content-end ">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/room.js"></script>