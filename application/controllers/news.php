<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends MY_Controller {

	/**
	 * @author : Adrian
	 * @web : 
	 * @keterangan : Controller untuk asal informasi
	 **/
	
	public function index()
	{
		$this->mydata['data']=$this->system_model->getNews();
        $this->mydata['content']=$this->load->view('application/news/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function read($id){
        $this->session->set_flashdata('news_id',$id);
        $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
    }
    
    public function loadPage(){
        $id=$this->session->flashdata('news_id');
        $this->mydata['data']=$this->system_model->getReadNews($id);
        echo $this->load->view('application/news/read',$this->mydata,true);
        
    }
    
    public function simpan()
	{
        $p=$this->input->post();
        echo $this->system_model->saveChangedConfig($p['name'],$p['value']);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
