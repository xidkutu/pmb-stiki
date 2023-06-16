<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
						 Widget settings form goes here
					</div>
					<div class="modal-footer">
						<button type="button" class="btn blue">Save changes</button>
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN STYLE CUSTOMIZER -->
		<div class="theme-panel hidden-xs hidden-sm">
			<div class="toggler">
			</div>
			<div class="toggler-close">
			</div>
			<div class="theme-options">
				<div class="theme-option theme-colors clearfix">
					<span>
					THEME COLOR </span>
					<ul>
						<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
						</li>
						<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
						</li>
						<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
						</li>
						<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
						</li>
						<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
						</li>
						<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
						</li>
					</ul>
				</div>
				<div class="theme-option">
					<span>
					Layout </span>
					<select class="layout-option form-control input-small">
						<option value="fluid" selected="selected">Fluid</option>
						<option value="boxed">Boxed</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Header </span>
					<select class="page-header-option form-control input-small">
						<option value="fixed" selected="selected">Fixed</option>
						<option value="default">Default</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Mode</span>
					<select class="sidebar-option form-control input-small">
						<option value="fixed">Fixed</option>
						<option value="default" selected="selected">Default</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Menu </span>
					<select class="sidebar-menu-option form-control input-small">
						<option value="accordion" selected="selected">Accordion</option>
						<option value="hover">Hover</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Style </span>
					<select class="sidebar-style-option form-control input-small">
						<option value="default" selected="selected">Default</option>
						<option value="light">Light</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Position </span>
					<select class="sidebar-pos-option form-control input-small">
						<option value="left" selected="selected">Left</option>
						<option value="right">Right</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Footer </span>
					<select class="page-footer-option form-control input-small">
						<option value="fixed">Fixed</option>
						<option value="default" selected="selected">Default</option>
					</select>
				</div>
			</div>
		</div>
		<!-- END STYLE CUSTOMIZER -->
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		<?php echo $page_title?> <small><?php echo $page_title?></small>
		</h3>
		<div class="page-bar">
			<?php echo $breadcrumb?>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Aksi <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="#" onclick="<?php echo str_replace(' ','_',$page_title);?>_tambah();">Tambah</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
                <div class="portlet box green-haze">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-university"></i>
                            <?php echo $page_title;?>
						</div>
						<div class="tools">
							<a href="javascript:;" class="reload" onclick="reloadTable()">
							</a>
						</div>
					</div>
                    <div class="portlet-body">
        				<table id="data<?php echo str_replace(' ','_',$page_title);?>" class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sort-alpha">Id Syarat</th>
                                 <th class="sort-alpha">Detail Syarat Daftar</th>
                                 <th class="sort-alpha">Aktif</th>
                                 <th class="sort-alpha">Action</th>
                              </tr>
                           </thead>
                           <tfoot>
                                 <tr>
                                    <th>
                                       <input type="text" name="filter_kode" placeholder="Filter Id Syarat" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_nama" placeholder="Filter Syarat Pendaftaran" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <select name="filter_aktif" placeholder="Filter Aktif" class="form-control input-sm datatable_input_col_search">
                                            <option value="">Semua</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                       </select>
                                    </th>
                                    <th>
                                       
                                    </th>
                                 </tr>
                              </tfoot>
                           <tbody>
                           </tbody>
                        </table>
                    </div>
                </div>
                
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        
        var table = $('#data<?php echo str_replace(' ','_',$page_title);?>').DataTable({
            "processing":true,
            "serverSide":true,
            "ajax":"<?php echo base_url()?>index.php/rf_pmb_syarat_daftar/retrieveData"
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
    });
    
    function reloadTable(){
        var table = $('#data<?php echo str_replace(' ','_',$page_title);?>').DataTable().ajax.reload();
    }
    
    function <?php echo str_replace(' ','_',$page_title);?>_tambah(){
        resetForm();
        document.getElementById('<?php echo str_replace(' ','_',$page_title);?>_modal_input_title').innerHTML='Tambah <?php echo $page_title?>';
        $('#<?php echo str_replace(' ','_',$page_title);?>_modal_input').modal('show');
    }
    
    function setHapusData(id,nama){
        bootbox.confirm("Anda yakin ingin menghapus syarat pendaftaran "+nama+" ?", function(result) {
            if(result==true){
                var string="id="+id;
                $.ajax({
        			type	: 'POST',
        			url		: "<?php echo base_url(); ?>index.php/rf_pmb_syarat_daftar/hapus",
        			data	: string,
        			cache	: false,
        			success	: function(data){
        				toastr['success']("<?php echo $page_title?> berhasil dihapus", "<?php echo $page_title?>")
                        reloadTable();
        			},
        			error : function(xhr, teksStatus, kesalahan) {
        				toastr['error']("<?php echo $page_title?> tidak berhasil dihapus", "<?php echo $page_title?>")
        				return false;
        			}
        		});  
            }
        });
    }
    
    function editData(id,det){
        $("#form_id_syarat").val(id);
        $("#form_detail_syarat").val(det);
        document.getElementById('<?php echo str_replace(' ','_',$page_title);?>_modal_input_title').innerHTML='Edit <?php echo $page_title;?>';
        $('#<?php echo str_replace(' ','_',$page_title);?>_modal_input').modal('show');
    }
    
    function setChangeActive(id){
        var string="id="+id;
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/rf_pmb_syarat_daftar/changeAktif",
			data	: string,
			cache	: false,
			success	: function(data){
				toastr['success']("Perubahan aktif/non-aktif tersimpan", "<?php echo $page_title?>");
                reloadTable();
			},
			error : function(xhr, teksStatus, kesalahan) {
                toastr['error']("Perubahan aktif/non-aktif gagal", "<?php echo $page_title?>");
				return false;
			}
		});
    }
</script>
