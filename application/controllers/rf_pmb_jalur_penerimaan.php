<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_jalur_penerimaan extends MY_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman provinsi
	 **/

	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/jalur_penerimaan/modal_input',$this->mydata,true);
        $this->mydata['modal'].=$this->load->view('rf/jalur_penerimaan/modal_setsyarat',$this->mydata,true);
        $this->mydata['modal'].=$this->load->view('rf/jalur_penerimaan/modal_setberkas',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/jalur_penerimaan/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_jalur_penerimaan';
         
        // Table's primary key
        $primaryKey = 'Id_JalurPenerimaan';
         
        $columns = array(
            array( 'db' => 'Id_JalurPenerimaan', 'dt' => 0 ),
            array( 'db' => 'Nama_JalurPenerimaan',  'dt' => 1 ),
            array( 'db' => 'Fasilitas',  'dt' => 2 ),
            array( 'db' => 'Periode_Penerimaan',  'dt' => 3 ),
            array( 'db' => 'SyaratDaftar',  'dt' => 4 ),
            array( 'db' => 'isAktif',   'dt' => 5 ),
            array( 'db' => 'action',   'dt' => 6 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            $aksi='setChangeActive_'.$this->mydata['page_id'].'("'.$content[$i][0].'")';
            if($content[$i][5]=='checkYES'){
                $content[$i][5]=
                    "<input type='checkbox' checked class='make-switch' data-size='small' onchange='$aksi'>";
            }else{
                $content[$i][5]=
                    "<input type='checkbox' class='make-switch' data-size='small' onchange='$aksi'>";
            }
            //Action dropdown
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiSetSyarat='setSyarat("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiSetBerkas='setBerkas("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][6]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Edit</a></li>
                                  <li><a href='#' onclick='$aksiSetSyarat'>Syarat Pendaftaran</a></li>
                                  <li><a href='#' onclick='$aksiSetBerkas'>Pengaturan Berkas</a></li>
                                  <li class='divider'></li>
                                  <li><a href='#' onclick='$aksiHapus'>Delete</a></li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
    }
    
    public function setViewForDetailSyarat(){
        $id=$this->input->post('id');
        $this->session->set_userdata($this->mydata['page_id'].'det_id',$id);
        
        $optSyarat="<option value=''>-Choose-</option>";
        $list=$this->app_model->getListSyaratDaftar();
        foreach($list->result_array() as $app){
            $detSyarat=$app['Detail_SyaratDaftar'];
            if($app['nWord']>5) $detSyarat.='...';
            $optSyarat.="<option value='".$app['Id_SyaratDaftar']."'>".$app['Id_SyaratDaftar'].". ".$detSyarat."</option>";
        }
        
        $d['optSyarat']=$optSyarat;
        echo json_encode($d);
    }
    
    public function retrieveDataDetail(){
        $this->load->library('datatable');          
        $id=$this->session->userdata($this->mydata['page_id'].'det_id');  	
        $kolom = array('Id_SyaratDaftar','Detail_SyaratDaftar','options-no-db');        
		$pk = 'Id_SyaratDaftar';
		$sql = "
			(
				SELECT
                	syarat.Id_SyaratDaftar,
                	Detail_SyaratDaftar
                FROM
                	tb_pmb_tr_syaratdaftar_penerimaan syaratDaftar
                INNER JOIN tb_pmb_rf_syarat_daftar syarat ON syaratDaftar.Id_SyaratDaftar = syarat.Id_SyaratDaftar 
                WHERE
                	syaratDaftar.Id_JalurPenerimaan='$id'
                AND syarat.isAktif='YES'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->Id_SyaratDaftar,				
				$row->Detail_SyaratDaftar,			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='setHapusDataDetail(\"".$row->Id_SyaratDaftar."\")'>Delete</a></li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function saveSyarat(){
        $id_jalur=$this->input->post('id_jalur');
        $syarat=$this->input->post('syarat');
        
        $databaru = array(
                'Id_JalurPenerimaan' =>$id_jalur,
                'Id_SyaratDaftar' =>  $syarat,
                'Created_App' => $this->config->item('application_id'),
                'Created_by' => $this->session->userdata('username'),
                'Created_date' => $this->app_model->getToday(),
           );
        $this->db->insert("tb_pmb_tr_syaratdaftar_penerimaan",$databaru);
        
    }
    
    public function hapusSyarat(){
        $id_jalur=$this->input->post('id_jalur');
        $syarat=$this->input->post('idSyarat');
        $res=$this->app_model->setHapusSyarat($id_jalur,$syarat);
        echo $res; 
    }
    
    public function setViewForDetailBerkas(){
        $id=$this->input->post('id');
        $this->session->set_userdata($this->mydata['page_id'].'det_id_berkas',$id);
        
        $optSyarat="<option value=''>-Choose-</option>";
        $list=$this->app_model->getListBerkasDaftar();
        foreach($list->result_array() as $app){
            $detBerkas=$app['Detail_Berkas'];
            if($app['nWord']>5) $detBerkas.='...';
            $optSyarat.="<option value='".$app['Id_Berkas']."'>".$app['Detail_Berkas'].". ".$detBerkas."</option>";
        }
        
        $d['optSyarat']=$optSyarat;
        echo json_encode($d);
    }
    
    public function retrieveDataBerkas(){
        $this->load->library('datatable');          
        $id=$this->session->userdata($this->mydata['page_id'].'det_id_berkas');  	
        $kolom = array('id_berkas','detail_berkas','options-no-db');        
		$pk = 'id_berkas';
		$sql = "
			(
				SELECT
                	jalur.id_berkas,
                	detail_berkas
                FROM
                	tb_pmb_tr_berkas_jalur jalur INNER JOIN tb_pmb_rf_berkas berkas ON jalur.id_berkas=berkas.id_berkas
                WHERE
                	jalur.Id_JalurPenerimaan = '$id'
                AND berkas.isAktif='YES'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->id_berkas,				
				$row->detail_berkas,			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='setHapusDataBerkas(\"".$row->id_berkas."\")'>Delete</a></li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function saveBerkas(){
        $id_jalur=$this->input->post('id_jalur');
        $berkas=$this->input->post('berkas');
        
        $databaru = array(
                'Id_JalurPenerimaan' =>$id_jalur,
                'Id_Berkas' =>  $berkas,
                'Created_App' => $this->config->item('application_id'),
                'Created_by' => $this->session->userdata('username'),
                'Created_date' => $this->app_model->getToday(),
           );
        $this->db->insert("tb_pmb_tr_berkas_jalur",$databaru);
        
    }
    public function hapusBerkas(){
        $id_jalur=$this->input->post('id_jalur');
        $idBerkas=$this->input->post('idBerkas');
        $res=$this->app_model->setHapusBerkas($id_jalur,$idBerkas);
        echo $res; 
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
