<div id="<?php echo $page_id;?>ModalDetailProdi" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalDetailProdiTitle">Program Studi Perguruan Tinggi</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
					<div class="row">
					   <div class="portlet light">
                			<div class="portlet-title">
                				<div class="caption">
                					<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
                					<span class="caption-subject font-green-sharp bold uppercase" id="modal_title_pt_name">Program Studi</span>
                					<span class="caption-helper">Detail Program Studi Perguruan Tinggi</span>
                				</div>
                				<div class="actions">
                					<a href="#" class="btn btn-default btn-circle" onclick="<?php echo $page_id;?>_tambahDetail()">
                					<i class="fa fa-plus"></i>
                					<span class="hidden-480">
                					Tambah </span>
                					</a>
                                    <a href="#" class="btn btn-default btn-circle" onclick="reloadDetTable()">
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
                								<a href="#" onclick="doExportExcelDet_<?php echo $page_id;?>()">
                								Export to Excel </a>
                							</li>
                						</ul>
                					</div>
                				</div>
                			</div>
                			<div class="portlet-body">
                				<div class="table-container">
                					<table class="table table-striped table-bordered table-hover" id="dataDet<?php echo $page_id;?>">
                					<thead>
                					<tr role="row" class="heading">
                						<th style="width: 75px;">Kode Prodi</th>
                                        <th style="width: 75px;">Jenjang</th>
                                        <th>Nama Prodi</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
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
                						</td>
                					</tr>
                                    </tfoot>
                					</table>
                				</div>
                			</div>
                		</div>	
					</div>
				</div>
			</div>
            <input type="hidden" id="hid_temp_kodept"/>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn blue" onclick="<?php echo $page_id;?>_btnSaveClick()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function master_detail_<?php echo $page_id;?>(id,text){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/setViewForDetail',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            if(data.isOk){
                $("#hid_temp_kodept").val(id);
                var table = $('#dataDet<?php echo $page_id;?>').dataTable().fnDestroy();
                
                var table = $('#dataDet<?php echo $page_id;?>').DataTable({
                    "processing":true,
                    "serverSide":true,
                    "ajax":"<?php echo base_url()?>index.php/<?php echo $page_id;?>/retrieveDataDetail"
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
                
                $('#modal_title_pt_name').html(text);
                $('#<?php echo $page_id;?>ModalDetailProdi').modal('show');
            }else{
                toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
        		return false;       
            }
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
function <?php echo $page_id;?>_tambahDetail(){
    document.getElementById('<?php echo $page_id;?>ModalInputDetailTitle').innerHTML='Tambah Program Studi';
    $('#<?php echo $page_id;?>ModalInputDetail').modal('show');
    clear_form('form_prodi_pt');
    $(".form_prodi_pt#saveas").val('baru');
    $(".form_prodi_pt#Kode_PT").val($("#hid_temp_kodept").val());
    $(".form_prodi_pt#Kode_Prodi").removeAttr('readonly');
}
function reloadDetTable(){
    var table = $('#dataDet<?php echo $page_id;?>').DataTable().ajax.reload();
}
function doExportExcelDet_<?php echo $page_id;?>(){
    var colCount = -1;
    $('#dataDet<?php echo $page_id;?> tr:nth-child(1) th').each(function () {
        if ($(this).attr('colspan')) {
            colCount += +$(this).attr('colspan');
        } else {
            colCount++;
        }
    });
    var tableContent = document.getElementById("dataDet<?php echo $page_id;?>").innerHTML;
    document.getElementById("temp_data_<?php echo $page_id;?>").innerHTML=tableContent;
    $("#temp_data_<?php echo $page_id;?> tfoot").remove();
    $("#temp_data_<?php echo $page_id;?> tr").find('td:eq('+colCount+'),th:eq('+colCount+')').remove();
    $("table#temp_data_<?php echo $page_id;?> div.bootstrap-switch-on" ).replaceWith( "YES" );
    $("table#temp_data_<?php echo $page_id;?> div.bootstrap-switch-off" ).replaceWith( "NO" );
    tableToExcel('temp_data_<?php echo $page_id;?>','PMB_<?php echo $page_id;?>');
    
    toastr['success']("Ekspor Excel berhasil !", "<?php echo $page_info['Nama_Menu']?>");
}
</script>