<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  

<style>
.container-dashboard {
    text-align: center;
    background-color: #2c3e50;
    padding: 10px;
    box-shadow: 1px 1px 2px 3px rgba(189, 189, 189, 1);
    
}

.parentAlert {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 20px;
        background-color: #2c3e50; /* Fondo azul oscuro */
}

.common-style-Alert {
    border-radius: 3px;
    border: none;
    padding: 5px; /* Reduce el padding */
    box-shadow: 0 4px 8px rgba(0,0,0,.3); /* Sombra para profundidad */
    margin: auto; /* Margen automático según el contenido */
}

.alert-animated-1 {
    background-color: #27ae60;
    transition: transform .2s; /* Transición suave al pasar el cursor */
}

.alert-animated-1:hover {
    transform: scale(1.04); /* Aumenta ligeramente el tamaño al pasar el cursor */
    cursor: pointer;
}
.alert-animated-2 {
    background-color: #f39c12;
    animation: wobble-bottom 2s ease-in-out infinite;
    animation-delay: 1s; /* Para que se repita cada 3 segundos */
    
}
.alert-animated-2:hover {
    cursor: pointer;
}
    @keyframes wobble-bottom {
  0%, 100% {
    transform: translateY(0);
  }
  25% {
    transform: translateY(3px);
  }
  50% {
    transform: translateY(-3px);
  }
  75% {
    transform: translateY(3px);
  }
}



    .p-alert {
        font-size: 16px; /* Reduce el tamaño de la fuente */
        color: white;
        margin-bottom: 10px;
        font-weight: bold; /* Texto en negrita */
        text-align: center; /* Centra el texto */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Estilo de fuente moderno */
    }

    /* Estilos específicos para cada alerta para añadir colores distintos */



.parent {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(4, 1fr);
    grid-column-gap: 30px;
    grid-row-gap: 30px;
    border-radius: 15px; 
    place-items: center; 
} 



.div1 { grid-area: 1 / 1 / 2 / 2; }
.div2 { grid-area: 1 / 2 / 2 / 3; }
.div3 { grid-area: 1 / 3 / 2 / 4; }
.div4 { grid-area: 2 / 1 / 3 / 2; }
.div5 { grid-area: 2 / 2 / 3 / 3; }
.div6 { grid-area: 2 / 3 / 3 / 4; }
.div7 { grid-area: 3 / 1 / 4 / 2; }
.div8 { grid-area: 3 / 2 / 4 / 3; }
.div9 { grid-area: 3 / 3 / 4 / 4; }
.div10 { grid-area: 4 / 1 / 5 / 2; }
.div11 { grid-area: 4 / 2 / 5 / 3; }
.div12 { grid-area: 4 / 3 / 5 / 4; } 


.flex-container {
    display: inline-flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: stretch;
    align-content: stretch;
    height: auto;
    width: 250px;
    
 
}

.flex-items:nth-child(1) {
    display: block;
    flex-grow: 0;
    flex-shrink: 1;
    flex-basis: auto;
    align-self: center;
    text-align: center;
    order: 0;
    padding: 7px;
    border-radius: 10px; 
    transition: transform .2s;
}

.flex-items:nth-child(1):hover {
        transform: scale(1.25); 
        cursor: pointer;
    }

    

.flex-items:nth-child(2) {
    display: block;
    flex-grow: 1;
    flex-shrink: 1;
    flex-basis: auto;
    align-self: flex-start;
    order: 0;
    padding: 10px;
}

.common-style {
   /*  background-color: whitesmoke; /* Color de fondo más agradable */ 
    border-radius: 10px; /* Bordes redondeados */
    text-align: right; /* Centrar texto */
    color: black;/* Color de letra más oscuro */
    padding: 10px;
    box-shadow: 1px 1px 2px 3px rgba(189, 189, 189, 1);
}

.titleAlert{
    font-size: 28px;
    color: white;
}

.titleParent {
    color: black;
    font-size: 18px; /* Fuente para títulos */
}

.paragraph-large {
    font-size: 14px; /* Fuente para párrafos grandes */
}

.img-dashboard{
    width: 50px ;
    height:50px ;
}

.link-color{
   color: black;
}


</style>


<?php
date_default_timezone_set('America/Caracas'); 
$hora = date('H');
if ($hora >= 0 && $hora < 12) {$hello = "Buenos días";} else if ($hora >= 12 && $hora < 19) {$hello = "Buenas tardes";} else {$hello = "Buenas noches";}
?>

<div class="container-dashboard">

   
    
    <p class="titleAlert" ><strong>hola! <?php echo $_SESSION['user']['name']." ".$hello."<br><br>" ;?> </strong> </p>
    
    <div class="parentAlert">
        
           
    </div>
            <!--  <div class="div1Alert common-style-Alert  <?php //  echo ($dataToView["data"]["packages"]['packagesDisable'] > 0)? "alert-animated-2" : "alert-animated-1" ; ?>">
            <?php // if($dataToView["data"]["packages"]['packagesDisable'] > 0 ){ ?>
                <p class="p-alert">solicitudes de Reservaciones</p>
           <?php // }else{ ?>
                <p class="p-alert">No hay Reservaciones</p>     
            <?php // } ?>
            </div>
        
            <div class="div2Alert common-style-Alert alert-animated-1">
            <?php // if($dataToView["data"]["packages"]['packagesDisable'] > 0 ){ ?>
                <p class="p-alert">Ver ofertas de viaje vigentes</p>
            <?php // }else{ ?>
                <p class="p-alert">No hay ofertas de viaje vigente</p>   
            <?php // } ?>
            </div>
 
            <div class="div3Alert common-style-Alert alert-animated-1"> 
                <p class="p-alert">Generar Reporte</p>
            </div> -->

 </div>



<div class="parent"><!-- //////////////////////////////////// -->

    <div class="div1  common-style">
        <div class="flex-container">
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=packages&action=list">
                    <svg class='bx img-dashboard' xmlns="http://www.w3.org/2000/svg" width="24" height="25.6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex-items">
            <h1 class="titleParent" >Reservaciones</h1>
                <p class="paragraph-large" ></a>Aprobadas:    <?php echo $dataToView["data"]["userPublicist"]['userPublicistEnable'];?><img src="asset/icon/reservacionAprobada.png" width=25px></p>
                <p class="paragraph-large" ></a>Rechasadas: <?php echo $dataToView["data"]["userPublicist"]['userPublicistDisable'];?><img src="asset/icon/reservacionRechasada.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["userPublicist"]['userPublicist'];?></strong></p>
            </div>
        </div>
    </div>
    <div class="div2  common-style"> 
        <div class="flex-container">
            
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=packages&action=list">
                    <svg class='bx img-dashboard' xmlns="http://www.w3.org/2000/svg" width="24" height="25.6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 12h2a7.986 7.986 0 0 1 2.337-5.663 7.91 7.91 0 0 1 2.542-1.71 8.12 8.12 0 0 1 6.13-.041A2.488 2.488 0 0 0 17.5 7C18.886 7 20 5.886 20 4.5S18.886 2 17.5 2c-.689 0-1.312.276-1.763.725-2.431-.973-5.223-.958-7.635.059a9.928 9.928 0 0 0-3.18 2.139 9.92 9.92 0 0 0-2.14 3.179A10.005 10.005 0 0 0 2 12zm17.373 3.122c-.401.952-.977 1.808-1.71 2.541s-1.589 1.309-2.542 1.71a8.12 8.12 0 0 1-6.13.041A2.488 2.488 0 0 0 6.5 17C5.114 17 4 18.114 4 19.5S5.114 22 6.5 22c.689 0 1.312-.276 1.763-.725A9.965 9.965 0 0 0 12 22a9.983 9.983 0 0 0 9.217-6.102A9.992 9.992 0 0 0 22 12h-2a7.993 7.993 0 0 1-.627 3.122z"></path><path d="M12 7.462c-2.502 0-4.538 2.036-4.538 4.538S9.498 16.538 12 16.538s4.538-2.036 4.538-4.538S14.502 7.462 12 7.462zm0 7.076c-1.399 0-2.538-1.139-2.538-2.538S10.601 9.462 12 9.462s2.538 1.139 2.538 2.538-1.139 2.538-2.538 2.538z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex-items">
            <h1 class="titleParent" >Bitacoras de viaje</h1>
                <p class="paragraph-large" ></a>Subidas:    <?php echo $dataToView["data"]["route"]['routeEnable'];?><img src="asset/icon/bitacoraSubidas.png" width=25px></p>
                <p class="paragraph-large" ></a>Ocultas: <?php echo $dataToView["data"]["route"]['routeDisable'];?><img src="asset/icon/bitacorasOcultas.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["route"]['route'];?></strong></p>
            </div>
        </div>
    </div>
    <div class="div3  common-style"> 
        <div class="flex-container">
            
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=trip&action=listTripEnabled"><img class='bx img-dashboard' src="asset/icon/trip2.png" ></a>
            </div>
            

            <div class="flex-items">
            <h1 class="titleParent" >Ofertas de viaje</h1>
                <p class="paragraph-large" ></a>En oferta:    <?php echo $dataToView["data"]["traveloffer"]['travelofferEnable'];?><img src="asset/icon/viajeOferta.png" width=25px></p>
                <p class="paragraph-large" ></a>Ocultas: <?php echo $dataToView["data"]["traveloffer"]['travelofferDisable'];?><img src="asset/icon/viajeOculto.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["traveloffer"]['traveloffer'];?></strong></p>
            </div>
            
        </div>
    </div>
    <div class="div4  common-style"> 
        <div class="flex-container">
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=users&action=list&userType=turista&status=1">
                    <svg class='bx  img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex-items">
            <h1 class="titleParent" >Usuarios turistas</h1>
                <p class="paragraph-large" ></a>Activos:    <?php echo $dataToView["data"]["userTourist"]['userTouristEnable'];?><img src="asset/icon/activo.png" width=21px></p>
                <p class="paragraph-large" ></a>Baneados: <?php echo $dataToView["data"]["userTourist"]['userTouristDisable'];?><img src="asset/icon/baneado.png" width=20px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["userTourist"]['userTourist'];?></strong></p>
            </div>
            
        </div>
        
    </div>
    <div class="div5  common-style"> 
    <div class="flex-container">
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=pubEspecial&action=list">
                    <svg class='bx  img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z"></path>
                    </svg>
                </a>
            </div>
            <div class="flex-items">
            <h1 class="titleParent" >Publicaciones Especiales</h1>
                <p class="paragraph-large" ></a>Habilitados:    <?php echo $dataToView["data"]["pubSpecials"]['pubSpecialsEnable'];?><img src="asset/icon/enable2.png" width=25px></p>
                <p class="paragraph-large" ></a>Deshabilitados: <?php echo $dataToView["data"]["pubSpecials"]['pubSpecialsDisable'];?><img src="asset/icon/disable2.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["pubSpecials"]['pubSpecials'];?></strong></p>
            </div>
        </div>
    </div>
    <div class="div6  common-style">
        <div class="flex-container">
            
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=faqs&action=listFaq">
                    <svg class='bx  img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 6a3.939 3.939 0 0 0-3.934 3.934h2C10.066 8.867 10.934 8 12 8s1.934.867 1.934 1.934c0 .598-.481 1.032-1.216 1.626a9.208 9.208 0 0 0-.691.599c-.998.997-1.027 2.056-1.027 2.174V15h2l-.001-.633c.001-.016.033-.386.441-.793.15-.15.339-.3.535-.458.779-.631 1.958-1.584 1.958-3.182A3.937 3.937 0 0 0 12 6zm-1 10h2v2h-2z"></path><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex-items">
            <h1 class="titleParent" >Preguntas frecuentes</h1>
                <p class="paragraph-large" ></a>Habilitados:    <?php echo $dataToView["data"]["faq"]['faqEnable'];?><img src="asset/icon/enable2.png" width=25px></p>
                <p class="paragraph-large" ></a>Deshabilitados: <?php echo $dataToView["data"]["faq"]['faqDisable'];?><img src="asset/icon/disable2.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["faq"]['faq'];?></strong></p>
            </div>
            
        </div>
    </div>
    <div class="div7  common-style"> 
        <div class="flex-container">
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=packages&action=list">
                    <svg class='bx img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22 8a.76.76 0 0 0 0-.21v-.08a.77.77 0 0 0-.07-.16.35.35 0 0 0-.05-.08l-.1-.13-.08-.06-.12-.09-9-5a1 1 0 0 0-1 0l-9 5-.09.07-.11.08a.41.41 0 0 0-.07.11.39.39 0 0 0-.08.1.59.59 0 0 0-.06.14.3.3 0 0 0 0 .1A.76.76 0 0 0 2 8v8a1 1 0 0 0 .52.87l9 5a.75.75 0 0 0 .13.06h.1a1.06 1.06 0 0 0 .5 0h.1l.14-.06 9-5A1 1 0 0 0 22 16V8zm-10 3.87L5.06 8l2.76-1.52 6.83 3.9zm0-7.72L18.94 8 16.7 9.25 9.87 5.34zM4 9.7l7 3.92v5.68l-7-3.89zm9 9.6v-5.68l3-1.68V15l2-1v-3.18l2-1.11v5.7z"></path>
                    </svg> 
                </a>
            </div>

            <div class="flex-items">
                <h1  class="titleParent" >Paquetes de viaje</h1>
          
                <p class="paragraph-large" ></a>Habilitados:    <?php echo $dataToView["data"]["packages"]['packagesEnable'];?><img src="asset/icon/enable2.png" width=25px></p>
                <p class="paragraph-large" ></a>Deshabilitados: <?php echo $dataToView["data"]["packages"]['packagesDisable'];?><img src="asset/icon/disable2.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["packages"]['packages'];?></strong></p>
            </div>
        </div>
    </div>

    <div class="div8  common-style"> 
        <div class="flex-container">
            
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=route&action=listRouteEnabled">
                    <svg class='bx img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z"></path><path d="M11.42 21.814a.998.998 0 0 0 1.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.005.021 4.438-4.388 8.423-6 9.73-1.611-1.308-6.021-5.294-6-9.735 0-3.309 2.691-6 6-6z"></path>
                    </svg> 
                </a>    
            </div>
            <div class="flex-items">
            <h1 class="titleParent" >Rutas de viaje</h1>
                <p class="paragraph-large" ></a>Habilitados:    <?php echo $dataToView["data"]["route"]['routeEnable'];?><img src="asset/icon/enable2.png" width=25px></p>
                <p class="paragraph-large" ></a>Deshabilitados: <?php echo $dataToView["data"]["route"]['routeDisable'];?><img src="asset/icon/disable2.png" width=25px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["route"]['route'];?></strong></p>
            </div>
        </div>
    </div>

    <div class="div9  common-style"> 
        <div class="flex-container">
            
            <div class="flex-items  leftStyleInsights">
                <a class="link-color" href="index.php?controller=users&action=list&userType=publicista&status=1">
                    <svg class='bx  img-dashboard' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex-items">
            <h1 class="titleParent" >Usuarios Publicista</h1>
                <p class="paragraph-large" ></a>Activos:    <?php echo $dataToView["data"]["userPublicist"]['userPublicistEnable'];?><img src="asset/icon/activo.png" width=21px></p>
                <p class="paragraph-large" ></a>Baneados: <?php echo $dataToView["data"]["userPublicist"]['userPublicistDisable'];?><img src="asset/icon/baneado.png" width=20px></p>
                
                <p class="titleParent" ><strong>Total:<?php echo $dataToView["data"]["userPublicist"]['userPublicist'];?></strong></p>
            </div>
            
        </div>
    </div>

<!-- <div class="div10  common-style"> </div>
<div class="div11  common-style"> </div>
<div class="div12  common-style"> </div> -->


    </div> <!-- /////////////parent/////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->




        
        
