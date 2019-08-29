<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50" id="section-1">
            <p>Listado de productos</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-2">
            <p>Listado de categorias</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-3">
            <p>Promociones</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Listado de productos</h4>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-product">
            Nuevo producto
        </button>
        <div class="content-table">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1233</th>
                        <td>coca-cola</td>
                        <td>bebidas</td>
                        <td>el man ese</td>
                        <td>5.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="subcontent p-4" id="section-2-tab">
        <h4 class="pricipal-title mb-4">Listado de categorias</h4>
        <div class="content-crear">
            <p>Crear una categoria</p>
                <form id="form-create-category" class="d-flex">
                    <div class="form-group col">
                        <label for="name-product">Nombre de la categoria:</label>
                        <input id="name-product" class="form-control" type="text" require>
										</div>
										<div class="form-group col d-flex align-items-end ">
											<button type="submit" class="btn btn-primary btn-block">Crear</button>
										</div>
                </form>
        </div>
        <div class="content-table">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1233</th>
                        <td>bebidas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="subcontent p-4" id="section-3-tab">
        <h4 class="pricipal-title mb-4">Promociones y descuentos</h4>
        <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal"
            data-target="#create-category">
            nueva promoción
        </button>
        <div class="content-table">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1233</th>
                        <td>bebidas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal crear producto -->
<div id="create-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nuevo producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4">
                <form id="form-create-product">
                    <div class="form-group">
                        <label for="name-product">Nombre del producto:</label>
                        <input id="name-product" class="form-control" type="text" require>
                    </div>
                    <div class="form-group">
                        <label for="value-product">Valor:</label>
                        <input id="value-product" class="form-control" type="number" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select id="category" class="form-control">
                            <option>Text</option>
                            <option>Text</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="provider">Proveedor:</label>
                        <select id="provider" class="form-control">
                            <option>Text</option>
                            <option>Text</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal crear categoria -->
<div id="create-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Crear un nueva categoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4">

            </div>
        </div>
    </div>
</div>