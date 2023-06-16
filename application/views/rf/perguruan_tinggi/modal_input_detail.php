<div id="<?php echo $page_id;?>ModalInputDetail" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputDetailTitle">Responsive & Scrollable</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
					<div class="row">
						<?php echo $detForm['form'];?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn blue" onclick="<?php echo $page_id;?>_btnSaveDetClick()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function <?php echo $page_id;?>_btnSaveDetClick(){
    if(validation('form_prodi_pt')){
        var string = generateDataString('form_prodi_pt');
    	$.ajax({
    		type	: 'POST',
    		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/simpanDetail',
    		data	: string,
    		cache	: false,
            dataType : "json",
    		success	: function(data){
    		 if(data.isSuccess){
                toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                $('#<?php echo $page_id;?>ModalInputDetail').modal('toggle'); 
                reloadDetTable();   
    		 }else{
                toastr['error']("Tidak berhasil menyimpan perubahan, hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    		 }
    		},
    		error : function(xhr, teksStatus, kesalahan) {
    			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    			return false;
            }
    	});
        }
    	return false;
};
function editDet_<?php echo $page_id;?>(pt,id){
    var string = 'id='+id+'&pt='+pt;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/lihatDetail',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            setResetForm();
            reset_validation();
            fill_form('form_prodi_pt',data);
            $(".form_prodi_pt#Kode_Prodi").attr('readonly','readonly');
            $(".form_prodi_pt#saveas").val('ubah');
            document.getElementById('<?php echo $page_id;?>ModalInputDetailTitle').innerHTML='Ubah Program Studi';
            $('#<?php echo $page_id;?>ModalInputDetail').modal('show');
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>