<script src="js/facebookSDK.js"></script>

<!-- jQuery 3 -->
<script src="<?= base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



<!-- DataTables -->
<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- cuando concluye el cargado de la pagina muestra la ventana modal	-->
<script type="text/javascript">
	$(document).ready(function(){
		$('#modal-primary').modal()
	});
</script>

<!-- formato de tablas para exportacion -->
<script>
  $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#Jtablapagos_cliente').DataTable({
      //orderCellsTop: true,
      //responsive:true,
      order: [[ 1, 'asc' ]],
      //responsive:true,
      pageLength: 10,
      pagingType: 'numbers',
      ordering: true,
      columns: [
      { orderable: false },
      { orderable: null },
      //HABILITA EL ORDENAMIENTO POR LA TERCERA COLUMNA CUANDO SE PUNE null, en las otras columnas estan descantivas el ordenamiento null,
      { orderable: false },
      { orderable: false },
      { orderable: false }
      ],

      dom: 'Bt<"row"<"col-4"><"col-4 text-center"p>>',
      
      buttons: [
      {
        extend:'excelHtml5',
        text:'<i class="fa fa-file-excel-o"></i>',
        titleAttr:'Exportar a excel',
        className:'btn btn-success',
        title: $('#Jtablapagos_cliente').data("export-title"),
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4]
        }
      },
      {
        extend:'pdfHtml5',
        text:'<i class="fa fa-file-pdf-o"></i>',
        titleAttr:'Exportar a pdf',
        className:'btn btn-danger',
        title: $('#Jtablapagos_cliente').data("export-title"),
        orientation: 'landscape',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4]
        }
      },

      {
        extend:'print',
        text:'<i class="fa fa-print"></i>',
        titleAttr:'Imprimir',
        className:'btn btn-info',
        title: $('#Jtablapagos_cliente').data("export-title"),
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4]
        }
      }
      ],


          //searching: true,
          language: {
            sProcessing:     "Procesando...",
            sLengthMenu:     "Mostrar _MENU_ registros",
            //"sLengthMenu":     "",
            sZeroRecords:    "No se encontraron resultados",
            sEmptyTable:     "Ningún registro disponible!",
            //"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfo:           "",
            sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix:    "",
            sSearch:         "Buscar en todo:",
            sUrl:            "",
            sInfoThousands:  ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
              sFirst:    "Primero",
              sLast:     "Último",
              sNext:     "Siguiente",
              sPrevious: "Anterior"
            }
          }

        });
  });
</script>


<!-- Para cambiar al español los mensajes  por defecto	-->
<script type="text/javascript">
	$(document).ready(function(){
		$.extend( $.fn.dataTable.defaults, {
			searching: false,
			ordering:  false,
			pageLength: 4,
			lengthChange: false

		} );
		$('#tablalistado').DataTable({
			"language":{
				"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
			}
		});

	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$.extend( $.fn.dataTable.defaults, {
			searching: false,
			ordering:  false,
			pageLength: 2,
			lengthChange: false,
			info:false
		} );
		$('#tablalistadopublis').DataTable({
			"language":{
				"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
			}
		});

		$('#tablalistadoresolus').DataTable({
			"language":{
				"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
			}
		});

		$('#tablalistadodoscols').DataTable({
			"language":{
				"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
			}
		});

	});
</script>
<!-- Para cambiar estilo de tablas de cuerpo	-->
<script type="text/javascript">
	$(document).ready(function(){
		$.extend( $.fn.dataTable.defaults, {
			searching: false,
			ordering:  false,
			pageLength: 2,
			lengthChange: false,
			info:false
		} );
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#render-data').dataTable({
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			responsive: true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			},
			"paging": true,
			"processing": true,
			'serverMethod': 'post',
			dom: 'lBfrtip',
			buttons: [
			'excel', 'csv', 'pdf', 'print', 'copy',
			],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		} );
	} );

</script>





<!-- FastClick -->
<script src="<?= base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?= base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url();?>assets/bower_components/chart.js/Chart.js"></script>



<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
		})
	})
</script>


</body>
</html>
