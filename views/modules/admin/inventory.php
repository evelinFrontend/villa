<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Listado de productos</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Listado de categorias</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-3">
            <p>Proveedores</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-4">
            <p>Movimientos</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Listado de productos</h4>
        <div class="alert alert-success" role="alert"></div>
        <div class="alert alert-danger" role="alert"></div>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-product">
            Nuevo producto
        </button>
        <div class="content-table">
            <table class="table table-striped col" id="table-product">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">opciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Listado de categorias</h4>
        <div class="alert alert-success" role="alert" id="alert-scc-category">
        </div>
        <div class="content-crear pb-4 mb-4 border-bottom">
            <div class="alert alert-danger alert-category" role="alert"></div>
            <form id="form-create-category" class="d-flex">
                <div class="form-group col">
                    <label for="name-new-category">Nombre de la categoria:</label>
                    <input id="name-new-category" class="form-control" type="text" require>
                </div>
                <div class="form-group col">
                    <label for="description-category">Descripción:</label>
                    <input id="description-category" class="form-control" type="text" require>
                </div>
                <div class="form-group col d-flex align-items-end ">
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
                </div>
            </form>
        </div>
        <div class="content-table">
            <table class="table table-striped col" id="table-category">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="subcontent p-4" id="section-3-tab">
        <h4 class="pricipal-title mb-4">Proveedores</h4>
        <div class="alert alert-success" role="alert">
        </div>
        <div class="alert alert-danger" role="alert">
        </div>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-provider">
            Nuevo proveedor
        </button>
        <div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-provider">
                    <thead>
                        <tr>
                            <th>Nombre del proveedor:</th>
                            <th>Nombre del encargado:</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="subcontent p-4" id="section-4-tab">
        <h4 class="pricipal-title mb-4">Movimientos</h4>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-moviment">
            Nuevo movimiento
        </button>
        <div class="row user-content-table">
            <div class="col-12">
                <table class="table table-striped col" id="table-provider">
                    <thead>
                        <tr>
                            <th>Cpnsecutivo</th>
                            <th>Tipo</th>
                            <th>Observaciones</th>
                            <th>Fecha</th>
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
</div>

<!-- modal crear producto -->
<div id="create-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nuevo producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4">
                <div class="alert alert-danger" role="alert"></div>
                <form id="form-create-product" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col">
                            <label for="name-product">Nombre del producto:</label>
                            <input id="name-product" class="form-control" type="text" require>
                        </div>
                        <div class="form-group col">
                            <label for="code-product">Codigo:</label>
                            <input id="code-product" class="form-control" type="text" require>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="value-pay-product">Valor de compra:</label>
                            <input id="value-pay-product" class="form-control" type="number" required>
                        </div>
                        <div class="form-group col">
                            <label for="value-buy-product">Valor de venta:</label>
                            <input id="value-buy-product" class="form-control" type="number" required>
                        </div>
                        <div class="form-group col">
                            <label for="cant-product">Cant. disponible:</label>
                            <input id="cant-product" class="form-control" type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="category-product">Categoria:</label>
                            <select id="category-product" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="provider-product">Proveedor:</label>
                            <select id="provider-product" class="form-control">
                                <option value="null">N/A
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="custom-file col my-4 mx-3">
                            <input id="img-product" class="custom-file-input" type="file"
                                accept="image/gif, image/jpeg, image/png">
                            <label for="img-product" class="custom-file-label">Imagen:</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
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
                    <div class="alert alert-danger" role="alert">
                    </div>
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
                            <input id="nit-provider" class="form-control" type="text">
                        </div>
                        <div class="form-group col">
                            <label for="business-name-provider">Razón social:</label>
                            <input id="business-name-provider" class="form-control" type="text">
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
                            <label for="email-provider">Correo eléctronico:</label>
                            <input id="email-provider" class="form-control" type="email">
                        </div>
                        <div class="form-group col">
                            <label for="account-provider">Numero de cuenta:</label>
                            <input id="account-provider" class="form-control" type="number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="type-account-provider">Tipo de cuenta:</label>
                            <input id="type-account-provider" class="form-control" type="text">
                        </div>
                        <div class="form-group col">
                            <label for="bank-provider">Banco:</label>
                            <input id="bank-provider" class="form-control" type="text">
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mb-4" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal create movement -->
<div id="create-moviment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nuevo movimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-movement">
                    <div class="row border-bottom ">
                        <div class="form-group col">
                            <label for="movement-date">Fecha:</label>
                            <input id="movement-date" class="form-control" type="date">
                        </div>
                        <div class="form-group col">
                            <label for="movement-type">Tipo:</label>
                            <select id="movement-type" class="custom-select">
                                <option value="descontar">Decontando saldo</option>
                                <option value="sumar">Sumar saldo</option>
                                <option value="cortesia">Cortesia</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="movement-description">Observaciones:</label>
                            <textarea id="movement-description" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <h6 class="text-center my-4">Productos</h6>
                    <div class="row">
                        <div class="form-group col-5">
                            <label for="product">Selecciona un producto:</label>
                            <select id="product" class="custom-select">
                                <option>Text</option>
                            </select>
                        </div>
                        <div class="form-group col-5">
                            <label for="cant">Cantidad</label>
                            <input id="cant" class="form-control" type="number">
                        </div>
                        <div class="form-group col mt-4">
                            <button class="btn btn-primary mt-2">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal update product -->
<div id="modal-pr-update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-update" role="alert"></div>
                <div id="update-product-detail">
                    <div class="row">
                        <div class="update-pr-img col"></div>
                        <div class="update-pr-detail col">
                        </div>
                    </div>
                </div>
                <div id="update-product-form" class="border-top mt-4">
                    <h5 class="modal-title my-3" id="my-modal-title">Editar Producto</h5>
                    <form id="form-update-product">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="id-product-up">id:</label>
                                <input id="id-product-up" class="form-control" type="text" disabled>
                            </div>
                            <div class="form-group col">
                                <label for="name-product-up">Nombre del producto:</label>
                                <input id="name-product-up" class="form-control" type="text" require>
                            </div>
                            <div class="form-group col">
                                <label for="code-product-up">Codigo:</label>
                                <input id="code-product-up" class="form-control" type="text" require>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="value-pay-product-up">Valor de compra:</label>
                                <input id="value-pay-product-up" class="form-control" type="number" required>
                            </div>
                            <div class="form-group col">
                                <label for="value-buy-product-up">Valor de venta:</label>
                                <input id="value-buy-product-up" class="form-control" type="number" required>
                            </div>
                            <div class="form-group col">
                                <label for="cant-product-up">Cant. disponible:</label>
                                <input id="cant-product-up" class="form-control" type="number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="category-product-up">Categoria:</label>
                                <select id="category-product-up" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="provider-product-up">Proveedor:</label>
                                <select id="provider-product-up" class="form-control">
                                    <option value="null">N/A
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="custom-file col my-4 mx-3">
                                <input id="img-product" class="custom-file-input" type="file"
                                    accept="image/gif, image/jpeg, image/png">
                                <label for="img-product" class="custom-file-label">Imagen:</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal update category -->
<div id="modal-ct-update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-up-category" role="alert"></div>
                <form id="form-update-category">
                    <div class="form-group col">
                        <label for="id-new-category-up">Id de la categoria:</label>
                        <input id="id-new-category-up" class="form-control" type="text" disabled>
                    </div>
                    <div class="form-group col">
                        <label for="name-new-category-up">Nombre de la categoria:</label>
                        <input id="name-new-category-up" class="form-control" type="text" require>
                    </div>
                    <div class="form-group col">
                        <label for="description-category-up">Descripción:</label>
                        <input id="description-category-up" class="form-control" type="text" require>
                    </div>
                    <div class="form-group col d-flex align-items-end ">
                        <button type="submit" class="btn btn-primary btn-block">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/js/data-tables.min.js"></script>
<script src="views/assets/js/inventory.js"></script>