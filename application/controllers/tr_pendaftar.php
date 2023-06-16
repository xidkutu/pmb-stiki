<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_pendaftar extends MY_Form_Camaba {

	/**
	 * @author : Ahmad Rianto
	 **/
	
	public function index($key='')
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        $this->mydata['key']=transHtmlCode($key);
        $this->mydata['jsInclude']=getJsIncludeFormByClass('tr_pmb_insert_data');
        $this->mydata['modal']=$this->load->view('tr/pendaftar/modal_password',$this->mydata,true);
        //Load Modal
        
        $this->mydata['content']=$this->load->view('tr/pendaftar/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('datatable');          
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
          	
        $kolom = array('nama','Nama_Prop','Nama_Kota','Asal_SMU','email','telp','tgl','options-no-db');        
		$pk = 'email';
		$sql = "
			(
				SELECT
                	nama,
                	Nama_Prop,
                	Nama_Kota,
                	sklh.Asal_SMU,
                	reg.email,
                	reg.telp,
                    DATE_FORMAT(tgl,'%d/%m/%y') tgl
                FROM
                	tb_pmb_tr_camaba_reg reg
                LEFT JOIN tb_akd_rf_propinsi prop ON reg.Kode_Prop = prop.Kode_Prop
                LEFT JOIN tb_glb_rf_kota kota ON reg.Kode_Kota=kota.Kode_Kota
                LEFT JOIN tb_akd_rf_asal_sekolah sklh ON sklh.Kode_SMU=reg.Kode_SMU 
                WHERE
                	reg.Tahun_Penerimaan='$tahun'				
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$row->email.'","'.$row->nama.'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$row->email.'")';
            $aksiLihat='lihat_'.$this->mydata['page_id'].'("'.$row->email.'")';
            $aksiKartuUjian='kartuUjian_'.$this->mydata['page_id'].'("'.$row->email.'")';
            
			$new_data[] = array(
				$row->nama,				
				$row->Nama_Prop,
                $row->Nama_Kota,
                $row->Asal_SMU,
                $row->email,
                $row->telp,
                $row->tgl,                			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='$aksiLihat'>Lihat Profile</a></li>
                      <li><a href='#' onclick='$aksiKartuUjian'>Kartu Ujian</a></li>
                      <li><a href='#' onclick='ubah_password".$this->mydata['page_id']."(\"".$row->email."\")'>Ubah Password</a></li>
                      <li><a href='#' onclick='$aksiEdit'>Edit</a></li>
                      <li><a href='#' onclick='IjinkanIsiDataDiri(\"".$row->email."\")'>Ijinkan Ulang Isi Data Diri</a></li>
                      <li class='divider'></li>
                      <li><a href='#' onclick='$aksiHapus'>Delete</a>
                      </li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    public function load_profile(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->load->view('application/profile/profile_base',$this->mydata,true);
    }
    public function loadPage(){
        $page=$this->getProfile('camaba');
        echo $page;
    }
    public function getProfileCamaba(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        if(isset($res['pwd'])) unset($res['pwd']);
        $res['tahun_penerimaan']=$this->system_model->getConfigItem('tahun_penerimaan');
        $res['mata_ujian']=$this->app_model->getMataUjianCamaba_Kartu($res['Kode_Prodi']);
        $res['today']=$this->app_model->getTodayByFormat();
        $res['kota_instansi']=$this->system_model->getConfigItem('pt_city');
        $res['tmp_ujian']=$this->system_model->getConfigItem('pt_address');
        $res['waktu_ujian']=$this->app_model->getWaktuUjian($user);
        echo json_encode($res);
    }
    public function load_form(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->genFormCamaba();
    }
    public function load_kartuUjian(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->getKartuUjian();
    }
    public function load_profile_bc(){
        echo $this->load->view('tr/pendaftar/bc_profile',false,true);
    }
    public function load_edit_bc(){
        echo $this->load->view('tr/pendaftar/bc_input',false,true);
    } 
    public function simpan()
	{
	   $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_pmb_rf_asal_informasi",$data);
        if($p['saveas']=='baru'){
            $data['isAktif']='YES';
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_pmb_rf_asal_informasi",$data);   
        }else{
            $key = array(
                'Id_Informasi' => $data['Id_Informasi'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_pmb_rf_asal_informasi',$data,$key);
        }		
		
        echo json_encode($res);
	}
    
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusPendaftar($id);
        
        echo 'succed';
    }
    public function getProfileCamaba_pwd(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        $res=filter_column_by_class('tr_pendaftar',$res);
        $res['StatEmail']=$res['email'];
        $res['pwd']='{-unchanged-}';
        $res['re_pwd']=$res['pwd'];
        echo json_encode($res);
    }
    public function simpan_pwd(){
        $p=$this->input->post();
        if($p['pwd']!='{-unchanged-}'){
            $pwd=",pwd=MD5('".$p['pwd']."')";
        }else $pwd='';
        $res=$this->db->query("UPDATE tb_pmb_tr_camaba_reg SET 
        email='".$p['StatEmail']."'
        ,telp='".$p['telp']."'
        $pwd
        ,Modified_App='".$this->config->item('application_id')."'
        ,Modified_By='".$this->session->userdata('username')."
        ',Modified_Date=NOW() WHERE email='".$p['email']."'");
        if($res){
            $has['isOk']=true;
        }else{
            $has['isOk']=false;
            $has['msg']='Gagal menyimpan perubahan password';
        }
        echo json_encode($has);
    }
    public function ijinkanIsiDataDiri(){
        $this->db->trans_begin();
        $email=$this->input->post('id');
        $id=$this->app_model->getIdCamabaByEmail($email);
        $dataUpdate=array(
            "isUjian"=>"Belum Ditentukan",
            "Jalur_Penerimaan"=>null,
            "IsDiterima"=>null,
            "Tgl_Diterima"=>null,
            "NRP"=>null,
            "isCanChange"=>"YES"
        );
        $dataUpdate=$this->addUpdateLog($dataUpdate);
        $res1=$this->db->update('tb_pmb_tr_camaba',$dataUpdate,array("Id_Camaba"=>$id));
        $res2=$this->db->delete('tb_pmb_tr_ujian_masuk',array("Id_Camaba"=>$id));
        $res3=$this->db->delete('tb_pmb_tr_daftar_ulang',array("Id_Camaba"=>$id));
        $res4=$this->app_model->updateLangkahPendaftaranCamaba($email,2,5);
        if($this->db->trans_status() === FALSE || !$res1 || !$res2 || !$res3 || !$res4){
            $this->db->trans_rollback();
            $res['isOk']=false;
            if(!$res1) $res['msg']='Gagal menghapus jalur penerimaan dan penerimaan mahasiswa';
            if(!$res2) $res['msg']='Gagal menghapus setting ujian';
            if(!$res3) $res['msg']='Gagal menghapus proses daftar ulang';
            if(!$res3) $res['msg']='Gagal memperbaharui langkah daftar';
        }else{
            $this->db->trans_commit();
            $res['isOk']=true;
        }
        echo json_encode($res);
        
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
