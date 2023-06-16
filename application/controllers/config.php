<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class config extends MY_Controller {

	/**
	 * @author : Adrian
	 * @web : 
	 * @keterangan : Controller untuk asal informasi
	 **/
	
	public function index()
	{
		$this->app_model->prepareConfigProdi();
        $this->mydata['data']=$this->system_model->getEditableConfig();
        $this->mydata['content']=$this->load->view('application/config/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function simpan()
	{
        $p=$this->input->post();
        echo $this->system_model->saveChangedConfig($p['name'],$p['value']);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
