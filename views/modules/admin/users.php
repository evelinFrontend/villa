<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Personal del hotel</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Proveedores</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-3">
            <p>Promociones</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Personal del hotel</h4>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-employee">
            Nuevo empleado
				</button>
				<div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-employee">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
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
    <div class="subcontent p-4" id="section-2-tab">
		<h4 class="pricipal-title mb-4">Proveedores</h4>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-provider">
            Nuevo proveedor
				</button>
				<div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-provider">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
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
    <div class="subcontent p-4" id="section-3-tab">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
    </div>
</div>
<!-- modal create employee -->
<div id="create-employee" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nuevo empleado</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Recuerda asignar el rol y el horario de trabajo propios del empleado, estos se pobrán editar luego.
                </p>
                <form id="form-create-employee" class="m-4">
                    <div class="row">
                        <div class="form-group col">
                            <label for="name-employee">Nombres:</label>
                            <input id="name-employee" class="form-control" type="text">
                        </div>
                        <div class="form-group col">
                            <label for="lastname-employee">Apellidos:</label>
                            <input id="lastname-employee" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="doc-employee">Número de documento:</label>
                            <input id="doc-employee" class="form-control" type="number" name="">
                        </div>
                        <div class="form-group col">
                            <label for="doc-employee">Fecha de nacimiento:</label>
                            <input id="doc-employee" class="form-control" type="date" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
														<label for="doc-employee">Hora de entrada:</label>
                            <input id="doc-employee" class="form-control" type="time" name="">
                        </div>
                        <div class="form-group col">
                            <label for="doc-employee">hora de salida:</label>
                            <input id="doc-employee" class="form-control" type="time" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="doc-employee">Número de contacto:</label>
                            <input id="doc-employee" class="form-control" type="number" name="">
                        </div>
                        <div class="form-group col">
                            <label for="rol">Rol</label>
                            <select id="rol" class="form-control" name="">
                                <option>Administrador</option>
                                <option>Caja</option>
                            </select>
                        </div>
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="user-name-employee">Nombre de usuario:</label>
												<input id="user-name-employee" class="form-control" type="text" name="">
											</div>
											<div class="form-group col">
												<label for="password-employee">Contraseña</label>
												<input id="password-employee" class="form-control" type="password" name="">
											</div>
										</div>
											<button class="btn btn-primary float-right mb-4" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal create provider -->
<div id="create-provider" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nuevo proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-provider" class="m-4">
                    <div class="row">
                        <div class="form-group col">
                            <label for="name-incharge">Nombre del encargo:</label>
                            <input id="name-incharge" class="form-control" type="text">
                        </div>
                        <div class="form-group col">
                            <label for="name-provider">Nombre del proveedor:</label>
                            <input id="name-provider" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="nit-provider">Nit:</label>
                            <input id="nit-provider" class="form-control" type="number" name="">
                        </div>
                        <div class="form-group col">
                            <label for="business-name-provider">Razón social:</label>
                            <input id="business-name-provider" class="form-control" type="text" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
														<label for="number-provider">Telefono:</label>
                            <input id="number-provider" class="form-control" type="number" name="">
                        </div>
                        <div class="form-group col">
                            <label for="address-provider">Direccion:</label>
                            <input id="address-provider" class="form-control" type="text" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="doc-employee">correo eléctronico:</label>
                            <input id="doc-employee" class="form-control" type="number" name="">
                        </div>
										</div>
											<button class="btn btn-primary float-right mb-4" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/user.js"></script>