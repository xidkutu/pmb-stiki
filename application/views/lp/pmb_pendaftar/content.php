<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>

<div class="row">
	<div class="col-md-12">
		<!-- Begin: life time stats -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?php echo $page_info['Nama_Menu']?></span>
					<span class="caption-helper"><?php echo $page_info['Keterangan']?></span>
				</div>
				<div class="actions" id="table-option">					                  
                </div>                
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<table id="data_<?php echo $page_id;?>" class="table table-responsive table-striped table-bordered table-hover ">
							<thead>								                           
								<tr>
									<th class="sort-alpha">Tanggal</th>
									<th class="sort-alpha">Nama</th>
									<th class="sort-alpha">Propinsi</th>
									<th class="sort-alpha">Kota</th>
									<th class="sort-alpha">Sekolah Asal</th>                                    
                                    <th class="sort-alpha">Email</th>
                                    <th class="sort-alpha">Telp</th>
                                    <th class="sort-alpha" width="5%">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>	
                                <tr>
									<td><input type="text" class="form-control"></td>
									<td><input type="text" class="form-control"></td>									
									<td><input type="text" class="form-control"></td>
									<td><input type="text" class="form-control"></td>
								    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>                                    
                                    <td><input type="text" class="form-control"></td>
                                    <td></td>
								</tr> 							
							</tfoot>
						</table>
						<table id="temp-export"></table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
    <div class="temp_export">
        <table id="temp_data_<?php echo $page_id;?>"></table>
    </div>
    <?php if(isset($modal)) echo $modal;?>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->



<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
    $(document).ready(function(){

        /* begin - date range */
        var tglmulai=getdatenow_mysql();
        var tglsmp=getdatenow_mysql();
        
        /* i Datatables */        
        var datatable;
        datatable = $('#data_<?php echo $page_id;?>').DataTable({
            "aLengthMenu":[[10,50,100,150,200,300,-1],[10,50,100,150,200,300,"All"]],
			"serverSide": true,            
			"ajax":{
                 'url' :'<?php echo base_url()?>index.php/<?php echo $page_id?>/get_datatable',
				"data": function ( d ) {
					d.tglmulai = tglmulai;
					d.tglsmp = tglsmp;
				}
			},
			"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable   
            "tableTools": {
                "sSwfPath": "<?php echo base_url('assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf'); ?>",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF"
                }, {
                    "sExtends": "csv",
                    "sButtonText": "CSV"
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Print",
                    "sInfo": 'Please press "CTRL+P" to print or "ESC" to quit',
                    "sMessage": "Generated by DataTables"
                }, {
                    "sExtends": "copy",
                    "sButtonText": "Copy"
                }]
			},
            "initComplete" : function()
			{
				$('.DTTT_container').prepend('<div id="daterangepicker2" class="btn default"><i class="fa fa-calendar"></i>&nbsp; <span></span><b class="fa fa-angle-down"></b></div> &nbsp;');
				$('#table-option').html($('.DTTT_container').html());
				$('.DTTT_container').hide();
				
				$('#daterangepicker2').daterangepicker({
					format: 'DD-MM-YYYY',
					startDate: moment(),
					endDate: moment(),
					minDate: '01/01/2012',
					maxDate: '12/31/2015',
					dateLimit: { days: 365 },
					showDropdowns: true,
					showWeekNumbers: true,
					timePicker: false, 
					timePickerIncrement: 1,
					timePicker12Hour: true,
					ranges: {
					   'Today': [moment(), moment()],
					   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					   'This Month': [moment().startOf('month'), moment().endOf('month')],
					   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					opens: 'left',
					drops: 'down',
					buttonClasses: ['btn', 'btn-sm'],
					applyClass: 'btn-primary',
					cancelClass: 'btn-default',
					separator: ' to ',
					locale: {
						applyLabel: 'Submit',
						cancelLabel: 'Cancel',
						fromLabel: 'From',
						toLabel: 'To',
						customRangeLabel: 'Custom',
						daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],                
		//                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
						firstDay: 1
					}
				}, function(start, end, label) {        
					$('#daterangepicker2 span').html(start.format('DD-MM-YYYY') + ' s/d ' + end.format('DD-MM-YYYY'));
					tglmulai = start.format('YYYY-MM-DD');
					tglsmp   = end.format('YYYY-MM-DD');        
					datatable.draw();
				});
				
				$('#daterangepicker2 span').html(getdatenow()+' s/d '+getdatenow()); 				
			}
            
		});				
		
		datatable.columns().eq( 0 ).each( function ( colIdx ) {
			$( 'input, select', datatable.column( colIdx ).footer() ).on( 'keyup change', function () {
				datatable.column( colIdx ).search( this.value ).draw();
			} );
		} );
        /* e Datatables */        
        
                                   
        
        function getdatenow(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            
            if(dd<10) {
                dd='0'+dd
            } 
            
            if(mm<10) {
                mm='0'+mm
            } 
            
            today = dd+'-'+mm+'-'+yyyy;
            return today;
        }
        
        function getdatenow_mysql(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            
            if(dd<10) {
                dd='0'+dd
            } 
            
            if(mm<10) {
                mm='0'+mm
            } 
            
            today = yyyy+'-'+mm+'-'+dd;
            return today;
        }       
        /* end   - date range */
        
        
    });
    function setDefaultValue(){
        <?php echo $setDefaultValue?>
    }
    function setResetForm(){
        reset_validation();
        clear_form('<?php echo $Form_Id?>');
    	return false;
    }
    function lihat_<?php echo $page_id;?>(id){
        Metronic.startPageLoading({animate: true});
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_profile",{id:id}, function( data ) {
          $( "#page-content-inner" ).html( data );
          breadcrumb_lihat_<?php echo $page_id;?>();
          Metronic.stopPageLoading();
        });
    }
    function kartuUjian_<?php echo $page_id;?>(id){
        Metronic.startPageLoading({animate: true});

        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_kartuUjian",{id:id}, function( data ) {
          $( "#page-content-inner" ).html( data );
          breadcrumb_edit<?php echo $page_id;?>();
          Metronic.stopPageLoading();
        });
    }
    function breadcrumb_lihat_<?php echo $page_id;?>(){
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_profile_bc", function( data ) {
          $( ".breadcrumb" ).html( data );
        });
    }
    function breadcrumb_edit<?php echo $page_id;?>(){
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_edit_bc", function( data ) {
          $( ".breadcrumb" ).html( data );
        });
    }
</script>
<?php echo $js_global_method?>
