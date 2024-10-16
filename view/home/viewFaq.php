<!-- VISTA PARA LOS TURISTAS.. DETALLE DE Las PREGUNTAS FRECUENTES (LLAMADO DESDE EL CONTROLHOME) -->

<section class="card">   
        <h1>Pregunta Frecuentes</h1><br>
        <div >
        <?php if(count($dataToView["data"])>0){ $preg=1; ?>  
        
            <?php
            foreach($dataToView["data"] as $data){ 
            ?>
            <div class="card-data"  >
            <table border="0" width=200px>
                <tr><td><?php echo "P". $preg. ") ".  $data->query; ?></td></tr>
                <tr><td><?php echo "R". $preg. ") ". $data->respond; ?></td></tr>
            </table>
            </div>
            <br>
           <?php  
              $preg++; }?>
               <?php
           }else{
           ?>
        <div>
               Actualmente No Hay Preguntas Frecuentes Disponibles.
           </div>
       <?php
           }
       ?>
       </div>
    </section>
    
