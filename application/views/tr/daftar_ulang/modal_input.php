<div id="<?php echo $page_id;?>ModalInput" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Responsive & Scrollable</h4>
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
var $input = $('.form_tr_daftar_ulang#NRP_DaftarUlang');
$("#isDaftar_Ulang").change(function(){
   cond_form($("#isDaftar_Ulang")); 
})
function cond_form($daft){
    if($daft.val()=='YES'){
        $("#form-group-Tgl_DaftarUlang").show(400);
        $("#form-group-NRP_DaftarUlang").show(400);
    }else{
        $("#form-group-Tgl_DaftarUlang").hide(400);
        $("#form-group-NRP_DaftarUlang").hide(400);
    }
}
function isNRPUsed(nrp){
    
}
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>')){
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/isNrpUsed",{nrp:$input.val(),id:$(".form_tr_daftar_ulang#Id_Camaba").val()}, function( data ){
            if(data.isExist){
                toastr['error']("NRP telah digunakan !", "<?php echo $page_info['Nama_Menu']?>");   
                $(".form_tr_daftar_ulang#NRP_DaftarUlang").val(data.NRP_DaftarUlang);
            }else{
                var string = generateDataString('<?php echo $Form_Id?>');
        
            	$.ajax({
            		type	: 'POST',
            		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/simpan',
            		data	: string,
            		cache	: false,
                    dataType : "json",
            		success	: function(data){
            		 if(data.isSuccess){
                        toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                        $('#<?php echo $page_id;?>ModalInput').modal('toggle'); 
                        reloadTable()   
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
        },'json');
    }
   	return false;
};
function edit_<?php echo $page_id;?>(id,text){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/lihat',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            setResetForm();
            reset_validation();
            fill_form('<?php echo $Form_Id?>',data);
            $(".<?php echo $Form_Id?>#saveas").val('ubah');
            document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Ubah <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalInput').modal('show');
            cond_form($("#isDaftar_Ulang")); 
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>