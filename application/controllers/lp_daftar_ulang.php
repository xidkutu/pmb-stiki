<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lp_daftar_ulang extends MY_Controller {

	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['doneTypingInterval']=$this->system_model->getConfigItem('doneTypingInterval');
        $this->mydata['modal']=$this->load->view('lp/daftar_ulang/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('lp/daftar_ulang/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function retrieveData()
	{		
        $this->load->library('datatable');
        
		$tglmulai = $this->input->get('tglmulai');
        $tglsmp   = $this->input->get('tglsmp');

        if ($tglmulai==''){            
            $where = " YEAR(daftar.Tgl_DaftarUlang) = YEAR(CURDATE()) AND MONTH(daftar.Tgl_DaftarUlang) = MONTH(CURDATE()) ";
        }else{
            $where = " daftar.Tgl_DaftarUlang BETWEEN '".$tglmulai."' and '".$tglsmp."' ";                        
        }
            	        
        $kolom = array( 'tgl',
                        'NRP',
                        'nama', 
                        'nama_sekolah',
                        'kota_sekolah',
                        'prop_sekolah',
                        'ukuran_baju',
                        'agama',
                        'telp', 
                        'asal_informasi',
                        'Jenjang', 'Nama_Prodi', 'Kelas_Deskripsi', 
                        'Status_Masuk', 'Nama_JalurPenerimaan', 
                        'isDaftar_Ulang','options-no-db');        
		$pk = 'Id_Camaba';
		$sql = "
			(
				SELECT                	                	
                	date_format(daftar.Tgl_DaftarUlang,'%d-%m-%Y')tgl,
                	NRP,
                	Nama_Mhs nama,
                	sekolah.Asal_SMU nama_sekolah,
                	sekolah.Kota_SMU kota_sekolah,
                	prop.Nama_Prop prop_sekolah,
                    ukuran_baju,
                    agm.agama,
                	reg.telp telp,
                	info.Nama_Informasi asal_informasi,
                	prodi.Jenjang,
                	prodi.Nama_Prodi,
                	kls.Kelas_Deskripsi,
                	Status_Masuk,
                	jalur.Nama_JalurPenerimaan,
                	IFNULL(daftar.isDaftar_Ulang,'NO') AS isDaftar_Ulang
                FROM
                	tb_pmb_tr_camaba camaba
                INNER JOIN tb_pmb_tr_camaba_reg reg ON camaba.Email = reg.email
                INNER JOIN tb_akd_rf_asal_sekolah sekolah ON reg.Kode_SMU = sekolah.Kode_SMU 
                INNER JOIN tb_glb_rf_kota kota ON sekolah.Kode_Kota = kota.Kode_Kota
                INNER JOIN tb_akd_rf_propinsi prop ON kota.Kode_Prop = prop.Kode_Prop
                INNER JOIN tb_akd_rf_prodi prodi ON camaba.Kode_Prodi = prodi.Kode_Prodi
                LEFT JOIN tb_pmb_rf_asal_informasi info ON camaba.Id_Informasi = info.Id_Informasi
                LEFT JOIN tb_akd_rf_kelas_mhs kls ON kls.Kelas_Mhs = camaba.Kelas
                LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
                LEFT JOIN tb_pmb_tr_daftar_ulang daftar ON camaba.Id_Camaba=daftar.Id_Camaba
                LEFT JOIN tb_peg_rf_agama agm ON camaba.Agama_id=agm.agama_id
                WHERE
                camaba.IsDiterima='YES'
                and daftar.isDaftar_Ulang = 'YES'
                and $where 
				
			)";
			//and YEAR(presensi.tgl) = YEAR(CURDATE()) AND MONTH(presensi.tgl) = MONTH(CURDATE())
		//echo $sql;
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $new_data[] = array(				
                $row->tgl,
                $row->NRP,
                $row->nama,
                $row->nama_sekolah,
                $row->kota_sekolah,
                $row->prop_sekolah,
                $row->ukuran_baju,
                $row->agama,
                $row->telp,
                $row->asal_informasi,
                $row->Jenjang,
                $row->Nama_Prodi,
                $row->Kelas_Deskripsi,
                $row->Status_Masuk,
                $row->Nama_JalurPenerimaan,
                $row->isDaftar_Ulang                                
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
	}
    
    public function retrieveData1(){
        $this->load->library('datatable'); 
        
        //$tglmulai = $this->input->get('tglmulai');
//        $tglsmp   = $this->input->get('tglsmp');
//
//        if ($tglmulai==''){            
//            $where = " YEAR(daftar.Tgl_DaftarUlang) = YEAR(CURDATE()) AND MONTH(daftar.Tgl_DaftarUlang) = MONTH(CURDATE()) ";
//        }else{
//            $where = " DATE_FORMAT(daftar.Tgl_DaftarUlang,'%Y-%m-%d') between '".$tglmulai."' and '".$tglsmp."' ";            
//        }
                 
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
          	
        $kolom = array('Id_Camaba','Nama_Mhs','Jenjang','Nama_Prodi','Kelas_Deskripsi','Status_Masuk','Nama_JalurPenerimaan','isDaftar_Ulang','options-no-db');        
		$pk = 'Id_Camaba';
		$sql = "
			(
				SELECT                	
                    camaba.Id_Camaba,
                    date_format(daftar.Tgl_DaftarUlang,'%d-%m-%Y')tgl,
                	Nama_Mhs,
                	prodi.Jenjang,
                	prodi.Nama_Prodi,
                	kls.Kelas_Deskripsi,
                	Status_Masuk,
                	jalur.Nama_JalurPenerimaan,
                	IFNULL(daftar.isDaftar_Ulang,'NO') AS isDaftar_Ulang
                FROM
                	tb_pmb_tr_camaba camaba
                INNER JOIN tb_akd_rf_prodi prodi ON camaba.Kode_Prodi = prodi.Kode_Prodi
                LEFT JOIN tb_akd_rf_kelas_mhs kls ON kls.Kelas_Mhs = camaba.Kelas
                LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
                LEFT JOIN tb_pmb_tr_daftar_ulang daftar ON camaba.Id_Camaba=daftar.Id_Camaba
                WHERE
                	camaba.IsDiterima='YES'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$row->Id_Camaba.'")';               		  
			$new_data[] = array(
                $row->tgl,
				$row->Nama_Mhs,				
				$row->Jenjang,
                $row->Nama_Prodi,
                $row->Kelas_Deskripsi,
                $row->Status_Masuk,
                $row->Nama_JalurPenerimaan,
                $row->isDaftar_Ulang,                			
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
        $this->load->helper('rules_helper');
        if(empty($res['NRP_DaftarUlang'])) $res['NRP_DaftarUlang']=getNewNrp($res['Kode_Prodi'],$res['Kelas'],$res['Status_Masuk'],$res['Id_Camaba']);
        $res=filter_column_by_class($this->mydata['page_id'],$res);
        echo json_encode($res);
    }
    public function isNrpUsed(){
        $p=$this->input->post('nrp');
        $data['isExist']=$this->app_model->isNrpExist($p);
        if($data['isExist']){
            $user=$this->input->post('id');
            $data['NRP_DaftarUlang']=$this->app_model->getNrpDraft($user);
            if(empty($data['NRP_DaftarUlang'])){
                $res=$this->app_model->getProfileCamabaById($user);
                $this->load->helper('rules_helper');
                $data['NRP_DaftarUlang']=getNewNrp($res['Kode_Prodi'],$res['Kelas'],$res['Status_Masuk'],$res['Id_Camaba']);   
            }    
        }
        
        echo json_encode($data);
    }
    public function simpan()
	{
        $this->db->trans_begin();
        $p=$this->input->post();
        $p['Tgl_DaftarUlang'] = date("Y-m-d", strtotime($p['Tgl_DaftarUlang']));
        $isDaftarUlangExist=$this->app_model->isDaftarUlang($p['Id_Camaba']);
        
        $key=array(
            'Id_Camaba' => $p['Id_Camaba'],
        );
        
        if($isDaftarUlangExist){
            $data=$p;
            $data=mappingColumn('tb_pmb_tr_daftar_ulang',$data);
            $data=$this->addUpdateLog($data);
            $res1=$this->db->update('tb_pmb_tr_daftar_ulang',$data,$key);
        }else{
            $data=$p;
            $data=mappingColumn('tb_pmb_tr_daftar_ulang',$data);
            $data=$this->addInsertLog($data);
            $res1=$this->db->insert('tb_pmb_tr_daftar_ulang',$data);
        }
        
        if(strtoupper($p['isDaftar_Ulang'])=='YES'){
            $res2=$this->db->update('tb_pmb_tr_camaba',array("NRP"=>$p['NRP_DaftarUlang']),$key);
        }else{
            $res2=$this->db->update('tb_pmb_tr_camaba',array("NRP"=>null),$key);
        }	
        
        if ($this->db->trans_status() === FALSE || !$res1 || !$res2 )
        {
            $this->db->trans_rollback();
            if(!$res1) $res['msg']='Gagal menyimpan data daftar ulang';
            if(!$res2) $res['msg']='Gagal menyimpan perubahan data camaba';
            $res['isSuccess']=false;
        }
        else
        {
            $this->db->trans_commit();
            $p['Email']=$this->app_model->getEmailById($p['Id_Camaba']);
            if(strtolower($data['isDaftar_Ulang'])=='yes'){
                $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],7,13);
                $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Saudara dinyatakan diterima.',"#");
              }
            else
            if(strtolower($data['isDaftar_Ulang'])=='no'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],6,12);
              $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Saudara dinyatakan tidak diterima.',"#");
              }
            $res['isSuccess']=true;    
        }
        echo json_encode($res);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
