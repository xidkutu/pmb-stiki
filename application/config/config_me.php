<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Instansi
|--------------------------------------------------------------------------
*/
$config['nama_instansi'] = 'STIKI Malang';
$config['usaha'] = 'Edukasi';
$config['alamat_instansi'] = 'Jl. Raya Tidar 100 Malang';

/*
|--------------------------------------------------------------------------
| Developer Info
|--------------------------------------------------------------------------
*/
$config['developer_name'] = 'SisFo Team';
$config['development_year'] = '2015';

/*
|--------------------------------------------------------------------------
| Sistem Info
|--------------------------------------------------------------------------
*/
$config['application_id']='PMB';
$config['nama_program'] = 'PMB';
$config['desc_program'] = 'Penerimaan Mahasiswa Baru';

/*
|--------------------------------------------------------------------------
| File Server
|--------------------------------------------------------------------------
*/
$config['ftp_host']='114.4.32.180';
$config['ftp_username']='files';
$config['ftp_password']='45B968e9ef634a0eb66fef4b5@)!^';
$config['ftp_domain']='http://files.stiki.ac.id';
$config['ftp_loc_img']='/public_html/repository/Images/profile_picture/camaba/';
$config['ftp_loc_doc']='/public_html/repository/pmb/';
$config['ftp_dir_img']='/repository/Images/profile_picture/camaba/';
$config['ftp_dir_doc']='/repository/pmb/';

//Local temporary file location
$config['file_loc_img']=$_SERVER['DOCUMENT_ROOT'].'/assets/documents/images/';
$config['file_loc_doc']=$_SERVER['DOCUMENT_ROOT'].'/assets/documents/documents/';

//Default picture if picture is null or not exist
$config['no_picure']='http://files.stiki.ac.id/repository/Images/profile_picture/not_available.jpg';
$config['no_picure_local']="http://".$_SERVER['HTTP_HOST']."/assets/documents/images/no-profile-pic.jpg";

/*
|--------------------------------------------------------------------------
| Email
|--------------------------------------------------------------------------
*/
$config['email_protocol']='smtp';
$config['email_smtp_host']='ssl://smtp.gmail.com';
$config['email_smtp_user']='noreply@stiki.ac.id';
$config['email_smtp_pass']='stiki@)!$';
$config['email_smtp_port']=465;
$config['email_mailtype']='html';
$config['email_charset']='utf-8';
$config['email_newline']="\r\n";

/*
|--------------------------------------------------------------------------
| SMS Gateway
|--------------------------------------------------------------------------
*/
$config['sms']['provider']='zenziva';
$config['sms']['kalkun']['base_url'] = "http://114.4.32.178/smsgateway/index.php/";
$config['sms']['kalkun']['session_file'] = "assets/tmp/cookies.txt";
$config['sms']['kalkun']['username'] = "mimin";
$config['sms']['kalkun']['password'] = "k4lk0n@)!^";

$config['sms']['zenziva']['base_url'] = "http://sms.wisanggeni.stiki.ac.id/index.php/";
$config['sms']['zenziva']['private_key'] = "34AS37dAax";


$config['prg'] = 'SISFO';
$config['web_prg'] = '';
$config['limit_data']=15;
?>