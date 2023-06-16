<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
	public function index()
	{        
        if($this->session->userdata('role')=='camaba'){
            $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        }
        else{
            $this->mydata['stat']=$this->system_model->getStatistikDashboard();
            $this->mydata['content']=$this->load->view('application/dashboard/content',$this->mydata,true);
        }
        $this->load->view('main_page',$this->mydata);
	}
    public function getStatistik(){
        $data=$this->system_model->getStatistikDashboard();
        echo json_encode($data);
    }
    public function getRegionalVisitor(){
        $data=$this->system_model->getRegionalVisitor();
        echo json_encode($data);
    }
    public function getRegionalVisitor_pie(){
        $data=$this->system_model->getRegionalPie();
        echo json_encode($data);
    }
    public function loadPage(){
        $username=$this->session->userdata('username');
        $par['langkah']=$this->app_model->getLangkahDaftar();
        $par['langkahCamaba']=$this->app_model->getLangkahKeCamaba($username);
        $page=$this->load->view('application/profile/overview',$par,true);
        echo $page;
    }
    public function loadInfo(){
        $username=$this->session->userdata('username');
        $langkah=$this->input->post('id');
        $par=array();
        if($langkah=='5'){
            $res['isEnable']=true;
            $isTerima=$this->app_model->isDiterima($username);
            $par['prodi']=$this->app_model->getProdiDiterima($username);
            if(strtoupper($isTerima)=='YES')
                $res['page']=$this->load->view('application/info/penerimaan/info_diterima',$par,true);
            else if(strtoupper($isTerima)=='NO')
                $res['page']=$this->load->view('application/info/penerimaan/info_ditolak',$par,true);
            else
                $res['page']=$this->load->view('application/info/penerimaan/info_menunggu',$par,true);
        }else
        if($langkah=='6'){
            $isDafUl=$this->app_model->isDaftarUlangByUsername($username);
            if($isDafUl['isExist']){
                $res['isEnable']=true;
                if(strtoupper($isDafUl['isisDaftar_Ulang'])=='YES'){
                    $res['page']=$this->load->view('application/info/daftar_ulang/complete',$par,true);
                }else
                    $res['page']=$this->load->view('application/info/daftar_ulang/info',$par,true);
            }else
                $res['isEnable']=false;                
        }else
            $res['isEnable']=false;
        echo json_encode($res);
    }
}
