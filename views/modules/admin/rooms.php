<div class="content-main">
    <div class="slide-menu">
        <!-- <div class="slide-item w-50" id="section-1">
            <p>Habitaciones</p>
        </div> -->
        <div class="slide-item w-50 border-slide" id="section-1">
            <p>Crear Habitación</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Tipo de Habitación</p>
        </div>
    </div>
    <!-- <div class="content-card row" id="section-1-tab">
        <div class="cards room bg-success mb-3 col-2" onclick="openModal()">
            <div class="card-header text-white text-center">Disponible</div>
            <div class="card-body row">
                <div class="card-number col-4 d-flex align-items-center justify-content-center">
                    <h3 class="text-center text-white">1</h3>
                </div>
                <div class="col-8">
                    <p class="card-text">Sencilla</p>
                    <p class="card-text">1:00:00</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Crear habitación</h4>
        <form id="create-room" class="border-bottom pb-4 mb-4">
            <div class="row">
                <div class="form-group col-4">
                    <label for="room-number">Numero de habitación:</label>
                    <input id="room-number" class="form-control" type="number">
                </div>
                <div class="form-group col-4">
                    <label for="room-type">Tipo de Habitacion</label>
                    <select id="room-type" class="form-control">
                        <option>normal</option>
                        <option>chevere</option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="room-detail">Detalles de la habitación:</label>
                    <textarea id="room-detail" class="form-control" name="" rows="1"></textarea>
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
                    <th>Nombre</th>
                    <th>Descrpción</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Normal</td>
                    <td>Pues es normal</td>
                    <td>editar</td>
                </tr>
                <tr>
                    <td>Normal</td>
                    <td>Pues es normal</td>
                    <td>editar</td>
                </tr>
                <tr>
                    <td>Normal</td>
                    <td>Pues es normal</td>
                    <td>editar</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Crear tipo de habitación</h4>
        <form id="form-type-room" class="border-bottom pb-4 mb-5">
            <div class="row">
                <div class="form-group col">
                    <label for="room-type-name">Nombre:</label>
                    <input id="room-type-name" class="form-control" type="text" require>
                </div>
                <div class="form-group col">
                    <label for="room-type-detail">Detalles:</label>
                    <input id="room-type-detail" class="form-control" type="text" requiere>
                </div>
                <div class="form-group col-4">
                    <label for="room-price">Valor por hora:</label>
                    <input id="room-price" class="form-control" type="number">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="room-price">Valor por persona adicional :</label>
                    <input id="room-price" class="form-control" type="number">
                </div>>
            <div class="form-group col-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
            </div>
        </form>
        <h4 class="pricipal-title mb-4">Lista de tipo de habitaciones</h4>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped col" id="table-type-room">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descrpción</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Normal</td>
                            <td>Pues es normal</td>
                            <td>editar</td>
                        </tr>
                        <tr>
                            <td>Normal</td>
                            <td>Pues es normal</td>
                            <td>editar</td>
                        </tr>
                        <tr>
                            <td>Normal</td>
                            <td>Pues es normal</td>
                            <td>editar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status">Estados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <b>Número de habitación:</b>
                        <p>1</p>
                    </div>
                    <div class="col">
                        <b>Tipo de habitacion:</b>
                        <p>2</p>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <b>Estado:</b>
                        <p>disponible</p>
                    </div>
                    <div class="col">
                        <b>Detalles:</b>
                        <p>habitacion tal porque ajam</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Hora de entrada:</b>
                        <p>7:00pm</p>
                    </div>
                    <div class="col">
                        <b>Hora Actual:</b>
                        <p>1:00hr</p>
                    </div>
                    <div class="col">
                        <b>Tiempo transcurrido:</b>
                        <p>1:00hr</p>
                    </div>
                </div>
                <div class="row">
                    <form id="status-form" class="col">
                        <div class="form-group">
                            <label for="status-room">Cambiar de estado:</label>
                            <select id="status-room" class="form-control">
                                <option value="available">Disponible</option>
                                <option value="busy">En uso</option>
                                <option value="clean">Limpieza</option>
                                <option value="courtesy">Cortesia</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Guarda estado</button>
                    <button type="button" class="btn btn-primary">Imprimir tiempo parcial</button>
                    <button type="button" class="btn btn-primary">Facturar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/room.js"></script>