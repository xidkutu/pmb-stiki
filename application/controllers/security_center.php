<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class security_center extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
    
    public function deniedMessage(){
        $d['isContaintError']="YES";
        $d['sec_error_msg']="Access denied !";
        echo json_encode($d);
    }
}