<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Message extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : http://empugandring.com
	 * @keterangan : Controller untuk halaman awal ketika aplikasi koperasi diakses
	 **/
	 
	public function getUnReadMessage()
	{
	   	$res=$this->message_model->dbGetUnReadMessage();
        
        $d['num_unread_msg']=$res->num_rows();
        $str='';
        foreach($res->result_array() as $r){
            $str.='<li>
				<a href="inbox.html?a=view">
				<span class="photo">
				<img src="http://'.$r['photo'].'" alt=""/>
				</span>
				<span class="subject">
				<span class="from">'.$r['Sender_Name'].'</span>
				<span class="time">'.$r['Sending_Time'].'</span>
				</span><br />
				<span class="message">'.$r['Message_Teaser'].'</span>
				</a>
			</li>';
        }
        //echo '<pre>';
//        print_r($res->result_array());
//        echo '</pre>';
        $d['new_msg']=$str;
        echo json_encode($d);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */
