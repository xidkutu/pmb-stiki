<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>STIKI PMB Online | Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="STIKI PMB Online" name="description">
<meta content="STIKI PMB Online" name="keywords">
<meta content="puskom" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url()?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/layout/css/helper.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<!-- BEGIN BOOTBOX PLUGIN -->
<!-- <script src="<?php echo base_url()?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script> -->
<!-- END BOOTBOX PLUGIN -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="<?php echo base_url()?>/assets/admin/layout4/img/login_stiki.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url()?>index.php/login" method="post">
		<h3 class="form-title">Sign In</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
        <?php 
			$pesan = $this->session->flashdata('result_login'); 
			if($pesan) echo '<div class="alert alert-danger"><button class="close" data-close="alert"></button><span>'.$pesan.'</span></div>';
		?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Masukkan Email atau username anda</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Masukkan email atau username anda" name="username" id="username"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
		</div>
		<div class="form-actions">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <button type="submit" class="btn btn-success uppercase" style="width: 100%;">Login</button>
                </div>
                <div class="col-md-12 col-lg-6">
                    <a href="javascript:;" id="forget-password" class="btn btn-success uppercase pull-right" style="width: 100%;">Lupa Password?</a>
                </div>
            </div>
		</div>	
        <input type="hidden" name="fingerprint"/>
        <input type="hidden" name="browser"/>
        <input type="hidden" name="appVersion"/>
        <input type="hidden" name="wtoken" value="<?php echo $this->session->userdata('wtoken');?>"/>	
        <div class="create-account">
			<p>
				<a href="<?php echo base_url()?>" class="uppercase">Back to Home</a>
			</p>
		</div>		
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
    <div id="panel_forgot">
	<form class="forget-form" action="#" id="contact" method="post">
		<h3>Lupa Password ?</h3>
		<div id="pesan" class="mb15 mt15">
        <p class="text-muted">Masukkan Email dan captcha dibawah ini, kode verifikasi akan dikirim ke HP anda. Pastikan email sesuai dengan email sewaktu anda mendaftar</p>
        </div>
		<div class="form-group">
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Masukkan Email Anda" name="email_forgot" id="email_forgot"  />
		</div>
        <div class="form-group"> 
            <div class="row">           
                <div class="col-md-8 pr5" id="imgcaptcha" ><?php echo $captcha['image']; ?></div>
                <div class="col-md-4 pl5 text-right">
                <button type="button" class="btn btn-info" id="btncaptcharefresh" style="width: 100%;height: 43px;">Refresh</button>
                </div> 
            </div>
        </div>
        <div class="form-group">
            <input class="form-control placeholder-no-fix mt15" type="text" autocomplete="off" placeholder="Masukkan Captcha" name="form_captcha" id="form_captcha" />
        
        </div>
        <div id="bootstrap_alerts_demo"></div>
		<div class="form-actions">
			<button type="button" class="btn btn-success uppercase" id="btnreset_password">Reset Password</button>
		</div>
        <div class="create-account">
			<p>
				<a href="#" id="back-btn" class="uppercase">Back to Login</a>
			</p>
		</div>
	</form>
    </div>
	<!-- END FORGOT PASSWORD FORM -->
    
    <!-- BEGIN FORM VERIFIKASI -->
    <div class="panel panel-info mv10 heading-border br-n" id="panel_kodesms" style="display:none; cursor: default">
        <form method="post" action="/" id="frmkodesms">
            <div class="panel-body bg-white p15 pt25">
                <div class="panel-footer p25 pv15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section mn">
                                <label for="email" id="lblverifikasikodesms" class="field-label text-muted fs18 mb10">Masukkan kode verifikasi yang telah dikirim SMS ke HP anda</label>
                                <div class="smart-widget sm-right smr-80">
                                    <label for="email" class="field prepend-icon">
                                        <input type="text" name="verifikasikodesms" id="verifikasikodesms" class="gui-input" placeholder="Masukkan kode verikasi">
                                        <label for="verifikasikodesms" class="field-icon">
                                        </label>
                                    </label>                                        
                                </div>
                            </div>
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="panel-footer clearfix p10 ph15">                            
                			<button type="button" class="btn btn-primary btn-gradient dark mr10" id="btnverifikasikodesms">OK</button>                                								
                            <button type="button" class="btn btn-success btn-gradient dark mr10" id="btncancelverifikasisms">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>                        
   </div>
    <!-- END   FORM VERIFIKASI -->
	
</div>
<div class="copyright">
	 2015 &copy; <?php echo $this->config->item('nama_instansi').'. '.$this->config->item('developer_name').'.';?>
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url()?>/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url()?>/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN JS TAMBAHAN -->
<script type="text/javascript" src="<?php echo base_url()?>assets/additional/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url()?>assets/additional/fingerprint/fingerprint.js" type="text/javascript"></script>
<!-- END   JS TAMBAHAN -->

<script>
var b='<?php echo base_url();?>',
    m='<?php echo $m;?>',
    s='<?php echo $s;?>';
jQuery(document).ready(function() {     
    var fingerprint = new Fingerprint({screen_resolution: true}).get();
    $("input[name='fingerprint']").val(fingerprint);
    $("input[name='browser']").val(JSON.stringify($.browser));
    $("input[name='appVersion']").val(navigator['appVersion']);
    $.ajax({
    	url:"<?php echo $ws;?>",
    	dataType: 'jsonp', 
    	success:function(json){ 
    	   <?php if($ms=='YES'){ ?>
    	       if (!json.wtoken && !$('[name="wtoken"]').val())
				{
				    $.post('<?php echo base_url()?>index.php/login/isPv',function(data){
                        if(data)window.location = m+'/'+s+'#'+b+'index.php/login/receiver';
                    }) 
				}
    	   <?php }?>
    	   if (json.wtoken) $('[name="wtoken"]').val(json.wtoken); 
        },
    	error:function(){console.log("Error");}      
    });
    
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Login.init();
    Demo.init();
    
    captcharesize();

    $('#btnforgetsubmit').click(function(){
       $.ajax({
  			type	: 'POST',
  			url		: "<?php echo base_url(); ?>home/forgotpassword",
  			data	: { email : $('#forgot_email').val() },
  			cache	: false,
            dataType: 'json',
  			success	: function(data){
                Metronic.alert({
                    container: '#bootstrap_alerts_demo', // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'append', // append or prepent in container 
                    type: 'success',  // alert's type
                    message: data,  // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: true, // auto scroll to the alert after shown
                    closeInSeconds: 0, // auto close after defined seconds
                    icon: '' // put icon before the message
                });                
  			},
  			error: function(jq,status,message) {
                alert('Terdapat kesalahan dalam proses penyimpanan, Status: ' + status + ' - Message: ' + message);
            }
          }); 
    });
    
    $('#btncaptcharefresh').click(function(){
        refreshcaptcha();
    });
    
});

    $('#btncancelverifikasisms').click(function(){
        clearformforgotpassword();
        $.unblockUI();        
    });
    
    $('#btncaptcharefresh').click(function(){
        refreshcaptcha();
    });
    
    function refreshcaptcha(){
        $.blockUI();
        $.ajax({
            url: '<?php echo base_url(); ?>login/refresh_captcha',
            success: function(html) {
                $('#imgcaptcha img').remove();
                $('#imgcaptcha').append(html);  
                captcharesize();
                $('#form_captcha').val('');
                $('#form_captcha').focus();                                                  
            }
        });
        $.unblockUI(); 
    }
    
    function captcharesize(){
        $('#imgcaptcha img').removeAttr('style');
        $('#imgcaptcha img').removeAttr('width');
        $('#imgcaptcha img').removeAttr('height');            
        $('#imgcaptcha img').addClass('img-responsive');
        $('#imgcaptcha img').css('width','100%');
        $('#imgcaptcha img').css('height','40px');
    }
    
    function clearformforgotpassword(){
       refreshcaptcha();
       $('#verifikasikodesms').val('');
       $('#email_forgot').val('');
       $('#form_captcha').val('');        
    }
    
    
    $('#btnreset_password').click(function(){   
       console.log('email='+$('#email_forgot').val());
       console.log('captcha='+$('#form_captcha').val()); 
       $.blockUI();
         $.ajax({
  			type	: 'POST',
  			url		: "<?php echo base_url(); ?>login/forgotpassword",
  			data	: { email : $('#email_forgot').val(),captcha : $('#form_captcha').val() },
  			cache	: false,
            dataType: 'json',
  			success	: function(data){
                $.unblockUI();
                console.log('res_cap = '+data.res_cap);
                if (data.res_cap == 'not ok'){ 
                    $('#contact').find('.alert-warning').addClass('alert-info');
                    $('#contact').find('.alert-info').removeClass('alert-warning');       
                    $('#pesan').text('Captcha yang anda masukkan salah.');
                    refreshcaptcha();
                }else{
                    if (data.res_log == 'ok' && data.res_sms == 'ok') {
                        $.blockUI({ message: $('#panel_kodesms') });
                    }else{
                        $('#contact').find('.alert').removeClass('alert-info');
                        $('#contact').find('.alert').addClass('alert-warning');                                  
                        $('#pesan').text('Terdapat kesalahan dalam proses penyimpanan');
                        $('#email_forgot').val('');
                        $.unblockUI();
                    }
                }
  			},
  			error: function(jq,status,message) {
                $('#contact').find('.alert').removeClass('alert-info');
                $('#contact').find('.alert').addClass('alert-warning');                                  
                $('#pesan').text('Terdapat kesalahan dalam proses penyimpanan');
                $('#email_forgot').val('');
                $.unblockUI();
            }
          });                     
          
          
    });
    
    $('#btnverifikasikodesms').click(function(e) {
        e.preventDefault();
        var verifikasi = $('#verifikasikodesms').val();
        var email_forgot = $('#email_forgot').val(); 
        console.log('verifikasi='+verifikasi);
        console.log('email_forgot='+email_forgot);  
             
        
        $.ajax({url: '<?php echo base_url(); ?>login/cekverifikasi',
            data:  {email_forgot:email_forgot,verifikasi:verifikasi },
            type: 'POST',                               
            dataType: 'json',
            beforeSend: function() {                 
                console.log('before cekverifikasi');                 
            },
            complete: function(data) {
                
                console.log('complete cekverifikasi');                
                /*
                
                //$('#frmkodesms').unblock();
                */
            },
            fail: function(data) {
                console.log('verifikasi tidak sama');
            },
            success: function (data) {//it successful place returned HTML from PHP script in DIV
                //$('#verifikasipesan').html(data);
                //$('#panel_kodesms').find('.alert-info #verifikasipesan').html('<i class="fa fa-question pr10"></i>'.data);
                console.log('success : '+data);
                
                if (data=='ok'){
                    $('#lblverifikasikodesms').text('Sedang Proses, harap ditunggu');
                    $.ajax({url: '<?php echo base_url(); ?>login/verifikasi_krm_email',
                        data:  {email_forgot:email_forgot,verifikasi:verifikasi },
                        type: 'post',                                                                   
                        dataType: 'json',
                        success: function(data) {
                            if (data=='ok'){
                               $.unblockUI();
                               $('#contact').find('.alert-warning').removeClass('alert-info');
                               $('#contact').find('.alert-info').removeClass('alert-warning');
                               $('#contact').find('.alert').addClass('alert-warning');        
                               $('#pesan').text('Password Reset telah dikirim ke Email anda, Silahkan cek Inbox Email anda.');
                                                              
                            }else{
                               $('#lblverifikasikodesms').text('Verifikasi gagal, pastikan kode yang anda masukkan sudah valid!');
                               $('#verifikasikodesms').val(''); 
                            }
                            clearformforgotpassword();
                            console.log('verifikasi_krm_email='+data);
                        }
                    });
                }else{                     
                    console.log('verifikasi_krm_email='+data);                    
                    $('#lblverifikasikodesms').text('Verifikasi gagal, pastikan kode yang anda masukkan sudah valid!');
                    $('#verifikasikodesms').val('');                    
                } 
                                
            }
        });
        
    });
    
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>