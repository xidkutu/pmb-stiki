<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Reporting extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
    function  __construct() {
        parent::__construct();
        $this->load->model('rep_model');
        $this->mydata['modal_mhs']=$this->load->view('lp/statistik/global/modal_mhs',$this->mydata,true);
    }
}