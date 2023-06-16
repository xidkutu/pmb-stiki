<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rep_stat_provinsi extends MY_Reporting {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
	public function index()
	{        
        $this->mydata['stat']=$this->system_model->getStatistikDashboard();
        $this->mydata['content']=$this->load->view('lp/statistik/global/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function getReport(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatProv_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $var['data']=$this->rep_model->getStatProv_Mhs($p['start'],$p['end']);
        }else{
            $var['data']=$this->rep_model->getStatProv_PembayaranDiterima($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/provinsi/table',$var,true);
        echo $var['table'];
    }
    public function getReport_pie(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatProv_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $data=$this->rep_model->getStatProv_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatProv_PembayaranDiterima($p['start'],$p['end']);
        }
        
        $limit=$this->system_model->getConfigItem('graph_pie_limit');
        $newData=array();
        
        $tresData=-1;
        
        $tempData=$data->result_array();
        $ns=array_filter(array_column($tempData,'N'));
        if(count($ns)>$limit){
            $tresData=min($ns);
        }
        
        $tresInd=-1;
        foreach($data->result_array() as $i=>$r){
            if($r['N']>0){
                if($i>=$limit || (count($ns)>$limit && $r['N']==$tresData)){
                    if($tresInd==-1){
                        $tresInd=$i;
                        $newData[$tresInd]['reg']='Lainnya';
                        $newData[$i]['n']=0;    
                    };
                    $newData[$tresInd]['n']+=$r['N'];
                }else{
                    $newData[$i]['reg']=$r['Nama_Prop'];
                    $newData[$i]['n']=$r['N'];   
                }   
            }
        }
        
        echo json_encode($newData);
    }
    public function detailMhs(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data['data']=$this->rep_model->getDetailProv_Pendaftar($p['id'],$p['start'],$p['end']);            
        }elseif($p['tipe']==2){
            $data['data']=$this->rep_model->getDetailProv_Mhs($p['id'],$p['start'],$p['end']);
        }else{
            $data['data']=$this->rep_model->getDetailProv_PembayaranDiterima($p['id'],$p['start'],$p['end']);
        }
        $content=$this->load->view('lp/statistik/sekolah/table_detail_mhs',$data,true);
        echo $content;
    }
}
