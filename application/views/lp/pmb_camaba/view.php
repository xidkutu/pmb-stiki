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
				 <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        	<th rowspan="2">No</th>
                            <th>NRP</th>
                            <th>Nama Mhs</th>
                            <th>Jenis Kelamin</th>    
                            <th>Kelas</th>
                            <th>Agama</th>
                            <th>Tahun Masuk</th>
                            <th>Provinsi</th>
                            <th>Prodi</th>
                            <th>SMU Asal</th>
                            <th>Asal Informasi</th>
                            <th>Status Daftar</th>
                            <th>Status Daftar Ulang</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                        </tr>
                        <tr>
                            <td class="td_filter">
                                <input type="text" name="fltr_nrp" id="fltr_nrp" maxlength="11" value="<?php echo $nrp; ?>" style="text-transform: uppercase;" />    
                            </td>
                            
                            <td class="td_filter">
                                <input type="text" name="fltr_nama" id="fltr_nama" maxlength="100" value="<?php echo $nama; ?>" style="text-transform: uppercase;" />
                            </td>
                            <td class="td_filter">
                                <select name="fltr_jk" id="fltr_jk" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <option value="L" <?php if($jk=='L') echo 'selected="selected"' ?>>Laki-laki</option>
                                <option value="P" <?php if($jk=='P') echo 'selected="selected"' ?>>Perempuan</option>
                                </select>    
                            </td>
                            
                            </td>
                            <td class="td_filter">
                                <select name="fltr_kelas" id="fltr_kelas" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <option value="R" <?php if($kelas=='R') echo 'selected="selected"' ?>>Reguler</option>
                                <option value="N" <?php if($kelas=='N') echo 'selected="selected"' ?>>Non Reguler</option>
                                <option value="K" <?php if($kelas=='K') echo 'selected="selected"' ?>>Kerja sama</option>
                                </select> 
                            </td>
                            <td class="td_filter">
                                 <select name="fltr_agama" id="fltr_agama" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <?php
                            	foreach($agama->result() as $t){
                            	?>
                                <option value="<?php echo $t->Agama_id;?>" <?php if($t->Agama_id==$selected_agama) echo "selected='selected'";?> ><?php echo $t->Agama;?></option>
                                <?php } ?>
                                </select>
                            </td>
                            </td>
                            <td class="td_filter">
                                <input type="text" name="fltr_tahun" id="fltr_tahun" maxlength="11" value="<?php echo $tahun; ?>" style="text-transform: uppercase;" />
                            </td>
                            <td class="td_filter">
                             <select name="fltr_provinsi" id="fltr_provinsi" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <?php
                            	foreach($provinsi->result() as $t){
                            	?>
                                <option value="<?php echo $t->Kode_Prop;?>" <?php if($t->Kode_Prop==$selected_provinsi) echo "selected='selected'";?> ><?php echo $t->Nama_Prop;?></option>
                                <?php } ?>
                                </select>
                            </td>
                            
                            <td class="td_filter">
                              <select name="fltr_prodi" id="fltr_prodi" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <?php
                            	foreach($prodi->result() as $t){
                            	?>
                                <option value="<?php echo $t->Kode_Prodi;?>" <?php if($t->Kode_Prodi==$selected_prodi) echo "selected='selected'";?> ><?php echo $t->Nama_Prodi;?></option>
                                <?php } ?>
                                </select> 
                            </td>
                            
                            <td class="td_filter">
                            <select name="fltr_smu" id="fltr_smu" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <?php
                            	foreach($SMU->result() as $t){
                            	?>
                                <option value="<?php echo $t->Kode_SMU;?>" <?php if($t->Kode_SMU==$selected_smu) echo "selected='selected'";?> ><?php echo $t->Asal_SMU;?></option>
                                <?php } ?>
                                </select>
                                
                            </td>
                            </td>
                            <td class="td_filter">
                              <select name="fltr_asalInformasi" id="fltr_asalInformasi" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <?php
                            	foreach($asalInformasi->result() as $t){
                            	?>
                                <option value="<?php echo $t->Id_Informasi;?>" <?php if($t->Id_Informasi==$selected_informasi) echo "selected='selected'";?> ><?php echo $t->Nama_Informasi;?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td class="td_filter">
                               <select name="fltr_statusDaftar" id="fltr_statusDaftar" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <option value="online" <?php if($statusDaftar=='online') echo 'selected="selected"' ?>>Online</option>
                                <option value="offline" <?php if($statusDaftar=='offline') echo 'selected="selected"' ?>>Offline</option>
                                </select>
                            </td>
                            
                            <td class="td_filter">
                               <select name="fltr_statusReg" id="fltr_statusReg" class="combo" style="width: 100%">
                                <option value="0">Semua</option>
                                <option value="Yes" <?php if($statusReg=='Yes') echo 'selected="selected"' ?>>YES</option>
                                <option value="No" <?php if($statusReg=='No') echo 'selected="selected"' ?>>NO</option>
                                </select>   
                            </td>
                            
                            <td class="td_filter">
                             <input type="text" id="fltr_tglMasuk" name="fltr_tglMasuk" class="easyui-datebox" style="width: 100%" value="<?php echo $tglMasuk?>" />
                                 
                            </td> 
                                
                           <td class="td_filter">
                               <input type="text" id="fltr_tglMasuk2" name="fltr_tglMasuk2" class="easyui-datebox" style="width: 100%" value="<?php echo $tglMasuk2?>"/>
                                
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    	if($data->num_rows()>0){
                    		$no =1+$hal;
                    		foreach($data->result_array() as $data){  
                    		?>    
                        	<tr onclick="showDetail('<?php echo $data['NRP']; ?>')">
                    			<td><?php echo $no; ?></td>
                                <td><?php echo $data['NRP']; ?></td>
                                <td><?php echo $data['Nama_Mhs']; ?></td>
                                <td><?php echo $data['JK']; ?></td>
                                <td><?php echo $data['Kelas']; ?></td>
                                <td><?php echo $data['Agama']; ?></td>
                                <td><?php echo $data['Tahun_Masuk']; ?></td>
                                <td><?php echo $data['Nama_Prop']; ?></td>
                                <td><?php echo $data['Nama_Prodi']; ?></td>
                                <td><?php echo $data['Asal_SMU']; ?></td>
                                <td><?php echo $data['Nama_Informasi']; ?></td>
                                <td><?php echo $data['Status_Daftar']; ?></td>
                                <td><?php echo $data['Status_Reg']; ?></td> 
                                <td colspan="2"><?php echo $data['Tgl_Masuk']; ?></td>             
                    
                        </tr>
                        <?php
                    		$no++;
                    	               }
                    	                   }else{
                    ?>
                        	<tr>
                            	<td colspan="10" align="center" >Tidak Ada Data</td>
                            </tr>
                     <?php	
                    }
                    ?>
                    </tbody>
                    </table>
                    <?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>