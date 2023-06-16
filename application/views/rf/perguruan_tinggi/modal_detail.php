<div id="<?php echo $page_id;?>ModalDetail" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalDetailTitle">Responsive & Scrollable</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
					<div class="row">
                        <table class="table table-striped table-hover" style="margin-left: 20px; margin-right: 20px;">
                        <?php echo $detTable?>
                        </table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn blue" onclick="<?php echo $page_id;?>_btnSaveClick()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function lihat_<?php echo $page_id;?>(id,text){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/lihat',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            fill_detail('<?php echo $Form_Id?>',data);
            document.getElementById('<?php echo $page_id;?>ModalDetailTitle').innerHTML='Ubah <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalDetail').modal('show');
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>