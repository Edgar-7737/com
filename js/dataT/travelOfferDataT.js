$(document).ready(function() {
    $('#tripTable').DataTable({
        "columnDefs": [
            {"width": "8%","targets": 0},
            {"width": "8%","targets": 1},
            {"width": "8%","targets": 2},
            {"width": "8%", "targets": 3},
            {"width": "8%","targets": 4},
            {"width": "8%","targets": 5},
            {"width": "10%","targets": 6},
            {"width": "8%","targets": 7},
            {"width": "10%","targets": 8},
            {"width": "7%", "targets": 9},
            {"width": "5%","targets": 10},
            {"width": "5%","targets": 11},
            {"width": "7%","targets": 12}
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});
