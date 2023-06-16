<div id="<?php echo $page_id;?>ModalInput" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Responsive & Scrollable</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:150px" data-always-visible="1" data-rail-visible1="1" id="my-scr">
					<div class="row">
						<?php echo $form[0];?>
                        <form action="" class="form-horizontal row-border">
                            <div class="form-group" id="form-group-pilpro" style="display: none;">
                                <label class="col-sm-3 control-label">Pilihan Program Studi</label>
                                <div class="col-sm-8" style="margin-left: 15px;">
                                    <div class="form-group" id="form-group-prodi" style="margin-bottom: 0px;">
                            			
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php echo $form[1];?>
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
<div style="display: none;">
<div id="opt-prodi">
<option value>--Pilih--</option>
<?php 
foreach($opt['prodi']->result_array() as $opt){
    echo "<option value='".$opt['Kode_Prodi']."' data-par='".$opt['param']."' data-info='".$opt['info']."'>".$opt['caption']."</option>";
}
?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('select#Kode_Prodi').html($('div#opt-prodi').html());
})
$('select#IsDiterima').change(function(){
    if($(this).val()=='YES'){
        $('div#form-group-pilpro').show(400);
        $('div#form-group-Kode_Prodi').show(400);
        $('div#my-scr').css('height','300px');
        $('div.slimScrollDiv').css('height','300px');
    }else{
        $('div#form-group-pilpro').hide(400);
        $('div#form-group-Kode_Prodi').hide(400);
        $('div#my-scr').css('height','150px');
        $('div.slimScrollDiv').css('height','150px');   
    }
})
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>')){
        var string = genDataStringByClass('<?php echo $Form_Id?>');
        
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
            $("#form-group-prodi").html(data.det_prodi);
            if(data.Kode_Prodi!=null && data.Kode_Prodi.length>0) $("select#Kode_Prodi").val(data.Kode_Prodi);   
            else $("select#Kode_Prodi").val($("#form-group-prodi li.list-group-item:first").attr('data-id'));
            $('select#IsDiterima').trigger('change');
            $(".<?php echo $Form_Id?>#saveas").val('ubah');
            document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Ubah <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalInput').modal('show');
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>