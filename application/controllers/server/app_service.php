<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Service extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 **/

    public function getNumUnReadNotification()
	{
	   	$res=$this->system_model->getUnreadNotification();
        echo $res->num_rows();
	}
	public function getUnReadNotification()
	{
	   	$d['notif']=$this->system_model->getUnreadNotification();
        $notif=$this->load->view('application/service/notification',$d,true);
        echo $notif;
	}
    public function markAsReadNotif(){
        $id=$this->input->post('id');
        echo $this->system_model->markNotifAsRead($id);
    }
    public function markAllAsReadNotif(){
        $id=$this->session->userdata('username');
        echo $this->system_model->markAllNotifAsRead($id);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */
