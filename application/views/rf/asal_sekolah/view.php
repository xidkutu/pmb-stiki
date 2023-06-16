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
							<a href="#" onclick="asal_sekolah_tambah();">Tambah</a>
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
        				<table id="dataSekolah" class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sort-alpha">Kode</th>
                                 <th class="sort-alpha">Nama Sekolah</th>
                                 <th class="sort-alpha">Alamat</th>
                                 <th class="sort-alpha">Kota</th>
                                 <th class="sort-alpha">Telepon</th>
                                 <th class="sort-alpha">Email</th>
                                 <th class="sort-alpha">Action</th>
                              </tr>
                           </thead>
                           <tfoot>
                                 <tr>
                                    <th>
                                       <input type="text" name="filter_kode" placeholder="Filter Kode" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_nama" placeholder="Filter Nama" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_alamat" placeholder="Filter Alamat" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_kota" placeholder="Filter Kota" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_telp" placeholder="Filter Telepon" class="form-control input-sm datatable_input_col_search">
                                    </th>
                                    <th>
                                       <input type="text" name="filter_email" placeholder="Filter Email" class="form-control input-sm datatable_input_col_search">
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
        
        var table = $('#dataSekolah').DataTable({
            "processing":true,
            "serverSide":true,
            "ajax":"<?php echo base_url()?>index.php/rf_pmb_asal_sekolah/retrieveData"
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
        
    });
    
    function reloadTable(){
        var table = $('#dataSekolah').DataTable().ajax.reload();
    }
    
    function asal_sekolah_tambah(){
        resetForm();
        document.getElementById('sekolah_modal_input_title').innerHTML='Tambah Sekolah';
        $('#sekolah_modal_input').modal('show');
    }
    
    function setHapusSekolah(id,nama,kota){
        bootbox.confirm("Anda yakin ingin menghapus sekolah "+nama+" "+kota+" ?", function(result) {
            if(result==true){
                var string="id="+id;
                $.ajax({
        			type	: 'POST',
        			url		: "<?php echo base_url(); ?>index.php/rf_pmb_asal_sekolah/hapus",
        			data	: string,
        			cache	: false,
        			success	: function(data){
        				toastr['success']("Sekolah berhasil dihapus", "Sekolah")
                        var table = $('#dataSekolah').DataTable().ajax.reload();
        			},
        			error : function(xhr, teksStatus, kesalahan) {
        				toastr['error']("Sekolah tidak berhasil dihapus", "Sekolah")
        				return false;
        			}
        		});  
            }
        });
    }
    
    function editSekolah(id){
        var string="id="+id;
        $.ajax({
        type    :'POST',
        url     : "<?php echo base_url(); ?>index.php/rf_pmb_asal_sekolah/getDetail",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            $("#form_kode_sma").val(data.Kode_SMU);
            $("#form_sma_prop").val(data.Kode_Prop);
            getDaftarKota(data.Kode_Kota);
            $("#form_sma_kota").val('');
            $("#form_sma_nama").val(data.Asal_SMU);
            $("#form_sma_alamat").val(data.Alamat_SMU);
            $("#form_sma_telp").val(data.Telp);
            $("#form_sma_email").val(data.Email);
            
            document.getElementById('sekolah_modal_input_title').innerHTML='Edit Sekolah';
            $('#sekolah_modal_input').modal('show');
          },
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Terjadi kesalahan dalam mengambil data sekolah", "Sekolah")
			return false;
		}
        });
    }
</script>
