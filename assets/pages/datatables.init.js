/*
 Template Name: Fonik - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Datatable js
 */

$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        
    	responsive: {
            details: {
                type: 'column',
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 0, 'asc' ],
        // lengthChange: false,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel',  'colvis',
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 4, 5,6,7,8,9 ]
                }
            }]
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
} );