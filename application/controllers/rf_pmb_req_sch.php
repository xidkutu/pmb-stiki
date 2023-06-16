<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_req_sch extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 **/
     
	public function index($key='')
	{       
        $genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['key']=transHtmlCode($key);
        $this->mydata['modal']=$this->load->view('rf/req_sch/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/req_sch/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}

    public function retrieveData(){
        $this->load->library('datatable');
          	
        $kolom = array('Id','Nama_Pemohon','Asal_SMU','Nama_Kota','Nama_Prop','Ref','options-no-db');        
		$pk = 'Id';
		$sql = "
			(
				SELECT
                	Id,
                	Nama_Pemohon,
                	Asal_SMU,
                	Nama_Kota,
                	Nama_Prop,
                	Ref
                FROM
                	tb_glb_tr_permohonan_sekolah_baru sch 
                LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
                LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop=prov.Kode_Prop			
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$row->Id.'","'.$row->Asal_SMU.'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$row->Id.'","'.$row->Asal_SMU.'")';
            
			$new_data[] = array(
				$row->Nama_Pemohon,				
				$row->Asal_SMU,
                $row->Nama_Kota,
                $row->Nama_Prop,
                $row->Ref,            			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left' role='menu'>
                     <li role='presentation'>
	                    <a role='menuitem' tabindex='-1' href='#' onclick='$aksiEdit'>Lihat detail</a>
					 </li>
                     <li role='presentation' class='divider'></li>
                     <li role='presentation'>
                        <a role='menuitem' tabindex='-1' href='#' onclick='$aksiHapus'>Hapus</a>
					 </li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function getDaftarKota(){
        $id=$this->input->post('prop');
        $city=$this->app_model->getDaftarKota($id);
        
        $res='<option value="">-PILIH-</option>';
        foreach($city->result() as $c){
            $res.='<option value="'.$c->Kode_Kota.'">'.$c->NamaKota.'</option>';
        }
        
        $d['kota']=$res;
        
        echo json_encode($d);
    }
    public function simpan()
	{
        $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_akd_rf_asal_sekolah",$data);
        
        $data['Kode_SMU']=$this->app_model->generateKodeSma($p['KodeProp']);
        $data=$this->addInsertLog($data);
        $res['isSuccess']=$this->db->insert("tb_akd_rf_asal_sekolah",$data);   
    	
        $this->app_model->hapusReqSch($p['Id']);
        echo json_encode($res);
	}
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusReqSch($id);
        echo 'succed';
    }
    
    public function detail(){
        $id=$this->input->post('id');
        
        $res=$this->app_model->getDetailOfReqSch($id);
        echo json_encode($res);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
