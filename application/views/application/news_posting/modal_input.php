<div id="<?php echo $page_id;?>ModalInput" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Responsive & Scrollable</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
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
function Keterangan_keyup(e){
    $("#Teaser").code($("#Keterangan").code().split("</p>")[0]);
}
function page_validation(){
    if($("#Keterangan").code().length>3100){
        toastr['error']("Isi berita melebihi batas maksimal karakter. Maksimal karakter adalah 3100, Jumlah karakter anda saat ini "+$("#Keterangan").code().length, "<?php echo $page_info['Nama_Menu']?>");
        return false;
    }else if($("#Teaser").code().length>3100){
        toastr['error']("Isi teaser melebihi batas maksimal karakter. Maksimal karakter adalah 3100, Jumlah karakter anda saat ini "+$("#Teaser").code().length, "<?php echo $page_info['Nama_Menu']?>");
        return false;
    }else return true
}
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>') && page_validation()){
        var string = generateDataString('<?php echo $Form_Id?>');
        Cookies.set('Keterangan', $("#Keterangan").code());
        Cookies.set('Teaser', $("#Teaser").code());
        
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
    	return false;
};
function edit_<?php echo $page_id;?>(id){
    setResetForm();
    reset_validation();
    var string = "id="+id;
	$.ajax({
		type	: 'POST',
		url		: "<?php echo base_url();?>index.php/<?php echo $page_id;?>/detail",
		data	: string,
		cache	: true,
		dataType : "json",
		success	: function(data){            
            fill_form("<?php echo $Form_Id?>",data);
            $("#Keterangan").code(data.Keterangan);
            $("#Teaser").code(data.Teaser);
            $(".<?php echo $Form_Id?>#saveas").val('edit');
            document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Ubah <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalInput').modal('show');
			return false;
		}
	});
	return false;
}
</script>