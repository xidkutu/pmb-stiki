<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $nama_program; ?></title>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style_login.css" type="text/css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/demo.css">
<link rel="icon" href="<?php echo base_url();?>asset/images/favicon.ico" type="image/x-icon">

<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
<style type="text/css">
button {margin: 0; padding: 0;}
button {margin: 2px; position: relative; padding: 4px 4px 4px 2px; 
cursor: pointer; float: left;  list-style: none;}
button span.ui-icon {float: left; margin: 0 4px;}
</style>
</head>
<body>
<div style="width:100%">  
    <div style="display: table;margin:0 auto;">
    <img src='<?php echo base_url();?>asset/images/simaru.jpg' style="padding:0; margin:0;" width="360" height="68">
    <div style="margin:20px 0;"></div>
<div class="easyui-panel" title="Login" style="width:450px;" >
    <div style="padding:10px 0 10px 60px">
        <?php echo form_open('login/index'); ?>
        <table>
        	<tr>
        		<td>Nama User:</td>
                <td>:</td>
        		<td><?php echo form_input($username,set_value('username')); ?></td>
        	</tr>
        	<tr>
        		<td>Password:</td>
                <td>:</td>
        		<td><?php echo form_input($password); ?></td>
        	</tr>	
            <tr>
                <td colspan="3">
                <?php echo validation_errors(); ?>
        	    <?php echo $this->session->flashdata('result_login'); ?>
                </td>
            </tr>    
            <tr>
                <td><?php echo form_button($submit,'Login');?></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="demo-info">	
	<div><p>Copyright &copy; <?php echo $instansi;?> 2014</p>
	<p>Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik</p></div>
</div>
</div>
</div>





</body>
</html>