<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_asal_sekolah extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 **/
     
	public function index()
	{       
        $genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/asal_sekolah/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/asal_sekolah/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    
    public function getFileNamaFromURL($fileurl){
        $filename=explode('/',$fileurl);
        $filename=end($filename);
        return $filename;
    }
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_sekolah';
         
        // Table's primary key
        $primaryKey = 'Kode_SMU';
         
        $columns = array(
            array( 'db' => 'Kode_SMU', 'dt' => 0 ),
            array( 'db' => 'Asal_SMU',  'dt' => 1 ),
            array( 'db' => 'Alamat_SMU',   'dt' => 2 ),
            array( 'db' => 'Kota_SMU',   'dt' => 3 ),
            array( 'db' => 'Telp',   'dt' => 4 ),
            array( 'db' => 'Email',   'dt' => 5 ),
            array( 'db' => 'action',   'dt' => 6 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            //Action dropdown
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].' '.$content[$i][3].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][6]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Edit</a>
                                  </li>
                                  <li class='divider'></li>
                                  <li><a href='#' onclick='$aksiHapus'>Delete</a>
                                  </li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
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
        if($p['saveas']=='baru'){
            $data['Kode_SMU']=$this->app_model->generateKodeSma($p['KodeProp']);
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_akd_rf_asal_sekolah",$data);   
        }else{
            $key = array(
                'Kode_SMU' => $data['Kode_SMU'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_akd_rf_asal_sekolah',$data,$key);
        }		
		
        echo json_encode($res);
	}
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusSekolah($id);
        
        echo 'succed';
    }
    
    public function detail(){
        $id=$this->input->post('id');
        
        $res=$this->app_model->getDetailSekolah($id);
        echo json_encode($res);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
