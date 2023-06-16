<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_ujian_masuk extends MY_Controller {

	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/ujian_masuk/modal_setmataujian',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/ujian_masuk/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_ujian_masuk';
         
        // Table's primary key
        $primaryKey = 'Kode_Prodi';
         
        $columns = array(
            array( 'db' => 'Kode_Prodi', 'dt' => 0 ),
            array( 'db' => 'Nama_Prodi',  'dt' => 1 ),
            array( 'db' => 'Jenjang',  'dt' => 2 ),
            array( 'db' => 'MataUjian',  'dt' => 3 ),
            array( 'db' => 'action',   'dt' => 4 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            $aksiEdit='setMataUjian("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][4]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Setting Mata Ujian</a></li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
    }
    
    public function setViewForMataUjian(){
        $id=$this->input->post('id');
        $this->session->set_userdata($this->mydata['page_id'].'det_id',$id);
        
        $optMataUjian="<option value=''>-Choose-</option>";
        $list=$this->app_model->getListOfMataUjian();
        foreach($list->result_array() as $app){
            $optMataUjian.="<option value='".$app['Id_Mata_Ujian']."'>".$app['Mata_Ujian']."</option>";
        }
        
        $d['optMataUjian']=$optMataUjian;
        echo json_encode($d);
    }
    
    public function retrieveDataDetail(){
        $this->load->library('datatable');          
        $id=$this->session->userdata($this->mydata['page_id'].'det_id');  	
        $kolom = array('Id_Mata_Ujian','Mata_Ujian','options-no-db');        
		$pk = 'Id_Mata_Ujian';
		$sql = "
			(
				SELECT
                	Id_Mata_Ujian,
                	mata.Mata_Ujian
                FROM
                	tb_pmb_rf_ujian_masuk ujian INNER JOIN tb_pmb_rf_mata_ujian mata ON ujian.Mata_Ujian=mata.Id_Mata_Ujian
                WHERE
                	Kode_Prodi = '$id'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->Id_Mata_Ujian,				
				$row->Mata_Ujian,			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='setHapusDataDetail(\"".$row->Id_Mata_Ujian."\")'>Delete</a></li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function saveMataUjian(){
        $p=$this->input->post();
        $p=$this->addInsertLog($p);
        $p=array_filter($p);
        echo $this->db->insert("tb_pmb_rf_ujian_masuk",$p);
    }
    
    public function hapusMataUjian(){
        $p=$this->input->post();
        echo $this->db->delete("tb_pmb_rf_ujian_masuk",$p);
    }
    
    public function changeAktif(){
        $id=$this->input->post('id');
        $res=$this->app_model->changeAktif('tb_pmb_rf_jalur_penerimaan','Id_JalurPenerimaan',$id);
        
        echo 'succed';
    }
    
    public function simpan()
	{
	   $p=$this->input->post();
       $data=$p;
       if($p['saveas']=='baru'){
           unset($data['saveas']);
           unset($data['Id_JalurPenerimaan']);
           $data['isAktif']='YES';
           $data=$this->addInsertLog($data);
           $res['isSuccess']=$this->db->insert("tb_pmb_rf_jalur_penerimaan",$data);
       }else{
           unset($data['saveas']);
           unset($data['Id_JalurPenerimaan']);
           $data=$this->addUpdateLog($data);            
           $key=array(
            'Id_JalurPenerimaan' => $p['Id_JalurPenerimaan'],
           );
           $res['isSuccess']=$this->db->update("tb_pmb_rf_jalur_penerimaan",$data,$key);
       }		
		
        echo json_encode($res);
	}
	
    public function detail(){
        $id=$this->input->post('id');
        $res=$this->app_model->getDetailJalurPenerimaan($id);
        echo json_encode($res);
    }       
    
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusJalurPenerimaan($id);
        echo $res;
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
