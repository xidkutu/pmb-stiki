<div class="modal" id="<?php echo $page_id;?>_modal_setsyarat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="<?php echo $page_id;?>_modal_input_title" >Ujian Masuk</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green-haze">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa <?php echo $page_info['Icon']?>"></i>Mata Ujian
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="javascript:;" onclick="reloadTableDet();" class="reload">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="panel-group accordion scrollable" id="accordion2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1">
							Tambah Mata Ujian </a>
							</h4>
						</div>
						<div id="collapse_2_1" class="panel-collapse collapse">
							<div class="panel-body">
								<form action="" class="frm_validation form-horizontal row-border" id="frm_validation2">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Program Studi</label>
                                        <div class="col-sm-6">
                                            <label class="control-label" id="det_ProgramStudi">Beasiswa Penuh</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mata Ujian</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="form_ujian_mata_ujian" required="required">
                                            </select>
                                        </div>
                                        <input type="hidden" name="form_ujian_kode_prodi" id="form_ujian_kode_prodi" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                        </div>
                                        <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn_validation" onclick="<?php echo $page_id;?>_btnSyaratSaveClick()" >Save changes</button>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2">
							Daftar Mata Ujian </a>
							</h4>
						</div>
						<div id="collapse_2_2" class="panel-collapse in">
							<div class="panel-body">
								<table id="dataDet<?php echo $page_id;?>" class="table table-striped table-bordered table-hover">
                                   <thead>
                                      <tr>
                                         <th class="sort-alpha">Id Syarat</th>
                                         <th class="sort-alpha">Detail Syarat</th>
                                         <th class="sort-alpha">Action</th>
                                      </tr>
                                   </thead>
                                   <tfoot>
                                         <tr>
                                            <th>
                                               <input type="text" name="filter_id" placeholder="Filter Id" class="form-control input-sm datatable_input_col_search">
                                            </th>
                                            <th>
                                               <input type="text" name="filter_nama" placeholder="Filter Detail" class="form-control input-sm datatable_input_col_search">
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
			</div>
		</div>              
      </div><!-- /.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    function <?php echo $page_id;?>_btnSyaratSaveClick(){
        if(validation('frm_validation2')==true){
    		var Kode_Prodi=$("#form_ujian_kode_prodi").val();
    		var Mata_Ujian = $("#form_ujian_mata_ujian").val();
              		
    		var string = "Kode_Prodi="+Kode_Prodi+"&Mata_Ujian="+Mata_Ujian;
  
    		$.ajax({
    			type	: 'POST',
    			url		: "<?php echo base_url(); ?>index.php/rf_pmb_ujian_masuk/saveMataUjian",
    			data	: string,
    			cache	: false,
    			success	: function(data){
    				toastr['success']("Mata ujian berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                    $('#collapse_2_1').collapse('hide');
                    $('#collapse_2_2').collapse('show');
                    
                    resetFormDetail();
                    reloadTableDet();
                    reloadTable();
    			},
    			error : function(xhr, teksStatus, kesalahan) {
    				    toastr['error']("Mata ujian tidak berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
    				return false;
    			}
    		});
        }
		return false;
	};

    function reloadTableDet(){
        var table = $('#dataDet<?php echo $page_id;?>').DataTable().ajax.reload();
    }
    function resetFormDetail(){
        $("#form_ujian_mata_ujian").val('');
    }
    
    function setHapusDataDetail(Id_Mata_Ujian){
        bootbox.confirm("Anda yakin ingin menghapus mata ujian dari ujian masuk ?", function(result) {
            if(result==true){
                var Kode_Prodi=$("#form_ujian_kode_prodi").val();
          		
                var string = "Kode_Prodi="+Kode_Prodi+"&Mata_Ujian="+Id_Mata_Ujian;
                $.ajax({
        			type	: 'POST',
        			url		: "<?php echo base_url(); ?>index.php/rf_pmb_ujian_masuk/hapusMataUjian",
        			data	: string,
        			cache	: false,
        			success	: function(data){
        				toastr['success']("Mata ujian berhasil dihapus", "<?php echo $page_info['Nama_Menu']?>");
                        
                        reloadTableDet();
                        reloadTable();
        			},
        			error : function(xhr, teksStatus, kesalahan) {
        				toastr['error']("<?php echo $page_info['Nama_Menu']?> tidak berhasil dihapus", "<?php echo $page_info['Nama_Menu']?>")
        				return false;
        			}
        		});  
            }
        });
    }
    
</script>