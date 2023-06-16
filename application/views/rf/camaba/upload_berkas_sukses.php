<html>
<head>
<title></title>
</head>
<body>
<?php
    echo $nama_file;
    if($pesan=='success'){
        $alamat='asset/img/success.png';
        $msg='';
    }else{
        $alamat='asset/img/failed.png';
        $msg=$pesan;
    }
?>
<img src="<?php echo base_url().$alamat ?>" width="35px"/>
<?php
    echo $msg;
?>
</body>
</html>