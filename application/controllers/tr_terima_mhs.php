<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_terima_mhs extends MY_Controller {

	public function index()
	{
	   $prop=array(
            "tab"=>array(
                    0=>array(
                        "from"=>0,
                        "to"=>3,
                    ),
                    1=>array(
                        "from"=>4,
                        "to"=>4,
                    )
                )
        );
		$genForm=$genForm=genFormInputByClassWithProperty($this->mydata['page_id'],$prop);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        $this->mydata['opt']['prodi']=$this->app_model->getOptProdi();
        //Load Modal
        $this->mydata['modal']=$this->load->view('tr/terima_mhs/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('tr/terima_mhs/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('datatable');          
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
          	
        $kolom = array('Id_Camaba','Nama_Mhs','Pilihan_Prodi','Kelas_Deskripsi','IsDiterima','Prodi_Diterima','Status_Masuk','Nama_JalurPenerimaan','options-no-db');        
		$pk = 'Id_Camaba';
		$sql = "
			(
				SELECT
                	camaba.Id_Camaba,
                	Nama_Mhs,
                	GROUP_CONCAT(CONCAT(opt_prd.pilihan_ke,'. ',prd.Jenjang,' ',prd.Nama_Prodi) ORDER BY opt_prd.pilihan_ke SEPARATOR ', ') AS Pilihan_Prodi,
                	kls.Kelas_Deskripsi,
                	IsDiterima,
                	CONCAT(d_prd.jenjang,' ',d_prd.Nama_Prodi) Prodi_Diterima,
                	Status_Masuk,
                	jalur.Nama_JalurPenerimaan
                FROM
                	tb_pmb_tr_camaba camaba
                LEFT JOIN tb_akd_rf_prodi d_prd ON camaba.Kode_Prodi=d_prd.Kode_Prodi
                LEFT JOIN tb_akd_rf_kelas_mhs kls ON kls.Kelas_Mhs = camaba.Kelas
                LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
                LEFT JOIN (
                	tb_pmb_tr_pilihan_prodi opt_prd 
                INNER JOIN tb_akd_rf_prodi prd ON opt_prd.prodi=prd.Kode_Prodi
                )
                ON camaba.Id_Camaba=opt_prd.id_camaba
                WHERE
                	camaba.Tahun_Masuk = '$tahun'
                GROUP BY
                	camaba.Id_Camaba				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$row->Id_Camaba.'")';               		  
			$new_data[] = array(
				$row->Nama_Mhs,				
				$row->Pilihan_Prodi,
                $row->Kelas_Deskripsi,
                $row->Status_Masuk,
                $row->Nama_JalurPenerimaan,
                $row->Prodi_Diterima,
                $row->IsDiterima,                			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='$aksiEdit'>Ubah Penerimaan</a>
                      </li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function lihat(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamabaById($user);
        $res=filter_column_by_class($this->mydata['page_id'],$res);
        $res['det_prodi']=$this->getPlihanProdi($user);
        echo json_encode($res);
    }
    
    function getPlihanProdi($id){
        $data['opts']=$this->app_model->getPilihanProdi($id);
        return $this->load->view('tr/set_jalur_penerimaan/pilihan_prodi',$data,true);
    }
    
    public function simpan()
	{
        $p=$this->input->post();
        $key = array(
            'Id_Camaba' => $p['Id_Camaba'],
        );
        $data['IsDiterima']=$p['IsDiterima'];
        $data=$this->addUpdateLog($data);
        if(strtolower($data['IsDiterima'])=='yes'){
	      $data['Tgl_Diterima']=$this->app_model->getToday();
          $data['Kode_Prodi']=$p['Kode_Prodi'];
        }else
        if(strtolower($data['IsDiterima'])=='no'){
            $data['Tgl_Diterima']=NULL;
            $data['Kode_Prodi']=NULL;
        }else{
            $data['Tgl_Diterima']=NULL;
            $data['Kode_Prodi']=NULL;   
        }
        $res['isSuccess']=$this->db->update('tb_pmb_tr_camaba',$data,$key);		
		if($res['isSuccess']){
            if(strtolower($data['IsDiterima'])=='yes'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],6,12);
              $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Saudara dinyatakan diterima.',"#");
              }
            else
            if(strtolower($data['IsDiterima'])=='no'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],5,6);
              $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Saudara dinyatakan tidak diterima.',"#");
              }
            else{
                $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],5,7 );
                $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Pendaftaran saudara dalam proses menunggu pengumuman',"#");   
            }
		}
        echo json_encode($res);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
