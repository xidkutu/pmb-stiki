<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Halaman <?php echo $this->session->userdata('roleName');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow">
<meta http-equiv="Copyright" content="zamroni">
<meta name="author" content="zamroni">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/layout.css">
<link href="<?php echo base_url();?>asset/css/fonts/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/cupertino/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css">

<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>asset/js/clock.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/app.js" ></script>
<link rel="icon" href="<?php echo base_url();?>asset/images/favicon.ico" type="image/x-icon">

<!--datepicker-->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker.js"></script>

<!--Polling-->
<script type="text/javascript" src="<?php echo base_url();?>asset/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/exporting.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>asset/js/swfobject.js"></script>
<!-- notifikasi -->
<!-- <script type="text/javascript" src="<?php echo base_url();?>asset/js/notifikasi.js"></script> -->

<script type="text/javascript">
$(function() {
	$("#dataTable tr:even").addClass("stripe1");
	$("#dataTable tr:odd").addClass("stripe2");
	$("#dataTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>

</head>
<body onLoad="goforit()">
<div class="header" style="height:70px;background:white;padding:2px;margin:0;">	
		<div style="float:left; padding:0px; margin:0px;">
        <img src='<?php echo base_url();?>asset/images/simaru.jpg' style="padding:0; margin:0;" width="360" height="68">
        </div>        		
	</div>			
    
    <!-- awal menu atas -->
    <div class="panel-header" fit="true" style="height:21px;padding-top:1px;padding-right:20px">
        <div>
        <?php
    	echo $this->session->userdata('strHTMLMenu');
    	?>
        </div>
    </div>
    <!-- akhir menu atas -->    
           
    <div id="tt" class="easyui-tabs" style="height:500px;">
        <div title="<?php echo $judul;?>" style="padding:10px">
		<?php echo $content;?>	
        </div>
    </div>	
			

<div class="panel-header" fit="true" style="height:20px;text-align:center;">	    
Copyright &copy; <?php echo $instansi;?> 2014 by SIMARU
</div>
</body>
</html>
