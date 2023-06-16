<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class biaya_daftar extends MY_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk asal informasi
	 **/
    
	public function index()
	{
        $this->mydata['jsInclude']=getJsIncludeFormByClass($this->mydata['page_id']);
        $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    public function loadPage(){
        if($this->app_model->isBayarDaftarExist($this->session->userdata('username'))){
            $page=$this->loadPageStatus();    
        }else{
            $page=$this->loadPageKonfirmasi();
        }
        echo $page;
    }

    public function loadPageKonfirmasi(){
        $username=$this->session->userdata('username');
        $this->mydata['pt_long_name']=$this->app_model->getConfigItem('pt_long_name');
        $this->mydata['rekening']=$this->app_model->rekeningDaftarPmb();
        $genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        $this->mydata['biayaDaftarPlain']=$this->app_model->getConfigItem('default_biayaDaftar');
        $this->mydata['biayaDaftar']=$this->money($this->mydata['biayaDaftarPlain']);
        $page=$this->load->view('tr/biaya_daftar/konfirmasi',$this->mydata,true);
        return $page;
    }
    public function loadPageStatus(){
        $username=$this->session->userdata('username');
        $this->mydata['rekening']=$this->app_model->rekeningDaftarPmb();
        $this->mydata['detTbl']=genDetailByClass($this->mydata['page_id']);
        $page=$this->load->view('tr/biaya_daftar/status',$this->mydata,true);
        return $page;
    }
    public function getDetaiStatus(){
        $res=$this->app_model->getDetailOfBayarDaftar($this->session->userdata('username'));
        echo json_encode($res);
    }
    public function simpan(){
        $p=$this->input->post();
        $data=mappingColumn('tb_pmb_tr_bayar_daftar',$p);
        if(!empty($data['Tanggal_Bayar']))
            $data['Tanggal_Bayar'] = date("Y-m-d", strtotime($data['Tanggal_Bayar']));
        $data['Username_Reg']=$this->session->userdata('username');
        $data['IdFile']=$this->session->userdata('idFile');
        if($this->app_model->isBayarDaftarExist($data['Username_Reg'])){
            $data=$this->addUpdateLog($data);
            $data=array_filter($data);
            $key['Username_Reg']=$data['Username_Reg'];
            $res['isSuccess']=$this->db->update("tb_pmb_tr_bayar_daftar",$data,$key);
        }else{
            $data=$this->addInsertLog($data);
            $data=array_filter($data);
            $res['isSuccess']=$this->db->insert("tb_pmb_tr_bayar_daftar",$data);    
        }
        if($res['isSuccess']){
            $this->system_model->writeNotifForUserOnGroupOfRole($this->config->item('application_id'),$this->system_model->getConfigItem('target_group_role_bayar_daftar'),$this->session->userdata('nama_lengkap').' mengkonfirmasi pembayaran biaya pendaftaran.',base_url().'index.php/tr_verifikasi_bayar_daftar/index/'.specialCharToHtmlCode($this->session->userdata('username')));
            $this->app_model->updateLangkahPendaftaranCamaba($this->session->userdata('username'),3,3);
        }
        echo json_encode($res);
    }
 }