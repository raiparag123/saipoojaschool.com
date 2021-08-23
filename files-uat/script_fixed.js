$(document).ready(function() {
  $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
				exportOptions: {
                    columns: ':visible'
                },
				messageTop: 'This print was produced using the Print button for DataTables',
                customize: function ( win ){
					$(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position: fixed; top:50%; left:50%; margin-top: -50px; margin-left: -100px;" />'
                        );
						
					$(win.document.body).find( 'td' )
                        .addClass( 'dt-center' )
                        .css( 'font-size', 'inherit' );
					
				}
				
            },
			'pdf'
				
			
            
        ],
        
    } );
    // Setup - add a text input to each footer cell
    $('#example23 thead tr').clone(true).appendTo( '#example23 thead' );
    $('#example23 thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder=" '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } ); 
    } );
 
    var table = $('#example23').DataTable( {
        retrieve: true,
		orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [
            { width: '20%', targets: 1 }
        ],
        fixedColumns: true
    } );
	} );
