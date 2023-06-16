<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_pmb_insert_data extends MY_Form_Camaba {

	public function index()
	{
        $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user));
        $this->session->unset_userdata('my_berkas_files');
        if($this->app_model->isBayarDaftarExist($this->session->userdata('username'))){
            if($this->app_model->isProfileCanChange($cur_user)){
                $this->mydata['content']=$this->genFormCamaba();    
            }else
                $this->mydata['content']=$this->load->view('tr/pmb_insert_data/msg_nochanged',array(),true);
        }else{
            $this->mydata['content']=$this->load->view('tr/pmb_insert_data/msg_blm_bayar',array(),true);
        }
        
        $this->load->view('main_page',$this->mydata);
	}
    public function preFill(){
        $email=$this->session->userdata('cur_user');
        
        $data=$this->app_model->getProfileCamaba($email);
        $data=array_filter($data);
        echo json_encode($data);
    }
    
    public function reloadDraft(){
        $email=$this->session->userdata('cur_user');
        
        $data=$this->app_model->getDraftCamaba($email);
        $data=array_filter($data);
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
    public function getDaftarSMA(){
        $id=$this->input->post('kota');
        $city=$this->app_model->getListOfSmaByKota($id);
        
        $res='<option value="">--Pilih--</option>';
        foreach($city->result() as $c){
            $res.='<option value="'.$c->Kode_SMU.'">'.$c->Asal_SMU.' - '.$c->Alamat_SMU.'</option>';
        }
        
        $d['smu']=$res;
        
        echo json_encode($d);
    }
    public function generateProdi(){
        $id = $this->input->post('jenjang');
                
		$data = $this->app_model->getListOfProdyByJenjang($id);
        $options="<option value=''>-PILIH-</option>";
            foreach($data->result() as $db){
                $options.="<option value='$db->Kode_Prodi'>$db->Nama_Prodi</option>";
			}
        $d['options']=$options;
        echo json_encode($d);
    }
    public function getDaftarProdiPTAsal(){
        $p=$this->input->post();
        $data=$this->app_model->getListOfProdiPTAsal($p);
        
        $res='<option value="">--Pilih--</option>';
        foreach($data->result() as $c){
            $res.='<option value="'.$c->Kode_Prodi.'">'.$c->Nama_Prodi.'</option>';
        }
        
        $d['prodi']=$res;
        
        echo json_encode($d);
    }
    public function getSyaratDaftar(){
        $p=$this->input->post();
        $data=$this->app_model->getListOfSyaratByJalurDaftar($p);
        
        $res='';
        foreach($data->result_array() as $i=>$c){
            $res.='<li class="list-group-item">
					<span class="fa fa-check"></span> '.($i+1).'. '.$c['Detail_SyaratDaftar'].'
				</li>';
        }
        $ret['syarat']=$res;
        
        $dataBerkas['data']=$this->app_model->getListOfBerkas($p);
        $dataBerkas['uploaded']=$this->app_model->getUploadedBerkas($this->session->userdata('cur_user'));
        $dataBerkas['max_filesize']=$this->system_model->getConfigItem('berkas_max_filesize');
        $res=$this->load->view('tr/pmb_insert_data/uploader',$dataBerkas,true);
        $ret['berkas']=$res;
        
        echo json_encode($ret);
    }
    
    public function isDraftExist(){
        $username=$this->session->userdata('username');
        $email=$this->session->userdata('cur_user');
        if(empty($email)) $email=$username;
        $res=$this->app_model->isDraftCamabaExist($username,$email);
        if($res->num_rows()>0){
            $data['isExist']=true;
            $res=$res->row_array();
            $data['tgl']=$res['Tgl'];
        }else
            $data['isExist']=false;
        echo json_encode($data);
    }
    
    public function simpan(){
        $this->db->trans_begin();
        $this->load->helper('rules_helper');
        
        $p=$this->input->post();
        $data=mappingColumn('tb_pmb_tr_camaba',$p);
        $data['Kode_Prodi']=NULL;
        if($data['Warga_Negara']=='WNI') $data['Kewarganegaraan']='IDN';
        if($data['Jumlah_Saudara_Kandung']==0) $data['Jumlah_Saudara_Kandung']='0';
        $data['Tgl_Daftar']=$this->app_model->getToday();
        $periode=$this->app_model->getActivePeriod($data['Kode_Prodi'],$data['Kelas']);
        $data['Tahun_Masuk']=$this->system_model->getConfigItem('tahun_penerimaan');
        $data['Semester_Masuk']=$periode['Semester'];
        $data['Media_Daftar']='Offline';
        if(!empty($data['Tgl_Lahir']))
            $data['Tgl_Lahir'] = date("Y-m-d", strtotime($data['Tgl_Lahir']));
        if(!empty($data['Tgl_Lahir_Ayah']))
            $data['Tgl_Lahir_Ayah'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Ayah']));
        if(!empty($data['Tgl_Lahir_Ibu']))
            $data['Tgl_Lahir_Ibu'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Ibu']));
        if(!empty($data['Tgl_Lahir_Wali']))
            $data['Tgl_Lahir_Wali'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Wali']));
        
        $data['Tgl_Lulus'] = date("Y-m-d", strtotime($data['Tgl_Lulus']));  
        $data['JK']=$p['JK_Mhs'];
        $data['ID_File_Photo']=$this->session->userdata('idFile');
        if($this->app_model->isCamabaExist($data['Email'])){
            $data=$this->addUpdateLog($data);
            $data=array_filter($data);
            $key=array('Email'=>$data['Email']);
            $res1=$this->db->update('tb_pmb_tr_camaba',$data,$key);
        }else{
            $data=$this->addInsertLog($data);
            $data=array_filter($data);
            //$data['Nomer_Tes']=getNewNoTes($data['Kode_Prodi'],$data['Jalur_Penerimaan']);
            $res1=$this->db->insert('tb_pmb_tr_camaba',$data);    
        }
        
        $this->db->update('tb_pmb_tr_camaba_reg',array('Kode_SMU'=>$data['Kode_SMU']),array('email'=>$data['Email']));
        
        $berkas=$this->session->userdata('my_berkas_files');
        $berkas=json_decode($berkas,true);
        
        if(is_array($berkas) && count($berkas)>0){
            $newBerkas=array();
            foreach($berkas as $i=>$b){
                $newBerkas[$i]['Username_Camaba']=$b['Username_Camaba'];
                $newBerkas[$i]['Id_Files']=$b['Id_Files'];
                $newBerkas[$i]['id_berkas']=$b['id_berkas'];
                $newBerkas[$i]=$this->app_model->addInsertLog($newBerkas[$i]);
            }
            $res2=$this->db->insert_batch('tb_pmb_tr_berkas_camaba',$newBerkas);
        }else $res2=true;
        
        $deletedBerkas=$this->input->post('deletedBerkas');
        $delBerkas=explode('-',$deletedBerkas);
        if(count($delBerkas)>0){
            foreach($delBerkas as $del){
                $path=$this->system_model->getDetailFiles($del);
                if(isset($path) && !empty($path['fullPath'])){
                    if($this->is_url_exist($path['fullPath'])) {
                        $this->delFile($path['ftpPath']);   
                    }   
                }
                $res3=$this->app_model->hapusBerkasCamaba($data['Email'],$del);
                $res4=$this->system_model->files_del($del);
            }
        }
        
        $id_cam=$this->db->query("SELECT Id_Camaba FROM tb_pmb_tr_camaba WHERE Email='".$p['Email']."'")->row_array();
        $id_cam=$id_cam['Id_Camaba'];
        
        $now=$this->app_model->getTodayAsString();
        if(!empty($p['Kode_Prodi1'])) $opt[]=array(
                'id_camaba'=>$id_cam,
                'pilihan_ke'=>'1',
                'prodi'=>$p['Kode_Prodi1'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
            );
        if(!empty($p['Kode_Prodi2'])) $opt[]=array(
                'id_camaba'=>$id_cam,
                'pilihan_ke'=>'2',
                'prodi'=>$p['Kode_Prodi2'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
           );
        if(!empty($p['Kode_Prodi3'])) $opt[]=array(
                'id_camaba'=>$id_cam,
                'pilihan_ke'=>'3',
                'prodi'=>$p['Kode_Prodi3'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
            );
        $this->db->query("DELETE FROM tb_pmb_tr_pilihan_prodi WHERE id_camaba='".$id_cam."'");
        if(!empty($opt))$this->db->insert_batch('tb_pmb_tr_pilihan_prodi',$opt);
        
        $res5=$this->app_model->removeDraft($this->session->userdata('username'),$data['Email']);
        
        if ($this->db->trans_status() === FALSE || !$res1 || !$res2 || !$res3 || !$res4 || !$res5)
        {
            $this->db->trans_rollback();
            if(!$res1) $res['msg']='Gagal menyimpan perubahan data';
            if(!$res2) $res['msg']='Gagal menambahkan file berkas';
            if(!$res3 || !$res4) $res['msg']='Gagal menghapus file berkas';
            if(!$res5) $res['msg']='Gagal menghapus draft';
            $res['isSuccess']=false;
        }
        else
        {
            $this->db->trans_commit();
            $this->session->unset_userdata('my_berkas_files');
            if($this->session->userdata('role')=='camaba' && $data['isCanChange']=='NO'){
                $this->system_model->writeNotifForUserOnGroupOfRole($this->config->item('application_id'),$this->system_model->getConfigItem('target_group_role_isidatadiri'),
                $this->session->userdata('nama_lengkap').' telah melengkapi biodata diri.',base_url().'index.php/tr_pendaftar/index/'.specialCharToHtmlCode($data['Email']));
                $this->app_model->updateLangkahPendaftaranCamaba($this->session->userdata('username'),4,9);
            }
            $res['isSuccess']=true;    
        }
        echo json_encode($res);
	}
    
    public function discardDraft(){
        $res5=$this->app_model->removeDraft($this->session->userdata('username'),$this->session->userdata('cur_user'));
        if ($this->db->trans_status() === FALSE || !$res5)
        {
            $this->db->trans_rollback();
            if(!$res5) $res['msg']='Gagal menghapus draft';
            $res['isSuccess']=false;
        }
        else
        {
            $this->db->trans_commit();
            $res['isSuccess']=true;    
        }
        echo json_encode($res);
    }
    
    public function simpan_draft(){
        $this->db->trans_begin();
        $this->load->helper('rules_helper');
        
        $p=$this->input->post();
        $data=mappingColumn('tb_pmb_tr_camaba',$p);
        $data['Kode_Prodi']=$p['Kode_Prodi1'];
        if($data['Warga_Negara']=='WNI') $data['Kewarganegaraan']='IDN';
        if($data['Jumlah_Saudara_Kandung']==0) $data['Jumlah_Saudara_Kandung']='0';
        $data['Tgl_Daftar']=$this->app_model->getToday();
        $periode=$this->app_model->getActivePeriod($data['Kode_Prodi'],$data['Kelas']);
        $data['Tahun_Masuk']=$periode['Tahun'];
        $data['Semester_Masuk']=$periode['Semester'];
        $data['Media_Daftar']='Offline';
        if(!empty($data['Tgl_Lahir']))
            $data['Tgl_Lahir'] = date("Y-m-d", strtotime($data['Tgl_Lahir']));
        if(!empty($data['Tgl_Lahir_Ayah']))
            $data['Tgl_Lahir_Ayah'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Ayah']));
        if(!empty($data['Tgl_Lahir_Ibu']))
            $data['Tgl_Lahir_Ibu'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Ibu']));
        if(!empty($data['Tgl_Lahir_Wali']))
            $data['Tgl_Lahir_Wali'] = date("Y-m-d", strtotime($data['Tgl_Lahir_Wali']));
        if(!empty($data['Tgl_Lulus']))
            $data['Tgl_Lulus'] = date("Y-m-d", strtotime($data['Tgl_Lulus']));
          
        $data['JK']=$p['JK_Mhs'];
        $data['user_username']=$this->session->userdata('username');
        $data['ID_File_Photo']=$this->session->userdata('idFile');
        if($this->app_model->isCamabaDraftExist($this->session->userdata('username'),$data['Email'])){
            $data=$this->addUpdateLog($data);
            $data=array_filter($data);
            $key=array('Email'=>$data['Email'],'user_username'=>$this->session->userdata('username'));
            $res1=$this->db->update('tb_pmb_tr_camaba_draft',$data,$key);
        }else{
            $data=$this->addInsertLog($data);
            $data=array_filter($data);
            //$data['Nomer_Tes']=getNewNoTes($data['Kode_Prodi'],$data['Jalur_Penerimaan']);
            $res1=$this->db->insert('tb_pmb_tr_camaba_draft',$data);    
        }
        //simpan pilihan prodi
        $now=$this->app_model->getTodayAsString();
        if(!empty($p['Kode_Prodi1'])) $opt[]=array(
                'user_username'=>$p['Email'],
                'pilihan_ke'=>'1',
                'prodi'=>$p['Kode_Prodi1'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
            );
        if(!empty($p['Kode_Prodi2'])) $opt[]=array(
                'user_username'=>$p['Email'],
                'pilihan_ke'=>'2',
                'prodi'=>$p['Kode_Prodi2'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
           );
        if(!empty($p['Kode_Prodi3'])) $opt[]=array(
                'user_username'=>$p['Email'],
                'pilihan_ke'=>'3',
                'prodi'=>$p['Kode_Prodi3'],
                'Created_App'=>$this->config->item('application_id'),
                'Created_By'=>$this->session->userdata('username'),
                'Created_Date'=>$now 
            );
        $this->db->query("DELETE FROM tb_pmb_tr_pilihan_prodi_draft WHERE user_username='".$p['Email']."'");
        if(!empty($opt))$this->db->insert_batch('tb_pmb_tr_pilihan_prodi_draft',$opt);
        //Syarat Daftar
        //$syaratDaftar=explode(',',$p['syaratDaftar']);
//        foreach($syaratDaftar as $i=>$s){
//            $syarat=explode('is',$s);
//            $syaratCamaba[$i]['Id_Camaba']='1';
//            $syaratCamaba[$i]['Id_SyaratDaftar']=$syarat[0];
//            $syaratCamaba[$i]['is_Passed']=$syarat[1];
//            $syaratCamaba[$i]=$this->addInsertLog($syaratCamaba[$i]);
//        }
        //$res2=$this->db->insert_batch('tb_pmb_tr_syaratdaftar_camaba',$syaratCamaba);
        if ($this->db->trans_status() === FALSE || !$res1)
        {
            $this->db->trans_rollback();
            if(!$res1) $res['msg']='Gagal menyimpan draft data';
            $res['isSuccess']=false;
        }
        else
        {
            $this->db->trans_commit();
            $res['isSuccess']=true;    
        }
        echo json_encode($res);
	}
    
    public function delFile($path){
        $config['hostname'] = $this->config->item('ftp_host');
        $config['username'] = $this->config->item('ftp_username');
        $config['password'] = $this->config->item('ftp_password');
        $config['debug']	= TRUE;
        
        $this->ftp->connect($config);
        //echo $ftpPath;
        $this->ftp->delete_file($path);
        
        return $this->ftp->close();
    }
    
    public function cekFileUploaded(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/photo/'.$result['namaUploaded'];
        
        echo json_encode($result);
    }
    
    public function showUploader(){
        $this->load->view('tr/pmb_insert_data/uploader');
    }
    
    public function showUploaderBerkas(){
        $this->load->view('tr/pmb_insert_data/uploader_berkas');
    }
    
      public function saveFileBerkas(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            /** Inserting Data Program Studi **/
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/file_berkas/';
    		$config['allowed_types'] = 'bmp|jpg|png';
            //$config['allowed_types'] ='*';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'].'';
		 	    
                $sess_file['oploaded_berkas']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('tr/pmb_insert_data/upload_berkas_sukses', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded_berkas']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('tr/pmb_insert_data/upload_berkas_sukses', $d);
    		}
    }
    }
    
    public function saveFile(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            /** Inserting Data Program Studi **/
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/photo/';
    		$config['allowed_types'] = '7zip|zip|rar|bmp|jpg|png';
            //$config['allowed_types'] ='*';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'].'';
		 	    
                $sess_file['oploaded']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('tr/pmb_insert_data/upload_success', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('tr/pmb_insert_data/upload_success', $d);
    		}
    }
    }    

    public function detailSekolah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('id');  //$this->uri->segment(3);
			
            $text = "SELECT
                        Alamat_SMU,
                        Kota_SMU,
                        Telp,
                        Email
                     FROM
                        tb_akd_rf_asal_sekolah         	
                WHERE Kode_SMU='$id'"; 
                    
			$data = $this->app_model->manualQuery($text);
            if($data->num_rows()==0){
                $d['recNum']='0';
            }else
            {  foreach($data->result() as $db){
                    $d['Alamat_SMU']=$db->Alamat_SMU;
                    $d['Kota_SMU']=$db->Kota_SMU;
                    $d['Telp']=$db->Telp;
                    $d['Email']=$db->Email;
                    $d['recNum']='1';
				}
                } 
            echo json_encode($d);
		
		}else{
			header('location:'.base_url());
		}
	}
    
    public function uploadavatar(){
        $namafile = $this->session->userdata('username');
        
        $options = array(
                	'upload_dir' => $this->config->item('file_loc_img'),
                    'upload_url' => base_url().'assets/documents/images/',
                	'accept_file_types' => 'png|jpg|jpeg|gif',
                	'mkdir_mode' => 0777,
                	'max_file_size' => null,
                    'min_file_size' => 1,
                    'max_width'  => null,
                    'max_height' => null,
                    'min_width'  => 1,
                    'min_height' => 1,
                    'load' => function($instance) {
                    	//return 'avatar.jpg';
                    },
                    'delete' => function($filename, $instance) {
                    	return true;
                    },
                	'upload_start' => function($image, $instance) {
                	    $CI =& get_instance();
                        $CI->load->library("session");
                        $parts = explode("@", $CI->session->userdata('username'));
                        $username = $parts[0];
                		$image->name = $username . md5(date('mdY')).'.' . $image->type;		
                	},
                	'upload_complete' => function($image, $instance) {
                	},
                	'crop_start' => function($image, $instance) {
                	    $CI =& get_instance();
                        $CI->load->library("session");
                        $parts = explode("@", $CI->session->userdata('username'));
                        $username = $parts[0];
                        $prop=$this->input->post();
                		$image->name = $username .md5(date('mdY')). '.' . $image->type;
                        $this->doCrop($prop,$username . md5(date('mdY')), '.'.$image->type);
                	},
                	'crop_complete' => function($image, $instance) {
                	   $CI =& get_instance();
                        $CI->load->library("session");
                        $parts = explode("@", $CI->session->userdata('username'));
                        $username = $parts[0];
                        $prop=$this->input->post();
                        $this->createThumb($prop,$username . md5(date('mdY')), '.'.$image->type);
                	}
                );
        $this->load->library('imgpicker',$options);
    }
    
    public function doCrop($prop,$filename,$etx){
        $ratio=$this->system_model->getConfigItem('img_aspect_ratio');
        $loc=$this->config->item('file_loc_img');
        $newImg=$loc.$filename.'-avatar'.$etx;
        copy($loc.$prop['image'],$newImg);
        
        $imgSize= getimagesize($newImg);
        //var_dump($imgSize);
        $w=$ratio*$prop['coords']['h'];
        $h=$prop['coords']['h'];
        $x=$prop['coords']['x'];
        $y=$prop['coords']['y'];
        
        if(($x+$w)>$imgSize[0]){
            $x=$imgSize[0]-$w;
        }
        
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']	= $newImg;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width']	= $w;
        $config['height']	= $h;
        $config['x_axis'] = $x;
        $config['y_axis'] = $y;
        
        $this->image_lib->initialize($config); 
        
        if ( ! $this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        } 
    }
    
    public function createThumb($prop,$filename,$etx){
        $loc=$this->config->item('file_loc_img');
        $newImg=$loc.$filename.'-thumb'.$etx;
        copy($loc.$filename.$etx,$newImg);
        
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']	= $newImg;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width']	= $prop['coords']['w'];
        $config['height']	= $prop['coords']['w'];
        $config['x_axis'] = $prop['coords']['x'];;
        $config['y_axis'] = $prop['coords']['y'];
        
        $this->image_lib->initialize($config); 
        
        if ( ! $this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        } 
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
        echo json_encode($res);
    }
    public function getFileNamaFromURL($fileurl){
        $filename=explode('/',$fileurl);
        $filename=end($filename);
        return $filename;
    }
    public function load_profile_bc(){
        echo $this->load->view('tr/pmb_insert_data/bc_profile',false,true);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
