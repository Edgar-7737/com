//data table dinamico para todas las tablas 
// Distrubuye el acho de las columnas equitativamente de manera automatica
$(document).ready(function(){
    var table = $('table').DataTable();
    var columnCount = table.columns().header().length;
    var columnWidth = 100 / columnCount; // Calcula el ancho en porcentaje

    var columnDefs = [];
    for (var i = 0; i < columnCount; i++) {
        columnDefs.push({ "width": columnWidth + "%", "targets": i });
    }

    table.destroy(); // Destruye la instancia existente de DataTable
    $('table').DataTable({
        "columnDefs": columnDefs,
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




