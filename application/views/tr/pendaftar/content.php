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
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Sekolah</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th style="width: 60px;">Tanggal</th>
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
							<input type="text" class="form-control form-filter input-sm" name="order_id">
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
<!-- BEGIN PAGE LEVEL PLUGINS 
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/select2/select2.min.js"></script>-->
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
            "serverSide":true,
            "ajax":"<?php echo base_url()?>index.php/<?php echo $page_id;?>/retrieveData",
            "initComplete": function(){
                $('#table-option').html($('.DTTT_container').html());
				$('.DTTT_container').hide();
            }
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
        
        <?php echo $initJs?>
        var key='<?php echo $key;?>';
        if(key!=''){
            $(".dataTables_filter").find('input').val(key);
            table.search( key ).draw();   
        }
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
    function edit_<?php echo $page_id;?>(id){
        Metronic.startPageLoading({animate: true});

        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_form",{id:id}, function( data ) {
          $( "#page-content-inner" ).html( data );
          breadcrumb_edit<?php echo $page_id;?>();
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
    function IjinkanIsiDataDiri(id){
        bootbox.confirm("Mengijinkan pendaftar mengulang proses isi data diri akan <strong>menghapus</strong> proses selanjutnya, <strong>(Penentuan Jalur Penerimaan, Ujian, Penerimaan Mahasiswa dan Daftar Ulang)</strong>. Apa anda yakin ingin melanjutkan ?", function(result) {
            if(result){
                $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/ijinkanIsiDataDiri",{id:id}, function( data ) {
                  if(data.isOk){
                    toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                  }else{
                    toastr['error'](data.msg, "<?php echo $page_info['Nama_Menu']?>");
                  };
                },'json');
            }
        });
    }
</script>
<?php echo $js_global_method?>