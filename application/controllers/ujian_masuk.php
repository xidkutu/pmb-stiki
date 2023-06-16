<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ujian_masuk extends MY_Form_Camaba {
	
    public function index(){
        $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
    }
    public function loadPage(){
        $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user));
        
        $isUjian=$this->app_model->getCamabaIsUjianAndJalur($cur_user); 
        if($isUjian['isUjian']=='YES')
            echo $this->getKartuUjian();
        else
        if($isUjian['isUjian']=='NO'){
            echo $this->load->view('application/profile/tidak_ujian',$isUjian,true);
        }else{
            echo $this->load->view('application/profile/menunggu_ujian',$isUjian,true);
        }
             
    }
    public function getProfileCamaba(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        if(isset($res['pwd'])) unset($res['pwd']);
        $res['tahun_penerimaan']=$this->system_model->getConfigItem('tahun_penerimaan');
        $res['mata_ujian']=$this->app_model->getMataUjianCamaba_Kartu($res['Kode_Prodi']);
        $res['today']=$this->app_model->getTodayByFormat();
        $res['kota_instansi']=$this->system_model->getConfigItem('pt_city');
        $res['tmp_ujian']=$this->system_model->getConfigItem('pt_address');
        $res['waktu_ujian']=$this->app_model->getWaktuUjian($user);
        
        echo json_encode($res);
    }
}