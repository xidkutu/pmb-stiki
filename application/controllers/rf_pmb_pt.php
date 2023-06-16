<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_pt extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 **/

	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        $detForm['detForm']=genFormInputByClass($this->mydata['page_id'].'1');
        $this->mydata=array_merge($this->mydata,$detForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/perguruan_tinggi/modal_input',$this->mydata,true);
        $this->mydata['modal'].=$this->load->view('rf/perguruan_tinggi/modal_detail',$this->mydata,true);
        $this->mydata['modal'].=$this->load->view('rf/perguruan_tinggi/modal_detail_prodi',$this->mydata,true);
        $this->mydata['modal'].=$this->load->view('rf/perguruan_tinggi/modal_input_detail',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/perguruan_tinggi/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_perguruan_tinggi';
         
        // Table's primary key
        $primaryKey = 'Kode_PT';
         
        $columns = array(
            array( 'db' => 'Kode_PT', 'dt' => 0 ),
            array( 'db' => 'Nama_PT',  'dt' => 1 ),
            array( 'db' => 'Kota',   'dt' => 2 ),
            array( 'db' => 'Telepon',   'dt' => 3 ),
            array( 'db' => 'Email_PT',   'dt' => 4 ),
            array( 'db' => 'Website_PT',   'dt' => 5 ),
            array( 'db' => 'action',   'dt' => 6 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            $aksiHapus='lihat_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiMasterDetail='master_detail_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][6]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiHapus'>Lihat detail</a>
                                  </li>
                                  <li><a href='#' onclick='$aksiEdit'>Edit Perguruan Tinggi</a>
                                  </li>
                                  <li><a href='#' onclick='$aksiMasterDetail'>Program Studi PT</a>
                                  </li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
    }
    public function setViewForDetail(){
        $id=$this->input->post('id');
        $this->session->set_userdata($this->mydata['page_id'].'det_id',$id);
        $d['isOk']=true;
        echo json_encode($d);
    }
    public function retrieveDataDetail(){
        $this->load->library('datatable');          
        $id=$this->session->userdata($this->mydata['page_id'].'det_id');  	
        $kolom = array('Kode_PT','Kode_Prodi','Jenjang','Nama_Prodi','Telepon','Email','options-no-db');        
		$pk = 'Kode_Prodi';
		$sql = "
			(
				SELECT Kode_PT,Kode_Prodi,Jenjang,Nama_Prodi,Telepon,Email FROM tb_akd_rf_prodi_pt WHERE Kode_PT='$id'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->Kode_Prodi,				
				$row->Jenjang,
                $row->Nama_Prodi,
                $row->Telepon,
                $row->Email,			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='editDet_".$this->mydata['page_id']."(\"".$row->Kode_PT."\",\"".$row->Kode_Prodi."\")'>Edit</a></li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    public function getKotaByProvinsi(){
        $prov=$this->input->post("prov");
        $res=$this->app_model->getKotaByProv($prov);
        $opt="<option value=''>-PILIH KOTA-</option>";
        foreach($res->result() as $ct){
            $opt.="<option value='".$ct->Kode_Kota."'>".$ct->NamaKota."</option>";
        }
        
        $d['opt']=$opt;
        echo json_encode($d);
    }
    public function lihat(){
        $id=$this->input->post('id');
        $res=$this->app_model->getDetailOfPerguruanTinggi($id);
        echo json_encode($res);
    }
    public function lihatDetail(){
        $id=$this->input->post('id');
        $pt=$this->input->post('pt');
        $res=$this->app_model->getDetailOfProdiPt($id,$pt);
        echo json_encode($res);
    }
    public function simpan()
	{
	   $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_akd_rf_perguruan_tinggi",$data);
        if(!empty($data['Tgl_Akta']))
        $data['Tgl_Akta'] = date("Y-m-d", strtotime($data['Tgl_Akta']));
        if(!empty($data['Tgl_Awal_Pendirian']))
        $data['Tgl_Awal_Pendirian'] = date("Y-m-d", strtotime($data['Tgl_Awal_Pendirian']));
        $data=array_filter($data);
        if($p['saveas']=='baru'){
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_akd_rf_perguruan_tinggi",$data);   
        }else{
            $key = array(
                'Kode_PT' => $data['Kode_PT'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_akd_rf_perguruan_tinggi',$data,$key);
        }		
		
        echo json_encode($res); 
	}
    public function simpanDetail()
	{
	   $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_akd_rf_prodi_pt",$data);
        if($p['saveas']=='baru'){
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_akd_rf_prodi_pt",$data);   
        }else{
            $key = array(
                'Kode_Prodi' => $data['Kode_Prodi'],
                'Kode_PT' => $data['Kode_PT'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_akd_rf_prodi_pt',$data,$key);
        }		
		
        echo json_encode($res); 
	}
	
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusProvinsi($id);
        
        echo 'succed';
    }
    
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
