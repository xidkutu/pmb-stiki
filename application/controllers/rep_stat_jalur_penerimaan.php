<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rep_stat_jalur_penerimaan extends MY_Reporting {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
	public function index()
	{        
        $this->mydata['stat']=$this->system_model->getStatistikDashboard();
        $this->mydata['content']=$this->load->view('lp/statistik/jalur_penerimaan/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function getReport(){
        $p=$this->input->post();
        $var['jenis']='1';
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatJalurUsul_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $var['data']=$this->rep_model->getStatJalurUsul_Mhs($p['start'],$p['end']);
        }else{
            $var['data']=$this->rep_model->getStatJalurUsul_Bayar($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/jalur_penerimaan/table',$var,true);
        echo $var['table'];
    }
    public function getReport_pie(){ 
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatJalurUsul_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $data=$this->rep_model->getStatJalurUsul_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatJalurUsul_Bayar($p['start'],$p['end']);
        }
        
        $limit=$this->system_model->getConfigItem('graph_pie_limit');
        $newData=array();
        
        $tresData=-1;
        if($data->num_rows()>$limit){
            $tempData=$data->result_array();
            $tresData=$tempData[count($tempData)-1]['N'];
        }
        $tresInd=-1;
        foreach($data->result_array() as $i=>$r){
            if($i>=$limit || $r['N']==$tresData){
                if($tresInd==-1){
                    $tresInd=$i;
                    $newData[$tresInd]['reg']='Lainnya';
                    $newData[$i]['n']=0;    
                };
                $newData[$tresInd]['n']+=$r['N'];
            }else{
                $newData[$i]['reg']=$r['Nama_JalurPenerimaan'];
                $newData[$i]['n']=$r['N'];   
            }
        }
        echo json_encode($newData);
    }
    public function getReportBeri(){
        $p=$this->input->post();
        $var['jenis']='2';
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatJalurBeri_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $var['data']=$this->rep_model->getStatJalurBeri_Mhs($p['start'],$p['end']);
        }else{
            $var['data']=$this->rep_model->getStatJalurBeri_Bayar($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/jalur_penerimaan/table',$var,true);
        echo $var['table'];
    }
    public function getReportBeri_pie(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatJalurBeri_Pendaftar($p['start'],$p['end']);
        }elseif($p['tipe']==2){
            $data=$this->rep_model->getStatJalurBeri_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatJalurBeri_Bayar($p['start'],$p['end']);
        }
        
        $limit=$this->system_model->getConfigItem('graph_pie_limit');
        $newData=array();
        
        $tresData=-1;
        if($data->num_rows()>$limit){
            $tempData=$data->result_array();
            $tresData=$tempData[count($tempData)-1]['N'];
        }
        $tresInd=-1;
        foreach($data->result_array() as $i=>$r){
            if($i>=$limit || $r['N']==$tresData){
                if($tresInd==-1){
                    $tresInd=$i;
                    $newData[$tresInd]['reg']='Lainnya';
                    $newData[$i]['n']=0;    
                };
                $newData[$tresInd]['n']+=$r['N'];
            }else{
                $newData[$i]['reg']=$r['Nama_JalurPenerimaan'];
                $newData[$i]['n']=$r['N'];   
            }
        }
        echo json_encode($newData);
    }
    public function detailMhs(){
        $p=$this->input->post();
        if($p['tipe']==1){
            if($p['jenis']=='my_tabel'){
                $data['data']=$this->rep_model->getDetailStatJalurUsul_Pendaftar($p['id'],$p['start'],$p['end']);   
            }if($p['jenis']=='my_tabel_beri'){
                $data['data']=$this->rep_model->getDetailStatJalurBeri_Pendaftar($p['id'],$p['start'],$p['end']);
            }            
        }else if($p['tipe']==2){
            if($p['jenis']=='my_tabel'){
                $data['data']=$this->rep_model->getDetailStatJalurUsul_Mhs($p['id'],$p['start'],$p['end']);   
            }if($p['jenis']=='my_tabel_beri'){
                $data['data']=$this->rep_model->getDetailStatJalurBeri_Mhs($p['id'],$p['start'],$p['end']);
            }           
        }else{
            if($p['jenis']=='my_tabel'){
                $data['data']=$this->rep_model->getDetailStatJalurUsul_Bayar($p['id'],$p['start'],$p['end']);   
            }if($p['jenis']=='my_tabel_beri'){
                $data['data']=$this->rep_model->getDetailStatJalurBeri_Bayar($p['id'],$p['start'],$p['end']);
            }
        }
        $content=$this->load->view('lp/statistik/sekolah/table_detail_mhs',$data,true);
        echo $content;
    }
}
