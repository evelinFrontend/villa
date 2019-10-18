<div class="menu">
    <ul>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/home-duo.png" class="icon-menu">
                </div>
                <a href="home">Inicio</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2 ){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/bell-duo.png" class="icon-menu">
                </div>
                <a href="recepcion">Recepción</a>
            </li>
        <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item"> 
                <div>
                    <img src="views/assets/icons/file-duo.png" class="icon-menu">
                </div>
                <a href="facturas">Facturas</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/basket-duo.png" class="icon-menu">
                </div>
                <a href="inventario">Inventario</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/bed-duo.png" class="icon-menu">
                </div>
                <a href="habitaciones">Habitaciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/poll-duo.png" class="icon-menu">
                </div>
                <a href="reportes">Reportes</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?> 
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                </div>
                <a href="configuraciones">Configuraciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                </div>
                <a href="cierre">Cierres</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 && $_SESSION["DATA_USER"]["ID"]==0){?>
            <li class="main-item">
                    <div>
                        <img src="views/assets/icons/setting-duo.png" class="icon-menu">
                    </div>
                    <a href="AjustarFacturas">Ajustar facturas</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
    </ul>
</div>