<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.6.3
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
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $this->config->item('nama_program').' | '.$this->config->item('nama_instansi')?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo base_url()?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo base_url()?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link href="<?php echo base_url()?>assets/additional/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url()?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url()?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<!-- END CORE PLUGINS -->
<?php if(isset($cssInclude)) echo $cssInclude?>
<script src="<?php echo base_url()?>assets/additional/js/js.cookie.js"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url()?>dashboard">
			<img src="<?php echo base_url()?>assets/admin/layout4/img/home_stiki.png" alt="logo" class="logo-default" style="width: 190px;"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions -->
		
		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			<form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide">
					</li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-success" id="num_unread_notif">
						0 </span>
						</a>
						<ul class="dropdown-menu" id="drop_notif">
							
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						<?php echo $this->session->userdata('nama_lengkap')?> </span>
						<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
						<img alt="" id="img_pojok" class="img-circle" src="<?php echo $this->session->userdata('my_photo')?>"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="#">
								<i class="icon-badge"></i> <?php echo $this->session->userdata('roleName')?> </a>
							</li>
                            <li>
								<a href="#">
								<i class="icon-credit-card"></i> <?php echo $this->session->userdata('username')?> </a>
							</li>
                            <li class="divider">
							</li>
                            <li>
								<a href="<?php echo base_url()?>index.php/profile">
								<i class="icon-user"></i> My Profile </a>
							</li>
                            <li>
								<a href="<?php echo base_url()?>index.php/change_password">
								<i class="icon-key"></i> Ubah Password </a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="<?php echo base_url()?>index.php/login/logout">
								<i class="icon-logout"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<?php echo generateMenu($this->session->userdata('username'));?>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
    	<div class="page-content">
    		<!-- BEGIN PAGE HEAD -->
    		<div class="page-head">
    			<!-- BEGIN PAGE TITLE -->
    			<div class="page-title">
    				<h1><?php echo $page_info['Nama_Menu']?> <small><?php echo $page_info['Keterangan']?></small></h1>
    			</div>
    			<!-- END PAGE TITLE -->
    			<!-- BEGIN PAGE TOOLBAR -->
    			<div class="page-toolbar">
    				<!-- BEGIN THEME PANEL -->
    				<div class="btn-group btn-theme-panel">
    					<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
    					<i class="icon-settings"></i>
    					</a>
    					<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
    						<div class="row">
    							<div class="col-md-4 col-sm-4 col-xs-12">
    								<h3>THEME</h3>
    								<ul class="theme-colors">
    									<li class="theme-color theme-color-default" data-theme="default">
    										<span class="theme-color-view"></span>
    										<span class="theme-color-name">Dark Header</span>
    									</li>
    									<li class="theme-color theme-color-light active" data-theme="light">
    										<span class="theme-color-view"></span>
    										<span class="theme-color-name">Light Header</span>
    									</li>
    								</ul>
    							</div>
    							<div class="col-md-8 col-sm-8 col-xs-12 seperator">
    								<h3>LAYOUT</h3>
    								<ul class="theme-settings">
    									<li>
    										 Theme Style
    										<select class="layout-style-option form-control input-small input-sm">
    											<option value="square">Square corners</option>
    											<option value="rounded" selected="selected">Rounded corners</option>
    										</select>
    									</li>
    									<li>
    										 Layout
    										<select class="layout-option form-control input-small input-sm">
    											<option value="fluid" selected="selected">Fluid</option>
    											<option value="boxed">Boxed</option>
    										</select>
    									</li>
    									<li>
    										 Header
    										<select class="page-header-option form-control input-small input-sm">
    											<option value="fixed" selected="selected">Fixed</option>
    											<option value="default">Default</option>
    										</select>
    									</li>
    									<li>
    										 Top Dropdowns
    										<select class="page-header-top-dropdown-style-option form-control input-small input-sm">
    											<option value="light">Light</option>
    											<option value="dark" selected="selected">Dark</option>
    										</select>
    									</li>
    									<li>
    										 Sidebar Mode
    										<select class="sidebar-option form-control input-small input-sm">
    											<option value="fixed">Fixed</option>
    											<option value="default" selected="selected">Default</option>
    										</select>
    									</li>
    									<li>
    										 Sidebar Menu
    										<select class="sidebar-menu-option form-control input-small input-sm">
    											<option value="accordion" selected="selected">Accordion</option>
    											<option value="hover">Hover</option>
    										</select>
    									</li>
    									<li>
    										 Sidebar Position
    										<select class="sidebar-pos-option form-control input-small input-sm">
    											<option value="left" selected="selected">Left</option>
    											<option value="right">Right</option>
    										</select>
    									</li>
    									<li>
    										 Footer
    										<select class="page-footer-option form-control input-small input-sm">
    											<option value="fixed">Fixed</option>
    											<option value="default" selected="selected">Default</option>
    										</select>
    									</li>
    								</ul>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!-- END THEME PANEL -->
    			</div>
    			<!-- END PAGE TOOLBAR -->
    		</div>
    		<!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
    		<ul class="page-breadcrumb breadcrumb">
    			<?php echo $breadcrumb?>
    		</ul>
            <!-- END PAGE BREADCRUMB -->
            
            <?php $denied=$this->session->flashdata('sec_error_msg');
            if(!empty($denied)){?>
                  <div class="row">
                    <div class="note note-danger" style="margin: 0 35px 10px 15px;">
                        <h3>Denied Access !</h3>
                    	<p>Anda mencoba mengakses halaman yang terlarang. Sistem kami telah mencatat aktifitas ini.</p>
                    </div>
                </div>  
            <?php }
            ?>
    		
            <div id="page-content-inner">
            <?php echo $content?>
            </div>
            </div>
        </div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <?php echo $this->config->item('development_year')?> &copy; <?php echo $this->config->item('nama_instansi').' by '.$this->config->item('developer_name')?>.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<?php if(isset($jsInclude)) echo $jsInclude?>
<script type="text/javascript">
jQuery(document).ready(function() {
    setToggleRightMenu();
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    getNumUnreadNotif();
    getUnreadNotif();
    setInterval(function(){ getNumUnreadNotif(); }, <?php echo $notif_interval?>);
});
function setToggleRightMenu(){
    var classname="<?php echo $page_id?>";
    var currentClass=document.getElementById(classname).getAttribute('class');
    if(currentClass!=null)
    var newClass='active';else var newClass=currentClass+' active';
    document.getElementById(classname).setAttribute('class',newClass);
    
    if(currentClass=='has-parent'){
        if($("#"+classname).parent().parent().hasClass('has-parent')){
            $("#"+classname).parent().parent().get(0).setAttribute('class','has-child has-parent open');
            $("#"+classname).parent().get(0).setAttribute('style','display:block');
            $("#"+classname).parent().parent().parent().parent().get(0).setAttribute('class','has-child has-parent open');
            $("#"+classname).parent().parent().parent().get(0).setAttribute('style','display:block');
        }else{
            $("#"+classname).parent().parent().get(0).setAttribute('class','has-child open');
            $("#"+classname).parent().get(0).setAttribute('style','display:block');   
        }        
    }
}
function getNumUnreadNotif(){
    if (!($("#header_notification_bar").hasClass('open'))){
        $.post( "<?php echo base_url(); ?>index.php/server/app_service/getNumUnReadNotification", function( data ) {
            if(data.substr(0,8)=='{logout}'){
                window.location.reload();
            }else{
                if(parseInt($( "#num_unread_notif" ).html())!=parseInt(data)) getUnreadNotif();
                $( "#num_unread_notif" ).html( data );
            }
                
          
        });   
    }
}
function getUnreadNotif(){
   $.post( "<?php echo base_url(); ?>index.php/server/app_service/getUnReadNotification", function( data ) {
      $( "#drop_notif" ).html( data );
      Metronic.initSlimScroll('.scroller');
    }); 
}
$("#header_notification_bar").click(function(){
    getUnreadNotif();
})
$("#header_notification_bar").mouseover(function(){
    if (!($("#header_notification_bar").hasClass('open'))) {
        getUnreadNotif();
    }
})
</script>
<script src="<?php echo base_url()?>assets/additional/js/adrian_library.js"></script>
</body>
<!-- END BODY -->
</html>