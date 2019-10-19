<div class="menu">
    <ul>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item" onClick="goTo(this.id)" id="home">
                <div>
                    <img src="views/assets/icons/home-duo.png" class="icon-menu">
                </div>
                <a>Inicio</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2 ){?>
            <li class="main-item" onClick="goTo(this.id)" id="recepcion">
                <div>
                    <img src="views/assets/icons/bell-duo.png" class="icon-menu">
                </div>
                <a>Recepción</a>
            </li>
        <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item" onClick="goTo(this.id)" id="facturas"> 
                <div>
                    <img src="views/assets/icons/file-duo.png" class="icon-menu">
                </div>
                <a>Facturas</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item" onClick="goTo(this.id)" id="inventario">
                <div>
                    <img src="views/assets/icons/basket-duo.png" class="icon-menu">
                </div>
                <a>Inventario</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item" onClick="goTo(this.id)" id="habitaciones">
                <div>
                    <img src="views/assets/icons/bed-duo.png" class="icon-menu">
                </div>
                <a>Habitaciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item" onClick="goTo(this.id)" id="reportes">
                <div>
                    <img src="views/assets/icons/poll-duo.png" class="icon-menu">
                </div>
                <a>Reportes</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?> 
            <li class="main-item" onClick="goTo(this.id)" id="configuraciones">
                <div>
                    <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                </div>
                <a>Configuraciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item" onClick="goTo(this.id)" id="cierre">
                <div>
                    <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                </div>
                <a>Cierres</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 && $_SESSION["DATA_USER"]["ID"]==0){?>
            <li class="main-item" onClick="goTo(this.id)" id="AjustarFacturas">
                    <div>
                        <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                    </div>
                    <a>Ajustar facturas</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
    </ul>
</div>