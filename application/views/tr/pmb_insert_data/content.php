<?php if(isset($cssInclude)) echo $cssInclude?>
<link rel='stylesheet' type='text/css' href='<?php echo base_url()?>assets/additional/js/dropzone/dropzone.css'/>
<link href="<?php echo base_url()?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light" id="form_wizard_1">
            <div class="portlet-title">
				<div class="caption">
					<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase step-title">Step 1 of 4</span>
					<span class="caption-helper"><?php echo $page_info['Keterangan']?></span>
				</div>
				<div class="actions">
                    <a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
				</div>
			</div>
			<div class="portlet-body form">
                <div class="form-wizard">
					<div class="form-body">
						<ul class="nav nav-pills nav-justified steps">
                            <li>
								<a href="#tab1" data-toggle="tab" class="step">
								<span class="number"> 1 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Pilihan </span>
								</a>
							</li>
							<li>
								<a href="#tab2" data-toggle="tab" class="step">
								<span class="number"> 2 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Pribadi </span>
								</a>
							</li>
							<li>
								<a href="#tab3" data-toggle="tab" class="step">
								<span class="number"> 3 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Orang Tua </span>
								</a>
							</li>
							<li>
								<a href="#tab4" data-toggle="tab" class="step">
								<span class="number"> 4 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Pendidikan </span>
								</a>
							</li>
                            <li>
								<a href="#tab5" data-toggle="tab" class="step">
								<span class="number"> 5 </span>
								<span class="desc">
								<i class="fa fa-check"></i> Berkas </span>
								</a>
							</li>
						</ul>
						<div id="bar" class="progress" role="progressbar">
							<div class="progress-bar progress-bar-success" style="width: 20%;">
							</div>
						</div>
						<div class="tab-content">
							<div class="alert alert-danger display-none">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success display-none">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>
                            <div class="tab-pane active" id="tab1">
								<div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Pilihan Daftar</span>
            								<span class="caption-helper">Pilihan Paket Studi</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
                                        <?php echo $form[11]?>
                                        <div class="list-group">
                                            <a href="javascript:;" class="list-group-item">
                                                <h4 class="list-group-item-heading">Pilihan Ke 1</h4>
                                                <?php echo $form[12]?>
                                                <div class="alert alert-info" id="alt-pilihan" style="display: none;">
                                                <strong>Info!</strong> Anda diijinkan memilih pilihan program studi selanjutnya dengan <span></span>.</div>
                                            </a>
                                            <a href="javascript:;" class="list-group-item">
                                                <h4 class="list-group-item-heading">Pilihan Ke 2</h4>
                                                <?php echo $form[13]?>
                                            </a>
                                            <a href="javascript:;" class="list-group-item">
                                                <h4 class="list-group-item-heading">Pilihan Ke 3</h4>
                                                <?php echo $form[14]?>
                                            </a>
                                        </div>
            							
                                        <form class="form-horizontal" role="form">
								            <div class="form-body">
                                                <div class="form-group">
        											<label class="col-md-3 control-label">Syarat Pendaftaran </label>
        											<div class="col-md-6">
        												<ul class="list-group" id="listgroup-syaratdaftar">
                                                            
                            							</ul>
        											</div>
        										</div>
                                            </div>
                                        </form>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Informasi Tambahan</span>
            								<span class="caption-helper">Informasi Tambahan</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[10]?>
            						</div>
            					</div>
							</div>
							<div class="tab-pane" id="tab2">
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Data Diri</span>
            								<span class="caption-helper">Data Diri Calon Mahasiswa</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[0]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Alamat Tinggal</span>
            								<span class="caption-helper">Alamat Tinggal Calon Mahasiswa</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[1]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Alamat Asal</span>
            								<span class="caption-helper">Alamat Asal Calon Mahasiswa</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[2]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Pekerjaan (Optional)</span>
            								<span class="caption-helper">Pekerjaan Calon Mahasiswa Baru</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse" id="tools-collapse-pekerjaan">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body portlet-hidden" id="portlet-body-pekerjaan">
            							<?php echo $form[3]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Lain-lain</span>
            								<span class="caption-helper">Informasi Tambahan Calon Mahasiswa Baru</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[4]?>
            						</div>
            					</div>
							</div>
							<div class="tab-pane" id="tab3">
								<div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Data Diri</span>
            								<span class="caption-helper">Data Diri Orang Tua Calon Mahasiswa Baru</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[5]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Wali (Optional)</span>
            								<span class="caption-helper">Data Diri Wali Calon Mahasiswa Baru</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse" id="tools-collapse-wali">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body" id="portlet-body-wali">
            							<?php echo $form[6]?>
            						</div>
            					</div>
							</div>
							<div class="tab-pane" id="tab4">
								<div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Status Masuk</span>
            								<span class="caption-helper">Pilih status masuk baru atau pindahan</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[7]?>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">SMA/SMK</span>
            								<span class="caption-helper">Riwayat pendidikan SMA/SMK</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[8]?>
            						</div>
            					</div>
                                <div class="portlet light" id="portlet-asalPt" style="display: none;">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Perguruan Tinggi</span>
            								<span class="caption-helper">Pindahan/Alih Jenjang</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
            							<?php echo $form[9]?>
            						</div>
            					</div>
							</div>
                            <div class="tab-pane" id="tab5">
                                <div class="portlet light" id="portlet-asalPt">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="icon icon-camera font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Photo</span>
            								<span class="caption-helper">Photo calon mahasiswa</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body">
                                        <form class="form-horizontal" role="form">
                							<div class="form-body">
                                        		<div class="form-group">
                                        			<label class="col-md-3 control-label">Foto Calon Mahasiswa</label>
                                                    <div class="col-md-4">
                                                        <div class="profile-usermenu">
                                                        <a data-ip-modal="#avatarModal">
                                                            <img src="<?php echo $no_picture_url?>" class="img-responsive popovers" id="img_profile" alt="" style="width: 200px;" data-trigger="hover" data-placement="right" data-content="Ubah photo"></a>
                                        				</div>
                                                        <div class="profile-userbuttons" style="padding-top: 5px;">
                                        					<button type="button" id="btneditpic" data-ip-modal="#avatarModal" class="btn btn-circle green-haze btn-sm">Ganti Foto Profile</button>					
                                        				</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="note note-info">
                            								<h4 class="block">Info! Ketentuan Photo</h4>
                            								<p>
         									                  <?php echo $conf_ketentuan_photo;?>
                            								</p>
                            							</div>
                                                    </div>
                                        		</div>
                                            </div>
                                          </form>
            						</div>
            					</div>
                                <div class="portlet light">
            						<div class="portlet-title">
            							<div class="caption">
            								<i class="icon icon-cloud-upload font-green-sharp"></i>
            								<span class="caption-subject font-green-sharp bold uppercase">Berkas Pendukung</span>
            								<span class="caption-helper">Upload berkas-berkas pendukung</span>
            							</div>
            							<div class="tools">
            								<a href="javascript:;" class="collapse">
            								</a>
            							</div>
            						</div>
            						<div class="portlet-body" id="form_berkas">
            							
            						</div>
            					</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6" style="text-align: left;">
                                <a href="javascript:;" class="btn btn-nav default button-previous" onclick="onPrev()">
                                <i class="m-icon-swapleft"></i> Kembali </a>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="javascript:;" class="btn btn-nav blue button-next popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Simpan draft entrian data diri" onclick="simpan_draft()">
								Simpan Draft <i class="fa fa-file-text-o m-icon-white"></i>
								</a>
                                <a href="javascript:;" class="btn btn-nav green green-seagreen button-save popovers" data-trigger="hover" data-placement="top" data-content="Menyimpan data diri tanpa mengirim ke operator. Anda masih bisa merubah data, tetapi data Anda belum akan diproses oleh operator." onclick="onSubmit('YES')">
								Simpan <i class="fa fa-save m-icon-white"></i>
								</a>
                                <a href="javascript:;" class="btn btn-nav green green-seagreen button-draft popovers" data-trigger="hover" data-placement="top" 
                                  onclick="onNext()">
								Selanjutnya <i class="m-icon-swapright m-icon-white"></i>
								</a>
								<a href="javascript:;" class="btn btn-nav green button-submit popovers" data-trigger="hover" data-placement="top"
                                data-content="Menyimpan dan mengirimkan data diri ke operator. Anda tidak dapat merubah data kembali. Data akan segera diproses oleh operator." onclick="onSubmit('NO')">
								Simpan dan Kirim <i class="glyphicon glyphicon-send m-icon-white"></i>
								</a>
							</div>
                            <input type="hidden" id="isCanChange"/>
						</div>
					</div>
				</div>
                <!-- END FORM WIZARD-->
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
<?php if(isset($modal_avatar)) echo $modal_avatar;?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<script src='<?php echo base_url()?>assets/additional/js/dropzone/dropzone.js'></script>
<script src="<?php echo base_url()?>assets/global/plugins/icheck/icheck.min.js"></script>

<script src="<?php echo base_url()?>assets/additional/js/application/form_input_camaba/js_script.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        init_js();
        //$("#form_sma").select2();
        $(".select2.select2-container").css('width','100%');
        var opt=$('div#opt-prodi').html();
        $('select#Kode_Prodi1').html(opt);
        $('select#Kode_Prodi2').html(opt);
        $('select#Kode_Prodi3').html(opt);        
    });
    function init_js(){
        Metronic.startPageLoading({animate: true});
        <?php echo $initJs?>
        handleTitle(1);
        $("#JK_Mhs").html("<option value>-PILIH-</option><option value='L'>Laki-laki</option><option value='P'>Perempuan</option>");
        //isiSampleData();
        //preFill();
        isDraftExist();
        Metronic.stopPageLoading();
        $("#Kode_SMU").select2('destroy');
        $("#Kode_SMU").select2();
    }
    function setDefaultValue(){
        <?php echo $setDefaultValue?>
    }
    
    function isDraftExist(){
        $.post( "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/isDraftExist", function( data ){
            if(data.isExist){
                bootbox.dialog({
                    message: "Sistem menemukan adanya draft data yang tersimpan pada "+data.tgl+". Apakah Anda ingin menggunakannya kembali ?",
                    buttons: {
                      success: {
                        label: "YES",
                        className: "blue",
                        callback: function() {
                            reloadDraft();
                        }
                      },
                      danger: {
                        label: "NO",
                        className: "grey",
                        callback: function() {
                          preFill();
                        }
                      },
                      main: {
                        label: "Discard",
                        className: "red",
                        callback: function() {
                              discardDraft();
                              preFill();
                        }
                      }
                    }
                });
          }else
            preFill();
        },'json' );
    }
    
    var typingTimer;                //timer identifier
    var doneTypingInterval = <?php echo $doneTypingInterval;?>;  //time in ms, 3 second for example
    var $input = $('.form_tr_camaba');
    
    //on keyup, start the countdown
    $input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
    
    //on keyup, start the countdown
    $input.on('change', function () {
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
      simpan_draft();
    }
    
    function discardDraft(){
       $.post( "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/discardDraft", function( data ){
            if(data.isSuccess){
                toastr['success']("Berhasil menghapus draft", "<?php echo $page_info['Nama_Menu']?>");   
    		 }else{
                toastr['error']("Tidak berhasil menghapus draft, hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    		 }
       },'json');
    }
    
    function preFill(){        
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/preFill",
			cache	: false,
            dataType: 'json',
			success	: function(data){
				fill_form('<?php echo $Form_Id?>',data);
                getListOfProdi(data.Pilihan_Jenjang,data.Kode_Prodi);
                getKotaByProvinsi("Prov_Lahir","Tempat_Lahir",data.Tempat_Lahir);
                getKotaByProvinsi("Alamat_Prov","Alamat_Kode_Kota",data.Alamat_Kode_Kota);
                getKotaByProvinsi("Prov_Asal_Mhs","Kode_Kota_asl",data.Kode_Kota_asl);
                getKotaByProvinsi("Prov_Ortu","Kode_Kota_Ortu",data.Kode_Kota_Ortu);
                getKotaByProvinsi("Prov_Wali","Kode_Kota_Wali",data.Kode_Kota_Wali);
                getKotaByProvinsi("Prov_SMA","Kota_SMA",data.Kota_SMA);
                getSchList(data.Kota_SMA,data.Kode_SMU);
                getSyaratDaftar(data.Usulan_Jalur_Penerimaan);
                $("#img_profile").attr('src',data.Url_Foto);
                if(data.Status_Masuk=='Pindahan'){
                    $("#portlet-asalPt").show(400)
                }else{
                    $("#portlet-asalPt").hide(400);
                }
                if(data.Warga_Negara=='WNA')
                    $("#form-group-Kewarganegaraan").show(400)
                else
                    $("#form-group-Kewarganegaraan").hide(400)
    
                if(data.Is_Terima_KPS=='YES')
                    $("#form-group-No_KPS").show(400)
                else
                    $("#form-group-No_KPS").hide(400);
                getProdiList_PTAsal(data.Kode_PT_Asal,data.Jenjang_PT,data.Kode_Prodi_PT_Asal);
                
                if(data.PekerjaanMhs===undefined){
                    $("#tools-collapse-pekerjaan").removeClass( 'collapse' );
                    $("#tools-collapse-pekerjaan").addClass( 'expand' );
                    $("#portlet-body-pekerjaan").addClass('portlet-hidden');
                    
                }else{
                    $("#tools-collapse-pekerjaan").removeClass( 'expand' );
                    $("#tools-collapse-pekerjaan").addClass( 'collapse' );
                    $("#portlet-body-pekerjaan").removeClass('portlet-hidden');
                }
                if(data.Nama_Wali===undefined){
                    $("#tools-collapse-wali").removeClass( 'collapse' );
                    $("#tools-collapse-wali").addClass( 'expand' );
                    $("#portlet-body-wali").addClass('portlet-hidden');
                    
                }else{
                    $("#tools-collapse-wali").removeClass( 'expand' );
                    $("#tools-collapse-wali").addClass( 'collapse' );
                    $("#portlet-body-wali").removeClass('portlet-hidden');
                }
			},
			error : function(xhr, teksStatus, kesalahan) {
				toastr['error']("Tidak dapat mengambil data", "<?php echo $page_info['Nama_Menu']?>")
				return false;
			}
		});  
    }
    
    function reloadDraft(){        
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/reloadDraft",
			cache	: false,
            dataType: 'json',
			success	: function(data){
				fill_form('<?php echo $Form_Id?>',data);
                getListOfProdi(data.Pilihan_Jenjang,data.Kode_Prodi);
                getKotaByProvinsi("Prov_Lahir","Tempat_Lahir",data.Tempat_Lahir);
                getKotaByProvinsi("Alamat_Prov","Alamat_Kode_Kota",data.Alamat_Kode_Kota);
                getKotaByProvinsi("Prov_Asal_Mhs","Kode_Kota_asl",data.Kode_Kota_asl);
                getKotaByProvinsi("Prov_Ortu","Kode_Kota_Ortu",data.Kode_Kota_Ortu);
                getKotaByProvinsi("Prov_Wali","Kode_Kota_Wali",data.Kode_Kota_Wali);
                getKotaByProvinsi("Prov_SMA","Kota_SMA",data.Kota_SMA);
                getSchList(data.Kota_SMA,data.Kode_SMU);
                getSyaratDaftar(data.Usulan_Jalur_Penerimaan);
                $("#img_profile").attr('src',data.Url_Foto);
                if(data.Status_Masuk=='Pindahan'){
                    $("#portlet-asalPt").show(400)
                }else{
                    $("#portlet-asalPt").hide(400);
                }
                if(data.Warga_Negara=='WNA')
                    $("#form-group-Kewarganegaraan").show(400)
                else
                    $("#form-group-Kewarganegaraan").hide(400)
    
                if(data.Is_Terima_KPS=='YES')
                    $("#form-group-No_KPS").show(400)
                else
                    $("#form-group-No_KPS").hide(400);
                getProdiList_PTAsal(data.Kode_PT_Asal,data.Jenjang_PT,data.Kode_Prodi_PT_Asal);
                
                if(data.PekerjaanMhs===undefined){
                    $("#tools-collapse-pekerjaan").removeClass( 'collapse' );
                    $("#tools-collapse-pekerjaan").addClass( 'expand' );
                    $("#portlet-body-pekerjaan").addClass('portlet-hidden');
                    
                }else{
                    $("#tools-collapse-pekerjaan").removeClass( 'expand' );
                    $("#tools-collapse-pekerjaan").addClass( 'collapse' );
                    $("#portlet-body-pekerjaan").removeClass('portlet-hidden');
                }
                if(data.Nama_Wali===undefined){
                    $("#tools-collapse-wali").removeClass( 'collapse' );
                    $("#tools-collapse-wali").addClass( 'expand' );
                    $("#portlet-body-wali").addClass('portlet-hidden');
                    
                }else{
                    $("#tools-collapse-wali").removeClass( 'expand' );
                    $("#tools-collapse-wali").addClass( 'collapse' );
                    $("#portlet-body-wali").removeClass('portlet-hidden');
                }
			},
			error : function(xhr, teksStatus, kesalahan) {
				toastr['error']("Tidak dapat mengambil data", "<?php echo $page_info['Nama_Menu']?>")
				return false;
			}
		});  
    }
    
    function getKotaByProvinsi(src,target,setVal){
        var prov=$("#"+src).val();
        var string="prov="+prov;
        
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/getKotaByProvinsi",
			data	: string,
			cache	: false,
            dataType: 'json',
			success	: function(data){
				document.getElementById(target).innerHTML=data.opt;
                $("#"+target).val(setVal);
			},
			error : function(xhr, teksStatus, kesalahan) {
				toastr['error']("Tidak dapat mengambil daftar kota", "<?php echo $page_info['Nama_Menu']?>")
				return false;
			}
		});  
    }
    function getSchList(kota,curSma){
        if(kota=='')kota=$("#Kota_SMA").val();
        var string='kota='+kota;
        $.ajax({
        type    :'POST',
        url     : "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/getDaftarSMA",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            $("#Kode_SMU").html(data.smu);
            //$("#Kode_SMU").val(curSma);
            $("#Kode_SMU").val(curSma).trigger('change');
            //reInitSelect2();
          }
        })
    }
    
    function getDaftarProdi(){
        var pt=$("#Kode_PT_Asal").val();
        var jenjang=$("#Jenjang_PT").val();
        if(!(pt=='') && !(jenjang=='')) getProdiList_PTAsal(pt,jenjang,'');
    }
    function getProdiList_PTAsal(kodePt,jenjang,curProdi){
        var string='Kode_PT='+kodePt+'&Jenjang='+jenjang;
        $.ajax({
        type    :'POST',
        url     : "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/getDaftarProdiPTAsal",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            $("#Kode_Prodi_PT_Asal").html(data.prodi);
            $("#Kode_Prodi_PT_Asal").val(curProdi);
          }
        })
    }
    function getListOfProdi(jenjang,prodi){
        //var jenjang=$("#Pilihan_Jenjang").val();
//        var string="jenjang="+jenjang;
//        $.ajax({
//			type	: 'POST',
//			url		: "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/generateProdi",
//			data	: string,
//			cache	: true,
//			dataType : "json",
//			success	: function(data){
//                document.getElementById("Kode_Prodi").innerHTML=data.options;
//                $("#Kode_Prodi").val(prodi);		
//				return false;
//			}
//	   });
    }
    
    function getSyaratDaftar(id){
        $.post( "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/getSyaratDaftar",{Id_JalurPenerimaan:id}, function( data ){
          $("#listgroup-syaratdaftar").html(data.syarat);
          $("#form_berkas").html(data.berkas);
        },'json' );
    }
    
    function simpan_draft(){
        var string = genDataStringByClass('<?php echo $Form_Id?>');
        string+=('&syaratDaftar='+ekstrakSyaratDaftar()+'&deletedBerkas='+getDeletedFile());
        
    	$.ajax({
    		type	: 'POST',
    		url		: '<?php echo base_url(); ?>index.php/tr_pmb_insert_data/simpan_draft',
    		data	: string,
    		cache	: false,
            dataType : "json",
    		success	: function(data){
    		 if(data.isSuccess){
                toastr['info']("Berhasil menyimpan draft data diri", "<?php echo $page_info['Nama_Menu']?>");
                $('.dz-success').remove();
                $('.dropzone').removeClass('dz-started');   
    		 }else{
                toastr['error']("Tidak berhasil menyimpan perubahan, Kesalahan: "+data.msg+" hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    		 }
    		},
    		error : function(xhr, teksStatus, kesalahan) {
    			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
    			return false;
            }
    	});
       	return false;
    }
    
    function simpan(isSend){
        if(validation('<?php echo $Form_Id?>')){
            $("#isCanChange").val(isSend);
            if(isSend=='NO'){
                bootbox.confirm("<blockquote><p>Saya menyatakan bahwa data yang saya diberikan adalah benar, dan Saya bertanggung jawab sepenuhnya atas kebenaran data yang saya berikan.</p><small>Pernyataan <cite title='calon mahasiswa'>calon mahasiswa</cite></small></blockquote><p>Dengan menekan tombol OK anda menyatakan telah setuju dengan pernyataan diatas. Apabila ada menekan tombol OK, Anda tidak dapat merubah kembali data Anda. Data Anda akan segera diproses oleh operator. Apakah anda yakin ingin melanjutkan ?</p>", function(result) {
                    if(result){
                        doUploadOrSave();
                    }
                });
            }else{
                doUploadOrSave();
            }
         }
       	return false;
    };
    function doUploadOrSave(){
        if(isAllComplete()) doSimpan(); else doUpload();
    }
    function doSimpan(){
        var isSend=$("#isCanChange").val();
        var string = genDataStringByClass('<?php echo $Form_Id?>');
        string+=('&syaratDaftar='+ekstrakSyaratDaftar()+'&deletedBerkas='+getDeletedFile()+'&isCanChange='+isSend);
        
    	$.ajax({
    		type	: 'POST',
    		url		: '<?php echo base_url(); ?>index.php/tr_pmb_insert_data/simpan',
    		data	: string,
    		cache	: false,
            dataType : "json",
    		success	: function(data){
    		 if(data.isSuccess){
                toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                //$('#<?php echo $page_id;?>ModalInput').modal('toggle');
                $('.dz-success').remove();
                $('.dropzone').removeClass('dz-started');
                if(isSend=='NO') loadProfile(); else getSyaratDaftar($("#Usulan_Jalur_Penerimaan").val());
                $("#isCanChange").val('');
                $(".btn-nav").removeAttr('disabled');
                uploadPhoto();
                Metronic.unblockUI();
    		 }else{
                toastr['error']("Tidak berhasil menyimpan perubahan, Kesalahan: "+data.msg+" hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
                $(".btn-nav").removeAttr('disabled');
                Metronic.unblockUI();
    		 }
    		},
    		error : function(xhr, teksStatus, kesalahan) {
    			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
                $(".btn-nav").removeAttr('disabled');
                Metronic.unblockUI();
    			return false;
            }
    	});
    };
    
    function uploadPhoto(){
        if($("#isProfile").val()=="yes"){
            $.post( "<?php echo base_url(); ?>index.php/file_uploader/uploadPhotoDataDiri",{username:$(".form_tr_camaba#Email").val()}, function( data ){
                var imgUrl=curImg.split("/");
                var filename=imgUrl[imgUrl.length-1];
                var d = new Date();
                var n = d.getTime();
                $('#img_pojok').attr('src', '<?php echo $this->config->item('ftp_domain').$this->config->item('ftp_loc_img')?>'+filename+'?'+n );
            },'json' );   
        }
    }
    
    function loadProfile(){
        Metronic.startPageLoading({animate: true});
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_profile",{id:$(".form_tr_camaba#Email").val()}, function( data ) {
          $( "#page-content-inner" ).html( data );
          breadcrumb_lihat_<?php echo $page_id;?>();
          Metronic.stopPageLoading();
        });
    }
    
    function breadcrumb_lihat_<?php echo $page_id;?>(){
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/load_profile_bc", function( data ) {
          $( ".breadcrumb" ).html( data );
        });
    }
    $('select#Kode_Prodi1,select#Kode_Prodi2,select#Kode_Prodi3').change(function(){
        if(
            ($(this).val()==$('select#Kode_Prodi1').val() && $(this).is(':not(select#Kode_Prodi1)'))
            || ($(this).val()==$('select#Kode_Prodi2').val() && $(this).is(':not(select#Kode_Prodi2)'))
            || ($(this).val()==$('select#Kode_Prodi3').val() && $(this).is(':not(select#Kode_Prodi3)'))
        ) $(this).val('');
        //console.log($(this).find('option:selected').attr('data-par'));
    })
    $('select#Kode_Prodi1').change(function(){
        var alt=JSON.parse($(this).find('option:selected').attr('data-par'));
        if(alt.length==2){
            $('select#Kode_Prodi2').removeAttr('disabled');
            $('select#Kode_Prodi3').removeAttr('disabled');
        }else if(alt.length==1){
            $('select#Kode_Prodi2').removeAttr('disabled');
            $('select#Kode_Prodi3').attr('disabled','disabled');
        }else{
            $('select#Kode_Prodi2').attr('disabled','disabled');
            $('select#Kode_Prodi3').attr('disabled','disabled');
        }
        var info=$(this).find('option:selected').attr('data-info'),
        alp=$('div.alert#alt-pilihan');
        if(info.length>0){
            alp.find('span').html(info);
            alp.show(400);
        }else alp.hide(400);
    })
    $('select#Kode_Prodi2,select#Kode_Prodi3').change(function(){
        var val=$(this).val();
        if(val.length>0){
            alt=JSON.parse($('select#Kode_Prodi1').find('option:selected').attr('data-par'));
            var is=false;
            $.each(alt, function(index,value){
                if(val==value) is=true;
            })
            if(!is){
                toastr['error']("Anda tidak diperkanan memilih program studi tersebut sebagai pilihan", "<?php echo $page_info['Nama_Menu']?>");
                $(this).val('');
            }
        }
    })
</script>
<?php echo $js_global_method?>
