<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Personal del hotel</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Promociones</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-3">
            <p>Estados de reserva</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Personal del hotel</h4>
        <div class="alert alert-success" role="alert"></div>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-employee">
            Nuevo empleado
        </button>
        <div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-employee">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>numero de contacto</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Promociones</h4>
        <div class="alert alert-success" role="alert"></div>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#create-promo">
            Nueva promoción
        </button>
        <div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-promo">
                    <thead>
                        <tr>
                            <th>Nombre promo</th>
                            <th>Tiempo</th>
                            <th>Valor</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="subcontent p-4" id="section-3-tab">
    <h4 class="pricipal-title mb-4">Promociones</h4>
    <p>Te recomendamos no usar el mismo color para varios estados</p>
        <form id="changeStatus">
            <div id="content-shema"></div>
            <button type="submit" class="btn btn-primary float-right">Cambiar</button>
        </form>
        
    </div>
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
                <div class="alert alert-danger" role="alert"></div>
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
                            <input id="doc-employee" class="form-control" type="number" >
                        </div>
                        <div class="form-group col">
                            <label for="birthdate">Fecha de nacimiento:</label>
                            <input id="birthdate" class="form-control" type="date" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="email">Correo electronico:</label>
                            <input id="email" class="form-control" type="email" name="">
                        </div>
                        <div class="form-group col">
                            <label for="number">Número de contacto:</label>
                            <input id="number" class="form-control" type="number" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="rol">Rol</label>
                            <select id="rol" class="form-control" name="">
                                <option value="1">Administrador</option>
                                <option value="2">Caja</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="user-name-employee">Nombre de usuario:</label>
                            <input id="user-name-employee" class="form-control" type="text" name="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="password-employee">Contraseña</label>
                            <input id="password-employee" class="form-control" type="password" name="">
                        </div>
                        <div class="form-group col">
                            <label for="password-repet-employee">Contraseña</label>
                            <input id="password-repet-employee" class="form-control" type="password" name="">
                            <div class="invalid-feedback" id="mss-err-pass">
                                Las contraseñas no coinciden
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mb-4" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal update employee -->
<div id="update-employee" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos de usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                </div>
                <div class="modal-user-data row justify-content-center border-bottom pb-3"></div>
                <h5 class="modal-title mt-3 mb-3">Actualizar contraseña</h5>
                <div class="change-password border-bottom border-top py-4 ">
                    <form id="form-change-pass">
                        <div class="row">
                            <div class="form-group col">
                                <label for="actual">Contraseña actual:</label>
                                <input id="actual" class="form-control" type="password">
                            </div>
                            <div class="form-group col">
                                <label for="new">Nueva contraseña:</label>
                                <input id="new" class="form-control" type="password">
                            </div>
                            <div class="form-group col">
                                <label for="repeat">Repetir contraseña:</label>
                                <input id="repeat" class="form-control" type="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Cambiar
                        </button>
                    </form>
                </div>
                <h5 class="modal-title mt-3 mb-3">Actualizar datos</h5>
                <div class="change-data border-bottom border-top pb-3">
                    <form id="form-update-employee" class="m-4">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="name-employee-up">Codigo:</label>
                                <input id="code-up" class="form-control" type="text" disabled>
                            </div>
                            <div class="form-group col">
                                <label for="name-employee-up">Nombres:</label>
                                <input id="name-employee-up" class="form-control" type="text">
                            </div>
                            <div class="form-group col">
                                <label for="lastname-employee-up">Apellidos:</label>
                                <input id="lastname-employee-up" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="doc-employee-up">Número de documento:</label>
                                <input id="doc-employee-up" class="form-control" type="number" name="">
                            </div>
                            <div class="form-group col">
                                <label for="birthdate-up">Fecha de nacimiento:</label>
                                <input id="birthdate-up" class="form-control" type="date" name="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="email-up">Correo electronico:</label>
                                <input id="email-up" class="form-control" type="email" name="">
                            </div>
                            <div class="form-group col">
                                <label for="number-up">Número de contacto:</label>
                                <input id="number-up" class="form-control" type="number" name="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="rol-up">Rol</label>
                                <select id="rol-up" class="form-control" name="">
                                    <option value="1">Administrador</option>
                                    <option value="2">Caja</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="user-name-employee-up">Nombre de usuario:</label>
                                <input id="user-name-employee-up" class="form-control" type="text" name="">
                            </div>
                        </div>
                        <button class="btn btn-primary float-right mb-4" type="submit">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal create promo -->
<div id="create-promo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear promoción</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-promo">
                    <div class="alert alert-danger" role="alert">
                    </div>
                    <div class="form-group">
                        <label for="promo-name">Nombre:</label>
                        <input id="promo-name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="promo-time">Tiempo</label>
                        <input id="promo-time" class="form-control" type="time">
                        <small>Ejemplo 1:00:00</small>
                    </div>
                    <div class="form-group">
                        <label for="promo-value">Valor</label>
                        <input id="promo-value" class="form-control" type="number">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal update promo -->
<div id="update-promo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar promoción</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                </div>
                <form id="form-update-promo">
                    <div class="row">
                    <div class="form-group col">
                        <label for="update-promo-id">Id:</label>
                        <input id="update-promo-id" class="form-control" type="text" disabled>
                    </div>
                    <div class="form-group col">
                        <label for="update-promo-status">estados:</label>
                        <select id="update-promo-status" class="form-control">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="update-promo-name">Nombre:</label>
                        <input id="update-promo-name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="update-promo-times">Tiempo:</label>
                        <input id="update-promo-times" class="form-control" type="time">
                    </div>
                    <div class="form-group">
                        <label for="update-promo-value">Valor:</label>
                        <input id="update-promo-value" class="form-control" type="number" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/setting.js"></script>