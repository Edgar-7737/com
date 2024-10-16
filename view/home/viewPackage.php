<!-- VISTA PARA LOS TURISTAS.. DETALLE DE Los paquetes (LLAMADO DESDE EL CONTROLHOME) -->

<section>   
        <h2>Paquetes</h2><br>
        <div class="horizontal-scroll">
        <?php if(count($dataToView["data"])>0){  ?>  
        
            <?php
            foreach($dataToView["data"] as $data){ 
            ?>
            <div class="route-item">
            <?php echo "Paquete #". $data['idPackages']; ?>
            <table border="1" width="300x" height= 150px>
            <thead><th><?php echo "Título: ". $data['title']; ?></th></thead>
    
            <tr><td><?php echo "Descripcion: ". $data['description']; ?></td></tr>
            <tr><td><?php echo "Transporte: ". $data['transport']; ?></td></tr>
            <tr><td><?php echo "Comida: ". $data['food']; ?></td></tr>
            <tr><td><?php echo "Hospedaje: ". $data['lodging']; ?></td></tr>
            <tr><td><?php echo "Precio: ".$data['price']; ?></td></tr>
            </table>
            </div>
            <br>
           <?php  
               }?>
               <?php
           }else{
           ?>
           <div>
               Actualmente No Hay Paquetes Disponibles.
           </div>
       <?php
           }
       ?>
       </div>
    </section>

  

