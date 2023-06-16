<link href="<?php echo base_url()?>assets/additional/plugin/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/additional/plugin/dropzone/css/basic.css" rel="stylesheet" type="text/css"/>

<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
						 Widget settings form goes here
					</div>
					<div class="modal-footer">
						<button type="button" class="btn blue">Save changes</button>
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN STYLE CUSTOMIZER -->
		<div class="theme-panel hidden-xs hidden-sm">
			<div class="toggler">
			</div>
			<div class="toggler-close">
			</div>
			<div class="theme-options">
				<div class="theme-option theme-colors clearfix">
					<span>
					THEME COLOR </span>
					<ul>
						<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
						</li>
						<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
						</li>
						<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
						</li>
						<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
						</li>
						<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
						</li>
						<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
						</li>
					</ul>
				</div>
				<div class="theme-option">
					<span>
					Layout </span>
					<select class="layout-option form-control input-small">
						<option value="fluid" selected="selected">Fluid</option>
						<option value="boxed">Boxed</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Header </span>
					<select class="page-header-option form-control input-small">
						<option value="fixed" selected="selected">Fixed</option>
						<option value="default">Default</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Mode</span>
					<select class="sidebar-option form-control input-small">
						<option value="fixed">Fixed</option>
						<option value="default" selected="selected">Default</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Menu </span>
					<select class="sidebar-menu-option form-control input-small">
						<option value="accordion" selected="selected">Accordion</option>
						<option value="hover">Hover</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Style </span>
					<select class="sidebar-style-option form-control input-small">
						<option value="default" selected="selected">Default</option>
						<option value="light">Light</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Sidebar Position </span>
					<select class="sidebar-pos-option form-control input-small">
						<option value="left" selected="selected">Left</option>
						<option value="right">Right</option>
					</select>
				</div>
				<div class="theme-option">
					<span>
					Footer </span>
					<select class="page-footer-option form-control input-small">
						<option value="fixed">Fixed</option>
						<option value="default" selected="selected">Default</option>
					</select>
				</div>
			</div>
		</div>
		<!-- END STYLE CUSTOMIZER -->
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		<?php echo $page_title?> <small><?php echo $page_title?></small>
		</h3>
		<div class="page-bar">
			<?php echo $breadcrumb?>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Actions <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="#">Action</a>
						</li>
						<li>
							<a href="#">Another action</a>
						</li>
						<li>
							<a href="#">Something else here</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">Separated link</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				 <div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i> Langkah Pendaftaran - <span class="step-title">
								Step 1 of 5 </span>
							</div>
							<div class="tools hidden-xs">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Data Pribadi </span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Orang Tua </span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Pendidikan </span>
												</a>
											</li>
											<li>
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Pilihan Daftar </span>
												</a>
											</li>
                                            <li>
												<a href="#tab5" data-toggle="tab" class="step">
												<span class="number">
												5 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Berkas </span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
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
                                                <div class="portlet box blue-hoki">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Masukkan Data Mahasiswa Baru
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="collapse">
                            								</a>
                            							</div>
                            						</div>
                            						<div class="portlet-body">
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Nama <span class="required">* </span>
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="nama_calon" id="nama_calon" required="required"/>
        														<span class="help-block">
        														Masukkan nama calon mahasiswa </span>
        													</div>
        												</div>
        												<div class="form-group">
        													<label class="control-label col-md-3">Jenis Kelamin <span class="required">* </span>
        													</label>
        													<div class="col-md-4">
        														<select name="form_jk" id="form_jk" class="form-control" required="required">
                													<option value="">-PILIH-</option>
                                                                    <option value="L">Laki-laki</option>
                													<option value="P">Perempuan</option>
                												</select>
        														<span class="help-block">
        														Pilih jenis kelamin calon mahasiswa </span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Warnga Negara <span class="required">* </span>
        													</label>
        													<div class="col-md-4">
        														<select name="form_wniWna" id="form_wniWna" class="form-control" required="required">
                													<option value="">-PILIH-</option>
                                                                    <option value="WNI">WNI</option>
                													<option value="WNA">WNA</option>
                												</select>
        														<span class="help-block">
        														Pilih warga negara calon mahasiswa </span>
        													</div>
                                                            <div class="col-md-4" id="form_cond_kewarganegaraan">
        														<select name="form_wargaNegara" id="form_wargaNegara" class="form-control" required="required">
                													<option value="">-PILIH-</option>
                                                                    <?php
                                                                    foreach($enum_negara->result()as $t){
                                                                    ?>    
                                                                    <option value="<?php echo $t->Code;?>"> <?php echo $t->Name;?></option>   
                                                                    <?php } ?>
                												</select>
        														<span class="help-block">
        														Pilih warga negara calon mahasiswa </span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Anak Ke
        													</label>
        													<div class="col-md-4">
        														<div id="form_anakke">
                    												<div class="input-group input-small">
                    													<input type="text" class="spinner-input form-control" maxlength="3" readonly>
                    													<div class="spinner-buttons input-group-btn btn-group-vertical">
                    														<button type="button" class="btn spinner-up btn-xs blue">
                    														<i class="fa fa-angle-up"></i>
                    														</button>
                    														<button type="button" class="btn spinner-down btn-xs blue">
                    														<i class="fa fa-angle-down"></i>
                    														</button>
                    													</div>
                    												</div>
                    											</div>
        														<span class="help-block">
        														Masukkan anak ke berapa dalam keluarga </span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Jumlah Saudara Kandung
        													</label>
        													<div class="col-md-4">
        														<div id="form_jumlahSaudara">
                    												<div class="input-group input-small">
                    													<input type="text" class="spinner-input form-control" maxlength="3" readonly>
                    													<div class="spinner-buttons input-group-btn btn-group-vertical">
                    														<button type="button" class="btn spinner-up btn-xs blue">
                    														<i class="fa fa-angle-up"></i>
                    														</button>
                    														<button type="button" class="btn spinner-down btn-xs blue">
                    														<i class="fa fa-angle-down"></i>
                    														</button>
                    													</div>
                    												</div>
                    											</div>
        														<span class="help-block">
        														Masukkan jumlah saudara kandung dalam keluarga </span>
        													</div>
        												</div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Tempat Lahir <span class="required">
        													* </span>
        													</label>
                                                            <div class="col-md-4">
        														<select name="form_provLahir" id="form_provLahir" class="form-control" required="required" onchange="getKotaByProvinsi('form_provLahir','form_kotaLahir','');" >
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Pilih provinsi tempat kelahiran calon mahasiswa</span>
        													</div>
                                                            <div class="col-md-4">
        														<select name="form_kotaLahir" id="form_kotaLahir" class="form-control" required="required">
                                                                <option value="0">-PILIH KOTA-</option>
                                                                </select>
        														<span class="help-block">
        														Pilih kota tempat kelahiran calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Tanggal Lahir<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years" >
                    												<input type="text" class="form-control" name="form_tglLahir" id="form_tglLahir" readonly required="required">
                    												<span class="input-group-btn">
                    												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                    												</span>
                    											</div>
        														<span class="help-block">
        														Pilih tanggal lahir calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Warga Negara<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<select name="form_wn" id="form_wn" class="form-control" required="required">
                													<option value="">-PILIH-</option>
                                                                    <option value="WNI">Warga Negara Indonesia</option>
                													<option value="WNA">Warga Negara Asing</option>
                												</select>
        														<span class="help-block">
        														Pilih kewarganegaraan calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Agama<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<select name="form_agama" id="form_agama" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                                    foreach($listAgama->result()as $t){
                                                                    ?>    
                                                                    <option value="<?php echo $t->Agama_id;?>"> <?php echo $t->Agama;?></option>   
                                                                  <?php } ?>       
                                                                </select>
        														<span class="help-block">
        														Pilih agama calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Alamat<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-8">
        														<input type="text" class="form-control" name="form_alamat" id="form_alamat" required="required"/>
                                                                <span class="help-block">
        														Masukkan alamat tinggal sekarang calon mahasiswa</span>
        													</div>
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-4">
                                                                <select name="form_provAlamat" id="form_provAlamat" class="form-control" required="required" onchange="getKotaByProvinsi('form_provAlamat','form_kotaAlamat','');" >
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan provinsi alamat tinggal sekarang calon mahasiswa</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="form_kotaAlamat" id="form_kotaAlamat" class="form-control" required="required" >
                                                                <option value="">-PILIH KOTA-</option>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan kota alamat tinggal sekarang calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Alamat Asal<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-8">
        														<input type="text" class="form-control" name="form_alamatAsal" id="form_alamatAsal" required="required"/>
                                                                <span class="help-block">
        														Masukkan alamat asal calon mahasiswa</span>
        													</div>
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-4">
                                                                <select name="form_provAlamatAsal" id="form_provAlamatAsal" class="form-control" required="required" onchange="getKotaByProvinsi('form_provAlamatAsal','form_kotaAlamatAsal','');" >
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan provinsi alamat asal calon mahasiswa</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="form_kotaAlamatAsal" id="form_kotaAlamatAsal" class="form-control" required="required" >
                                                                <option value="">-PILIH KOTA-</option>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan kota alamat asal calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Telepon<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="phone" id="form_tlp" required="required"/>
        														<span class="help-block">
        														Masukkan nomor telepon calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Handphone<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="handphone" id="form_hp" required="required"/>
        														<span class="help-block">
        														Masukkan nomor handphone calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">E-Mail<span class="required">
        													* </span>
        													</label>
        													<div class="col-md-4">
        														<input type="email" class="form-control" name="email" id="form_email" required="required"/>
        														<span class="help-block">
        														Masukkan alamat email calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group last">
                    										<label class="control-label col-md-3">Photo</label>
                    										<div class="col-md-9">
                    											<div class="dropzone" id="dropzonePhotoMhs">
                                                                  
                                                                </div>
                    										</div>
                    									</div>
                            						</div>
                            					</div>
                                                <div class="portlet box blue-hoki">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Masukkan Pekerjaan Mahasiswa (Optional)
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="expand">
                            								</a>
                            							</div>
                            						</div>
                            						<div class="portlet-body" style="display: none;">
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pekerjaan Mahasiswa
        													</label>
        													<div class="col-md-4">
        														<select name="form_pekerjaanMhs" id="form_pekerjaanMhs" class="form-control">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($pekerjaan->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih pekerjaan calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group" id="form_cond_ptAjar">
        													<label class="control-label col-md-3">PT Tempat Mengajar
        													</label>
        													<div class="col-md-4">
        														<select name="form_ptAjar" id="form_ptAjar" class="form-control">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($enum_pt->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kode_PT;?>"><?php echo $t->Nama_PT;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih perguruan tinggi tempat calon mahasiswa mengajar</span>
        													</div>
        												</div>
                                                        <div class="form-group" id="form_cond_biayaStudi">
        													<label class="control-label col-md-3">Biaya Studi
        													</label>
        													<div class="col-md-4">
        														<select name="form_biayaStudi" id="form_biayaStudi" class="form-control">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($enum_biayaStudi->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kode_BiayaStudi;?>"><?php echo $t->Keterangan_Biaya;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih biaya studi mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Nama Kantor</label>
        													<div class="col-md-4">
        														<input type="email" class="form-control" name="form_kantorMhs" id="form_kantorMhs" />
        														<span class="help-block">
        														Masukkan nama kantor calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Alamat Kantor
        													</label>
        													<div class="col-md-8">
        														<input type="text" class="form-control" name="form_alamatKantor" id="form_alamatKantor"/>
                                                                <span class="help-block">
        														Masukkan alamat kantor calon mahasiswa</span>
        													</div>
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-4">
                                                                <select name="form_provAlamatAsal" id="form_provAlamatKantor" class="form-control" onchange="getKotaByProvinsi('form_provAlamatKantor','form_kotaAlamatKantor','');" >
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan provinsi alamat kantor calon mahasiswa</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="form_kotaAlamatKantor" id="form_kotaAlamatKantor" class="form-control" >
                                                                <option value="">-PILIH KOTA-</option>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan kota alamat kantor calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Telp Kantor</label>
        													<div class="col-md-4">
        														<input type="email" class="form-control" name="form_telpKantor" id="form_telpKantor" />
        														<span class="help-block">
        														Masukkan telepon kantor calon mahasiswa</span>
        													</div>
        												</div>
                                                    </div>
                                                </div>
												<!-- End Tab1-->
											</div>
											<div class="tab-pane" id="tab2">
                                                <div class="portlet box blue-hoki">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Masukkan Data Orang Tua
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="collapse">
                            								</a>
                            							</div>
                            						</div>
                            						<div class="portlet-body">
        												<div class="form-group">
        													<label class="control-label col-md-3">Nama Ayah
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_namaAyah" id="form_namaAyah" required="required"/>
        														<span class="help-block">
        														Masukkan nama ayah calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">No KTP Ayah
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_noKTPAyah" id="form_noKTPAyah" required="required"/>
        														<span class="help-block">
        														Masukkan no KTP ayah calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pekerjaan Ayah
        													</label>
        													<div class="col-md-4">
        														<select name="form_pekerjaanAyah" id="form_pekerjaanAyah" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($pekerjaan->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih jenis daftar calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Nama Ibu
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_namaIbu" id="form_namaIbu" required="required"/>
        														<span class="help-block">
        														Masukkan nama ibu calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">No KTP Ibu
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_noKTPIbu" id="form_noKTPIbu" required="required"/>
        														<span class="help-block">
        														Masukkan no KTP Ibu calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pekerjaan Ibu
        													</label>
        													<div class="col-md-4">
        														<select name="form_pekerjaanIbu" id="form_pekerjaanIbu" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($pekerjaan->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih jenis daftar calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Alamat
        													</label>
        													<div class="col-md-8">
        														<input type="text" class="form-control" name="form_alamatOrtu" id="form_alamatOrtu" required="required"/>
                                                                <span class="help-block">
        														Masukkan alamat orang tua</span>
        													</div>
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-4">
                                                                <select name="form_provAlamatOrtu" id="form_provAlamatOrtu" class="form-control" onchange="getKotaByProvinsi('form_provAlamatOrtu','form_kotaAlamatOrtu','');" required="required">
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan provinsi alamat orang tua</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="form_kotaAlamatOrtu" id="form_kotaAlamatOrtu" class="form-control" required="required">
                                                                <option value="">-PILIH KOTA-</option>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan kota alamat orang tua</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Telepon
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_teleponOrtu" id="form_teleponOrtu" required="required"/>
        														<span class="help-block">
        														Masukkan telepon orang tua calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Handphone
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_hpOrtu" id="form_hpOrtu"/>
        														<span class="help-block">
        														Masukkan handphone orang tua calon mahasiswa</span>
        													</div>
        												</div>
                            						</div>
                            					</div>
                                                <div class="portlet box blue-hoki">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Masukkan Data Wali (Optional)
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="expand">
                            								</a>
                            							</div>
                            						</div>
                            						<div class="portlet-body" style="display: none;">
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Nama Wali
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_namaWali" id="form_namaWali"/>
        														<span class="help-block">
        														Masukkan nama wali calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">No KTP Wali
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_noKTPWali" id="form_noKTPWali"/>
        														<span class="help-block">
        														Masukkan no KTP wali calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pekerjaan Wali
        													</label>
        													<div class="col-md-4">
        														<select name="form_pekerjaanWali" id="form_pekerjaanWali" class="form-control">
                                                                <option value="0">-PILIH-</option>
                                                                <?php
                                                            	foreach($pekerjaan->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Pilih pekerjaan wali calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Alamat
        													</label>
        													<div class="col-md-8">
        														<input type="text" class="form-control" name="form_alamatWali" id="form_alamatWali" />
                                                                <span class="help-block">
        														Masukkan alamat orang tua</span>
        													</div>
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-4">
                                                                <select name="form_provAlamatWali" id="form_provAlamatWali" class="form-control" onchange="getKotaByProvinsi('form_provAlamatWali','form_kotaAlamatWali','');" >
                                                                <option value="">-PILIH PROVINSI-</option>
                                                                <?php
                                                                    foreach($listProp->result()as $t){
                                                                    ?>    
                                                               <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                  <?php } ?>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan provinsi alamat orang tua</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="form_kotaAlamatWali" id="form_kotaAlamatWali" class="form-control" >
                                                                <option value="">-PILIH KOTA-</option>
                                                               </select>
                                                               <span class="help-block">
        														Masukkan kota alamat orang tua</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Telepon
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_teleponWali" id="form_teleponWali"/>
        														<span class="help-block">
        														Masukkan telepon wali calon mahasiswa</span>
        													</div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Handphone
        													</label>
        													<div class="col-md-4">
        														<input type="text" class="form-control" name="form_hpWali" id="form_hpWali"/>
        														<span class="help-block">
        														Masukkan handphone wali calon mahasiswa</span>
        													</div>
        												</div>
        											</div>
                            					</div>
											</div><!-- END tab2-->
											<div class="tab-pane" id="tab3">
                                                <div class="portlet box blue-hoki">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Pilih Status Masuk
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="collapse">
                            								</a>
                            							</div>
                            						</div>
                                                    <div class="portlet-body">
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Status Masuk
        													</label>
        													<div class="col-md-4">
        														<select class="form-control" name="form_statusMasuk" id="form_statusMasuk" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach(explode("','",substr($enum_statusMasuk,6,-2)) as $option){
                                                            	?>
                                                                <option value="<?php echo $option;?>"><?php echo $option;?></option>
                                                                <?php } ?>
                                                                </select>
        														<span class="help-block">
        														Mahasiswa masuk baru atau pindahan</span>
        													</div>
        												</div>
                                                    </div>
                                                    <div class="portlet box blue-hoki" id="portlet_sma">
                                						<div class="portlet-title">
                                							<div class="caption">
                                								Riwayat Pendidikan SMA/SMK
                                							</div>
                                							<div class="tools hidden-xs">
                                								<a href="javascript:;" class="collapse">
                                								</a>
                                							</div>
                                						</div>
                                                        <div class="portlet-body">
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Provinsi Sekolah
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_provSmu" id="form_provSmu" class="form-control" onchange="getKotaByProvinsi('form_provSmu','form_kotaSmu','');" required="required">
                                                                    <option value="">-PILIH PROVINSI-</option>
                                                                    <?php
                                                                        foreach($listProp->result()as $t){
                                                                        ?>    
                                                                   <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                                                                      <?php } ?>
                                                                   </select>
                                                                   <span class="help-block">
            														Masukkan provinsi alamat asal sekolah</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Kota Sekolah
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_kotaSmu" id="form_kotaSmu" class="form-control" required="required" onchange="getSchList()">
                                                                    <option value="">-PILIH KOTA-</option>
                                                                    </select>
                                                                   <span class="help-block">
            														Masukkan kota alamat asal sekolah</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Nama Sekolah
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_asalSma" id="form_asalSma" class="form-control" required="required">
                                                                    <option value="">-PILIH-</option>
                                                                    </select>
                                                                   <span class="help-block">
            														Masukkan nama asal sekolah</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Jurusan
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_jurusanSma" id="form_jurusanSma" class="form-control" required="required">
                                                                    <option value="">-PILIH-</option>
                                                                    <?php
                                                                        foreach($enum_jurusan->result()as $t){
                                                                        ?>    
                                                                        <option value="<?php echo $t->Id_Jurusan;?>"> <?php echo $t->Nama_Jurusan;?></option>   
                                                                      <?php } ?>
                                                                    </select>
                                                                   <span class="help-block">
            														Masukkan penjurusan sekolah</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Total Nilai UAN
            													</label>
            													<div class="col-md-4">
            														<input type="text" class="form-control" name="form_nilaiUan" id="form_nilaiUan" onkeypress="return isDoubleNumberKey(event)" required="required"/>
            														<span class="help-block">
            														Masukkan total nilai UAN calon mahasiswa</span>
            													</div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Tahun Lulus
            													</label>
            													<div class="col-md-4">
            														<input type="text" class="form-control" name="form_tahunLulus" id="form_tahunLulus" maxlength="4" onkeypress="return isNumberKey(event)" required="required"/>
            														<span class="help-block">
            														Masukkan tahun lulus calon mahasiswa dari SMA/SMK</span>
            													</div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Tanggal Lulus
            													</label>
            													<div class="col-md-4">
            														<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years" >
                        												<input type="text" class="form-control" name="form_tglLulusSma" id="form_tglLulusSma" readonly required="required">
                        												<span class="input-group-btn">
                        												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        												</span>
                        											</div>
            														<span class="help-block">
            														Masukkan tanggal lulus calon mahasiswa dari SMA/SMK (tanggal pada ijazah)</span>
            													</div>
            												</div>
                                                        </div>
                                                    </div>
                                                    <div style="padding-top: 10px; background: white;"></div>
                                                    <div class="portlet box blue-hoki" id="portlet_pt">
                                						<div class="portlet-title">
                                							<div class="caption">
                                								Asal Perguruan Tinggi
                                							</div>
                                							<div class="tools hidden-xs">
                                								<a href="javascript:;" class="collapse">
                                								</a>
                                							</div>
                                						</div>
                                                        <div class="portlet-body">
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Perguruan Tinggi
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_asalPt" id="form_asalPt" class="form-control" required="required">
                                                                    <option value="">-PILIH-</option>
                                                                    <?php
                                                                	foreach($enum_pt->result() as $t){
                                                                	?>
                                                                    <option value="<?php echo $t->Kode_PT;?>"><?php echo $t->Nama_PT;?></option>
                                                                    <?php } ?>
                                                                    </select>
                                                                    <span class="help-block">
            														Masukkan perguruan tinggi asal</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">Jenjang
            													</label>
            													<div class="col-md-4">
                                                                    <select name="form_jenjangAsalPt" id="form_jenjangAsalPt" class="form-control" required="required">
                                                                    <option value="">-PILIH-</option>
                                                                    <?php
                                                                	foreach($enum_jenjang->result() as $t){
                                                                	?>
                                                                    <option value="<?php echo $t->Kode_Jenjang;?>"><?php echo $t->Nama_Jenjang;?></option>
                                                                    <?php } ?>
                                                                    </select>
                                                                    <span class="help-block">
            														Masukkan kota alamat asal sekolah</span>
                                                                </div>
            												</div>
                                                            <div class="form-group">
            													<label class="control-label col-md-3">NIM di PT Asal
            													</label>
            													<div class="col-md-4">
            														<input type="text" class="form-control" name="form_nimPtAsal" id="form_nimPtAsal" maxlength="4" onkeypress="return isNumberKey(event)" required="required"/>
            														<span class="help-block">
            														Nim mahasiswa di perguruan tinggi asal</span>
            													</div>
            												</div>
                                                        </div>
                                                    </div>
                                                </div>
											</div><!-- END tab3 -->
											<div class="tab-pane" id="tab4">
												<div class="portlet box blue-hoki" id="portlet_pt">
                            						<div class="portlet-title">
                            							<div class="caption">
                            								Pilihan Daftar
                            							</div>
                            							<div class="tools hidden-xs">
                            								<a href="javascript:;" class="collapse">
                            								</a>
                            							</div>
                            						</div>
                                                    <div class="portlet-body">
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pilihan Jenjang
        													</label>
        													<div class="col-md-4">
                                                                <select name="form_pilihanJenjang" id="form_pilihanJenjang" class="form-control" required="required" onchange="getListOfProdi();">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($enum_jenjang->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Kode_Jenjang;?>"><?php echo $t->Nama_Jenjang;?></option>
                                                                <?php } ?>
                                                                </select>
                                                                <span class="help-block">
        														Pilih jenjang studi yang akan ditempuh calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Pilihan Program Studi
        													</label>
        													<div class="col-md-4">
                                                                <select name="form_pilihanProdi" id="form_pilihanProdi" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                </select>
                                                                <span class="help-block">
        														Pilih program studi yang akan ditempuh calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Kelas Mahasiswa
        													</label>
        													<div class="col-md-4">
                                                                <select name="form_pilihanKelasMhs" id="form_pilihanKelasMhs" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <option value="R">Reguler</option>
                                                                <option value="N">Non-Reguler (Professional)</option>
                                                                <option value="K">Kerjasama</option>
                                                                </select>
                                                                <span class="help-block">
        														Pilih jenis kelas yang akan diikuti calon mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="form-group">
        													<label class="control-label col-md-3">Jalur Penerimaan
        													</label>
        													<div class="col-md-4">
                                                                <select name="form_jenjangAsalPt" id="form_jenjangAsalPt" class="form-control" required="required">
                                                                <option value="">-PILIH-</option>
                                                                <?php
                                                            	foreach($enum_jalurPenerimaan->result() as $t){
                                                            	?>
                                                                <option value="<?php echo $t->Id_JalurPenerimaan;?>"><?php echo $t->Nama_JalurPenerimaan;?></option>
                                                                <?php } ?>
                                                                </select>
                                                                <span class="help-block">
        														Pilih jalur penerimaan mahasiswa</span>
                                                            </div>
        												</div>
                                                        <div class="portlet box blue-hoki" id="portlet_pt">
                                    						<div class="portlet-title">
                                    							<div class="caption">
                                    								Checklist Syarat Pendaftaran
                                    							</div>
                                    							<div class="tools hidden-xs">
                                    								<a href="javascript:;" class="collapse">
                                    								</a>
                                    							</div>
                                    						</div>
                                                            <div class="portlet-body">
                                                                <div class="form-group">
                													<label class="control-label col-md-3">Syarat Daftar <span class="required">
                													* </span>
                													</label>
                													<div class="col-md-4">
                														<div class="checkbox-list checkbox_validation" id="checkbox_validation1" validation-type="all">
                															<label>
                															<input type="checkbox" name="syaratDaftar" id="syaratDaftar1" value="1" data-title="Auto-Pay with this Credit Card." required="required"/> Auto-Pay with this Credit Card </label>
                															<label>
                															<input type="checkbox" name="syaratDaftar" id="syaratDaftar2" value="2" data-title="Email me monthly billing." required="required"/> Email me monthly billing </label>
                														</div>
                														<div id="form_syarat_error">
                														</div>
                													</div>
                												</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                            <div class="tab-pane" id="tab5">
												<h3 class="block">Periksa Berkas Pendaftaran</h3>
												<div class="form-group">
													<label class="control-label col-md-3">SKHUN <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="checkbox-list">
															<label>
															<input type="checkbox" name="form_skhun" id="form_skhun" value="1" data-title="SKHUN"/>SKHUN</label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group">
													<label class="control-label col-md-3">Pas Photo <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="checkbox-list">
															<label>
															<input type="checkbox" name="form_pasPhoto" id="form_pasPhoto" value="1" data-title="Pas Photo"/>Pas Photo</label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group">
													<label class="control-label col-md-3">Akta Kelahiran <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="checkbox-list">
															<label>
															<input type="checkbox" name="form_akte" id="form_akte" value="1" data-title="Akta Kelahiran"/>Akta Kelahiran</label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group">
													<label class="control-label col-md-3">Ijazah<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="checkbox-list">
															<label>
															<input type="checkbox" name="form_ijazah" id="form_ijazah" value="1" data-title="Ijazah"/>Ijazah</label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group">
													<label class="control-label col-md-3">Raport<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="checkbox-list">
															<label>
															<input type="checkbox" name="form_rapor" id="form_rapor" value="1" data-title="Raport"/>Raport</label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="javascript:;" class="btn default button-previous">
												<i class="m-icon-swapleft"></i> Back </a>
												<a href="javascript:;" class="btn blue button-next">
												Continue <i class="m-icon-swapright m-icon-white"></i>
												</a>
												<a href="javascript:;" class="btn green button-submit">
												Submit <i class="m-icon-swapright m-icon-white"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/additional/plugin/dropzone/dropzone.js"></script>
<script type="text/javascript">
    $("div#dropzonePhotoMhs").dropzone({ url: "<?php echo $this->config->item('file_server')?>index.php/file_uploader/doUploadImage",
        addRemoveLinks:true,
        maxFilesize:1,
        uploadMultiple:false,
        createImageThumbnails:true,
        thumbnailWidth:100,
        thumbnailHeight:100 });
        
    $(document).ready(function(){
        $('#form_anakke').spinner();
        $('#form_jumlahSaudara').spinner({value:0, min: 0});
        
        var n = $('#form_anakke').spinner('value');
        
        doResetForm();
        setDummyData();
    })
    $("#form_pekerjaanMhs").change(function(){
        if($("#form_pekerjaanMhs").val()=="6"){
            $("#form_cond_ptAjar").show(400);
            $("#form_cond_biayaStudi").show(400);
        }else{
            $("#form_cond_ptAjar").hide(400);
            $("#form_cond_biayaStudi").hide(400);   
        } 
    })
    $("#form_statusMasuk").change(function(){
        if($("#form_statusMasuk").val().toLowerCase()=='baru'){
            $("#portlet_sma").show(400);
            $("#portlet_pt").hide(400);
        }else{
            $("#portlet_sma").show(400);
            $("#portlet_pt").show(400);
        }
    });
    $("#form_wniWna").change(function(){
        if($("#form_wniWna").val()=="WNA"){
            $("#form_cond_kewarganegaraan").show(400);
            $("#form_wargaNegara").val('');             
        }else
        if($("#form_wniWna").val()=="WNI"){
            $("#form_cond_kewarganegaraan").hide(400);
            $("#form_wargaNegara").val('IDN');             
        }else{
            $("#form_cond_kewarganegaraan").hide(400);
            $("#form_wargaNegara").val('');
        }
    });
    function doResetForm(){
        $("#portlet_sma").hide();
        $("#portlet_pt").hide();
        $("#form_cond_kewarganegaraan").hide();
        $("#form_cond_ptAjar").hide();
        $("#form_cond_biayaStudi").hide();
    }
    function getSchList(curSma){
        var string='kota='+$("#form_kotaSmu").val();
        $.ajax({
        type    :'POST',
        url     : "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/getDaftarSMA",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            document.getElementById("form_asalSma").innerHTML=data.smu;
            $("#form_asalSma").val(curSma);
          }
        })
    }   
    function setDummyData(){
        
        // Data Pribadi
        $("#nama_calon").val('Ahmad Rianto');
        $("#form_jk").val('L');
        $("#form_provLahir").val('05');
        getKotaByProvinsi("form_provLahir","form_kotaLahir","31");
        $("#form_tglLahir").val('12-02-2012');
        $("#form_wn").val('WNI');
        $("#form_agama").val('1');
        $("#form_alamat").val('Jalan Tidar 100');
        $("#form_provAlamat").val('05');
        getKotaByProvinsi("form_provAlamat","form_kotaAlamat","31");
        $("#form_alamatAsal").val('Jalan Tidar 100');
        $("#form_provAlamatAsal").val('05');
        getKotaByProvinsi("form_provAlamatAsal","form_kotaAlamatAsal","31");
        $("#form_tlp").val('085749809213');
        $("#form_hp").val('085749809213');
        $("#form_email").val('rian@stiki.ac.id');
        $("#form_wniWna").val('WNI');
        $("#form_wargaNegara").val('IDN');
        
        // Orang Tua
        $("#form_namaAyah").val('EDI SUKAMTO');
        $("#form_noKTPAyah").val('1234567891011');
        $("#form_pekerjaanAyah").val('1');
        $("#form_namaIbu").val('SUMARNI');
        $("#form_noKTPIbu").val('1234567891011');
        $("#form_pekerjaanIbu").val('2');
        $("#form_alamatOrtu").val('Jl Raya Bawang gang pondok no 50');
        $("#form_provAlamatOrtu").val('05');
        getKotaByProvinsi("form_provAlamatOrtu","form_kotaAlamatOrtu","31");
        $("#form_teleponOrtu").val('0354 698459');
        $("#form_hpOrtu").val('085649809213');
        
        //Pendidikan SMA/SMK
        $("#form_statusMasuk").val('baru');
        $("#portlet_sma").show(400);
        $("#portlet_pt").hide(400);
        $("#form_provSmu").val('05');
        getKotaByProvinsi("form_provSmu","form_kotaSmu","31");
        setTimeout(function() { getSchList("05001"); }, 400);
        $("#form_jurusanSma").val('1');
        $("#form_nilaiUan").val('46.9');
        $("#form_tahunLulus").val('2010');
        $("#form_tglLulusSma").val('12-02-2012');
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
				toastr['error']("Tidak dapat mengambil daftar kota", "<?php echo $page_title?>")
				return false;
			}
		});  
    }
    
    function isSyaratDaftarValidation(id){
        var frm = document.getElementsByClassName('checkbox_validation');
        var cbType = $("#"+id).attr("validation-type");
        var passed=true;
        var msgId=$("#"+id).parent().children().get(1).getAttribute('id');
        
        for(i=0;i<frm.length;i++){
            if(frm[i].getAttribute('id')==id){
                var elm=frm[i].getElementsByTagName('input');
                var checkCount=0;
                for(j=0;j<elm.length;j++){
                    var elmId=elm[j].getAttribute('id');
                    if(elm[j].getAttribute('required')=='required'){
                        if($("#"+elmId).attr('checked')){
                            checkCount++;
                        }
                    }   
                }
                if(cbType.toLowerCase()=='all'){
                    alert(checkCount);
                    if(checkCount==elm.length){
                        $("#"+msgId).html("");
                        $("#"+msgId).parent().parent().get(0).setAttribute('class','form-group has-error');
                        passed=true;
                    }else{
                        $("#"+msgId).parent().parent().get(0).setAttribute('class','form-group has-success');
                        alert($("#"+msgId).parent().parent().get(0).getAttribute('class'));
                        $("#"+msgId).html("Seluruh syarat harus dipenuhi");
                        passed=false;
                    }
                }
            }
        }
        
        return passed;
    }
    
    function getListOfProdi(jenjang,prodi){
        var jenjang=$("#form_pilihanJenjang").val();
        var string="jenjang="+jenjang;
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/tr_pmb_insert_data/generateProdi",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
                document.getElementById("form_pilihanProdi").innerHTML=data.options;
                //$("#form_prodi").val(prodi);		
				return false;
			}
	   });
    }
</script>