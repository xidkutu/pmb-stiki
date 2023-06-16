<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    public $mydata=array();
    
    function  __construct() {
        parent::__construct();
        $this->mydata['page_id']=$this->uri->rsegment(1);
        /*page info containt
            -Nama_Menu
            -Keterangan
            -Icon
        */
        $this->mydata['page_info']=$this->system_model->getPageInfo($this->mydata['page_id']);
        
        $this->mydata['breadcrumb']=genBCByClassName($this->mydata['page_id']);
        $this->mydata['notif_interval']=$this->app_model->getConfigItem('get_notif_interval');
        $this->mydata['js_global_method']=$this->load->view('global/js/global_method',$this->mydata,true);
        $noImageUrl=conf_link($this->app_model->getConfigItem('no_picture_url'));
        //if($this->isImageExists($noImageUrl)) $this->mydata['no_picture_url']=$noImageUrl;
        //else $this->mydata['no_picture_url']=$this->config->item('no_picure_local');
        $this->mydata['no_picture_url']=$noImageUrl;
    }
    
    function addInsertLog($data){
        $data['Created_App']= $this->config->item('application_id');
        $data['Created_by']= $this->session->userdata('username');
        $data['Created_date']=$this->system_model->getTodayStr();
        return $data;
    }
    
    function addUpdateLog($data){
        $data['Modified_App']= $this->config->item('application_id');
        $data['Modified_by']= $this->session->userdata('username');
        $data['Modified_date']=$this->system_model->getTodayStr();
        return $data;
    }
    
    public function kirim_email($pengirim,$ke,$subyek,$pesan) {
       $result=false;
       $this->load->library('email');
       $this->email->initialize(array(
             'protocol' => $this->config->item('email_protocol'),
             'smtp_host' => $this->config->item('email_smtp_host'),
             'smtp_user' => $this->config->item('email_smtp_user'),
             'smtp_pass' => $this->config->item('email_smtp_pass'),
             'smtp_port' => $this->config->item('email_smtp_port'),
             'mailtype' => $this->config->item('email_mailtype'),
             'charset'  => $this->config->item('email_charset'),
             'newline' => $this->config->item('email_newline') // kode yang harus di tulis pada konfigurasi controler email
       ));
    
       $from = $this->config->item('email_smtp_user');
       $nama = $pengirim;
       $to = $ke;
       $subject = $subyek;
       $message = $pesan;
       $this->email->from($from, $nama )
                   ->to($to)
                   ->subject($subject)
                   ->message($message);
    
       if ($this->email->send()) {
          //$this->session->set_flashdata('success', 'Email berhasil dikirim.');
          $result = 'sukses';
       } else {
          show_error($this->email->print_debugger());
          $result = 'gagal';
       }
       return $result;
    }
    
    public function money($number){
        if(!is_string($number)) $number=strval($number);
        $currency=$this->app_model->getConfigItem('Currency');
        $curPos=$this->app_model->getConfigItem('Currency_pos');
        $res='';
        if(strlen($number)>3){
            $md=strlen($number) % 3;
            foreach(str_split($number) as $i=>$n){
                if((($i+1)==$md || (($i-$md+1)%3==0)) && ($i<strlen($number)-1)) $res=$res.$n.'.';
                else $res=$res.$n;
            }
            if(strcasecmp($curPos, "depan")==0) $res=$currency.' '.$res.',-';else
            if(strcasecmp($curPos, "delakang")==0) $res=$res.',- '.$currency;
        }else{
            if(strcasecmp($curPos, "depan")==0) $res=$currency.' '.$number.',-';else
            if(strcasecmp($curPos, "delakang")==0) $res=$number.',- '.$currency;
        }
        return $res;
    }
    
    function isImageExists($url)
    {
        //if($this->is_url_exist($url)){
//            if (getimagesize($url) !== false) return true; else return false;   
//        }else return false;
        return true;
    }
    
    function is_url_exist($url){
        $ch = curl_init($url);    
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if($code == 200){
           $status = true;
        }else{
          $status = false;
        }
        curl_close($ch);
       return $status;
    }
}
?>