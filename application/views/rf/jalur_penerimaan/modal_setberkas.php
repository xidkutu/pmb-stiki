<div class="modal" id="<?php echo $page_id;?>_modal_setBerkas">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="<?php echo $page_id;?>_modal_berkas_title" >Jalur Penerimaan</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green-haze">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa <?php echo $page_info['Icon']?>"></i>Pengaturan Berkas
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="javascript:;" onclick="reloadTableDet();" class="reload">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="panel-group accordion scrollable" id="accordion3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">
							Tambah Berkas </a>
							</h4>
						</div>
						<div id="collapse_3_1" class="panel-collapse collapse">
							<div class="panel-body">
								<form action="" class="frm_validation form-horizontal row-border" id="frm_validation3">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jalur Penerimaan</label>
                                        <div class="col-sm-6">
                                            <label class="control-label" id="berkas_Nama_JalurPenerimaan">Beasiswa Penuh</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Syarat</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="form_syarat_berkas" required="required">
                                            </select>
                                        </div>
                                        <input type="hidden" name="form_berkas_id_jalur" id="form_berkas_id_jalur" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                        </div>
                                        <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn_validation" onclick="<?php echo $page_id;?>_btnBerkasSaveClick()" >Save changes</button>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2">
							Daftar Syarat </a>
							</h4>
						</div>
						<div id="collapse_3_2" class="panel-collapse in">
							<div class="panel-body">
								<table id="dataDetBerkas<?php echo $page_id;?>" class="table table-striped table-bordered table-hover">
                                   <thead>
                                      <tr>
                                         <th class="sort-alpha">Id Berkas</th>
                                         <th class="sort-alpha">Detail Berkas</th>
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
    function <?php echo $page_id;?>_btnBerkasSaveClick(){
        if(validation('frm_validation3')==true){
    		var id_jalur=$("#form_berkas_id_jalur").val();
    		var berkas = $("#form_syarat_berkas").val();
              		
    		var string = "id_jalur="+id_jalur+"&berkas="+berkas;
  
    		$.ajax({
    			type	: 'POST',
    			url		: "<?php echo base_url(); ?>index.php/rf_pmb_jalur_penerimaan/saveBerkas",
    			data	: string,
    			cache	: false,
    			success	: function(data){
    				toastr['success']("Syarat baru berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                    $('#collapse_3_1').collapse('hide');
                    $('#collapse_3_2').collapse('show');
                    
                    //resetFormDetail();
                    reloadTableBerkas();
                    resetFormBerkas();
    			},
    			error : function(xhr, teksStatus, kesalahan) {
    				    toastr['error']("Syarat baru tidak berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
    				return false;
    			}
    		});
        }
		return false;
	};

    function reloadTableBerkas(){
        var table = $('#dataDetBerkas<?php echo $page_id;?>').DataTable().ajax.reload();
    }
    function resetFormBerkas(){
        $("#form_syarat_berkas").val('');
    }
    
    function setHapusDataBerkas(idBerkas){
        bootbox.confirm("Anda yakin ingin menghapus berkas dari jalur masuk ?", function(result) {
            if(result==true){
                var id_jalur=$("#form_berkas_id_jalur").val();
          		
                var string = "id_jalur="+id_jalur+"&idBerkas="+idBerkas;
                $.ajax({
        			type	: 'POST',
        			url		: "<?php echo base_url(); ?>index.php/rf_pmb_jalur_penerimaan/hapusBerkas",
        			data	: string,
        			cache	: false,
        			success	: function(data){
        				toastr['success']("Syarat berhasil dihapus", "<?php echo $page_info['Nama_Menu']?>");
                        reloadTableBerkas();
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