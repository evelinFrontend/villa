<div class="menu">
    <ul>
        <li class="main-item">
            <div>
                <img src="views/assets/icons/home.svg" class="icon-menu">
            </div>
            <a [routerLink]="['home']">Inicio</a>
        </li>
        <div class="liner"></div>
        <li class="main-item">
            <div>
            <img src="views/assets/icons/file.svg" class="icon-menu">
            </div>
            <a [routerLink]="['facturas']">Facturas</a>
        </li>
        <div class="liner"></div>
        <li class="main-item">
            <div>
            <img src="views/assets/icons/shopping-bag.svg" class="icon-menu">
            </div>
            <a [routerLink]="['inventario']">Inventario</a>
        </li>
        <div class="liner"></div>
        <li class="main-item">
            <div>
            <img src="views/assets/icons/bed.svg" class="icon-menu">
        </div>
        <a [routerLink]="['habitaciones']">Habitaciones</a>
    </li>
    <div class="liner"></div>
    <li class="main-item">
        <div>
            <img src="views/assets/icons/ticket-alt.svg" class="icon-menu">
        </div>
            <a [routerLink]="['promocion-cortesia']">Promociones y cortesias</a>
        </li>
        <div class="liner"></div>
        <li class="main-item">
            <div>
            <img src="views/assets/icons/user.svg" class="icon-menu">
            </div>
            <a [routerLink]="['pusuarios']">Usuarios</a>
        </li>
        <div class="liner"></div>
    </ul>
</div>