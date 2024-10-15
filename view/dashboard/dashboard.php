<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  

<!-- Estilo del dashboard -->
<link rel="stylesheet" href="asset\css\adashboard.css">

<div class="container-header-dashboard">
    <p class="titleAlert" ><strong>Panel De Control</strong></p>
    <div class="headerDashboard">
        <ul>
            <li><a href="#">Historial de usurios</a></li>
            <li><a href="#">Generar reportes</a></li>
            <li><a href="#">Configuraion</a></li>
            <li><a href="index.php?controller=users&action=logout">Salir</a></li>
        </ul>
    </div>
</div>

<div class="bottom-container">

    <div class="prog-status">

        <div class="header">
            <h4>Detalles</h4>
        </div>

        <div class="details">

            <div class="item">
                
                <h2>Bitacoras de viaje</h2>
                <p>Subidas: <?php echo $dataToView["data"]["packages"]['packagesEnable']; ?> <img width="20px" height="20px" src="asset\icon\bitacoraSubidas.png" ></p>
                <p>Ocultas: <?php echo $dataToView["data"]["packages"]['packagesDisable']; ?> <img width="20px" height="20px" src="asset\icon\bitacorasOcultas.png" ></p>
                <h2>Total: <?php echo $dataToView["data"]["packages"]['packages']; ?> </h2>
            </div>
            
            <div class="separator"></div>

            <div class="item">
                <h2>Pub. especiales</h2>
                <p>Subidas: <?php echo $dataToView["data"]["pubSpecials"]['pubSpecialsEnable']; ?> <img width="21px" height="21px" src="asset\icon\pubDisable.png" ></p>
                <p>Ocultas: <?php echo $dataToView["data"]["pubSpecials"]['pubSpecialsDisable']; ?> <img width="21px" height="21px"src="asset\icon\pubEnable.png"  ></p>
                <h2>Total: <?php echo $dataToView["data"]["pubSpecials"]['pubSpecials']; ?> </h2>
            </div>

        </div>

        <div class="details">

            <div class="item">
                <h2>Paquetes de viaje</h2>
                <p>habilitados: <?php echo $dataToView["data"]["packages"]['packagesEnable']; ?> <img width="19px" height="19px" src="asset\icon\Enable2.png" ></p>
                <p>Inhabilitados: <?php echo $dataToView["data"]["packages"]['packagesDisable']; ?> <img width="17px" height="17px" src="asset\icon\disable2.png" ></p>
                <h2>Total: <?php echo $dataToView["data"]["packages"]['packages']; ?> </h2>
            </div>
            
            <div class="separator"></div>

            <div class="item">
                <h2>Rutas de viaje</h2>
                <p>Subidas: <?php echo $dataToView["data"]["route"]['routeEnable']; ?> <img width="19px" height="19px" src="asset\icon\routeEnable.png" ></p>
                <p>Ocultas: <?php echo $dataToView["data"]["route"]['routeDisable']; ?> <img width="21px" height="21px" src="asset\icon\routeDisable.png" ></p>
                <h2>Total: <?php echo $dataToView["data"]["route"]['route']; ?> </h2>
            </div>

        </div>

        <div class="details">

            <div class="item">
                <h2>Usuarios Turistas</h2>
                <p>Activos: <?php echo $dataToView["data"]["userTourist"]['userTouristEnable']; ?> <img width="18px" height="18px" src="asset/icon/activo.png" ></p>
                <p>Baneados: <?php echo $dataToView["data"]["userTourist"]['userTouristDisable']; ?> <img width="18px" height="18px" src="asset/icon/baneado.png" ></p>
                <h2>Total: <?php echo $dataToView["data"]["userTourist"]['userTourist']; ?> </h2>
            </div>
            
            <div class="separator"></div>

            <div class="item">
                <h2>Preguntas Frecuentes</h2>
                <p>Subidas: <?php echo $dataToView["data"]["faq"]['faqEnable']; ?> <img width="20px" height="20px" src="asset\icon\faqEnable.png" ></p>
                <p>Ocultas: <?php echo $dataToView["data"]["faq"]['faqDisable']; ?> <img width="21px" height="21px" src="asset\icon\faqDisable.png" ></p>
                <h2>Total: <?php echo $dataToView["data"]["faq"]['faq']; ?> </h2>
            </div>

        </div>

        <!-- <canvas class="prog-chart"></canvas> -->

    </div>

    <div class="popular">
        <div class="header">
            <h4>Notificaciones</h4>
            <!-- <?php if($dataToView["data"]["numberNotification"] > 0){ ?>
                <a href="#">|<?php echo $dataToView["data"]["numberNotification"] ?>|</a>
            <?php }else{ ?>
                <a href="#">|0|</a>
            <?php } ?> -->
        </div>
        <?php 
        if($dataToView["data"]["nearbyTrip"] !== false){?>
            <p><b>Viaje mas sercano:</b><br>
            <?php echo $dataToView["data"]["nearbyTrip"]["title"];?>: 
            <?php echo $dataToView["data"]["nearbyTrip"]["departureDate"];?> 
                <br>
            <a href="#"></a>
            </p>
        <?php }else{ ?>
            <p><b>No hay viajes planificados</p></b>
        <?php } ?>
        
        <?php if($dataToView["data"]["packages"]['packagesDisable'] > 0){?>
            <p><b>Hay <?php echo $dataToView["data"]["packages"]['packagesDisable'] ;?> Reservaciones Pendientes.</b>
                <br>
            <a href="index.php?controller=packages&action=list">Ver Reservaciones</a>
            </p>
        <?php }else{ ?>
            <p><b>No hay reservaciones pendientes</b></p>
        <?php } ?>

        
        
    </div>


    <div class="upcoming">

        <div class="header">
            <h4>Viajes planificados</h4>
        </div>

        <div class="events">
            <?php
            if($dataToView["data"]["traveloffer"] !== false){
                foreach($dataToView["data"]["traveloffer"] as $data){ ?>
                <div class="item">
                    <div>
                        <img src="asset\icon\dashboard-clock.png" width="17px" height="17px">
                        <div class="event-info">
                            <a href="#"><?php echo $data['title'] ?></a>
                            <p><?php echo $data['departureDate'] ?> | Cupos: <?php echo $data['numberSlots'] ?></p>
                            
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
            <?php
                }
            }else{
            ?>
                <div class="item">
                    <div>
                        <img src="asset\icon\dashboard-clock.png" width="17px" height="17px">
                        <div class="event-info">
                            <b><p>No hay viajes planificados</p></b>
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
            <?php    
            }
            ?>

        </div>

    </div>
<!--////////////////////////////////// Switc alert //////////////////////////////////-->
<div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="dashboard"></div>
<script src="asset\js\scripts\alert.js"></script>
</div>

