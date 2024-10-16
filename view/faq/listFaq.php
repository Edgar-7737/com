    
<main>
    <div class="header">
        <div class="left">
            <h2>Preguntas Frecuentes</h2>
        </div>
    </div>

    <div class="bottom-data">
        <div >
            <div class="rift">
                <a class="enlaces" href="index.php?controller=faqs&action=addFaq"  title="Añadir"><button class="button-Rev2" >Añadir</button></a>
                <a href="index.php?controller=faqs&action=listFaqDisable" title="Visualizar Preguntas Frecuentes Inahabilitadas"><button class="button-Rev2" >Inhabilitados</button></a>                
            </div>           
        <table id="faqTable" class="display" style="width:100%" >
        <?php
            if(count($dataToView["data"]) > 0){ ?>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Opciones</th>
            </tr>
        </thead>    
        <tbody>
          <?php
              foreach($dataToView["data"] as $data) :
          ?>  
          <tr>
            <td><?php echo $data->query; ?></td>
            <td><?php echo $data->respond; ?></td>
            <td><a href="index.php?controller=faqs&action=editFaq&id=<?php echo $data->id_preg_frecuente;?>" title="Editar">
            <img src="asset/icon/edit.png" width=30px ></a>&nbsp&nbsp
            <a href="index.php?controller=faqs&action=status&opc=disable&id=<?php echo $data->id_preg_frecuente;?>" title="Inahabilitar">
            <img src="asset/icon/disable.png" width=30px></a></td>
          </tr>
       
        <?php 
          endforeach;
          }
        ?>
        
       </tbody>
      </table>
    </div>
<script>
    $(document).ready(function(){
        $('#faqTable').DataTable({
            "columnDefs": [
            { "width": "45%", "targets": 0 },
            { "width": "45%", "targets": 1 },
            { "width": "10%", "targets": 2 },
          
            ],
                "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
                "oAria": {
                     "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>
</div>
       

</main>