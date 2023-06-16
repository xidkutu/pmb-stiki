<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rep_stat_sch extends MY_Reporting {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
	public function index()
	{        
        $this->mydata['stat']=$this->system_model->getStatistikDashboard();
        $this->mydata['content']=$this->load->view('lp/statistik/sekolah/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function getReport(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $var['data']=$this->rep_model->getStatSch_Mhs($p['start'],$p['end']);
        }else{
            $var['data']=$this->rep_model->getStatSch_Bayar($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/sekolah/table',$var,true);
        echo $var['table'];
    }
    public function getReport_pie(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $data=$this->rep_model->getStatSch_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatSch_Bayar($p['start'],$p['end']);
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
                $newData[$i]['reg']=$r['Asal_SMU'];
                $newData[$i]['n']=$r['N'];   
            }
        }
        echo json_encode($newData);
    }
    public function getReportProvSch(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatProvSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $var['data']=$this->rep_model->getStatProvSch_Mhs($p['start'],$p['end']);
        }else{
            $var['data']=$this->rep_model->getStatProvSch_Bayar($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/sekolah/table_prov',$var,true);
        echo $var['table'];
    }
    public function getReportProvSch_pie(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatProvSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $data=$this->rep_model->getStatProvSch_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatProvSch_Bayar($p['start'],$p['end']);
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
                $newData[$i]['reg']=$r['Nama_Prop'];
                $newData[$i]['n']=$r['N'];   
            }
        }
        echo json_encode($newData);
    }
    public function getReportKotaSch(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $var['data']=$this->rep_model->getStatKotaSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $var['data']=$this->rep_model->getStatKotaSch_Mhs($p['start'],$p['end']);
        }else{ 
            $var['data']=$this->rep_model->getStatKotaSch_Bayar($p['start'],$p['end']);
        }
        $var['table']=$this->load->view('lp/statistik/sekolah/table_kota',$var,true);
        echo $var['table'];
    }
    
    
    public function getReportKotaSch_pie(){
        $p=$this->input->post();
        if($p['tipe']==1){
            $data=$this->rep_model->getStatKotaSch_Pendaftar($p['start'],$p['end']);
        }else if($p['tipe']==2){
            $data=$this->rep_model->getStatKotaSch_Mhs($p['start'],$p['end']);
        }else{
            $data=$this->rep_model->getStatKotaSch_Bayar($p['start'],$p['end']);
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
                $newData[$i]['reg']=$r['Kota'];
                $newData[$i]['n']=$r['N'];   
            }
        }
        
        echo json_encode($newData);
    }
    
    public function detailMhs(){
        $p=$this->input->post();
        if($p['tipe']==1){
            if(strtoupper($p['jenis'])=='SEKOLAH'){
                $data['data']=$this->rep_model->getDetailSch_Pendaftar($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='PROV'){
                $data['data']=$this->rep_model->getDetailProvSch_Pendaftar($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='KOTA'){
                $data['data']=$this->rep_model->getDetailKotaSch_Pendaftar($p['id'],$p['start'],$p['end']);
            }            
        }else if($p['tipe']==2){
            if(strtoupper($p['jenis'])=='SEKOLAH'){
                $data['data']=$this->rep_model->getDetailSch_Mhs($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='PROV'){
                $data['data']=$this->rep_model->getDetailProvSch_Mhs($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='KOTA'){
                $data['data']=$this->rep_model->getDetailKotaSch_Mhs($p['id'],$p['start'],$p['end']);
            }           
        }else{
            if(strtoupper($p['jenis'])=='SEKOLAH'){
                $data['data']=$this->rep_model->getDetailSch_Bayar($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='PROV'){
                $data['data']=$this->rep_model->getDetailProvSch_Bayar($p['id'],$p['start'],$p['end']);
            }if(strtoupper($p['jenis'])=='KOTA'){
                $data['data']=$this->rep_model->getDetailKotaSch_Bayar($p['id'],$p['start'],$p['end']);
            }
        }
        $content=$this->load->view('lp/statistik/sekolah/table_detail_mhs',$data,true);
        echo $content;
    }
}
