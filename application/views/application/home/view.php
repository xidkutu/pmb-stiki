<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title><?php if(isset($pt_sort_name)) echo $pt_sort_name?> PMB Online</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="STIKI PMB Online" name="description">
  <meta content="stiki, pmb, online" name="keywords">
  <meta content="puskom.stiki.ac.id" name="author">

  <meta property="og:site_name" content="stikipmbonline">
  <meta property="og:title" content="stiki pmb online">
  <meta property="og:description" content="stiki pendaftaran mahasiswa baru online">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="pmb.stiki.ac.id">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <!-- Fonts START -->
  <link href="<?php echo base_url(); ?>assets/frontend/onepage/css/fonts.css" rel="stylesheet" type="text/css">
  <!-- Fonts END -->
  <!-- Global styles BEGIN -->
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
  <!-- Global styles END -->
  <!-- Page level plugin styles BEGIN -->
  <link href="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END --> 
  <!-- Theme styles BEGIN -->
  <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/onepage/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/onepage/css/style-responsive.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/onepage/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="<?php echo base_url(); ?>assets/frontend/onepage/css/custom.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/onepage/css/jquery.notific8.min.css"/>
  <!-- Theme styles END -->
  <!--SELECT2-->
  <link href="<?php echo base_url()?>assets/additional/select2/select2.min.css" rel="stylesheet" type="text/css"/>

</head>
<!--DOC: menu-always-on-top class to the body element to set menu on top -->
<body>  
  <!-- Header BEGIN -->
  <div class="header header-mobi-ext">
    <div class="container">
      <div class="row">
        <!-- Logo BEGIN -->
        <div class="col-md-2 col-sm-2">
          <a class="scroll site-logo" href="#promo-block"><img src="<?php echo base_url(); ?>assets/frontend/onepage/img/stiki_pmb_logo.png" alt="STIKI PMB Online"></a>
        </div>
        <!-- Logo END -->
        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
        <!-- Navigation BEGIN -->
        <div class="col-md-10 pull-right">
          <ul class="header-navigation">
            <li class="current"><a href="#promo-block">Home</a></li>
            <li><a href="http://pmb.stiki.ac.id/assets/files/brosur.zip">Brosur</a></li>			
            <?php if(empty($username)) echo('<li><a href="#daftar">Daftar</a></li>');  ?>
            <li><a href="#prodi">Program Studi</a></li>
            <li><a href="#jalur">Jalur</a></li>
            <li><a href="#beasiswa">Beasiswa</a></li>
            <li><a href="#panduan">Panduan</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <?php if(!empty($username)) echo('<li><a href="dashboard">Halaman User</a></li>') ?>
            <li><?php if (!empty($username)) echo('<a href="login/logout">Logout</a>'); else echo('<a href="login">Login</a>'); ?></li>
          </ul>
        </div>
        <!-- Navigation END -->
      </div>
    </div>
  </div>
  <!-- Header END -->
  <!-- Promo block BEGIN -->
  <div class="promo-block" id="promo-block">
    <div class="tp-banner-container">
      <div class="tp-banner" >
        <ul>         
		  <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
            <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/silder/slide11.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="tp-caption large_text customin customout start"
              data-x="center"
              data-hoffset="0"
              data-y="center"
              data-voffset="60"
              data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
              data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
              data-speed="1000"
              data-start="500"
              data-easing="Back.easeInOut"
              data-endspeed="300">              
            </div>            
          </li>   		   
          <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
            <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/silder/slide9.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="tp-caption large_text customin customout start"
              data-x="center"
              data-hoffset="0"
              data-y="center"
              data-voffset="60"
              data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
              data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
              data-speed="1000"
              data-start="500"
              data-easing="Back.easeInOut"
              data-endspeed="300">
            </div>            
          </li>
          <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
            <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/silder/slide8.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="tp-caption large_text customin customout start"
              data-x="center"
              data-hoffset="0"
              data-y="center"
              data-voffset="60"
              data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
              data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
              data-speed="1000"
              data-start="500"
              data-easing="Back.easeInOut"
              data-endspeed="300">
              <div class="promo-like"><i class="fa fa-cloud-download"></i></div>
              <div class="promo-like-text">
                <h2>Brosur STIKI Terbaru</h2>
                <p>Informasi Pendidikan dan Biaya.
                <a href="<?php echo base_url(); ?>assets/files/brosur.zip"> Klik disini untuk download brosur</a></p>
              </div>
            </div>            
          </li> 
                              
        <!-- THE THIRD SLIDE -->                    
        </ul>
      </div>
    </div>
  </div>
  <!-- Promo block END -->
  
  <!-- DAFTAR SEKARANG block BEGIN -->
  <!-- form daftar -->
  <div class="about-block content content-center <?php if(!empty($username)) echo('hide');  ?>" id="daftar">
    <div class="container">      
      <!-- BEGIN CONTENT -->
      <!-- <div class="col-md-9 col-sm-9"> -->
        <h2>Pendaftaran PMB Online</h2>
        <h4>Silahkan anda mengisi data dibawah ini :</h4>        
        <div class="content-form-page">
          <div class="row">
            <div class="col-md-2 col-sm-2"></div>            
              <form name="form_register" class="form-horizontal col-md-8 col-sm-8" role="form" action="<?= site_url('home/register');?>" method="post">
                <fieldset>                   
                 <div id="pesan" class="alert alert-info alert-dismissable" hidden="hidden">
                    <button type="button" class="close" data-hide="alert">&times;</button>
                    <strong>Info : </strong><span>Item isian belum terisi semuanya.</span>
                </div> 
                  <div class="form-group">
                    <label for="form_nama" class="col-lg-3 control-label pull-left">Nama Lengkap<span class="require">*</span></label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="form_nama" name="form_nama" placeholder="Nama Lengkap">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="form_provLahir" class="col-lg-3 control-label pull-left">Propinsi<span class="require">*</span></label>                        
                    <div class="col-lg-8">
						<select name="form_provLahir" id="form_provLahir" class="form-control" onchange="getKotaByProvinsi('form_provLahir','form_kotaLahir','');">
                        <option value="0">-PILIH PROVINSI-</option>
                        <?php
                            foreach ($propinsi->result() as $t)
                            {                               
                            ?>    
                       <option value="<?php echo $t->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
                          <?php } ?>
                       </select>                           
					</div>                        
				  </div>
                  <div class="form-group">
                    <label for="form_kotaLahir" class="col-lg-3 control-label pull-left">Kota<span class="require">*</span></label>                        
                    <div class="col-lg-8">
						<select name="form_kotaLahir" id="form_kotaLahir" class="form-control" onchange="getSmaByKota('form_kotaLahir','form_sma','');">
                            <option value="0">-PILIH KOTA-</option>
                        </select>                          
					</div>                        
				  </div>  
                  <div class="form-group">
                    <label for="form_sma" class="col-lg-3 control-label pull-left">SMA Asal<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <select class="form-control" name="form_sma" id="form_sma" style="text-align: left;">
                          <option value="0">-PILIH SMA-</option>
                        </select>
                        <div class="alert alert-info" style="margin-top: 5px; margin-bottom: 10px;">
                        <strong>Info!</strong> Apabila sekolah tidak ada pada daftar, pilih <strong>Lainnya</strong> di paling bawah daftar sekolah. </div>
					</div>                        
				  </div>
                  <div class="form-group" id="form-group-form_sma_lain" style="display: none;">
                    <label for="form_sma" class="col-lg-3 control-label">Nama Sekolah<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="form_sma_lain" name="form_sma_lain" placeholder="Nama Sekolah">
					</div>                        
				  </div>                                  
                  <div class="form-group" id="form-group-form_alamat_sma_lain" style="display: none;">
                    <label for="form_sma" class="col-lg-3 control-label">Alamat Sekolah<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="form_alamat_sma_lain" name="form_alamat_sma_lain" placeholder="Alamat Sekolah">
					</div>                        
				  </div>
                  <div class="form-group" id="form-group-form_telp_sma_lain" style="display: none;">
                    <label for="form_sma" class="col-lg-3 control-label">Telepon Sekolah<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="form_telp_sma_lain" name="form_telp_sma_lain" placeholder="Telepon Sekolah">
					</div>                        
				  </div>
                  <div class="form-group" id="form-group-form_email_sma_lain" style="display: none;">
                    <label for="form_sma" class="col-lg-3 control-label">Email Sekolah<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="form_email_sma_lain" name="form_email_sma_lain" placeholder="Email Sekolah">
					</div>                        
				  </div>
                  <div class="form-group" id="form-group-form_web_sma_lain" style="display: none;">
                    <label for="form_sma" class="col-lg-3 control-label">Website Sekolah<span class="require">*</span></label>                        
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="form_web_sma_lain" name="form_web_sma_lain" placeholder="Website Sekolah">
					</div>                        
				  </div>
                  <div class="form-group">
                    <label for="form_email" class="col-lg-3 control-label pull-left">Email <span class="require">*</span></label>
                    <div class="col-lg-8">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input type="email" class="form-control" id="form_email" name="form_email" placeholder="Alamat email">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="form_nohp" class="col-lg-3 control-label pull-left">No.HP <span class="require">*</span></label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control .numbersOnly" id="form_nohp" name="form_nohp" placeholder="Nomor Telp/HP">
                    </div>                    
                  </div>
                  <div class="form-group">                    
                    <label for="captcha" class="col-lg-3 control-label pull-leftn  ">Captcha<span class="required"> * </span></label>
                    <div class="col-lg-8">
                    <div class="row">                        
                        
                        <div class="col-md-4 pr5" id="imgcaptcha" ><?php echo $captcha['image']; ?></div>                                                                                                                                  
                        <div class="col-lg-6 pl5">
                            <div class="input-group">                                
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" name="form_captcha" id="form_captcha" class="form-control" placeholder="Masukkan Captcha disebelah">                                
                            </div>                                                                                                
                        </div>
                        <div class="col-lg-2 pl5">
                            <button type="button" class="btn btn-hover btn-primary btn-block" id="btncaptcharefresh"><i class="fa fa-refresh"></i></button>
                        </div>
                        
                        
                                                
                    </div>
                    </div>                    
                  </div>
                  <div class="form-group">                    
                    <div id="bootstrap_alerts_demo">
					</div>
                  </div>
                </fieldset>                                        
                <div class="row">
                 <div class="col-lg-3"></div>
                 <div class="col-lg-3" style="margin-bottom: 20px;">
                                        
                    <button type="button" class="btn blue pull-left" id="btndaftar">Daftar</button>                    
                    <button type="button" class="btn default pull-right" id="btnregreset">Clear</button>                                      
                  
                  </div>
                </div>                
              </form>
              <div class="col-md-2 col-sm-2"></div>
            </div>            
          </div>
        </div>
      <!-- </div> -->
      <!-- END CONTENT -->
      
    </div>
  </div>
  <!-- DAFTAR SEKARANG block END -->
  
  <!-- Team block BEGIN -->
  <div class="team-block content content-center margin-bottom-40" id="prodi">
    <div class="container">
      <h2>Program <strong>Studi</strong></h2>     
      <h4>Berikut penjelasan beberapa program studi</h4> 
      <div class="row">
        <div class="col-md-3 item">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/people/d3.jpg" alt="D3" class="img-responsive">
          <h3>D3 Manajemen Informatika</h3>
          <em>Jenjang D3, Gelar : Amd.Kom</em>
          <p style="text-align: left;">Menyiapkan lulusan yang mampu mengembangkan aplikasi berbasis web, multimedia & jaringan komputer seiring dengan perkembangan teknologi digital saat ini</p>
          <p style="text-align: left;"><strong>Matakuliah unggulan :</strong></p>
          <p><ul class="text-left">
                <li>Desain web</li>
                <li>Pemrograman web</li>
                <li>E-commerce</li>
                <li>Keamanan Jaringan</li>
              </ul>
          </p>
          <div class="tb-socio">
            <a href="javascript:void(0);" class="fa fa-facebook"></a>
            <a href="javascript:void(0);" class="fa fa-twitter"></a>
            <a href="javascript:void(0);" class="fa fa-google-plus"></a>
          </div>
        </div>
        <div class="col-md-3 item">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/people/s1.jpg" alt="S1" class="img-responsive">
          <h3>S1 Teknik Informatika</h3>
          <em>Jenjang S1, Gelar : S.Kom</em>
          <p style="text-align: left;">Menyiapkan profesional IT yang mampu menerapkan ilmu dan teknologi baru di bidang informatika pada berbagai profesi. Lulusan program studi juga akan memiliki kompetensi dalam
          pengembangan sistem cerdas, pengembangan perangkat lunak pada berbagai platform, pengembangan game, serta memiliki soft skills dan jiwa entrepreneurship yang tinggi
          </p>
          <p style="text-align: left;"><strong>Mata Kuliah Unggulan :</strong></p>
          <p><ul class="text-left">
            <li>Pemrograman Mobile</li>
            <li>Keamanan Informasi</li>
            <li>Komputasi Pervasif</li>
            <li>Pemrograman Berorientasi Object</li>
            <li>Data Mining</li>
            <li>Game Development</li>
          </ul>
          </p>
          <div class="tb-socio">
            <a href="javascript:void(0);" class="fa fa-facebook"></a>
            <a href="javascript:void(0);" class="fa fa-twitter"></a>
            <a href="javascript:void(0);" class="fa fa-google-plus"></a>
          </div>
        </div>
        <div class="col-md-3 item">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/people/s1a.jpg" alt="S1" class="img-responsive">
          <h3>S1 Desain Komunikasi Visual</h3>
          <em>Jenjang S1, Gelar : S.Ds</em>
          <p style="text-align: left;">Menyiapkan lulusan yang memahami Desain Komunikasi Visual dan mengembangkan dalam bentuk aplikasi komputer yang berbasis multimedia baik secara offline maupun online
          </p>
          <p style="text-align: left;"><strong>Mata Kuliah Unggulan :</strong></p>
          <p><ul class="text-left">
            <li>Design</li>
            <li>Multimedia</li>
            <li>Periklanan</li>
            <li>Newmedia</li>
            <li>Animasi 3D</li>
          </ul></p>
          <div class="tb-socio">
            <a href="javascript:void(0);" class="fa fa-facebook"></a>
            <a href="javascript:void(0);" class="fa fa-twitter"></a>
            <a href="javascript:void(0);" class="fa fa-google-plus"></a>
          </div>
        </div>
        <div class="col-md-3 item">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/people/s1b.jpg" alt="S1" class="img-responsive">
          <h3>S1 Sistem Informasi</h3>
          <em>Jenjang S1, Gelar : S.KOM</em>
          <p style="text-align: left;">Menyiapkan lulusan yang memahami, mengolah sistem informasi guna meningkatkan strategi kompetitif & pengambilan keputusan bisnis yang cepat dan tepat sesuai dengan perkembangan teknologi saat ini</p>
          <p style="text-align: left;"><strong>Mata Kuliah Unggulan :</strong></p>
          <p><ul class="text-left">
            <li>Integrated Enterprise</li>
            <li>Supply Chain Management System</li>
            <li>Management Support Systems</li>
            <li>e-Business</li>
            <li>IS Strategic Planning</li>
            <li>Sistem Enterprise</li>
            <li>Audit Sistem Informasi</li>                        
          </ul></p>
          <div class="tb-socio">
            <a href="javascript:void(0);" class="fa fa-facebook"></a>
            <a href="javascript:void(0);" class="fa fa-twitter"></a>
            <a href="javascript:void(0);" class="fa fa-google-plus"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Team block END -->
  
  <!-- Jalur penerimaan block BEGIN -->
  <div class="prices-block content content-center" id="jalur">
  	<div class="container">
      <h2 class="margin-bottom-50"><strong>Jalur</strong> Penerimaan</h2>
	  <div class="row" id="rowjalur">        
        <!-- Pricing item BEGIN -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="pricing-item">
            <div class="pricing-head">
              <h3>Jalur Undangan</h3>
              <p>Program</p>
            </div>
            <div class="pricing-content">
              <div class="pi-price">
              	<strong><em>1</em></strong>
				<b><p>JADWAL :</p></b>			
				<ul style="text-align:left;">
					<li>Pendaftaran mulai 1 Oktober 2016 - 28 Februari 2017</li>
					<li>Pengumuman satu minggu setelah pengumpulan berkas</li>
				</ul>              	
				<b><p>FASILITAS :</p></b>
				<ul style="text-align:left">
					<li>Free uang Pangkal / Uang Gedung</li>				
					<li>Free SPP Semester 1</li>
				</ul>
				<b><p>PERSYARATAN :</p></b>
				<ul style="text-align:left">
					<li>Siswa SMA/K Kelas XII Tahun Ajaran 2016/2017</li>				
					<li>Mengumpulkan fotokopi Raport kelas X-XII (sudah dilegalisir) dengan nilai Matematika dan B. Inggris Sem 1-4 harus KKM+5 untuk Jurusan Teknik Informatika dan Sistem Informasi</li>
					<li>Mengumpulkan fotokopi Raport kelas X-XII (sudah dilegalisir) dengan nilai B. Inggris Sem 1-4 harus KKM+5 untuk Jurusan Desain Komunikasi Visual</li>
				</ul>
              </div>	          			  
            </div>
            <div class="pricing-footer">              
            </div>
          </div>
        </div>
        <!-- Pricing item END -->
        <!-- Pricing item BEGIN -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="pricing-item">
            <div class="pricing-head">
              <h3>Reguler</h3>
              <p>Jalur Reguler (Semester Genap)</p>
            </div>
            <div class="pricing-content">
              <div class="pi-price">
              	<strong><em>2</em></strong>
              	<b><p>Pendaftaran mulai dari</p></b>
				<b><p>1 Oktober 2016 - 31 Januari 2017</p></b>
              </div>
	          <ul class="list-unstyled" style="text-align: center;">
	            <li>Test masuk dan wawancara</li>	            
	          </ul>
            </div>
            <div class="pricing-footer">
<!--              <a class="btn btn-default" href="javascript:void(0);">Sign Up</a> -->
            </div>
          </div>
        </div>
        <!-- Pricing item END --> 
        <!-- Pricing item BEGIN -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="pricing-item">
            <div class="pricing-head">
              <h3>Double Degree</h3>
              <p>Program</p>
            </div>
            <div class="pricing-content">
              <div class="pi-price">
              	<strong><em>3</em></strong>
              	<b><p>STIKI + Sun Moon University</p></b>
              </div>
			  <div class="text-center">
				<img src="assets/frontend/onepage/img/stiki-mu.png" />
			  </div>
<!--			  
	          <ul class="list-unstyled" style="text-align: center;">
	            <li style="margin-bottom: 15px;">Prodi Teknik Informatika (TI), dengan persyaratan sebagai berikut :
                    <ul style="text-align: left;">
                        <li>Rapot kelas X-XI mata pel B.Ing & Mat KKM+5</li>
                        <li>Jurusan SMA (IPA), SMK (TKJ, RPL)</li>
                        <li>Lulus tes online dan wawancara</li>
                        <li>Semua Nilai UN >= 80</li>
                    </ul>
                </li>	            	            
	          </ul>
-->			  
            </div>
            <div class="pricing-footer">              
            </div>
          </div>
        </div>
        <!-- Pricing item END -->       
      </div>
    </div>
  </div>
  <!-- Jalur penerimaan block END -->
  
<!-- JALUR PENDIDIKAN block BEGIN -->
  <div class="services-block content content-center" id="jenjang">
    <div class="container">
      <h2>Jenjang <strong>Pendidikan</strong></h2>
      <h4>Ada beberapa jenjang pendidikan yang tersedia di STIKI :</h4>

      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 item">
          <i class="fa fa-graduation-cap"></i>
          <h3>Diploma 3</h3>
          <ul class="list-unstyled">
            <li>D3 Manajemen Informatika</li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 item">
          <i class="fa fa-graduation-cap"></i>
          <h3>STRATA 1</h3>
          <ul class="list-unstyled">
            <li> S1 Teknik Informatika </li>
            <li> S1 Desain Komunikasi Visual</li>	            
            <li> S1 Sistem Informasi</li>
          </ul>
        </div>        
        <div class="col-md-4 col-sm-4 col-xs-12 item">
          <i class="fa fa-graduation-cap"></i>
          <h3>Pasca Sarjana<br/>Dual Mode UI-STIKI</h3>
          <ul class="list-unstyled">
            <li>Magister Ilmu Komputer</li>
            <li>Magister Teknologi Informasi</li>
          </ul>          
        </div>        
      </div>
    </div>
  </div>
  <!-- JALUR PENDIDIKAN block END -->
  <!-- Message block BEGIN -->
  <div class="message-block content content-center valign-center" id="message-block">
    <div class="valign-center-elem">
      <h2><strong>BACHELOR OF INFORMATICS</strong>DOUBLE DEGREE PROGRAM</h2>
      <em>This program gives the student a chance to study in two university, <br/>STIKI and Sun Moon University at the first two years of their study informatics at STIKI that is continued<br/>at Sun Moon University at the next two years. At the end of their study, <br/>the student will get two academic titles of Bachelors of Informatics both <br/>from STIKI and Sun Moon University</em>
    </div>
  </div>
  <!-- Message block END -->  
  
<!-- Checkout block BEGIN -->
  <div class="checkout-block content">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h2>PROGRAM PASCA SARJANA</h2>
        </div>
        <div class="col-md-2 text-right">
          <a href="#daftar" class="btn btn-primary">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Checkout block END -->
  <!-- Facts block BEGIN -->
  <div class="facts-block content content-center" id="facts-block">
    <div>    
    <h2>PROGRAM PASCA SARJANA<br/>Dual Mode Program STIKI dan Universitas Indonesia</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="item">
            <p>MAGISTER<br/>ILMU KOMPUTER</p>
            <strong>M.IK</strong>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="item">            
            <p>MAGISTER<br/>TEKNOLOGI INFOMRASI</p>
            <strong>M.TI</strong>
          </div>
        </div>        
        
      </div>
    </div>
  </div>
  <!-- Facts block END -->  
    
  <!-- BEASISWA block BEGIN -->
  <div class="choose-us-block content text-center margin-bottom-40" id="beasiswa">
    <div class="container">
      <h2>Beasiswa</h2>
      <h4>Ada beberapa beasiswa yang bisa diperoleh di STIKI, diantaranya adalah :</h4>
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 text-left">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/beasiswa.png" alt="Beasiswa" class="img-responsive">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 text-left">
          <div class="panel-group" id="accordion1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">Jalur Beasiswa Penuh Akademik Januari s/d Juli 2016</a>
                </h5>
              </div>
              <div id="accordion1_1" class="panel-collapse collapse in">
                <div class="panel-body">
                  <p>Syarat Masuk :</p>
                  <p>
                  <ul>
                    <li>Nilai UN permata pelajaran >= 80</li>
                    <li>Nilai Matematika dan Bhs. Inggris kelas XI dan XII yaitu KKM +5 dari semester 1-4</li>
                    <li>Dari Golongan tidak mampu (menyerahkan surat keterangan tidak mampu dari kelurahan, rekening listrik dan air)</li>
                    <li>Jurusan IPA untuk SMA, TKJ/RPL untuk SMK</li>
                    <li>Melampirkan sertifikat Juara 1/2/3 Lomba tingkat lokal, regional, nasional maupun internasional</li>
                    <li>Rekomendasi Kepala Sekolah</li>
                  </ul></p>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">Jalur Beasiswa Penuh Olahraga Januari s/d Juli 2016</a>
                </h5>
              </div>
              <div id="accordion1_2" class="panel-collapse collapse">
                <div class="panel-body">
                  <p>Syarat Masuk :</p>
                  <p>Untuk Program Studi Teknik Informatika</p>
                  <p>
                  <ul>
                    <li>Nilai raport Bahasa Inggris, Matematika, Penjas (KKM+5)</li>
                    <li>Nilai UAN Min 8 (Bahasa Inggris dan Matematika)</li>
                    <li>SMA dengan jurusan IPA, SMK dengan jurusan TKJ, RPL</li>
                  </ul>
                  </p>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">Jalur Beasiswa Bidik Misi</a>
                </h5>
              </div>
              <div id="accordion1_3" class="panel-collapse collapse">
                <div class="panel-body">
                  <p>
                  <ul>
                    <li>Nilai UN permata pelajaran >= 80</li>
                    <li>Nilai Matematika dan Bhs. Inggris kelas XI dan XII yaitu KKM +5 dari semester 1-4</li>
                    <li>Dari Golongan tidak mampu (menyerahkan surat keterangan tidak mampu dari kelurahan, rekening listrik dan air)</li>
                    <li>Jurusan IPA untuk SMA, TKJ/RPL untuk SMK</li>
                    <li>Melampirkan sertifikat Juara 1/2/3 Lomba tingkat lokal, regional, nasional maupun internasional</li>
                    <li>Rekomendasi Kepala Sekolah</li>
                  </ul>
                  </p>                  
                </div>
              </div>
            </div>
                        
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- BEASISWA block END -->
  
  <!-- PANDUAN block BEGIN -->
  <div class="choose-us-block content text-center margin-bottom-40" id="panduan">
    <div class="container">
      <h2>Panduan <strong>Pendaftaran</strong></h2>
      <h4>Berikut proses pendaftaran baik secara online maupun secara offline :</h4>
      <div class="row">        
        <div class="col-md-12 col-sm-12 col-xs-12 text-left">
          <div class="panel-group" id="accordion11">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion11" href="#accordion11_1">Pendaftaran Online</a>
                </h5>
              </div>
              <div id="accordion11_1" class="panel-collapse collapse in">
                <div class="panel-body">
                  <p><ul>
                    <li><p><strong>Persiapan sebelum pendaftaran</strong></p>   <!-- nomer 1 -->
                        <p>Sebelum melakukan pendaftaran online pastikan sudah memiliki beberapa file scanning gambar untuk</p>
                        <p>
                          <ul>
                            <li>Akte kelahiran</li>
                            <li>Rapor semester 1-4 (kelas X-XI) dilegalisir</li>
                            <li>Ijasah, SKHUN dilegalisir</li>                            
							<li>2 lembar pasfoto 3x4 menggunakan kemeja putih polos bukan seragam sekolah dengan background (S1: Biru : D3 :Merah)</li>
                            <li>1 lembar fotocopy ktp</li>
                          </ul></p>                        
                    </li>
                    <li><p><strong>Melakukan Transfer pembayaran uang pendaftaran</strong></p>  <!-- nomer 2 -->
                        <p>
                            <ul>
                                <li><p>Pembayaran uang pendaftaran mahasiswa baru STIKI untuk S1 & D3  dapat dilakukan Melalui bank dengan Account : <strong>Rekening BCA a.n STIKI Malang : 440.3000.909</strong></p></li>                                
								<li><p>Setelah transfer simpan bukti transfer pembayaran tersebut kemudian di scan dan dikirim ke e-mail : <strong>menik@stiki.ac.id</strong> atau di upload melalui login ke website pmb.stiki.ac.id.</p></li>
                            </ul>
                        </p>
                    </li>
                    <li><p><strong>Cara pendaftaran</strong></p>  <!-- nomer 3 -->
                        <p>Pendaftaran dapat dilakukan dengan klik "Form Pendaftaran" dan mengisi data beberapa langkah :</p>
                        <p>isi data calon mahasiswa, data orang lain, lain-lain dan upload dokumen Petunjuk pengisian :</p>
                        <p>
                          <ul>
                            <li>Klik pada salah satu pilihan berikut, misalnya S1 untuk Teknik Informatika, dan Pilih D3 untuk Manajemen  Informatika</li>
                            <li>Isi Nama lengkap pada kotak entri / kosong, dengan huruf besar</li>
                            <li>Harap dicek ulang untuk pertanyaan yang bertanda * berarti tidak boleh kosong (wajib diisi)</li>
                            <li>Klik tombol selanjut untuk menuju pengisian berikutnya pada langkah 2 dan langkah 3</li>
                          </ul>
                        </p>
                    </li>
                    <li><p><strong>Upload Dokumen</strong></p>   <!-- nomer 4 -->
                        <p>
                            <ul>
                                <li>Setelah pengisian data langkah 1 hingga langkah 3, selanjutnya upload dokumen berupa file scanning(Jpeg/ bmp) dengan memilih Browse</li>
                                <li>Pilih Folder, pilih File dan klik nama file pilih Open</li>
                                <li>Masukan kode rahasiswa yang tertera pada layar</li>
                                <li>Pilih Daftar</li>
                            </ul>
                        </p>
                    </li>
                    <li><p><strong>Konfirmasi pendaftaran</strong></p>
                        <p>Setelah mendaftar online, team PMB STIKI akan menghubungi anda melalui email atau No telp yang sudah diisi</p>
                        <p>Hasil pengumuman penerimaan mahasiswa secara online ini akan kami beritahukan melalui email atau sms dari dari nomer telpon</p>
                    </li>
                    <li><p><strong>Biaya Pendaftaran</strong></p>
                        <p><p>Untuk semua jalur sebesar <strong>Rp. 200.000</strong></p></p>
                    </li>
                  </ul>
                  </p>
                </div>
              </div>
            </div>                                    
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#accordion11_2">Pendaftaran Offline</a>
                </h5>
              </div>
              <div id="accordion11_2" class="panel-collapse collapse">
                <div class="panel-body">
                  <p><ul>
                  <li><p><strong>Persiapan sebelum pendaftaran</strong></p>
                      <p><strong>Sebelum melakukan pendaftaran offline pastikan sudah memiliki beberapa file untuk syarat pendaftaran :</strong></p>
                        <ul>
                            <li>akte kelahiran 2 lembar masing-masing foto copy dan dilegalisir</li>
                            <li>Rapor semester 1-4 (kelas X-XI), 2 lembar masing-masing foto copy dan dilegalisir</li>
                            <li>Ijasah, SKHUN 2 lembar masing-masing foto copy dan dilegalisir</li>                            
							<li>2 lembar pasfoto 3x4 menggunakan kemeja putih polos bukan seragam sekolah dengan background (S1: Biru : D3 :Merah)</li>
                            <li>1 lembar foto copy ktp</li>
                        </ul>
                  </li>
                  <li><p><strong>Melakukan pembayaran uang pendaftaran</strong></p>
                        <ul>
                            <li><p>Pembayaran uang pendaftaran mahasiswa baru STIKI untuk S1 & D3 dapat dilakukan di STIKI, atau Melalui bank dengan Account : <strong>Bank BCA a.n STIKI Malang : 440.3000.909</strong></p></li>
                            <li><p>Setelah transfer simpan bukti transfer pembayaran, kemudian fotocopy bukti pembayaran, kirimkan ke fax STIKI (0341)562525 atau lakukan scanning bukti transfer pembayaran dalam bentuk file (*.jpg) lalu kirimkan melalui e-mail : pmb@stiki.ac.id(link sends e-mail)</p></li>
                        </ul>
                  </li>
                  <li><p><strong>Syarat Pendaftaran S1 dan D3 :</strong></p>
                      <p><ul>
                            <li>Mengisi formulir pendaftaran</li>
                            <li>Mengumpulkan Foto copy Akte</li>
                            <li>Mengumpulkan Foto copy dan legalisir Raport</li>
                            <li>Mengumpulkan Foto copy dan Legalisir SKHUN, Ijazah, atau SKL (bisa disusulkan untuk lulusan 2014)</li>
                            <li>2 lembar pasfoto 3x4 background (S1: Biru : D3 :Merah)</li>
                      </ul></p>
                  </li>
                  </ul></p>                                                     
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title">
                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#accordion11_3">Pendaftaran Pascasarjana jenjang strata 2 STIKI secara offline</a>
                </h5>
              </div>
              <div id="accordion11_3" class="panel-collapse collapse">
                <div class="panel-body">
                  <p><ul>
                        <li><p><strong>SYARAT AKADEMIK S2</strong></p>
                            <p><ul>
                                <li>Program Magister Ilmu Komputer : Berijazah Sarjana (S1) di bidang Ilmu Komputer, Sistem Informasi, Informatika, Teknik Komputer, Teknik Elektro, Matematika, Fisika, atau ilmu lain yang terkait, dengan Indeks Prestasi tidak kurang dari 2.75 (pada skala 4.00); serta lulus Ujian Saringan UI yang meliputi Test Potensi Akademik dan Bahasa Inggris</li>
                                <li>Program Magister Teknologi Informasi : Lulusan S-1 dengan latar belakang keilmuan:Ilmu Komputer, Teknik Informatika, Sistem Informasi, Teknik Komputer, Teknik Elektro, Matematika, Fisika; atau Bidang keilmuan selain tersebut di atas dengan pengalaman kerja di bidang Teknologi Informasi; Lulus Ujian Saringan yang meliputi Tes Potensi Akademik (Quantitative Aptitude Test) dan Bahasa Inggris (Grammar; Vocabulary; Reading)</li>
                            </ul></p>
                        </li>
                        <li><p><strong>MEKANISME PENDAFTARAN</strong></p>
                            <p><ul>
                                <li>Calon peserta melakukan registrasi keikutsertaan dalam program dual mode melalui local partner STIKI di Kampus STIKI, Sekretariat PMB Jl. Tidar 100 Malang.</li>
                                <li>Selanjutnya Calon peserta melakukan registrasi secara online yang difasilitasi local partner melaluihttp://penerimaan.ui.ac.id. Mengingat registrasi online ini merupakan kegiatan terpusat dari Universitas Indonesia, mohon agar selalu mengupdate informasi melalui situs tersebut.</li>
                                <li>Ujian masuk program dual mode bisa dilakukan di local partner selama memenuhi syarat yang sudah ditetapkan oleh Fasilkom Universitas Indonesia.</li>
                                <li>Peserta yang dinyatakan lulus ujian masuk, akan menjadi mahasiswa Universitas Indonesia dengan segala hak dan kewajibannya sesuai dengan ketentuan yang berlaku di Universitas Indonesia. Ijazah yang diperoleh setelah lulus program dual mode ini merupakan ijazah Universitas Indonesia.</li>
                            </ul></p>
                        </li>
                    </ul>
                  </p>                                                     
                </div>
              </div>
            </div>
                        
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- PANDUAN block END -->
  
  <!-- Galeri block BEGIN -->
  <div class="portfolio-block content content-center" id="galeri">
    <div class="container">
      <h2 class="margin-bottom-50">Galeri</h2>
    </div>    
    <div class="row" style="margin-bottom: 0px;">
	  <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_1.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_1.jpg" title="Indonesia Culture Summer Camp in Nanjing China" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Indonesia Culture Summer Camp Nanjing China</strong>
            <em><p>
				Marshel Calvin-121110514<br/>
				Steven Indra-151221005</p>
			</em>
            <b>Details</b>
          </div>
        </a>
      </div>
	  <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_2.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_2.jpg" title="Indonesia Culture Summer Camp in Nanjing China" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Indonesia Culture Summer Camp Nanjing China</strong>
            <em><p>
				Marshel Calvin-121110514<br/>
				Steven Indra-151221005</p>
			</em>
            <b>Details</b>
          </div>
        </a>
      </div>
	  <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_3.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/summercamp_3.jpg" title="Indonesia Culture Summer Camp in Nanjing China" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Indonesia Culture Summer Camp Nanjing China</strong>
            <em><p>
				Marshel Calvin-121110514<br/>
				Steven Indra-151221005</p>
			</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/11.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/11.jpg" title="Spring Semester Exchange Students Orientation" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Spring Semester Exchange Students Orientation</strong>
            <em>Mahasiswa Double Degree STIKI & Sun Moon University</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/12.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/12.jpg" title="Spring Semester Exchange Students Orientation" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Spring Semester Exchange Students Orientation</strong>
            <em>Mahasiswa Double Degree STIKI & Sun Moon University</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/13.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/13.jpg" title="Spring Semester Exchange Students Orientation" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Spring Semester Exchange Students Orientation</strong>
            <em>Mahasiswa Double Degree STIKI & Sun Moon University</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      
    </div>
    
	
	<div class="row">
		<div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/14.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/14.jpg" title="Spring Semester Exchange Students Orientation" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Spring Semester Exchange Students Orientation</strong>
            <em>Mahasiswa Double Degree STIKI & Sun Moon University</em>
            <b>Details</b>
          </div>
        </a>
      </div>      
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/16.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/16.jpg" title="Spring Semester Exchange Students Orientation" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Spring Semester Exchange Students Orientation</strong>
            <em>Mahasiswa Double Degree STIKI & Sun Moon University</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/2.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/2.jpg" title="coba" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Seminar Nasional James Gwee</strong>
            <em>Seminar</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/6.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/6.jpg" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>STIKI Students Competition</strong>
            <em>Kegiatan</em>
            <b>Details</b>
          </div>
        </a>
      </div>      
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/3.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/3.jpg" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Seminar Nasional Tung Desem Waringin</strong>
            <em>Seminar</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/5.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/5.jpg" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>STIKI Students Competition</strong>
            <em>Kegiatan</em>
            <b>Details</b>
          </div>
        </a>
      </div>
<!-- 	  
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/4.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/4.jpg" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Knowledge Sharing Alumni</strong>
            <em>Seminar</em>
            <b>Details</b>
          </div>
        </a>
      </div>
      <div class="item col-md-2 col-sm-6 col-xs-12">
        <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/1.jpg" alt="NAME" class="img-responsive">
        <a href="<?php echo base_url(); ?>assets/frontend/onepage/img/portfolio/1.jpg" class="zoom valign-center">
          <div class="valign-center-elem">
            <strong>Lomba Design Web dan Poster</strong>
            <em>Kegiatan</em>
            <b>Details</b>
          </div>
        </a>
      </div>
-->	  
    </div>
  </div>
  <!-- Galeri block END -->
  
  <!-- Testimonials block BEGIN -->
  <div class="testimonials-block content content-center margin-bottom-65">
    <div class="container">
      <h2>Testimoni <strong>Alumni</strong></h2>
      <h4>Berikut testimoni dari para alumni STIKI</h4>
      <div class="carousel slide" data-ride="carousel" id="testimonials-block">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <!-- Carousel items -->
          <div class="active item">
            <blockquote>
              <p>STIKI mengajarkan berfikir terstruktur dan sistematis yang hingga saat ini berguna dalam karir saya</p>
            </blockquote>
            <p style="margin-top: 20px;" class="testimonials-name">Tiara Nugrahadi Matius, Amd.Kom</p>
            <span class="testimonials-job">System Manager JW Marriot Surabaya, Indonesia</span>
          </div>
          <!-- Carousel items -->
          <div class="item">
            <blockquote>
              <p>STIKI telah memberikan dasar dan pemahaman IT business serta membantu logika berfikir dalam bisnis dan jiwa entrepreneur</p>
            </blockquote>
            <p style="margin-top: 20px;" class="testimonials-name">Denny Santoso, S.Kom</p>
            <span class="testimonials-job">CEO of PT. Jaya Sportindo</span>            
          </div>
          <!-- Carousel items -->
          <div class="item">
            <blockquote>
              <p>Saya merasakan sebuah perpaduan yang sempurna antara pengalaman secara akademis maupun berinteraksi secara sosial. STIKI memberi saya dasar yang saya butuhkan untuk memulai karir saya. Terima kasih STIKI yang mengajar dan melatih saya sehingga menjadi diri saya saat ini dalam karir saya</p>
            </blockquote>
            <p style="margin-top: 20px;" class="testimonials-name">Renny Mallon, S.Kom</p>
            <span class="testimonials-job">Maintenance Renewal Business Operations Specialist of IIG, United States of America</span>            
          </div>
          <div class="item">
            <blockquote>
              <p>Intisari/Core pelajaran yang didapat dari STIKI adalah membentuk prilaku yang terstruktur, sistematis, logis serta komprehensif yang berguna dalam kehidupan baik dalam taraf pemikiran, ucapan serta tindakan dan sekaligus bisa diimplementasikan di segala bidang industri dan fungsi pekerjaan</p>
            </blockquote>
            <p style="margin-top: 20px;" class="testimonials-name">Dadang Beny Kurniawan, S.Kom, MM</p>
            <span class="testimonials-job">South Asia Pasific Technical IS Manager, Subsidiary of Ferro Corporation</span>            
          </div>          
        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#testimonials-block" data-slide-to="0" class="active"></li>
          <li data-target="#testimonials-block" data-slide-to="1"></li>
          <li data-target="#testimonials-block" data-slide-to="2"></li>
          <li data-target="#testimonials-block" data-slide-to="3"></li>
        </ol>
      </div>
    </div>
  </div>
  <!-- Testimonials block END -->
  <!-- Partners block BEGIN -->
  <div class="partners-block">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/1.png" alt="CATHOLIC UNIVERSITY OF DAEGU">
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/2.png" alt="WUXI INSTITUTE OF TECHNOLOGY">
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/3.png" alt="WOOSUK UNIVERSITY">
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/4.png" alt="KANGWON NATIONAL UNIVERSITY">
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/5.png" alt="KYUNG HEE UNIVERSITY">
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <img src="<?php echo base_url(); ?>assets/frontend/onepage/img/partners/6.png" alt="DONGGUK UNIVERSITY">
        </div>
      </div>
    </div>
  </div>
  <!-- Partners block END -->
  <!-- BEGIN PRE-FOOTER -->
  <div class="pre-footer" id="kontak">
    <div class="container">
      <div class="row">
        <!-- BEGIN BOTTOM ABOUT BLOCK -->
        <div class="col-md-4 col-sm-6 pre-footer-col">
          <h2>Peta</h2>
          <div class="col-md-4 col-sm-6 pre-footer-col">
          <iframe src="https://mapsengine.google.com/map/u/1/embed?mid=z9oBGik1qZiQ.kOAh1xF6MT2A" height="225"></iframe>
          </div>          
        </div>
        <!-- END BOTTOM ABOUT BLOCK -->
        <!-- BEGIN TWITTER BLOCK --> 
        <div class="col-md-4 col-sm-6 pre-footer-col">
          <h2 class="margin-bottom-0">Latest Tweets</h2>
          <a class="twitter-timeline" href="https://twitter.com/STIKIMalang" data-tweet-limit="2" data-theme="dark" data-link-color="#57C8EB" data-widget-id="590405069188636672" data-chrome="noheader nofooter noscrollbar noborders transparent">Loading tweets by @STIKIMalang...</a>      
        </div>
        <!-- END TWITTER BLOCK -->
        <div class="col-md-4 col-sm-6 pre-footer-col">
          <!-- BEGIN BOTTOM CONTACTS -->
          <h2>Kontak</h2>
          <address class="margin-bottom-20">
            Sekolah Tinggi Informatika dan Komputer Indonesia (STIKI)<br>
            Jl. Tidar Raya 100 Malang - Jawa Timur            
            0341-560823 fax :0341-562525 
            Email: <a href="mailto:stiki@stiki.ac.id">stiki@stiki.ac.id</a><br>            
          </address>
          <!-- END BOTTOM CONTACTS -->
          
        </div>
      </div>
    </div>
  </div>
  <!-- END PRE-FOOTER -->
  <!-- BEGIN FOOTER -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <!-- BEGIN COPYRIGHT -->
        <div class="col-md-6 col-sm-6">
          <div class="copyright">2015 &copy; sisfo.stiki.ac.id. ALL Rights Reserved.</div>
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN SOCIAL ICONS -->
        <div class="col-md-6 col-sm-6 pull-right">
          <ul class="social-icons">            
            <li><a class="facebook" data-original-title="facebook" target="_blank" href="https://www.facebook.com/stiki.malang"></a></li>
            <li><a class="twitter" data-original-title="twitter" target="_blank" href="http://twitter.com/STIKIMalang"></a></li>            
          </ul>
        </div>
        <!-- END SOCIAL ICONS -->
      </div>
    </div>
  </div>
  <!-- END FOOTER -->
  <a href="#promo-block" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>
  <!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
  <![endif]-->
  <!-- Load JavaScripts at the bottom, because it will reduce page load time -->
  <!-- Core plugins BEGIN (For ALL pages) -->
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- Core plugins END (For ALL pages) -->
  <!-- BEGIN RevolutionSlider -->
  <script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/onepage/scripts/revo-ini.js" type="text/javascript"></script> 
  <!-- END RevolutionSlider -->
  <!-- Core plugins BEGIN (required only for current page) -->
  <script src="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.easing.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.parallax.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.scrollTo.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/onepage/scripts/jquery.nav.js"></script>  
  <!-- Core plugins END (required only for current page) -->
  <!-- Global js BEGIN -->
  <script src="<?php echo base_url(); ?>assets/frontend/onepage/scripts/layout.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>assets/admin/pages/scripts/ui-blockui.js"></script>
  <script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>assets/additional/select2/select2.min.js"></script>
  
  <script>
    $(document).ready(function() {
        $('body').addClass("menu-always-on-top");		
		Layout.init();              
		$("#form_sma").select2();
        $(".select2.select2-container").css({'width':'100%','text-align':'left'});        
        $('#pesan').hide();
        
          
        var heights = $("#rowjalur .pricing-item").map(function() {
            return $(this).height();
        }).get(),
        maxHeight = Math.max.apply(null, heights);    
        
        $("#rowjalur .pricing-item").height(maxHeight);
                          
        $("[data-hide]").on("click", function(){
            $(this).closest("." + $(this).attr("data-hide")).hide();
        });
        captcharesize();
        getLocation();
        
        $(".fancybox").fancybox({
            helpers : {
                title: {
                    type: 'inside',
                    position: 'bottom'
                }
            },
            nextEffect: 'fade',
            prevEffect: 'fade'
        });
        
    }); 
/* begin EVENTS */
    // numeric only
    $('#form_nohp').keyup(function () {
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
           this.value = this.value.replace(/[^0-9\.]/g, '');
        }
    }); 
    
    $('#form_email').on('blur',function(){        
        $('#form_email').addClass('spinner');        

        var email       = $('#form_email').val();        
        $.ajax({
                type : "POST",
                url  : "<?php echo base_url(); ?>index.php/home/cekemail",
                data : "email=" + email,
                dataType: 'json',
                success : function(data){
                    if (data=='ya'){
                        showalert('Email yang anda masukkan sudah terdaftar.Silahkan menggunakan email yang lain');
                        $('#form_email').val('');
                        $('#form_email').focus();
                    }
                }
        });
        
        $('#form_email').removeClass('spinner');                  
    });                      
               
      
      $('#btnregreset').on('click',function(){
        kosongkanregister();
        $('#form_nama').focus();
      });
      
      $('#cmdReset').on('click',function(){        
        kosongkanlogin();
        $('#frmlogin_email').focus();                
      });
      
      $('#btncaptcharefresh').on('click',function(){
            Metronic.blockUI({ boxed: true });
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/home/refresh_captcha',
                success: function(html) {
                    $('#imgcaptcha img').remove();
                    $('#imgcaptcha').append(html); 
                    captcharesize();
                    $('#form_captcha').val('');
                    $('#form_captcha').focus();                                    
                }
            });
            Metronic.unblockUI();
      });
	
      function captcharesize(){
            $('#imgcaptcha img').removeAttr('style');
            $('#imgcaptcha img').removeAttr('width');
            $('#imgcaptcha img').removeAttr('height');            
            $('#imgcaptcha img').addClass('img-responsive');
            $('#imgcaptcha img').css('width','100%');
            $('#imgcaptcha img').css('height','34px');
      }    
      
      $('#btndaftar').on('click',function(){        
        if (cekformregister() == false) return false;
            Metronic.blockUI({ boxed: true });
                       
            var nama        = $('#form_nama').val();            
            var kode_prop   = $('#form_provLahir').val();
            var kode_kota   = $('#form_kotaLahir').val();
            var kode_smu    = $('#form_sma').val();
            var email       = $('#form_email').val();
            var nohp        = $('#form_nohp').val();
            var captcha     = $('#form_captcha').val();
            
            var form_sma_lain = $("#form_sma_lain").val();
            var form_alamat_sma_lain = $("#form_alamat_sma_lain").val();
            var form_telp_sma_lain = $("#form_telp_sma_lain").val();
            var form_email_sma_lain = $("#form_email_sma_lain").val();
            var form_web_sma_lain = $("#form_web_sma_lain").val();             
            
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url(); ?>index.php/home/register",
                data : "nama=" + nama + "&kode_prop=" + kode_prop + "&kode_kota=" + kode_kota + "&kode_smu=" + kode_smu + "&email=" + email + "&nohp=" + nohp + "&captcha=" + captcha
                + '&form_sma_lain=' + form_sma_lain + '&form_alamat_sma_lain=' + form_alamat_sma_lain + '&form_telp_sma_lain=' + form_telp_sma_lain
                + '&form_email_sma_lain=' + form_email_sma_lain + '&form_web_sma_lain=' + form_web_sma_lain,
                success : function(data){                    
                    switch(data){
                        case 'sukses':
                            showalert('Data telah tersimpan, UserID dan Password telah dikirim via email dan sms');
                            kosongkanregister();
                            Metronic.unblockUI();
                            break;
                        case 'gagal' :                            
                            showalert('Data gagal disimpan, Silahkan anda mengulangi lagi.');                            
                            $('#form_nama').focus();
                            $.ajax({
                                url: '<?php echo base_url(); ?>index.php/home/refresh_captcha',
                                success: function(html) {
                                    $('#captcha img').remove();
                                    $('#captcha').append(html);                                    
                                }
                            });
                            Metronic.unblockUI(); 
                            break;
                        case 'sudah ada' :                            
                            showalert('Email yang anda masukkan sudah terdaftar.Silahkan menggunakan email yang lain');
                            $('#form_email').focus();
                            $.ajax({
                                url: '<?php echo base_url(); ?>index.php/home/refresh_captcha',
                                success: function(html) {
                                    $('#captcha img').remove();
                                    $('#captcha').append(html);                                    
                                }
                            }); 
                            Metronic.unblockUI();
                            break;
                    }                    
                    }
                });
         });
                
       
/* end EVENTS */

/* begin FUNCTION */

    function showalert(message) {  
          $('#pesan').hide();
          $('#pesan span').text(message);
          $('#pesan').toggle("fast");
            /*
                .removeClass('alert-warning')
                .addClass('alert-info')                
                .unbind();
            */                      
    }
               
    function cekformregister(){  
        if($('#form_nama').val().length <= 2 ) { showalert('Nama belum terisi dan minimal 2 karakter.'); return false; }        
        if($("#form_provLahir option:selected").index() == 0) { showalert('Propinsi belum dipilih.'); return false;}
        if($("#form_kotaLahir option:selected").index() == 0) { showalert('Kota lahir belum dipilih.'); return false;}
        if($("#form_sma option:selected").index() == 0) { showalert('SMA belum dipilih.'); return false;}
        if(!validEmail($('#form_email').val()) || $('#form_email').val().length <= 2) { showalert('Email belum terisi atau format email salah (minimal 2 karakter)'); return false; }
        if($('#form_nohp').val().length <= 2 ) { showalert('Nomer HP belum terisi'); return false; }        
        if($('#form_captcha').val().length <= 2 ) { 
            showalert('Captcha belum terisi atau salah');            
            $('#form_captcha').val('');                                       
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/home/refresh_captcha',
                success: function(html) {
                    $('#captcha img').remove();
                    $('#captcha').append(html);                                    
                }
            });  
            return false; 
            }
        return true;
    }
      
    function validEmail(v) {
        var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        return (v.match(r) == null) ? false : true;
    }
    
    function kosongkanlogin(){
        Metronic.blockUI({
                boxed: true
            });
        $('#frmlogin_email').val('');
        $('#frmlogin_pwd').val('');
        Metronic.unblockUI();
    }
    
    function kosongkanregister(){
        Metronic.blockUI({
                boxed: true
            });
        $('#form_nama').val('');
        $('#form_provLahir').val('');
        $('#form_kotaLahir')
            .find('option')
            .remove()
            .end()
            .append('<option value="">-PILIH KOTA-</option>');
        $('#form_sma')
            .find('option')
            .remove()
            .end()
            .append('<option value="">-PILIH SMA-</option>');
        $('#form_email').val('');
        $('#form_nohp').val('');
        $('#form_captcha').val('');                            
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/home/refresh_captcha',
            success: function(html) {
                $('#captcha img').remove();
                $('#captcha').append(html);                                    
            }
        }); 
        Metronic.unblockUI();       
    }
      
    function getKotaByProvinsi(src,target,setVal){
          Metronic.blockUI({
                boxed: true
            });
            
          var prov=$("#"+src).val();
          var string="prov="+prov;
          
          $.ajax({
  			type	: 'POST',
  			url		: "<?php echo base_url(); ?>index.php/home/getKotaByProvinsi",
  			data	: string,
  			cache	: false,
              dataType: 'json',
  			success	: function(data){
  				document.getElementById(target).innerHTML=data.opt;
                  $("#"+target).val(setVal);
  			},
  			error : function(xhr, teksStatus, kesalahan) {
  				toastr['error']("Tidak dapat mengambil daftar kota", "STIKI - PMB Online")
  				return false;
  			}
          });
          Metronic.unblockUI();  
        }
        
     $("#form_sma").change(function(){
        if($("#form_sma").val()=="{0}"){
            $("#form-group-form_sma_lain").show(400);
            $("#form-group-form_alamat_sma_lain").show(400);
            $("#form-group-form_telp_sma_lain").show(400);
            $("#form-group-form_email_sma_lain").show(400);
            $("#form-group-form_web_sma_lain").show(400);
        }else{
            $("#form-group-form_sma_lain").hide(400);
            $("#form-group-form_sma_lain").hide(400);
            $("#form-group-form_alamat_sma_lain").hide(400);
            $("#form-group-form_telp_sma_lain").hide(400);
            $("#form-group-form_email_sma_lain").hide(400);
            $("#form-group-form_web_sma_lain").hide(400);
        }
     })
     function getSmaByKota(src,target,setVal){
          Metronic.blockUI({
                boxed: true
            });
          var sma=$("#"+src).val();
          var string="sma="+sma;
          
          $.ajax({
  			type	: 'POST',
  			url		: "<?php echo base_url(); ?>index.php/home/getSmaByKota",
  			data	: string,
  			cache	: false,
              dataType: 'json',
  			success	: function(data){
  				document.getElementById(target).innerHTML=data.opt;
                $("#"+target).val(setVal);
                $("#form_sma").select2();
                $(".select2.select2-container").css('width','100%');
  			},
  			error : function(xhr, teksStatus, kesalahan) {
  				toastr['error']("Tidak dapat mengambil daftar Sma", "STIKI - PMB Online")
  				return false;
  			}
          }); 
          Metronic.unblockUI();  
        }
        //var x = document.getElementById("demo");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position){
                        sendLoc(true,position);
                    },
                    function (error){
                        sendLoc(false,'');    
                    }
                );
            } 
        }
        function sendLoc(isOK,position){
            if(isOK){
                $.post( "<?php echo base_url()?>index.php/home/visitorTracking", { isok:1, geo_lat: position.coords.latitude, geo_long: position.coords.longitude })
                  .done(function( data ) {
                    //alert( "Data Loaded: " + data );
                });    
            }else{
                $.post( "<?php echo base_url()?>index.php/home/visitorTracking", { isok:0, geo_lat: '', geo_long: '' })
                  .done(function( data ) {
                    //alert( "Data Loaded: " + data );
                });
            }       
        }
        
/* end   FUNCTION */  
 
  </script>
<!--  <script type="text/javascript" src="/livechat/php/app.php?widget-init.js"></script> -->
  <!-- Global js END -->
</body>
</html>