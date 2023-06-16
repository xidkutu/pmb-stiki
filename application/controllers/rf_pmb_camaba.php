<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_camaba extends MY_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman camaba
	 **/
     
    public function cekFileUploadedBerkas(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/berkas/'.$result['namaUploaded'];
       $this->session->unset_userdata('oploaded'); 
        echo json_encode($result);        
    }  
    
    public function showUploaderBerkas(){
        $this->load->view('rf/camaba/uploader_berkas');
    }
    
        public function saveFileBerkas(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/berkas/';
    		$config['allowed_types'] = 'rar|zip|bmp|jpg|png';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'].'asdasdada';
		 	    
                $sess_file['oploaded']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('rf/camaba/upload_berkas_sukses', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('rf/camaba/upload_berkas_sukses', $d);
    		}
    }
    }
     
     /*-------------------------------------------------------------------------------------*/   
	
    public function cekFileUploaded(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/photo/'.$result['namaUploaded'];
       $this->session->unset_userdata('oploaded'); 
        echo json_encode($result);
    }
    
    public function showUploader(){
        $this->load->view('rf/camaba/uploader');
    }
      
    public function saveFile(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            /** Inserting Data Program Studi **/
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/photo/';
    		$config['allowed_types'] = 'bmp|jpg|png';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'].'asdasdada';
		 	    
                $sess_file['oploaded']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('rf/camaba/upload_success', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('rf/camaba/upload_success', $d);
    		}
    }
    }
    
    
    public function cari(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $cari = $this->input->post('txt_cari');
            
            $sess_cari['class']='rf_pmb_camaba';
            $sess_cari['keyword']=$cari;
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_camaba');
        }
    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='rf_pmb_camaba';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_camaba');
        }
    }
    
    public function getDataFromDB($table,$id,$idField,$resultField){
        $temp = $this->app_model->getDataFromDB($table,$id,$idField,$resultField);
        $result=$temp->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0][$resultField];   
        }
        return $hasil;
    }
    
   
    public function today(){
        $temp = $this->app_model->getToday();
        $result = $temp->result_array();
        
        $today='';
        if (count($result)!=0){
            $today = $result[0]['today'];   
        }
        return $today;
    }
    
//    public function getBatasStudi($batas){
//        if(strlen($batas)==5){
//        $batasStudi = substr($batas,0,4);
//        $sems= substr($batas,4,1);
//        if($sems=='1'){
//            $resSems = 'Ganjil';
//        }else
//        if($sems=='2'){
//            $resSems = 'Genap';
//        }else
//        if($sems=='3'){
//            $resSems = 'Periode 1';
//        }else
//        if($sems=='4'){
//            $resSems = 'Periode 2';
//        }else
//        if($sems=='5'){
//            $resSems = 'Periode 3';
//        }else
//            $resSems = 'Lainnya';
//        $result = $batasStudi.' '.$resSems;
//        return $result;
//        }else
//        return false;
//    }
    
	public function index()
	{
		$this->mydata['content']=$this->load->view('application/dashboard/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
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
    
    public function detail()
	{
	   
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$idCamaba = $this->input->post('Id_Camaba');  //$this->uri->segment(3);
			
             
            $text = "SELECT
                        Id_Camaba,
                    	Nomer_Tes,
                        Nama_Prodi,
                    	Nama_Jenjang,
                    	Kelas,
                    	NRP,
                    	Nama_Mhs,
                    	JK,
                    	Tlp_HP,
                        DATE_FORMAT(m.Tgl_Masuk, '%d-%m-%Y') AS Tgl_Masuk,
                        Jalur_Masuk,
                        prov.Kode_Prop,
                        Anak_ke,
                        Jumlah_Saudara_Kandung,
                        Warga_Negara,
                    	Status_Masuk,
                    	Tahun_Masuk,
                    	Semester_Masuk,
                    	Batas_Studi,
                       	JK,
                    	URL_Foto,
                    	ag.Agama_id,
                        jrs.Id_Jurusan,
                        Total_Nilai_UAN,
                        info.Id_Informasi,
                        Status_Reg,
                        Status_Daftar,
                        Status_Camaba,
                       	m.Alamat,
                    	m.Kota,
                    	Alamat_Asl,
                    	Kota_Asl,
                    	m.Tempat_Lahir,
                    	DATE_FORMAT(m.Tgl_Lahir, '%d-%m-%Y') AS Tgl_Lahir,
                    	m.Telp,
                    	m.Tlp_HP,
                    	m.Email,
                    	Kd_pekerjaan_mhs,
                    	Nama_Kantor,
                    	Alamat_Kantor,
                    	Telp_Kantor,
                    	Nama_Ayah,
                    	No_KTP_Ayah,
                    	Nama_Ibu,
                    	No_KTP_Ibu,
                    	Alamat_Ortu,
                    	Kota_Ortu,
                    	Kd_Pekerjaan_Ayah,
                    	Kd_Pekerjaan_Ibu,
                    	Telp_Ortu,
                    	Telp_HP_Ortu,
                    	Nama_Wali,
                    	No_KTP_Wali,
                    	Alamat_Wali,
                    	Kota_Wali,
                    	Kd_Pekerjaan_Wali,
                    	Telp_Wali,
                    	Telp_HP_Wali,
                    	s.Asal_SMU,
                    	s.Alamat_SMU,
                    	s.Kota_SMU,
                    	s.Telp AS Telp_SMU,
                    	s.Email AS Email_SMU,
                        URL_File_berkas,
                        Pas_Photo,
                        SKHUN,
                        Akte_Kelahiran,
                        Ijazah,
                        Rapor
                    FROM
                      (
                        (
                           (
                              (
                                 (
                                    (
                                       (
                                          (
		                                     (
		                                        (
       							                  tb_pmb_camaba m INNER JOIN tb_akd_rf_prodi p ON m.Kode_Prodi = p.Kode_Prodi
		                                       )
           				 	                   INNER JOIN tb_akd_rf_jenjang j ON p.Jenjang = j.Kode_Jenjang             					
                                           )
       		                                INNER JOIN tb_peg_rf_agama ag ON m.Agama_id = ag.Agama_id
                	                   )
                                        INNER JOIN tb_akd_rf_asal_sekolah s ON m.kode_SMU = s.kode_SMU
                                     )
                                     INNER JOIN tb_pmb_asal_informasi info ON m.Id_Informasi = info.Id_Informasi   
                                  )
                                  INNER JOIN tb_akd_rf_propinsi prov ON m.Kode_Prop = prov.Kode_Prop  
                               )
                               LEFT JOIN tb_akd_rf_pekerjaan pka ON m.Kd_Pekerjaan_Ayah = pka.Kd_Pekerjaan
                             ) 
                             LEFT JOIN tb_akd_rf_pekerjaan pki ON m.Kd_Pekerjaan_Ibu = pki.Kd_Pekerjaan                
                           )
                           LEFT JOIN tb_akd_rf_pekerjaan pkw ON m.Kd_Pekerjaan_Wali = pkw.Kd_Pekerjaan 
                        )  
                        LEFT JOIN tb_akd_rf_pekerjaan pkm ON m.Kd_pekerjaan_mhs = pkm.Kd_Pekerjaan            
                      )
                      INNER JOIN tb_pmb_rf_jurusan jrs ON m.Id_Jurusan = jrs.Id_Jurusan            
                    
                    WHERE Id_Camaba='$idCamaba'"; 
                   //echo $text;  
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['Id_Camaba']=$db->Id_Camaba;
                    $d['NRP']=$db->NRP;
                    $d['Nomer_Tes']=$db->Nomer_Tes;                    
                    $d['Prodi']=$db->Nama_Prodi;
                    $d['Kelas']=$db->Kelas;
                    
                    if($db->Kelas=='R'){
                        $d['Kelas']='Regular';   
                    }else
                    if($db->Kelas=='N')
                    {
                        $d['Kelas']='Non Reguler';
                    }else
                    if($db->Kelas=='K'){
                        $d['Kelas']='Kerjasama';
                    }
                    
                   $d['Tgl_Masuk']=$db->Tgl_Masuk;
                   
                   $d['Jalur']=$db->Jalur_Masuk;
                   if($db->Jalur_Masuk=='Undangan'){
                        $d['Jalur']='Undangan';   
                    }else
                    if($db->Jalur_Masuk=='BP')
                    {
                        $d['Jalur']='Beasiswa Penuh';
                    }else
                    if($db->Jalur_Masuk=='PA'){
                        $d['Jalur']='Prestasi Akademik/Non Akademik';
                    }else
                    if($db->Jalur_Masuk=='Reguler')
                    {
                        $d['Jalur']='Reguler';
                    }
                                      
                   $d['Tahun_Masuk']=$db->Tahun_Masuk; //.' '.$db->Semester_Masuk;                    
                   $d['Semester_Masuk']=$db->Semester_Masuk;
                   $d['Status_Masuk']=$db->Status_Masuk;
                   $d['Batas_Studi']=$db->Batas_Studi;
                   
                   $d['Nama_Mhs']=$db->Nama_Mhs;
                   $d['Alamat']=$db->Alamat;
                   $d['Kota_Mhs']=$db->Kota;
                   $d['Alamat_Asal_Mhs']=$db->Alamat_Asl;
                   $d['Kota_Asal_Mhs']=$db->Kota_Asl;
                   $d['Provinsi']=$this->getDataFromDB('tb_akd_rf_propinsi',$db->Kode_Prop,'Kode_Prop','Nama_Prop');
                   $d['JK']=$db->JK;
                   
                    if($db->JK=='L'){
                        $d['JK']='Laki-laki';   
                    }else
                    if($db->JK=='P')
                    {
                        $d['JK']='Perempuan';
                    }
                   
                   $d['Tempat_Lahir']=$db->Tempat_Lahir;
                   $d['Tanggal_Lahir']=$db->Tgl_Lahir;                   
                   
                   $d['Anak_ke']=$db->Anak_ke;
                   $d['jmlsdr']=$db->Jumlah_Saudara_Kandung;
                   $d['wn']=$db->Warga_Negara;
                   $d['Agama']=$this->getDataFromDB('tb_peg_rf_agama',$db->Kode_Prop,'Agama_id','Agama');
                   
                    if($db->URL_Foto=='' || @getimagesize($db->URL_Foto)==false){
                        if($db->JK=='P'){
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Women.png');}
                        else {
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Men.png');
                        }
                    }else
                    {
                        $d['URL_Photo']=$db->URL_Foto;
                    }
                                
                    $d['Telepon']=$db->Telp;
                    $d['HP']=$db->Tlp_HP;
                    $d['Email']=$db->Email;
                    
                    $d['Jurusan']=$this->getDataFromDB('tb_pmb_rf_jurusan',$db->Id_Jurusan,'Id_Jurusan','Nama_Jurusan');
                    $d['Nilai_UAN']=$db->Total_Nilai_UAN;
                    $d['Asal_Informasi']=$this->getDataFromDB('tb_pmb_asal_informasi',$db->Id_Informasi,'Id_Informasi','Nama_Informasi');
                    
                    $d['Pekerjaan_Mhs']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_pekerjaan_mhs,'Kd_Pekerjaan','Pekerjaan');
                    $d['Nama_Kantor']=$db->Nama_Kantor;
                    $d['Alamat_Kantor']=$db->Alamat_Kantor;
                    $d['Telp_Kantor']=$db->Telp_Kantor;
                    $d['Status_Registrasi']=$db->Status_Reg;
                    $d['Status_Daftar']=$db->Status_Daftar;
                    $d['Status_Camaba']=$db->Status_Camaba;
                    
                    $d['Nama_Ayah']=$db->Nama_Ayah;
                    $d['No_KTP_Ayah']=$db->No_KTP_Ayah;
                    $d['Pekerjaan_Ayah']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Ayah,'Kd_Pekerjaan','Pekerjaan');
                    
                    $d['Nama_Ibu']=$db->Nama_Ibu;
                    $d['No_KTP_Ibu']=$db->No_KTP_Ibu;
                    $d['Pekerjaan_Ibu']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Ibu,'Kd_Pekerjaan','Pekerjaan');
                    
                    $d['Alamat_Ortu']=$db->Alamat_Ortu;
                    $d['Kota_Ortu']=$db->Kota_Ortu;
                    $d['Telp_Ortu']=$db->Telp_Ortu;
                    $d['Telp_HP_Ortu']=$db->Telp_HP_Ortu;
                    
                    $d['Nama_Wali']=$db->Nama_Wali;
                    $d['No_KTP_Wali']=$db->No_KTP_Wali;
                    $d['Pekerjaan_Wali']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Wali,'Kd_Pekerjaan','Pekerjaan');
                    $d['Alamat_Wali']=$db->Alamat_Wali;
                    $d['Kota_Wali']=$db->Kota_Wali;
                    $d['Telp_Wali']=$db->Telp_Wali;
                    $d['Telp_HP_Wali']=$db->Telp_HP_Wali;
                    
                    $d['Nama_SMU']=$db->Asal_SMU;
                    $d['Alamat_SMU']=$db->Alamat_SMU;
                    $d['Kota_SMU']=$db->Kota_SMU;                	
                	$d['Telp_SMU']=$db->Telp;
                	$d['Email_SMU']=$db->Email;
                    
                    $d['Pas_Photo']=$db->Pas_Photo;
                    $d['SKHUN']=$db->SKHUN;
                    $d['Akte_Kelahiran']=$db->Akte_Kelahiran;                	
                	$d['Ijazah']=$db->Ijazah;
                	$d['Rapor']=$db->Rapor;
                    
                    $d['berkas']=$db->URL_File_berkas;
				}       
                
                $text="SELECT Bahan_Ujian FROM tb_pmb_camaba camaba INNER JOIN tb_pmb_tes tes ON camaba.Kode_Prodi=tes.Kode_Prodi WHERE Id_Camaba='$idCamaba'";
                $res=$this->db->query($text);
                $ujian='';
                foreach($res->result() as $t){
                    $ujian.='*'.$t->Bahan_Ujian.'<br />';
                }
                $d['ujian']=$ujian;
                echo json_encode($d);
	         }else{
			$d['signout']='YES';
            echo json_encode($d);
           
		}
          }
           
                 
    public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){ 
            $idCamaba = $this->input->post('Id_Camaba');  //$this->uri->segment(3);
			
             
            $text = "SELECT 
                        Id_Camaba,
                        Nomer_Tes,
                        Kode_Prodi,
                        Kelas,
                        NRP, 
                        Nama_Mhs,
                        JK,
                        Tlp_HP,
                        Tgl_Masuk,
                        Kode_Prop,
                        Anak_ke,
                        Jumlah_Saudara_Kandung,
                        Warga_Negara,
                        Status_Masuk,
                        Tahun_Masuk,
                        Semester_Masuk,
                        Batas_Studi,
                        URL_Foto,
                        Agama_id,
                        Id_Jurusan,
                        Total_Nilai_UAN,
                        Id_Informasi,
                        Status_Reg,
                        Status_Daftar,
                        Jalur_Masuk,
                        Alamat,
                        Kota,
                        Alamat_Asl,
                        Kota_Asl,
                        Tempat_Lahir,
                        Tgl_Lahir,                                                              
                        Telp,
                        Email,
                        Kd_pekerjaan_mhs,
                        Nama_Kantor,
                        Alamat_Kantor,
                        Telp_Kantor,
                        Nama_Ayah,
                        No_KTP_Ayah,
                        Nama_Ibu,
                        No_KTP_Ibu,
                        Alamat_Ortu,
                        Kota_Ortu,
                        Kd_Pekerjaan_Ayah,
                        Kd_Pekerjaan_Ibu,
                        Telp_Ortu,
                        Telp_HP_Ortu,
                        Nama_Wali,
                        No_KTP_Wali,
                        Alamat_Wali,
                        Kota_Wali,
                        Kd_Pekerjaan_Wali,
                        Telp_Wali,
                        Telp_HP_Wali,
                        Kode_SMU,
                        
                        Pas_Photo,
                        SKHUN,
                        Akte_Kelahiran,
                        Ijazah,
                        Rapor
                    FROM
                        tb_pmb_camaba                	
                WHERE Id_Camaba='$idCamaba'"; 
                    
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['Id_Camaba']=$db->Id_Camaba;
                    $d['Nomer_Tes']=$db->Nomer_Tes;
                    $d['NRP']=$db->NRP;
                    $d['Prodi']=$db->Kode_Prodi;
                    $d['Kelas']=$db->Kelas;
                    $d['Tgl_Masuk']=$db->Tgl_Masuk;
                    $d['Jalur']=$db->Jalur_Masuk;
                    $d['Tahun_Masuk']=$db->Tahun_Masuk;
                    $d['Semester_Masuk']=$db->Semester_Masuk;
                    $d['Status_Masuk']=$db->Status_Masuk;
                    $d['Batas_Studi']=$db->Batas_Studi;
                                       
                    $d['Nama_Mhs']=$db->Nama_Mhs;
                    $d['Alamat']=$db->Alamat;
                    $d['Kota_Mhs']=$db->Kota;
                    $d['Alamat_Asal_Mhs']=$db->Alamat_Asl;
                    $d['Kota_Asal_Mhs']=$db->Kota_Asl;
                    $d['Provinsi']=$db->Kode_Prop;
                    $d['JK']=$db->JK;
                    $d['Tempat_Lahir']=$db->Tempat_Lahir;
                    $d['Tanggal_Lahir']=$db->Tgl_Lahir;
                    $d['Anak_ke']=$db->Anak_ke;
                    $d['jmlsdr']=$db->Jumlah_Saudara_Kandung;
                    $d['wn']=$db->Warga_Negara;                
                    $d['Agama']=$db->Agama_id;
                    $d['Telepon']=$db->Telp;
                    $d['HP']=$db->Tlp_HP;
                    $d['Email']=$db->Email;
                    
                    $d['Jurusan']=$db->Id_Jurusan;
                    $d['Nilai_UAN']=$db->Total_Nilai_UAN;
                    $d['Asal_Informasi']=$db->Id_Informasi;
                    $d['Pekerjaan_Mhs']=$db->Kd_pekerjaan_mhs;
                    $d['Nama_Kantor']=$db->Nama_Kantor;
                    $d['Alamat_Kantor']=$db->Alamat_Kantor;
                    $d['Telp_Kantor']=$db->Telp_Kantor;
                    $d['Status_Registrasi']=$db->Status_Reg; 
                    $d['Status_Daftar']=$db->Status_Daftar;
                    //$d['Status_Camaba']=$db->Status_Camaba;
                    
                    $d['Nama_Ayah']=$db->Nama_Ayah;
                    $d['No_KTP_Ayah']=$db->No_KTP_Ayah;
                    $d['Pekerjaan_Ayah']=$db->Kd_Pekerjaan_Ayah;
                    $d['Nama_Ibu']=$db->Nama_Ibu;
                    $d['No_KTP_Ibu']=$db->No_KTP_Ibu;
                    $d['Pekerjaan_Ibu']=$db->Kd_Pekerjaan_Ibu;
                    
                    $d['Alamat_Ortu']=$db->Alamat_Ortu;
                    $d['Kota_Ortu']=$db->Kota_Ortu;
                    $d['Telp_Ortu']=$db->Telp_Ortu;
                    $d['Telp_HP_Ortu']=$db->Telp_HP_Ortu;
                    
                    $d['Nama_Wali']=$db->Nama_Wali;
                    $d['No_KTP_Wali']=$db->No_KTP_Wali;
                    $d['Pekerjaan_Wali']=$db->Kd_Pekerjaan_Wali;
                    $d['Alamat_Wali']=$db->Alamat_Wali;
                    $d['Kota_Wali']=$db->Kota_Wali;
                    $d['Telp_Wali']=$db->Telp_Wali;
                    $d['Telp_HP_Wali']=$db->Telp_HP_Wali;
                    $d['Kode_SMU']=$db->Kode_SMU;
                    
                    $d['SKHUN']=$db->SKHUN;
                    $d['Pas_Photo']=$db->Pas_Photo;
                    $d['Akte_Kelahiran']=$db->Akte_Kelahiran;
                    $d['Ijazah']=$db->Ijazah;
                    $d['Rapor']=$db->Rapor;
                    
                    
                    if($db->URL_Foto=='' || @getimagesize($db->URL_Foto)==false){
                        if($db->JK=='P'){
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Women.png');}
                        else {
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Men.png');
                        }
                    }else
                    {
                        $d['URL_Photo']=$db->URL_Foto;
                    }                
				} 
            echo json_encode($d);
		}else{
			header('location:'.base_url());
		}
	}
    
    public function getFileNamaFromURL($fileurl){
        $filename=explode('/',$fileurl);
        $filename=end($filename);
        return $filename;
    }
    
    public function simpanEdit()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		  
            $tgl_masuk = $this->input->post('tglMasuk');  
            $tgl_masuk = date("Y-m-d", strtotime($tgl_masuk)); 
            
            $originalDate = $this->input->post('tanggalLahir');
            $tanggal = date("Y-m-d", strtotime($originalDate)); 
          
            
            //$namaFile = $this->session->userdata('oploaded');
            //$namaFile= base_url().'asset/photo/'.$namaFile;
            
            $namaFile=$this->input->post('urlFoto');
            
            //echo $namaFile;
            if($this->input->post('pekerjaanMhs')=='0'){
            $kodePekerjaanMhs = null;
            }else
            {
                $kodePekerjaanMhs = $this->input->post('pekerjaanMhs');
            }
            
            if($this->input->post('pekerjaanAyah')=='0'){
                $kodePekerjaanAyah = null;
            }else
            {
                $kodePekerjaanAyah = $this->input->post('pekerjaanAyah');
            }
            
            if($this->input->post('pekerjaanIbu')=='0'){
                $kodePekerjaanIbu = null;
            }else
            {
                $kodePekerjaanIbu = $this->input->post('pekerjaanIbu');
            }
            
            if($this->input->post('pekerjaanWali')=='0'){
                $kodePekerjaanWali = null;
            }else
            {
                $kodePekerjaanWali = $this->input->post('pekerjaanWali');
            }
                                    
            if($this->input->post('sekolah')=='0'){
                $sekolah = null;
            }else
            {
                $sekolah = $this->input->post('sekolah');
            }
                        
            /** Updating Data **/
            $databaru = array(
                'Id_Camaba' =>  $this->input->post('Id_Camaba'),
                'NRP' =>  $this->input->post('nrp'),
                'Nomer_Tes' =>  $this->input->post('nomer_tes'),
                'Kode_Prodi' =>  $this->input->post('prodi'),
                'Kelas' =>  $this->input->post('kelas'),
                'Tgl_Masuk' => $tgl_masuk,// $this->input->post('tglMasuk'),
                'Jalur_Masuk' =>  $this->input->post('jalurMasuk'),
                'Tahun_Masuk' =>  $this->input->post('tahunMasuk'),
                'Semester_Masuk' =>  $this->input->post('semesterMasuk'),
                'Status_Masuk' =>  $this->input->post('statusMasuk'),
                'Batas_Studi' =>  $this->input->post('batasStudi'),
                               
                'Nama_Mhs' =>  $this->input->post('namaMhs'),
                'Alamat' =>  $this->input->post('alamat'),
                'Kota' =>  $this->input->post('kota'),
                'Alamat_asl' =>  $this->input->post('alamatAsal'),
                'Kota_asl' =>  $this->input->post('kotaAsal'),
                'Kode_Prop' =>  $this->input->post('provinsi'),
                
                
                'JK' =>  $this->input->post('jk'),
                'Tempat_Lahir' =>  $this->input->post('tempatLahir'),
                'Tgl_Lahir' =>  $tanggal,//$this->input->post('tanggalLahir'),
                'Anak_ke' =>  $this->input->post('anak'),
                'Jumlah_Saudara_Kandung' =>  $this->input->post('jmlSdr'),
                'Warga_Negara' =>  $this->input->post('wn'),              
                'Agama_id' =>  $this->input->post('agama'),
                'Telp' =>  $this->input->post('telepon'),
                'Tlp_HP' =>  $this->input->post('hp'),
                'Email' =>  $this->input->post('email'),
                'URL_Foto' =>  $this->input->post('urlFoto'),
                
                'Id_Jurusan' =>  $this->input->post('jurusan'),
                'Total_Nilai_UAN' =>  $this->input->post('UAN'),
                'Id_Informasi' =>  $this->input->post('informasi'),
                'Kd_pekerjaan_mhs' => $kodePekerjaanMhs,
                'Nama_Kantor' =>  $this->input->post('namaKantor'),
                'Alamat_Kantor' =>  $this->input->post('alamatKantor'),
                'Telp_Kantor' =>  $this->input->post('teleponKantor'),
                
                'Nama_Ayah' =>  $this->input->post('namaAyah'),
                'No_KTP_Ayah' =>  $this->input->post('noKTPAyah'),
                'Kd_Pekerjaan_Ayah' =>$kodePekerjaanAyah ,
                
                'Nama_Ibu' =>  $this->input->post('namaIbu'),
                'No_KTP_Ibu' =>  $this->input->post('noKTPIbu'),
                'Kd_Pekerjaan_Ibu' => $kodePekerjaanIbu,
                
                'Alamat_Ortu' =>  $this->input->post('alamatOrtu'),
                'Kota_Ortu' =>  $this->input->post('kotaOrtu'),
                'Telp_Ortu' =>  $this->input->post('teleponOrtu'),
                'Telp_HP_Ortu' =>  $this->input->post('hpOrtu'),
                
                'Nama_Wali' =>  $this->input->post('namaWali'),
                'No_KTP_Wali' =>  $this->input->post('noKTPWali'),
                'Kd_Pekerjaan_Wali' =>  $kodePekerjaanWali,
                'Alamat_Wali' =>  $this->input->post('alamatWali'),
                'Kota_Wali' =>  $this->input->post('kotaWali'),
                'Telp_Wali' =>  $this->input->post('teleponWali'),
                'Telp_HP_Wali' =>  $this->input->post('hpWali'),
                'Status_Reg' =>  $this->input->post('statusReg'),
                'Status_Daftar' =>  $this->input->post('statusDaftar'),
                                
                'Kode_SMU' =>  $this->input->post('sekolah'),
               // 'URL_File_berkas' =>  $this->input->post('url_file_berkas'),
                'SKHUN' =>  $this->input->post('skhun'),
                'Pas_Photo' =>  $this->input->post('pasPhoto'),
                'Akte_Kelahiran' =>  $this->input->post('akte'),
                'Ijazah' =>  $this->input->post('ijazah'),
                'Rapor' =>  $this->input->post('rapor'),
                
                
                
                'Modified_by' => $this->session->userdata('username'),
                'Modified_date' => $this->today(),
            );
            
            $simpan = $this->input->post('saveas');
            $key['Id_Camaba']=$this->input->post('Id_Camaba');
            
                
			if($simpan == 'edit'){
                $this->app_model->updateData("tb_pmb_camaba",$databaru,$key);		
			}                
            echo 'Ubah data Sukses';    
		}else{
				header('location:'.base_url());
		}
       } 
    
    public function getDataToCetak(){
        $jenjang = $this->session->userdata('jenjang');
}
}
/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
