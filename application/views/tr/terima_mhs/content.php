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
					<table class="table table-striped table-bordered table-hover" id="data_<?php echo $page_id;?>">
					<thead>
					<tr role="row" class="heading">
						<th>Nama</th>
                        <th>Pilihan Prodi</th>
                        <th style="max-width: 100px;">Kelas</th>
                        <th style="max-width: 100px;">Jenis Masuk</th>
                        <th style="max-width: 100px;">Jalur</th>
                        <th>Prodi Diterima</th>
                        <th>Diterima</th>
                        <th>Aksi</th>
					</tr>
                    </thead>
					<tbody>
					</tbody>
                    <tfoot>
                    <tr role="row" class="filter">
						<td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
                        <td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
                        <td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
                        <td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
                        <td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
                        <td>
							<input type="text" class="form-control form-filter input-sm" name="order_id">
						</td>
						<td>
							<select name="order_status" class="form-control form-filter input-sm">
								<option value="">ALL</option>
								<option value="YES">YES</option>
                                <option value="Menunggu">Menunggu</option>
								<option value="NO">NO</option>
							</select>
						</td>
						<td>
						</td>
					</tr>
                    </tfoot>
					</table>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#data_<?php echo $page_id;?>').DataTable({
            "aLengthMenu":[[10,50,100,150,200,300,-1],[10,50,100,150,200,300,"All"]],
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            "serverSide":true,
            "ajax":"<?php echo base_url()?>index.php/<?php echo $page_id;?>/retrieveData",
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
            "initComplete": function(){
                $('#table-option').html($('.DTTT_container').html());
				$('.DTTT_container').hide();
            }
        });
        
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                    .column( colIdx-1 )
                    .search( this.value )
                    .draw();
            } );
        } );
        
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'select', table.column( colIdx ).footer() ).on( 'change', function () {
                table
                    .column( colIdx-1 )
                    .search( this.value )
                    .draw();
            } );
        } );
        
        table.on( 'draw', function () {
            //alert( 'Table redrawn' );
            $('.make-switch').bootstrapSwitch();
        } );
        <?php echo $initJs?>
    });
    function setDefaultValue(){
        <?php echo $setDefaultValue?>
    }
    function setResetForm(){
        reset_validation();
        clear_form('<?php echo $Form_Id?>');
    	return false;
    }
</script>
<?php echo $js_global_method?>
