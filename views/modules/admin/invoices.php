<div class="content-main">
    <div class="slide-menu">
        <div class="slide-item w-50 border-slide" id="section-1">
            <p>Crear factura</p>
        </div>
        <div class="slide-item w-50" id="section-2">
            <p>Buscar facturas</p>
        </div>
        <div class="slide-item w-50 border-slide" id="section-3">
            <p>Configuracion de facturas</p>
        </div>
    </div>
    <div class="subcontent p-4" id="section-1-tab">
        <h4 class="pricipal-title mb-4">Crear Facturas</h4>
        <div class="row">
            <div class="col-9">
                <h4 class="pricipal-title mb-4">Crear una factura</h4>
                <p class="title-form font-weight-bold">Datos de la Habitación</p>
                <div class="row border-bottom">
                    <div class="form-group col">
                        <label for="user-name">Número de habitación:</label>
                        <input id="user-name" class="form-control" type="text" >
                    </div>
                    <div class="form-group col">
                        <label for="doc">Tiempo:</label>
                        <input id="doc" class="form-control" type="number">
                    </div>
                </div>
                <p class="title-form font-weight-bold">Datos del usuario</p>
                <div class="row border-bottom">
                    <div class="form-group col">
                        <label for="user-name">Nombre completo:</label>
                        <input id="user-name" class="form-control" type="text" >
                    </div>
                    <div class="form-group col">
                        <label for="doc">Numero de documento:</label>
                        <input id="doc" class="form-control" type="number">
                    </div>
                </div>
                <p class="title-form font-weight-bold">Descuentos</p>
                <div class="row border-bottom">
                    <div class="form-group col">
                        <label for="courtesy">Cortesia:</label>
                        <select id="courtesy" class="form-control" name="">
                            <option>1 hora</option>
                            <option>2 horas</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="additional-person">¿Persona adicional?</label>
                        <select id="additional-person" class="form-control" name="">
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="additional-person">¿Cuantas?</label>
                        <select id="additional-person" class="form-control" name="">
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <p class="title-form font-weight-bold">Formas de pago</p>
                <div class="row border-bottom">
                    <div class="form-group col">
                        <label for="payment-methods">Forma de pago:</label>
                        <select id="payment-methods" class="form-control">
                            <option>Text</option>
                            <option>Text</option>
                            <option>Text</option>
                            <option>Text</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="cant">Valor:</label>
                        <input id="cant" class="form-control" type="number">
                    </div>
                </div>
    
            </div>
            <div class="col-3 ">
                <p>restan tan</p>
            </div>
        </div>
    </div>
    <div class="subcontent p-4" id="section-2-tab">
       <h4 class="pricipal-title mb-4">Buscar facturas</h4>
       <div class="filter mb-4">
            <form id="form-search-invoice " required >
                <div class="form-row " required >
                    <div class="form-group col">
                        <label for="select-option">Buscar por:</label>
                        <select id="select-option" class="form-control">
                            <option value="number">Número de factura</option>
                            <option value="range">Rango de fecha</option>
                        </select>
                    </div>
                    <div class="form-group col number">
                        <label for="number-invoice">Numero de factura:</label>
                        <input id="number-invoice" class="form-control" type="number " required >
                    </div>
                    <div class="form-group col range">
                        <label for="date-init">Desde:</label>
                        <input id="date-init" class="form-control" type="date">
                    </div>
                    <div class="form-group col range">
                        <label for="date-finish">Hasta:</label>
                        <input id="date-finish" class="form-control" type="date">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
       </div>
       <div class="content-table">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">Factura Nro.</th>
            <th scope="col">Fecha</th>
                <th scope="col">valor</th>
                <th scope="col">opcioones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>123123</th>
                    <td>12 jun. 2018</td>
                    <td>20.000</td>
                    <td>
                        <p>ver</p>
                        <p>imprimir</p>
                    </td>
                </tr>
            </tbody>
            </table>
       </div>

    </div>
    <div class="subcontent p-4" id="section-3-tab">
        <h4 class="pricipal-title mb-4">Configurar Facturas</h4>
        <form id="config-invoce">
            <div class="row">
                <div class="form-group col">
                    <label for="prefix">Prefiro:</label>
                    <input id="prefix" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="resolution">Resolución:</label>
                    <input id="resolution" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="nit">Nit:</label>
                    <input id="nit" class="form-control" type="text " required >
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="business-name">Razón social:</label>
                    <input id="business-name" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="description">Descripción:</label>
                    <input id="description" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="phone">Teléfono:</label>
                    <input id="phone" class="form-control" type="text " required >
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="adress">Dirección:</label>
                    <input id="adress" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="city">Ciudad:</label>
                    <input id="city" class="form-control" type="text " required >
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="config-date-init">fecha inicial:</label>
                    <input id="config-date-init" class="form-control" type="date" required >
                </div>
                <div class="form-group col">
                    <label for="config-date-finish">Fecha final:</label>
                    <input id="config-date-finish" class="form-control" type="date" required >
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="range-init">Rango inicial:</label>
                    <input id="range-init" class="form-control" type="text " required >
                </div>
                <div class="form-group col">
                    <label for="range-finish">Rango final:</label>
                    <input id="range-finish" class="form-control" type="text " required >
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="text">Leyenda:</label>
                    <textarea id="text" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <input id="logo" class="form-control-file" type="file" required >
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>
<script src="views/assets/js/invoices.js"></script>