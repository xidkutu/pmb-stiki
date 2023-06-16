<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<div id="<?php echo $page_id;?>ModalInput" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Responsive & Scrollable</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
					<div class="row">
						<table class="table table-striped table-hover" style="margin-left: 20px; margin-right: 20px;">
                        <?php echo $detTable?>
                        </table>
                        <?php echo $form?>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("a#single_image").fancybox();

	/* Using custom settings */
	
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});

	/* Apply fancybox to multiple items */
	
	$("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>')){
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
    	return false;
};

function edit_<?php echo $page_id;?>(id){
    Metronic.startPageLoading({animate: true});
    setResetForm();
    reset_validation();
    var string = "id="+id;
	$.ajax({
		type	: 'POST',
		url		: "<?php echo base_url();?>index.php/<?php echo $page_id;?>/getDetaiStatus",
		data	: string,
		cache	: true,
		dataType : "json",
		success	: function(data){  
            fill_detail("<?php echo $Form_Id?>",data);
            fill_form("<?php echo $Form_Id?>",data);
            $("#detail_IdFile").html('<a id="single_image" href="'+data.UrlFile+'"><img src="'+data.UrlFile+'" style="width: 60%;;"/></a>')
            //$(".<?php echo $Form_Id?>#saveas").val('edit');
            document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Ubah <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalInput').modal('show');
            Metronic.stopPageLoading();
			return false;
		}
	});
    Metronic.stopPageLoading();
	return false;
}
</script>