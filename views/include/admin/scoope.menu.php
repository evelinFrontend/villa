<div class="menu">
    <ul>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/home-gray.png" class="icon-menu">
                </div>
                <a href="home">Inicio</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2 ){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/bell-gray.png" class="icon-menu">
                </div>
                <a href="recepcion">Recepción</a>
            </li>
        <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1 || $_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item"> 
                <div>
                    <img src="views/assets/icons/file-gray.png" class="icon-menu">
                </div>
                <a href="facturas">Facturas</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/basket-gray.png" class="icon-menu">
                </div>
                <a href="inventario">Inventario</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/bed-gray.png" class="icon-menu">
                </div>
                <a href="habitaciones">Habitaciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/poll.png" class="icon-menu">
                </div>
                <a href="reportes">Reportes</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==1){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/setting-gray.png" class="icon-menu">
                </div>
                <a href="configuraciones">Configuraciones</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
        <?php if($_SESSION["DATA_USER"]["ROL"]==2){?>
            <li class="main-item">
                <div>
                    <img src="views/assets/icons/setting-gray.png" class="icon-menu">
                </div>
                <a href="">Cierres</a>
            </li>
            <div class="liner"></div>
        <?php  } ?>
    </ul>
</div>