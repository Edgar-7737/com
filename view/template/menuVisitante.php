<div class="sidebar" >
    <div class="estyle-sidebar" >
    <div><!-- Bienvenido al Usuario -->
        <?php if(isset($_SESSION['user']))
        { echo "Bienvenido ";?>
        <br><img src="asset/icon/usuario.png" alt=""><br>
        <?php echo $_SESSION['user']['email'];}?>
    </div>

    <nav>
        <ul>
            <li><img src="asset/icon/menuu.png"   width=25px  alt=""> 
            <a href="index.php?controller=home" title="Inicio"><button class="button-Rev2" >HOME</button></a></li>

            <li><img src="asset/icon/estacion.png"   width=25px  alt=""> 
            <a href="index.php?controller=home&action=dashBoard" title="Escritorio de trabajo"><button class="button-Rev2" >Escritorio de trabajo</button></a></li>

            <li><img src="asset/icon/bitacora.png"  width=25px alt="">
            <a href="index.php?controller= " title="Bitacoras de Viaje"><button class="button-Rev2" >Bitacoras</button></a></li>

            <li> <img src="asset/icon/comentariobitacora.png"  width=25px alt="">
            <a href="index.php?controller= " title="Comentarios"><button class="button-Rev2" >Comentarios</button></a></li>

            <li><img src="asset/icon/route.png"  width=25px alt="">
            <a href="index.php?controller=route&action=listRouteEnabled" title="Rutas de Viaje"><button class="button-Rev2" >Rutas</button></a></li>

            <li><img src="asset/icon/paquete.png"  width=25px alt="">
            <a href="index.php?controller=packages&action=list" title="Paquetes de Viaje"><button class="button-Rev2" >Paquetes</button></a></li>
            
            <li><img src="asset/icon/promocion.png"  width=25px alt="">
            <a href="index.php?controller=pubEspecial&action=list" title="Publicaciones Especiales"><button class="button-Rev2" >Publicaciones Especiales</button></a></li>

            <li><img src="asset/icon/encuesta.png"  width=25px alt="">
            <a href="index.php?controller= " title="Solicitud de Reservaciones"><button class="button-Rev2" >Solicitud de Reservaciones</button></a></li>

            <li><img src="asset/icon/reservaciones.png"  width=25px alt="">
            <a href="index.php?controller= " title="Reservaciones"><button class="button-Rev2" >Reservaciones</button></a></li>
        
       
        </ul>
    </nav>
    </div>
</div>