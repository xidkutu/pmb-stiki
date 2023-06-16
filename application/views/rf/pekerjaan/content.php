<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
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
				<div class="actions">
					<a href="#" class="btn btn-default btn-circle" onclick="<?php echo $page_id;?>_tambah()">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">
					Tambah </span>
					</a>
                    <a href="#" class="btn btn-default btn-circle" onclick="reloadTable()">
					<i class="fa fa-refresh"></i>
					<span class="hidden-480">
					Refresh </span>
					</a>
					<div class="btn-group">
						<a class="btn btn-default btn-circle" href="#" data-toggle="dropdown">
						<i class="fa fa-share"></i>
						<span class="hidden-480">
						Tools </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#" onclick="doExportExcel_<?php echo $page_id;?>()">
								Export to Excel </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="data_<?php echo $page_id;?>">
					<thead>
					<tr role="row" class="heading">
						<th>ID Pekerjaan</th>
                        <th>Nama Pekerjaan</th>
                        <th>Keterangan</th>
                        <th>Aktif</th>
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
							<select name="order_status" class="form-control form-filter input-sm">
								<option value="">ALL</option>
								<option value="YES">YES</option>
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

<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#data_<?php echo $page_id;?>').DataTable({
            "iDisplayLength":10,
            "aLengthMenu":[[10,50,100,150,200,300,-1],[10,50,100,150,200,300,"All"]],
            "order":[[0,"asc"]],
            "processing":true,
            "serverSide":true,
            "ajax":"<?php echo base_url()?>index.php/<?php echo $page_id;?>/retrieveData"
        });
        
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                    .column( colIdx )
                    .search( this.value )
                    .draw();
            } );
        } );
        
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'select', table.column( colIdx ).footer() ).on( 'change', function () {
                table
                    .column( colIdx )
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
    function <?php echo $page_id;?>_tambah(){
        document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Tambah <?php echo $page_info['Nama_Menu']?>';
        $('#<?php echo $page_id;?>ModalInput').modal('show');
        setResetForm();
        $(".<?php echo $Form_Id?>#saveas").val('baru');
    }
    function setResetForm(){
        reset_validation();
        clear_form('<?php echo $Form_Id?>');
    	return false;
    }
</script>
<?php echo $js_global_method?>
