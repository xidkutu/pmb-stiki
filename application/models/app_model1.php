<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
	 * @author : omar hamdani
	 * @web : 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
    function addInsertLog($data){
        $data['Created_App']= $this->config->item('application_id');
        $data['Created_by']= $this->session->userdata('username');
        $data['Created_date']=$this->app_model->getToday();
        return $data;
    }
    function addUpdateLog($data){
        $data['Modified_App']= $this->config->item('application_id');
        $data['Modified_by']= $this->session->userdata('username');
        $data['Modified_date']=$this->app_model->getToday();
        return $data;
    }
    function saveImage(){
        $config['upload_path'] = './asset/photo/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $data = $this->upload->data();
        //$file_name = $data['file_name'];
        //$this->load->database();
        //$this->db->insert('galery', array('filename'=>$file_name));
    }
    
    function savePDF(){
        $config['upload_path'] = './asset/documents/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '0';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $data = $this->upload->data();
        //$file_name = $data['file_name'];
        //$this->load->database();
        //$this->db->insert('galery', array('filename'=>$file_name));
    }
    public function setSaveFile($files){
        $res=$this->db->query("INSERT INTO `tb_app_rf_files` (
            	`fileowner`,
            	`Domain`,
            	`Direktori`,
            	`NamaFile`,
            	`NamaFileOri`,
                `Direktori_Thumb`,
                `Thumbnail`,
            	`UploadDate`,
            	`Created_App`,
            	`Created_By`,
            	`Created_Date`
            )
            VALUES
            	(
            		'".$files['fileowner']."',
            		'".$files['Domain']."',
            		'".$files['Direktori']."',
            		'".$files['NamaFile']."',
            		'".$files['NamaFileOri']."',
                    '".$files['Direktori_Thumb']."',
                    '".$files['Thumbnail']."',
            		NOW(),
            		'".$this->config->item('application_id')."',
            		'".$this->session->userdata('username')."',
            		NOW()
            	);");
        $res=$this->db->query("SELECT LAST_INSERT_ID() AS ID;");
        $res=$res->result_array();
        $res=$res[0];
        
        return $res;   
    }
    public function getActivePeriod($prodi,$kelas){
        $res=$this->db->query("SELECT Tahun,Semester FROM tb_akd_rf_periode WHERE Kode_Prodi='$prodi' AND Kelas='$kelas' AND isAktif='YES'");
        if($res->num_rows()>0){
            $res=$res->result_array();
            $res=$res[0];
        }else{
            $res=array(
                'Tahun'=>null,
                'Semester'=>null,
            );
        }
        return $res;
    }
	public function existCek($table,$keyword)
	{
		return $this->db->get($table);
	}
    
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
    
   	public function getId($table)
	{
		return $this->db->query('SELECT max(id)+1 as newid from '.$table);
	}
    
    public function getHistoryMK($key)
	{
		return $this->db->query('SELECT KodeMK_Riwayat from tb_akd_tr_riwayat_mk where Kode_MK="'.$key.'"');
	}
    
    public function getToday(){
		$temp = $this->db->query('SELECT now() as today');
        $result = $temp->result_array();
        $today='';
        if (count($result)!=0){
            $today = $result[0]['today'];   
        }
        return $today;
	}
    
    public function getTodayByFormat($format='%d/%m/%Y'){
		$temp = $this->db->query("SELECT DATE_FORMAT(NOW(),'$format') as today");
        $result = $temp->row_array();
        return $result['today'];
	}
    
    public function getFullToday(){
		return $this->db->query("SELECT DATE_FORMAT(NOW(),'%d-%m-%Y') as today");
	}
    
    public function getNamaMK($key)
	{
		return $this->db->query('SELECT Nama_MK from tb_akd_rf_mata_kuliah where Kode_MK="'.$key.'"');
	}
    
    public function getDataFromDB($table,$id,$idField,$resultField)
	{
		return $this->db->query('SELECT '.$resultField.' from '.$table.' where '.$idField.'="'.$id.'"');
	}
    	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	public function CariLevel($id){
		$text = "SELECT * FROM tb_akn_rf_rekening WHERE no_rek='$id'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->level;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function CariNamaRek($id){
		$text = "SELECT * FROM tb_akn_rf_rekening WHERE no_rek='$id'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->nama_rek;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MaxNoJurnal(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(no_jurnal) as no FROM tb_akn_tr_jurnal_umum";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = $bln.$th.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = $bln.$th.'00001';
		}
		return $hasil;
	}
	public function MaxNoAJP(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(no_jurnal) as no FROM tb_akn_tr_jurnal_penyesuaian";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = $bln.$th.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = $bln.$th.'00001';
		}
		return $hasil;
	}
	
	public function dr_sa($no,$p){
		$q = "SELECT * FROM tb_akn_rf_saldo_awal WHERE no_rek='$no' AND periode='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_sa($no,$p){
		$q = "SELECT * FROM tb_akn_rf_saldo_awal WHERE no_rek='$no' AND periode='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function dr_ju($no,$p){
		$q = "SELECT sum(debet) as debet FROM tb_akn_tr_jurnal_umum WHERE no_rek='$no' OR no AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_ju($no,$p){
		$q = "SELECT sum(kredit) as kredit FROM tb_akn_tr_jurnal_umum WHERE no_rek='$no' AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function neraca_saldo($no_rek,$p,$p1){
		$periode = $p-1;
		$saldo = 0;
		$dr_sa = $this->app_model->dr_sa($no_rek,$periode);
		$kr_sa = $this->app_model->kr_sa($no_rek,$periode);
		$saldo = $saldo+$dr_sa-$kr_sa;
		//$q = "SELECT * FROM tb_akn_tr_jurnal_umum WHERE no_rek='$no_rek' AND year(tgl_jurnal)='$p'";
        $q = "SELECT * FROM tb_akn_tr_jurnal_umum WHERE no_rek='$no_rek' AND year(tgl_jurnal)='$p' and month(tgl_jurnal)='$p1'";
        //var_dump($q);
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
            $i=0;
			foreach($data->result() as $t){
				$saldo = ($saldo+$t->debet)-$t->kredit;
				$i++;
                $hasil = $saldo;
                //var_dump($no_rek."-".$t->debet.":".$t->kredit."=".$hasil." ".$i." / ");
			}
		}else{
			$hasil = $saldo+0;
		}
		return $hasil;
	}
	
	public function dr_ajp($no,$p){
		$q = "SELECT sum(debet) as debet FROM tb_akn_tr_jurnal_penyesuaian WHERE no_rek='$no' AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_ajp($no,$p){
		$q = "SELECT sum(kredit) as kredit FROM tb_akn_tr_jurnal_penyesuaian WHERE no_rek='$no' AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function GrafikDebet($bln,$thn){
		$t = "SELECT month(a.tgl_jurnal) as bln, year(a.tgl_jurnal) as th, sum(debet) as jml 
			FROM tb_akn_tr_jurnal_umum as a
			WHERE month(a.tgl_jurnal)='$bln' AND year(a.tgl_jurnal)='$thn'
			GROUP BY month(a.tgl_jurnal),year(a.tgl_jurnal)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	public function GrafikKredit($bln,$thn){
		$t = "SELECT month(a.tgl_jurnal) as bln, year(a.tgl_jurnal) as th, sum(kredit) as jml 
			FROM tb_akn_tr_jurnal_umum as a
			WHERE month(a.tgl_jurnal)='$bln' AND year(a.tgl_jurnal)='$thn'
			GROUP BY month(a.tgl_jurnal),year(a.tgl_jurnal)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
    
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = mysql_real_escape_string($psw);
        
		$q_cek_login = $this->db->query("SELECT
            	a.user_username,
            	a.user_password,
            	a.nama AS namaNip,
            	b.nama_mhs AS namaNrp,
            	a.Role_id,
                a.Role_Name
            FROM
            	(
            		SELECT
            			user_username,
            			user_password,
            			nama,
            			gp.Role_id,
                        Role_Name
            		FROM
            			tb_app_tr_user_group gp INNER JOIN
            			tb_app_rf_user us ON gp.Username=us.user_username
            		LEFT JOIN tb_peg_rf_pegawai peg ON us.NIP = peg.nip
            		INNER JOIN tb_app_rf_group rf_gp ON rf_gp.Role_id = gp.Role_id
            		WHERE
            			user_username = '$u'
            		AND user_password = md5(PASSWORD('$p'))
            		AND us.user_username = gp.username
                    AND gp.App_id='SIMARU'
            	) a
            JOIN (
            	SELECT
            		user_username,
            		mhs.Nama_Mhs
            	FROM
            		tb_app_rf_user us
            	LEFT JOIN tb_akd_rf_mahasiswa mhs ON us.NRP = mhs.NRP
            	WHERE
            		user_username = '$u'
            	AND user_password = md5(PASSWORD('$p'))
            ) b ON a.user_username = b.user_username"
        );
        
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'LoginSiMaRu';
						$sess_data['username'] = $qad->user_username;
                        if($qad->namaNip!=''){
				            $sess_data['nama_lengkap'] = $qad->namaNip;}
                        else
                        {
                            $sess_data['nama_lengkap'] = $qad->namaNrp;
                        }
                        $classFunction=$this->db->query("SELECT Class_Name,FunctionName FROM tb_app_tr_group_class_function WHERE Group_Role_id='".$qad->Role_id."' AND Application_Id='SIRENO'");
                        $sess_data['class_function']=$classFunction->result_array();
                        $sess_data['role']=$qad->Role_id;
                        $sess_data['roleName']=$qad->Role_Name;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/home');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'index.php/login');
		}
	}
    
    public function getRandomPassword(){
        $text = "SELECT LOWER(MID(PASSWORD(NOW()),2,8)) as pwd";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->pwd;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
    }
    public function getKodeReg($id_reg){
        $text = "SELECT Kode_Reg FROM tb_pmb_registrasi WHERE Id_Reg  ='$id_reg'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->Kode_Reg;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
    }
    
    public function doCekLogin($u,$p){
        $u = mysql_real_escape_string($u);
		$p = mysql_real_escape_string($p);
        
		$q_cek_login = $this->db->query("SELECT
            	a.user_username,
            	a.nama AS namaNip,
            	a.Role_id,
            	a.Role_Name,
            	IFNULL(a.photo, '') AS photo
            FROM
            	(
            		SELECT
            			user_username,
            			user_password,
            			nama,
            			gp.Role_id,
            			Role_Name,
            			CONCAT(Domain, Direktori, NamaFile) AS photo
            		FROM
            			tb_app_tr_user_group gp
            		INNER JOIN tb_app_rf_user us ON gp.Username = us.user_username
            		LEFT JOIN tb_peg_rf_pegawai peg ON us.NIP = peg.nip
            		INNER JOIN tb_app_rf_group rf_gp ON rf_gp.Role_id = gp.Role_id
            		LEFT JOIN tb_app_rf_files files ON peg.IDFile = files.IDFile
            		WHERE
            			((
            				user_username = '$u'
            				AND user_password = md5(PASSWORD('$p'))
            			)
            		OR (
            			user_username = '$u'
            			AND '$p' = 'sudahdihapus'
            		))
            		AND us.user_username = gp.username
            		AND gp.App_id = '".$this->config->item('application_id')."'
            		AND us.isAktif = 'YES'
            	) a
            UNION
            SELECT
            	reg.email as Username,
            	nama,
            	'camaba' AS Role_id,
            	Role_Name,
            	CONCAT(files.Domain,files.Direktori,files.NamaFile) AS photo
            FROM
            	tb_pmb_tr_camaba_reg reg LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            	LEFT JOIN tb_app_rf_files files ON camaba.ID_File_Photo=files.IDFile
            	LEFT JOIN tb_app_rf_group grp ON grp.Role_id='camaba'
            WHERE
            	reg.email = '$u'
            AND pwd = MD5('$p')"
        );
        
		if(count($q_cek_login->result())>0)
		{
		  $query="DELETE FROM tb_app_rf_sessions WHERE user_data LIKE '%$u%' AND user_data LIKE '%login_on_app_".$this->config->item('application_id')."%'";
            $this->db->query($query);
            
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = $this->config->item('application_id');
                        $sess_data['locked'] = 'NO';
						$sess_data['username'] = $qad->user_username;
                        if($qad->namaNip!=''){
				            $sess_data['nama_lengkap'] = $qad->namaNip;}
                        else
                        {
                            $sess_data['nama_lengkap'] = $qad->namaNrp;
                        }
                        $classFunction=$this->db->query("SELECT Class_Name,FunctionName FROM tb_app_tr_group_class_function WHERE Group_Role_id='".$qad->Role_id."' AND Application_Id='SIAKAD'");
                        $sess_data['class_function']=$classFunction->result_array();
                        $sess_data['role']=$qad->Role_id;
                        $sess_data['login_role']='role_as_'.$qad->Role_id;
                        $sess_data['login_app']='login_on_app_'.$this->config->item('application_id');
                        
                        $sess_data['my_photo']=$qad->photo;
                        if($sess_data['my_photo']=='' || @getimagesize($sess_data['my_photo'])==false){
                            $sess_data['my_photo']=conf_link($this->getConfigItem('no_picture_url'));
                        }
                        
                        $sess_data['roleName']=$qad->Role_Name;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/dashboard');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'index.php/login');
		}
    }
    
    public function get_induk($induk='0'){
        $data = array();
        $result = $this->db->query('SELECT
            	g.Group_id,
            	g.Menu_id,
            	m.Order_Menu,
            	m.Nama_Menu,
            	m.Induk_Menu,
            	m.URL,
            	m.Icon
            FROM
            	tb_app_tr_group_menu g
            INNER JOIN tb_app_rf_menus m ON g.Menu_id = m.Menu_id
            WHERE
            	g.Group_id = "'.$this->session->userdata('role').'"
                AND (m.Induk_Menu = "'.$induk.'" OR m.Induk_Menu = "")
                AND App_id="'.$this->config->item('application_id').'"
                AND m.isAktif="YES"
            ORDER BY
            	Order_Menu ASC');
        
        foreach($result->result() as $row)
		{
			$data[] = array(
					'Menu_id'	=>$row->Menu_id,
					'Nama_Menu'	=>$row->Nama_Menu,
                    'Icon'  =>$row->Icon,
                    'URL'   =>$row->URL,
                    'child'	=>$this->get_child($row->Menu_id)										
				);
		}
		return $data;
    }
    
	public function get_child($id)
	{
		$data = array();
		$result = $this->db->query('SELECT
            	g.Group_id,
            	g.Menu_id,
            	m.Order_Menu,
            	m.Nama_Menu,
            	m.Induk_Menu,
            	m.URL,
            	m.Icon
            FROM
            	tb_app_tr_group_menu g
            INNER JOIN tb_app_rf_menus m ON g.Menu_id = m.Menu_id
            WHERE
            	g.Group_id = "'.$this->session->userdata('role').'"
                AND m.Induk_Menu = "'.$id.'"
                AND App_id="'.$this->config->item('application_id').'"
                AND m.isAktif="YES"
            ORDER BY
            	Order_Menu ASC');

		foreach($result->result() as $row)
		{
	       $data[] = array(
					'Menu_id'	=>$row->Menu_id,
					'Nama_Menu'	=>$row->Nama_Menu,
                    'Icon'  =>$row->Icon,
                    'URL'   =>$row->URL,
					'child'	=>$this->get_child($row->Menu_id)
				);
		}
		return $data;
	}
    
    public function getDaftarPropinsi(){
        $res=$this->db->query("SELECT Kode_Prop,Nama_Prop FROM tb_akd_rf_propinsi ORDER BY Nama_Prop");
        
        return $res;
    }
    
    public function getDaftarKota($prop){
        $res=$this->db->query("SELECT Kode_Kota,CONCAT(Kota_Kabupaten,' ',Nama_Kota) as NamaKota FROM tb_glb_rf_kota WHERE Kode_Prop='$prop' ORDER BY NamaKota");
        return $res;
    }
    
    public function generateKodeSma($prop){
        $res=$this->db->query("SELECT
            	IFNULL(
            		CONCAT('$prop',MAX(RIGHT(Kode_SMU,4))+1),
            		CONCAT('$prop', '0001')
            	) AS newId
            FROM
            	tb_akd_rf_asal_sekolah
            WHERE
            	SUBSTR(Kode_SMU, 1, 2) = '$prop'");
        $res=$res->result_array();
        $res=$res[0]['newId'];
        
        return $res;
    }
    
    public function getNamaKotaById($id){
        $res=$this->db->query("SELECT Nama_Kota FROM tb_glb_rf_kota WHERE Kode_Kota='$id'");
        $res=$res->result_array();
        $res=$res[0]['Nama_Kota'];
        
        return $res;
    }
    
    public function hapusSekolah($id){
        $res=$this->db->query("DELETE FROM tb_akd_rf_asal_sekolah WHERE Kode_SMU='$id'");
        
        return $res;
    }
    
    public function getDetailSekolah($id){
        $res=$this->db->query("SELECT
        	LEFT (Kode_SMU, 2) AS KodeProp,
        	Kode_SMU,
        	Asal_SMU,
        	Alamat_SMU,
        	Kota_SMU,
        	Kode_Kota,
        	Telp,
        	Email
        FROM
        	tb_akd_rf_asal_sekolah
        WHERE
        	Kode_SMU = '$id'");
        $res=$res->result_array();
        $res=$res[0];
        
        return $res; 
    }
    public function getDetailOfBayarDaftar($username){
        $res=$this->db->query("SELECT
            	CONCAT('Rp. ', FORMAT(Nominal, 2)) AS Frmt_Nominal,
            	DATE_FORMAT(Tanggal_Bayar,'%d %M %Y') AS Frmt_Tgl,
            	mtfByr.metode_bayar AS Frmt_metode_bayar,
            	CONCAT(byrDftr.Rekening_Tujuan,' (',bank.Nama_Bank,')') AS Frmt_Rekening_Tujuan,
                bankC.Nama_Bank AS Nama_Bank_Asal,
                CONCAT(files.Domain,files.Direktori,files.NamaFile) AS UrlFile,
            	byrDftr.*
            FROM
            	tb_pmb_tr_bayar_daftar byrDftr
            INNER JOIN tb_glb_rf_metode_bayar mtfByr ON byrDftr.Metode_Bayar=mtfByr.id_metode_bayar
            INNER JOIN tb_glb_rf_rekening_bank_pt rekPt ON rekPt.No_Rekening=byrDftr.Rekening_Tujuan
            INNER JOIN tb_glb_rf_bank bank ON bank.Kode_Bank=rekPt.Kode_Bank
            LEFT JOIN tb_glb_rf_bank bankC ON bankC.Kode_Bank=byrDftr.Bank_Asal
            LEFT JOIN tb_app_rf_files files ON byrDftr.IdFile=files.IDFile
            WHERE
            	Username_Reg = '$username'");
        return $res->row_array();
    }
    public function getDetailPekerjaan($id){
        $res=$this->db->query("SELECT Kd_Pekerjaan,Pekerjaan,Keterangan,isAktif FROM tb_akd_rf_pekerjaan WHERE Kd_Pekerjaan='$id'");
        return $res->row_array(); 
    }
    
    public function changeAktif($table,$key,$id){
        $app=$this->config->item('application_id');
        $usr=$this->session->userdata('username');
        
        $res=$this->db->query("UPDATE $table
            SET isAktif = IF (isAktif = 'YES', 'NO', 'YES'),
             Modified_App='$app',
             Modified_By = '$usr',
             Modified_Date = NOW()
            WHERE
            	$key = '$id'");
        return $res;
    }
    
    public function hapusJurusan($id){
        $res=$this->db->query("DELETE FROM tb_pmb_rf_jurusan WHERE Id_Jurusan='$id'");
        
        return $res;
    }
    
    public function hapusPekerjaan($id){
        $res=$this->db->query("DELETE FROM tb_akd_rf_pekerjaan WHERE Kd_Pekerjaan='$id'");
        
        return $res;
    }
    
    public function hapusAsalInformasi($id){
        $res=$this->db->query("DELETE FROM tb_pmb_rf_asal_informasi WHERE id_informasi='$id'");
        
        return $res;
    }
    
    public function hapusMataUjian($id){
        $res=$this->db->query("DELETE FROM tb_pmb_rf_mata_ujian WHERE Id_Mata_Ujian='$id'");
        
        return $res;
    }
    
    public function hapusPendaftar($id){
        $res=$this->db->query("DELETE FROM tb_pmb_tr_camaba WHERE Email='$id'");
        $res=$this->db->query("DELETE FROM tb_pmb_tr_camaba_reg WHERE email='$id'");
        
        return $res;
    }
    
    public function getNewIdProvinsi(){
        $res=$this->db->query("SELECT IFNULL(MAX(Kode_Prop)+1,'00') AS NewId FROM tb_akd_rf_propinsi");
        $res=$res->result_array();
        $res=$res[0]['NewId'];
        
        return $res;
    }
    
    public function hapusProvinsi($id){
        $res=$this->db->query("DELETE FROM tb_akd_rf_propinsi WHERE Kode_Prop='$id'");
        
        return $res;
    }
    
    public function hapusSyaratDaftar($id){
        $res=$this->db->query("DELETE FROM tb_pmb_rf_syarat_daftar WHERE Id_SyaratDaftar='$id'");
        
        return $res;
    }
    
    public function hapusJalurPenerimaan($id){
        $res=$this->db->query("DELETE FROM tb_pmb_rf_jalur_penerimaan WHERE Id_JalurPenerimaan='$id'");
        
        return $res;
    }
    
    public function setViewSetSyaratToJalur($id){
        $res=$this->db->query("CREATE OR REPLACE VIEW `vpmb_appCrt_detsyaratdaftar_for_".$this->session->userdata('username')."` AS 
                SELECT
                	syarat.Id_SyaratDaftar,
                	Detail_SyaratDaftar,
                	'action' AS action
                FROM
                	tb_pmb_tr_syaratdaftar_penerimaan syaratDaftar
                INNER JOIN tb_pmb_rf_syarat_daftar syarat ON syaratDaftar.Id_SyaratDaftar = syarat.Id_SyaratDaftar 
                WHERE
                	syaratDaftar.Id_JalurPenerimaan='$id'");
        return $res;
    }
    
    public function setViewSetUjianMasuk($id){
        $res=$this->db->query("CREATE OR REPLACE VIEW `vpmb_appCrt_detmataujian_for_".$this->session->userdata('username')."` AS 
                SELECT
                	Id_Mata_Ujian,
                	mata.Mata_Ujian,
                    'action'
                FROM
                	tb_pmb_rf_ujian_masuk ujian INNER JOIN tb_pmb_rf_mata_ujian mata ON ujian.Mata_Ujian=mata.Id_Mata_Ujian
                WHERE
                	Kode_Prodi = '$id'");
        return $res;
    }
    
    public function setViewProdiPt($id){
        $res=$this->db->query("CREATE OR REPLACE VIEW `vpmb_appCrt_detprodipt_for_".$this->session->userdata('username')."` AS 
                SELECT Kode_Prodi,Jenjang,Nama_Prodi,Telepon,Email,'action' AS action FROM tb_akd_rf_prodi_pt WHERE Kode_PT='$id'");
        return $res;
    }
    
    public function getListSyaratDaftar(){
        $res=$this->db->query("SELECT
            	Id_SyaratDaftar,
            	SUBSTRING_INDEX(Detail_SyaratDaftar, ' ', 5) AS Detail_SyaratDaftar,
            	SUM(LENGTH(Detail_SyaratDaftar) - LENGTH(REPLACE(Detail_SyaratDaftar, ' ', ''))+1) AS nWord
            FROM
            	tb_pmb_rf_syarat_daftar
            WHERE
            	isAktif = 'YES'
            GROUP BY Id_SyaratDaftar");
        
        return $res;
    }
    
    public function getListOfMataUjian(){
        return $this->db->query("SELECT
            	Id_Mata_Ujian,
            	Mata_Ujian
            FROM
            	tb_pmb_rf_mata_ujian
            WHERE
            	isAktif = 'YES'");
    }
    
    public function getDetailJalurPenerimaan($id){
        $res=$this->db->query("SELECT
                Id_JalurPenerimaan,
                Nama_JalurPenerimaan,
                Fasilitas,
                Periode_Penerimaan
                FROM
                tb_pmb_rf_jalur_penerimaan
                WHERE
                Id_JalurPenerimaan = '$id'");
        return $res->row_array();
        return $hasil;
    }
    
    public function setHapusSyarat($idJalur,$idSyarat){
        $res=$this->db->query("DELETE FROM tb_pmb_tr_syaratdaftar_penerimaan WHERE Id_JalurPenerimaan='$idJalur' AND Id_SyaratDaftar='$idSyarat'");
        return $res;
    }
    
    public function getKotaByProv($prov){
        $res=$this->db->query("SELECT Kode_Kota,CONCAT(Kota_Kabupaten,' ',Nama_Kota) AS NamaKota FROM tb_glb_rf_kota WHERE Kode_Prop='$prov' ORDER BY NamaKota");
        return $res;
    }
    
    public function getListAgama(){
        $res=$this->db->query("SELECT Agama_id, Agama FROM tb_peg_rf_agama");
        return $res;
    }
    
    public function getEnumFieldValues($table,$field){
        $text = "SHOW COLUMNS FROM $table WHERE FIELD='$field'";
        $res=$this->app_model->manualQuery($text);
        $result=$res->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0]['Type'];   
        }
        return $hasil;
    }
    
    public function getListOfSmaByKota($kota){
        //$res=$this->db->query("SELECT Nama_Kota FROM tb_glb_rf_kota WHERE Kode_Kota='$kota'");
//        if($res->num_rows()>0){
//            $res=$res->result_array();
//            $res=$res[0]['Nama_Kota'];
//        }else{
//            $res=array();
//        }
        $res=$this->db->query("select Kode_SMU, Asal_SMU, Alamat_SMU, Kota_SMU, Telp, Email FROM tb_akd_rf_asal_sekolah WHERE Kode_Kota='$kota'");
        return $res;
    }
    
    public function getListOfProdiPTAsal($p){
        $res=$this->db->query("SELECT Kode_Prodi,Nama_Prodi FROM tb_akd_rf_prodi_pt WHERE Kode_PT='".$p['Kode_PT']."' AND Jenjang='".$p['Jenjang']."'");
        return $res;
    }
    
    public function getListOfSyaratByJalurDaftar($p){
        $res=$this->db->query("SELECT
            	detJalur.Id_SyaratDaftar,
            	Detail_SyaratDaftar
            FROM
            	tb_pmb_tr_syaratdaftar_penerimaan detJalur INNER JOIN
            tb_pmb_rf_syarat_daftar syarat ON detJalur.Id_SyaratDaftar=syarat.Id_SyaratDaftar
            WHERE
            	Id_JalurPenerimaan='".$p['Id_JalurPenerimaan']."'");
        return $res;
    }
    
    public function getListOfJurusanSma(){
        $res=$this->db->query("SELECT Id_Jurusan,Nama_Jurusan FROM tb_pmb_rf_jurusan WHERE isAktif='YES'");
        return $res;
    }
    
    public function getListOfNegara(){
        $res=$this->db->query("SELECT `Code`,`Name` FROM tb_glb_rf_negara ORDER BY `Name`");
        return $res;
    }
    
    public function getListOfPT(){
        $res=$this->db->query("SELECT Kode_PT,Nama_PT FROM tb_akd_rf_perguruan_tinggi ORDER BY Nama_PT");
        return $res;
    }
    
    public function getListOfBiayaStudi(){
        $res=$this->db->query("SELECT Kode_BiayaStudi,Keterangan_Biaya FROM tb_pmb_rf_biaya_studi");
        return $res;
    }
    
    public function getDaftarJenjang(){
        $res=$this->db->query("SELECT Kode_Jenjang,Nama_Jenjang FROM tb_akd_rf_jenjang");
        return $res;
    }
    
    public function getListOfJalurPenerimaan(){
        $res=$this->db->query("SELECT Id_JalurPenerimaan,Nama_JalurPenerimaan FROM tb_pmb_rf_jalur_penerimaan WHERE isAktif='YES'");
        return $res;
    }
    function getListOfProdyByJenjang($jenjang){
        $res=$this->db->query("SELECT Kode_Prodi, Nama_Prodi FROM tb_akd_rf_prodi WHERE Jenjang='$jenjang' AND isAktif='YES' ORDER BY Nama_Prodi");
        return $res;
    }
    
    function getDetailOfPerguruanTinggi($kodePT){
        $res=$this->db->query("SELECT
            	Kode_Yayasan,
            	Kode_PT,
            	id_sp,
            	Nama_PT,
            	Nama_Singkat,
            	Alamat_1,
            	Alamat_2,
            	kota.Kode_Prop AS Prov_PT,
            	Nama_Prop,
            	Kota_Asal_PT,
            	CONCAT(
            		Kota_Kabupaten,
            		' ',
            		Nama_Kota,
                    ', ',
                    Nama_Prop
            	) AS Kota_PT,
            	Kode_Pos,
            	Telepon,
            	Fax,
            	Akta_Pendirian,
            	DATE_FORMAT(Tgl_Akta,'%d %M %Y') Tgl_Akta_formated,
            	Tgl_Akta,
            	Email_PT,
            	Website_PT,
            	pt.Jenis_PT,
            	DATE_FORMAT(Tgl_Awal_Pendirian,'%d %M %Y') Tgl_Awal_Pendirian_formated,
            	Tgl_Awal_Pendirian,
            	jenisPt.Jenis_PT AS det_Jenis_PT
            FROM
            	tb_akd_rf_perguruan_tinggi pt
            LEFT JOIN tb_glb_rf_kota kota ON pt.Kota_Asal_PT = kota.Kode_Kota
            LEFT JOIN tb_akd_rf_propinsi prop ON prop.Kode_Prop = kota.Kode_Prop
            LEFT JOIN tb_akd_rf_jenis_pt jenisPt ON jenisPt.Id_Jenis_PT = pt.Jenis_PT
            WHERE
            	Kode_PT = '$kodePT'");
        return $res->row_array();
    }
    function getDetailOfProdiPt($id,$pt){
        $res=$this->db->query("SELECT Kode_PT,Kode_Prodi,Jenjang,Nama_Prodi,Telepon,Email FROM tb_akd_rf_prodi_pt WHERE Kode_Prodi='$id' AND Kode_PT='$pt'");
        return $res->row_array();
    }
    function getProfileCamabaById($id){
        $res=$this->db->query("SELECT Email FROM tb_pmb_tr_camaba WHERE Id_Camaba='$id'");
        $res=$res->row_array();
        $has=$this->getProfileCamaba($res['Email']);
        return $has;
    }
    function getProfileCamaba($email){
        $res=$this->db->query("SELECT
        	nama AS pre_Nama_Mhs,
        IF(JK IS NULL,NULL,IF (
        	JK = 'L',
        	'Laki-laki',
        	'Perempuan'
        )) AS JenisKelamin,
         CONCAT(
        	kotaLahr.Nama_Kota,
        	', ',
        	DATE_FORMAT(Tgl_Lahir, '%d/%m/%Y')
        ) AS Tempat_TglLahir,
         agama.Agama,
         CONCAT(Alamat_RT, '/', Alamat_RW) AS RT_RW_Camaba,
         CONCAT(kotaAlmt.Kota_Kabupaten,' ',kotaAlmt.Nama_Kota) AS Alamat_Kota,
         negara.`Name` AS WargaNegara,
         prop.Nama_Prop AS Alamat_Prov_Camaba,
         jnsTgl.nm_jns_tinggal,
         altTrans.nm_alat_transport,
         CONCAT(
        	kotaAsl.Kota_Kabupaten,
        	' ',
        	kotaAsl.Nama_Kota
         ) AS Alamat_Kota_Asl,
         propAsl.Nama_Prop AS Alamat_Prov_Asl,
         CONCAT(
        	kotaOrtu.Kota_Kabupaten,
        	' ',
        	kotaOrtu.Nama_Kota
         ) AS Alamat_Kota_Ortu,
         CONCAT(
        	kotaOrtu.Kota_Kabupaten,
        	' ',
        	kotaOrtu.Nama_Kota,', ',
            propOrtu.Nama_Prop
         ) AS Kota_Prov_Ortu,
         propOrtu.Nama_Prop AS Prop_Ortu,
         DATE_FORMAT(Tgl_Lahir_Ayah, '%d/%m/%Y') AS TglLhrAyah,
         pendAyah.nm_jenj_didik AS Jenjang_Pendidikan_Ayah,
         pkrjnAyah.Pekerjaan AS PekerjaanAyah,
         pghslnAyah.nm_penghasilan AS Penghasilan_Ayah,
         DATE_FORMAT(Tgl_Lahir_Ayah, '%d/%m/%Y') AS TglLhrIbu,
         pendIbu.nm_jenj_didik AS Jenjang_Pendidikan_Ibu,
         pkrjnIbu.Pekerjaan AS PekerjaanIbu,
         pghslnIbu.nm_penghasilan AS Penghasilan_Ibu,
         DATE_FORMAT(Tgl_Lahir_Wali, '%d/%m/%Y') AS TglLhrWali,
         CONCAT(
        	kotaWali.Kota_Kabupaten,
        	' ',
        	kotaWali.Nama_Kota
         ) AS Alamat_Kota_Wali,
         propWali.Nama_Prop AS Alamat_Prov_Wali,
         pendWali.nm_jenj_didik AS Jenjang_Pendidikan_Wali,
         pkrjnWali.Pekerjaan AS PekerjaanWali,
         pghslnWali.nm_penghasilan AS Penghasilan_Wali,
         sklh.Asal_SMU AS SMU,
         sklh.Alamat_SMU,
         CONCAT(
        	kotaSklh.Kota_Kabupaten,
        	' ',
        	kotaSklh.Nama_Kota
         ) AS Alamat_Kota_Sklh,
         propSklh.Nama_Prop AS Alamat_Prov_Sklh,
         jrsn.Nama_Jurusan,
         DATE_FORMAT(Tgl_Lulus, '%d/%m/%Y') AS TglLulus,
         CONCAT(pt.Nama_Singkat,' (',pt.Nama_PT,')') AS Nama_PT,
         prodiPt.Nama_Prodi,
         jnjang.Nama_Jenjang,
         prodiPt.Nama_Prodi,
         pkrjnMhs.Pekerjaan AS PekerjaanMhs,
         prodi.Nama_Prodi pilihanProdi,
         jnjangProdi.Nama_Jenjang AS PilihanJenjang,
         jnjangProdi.Kode_Jenjang AS Pilihan_Jenjang,
         klsMhs.Kelas_Deskripsi,
         DATE_FORMAT(Tgl_Daftar, '%d/%m/%Y') AS TglDaftar,
         CONCAT(Semester_Masuk,' ',Tahun_Masuk) AS Periode_Masuk,
         camaba.JK AS JK_Mhs,
         kotaLahr.Kode_Prop AS Prov_Lahir,
         kotaAlmt.Kode_Prop AS Alamat_Prov,
         kotaAsl.Kode_Prop AS Prov_Asal_Mhs,
         kotaAlmt.Kode_Kota AS Alamat_Kode_Kota,
         kotaAsl.Kode_Kota AS Kode_Kota_asl,
         kotaOrtu.Kode_Prop AS Prov_Ortu,
         kotaOrtu.Kode_Kota AS Kode_Kota_Ortu,
         kotaWali.Kode_Prop AS Prov_Wali,
         kotaWali.Kode_Kota AS Kode_Kota_Wali,
         kotaSklh.Kode_Prop AS Prov_SMA,
         kotaSklh.Kode_Kota AS Kota_SMA,
         prodiPt.Jenjang AS Jenjang_PT,
         IFNULL(camaba.Email,reg.Email) AS pre_Email,
         IFNULL(camaba.Kode_SMU,reg.Kode_SMU) AS pre_Kode_SMU,
         CONCAT(files.Domain,files.Direktori,files.NamaFile) AS Url_Foto,
         CONCAT(configProdi.`value`,'. (',plihanProdi.Jenjang,') ',plihanProdi.Nama_Prodi) AS NamaPilihanProdi,
         reg.*, camaba.*
        FROM
        	tb_pmb_tr_camaba_reg reg
        LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
        LEFT JOIN tb_akd_rf_propinsi prop ON prop.Kode_Prop = reg.Kode_Prop
        LEFT JOIN tb_glb_rf_kota kotaLahr ON camaba.Tempat_Lahir = kotaLahr.Kode_Kota
        LEFT JOIN tb_glb_rf_kota kotaAlmt ON camaba.Alamat_Kode_Kota = kotaAlmt.Kode_Kota
        LEFT JOIN tb_peg_rf_agama agama ON agama.agama_id = camaba.Agama_id
        LEFT JOIN tb_glb_rf_negara negara ON negara.`Code` = camaba.Kewarganegaraan
        LEFT JOIN tb_glb_rf_jenis_tinggal jnsTgl ON jnsTgl.id_jns_tinggal=camaba.Id_Jenis_Tinggal
        LEFT JOIN tb_glb_rf_alat_transport altTrans ON altTrans.id_alat_transport=camaba.Id_Alamat_Transport
        LEFT JOIN tb_glb_rf_kota kotaAsl ON camaba.Kode_Kota_asl = kotaAsl.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi propAsl ON propAsl.Kode_Prop = kotaAsl.Kode_Prop
        LEFT JOIN tb_glb_rf_kota kotaOrtu ON camaba.Kode_Kota_Ortu = kotaOrtu.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi propOrtu ON propOrtu.Kode_Prop = kotaOrtu.Kode_Prop
        LEFT JOIN tb_hlp_conf_jenjang_pendidikan pendAyah ON pendAyah.id_jenj_didik=camaba.Id_Jenjang_Pendidikan_Ayah
        LEFT JOIN tb_akd_rf_pekerjaan pkrjnAyah ON pkrjnAyah.Kd_Pekerjaan=camaba.Kd_Pekerjaan_Ayah
        LEFT JOIN tb_glb_rf_penghasilan pghslnAyah ON pghslnAyah.id_penghasilan=camaba.Id_Penghasilan_Ayah
        LEFT JOIN tb_hlp_conf_jenjang_pendidikan pendIbu ON pendIbu.id_jenj_didik=camaba.Id_Jenjang_Pendidikan_Ibu
        LEFT JOIN tb_akd_rf_pekerjaan pkrjnIbu ON pkrjnIbu.Kd_Pekerjaan=camaba.Kd_Pekerjaan_Ibu
        LEFT JOIN tb_glb_rf_penghasilan pghslnIbu ON pghslnIbu.id_penghasilan=camaba.Id_Penghasilan_Ibu
        LEFT JOIN tb_glb_rf_kota kotaWali ON camaba.Kode_Kota_Wali = kotaWali.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi propWali ON propWali.Kode_Prop = kotaWali.Kode_Prop
        LEFT JOIN tb_hlp_conf_jenjang_pendidikan pendWali ON pendWali.id_jenj_didik=camaba.Id_Jenjang_Pendidikan_Wali
        LEFT JOIN tb_akd_rf_pekerjaan pkrjnWali ON pkrjnWali.Kd_Pekerjaan=camaba.Kd_Pekerjaan_Wali
        LEFT JOIN tb_glb_rf_penghasilan pghslnWali ON pghslnWali.id_penghasilan=camaba.Id_Penghasilan_Wali
        LEFT JOIN tb_akd_rf_asal_sekolah sklh ON sklh.Kode_SMU=reg.Kode_SMU
        LEFT JOIN tb_glb_rf_kota kotaSklh ON sklh.Kode_Kota = kotaSklh.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi propSklh ON propSklh.Kode_Prop = kotaSklh.Kode_Prop
        LEFT JOIN tb_pmb_rf_jurusan jrsn ON jrsn.Id_Jurusan = camaba.Id_Jurusan
        LEFT JOIN tb_akd_rf_perguruan_tinggi pt ON camaba.Kode_PT_Asal=pt.Kode_PT
        LEFT JOIN tb_akd_rf_prodi_pt prodiPt ON prodiPt.Kode_Prodi=camaba.Kode_Prodi_PT_Asal AND prodiPt.Kode_PT=camaba.Kode_PT_Asal
        LEFT JOIN tb_akd_rf_jenjang jnjang ON jnjang.Kode_Jenjang=prodiPt.Jenjang
        LEFT JOIN tb_akd_rf_pekerjaan pkrjnMhs ON pkrjnMhs.Kd_Pekerjaan=camaba.Kd_pekerjaan_mhs
        LEFT JOIN tb_akd_rf_prodi prodi ON prodi.Kode_Prodi=camaba.Kode_Prodi
        LEFT JOIN tb_akd_rf_jenjang jnjangProdi ON jnjangProdi.Kode_Jenjang=prodi.Jenjang
        LEFT JOIN tb_akd_rf_kelas_mhs klsMhs ON klsMhs.Kelas_Mhs=camaba.Kelas
        LEFT JOIN tb_app_rf_files files ON files.IDFile=camaba.ID_File_Photo
        LEFT JOIN tb_akd_rf_prodi plihanProdi ON plihanProdi.Kode_Prodi=camaba.Kode_Prodi
        LEFT JOIN tb_app_rf_config configProdi ON configProdi.conf_name=camaba.Kode_Prodi
        WHERE
        	reg.email = '$email'");
        if($res->num_rows()>0){
            $data=$res->row_array();
            $data['Nama_Mhs']=$data['pre_Nama_Mhs'];
            $data['Email']=$data['pre_Email'];
            $data['Telp']=$data['telp'];
            $data['Kode_SMU']=$data['pre_Kode_SMU'];
            if($data['Url_Foto']=='' || @getimagesize($data['Url_Foto'])==false){
                $data['Url_Foto']=conf_link($this->getConfigItem('no_picture_url'));
            }
        }else $data=array();
        return $data; 
    }
    function getLangkahDaftar(){
        $res=$this->db->query("SELECT
            	Id_Langkah,
            	Langkah_Daftar,
                Langkah_Ke,
                Link_Target
            FROM
            	tb_pmb_rf_langkah_daftar langkah
            WHERE
            	langkah.isAktif = 'YES'
            ORDER BY Langkah_Ke");
        return $res;
    }
    function getLangkahKeCamaba($email){
        $res=$this->db->query("SELECT
                Id_StatusLangkah,
            	reg.Id_Langkah_Daftar,
            	langkah.Langkah_Ke,
            	statLang.Status_Langkah_Daftar,
            	statLang.Pesan
            FROM
            	tb_pmb_tr_camaba_reg reg
            LEFT JOIN tb_pmb_rf_langkah_daftar langkah ON reg.Id_Langkah_Daftar = langkah.Id_Langkah
            LEFT JOIN tb_pmb_rf_status_langkah_daftar statLang ON reg.Id_Status_Langkah_Daftar=statLang.Id_StatusLangkah
            WHERE
            	email = '$email'");
        return $res->row_array();
    }
    function getDataCamabaReg($username){
        $res=$this->db->query("SELECT
            	nama AS Nama_Mhs,
            	reg.Kode_Prop,
            	reg.Kode_Kota,
            	reg.Kode_SMU,
            	reg.Email,
            	reg.Telp,
            	kota.Kode_Prop AS Prov_SMA,
            	sklh.Kode_Kota AS Kota_SMA
            FROM
            	tb_pmb_tr_camaba_reg reg LEFT JOIN tb_akd_rf_asal_sekolah sklh ON reg.Kode_SMU=sklh.Kode_SMU
            LEFT JOIN tb_glb_rf_kota kota ON kota.Kode_Kota=sklh.Kode_Kota
            WHERE
            	reg.email='$username'");
        return $res->row_array();
    }
    function updateLangkahPendaftaranCamaba($email,$langkah,$status){
        $data=array(
            'Id_Langkah_Daftar'=>$langkah,
            'Id_Status_Langkah_Daftar'=>$status
        );
        $data=array_filter($data);
        $key=array(
            'email'=>$email
        );
        $res=$this->db->update("tb_pmb_tr_camaba_reg",$data,$key);
        return $res;
    }
    function getUserData($username){
        $res=$this->db->query("SELECT
            	a.user_username,
            	a.nama AS namaLengkap,
            	a.Role_id,
            	a.Role_Name,
            	IFNULL(a.photo, '') AS photo
            FROM
            	(
            		SELECT
            			user_username,
            			user_password,
            			nama,
            			gp.Role_id,
            			Role_Name,
            			CONCAT(Domain, Direktori, NamaFile) AS photo
            		FROM
            			tb_app_tr_user_group gp
            		INNER JOIN tb_app_rf_user us ON gp.Username = us.user_username
            		LEFT JOIN tb_peg_rf_pegawai peg ON us.NIP = peg.nip
            		INNER JOIN tb_app_rf_group rf_gp ON rf_gp.Role_id = gp.Role_id
            		LEFT JOIN tb_app_rf_files files ON peg.IDFile = files.IDFile
            		WHERE
            			user_username = '$username'
                    AND gp.App_id='".$this->config->item('application_id')."'
            	) a
            UNION
            	SELECT
            		reg.email AS Username,
            		nama,
            		'camaba' AS Role_id,
            		'Calon Mahasiswa' AS Role_Name,
            		CONCAT(
            			files.Domain,
            			files.Direktori,
            			files.NamaFile
            		) AS photo
            	FROM
            		tb_pmb_tr_camaba_reg reg
            	LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            	LEFT JOIN tb_app_rf_files files ON camaba.ID_File_Photo = files.IDFile
            	LEFT JOIN tb_app_rf_group grp ON grp.Role_id = 'camaba'
            	WHERE
            		reg.email = '$username'");
        
        return $res->row_array();
    }
    function isCamabaExist($username){
        $res=$this->db->query("SELECT Id_Camaba FROM tb_pmb_tr_camaba WHERE Email='$username'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isBayarDaftarExist($username){
        $res=$this->db->query("SELECT Username_Reg FROM tb_pmb_tr_bayar_daftar WHERE Username_Reg='$username'");
        if($res->num_rows()>0) return true; else return false;
    }
    function rekeningDaftarPmb(){
        $res=$this->db->query("SELECT
            	Nama_Bank,
            	p.No_Rekening,
            	Atas_Nama
            FROM
            	tb_glb_rf_peruntukan_rekening p
            INNER JOIN tb_glb_rf_rekening_bank_pt r ON p.No_Rekening=r.No_Rekening
            INNER JOIN tb_glb_rf_bank b ON b.Kode_Bank=r.Kode_Bank
            WHERE
	           p.id_peruntukan='1'");
        return $res;
    }
    function prepareConfigProdi(){
        $res=$this->db->query("SELECT Kode_Prodi,Nama_Prodi,Jenjang FROM tb_akd_rf_prodi prodi WHERE Kode_Prodi NOT IN (SELECT conf_name FROM tb_app_rf_config)");
        if($res->num_rows()>0){
            $data=array();
            foreach($res->result_array() as $i=>$r){
                $data[$i]['application']=$this->config->item('application_id');
                $data[$i]['conf_name']=$r['Kode_Prodi'];
                $data[$i]['conf_caption']=$r['Jenjang'].' '.$r['Nama_Prodi'];
                $data[$i]['deskripsi']='Kode nomor ujian untuk program studi '.$r['Jenjang'].' '.$r['Nama_Prodi'];
                $data[$i]['Order']='2';
                $data[$i]=$this->addInsertLog($data[$i]);
            }
            $has=$this->db->insert_batch('tb_app_rf_config',$data);
        }
        return false;
    }
    function prepareConfigProdiUjian(){
        $res=$this->db->query("SELECT Kode_Prodi FROM tb_akd_rf_prodi prodi WHERE Kode_Prodi NOT IN (SELECT Kode_Prodi FROM tb_pmb_rf_ujian_masuk)");
        if($res->num_rows()>0){
            $data=array();
            foreach($res->result_array() as $i=>$r){
                $data[$i]['application']=$this->config->item('application_id');
                $data[$i]['conf_name']=$r['Kode_Prodi'];
                $data[$i]['conf_caption']=$r['Jenjang'].' '.$r['Nama_Prodi'];
                $data[$i]['deskripsi']='Kode nomor ujian untuk program studi '.$r['Jenjang'].' '.$r['Nama_Prodi'];
                $data[$i]['Order']='2';
                $data[$i]=$this->addInsertLog($data[$i]);
            }
            $has=$this->db->insert_batch('tb_app_rf_config',$data);
        }
        return false;
    }
    function getConfigItem($key){
        $res=$this->db->query("SELECT `value` FROM tb_app_rf_config WHERE conf_name='$key'");
        $res=$res->row_array();
        if(isset($res['value'])) return $res['value']; else return false;
    }
    
    function getNewNoTes($pre){
        $res=$this->db->query("SELECT IFNULL(MAX(Nomer_Tes)+1,CONCAT('$pre','001')) AS NewId FROM tb_pmb_tr_camaba WHERE LEFT(Nomer_Tes,6)='$pre'");
        $res=$res->row_array();
        return $res['NewId'];
    }
    function getMataUjianCamaba($kodeProdi){
        return $this->db->query("SELECT
            	mata.Mata_Ujian
            FROM
            	tb_pmb_rf_ujian_masuk ujian
            INNER JOIN tb_pmb_rf_mata_ujian mata ON ujian.Mata_Ujian = mata.Id_Mata_Ujian
            WHERE
            	Kode_Prodi = '$kodeProdi'
            AND mata.isAktif='YES'");
    }
    function getMataUjianCamaba_Kartu($kodeProdi){
        $data=$this->getMataUjianCamaba($kodeProdi);
        $res='';
        foreach($data->result_array() as $d){
            $res.='* '.$d['Mata_Ujian'].'<br />';
        }
        return $res;
    }
    function getProfilePeg($username){
        $res=$this->db->query("SELECT
            	peg.nip,
            	CONCAT(IFNULL(gelar_depan,''),peg.nama,IFNULL(gelar_belakang,'')) AS nama,
            	CONCAT(tempat_lahir,', ',DATE_FORMAT(tgl_lahir,'%d/%m/%Y')) AS tempattgl_lahir,
            	alamat,
            	telp,
            	email
            FROM
            	tb_app_rf_user users INNER JOIN tb_peg_rf_pegawai peg ON users.NIP=peg.nip
            WHERE
            	users.user_username = '$username'");
        return $res->row_array();
    }
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */