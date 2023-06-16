<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<div id="<?php echo $page_id;?>ModalInput" class="modal container fade" tabindex="-1">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title" id="<?php echo $page_id;?>ModalInputTitle">Full Width</h4>
	</div>
	<div class="modal-body">
		<div class="scroller" id="sroller-modal" style="height:400px" data-always-visible="1" data-rail-visible1="1">
			<div class="row">
                <div class="col-lg-7">
                    <div class="panel panel-info">
    					<div class="panel-heading">
    						<h3 class="panel-title">Tentukan Jalur Penerimaan</h3>
    					</div>
    					<div class="panel-body">
    					   <?php echo $form[0];?>
                           <form action="" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilihan Program Studi</label>
                                    <div class="col-sm-8" style="margin-left: 15px;">
                                        <div class="form-group" id="form-group-prodi" style="margin-bottom: 0px;">
                                			
                                        </div>
                                    </div>
                                </div>
                            </form>  
                            <?php echo $form[1];?>
                            <form action="" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Syarat</label>
                                    <div class="col-sm-8" style="margin-left: 15px;">
                                        <div class="form-group" id="form-group-syarat">
                                			
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php echo $form[2];?>       	 
    					</div>
    				</div>
                </div>
                <div class="col-lg-5">
                    <div class="panel panel-info">
    					<div class="panel-heading">
    						<h3 class="panel-title">Berkas Diupload</h3>
    					</div>
    					<div class="panel-body" id="syarat_uploaded">
    					   
    					</div>
    				</div>
                </div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button type="button" class="btn blue" onclick="<?php echo $page_id;?>_btnSaveClick()">Save changes</button>
	</div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
    var typingTimer;                //timer identifier
    var doneTypingInterval = <?php echo $doneTypingInterval;?>;  //time in ms, 3 second for example
    var $input = $('.form_set_ujian_masuk#No_Ujian');
    
    //on keyup, start the countdown
    $input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
        
    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });
    
    //user is "finished typing," do something
    function doneTyping () {
      //do something
      //isNoUjianUsed($input.val());
    }
function showForm(data){
    if($(".form_set_ujian_masuk#isUjian").val()=='YES' || data=='YES'){
        $("#form-group-Tgl_Ujian").show(400);
        $("#form-group-Waktu_Mulai").show(400);
        $("#form-group-Waktu_Selesai").show(400);
        $("#form-group-No_Ujian").show(400);
    }else{
        $("#form-group-Tgl_Ujian").hide(400);
        $("#form-group-Waktu_Mulai").hide(400);
        $("#form-group-Waktu_Selesai").hide(400);
        $("#form-group-No_Ujian").hide(400);
    }
}
//$(".form_set_ujian_masuk#No_Ujian").blur(function(){
//    isNoUjianUsed($(this).val(),false);
//})
$(".form_set_ujian_masuk#isUjian").change(function(){
    showForm('');
})
$(".form_set_ujian_masuk#Jalur_Penerimaan").change(function(){
  getSyaratJalur($(".form_set_ujian_masuk#Jalur_Penerimaan").val(),$(".form_set_ujian_masuk#Id_Camaba").val());  
});
function getSyaratJalur(id,idCamaba){
    $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getSyaratAjax",{idJalur:id,Id_Camaba:idCamaba}, function( data ){
      $("#form-group-syarat").html(data.syarat);
      $(".form_set_ujian_masuk#No_Ujian").val(data.No_Ujian);
    },'json');
}

function isNoUjianUsed(noUjian,isSave){
    if($("#No_Ujian").val()!=$("#No_Ujian_hid").val()){
        var idJalur=$(".form_set_ujian_masuk#Jalur_Penerimaan").val();
        var idCamaba=$(".form_set_ujian_masuk#Id_Camaba").val();
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/isNoUjianUsed",{idJalur:idJalur,Id_Camaba:idCamaba,No_Ujian:noUjian}, function( data ){
            if(data.isExist){
                toastr['error']("No Ujian telah digunakan !", "<?php echo $page_info['Nama_Menu']?>");   
                $(".form_set_ujian_masuk#No_Ujian").val(data.New_No);
            }else{
                if(isSave==true){
                    simpan();
                }
            }
        },'json');   
    }else{
        if(isSave==true){
            simpan();
        }
    }
}
function ekstrakSyaratDaftar(){
    var res='';
    $(".check-syaratdaftar").each(function(){
        if($(this).is(':checked')) var chk='YES'; else var chk='NO'; 
        res+=(','+$(this).val()+'is'+chk);
    })
    res=res.substr(1,res.length);
    return res;
}
function <?php echo $page_id;?>_btnSaveClick(){
    if(validation('<?php echo $Form_Id?>')){
        isNoUjianUsed($(".form_set_ujian_masuk#No_Ujian").val(),true);
    }
	return false;
};
function simpan(){
    var string = genDataStringByClass('<?php echo $Form_Id?>');
    string+=('&syaratDaftar='+ekstrakSyaratDaftar());
    
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
function edit_<?php echo $page_id;?>(id){
    Metronic.startPageLoading({animate: true});
    setResetForm();
    reset_validation();
    var string = "id="+id;
	$.ajax({
		type	: 'POST',
		url		: "<?php echo base_url();?>index.php/<?php echo $page_id;?>/lihat",
		data	: string,
		cache	: true,
		dataType : "json",
		success	: function(data){  
            fill_form("<?php echo $Form_Id?>",data);
            $("#No_Ujian_hid").val(data.No_Ujian);
            $("#form-group-syarat").html(data.det_syarat);
            $("#form-group-prodi").html(data.det_prodi);
            $("#syarat_uploaded").html(data.det_berkas);
            if(data.Kode_Prodi!=null) $('select#ProgramStudi').val(data.Kode_Prodi); else
            $('select#ProgramStudi').val($("#form-group-prodi li.list-group-item:first").attr('data-id'));
            document.getElementById('<?php echo $page_id;?>ModalInputTitle').innerHTML='Tentukan <?php echo $page_info['Nama_Menu']?>';
            $('#<?php echo $page_id;?>ModalInput').modal('show');
            showForm(data.isUjian);
            Metronic.stopPageLoading();
			return false;
		}
	});
    //Metronic.stopPageLoading();
	return false;
}
</script>