<html>
<head>
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

</head>
<body style="background: transparent;">
<?php echo form_open_multipart('mahasiswa/saveFile');?>
<input type="file" name="userfile" id="upload_file" "size="20" />
<button type="submit" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-upload'">UPLOAD</button>
<form>
</body>
</html>