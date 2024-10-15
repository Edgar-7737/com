<div>

<?php 
    $home= new homeController;

?>


<main  ><!-- caja del home --> 

    <div  ><!-- secciones -->
        <section class="card"> <!-- Rutas -->
            <?php 
                $dataToView['data'] = $home->callRoute(); 
                require_once "viewRoute.php"; 
            ?> <br>
        </section>

        <section class="card"> <!-- Paquetes -->
             <?php 
             $dataToView['data'] = $home->callPackage(); 
             require_once "viewPackage.php"; 
             ?> <br>
        </section>

    </div> 

    <div> <!-- Preguntas -->
        <section> <!-- Preguntas Frecuentes --> 
            <?php 
            $dataToView['data'] = $home->callFaqs(); 
            require_once "viewFaq.php";
            ?> <br>
        </section>
    </div>

    <div><!-- aside -->
        <section> <!-- Publicaciones Especiales -->
            <?php
               $dataToView['data'] = $home->callPubSpecial();
            //require_once "viewPubSpecial.php"; 
            ?> 
        </section>
    </div>

</main>

</div>