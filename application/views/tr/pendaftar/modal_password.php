<div id="<?php echo $page_id;?>ModalInput" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Ubah Password Pendaftar</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
					<div class="row">
						<?php echo $form;?>
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
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>') && ($("#pwd").val()==$("#re_pwd").val())){
        var string = generateDataString('<?php echo $Form_Id?>');
        
    	$.ajax({
    		type	: 'POST',
    		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/simpan_pwd',
    		data	: string,
    		cache	: false,
            dataType : "json",
    		success	: function(data){
    		 if(data.isOk){
                toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                $('#<?php echo $page_id;?>ModalInput').modal('toggle');   
                reloadTable();
    		 }else{
                toastr['error']("Tidak berhasil menyimpan perubahan, hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    		 }
    		},
    		error : function(xhr, teksStatus, kesalahan) {
    			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    			return false;
            }
    	});
        }else{
            $("#form-group-re_pwd").addClass('has-error');
            $("#re_pwd").after('<span id="name-error-re_pwd" class="help-block help-block-error">Password tidak sama.</span>');
        }
    	return false;
};
function ubah_password<?php echo $page_id;?>(id){
    $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getProfileCamaba_pwd",{id:id}, function( data ) {
        setResetForm();
        reset_validation();
        fill_form('form_pmb_ubah_pass_pendaftar',data);
        $('#<?php echo $page_id;?>ModalInput').modal('show');
    	return false;
    },'json');
}
</script>