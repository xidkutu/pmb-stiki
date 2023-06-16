<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    public function cekFileUploaded(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/photo/'.$result['namaUploaded'];
        
        echo json_encode($result);
    }
    
    public function showUploader(){
        $this->load->view('rf/mahasiswa/uploader');
    }
    
    public function saveFile(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            /** Inserting Data Program Studi **/
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/photo/';
    		$config['allowed_types'] = 'gif|jpg|png';
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
                
                $this->load->view('rf/mahasiswa/upload_success', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('rf/mahasiswa/upload_success', $d);
    		}
    }
    }
    
    public function cari(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $cari = $this->input->post('txt_cari');
            
            $sess_cari['class']='mahasiswa';
            $sess_cari['keyword']=$cari;
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/mahasiswa');
        }
    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='mahasiswa';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/mahasiswa');
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
    
    public function getData(){
        $id = $this->input->post('id');
        
        $text = "SELECT NIP FROM tb_akd_tr_dosen WHERE NIP='$id'";
        $data = $this->app_model->manualQuery($text);
        $d['record']=$data->num_rows();
        
        $text = "SELECT
                	NIP,
                	NIDN,
                	Nama,
                    Jenis_kelamin,
                	sp.Status,
                	URL_photo
                FROM
                	tb_peg_rf_pegawai p INNER JOIN tb_peg_rf_status_peg sp ON p.statuspeg_id=sp.statuspeg_id
                WHERE NIP='$id' AND Aktif='YA'"; 
                    
			$data = $this->app_model->manualQuery($text);
            $d['dataNum']=$data->num_rows();
                foreach($data->result() as $db){
                    $d['NIP']=$db->NIP;
                    $d['NIDN']=$db->NIDN;
                    $d['Nama']=$db->Nama;
                    $d['Status']=$db->Status;
                    if($db->URL_photo==''){
                        if($db->Jenis_kelamin=='Perempuan'){
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Women.png');}
                        else {
                            $d['URL_Photo']=base_url('asset/photo/No-Photo-Men.png');
                        }
                    }else
                    {
                        $d['URL_Photo']=$db->URL_photo;
                    }
				} 
            echo json_encode($d);
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
    
    public function getBatasStudi($batas){
        if(strlen($batas)==5){
        $batasStudi = substr($batas,0,4);
        $sems= substr($batas,4,1);
        if($sems=='1'){
            $resSems = 'Ganjil';
        }else
        if($sems=='2'){
            $resSems = 'Genap';
        }else
        if($sems=='3'){
            $resSems = 'Periode 1';
        }else
        if($sems=='4'){
            $resSems = 'Periode 2';
        }else
        if($sems=='5'){
            $resSems = 'Periode 3';
        }else
            $resSems = 'Lainnya';
        $result = $batasStudi.' '.$resSems;
        return $result;
        }else
        return false;
    }
    
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
        $sess_cari['oploaded']='';
        $this->session->set_userdata($sess_cari);
        
		if(!empty($cek)){
            $class=$this->session->userdata('class');
            if($class=='mahasiswa'){
                  $cari = $cek = $this->session->userdata('keyword');
                $d['keyword']=$cari;
    			if(empty($cari)){
    				$where = " ";
    			}else{
    				$where = " WHERE ( NRP LIKE '%$cari%' OR Nama_Mhs LIKE '%$cari%')";
    			}
    			
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Mahasiswa";
    			
    			//paging
    			$page=$this->uri->segment(3);
    			$limit=$this->config->item('limit_data');
    			if(!$page):
    			$offset = 0;
    			else:
    			$offset = $page;
    			endif;
    			
    			$text = "SELECT count(NRP) as halaman FROM tb_akd_rf_mahasiswa $where ";		
    			$tot_hal = $this->app_model->manualQuery($text);		
                
                foreach($tot_hal->result() as $db){
    			$d['tot_hal'] = $db->halaman;
    			}
                
    			$config['base_url'] = site_url() . '/mahasiswa/index/';
    			$config['total_rows'] = $d['tot_hal'];
    			$config['per_page'] = $limit;
    			$config['uri_segment'] = 3;
    			$config['next_link'] = 'Lanjut &raquo;';
    			$config['prev_link'] = '&laquo; Kembali';
    			$config['last_link'] = '<b>Terakhir &raquo; </b>';
    			$config['first_link'] = '<b> &laquo; Pertama</b>';
    			$this->pagination->initialize($config);
    			$d["paginator"] =$this->pagination->create_links();
    			$d['hal'] = $offset;
                
                $text = "SELECT
                        	Tahun_Masuk,
                        	Nama_Prodi,
                        	Nama_Jenjang,
                        	Kelas,
                        	NRP,
                        	Nama_Mhs,
                        	JK,
                        	Tlp_HP,
                        	statAkd.Status as Status_Akademis
                        FROM
                        	(
                        		(
                        			tb_akd_rf_mahasiswa mhs
                        			INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi = prodi.Kode_Prodi
                        		)
                        		INNER JOIN tb_akd_rf_jenjang jen ON prodi.Jenjang = jen.Kode_Jenjang
                        	)
                        INNER JOIN tb_akd_rf_status_akademis statAkd ON mhs.Status_Akademis = statAkd.Kode_Status
                        $where
                        ORDER BY
                        	Tahun_Masuk DESC,
                        	NRP ASC
    					LIMIT $limit OFFSET $offset";
                
    			$d['data'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT agama_id, agama FROM tb_peg_rf_agama";
    			$d['agama'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kd_Pekerjaan, Pekerjaan FROM tb_akd_rf_pekerjaan";
    			$d['pekerjaan'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_SMU, Asal_SMU FROM tb_akd_rf_asal_sekolah";
    			$d['sekolah'] = $this->app_model->manualQuery($text);
                
    			$d['content'] = $this->load->view('rf/mahasiswa/view', $d, true);		
    			
                $this->load->view('home',$d);  
            }else
                $this->awal();
		}else{
			header('location:'.base_url());
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
    
    public function detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('id');  //$this->uri->segment(3);
			
             
            $text = "SELECT
                    	Nama_Prodi,
                    	Nama_Jenjang,
                    	Kelas,
                    	NRP,
                    	Nama_Mhs,
                    	JK,
                    	Tlp_HP,
                    	sa.STATUS as det_Status_Akademis,
                    	Status_Masuk,
                    	Tahun_Masuk,
                    	Semester_Masuk,
                    	Batas_Studi,
                        peg.gelar_depan,
                    	peg.Nama,
                        peg.gelar_belakang,
                    	JK,
                    	URL_Foto,
                    	Agama,
                    	m.Alamat,
                    	m.Kota,
                    	Alamat_Asl,
                    	Kota_Asl,
                    	m.Tempat_Lahir,
                    	DATE_FORMAT(m.Tgl_Lahir, '%d-%m-%Y') AS Tgl_Lahir,
                    	m.Telp,
                    	m.Tlp_HP,
                    	m.Email,
                    	Kd_Pekerjaan_Mhs,
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
                    	s.Email AS Email_SMU
                    FROM
                    		(
                    			(
                    				(
                    					(
                    						(
                    							tb_akd_rf_mahasiswa m INNER JOIN tb_akd_rf_prodi p ON m.Kode_Prodi = p.Kode_Prodi
                    					)
                    					INNER JOIN tb_akd_rf_jenjang j ON p.Jenjang = j.Kode_Jenjang
                    				)
                    				INNER JOIN tb_akd_rf_status_akademis sa ON m.status_akademis = sa.Kode_Status
                    			)
                    			LEFT JOIN tb_peg_rf_pegawai peg ON dosen_wali = peg.nip
                    		)
                    		INNER JOIN tb_peg_rf_agama ag ON m.Agama_id = ag.agama_id
                    	)
                    INNER JOIN tb_akd_rf_asal_sekolah s ON m.kode_SMU = s.kode_SMU
                WHERE NRP='$id'"; 
                    
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['NRP']=$db->NRP;
                    $d['Nama_Mhs']=$db->Nama_Mhs;
                    $d['Prodi']=$db->Nama_Prodi;
                    $d['Jenjang']=$db->Nama_Jenjang;
                    if($db->Kelas=='R'){
                        $d['Jalur']='Regular';   
                    }else
                    if($db->Kelas=='N')
                    {
                        $d['Jalur']='Non Reguler';
                    }else
                    if($db->Kelas=='K'){
                        $d['Jalur']='Kerjasama';
                    }
                   $d['Status_Masuk']=$db->Status_Masuk;
                   $d['Tahun_Masuk']=$db->Tahun_Masuk.' '.$db->Semester_Masuk;
                   $d['Batas_Studi']=$this->getBatasStudi($db->Batas_Studi) ;
                   $d['Dosen_Wali']=$db->gelar_depan.$db->Nama.$db->gelar_belakang;
                   $d['Status_Akademis']=$db->det_Status_Akademis;
                   $d['Agama']=$db->Agama;
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
                    $d['JK']=$db->JK;
                    $d['Alamat']=$db->Alamat;
                    $d['Kota_Mhs']=$db->Kota;
                    $d['Alamat_Asal_Mhs']=$db->Alamat_Asl;
                    $d['Kota_Asal_Mhs']=$db->Kota_Asl;
                    $d['Tempat_Lahir']=$db->Tempat_Lahir;
                    $d['Tanggal_Lahir']=$db->Tgl_Lahir;
                    $d['Telepon']=$db->Telp;
                    $d['HP']=$db->Tlp_HP;
                    $d['Email']=$db->Email;
                    $d['Pekerja, an_Mhs']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Mhs,'Kd_Pekerjaan','Pekerjaan');
                    $d['Nama_Kantor']=$db->Nama_Kantor;
                    $d['Alamat_Kantor']=$db->Alamat_Kantor;
                    $d['Telp_Kantor']=$db->Telp_Kantor;
                    $d['Nama_Ayah']=$db->Nama_Ayah;
                    $d['Nama_Ibu']=$db->Nama_Ibu;
                    $d['No_KTP_Ayah']=$db->No_KTP_Ayah;
                    $d['No_KTP_Ibu']=$db->No_KTP_Ibu;
                    $d['Alamat_Ortu']=$db->Alamat_Ortu;
                    $d['Kota_Ortu']=$db->Kota_Ortu;
                    $d['Pekerjaan_Ayah']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Ayah,'Kd_Pekerjaan','Pekerjaan');
                    $d['Pekerjaan_Ibu']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Ibu,'Kd_Pekerjaan','Pekerjaan');
                    $d['Telp_Ortu']=$db->Telp_Ortu;
                    $d['Telp_HP_Ortu']=$db->Telp_HP_Ortu;
                    $d['Nama_Wali']=$db->Nama_Wali;
                    $d['No_KTP_Wali']=$db->No_KTP_Wali;
                    $d['Alamat_Wali']=$db->Alamat_Wali;
                    $d['Kota_Wali']=$db->Kota_Wali;
                    $d['Pekerjaan_Wali']=$this->getDataFromDB('tb_akd_rf_pekerjaan',$db->Kd_Pekerjaan_Wali,'Kd_Pekerjaan','Pekerjaan');
                    $d['Telp_Wali']=$db->Telp_Wali;
                    $d['Telp_HP_Wali']=$db->Telp_HP_Wali;
                    $d['Nama_SMU']=$db->Asal_SMU;
                    $d['Alamat_SMU']=$db->Alamat_SMU;
                    $d['Kota_SMU']=$db->Kota_SMU;                	
                	$d['Telp_SMU']=$db->Telp_SMU;
                	$d['Email_SMU']=$db->Email_SMU;
				}
                if($d['Status_Masuk']=='Pindahan'){
                    $queryPTAsal="SELECT
                                	NRP,
                                	NIM_Asal,
                                	ptAsl.Kode_Prop,
                                	Nama_Prop,
                                	Kode_PT_Asal,
                                	Nama_PT,
                                	Jenjang,
                                	Nama_Jenjang,
                                	Program_Studi,
                                	SKS_Diakui
                                FROM
                                	(
                                		tb_akd_tr_pt_asal ptAsl
                                		INNER JOIN tb_akd_rf_propinsi prop ON ptAsl.Kode_Prop = prop.Kode_Prop
                                	)
                                INNER JOIN tb_akd_rf_jenjang jen ON ptAsl.Jenjang = jen.Kode_Jenjang
                                WHERE NRP='$id'
                    ";
                    $data = $this->app_model->manualQuery($queryPTAsal);
                    foreach($data->result() as $db){
                        $d['NIM_Asal']=$db->NIM_Asal;
                        $d['Nama_Prop']=$db->Nama_Prop;
                        $d['Kode_PT_Asal']=$db->Kode_PT_Asal;
                        $d['Nama_PT']=$db->Nama_PT;
                        $d['Nama_Jenjang']=$db->Nama_Jenjang;
                        $d['Program_Studi']=$db->Program_Studi;
                        $d['SKS_Diakui']=$db->SKS_Diakui;
                    }
                }
            //Data akademis mahasisawa 
            $text="SELECT
                	a.Tahun,
                	a.Periode_Sem,
                	a.mk_terambil AS MK_Ambil_Semester,
                	SKS_Sekarang AS SKS_Ambil_Semester,
                	SKS_lulus_Semester,
                	Mutu_Semester,
                	IP,
                	SKS_Keseluruhan AS SKS_Ambil_Komulatif,
                	SKS_Lulus AS SKS_Lulus_Komulatif,
                	Total_Nilai as Mutu_Komulatif,
                	IPK
                FROM
                	(
                		SELECT
                			statNilai.NRP,
                			statNilai.Tahun,
                			statNilai.Periode_Sem,
                			COUNT(Kode_MK) AS mk_terambil,
                			SKS_Sekarang,
                			Total_Nilai,
                			IP,
                			SKS_Keseluruhan,
                			SKS_Lulus,
                			IPK
                		FROM
                			tb_akd_tr_statistik_nilai statNilai
                		INNER JOIN tb_akd_tr_perwalian per ON statNilai.NRP = per.NRP
                		INNER JOIN tb_akd_tr_ambil_mk ambMK ON ambMK.Kd_Perwalian = per.Kd_perwalian
                		AND ambMK.Tahun = statNilai.Tahun
                		AND ambMK.Periode_Sem = statNilai.Periode_Sem
                		WHERE
                			statNilai.NRP = '$id'
                		AND ambMK.Kode_DropMK IS NULL
                		GROUP BY
                			Tahun,
                			Periode_Sem
                	) a
                LEFT JOIN (
                	SELECT
                	NRP,
                	Tahun,
                	Periode_Sem,
                	SUM(sks) as SKS_Lulus_Semester,
                	SUM(sks*Point) as Mutu_Semester
                FROM
                	(
                		tb_akd_tr_nilai nilai
                		INNER JOIN tb_akd_rf_mata_kuliah mk ON nilai.Kode_MK = mk.Kode_MK
                	)
                INNER JOIN tb_akd_hlp_nilai hlpNil ON nilai.Nilai = hlpNil.Nilai
                WHERE
                	NRP = '$id'
                    AND Nilai.Status_Nilai='Publikasi'
                	AND Nilai.Nilai<>'E'
                	AND nilai.Nilai<>'D'
                	AND nilai.Nilai is NOT NULL
                GROUP BY
                	Tahun,
                	Periode_Sem
                ) b ON a.NRP = b.NRP
                AND a.Tahun = b.Tahun
                AND a.Periode_Sem = b.Periode_Sem";
            $result_akd='';
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows()>0){
                foreach($data->result() as $i=>$db){
                    $result_akd=$result_akd."<tr class='item-row-data'>
                    <td align='center'>".$db->Tahun."</td>
                    <td align='center'>".$db->Periode_Sem."</td>
                    <td align='center'>".$db->MK_Ambil_Semester."</td>
                    <td align='center'>".$db->SKS_Ambil_Semester."</td>
                    <td align='center'>".$db->SKS_lulus_Semester."</td>
                    <td align='center'>".$db->Mutu_Semester."</td>
                    <td align='center'>".round($db->IP,2)."</td>
                    <td align='center'>".$db->SKS_Ambil_Komulatif."</td>
                    <td align='center'>".$db->SKS_Lulus_Komulatif."</td>
                    <td align='center'>".$db->Mutu_Komulatif."</td>
                    <td align='center'>".round($db->IPK,2)."</td>
                    <td align='center'>".$db->SKS_Lulus_Komulatif."</td>
                    </tr>";
				}
            }else
            {
                $result_akd="<tr bgcolor='#fff' class='item-row-data'><td colspan=12 align='center'> Tidak ada data </td> ";
            }
            $d['Data_Akademis']=$result_akd;
            
            //Riwayat Akademik
            $text="SELECT
                    	Tahun,
                    	Periode_Sem,
                    	Status
                    FROM
                    	tb_akd_tr_status_mahasiswa statMhs
                    INNER JOIN tb_akd_rf_status_akademis statAkd ON statMhs.Kode_Status = statAkd.Kode_Status
                    WHERE
                    	NRP = '$id'";
            $result_RA='';
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows()>0){
                foreach($data->result() as $i=>$db){
                    $result_RA=$result_RA."<tr class='item-row-data-RA'>
                    <td align='center'>".$db->Tahun."</td>
                    <td align='center'>".$db->Periode_Sem."</td>
                    <td align='center'>".$db->Status."</td>
                    </tr>";
				}
            }else
            {
                $result_RA="<tr bgcolor='#fff' class='item-row-data-RA'><td colspan=3 align='center'> Tidak ada data </td> ";
            }
            $d['Data_Riwayat_Akademik']=$result_RA;
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
            $id = $this->input->post('id');  //$this->uri->segment(3);
			
             
            $text = "SELECT 
                        NRP, 
                        Nama_Mhs,
                        JK,
                        Tempat_Lahir,
                        Tgl_Lahir,
                        Agama_id,
                        Alamat,
                        Kota,
                        Alamat_Asl,
                        Kota_Asl,
                        Telp,
                        Tlp_HP,
                        Email,
                        Kd_Pekerjaan_Mhs,
                        Nama_Kantor,
                        Alamat_Kantor,
                        Telp_Kantor,
                        Nama_Ayah,
                        Nama_Ibu,
                        No_KTP_Ayah,
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
                        URL_Foto
                    FROM
                        tb_akd_rf_mahasiswa                	
                WHERE NRP='$id'"; 
                    
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['NRP']=$db->NRP;
                    $d['Nama_Mhs']=$db->Nama_Mhs;
                    $d['Agama']=$db->Agama_id;
                    
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
                    $d['JK']=$db->JK;
                    $d['Alamat']=$db->Alamat;
                    $d['Kota_Mhs']=$db->Kota;
                    $d['Alamat_Asal_Mhs']=$db->Alamat_Asl;
                    $d['Kota_Asal_Mhs']=$db->Kota_Asl;
                    $d['Tempat_Lahir']=$db->Tempat_Lahir;
                    $d['Tanggal_Lahir']=$db->Tgl_Lahir;
                    $d['Telepon']=$db->Telp;
                    $d['HP']=$db->Tlp_HP;
                    $d['Email']=$db->Email;
                    $d['Pekerjaan_Mhs']=$db->Kd_Pekerjaan_Mhs;
                    $d['Nama_Kantor']=$db->Nama_Kantor;
                    $d['Alamat_Kantor']=$db->Alamat_Kantor;
                    $d['Telp_Kantor']=$db->Telp_Kantor;
                    $d['Nama_Ayah']=$db->Nama_Ayah;
                    $d['Nama_Ibu']=$db->Nama_Ibu;
                    $d['No_KTP_Ayah']=$db->No_KTP_Ayah;
                    $d['No_KTP_Ibu']=$db->No_KTP_Ibu;
                    $d['Alamat_Ortu']=$db->Alamat_Ortu;
                    $d['Kota_Ortu']=$db->Kota_Ortu;
                    $d['Pekerjaan_Ayah']=$db->Kd_Pekerjaan_Ayah;
                    $d['Pekerjaan_Ibu']=$db->Kd_Pekerjaan_Ibu;
                    $d['Telp_Ortu']=$db->Telp_Ortu;
                    $d['Telp_HP_Ortu']=$db->Telp_HP_Ortu;
                    $d['Nama_Wali']=$db->Nama_Wali;
                    $d['No_KTP_Wali']=$db->No_KTP_Wali;
                    $d['Alamat_Wali']=$db->Alamat_Wali;
                    $d['Kota_Wali']=$db->Kota_Wali;
                    $d['Pekerjaan_Wali']=$db->Kd_Pekerjaan_Wali;
                    $d['Telp_Wali']=$db->Telp_Wali;
                    $d['Telp_HP_Wali']=$db->Telp_HP_Wali;
                    $d['Kode_SMU']=$db->Kode_SMU;
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
            
            /** Updating Data Program Studi **/
            $databaru = array(
                'Nama_Mhs' =>  $this->input->post('namaMhs'),
                'JK' =>  $this->input->post('jk'),
                'Tempat_Lahir' =>  $this->input->post('tempatLahir'),
                'Tgl_Lahir' => $tanggal,
                'Agama_id' =>  $this->input->post('agama'),
                'Telp' =>  $this->input->post('telepon'),
                'Tlp_HP' =>  $this->input->post('hp'),
                'URL_Foto'=> $namaFile,
                'Email' =>  $this->input->post('email'),
                'Alamat' =>  $this->input->post('alamat'),
                'Kota' =>  $this->input->post('kota'),
                'Alamat_asl' =>  $this->input->post('alamatAsal'),
                'Kota_asl' =>  $this->input->post('kotaAsal'),
                'Kd_pekerjaan_mhs' => $kodePekerjaanMhs,
                'Nama_Kantor' =>  $this->input->post('namaPerusahaan'),
                'Alamat_Kantor' =>  $this->input->post('alamatPerusahaan'),
                'Telp_Kantor' =>  $this->input->post('teleponPerusahaan'),
                'Nama_Ayah' =>  $this->input->post('namaAyah'),
                'No_KTP_Ayah' =>  $this->input->post('noKTPAyah'),
                'Kd_Pekerjaan_Ayah' =>  $kodePekerjaanAyah,
                'Nama_Ibu' =>  $this->input->post('namaIbu'),
                'No_KTP_Ibu' =>  $this->input->post('noKTPIbu'),
                'Kd_Pekerjaan_Ibu' =>  $kodePekerjaanIbu,
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
                'Kode_SMU' =>  $this->input->post('sekolah'),
                'Modified_by' => $this->session->userdata('username'),
                'Modified_date' => $this->today(),
            );
            
            $simpan = $this->input->post('saveas');
            $key['NRP']=$this->input->post('nrp');
            
                
			if($simpan == 'edit'){
                $this->app_model->updateData("tb_akd_rf_mahasiswa",$databaru,$key);		
			}                
            echo 'Ubah data Sukses';    
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
