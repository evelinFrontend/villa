<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Personal del hotel</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Promociones</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Colores y estilos</p>
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
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum in nobis sed deleniti soluta at vero commodi?
        Natus non soluta tenetur laboriosam accusantium minus consectetur unde placeat possimus, ut aut!
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
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mb-4" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/setting.js"></script>