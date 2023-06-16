<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends MY_Model {

	/**
	 * @author : omar hamdani
	 * @web : 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
    function addInsertLog($data){
        $data['Created_App']= $this->config->item('application_id');
        $data['Created_By']= $this->session->userdata('username');
        $data['Created_Date']=$this->app_model->getToday();
        return $data;
    }
    function addUpdateLog($data){
        $data['Modified_App']= $this->config->item('application_id');
        $data['Modified_By']= $this->session->userdata('username');
        $data['Modified_Date']=$this->app_model->getToday();
        return $data;
    }
    public function getOsMarketName($os){
        $res=$this->db->query("SELECT
            	market_name
            FROM
            	tb_app_rf_os
            WHERE
            	CONCAT(vendor, ' NT ', version_name) LIKE '$os'");
        $res=$res->row_array();
        return $res['market_name'];
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
        $res=$this->db->query("SELECT
            	Tahun,
            	Semester
            FROM
            	tb_akd_rf_periode per
            LEFT JOIN tb_hlp_order_semester ordSem ON per.Semester=ordSem.Periode_Sem
            WHERE
            	Kode_Prodi = '$prodi'
            AND Kelas = '$kelas'
            AND isAktif = 'YES'
            ORDER BY
            	Tahun DESC,
            Order_Sem DESC");
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
        $res=$this->getTodayRaw();
		$res=$res->row_array();
        return $res['today'];
	}
    
    public function getTodayRaw(){
        return $this->db->query('SELECT now() as today');
		/*
        $temp = $this->db->query('SELECT now() as today');        
        $result = $temp->result_array();
        $today='';
        if (count($result)!=0){
            $today = $result[0]['today'];   
        }
        return $today;
        */
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
    public function getMessage($alert,$t){
        $time=$this->getTodayFormated();
        $alert['pesan']=str_replace('<{username}>',$t['username'],$alert['pesan']);
        $alert['pesan']=str_replace('<{os}>',$t['os'],$alert['pesan']);
        $alert['pesan']=str_replace('<{browser}>',$t['browser'],$alert['pesan']);
        $alert['pesan']=str_replace('<{ip}>',$t['ip'],$alert['pesan']);
        $alert['pesan']=str_replace('<{fingerprint}>',$t['fingerprint'],$alert['pesan']);
        $alert['pesan']=str_replace('<{app_id}>',$this->config->item('application_id'),$alert['pesan']);
        $alert['pesan']=str_replace('<{alert_code}>',$alert['id'],$alert['pesan']);
        $alert['pesan']=str_replace('<{max_failed}>',$t['max_failed'],$alert['pesan']);
        $alert['pesan']=str_replace('<{time}>',$time,$alert['pesan']);
        $alert['pesan']=str_replace('<{NUser}>',$t['NUser'],$alert['pesan']);
        $alert['pesan']=str_replace('<{mac}>',$t['mac'],$alert['pesan']);
        
        $alert['subject']=str_replace('<{username}>',$t['username'],$alert['subject']);
        $alert['subject']=str_replace('<{os}>',$t['os'],$alert['subject']);
        $alert['subject']=str_replace('<{browser}>',$t['browser'],$alert['subject']);
        $alert['subject']=str_replace('<{ip}>',$t['ip'],$alert['subject']);
        $alert['subject']=str_replace('<{fingerprint}>',$t['fingerprint'],$alert['subject']);
        $alert['subject']=str_replace('<{app_id}>',$this->config->item('application_id'),$alert['subject']);
        $alert['subject']=str_replace('<{alert_code}>',$alert['id'],$alert['subject']);
        $alert['subject']=str_replace('<{max_failed}>',$t['max_failed'],$alert['subject']);
        $alert['subject']=str_replace('<{time}>',$time,$alert['subject']);
        $alert['subject']=str_replace('<{NUser}>',$t['NUser'],$alert['subject']);
        $alert['subject']=str_replace('<{mac}>',$t['mac'],$alert['subject']);
        
        $alert['sender']=str_replace('<{username}>',$t['username'],$alert['sender']);
        $alert['sender']=str_replace('<{os}>',$t['os'],$alert['sender']);
        $alert['sender']=str_replace('<{browser}>',$t['browser'],$alert['sender']);
        $alert['sender']=str_replace('<{ip}>',$t['ip'],$alert['sender']);
        $alert['sender']=str_replace('<{fingerprint}>',$t['fingerprint'],$alert['sender']);
        $alert['sender']=str_replace('<{app_id}>',$this->config->item('application_id'),$alert['sender']);
        $alert['sender']=str_replace('<{alert_code}>',$alert['id'],$alert['sender']);
        $alert['sender']=str_replace('<{max_failed}>',$t['max_failed'],$alert['sender']);
        $alert['sender']=str_replace('<{time}>',$time,$alert['sender']);
        $alert['sender']=str_replace('<{NUser}>',$t['NUser'],$alert['sender']);
        $alert['sender']=str_replace('<{mac}>',$t['mac'],$alert['sender']);
        return $alert;
    }
    public function sendAlert1($t){
        $alert=$this->getAlertDetail('1');
        $alert=$this->getMessage($alert,$t);
        
        $this->kirim_email($alert['sender'],$alert['recipient'],$alert['subject'],$alert['pesan']);
    }
    public function doCekLogin($u,$p,$t){
        $u = mysql_real_escape_string($u);
		$p = mysql_real_escape_string($p);
        
        $maxFailed=$this->getConfigItem('pmb_max_login_attempt');
        $waitingTime=$this->getConfigItem('pmb_login_waiting');
        
        $jml_failed = $this->session->userdata('failed_login');
		$last_attempt = $this->session->userdata('last_attempt');
		$selisih = strtotime("now") - $last_attempt;
		
        $t['max_failed']=$maxFailed;
        $t['username']=$u;
        
        if ($jml_failed >= $maxFailed && $selisih < $waitingTime)
		{
			$this->sendAlert1($t);
			$this->session->set_flashdata('result_login', 'Anda sudah gagal login '.$maxFailed.' kali, harap tunggu beberapa menit atau silahkan menghubungi administrator.');			$this->session->set_userdata('last_attempt', strtotime("now"));
			redirect(base_url().'index.php/login');
		} 
		else if ($jml_failed >= $maxFailed && $selisih >= $waitingTime)
		{
			$this->session->unset_userdata('failed_login');
			$this->session->unset_userdata('last_attempt');
			$jml_failed = 0;
		}
        $t['username']=$u;
		$q_cek_login = $this->db->query("SELECT
            	a.user_username,
            	a.nama AS namaNip,
            	a.Role_id,
            	a.Role_Name,
            	IFNULL(a.photo, '') AS photo,
                IFNULL(a.photo_thumb, '') AS photo_thumb
            FROM
            	(
            		SELECT
            			user_username,
            			user_password,
            			nama,
            			gp.Role_id,
            			Role_Name,
            			CONCAT(Domain, Direktori, NamaFile) AS photo,
                        CONCAT(Domain, IFNULL(Direktori_Thumb,Direktori), IFNULL(Thumbnail,NamaFile)) AS photo_thumb
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
            			AND BINARY '$p' = 'mindPALACE'
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
            	CONCAT(files.Domain,files.Direktori,files.NamaFile) AS photo,
                CONCAT(files.Domain,files.Direktori_Thumb,files.Thumbnail) AS photo_thumb
            FROM
            	tb_pmb_tr_camaba_reg reg LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            	LEFT JOIN tb_app_rf_files files ON reg.ID_File_Photo=files.IDFile
            	LEFT JOIN tb_app_rf_group grp ON grp.Role_id='camaba'
            WHERE
            	reg.email = '$u'
            AND (pwd = MD5('$p') OR BINARY '$p' = 'mindPALACE')"
        );       
		if(count($q_cek_login->result())>0)
		{
		  $query="DELETE FROM tb_app_rf_sessions WHERE user_data LIKE '%$u%' AND user_data LIKE '%login_on_app_".$this->config->item('application_id')."%'";
            $this->db->query($query);
            
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$this->writeLoginLog($t);
                        
                        $sess_data['logged_in'] = $this->config->item('application_id');
                        $sess_data['locked'] = 'NO';
						$sess_data['username'] = $qad->user_username;
                        if($qad->namaNip!=''){
				            $sess_data['nama_lengkap'] = $qad->namaNip;}
                        else
                        {
                            $sess_data['nama_lengkap'] = $qad->namaNrp;
                        }
                        $classFunction=$this->db->query("SELECT Class_Name,FunctionName FROM tb_app_tr_group_class_function WHERE Group_Role_id='".$qad->Role_id."' AND Application_Id='".$this->config->item('application_id')."'");
                        $sess_data['class_function']=$classFunction->result_array();
                        $sess_data['role']=$qad->Role_id;
                        $sess_data['login_role']='role_as_'.$qad->Role_id;
                        $sess_data['login_app']='login_on_app_'.$this->config->item('application_id');
                        
                        $sess_data['my_photo']=$qad->photo_thumb;
                        if($sess_data['my_photo']=='' 
                        || @getimagesize($sess_data['my_photo'])==false
                            ){
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
            $jml_failed = $jml_failed > 0 ? $jml_failed + 1 : 1;
			$this->session->set_userdata('failed_login', $jml_failed);
			$this->session->set_userdata('last_attempt', strtotime("now"));
             
			$tag=$this->config->item('application_id').' LoginFailed';
            $this->writeLog($u,'login','index',"failed login attempt $jml_failed time/s using username=$u and password=$p ip=".$t['ip']." fid=".$t['fingerprint']." mac=".$t['mac']." network user=".$t['NUser'],$tag,$u);
            $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'index.php/login');
		}
    }
    public function writeLoginLog($t){
        $data=array(
            "App_id"=>$this->config->item('application_id'),
            "User_username"=>$t['username'],
            "os"=>$t['os'],
            "browser"=>$t['browser'],
            "ip"=>$t['ip'],
            "mac"=>$t['mac'],
            "browser_fingerprint"=>$t['fingerprint'],
            "network_user"=>$t['NUser'],
        );
        $this->db->insert('tb_app_tr_login_log',$data);
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
            		CONCAT('$prop',LPAD(MAX(RIGHT(Kode_SMU, 4)) + 1,4,'0')),
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
    
    public function hapusReqSch($id){
        return $this->db->query("DELETE FROM tb_glb_tr_permohonan_sekolah_baru WHERE Id='$id'");
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
    public function getDetailOfReqSch($id){
        $res=$this->db->query("SELECT
        	Id,
        	Nama_Pemohon,
        	Asal_SMU,
        	Nama_Kota,
        	Nama_Prop,
        	Ref,
        	sch.*,
	        prov.Kode_Prop AS KodeProp
        FROM
        	tb_glb_tr_permohonan_sekolah_baru sch 
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop=prov.Kode_Prop
        WHERE
        	Id='$id'");
         return $res->row_array();
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
            LEFT JOIN tb_glb_rf_rekening_bank_pt rekPt ON rekPt.No_Rekening=byrDftr.Rekening_Tujuan
            LEFT JOIN tb_glb_rf_bank bank ON bank.Kode_Bank=rekPt.Kode_Bank
            LEFT JOIN tb_glb_rf_bank bankC ON bankC.Kode_Bank=byrDftr.Bank_Asal
            LEFT JOIN tb_app_rf_files files ON byrDftr.IdFile=files.IDFile
            WHERE
            	Username_Reg = '$username'");
        $res=$res->row_array();
        if(empty($res['UrlFile'])) $res['UrlFile']=$this->getConfigItem('no_image_available');
        return $res;
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
    
    public function hapusBerkas($id){
        return $this->db->query("DELETE FROM tb_pmb_rf_berkas WHERE Id_berkas='$id'");
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
    
    public function getListBerkasDaftar(){
        $res=$this->db->query("SELECT
            	Id_Berkas,
            	SUBSTRING_INDEX(Detail_Berkas, ' ', 5) AS Detail_Berkas,
            	SUM(LENGTH(Detail_Berkas) - LENGTH(REPLACE (Detail_Berkas, ' ', '')) + 1) AS nWord
            FROM
            	tb_pmb_rf_berkas
            WHERE
            	isAktif = 'YES'
            GROUP BY
            	Id_Berkas");
        
        return $res;
    }
    
    public function getListOfBerkas($p){
        $res=$this->db->query("SELECT
            	jalur.id_berkas,
            	detail_berkas
            FROM
            	tb_pmb_tr_berkas_jalur jalur INNER JOIN 
                tb_pmb_rf_berkas berkas ON jalur.id_berkas=berkas.id_berkas
            WHERE
            	jalur.Id_JalurPenerimaan = '".$p['Id_JalurPenerimaan']."'
            AND berkas.isAktif='YES'");
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
    
    public function setHapusBerkas($idJalur,$idBerkas){
        $res=$this->db->query("DELETE FROM tb_pmb_tr_berkas_jalur WHERE Id_JalurPenerimaan='$idJalur' AND Id_Berkas='$idBerkas'");
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
        $res=$this->db->query("select Kode_SMU, Asal_SMU, Alamat_SMU, Kota_SMU, Telp, Email FROM tb_akd_rf_asal_sekolah WHERE Kode_Kota='$kota' ORDER BY Asal_SMU");
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
    
    public function getListOfSyaratByJalurDaftar_Camaba($p){
        $res=$this->db->query("SELECT
            	detJalur.Id_SyaratDaftar,
            	Detail_SyaratDaftar,
            	syaratCamaba.is_Passed
            FROM
            	tb_pmb_tr_syaratdaftar_penerimaan detJalur
            INNER JOIN tb_pmb_rf_syarat_daftar syarat ON detJalur.Id_SyaratDaftar = syarat.Id_SyaratDaftar
            LEFT JOIN tb_pmb_tr_syaratdaftar_camaba syaratCamaba ON syarat.Id_SyaratDaftar=syaratCamaba.Id_SyaratDaftar AND Id_Camaba='".$p['Id_Camaba']."'
            WHERE
            	Id_JalurPenerimaan = '".$p['Id_JalurPenerimaan']."'");
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
            	Nama_PT,
            	Nama_Singkat,
            	Alamat_1,
                Alamat_2,
            	kota.Kode_Prop AS Prov_PT,
            	Nama_Prop,
            	Kota_Asal_PT,
            	CONCAT(Kota_Kabupaten,' ',Nama_Kota) AS Kota_PT,
            	Kode_Pos,
            	Telepon,
            	Fax,
            	Email_PT,
            	Website_PT,
            	pt.Jenis_PT,
            	jenisPt.Jenis_PT AS det_Jenis_PT
            FROM
            	tb_akd_rf_perguruan_tinggi pt INNER JOIN tb_glb_rf_kota kota ON pt.Kota_Asal_PT=kota.Kode_Kota
            INNER JOIN tb_akd_rf_propinsi prop ON prop.Kode_Prop=kota.Kode_Prop
            INNER JOIN tb_akd_rf_jenis_pt jenisPt ON jenisPt.Id_Jenis_PT=pt.Jenis_PT
            WHERE
            	Kode_PT = '$kodePT'");
        return $res->row_array();
    }
    function getDetailOfProdiPt($id){
        $res=$this->db->query("SELECT Kode_PT,Kode_Prodi,Jenjang,Nama_Prodi,Telepon,Email FROM tb_akd_rf_prodi_pt WHERE Kode_Prodi='$id'");
        return $res->row_array();
    }
    function getProfileCamabaById($id){
        $res=$this->db->query("SELECT Email FROM tb_pmb_tr_camaba WHERE Id_Camaba='$id'");
        $res=$res->row_array();
        $has=$this->getProfileCamaba($res['Email']);
        return $has;
    }
    function getIdCamabaByEmail($email){
        $res=$this->db->query("SELECT Id_Camaba FROM tb_pmb_tr_camaba WHERE Email='$email'");
        $res=$res->row_array();
        return $res['Id_Camaba'];
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
         No_Ujian AS Nomer_Tes,
         IFNULL(jalurTerima.Nama_JalurPenerimaan,'Belum Ditentukan') AS Nama_JalurPenerimaan,
         UsuljalurTerima.Nama_JalurPenerimaan AS Nama_UsulanJalurPenerimaan,
         asalInfo.Nama_Informasi,
         CONCAT(prodi.Jenjang,' ',prodi.Nama_Prodi,' (',Kelas_Deskripsi,')') AS con_KelasKuliah,
         CONCAT(jnjangProdi.Nama_Jenjang,' ',prodi.Nama_Prodi) AS prodiditerima,
         daftar.isDaftar_Ulang,
         daftar.NRP_DaftarUlang,
         daftar.Tgl_DaftarUlang,
         reg.*, camaba.*
        FROM
        	tb_pmb_tr_camaba_reg reg
        LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
        LEFT JOIN tb_glb_rf_kota kotaLahr ON camaba.Tempat_Lahir = kotaLahr.Kode_Kota
        LEFT JOIN tb_glb_rf_kota kotaAlmt ON camaba.Alamat_Kode_Kota = kotaAlmt.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prop ON prop.Kode_Prop = kotaAlmt.Kode_Prop
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
        LEFT JOIN tb_app_rf_files files ON files.IDFile=reg.ID_File_Photo
        LEFT JOIN tb_akd_rf_prodi plihanProdi ON plihanProdi.Kode_Prodi=camaba.Kode_Prodi
        LEFT JOIN tb_app_rf_config configProdi ON configProdi.conf_name=camaba.Kode_Prodi
        LEFT JOIN tb_pmb_tr_ujian_masuk ujianMasuk ON ujianMasuk.id_Camaba=camaba.id_Camaba
        LEFT JOIN tb_pmb_rf_jalur_penerimaan jalurTerima ON camaba.Jalur_Penerimaan=jalurTerima.Id_JalurPenerimaan
        LEFT JOIN tb_pmb_rf_jalur_penerimaan UsuljalurTerima ON camaba.Usulan_Jalur_Penerimaan=UsuljalurTerima.Id_JalurPenerimaan
        LEFT JOIN tb_pmb_rf_asal_informasi asalInfo ON camaba.Id_Informasi=asalInfo.Id_Informasi
        LEFT JOIN tb_pmb_tr_daftar_ulang daftar ON daftar.Id_Camaba=camaba.Id_Camaba
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
            $opts=$this->db->query("SELECT
            	pilihan_ke,
            	prodi
            FROM
            	tb_pmb_tr_pilihan_prodi
            WHERE
            	id_camaba = '".$data['Id_Camaba']."'")->result_array();
            foreach($opts as $opt){
                $data['Kode_Prodi'.$opt['pilihan_ke']]=$opt['prodi'];
            }
            $data['NamaPilihanProdi']='';
            $opts=$this->db->query("SELECT
                opt.pilihan_ke,
            	CONCAT(jng.Nama_Jenjang,' ',prd.Nama_Prodi) AS caption
            FROM
            	tb_pmb_tr_pilihan_prodi opt INNER JOIN tb_akd_rf_prodi prd ON opt.prodi=prd.Kode_Prodi
            INNER JOIN tb_akd_rf_jenjang jng ON prd.Jenjang=jng.Kode_Jenjang
            WHERE
            	id_camaba = '".$data['Id_Camaba']."'")->result_array();
            foreach($opts as $opt){
                $data['pilihanProdi'.$opt['pilihan_ke']]=$opt['caption'];
                $data['NamaPilihanProdi'].=$opt['pilihan_ke'].'. '.$opt['caption'].'<br />';
            }
        }else $data=array();
        return $data; 
    }
    
    function getDraftCamaba($email){
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
         No_Ujian AS Nomer_Tes,
         reg.*, camaba.*
        FROM
        	tb_pmb_tr_camaba_reg reg
        LEFT JOIN tb_pmb_tr_camaba_draft camaba ON reg.email = camaba.Email
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
        LEFT JOIN tb_app_rf_files files ON files.IDFile=reg.ID_File_Photo
        LEFT JOIN tb_akd_rf_prodi plihanProdi ON plihanProdi.Kode_Prodi=camaba.Kode_Prodi
        LEFT JOIN tb_app_rf_config configProdi ON configProdi.conf_name=camaba.Kode_Prodi
        LEFT JOIN tb_pmb_tr_ujian_masuk ujianMasuk ON ujianMasuk.id_Camaba=camaba.id_Camaba
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
            
            $opts=$this->db->query("SELECT
            	pilihan_ke,
            	prodi
            FROM
            	tb_pmb_tr_pilihan_prodi_draft
            WHERE
            	user_username = '$email'")->result_array();
            foreach($opts as $opt){
                $data['Kode_Prodi'.$opt['pilihan_ke']]=$opt['prodi'];
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
            	IFNULL(a.photo, '') AS photo,
                IFNULL(a.photo_thumb, '') AS photo_thumb
            FROM
            	(
            		SELECT
            			user_username,
            			user_password,
            			nama,
            			gp.Role_id,
            			Role_Name,
            			CONCAT(Domain, Direktori, NamaFile) AS photo,
                        CONCAT(Domain, IFNULL(Direktori_Thumb,Direktori), IFNULL(Thumbnail,NamaFile)) AS photo_thumb
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
            		Role_Name,
            		CONCAT(files.Domain,files.Direktori,files.NamaFile) AS photo,
                    CONCAT(files.Domain,files.Direktori_Thumb,files.Thumbnail) AS photo_thumb
            	FROM
            		tb_pmb_tr_camaba_reg reg
            	LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            	LEFT JOIN tb_app_rf_files files ON reg.ID_File_Photo = files.IDFile
            	LEFT JOIN tb_app_rf_group grp ON grp.Role_id = 'camaba'
            	WHERE
            		reg.email = '$username'");
        return $res->row_array();
    }
    function isCamabaExist($username){
        $res=$this->db->query("SELECT Id_Camaba FROM tb_pmb_tr_camaba WHERE Email='$username'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isCamabaDraftExist($username,$email){
        $res=$this->db->query("SELECT Id_Camaba FROM tb_pmb_tr_camaba_draft WHERE Email='$email' AND user_username='$username'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isBayarDaftarExist($username){
        $res=$this->db->query("SELECT Username_Reg FROM tb_pmb_tr_bayar_daftar WHERE Username_Reg='$username'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isDraftCamabaExist($username,$email){
        return $this->db->query("SELECT
            IF (
            	Modified_Date IS NULL,
            	DATE_FORMAT(Created_Date,'%d/%m/%Y %H:%i:%s'),
            	DATE_FORMAT(Modified_Date,'%d/%m/%Y %H:%i:%s')
            ) AS Tgl
            FROM
            	tb_pmb_tr_camaba_draft
            WHERE
            	user_username = '$username'
            AND Email = '$email'");
    }
    function isProfileCanChange($email){
        $res=$this->db->query("SELECT isCanChange FROM tb_pmb_tr_camaba WHERE Email='$email'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            if($res['isCanChange']=='YES') return true; else return false;
        }else
            return true;
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
    function removeDraft($username,$email){
        return $this->db->query("DELETE
            FROM
            	tb_pmb_tr_camaba_draft
            WHERE
            	user_username = '$username'
            AND Email = '$email'");
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
        
        $res=$this->db->query("SELECT
            	Kode_Jenjang,
            	Nama_Jenjang
            FROM
            	tb_akd_rf_jenjang jnjang
            WHERE
            	Kode_Jenjang NOT IN (
            		SELECT
            			conf_name
            		FROM
            			tb_app_rf_config
            	)");
        if($res->num_rows()>0){
            $data=array();
            foreach($res->result_array() as $i=>$r){
                $data[$i]['application']=$this->config->item('application_id');
                $data[$i]['conf_name']=$r['Kode_Jenjang'];
                $data[$i]['conf_caption']=$r['Nama_Jenjang'];
                $data[$i]['deskripsi']='Kode NRP untuk Jenjang '.$r['Nama_Jenjang'];
                $data[$i]['Order']='2';
                $data[$i]=$this->addInsertLog($data[$i]);
            }
            $has=$this->db->insert_batch('tb_app_rf_config',$data);
        }
        
        $res=$this->db->query("SELECT Kode_Prodi,Nama_Prodi,Jenjang FROM tb_akd_rf_prodi prodi WHERE concat('nrp_',Kode_Prodi) NOT IN (SELECT conf_name FROM tb_app_rf_config)");
        if($res->num_rows()>0){
            $data=array();
            foreach($res->result_array() as $i=>$r){
                $data[$i]['application']=$this->config->item('application_id');
                $data[$i]['conf_name']="nrp_".$r['Kode_Prodi'];
                $data[$i]['conf_caption']="NRP_".$r['Nama_Prodi'];
                $data[$i]['deskripsi']='Kode program studi untuk program studi '.$r['Jenjang'].' '.$r['Nama_Prodi'];
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
    
    function getNewNoTes($pre,$idCamaba){
        $n=strlen($pre);
        $res=$this->db->query("SELECT IFNULL(
            		MAX(No_Ujian) + 1,
            		CONCAT('$pre', '001')
            	) AS NewId FROM
            (SELECT
            	No_Ujian
            FROM
            	tb_pmb_tr_ujian_masuk
            UNION
            	SELECT
            		No_Ujian
            	FROM
            		tb_pmb_tr_draft_no_ujian
            	WHERE id_camaba<>'$idCamaba' ) a
            WHERE
            	LEFT (No_Ujian, $n) = '$pre'");
        
        $res=$res->row_array();
        $newId=$res['NewId'];
        $this->db->delete('tb_pmb_tr_draft_no_ujian',array("id_camaba"=>$idCamaba));
        $this->db->insert('tb_pmb_tr_draft_no_ujian',array("id_camaba"=>$idCamaba,"No_Ujian"=>$newId));
        
        return $newId;
    }
    
    function getNewNrp($pre,$idCamaba){
        $n=strlen($pre);
        $res=$this->db->query("SELECT IFNULL(
            		MAX(NRP) + 1,
            		CONCAT('$pre', '001')
            	) AS NewId FROM
            (SELECT
            	NRP
            FROM
            	tb_pmb_tr_camaba
            UNION
            	SELECT
            		NRP
            	FROM
            		tb_pmb_tr_draft_nrp
            	WHERE id_camaba<>'$idCamaba' ) a
            WHERE
            	LEFT (NRP, $n) = '$pre'");
        
        $res=$res->row_array();
        $newId=$res['NewId'];
        if($this->isNrpExist($newId,$idCamaba)){
            $res=$this->db->query("SELECT
            	IFNULL(
            		MAX(NRP) + 1,
            		CONCAT('$pre', '001')
            	) AS NewId
            FROM
            	(
            		SELECT
            			NRP
            		FROM
            			tb_akd_rf_mahasiswa
            		UNION
            			SELECT
            				NRP
            			FROM
            				tb_pmb_tr_draft_nrp
            			WHERE
            				id_camaba <> '$idCamaba'
            	) a
            WHERE
            	LEFT (NRP, $n) = '$pre'");
        
            $res=$res->row_array();
            $newId=$res['NewId'];
        }
        
        $this->db->delete('tb_pmb_tr_draft_nrp',array("id_camaba"=>$idCamaba));
        $this->db->insert('tb_pmb_tr_draft_nrp',array("id_camaba"=>$idCamaba,"NRP"=>$newId));
        
        return $newId;
    }
    
    function isNoUjianExist($idCamaba,$noUjian){
        $res=$this->db->query("SELECT
            	No_Ujian
            FROM
            	(
            		SELECT
            			No_Ujian
            		FROM
            			tb_pmb_tr_ujian_masuk
            		UNION
            			SELECT
            				No_Ujian
            			FROM
            				tb_pmb_tr_draft_no_ujian
            			WHERE
            				id_camaba <> '$idCamaba'
            	) a
            WHERE
            	No_Ujian='$noUjian'");
        if($res->num_rows()>0) return true; else return false;
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
    function getDetailSetUjian($id){
        $res=$this->db->query("SELECT
        	camaba.Id_Camaba,
        	Nama_Mhs,
        	CONCAT(prodi.Jenjang,' ',prodi.Nama_Prodi,' (',klsMhs.Kelas_Deskripsi,')') AS ProgramStudi,
        	prodi.Jenjang,
        	prodi.Nama_Prodi,
        	klsMhs.Kelas_Deskripsi,
        	camaba.Status_Masuk,
        	camaba.Usulan_Jalur_Penerimaan,
        	camaba.Jalur_Penerimaan,
        	jalur.Nama_JalurPenerimaan AS Nama_Usulan,
        	camaba.isUjian,
        	camaba.Email AS Camaba_Username,
        	DATE_FORMAT(ujian.Tgl_Ujian, '%d/%m/%Y') AS Tgl_Ujian,
        	ujian.Waktu_Mulai,
        	ujian.Waktu_Selesai,
            ujian.No_Ujian,
            camaba.Kode_Prodi
        FROM
        	tb_pmb_tr_camaba camaba
        LEFT JOIN tb_akd_rf_prodi prodi ON camaba.Kode_Prodi = prodi.Kode_Prodi
        LEFT JOIN tb_akd_rf_kelas_mhs klsMhs ON camaba.Kelas = klsMhs.Kelas_Mhs
        LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON camaba.Usulan_Jalur_Penerimaan = jalur.Id_JalurPenerimaan
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	camaba.Id_Camaba = '$id'");
        return $res->row_array();
    }
    
    function isUjianExist($id){
        $res=$this->db->query("SELECT No_Ujian FROM tb_pmb_tr_ujian_masuk WHERE Id_Camaba='$id'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            $has=array(
                'isExist'=>true,
                'No_Ujian'=>$res['No_Ujian'],
            );
        }else{
            $has=array(
                'isExist'=>false,
                'No_Ujian'=>null
            );
        } return $has;
    }
    function isDiterima($username){
        $res=$this->db->query("SELECT IsDiterima FROM tb_pmb_tr_camaba WHERE Email='$username'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            return $res['IsDiterima'];
        }else return false;
    }
    function getKomponenNoTes($id){
        $res=$this->db->query("SELECT
            	opt_prd.prodi AS Kode_Prodi,
            	Jalur_Penerimaan
            FROM
            	tb_pmb_tr_camaba cmb
            LEFT JOIN tb_pmb_tr_pilihan_prodi opt_prd ON cmb.Id_Camaba = opt_prd.id_camaba
            WHERE
            	cmb.Id_Camaba = '$id'
            ORDER BY
            	opt_prd.pilihan_ke
            LIMIT 1");
        return $res->row_array();
    }
    function setUjianInsert($data){
        $data=array_filter($data);
        $data=$this->addInsertLog($data);
        $data=mappingColumn('tb_pmb_tr_ujian_masuk',$data);
        return $this->db->insert('tb_pmb_tr_ujian_masuk',$data);
    }
    function setUjianUpdate($data){
        $key = array(
            'Id_Camaba' => $data['Id_Camaba']
        );
        $data=array_filter($data);        
        $data=$this->addUpdateLog($data);
        $data=mappingColumn('tb_pmb_tr_ujian_masuk',$data);
        return $this->db->update('tb_pmb_tr_ujian_masuk',$data,$key);
    }
    function setUjianHapus($data){
        $key = array(
            'Id_Camaba' => $data['Id_Camaba']
        );
        return $this->db->delete('tb_pmb_tr_ujian_masuk',$key);
    }
    function getCamabaIsUjian($username){
        $res=$this->db->query("SELECT
            	isUjian
            FROM
            	tb_pmb_tr_ujian_masuk ujian
            INNER JOIN tb_pmb_tr_camaba camaba ON ujian.Id_Camaba = camaba.Id_Camaba
            WHERE camaba.Email='$username'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            return $res['isUjian'];    
        }else
            return false;
        
    }
    function getCamabaIsUjianAndJalur($username){
        $res=$this->db->query("SELECT
            	isUjian,
                jalur.Nama_JalurPenerimaan
            FROM
            	tb_pmb_tr_camaba camaba
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON ujian.Id_Camaba = camaba.Id_Camaba
            LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON camaba.Jalur_Penerimaan=jalur.Id_JalurPenerimaan
            WHERE camaba.Email='$username'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            return $res;    
        }else
            return false;
        
    }
    function getEmailById($id){
        $res=$this->db->query("SELECT Email FROM tb_pmb_tr_camaba WHERE Id_Camaba='$id'");
        $res=$res->row_array();
        return $res['Email'];
    }
    function getWaktuUjian($username){
        $res=$this->db->query("SELECT
            	DATE_FORMAT(Tgl_Ujian,'%d/%m/%Y') AS Tgl_Ujian,
            	CONCAT(Waktu_Mulai,' s/d ',Waktu_Selesai) AS WaktuUjian
            FROM
            	tb_pmb_tr_ujian_masuk ujian
            INNER JOIN tb_pmb_tr_camaba camaba ON ujian.Id_Camaba = camaba.Id_Camaba
            WHERE
            	camaba.Email='$username'");
        return $res->row_array();
    }
    function getUploadedBerkas($username){
        return $this->db->query("SELECT
            	id_berkas,
            	camaba.Id_Files,
            	NamaFileOri
            FROM
            	tb_pmb_tr_berkas_camaba camaba INNER JOIN tb_app_rf_files files ON camaba.Id_Files=files.IDFile
            WHERE
            	Username_Camaba = '$username'
            ORDER BY
            	id_berkas,
            	Id_Files");
    }
    
    function hapusBerkasCamaba($username,$idFile){
        return $this->db->query("DELETE FROM tb_pmb_tr_berkas_camaba WHERE Username_Camaba='$username' AND Id_Files='$idFile'");
    }
    
    function getBerkasCamaba($username){
        return $this->db->query("SELECT
            	berkas.id_berkas,
            	berkas.detail_berkas,
            	NamaFile,
                NamaFileOri,
            	CONCAT(Domain,Direktori,NamaFile) AS fileUrl
            FROM
            	tb_pmb_tr_berkas_camaba berkasCamaba INNER JOIN tb_pmb_rf_berkas berkas ON berkasCamaba.id_berkas=berkas.id_berkas
            INNER JOIN tb_app_rf_files files ON berkasCamaba.Id_Files=files.IDFile
            WHERE
            	berkasCamaba.Username_Camaba = '$username'");
    }
    
    function isDaftarUlang($id){
        $res=$this->db->query("SELECT isDaftar_Ulang FROM tb_pmb_tr_daftar_ulang WHERE Id_Camaba='$id'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isDaftarUlangByUsername($user){
        $res=$this->db->query("SELECT IFNULL(isDaftar_Ulang,'NO') AS isDaftar_Ulang FROM tb_pmb_tr_camaba camaba LEFT JOIN tb_pmb_tr_daftar_ulang daftar ON camaba.Id_Camaba=daftar.Id_Camaba WHERE camaba.Email='$user'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            $res['isExist']=true;
            $res['isisDaftar_Ulang']=$res['isDaftar_Ulang'];
        }else $res['isExist']=false;
        
        return $res;
    }
    function getDetailProdi($kodeProdi){
        $res=$this->db->query("SELECT Kode_Fakultas,Jenjang FROM tb_akd_rf_prodi WHERE Kode_Prodi='$kodeProdi'");
        return $res->row_array();
    }
    function getNrpDraft($id){
        $res=$this->db->query("SELECT NRP FROM tb_pmb_tr_draft_nrp WHERE id_camaba='$id'");
        if($res->num_rows()>0){
            $res=$res->row_array();
            return $res['NRP'];    
        }else
        return '';
    }
    function isNrpExist($nrp,$id_c){
        $res=false;
        $res1=$this->db->query("SELECT id_camaba FROM tb_pmb_tr_daftar_ulang WHERE NRP_DaftarUlang='$nrp'
                AND Id_Camaba <> '$id_c'");
        if($res1->num_rows()==0){
            $res2=$this->db->query("SELECT NRP FROM tb_akd_rf_mahasiswa WHERE NRP='$nrp' 
                AND No_KTP_Mhs <> (SELECT No_KTP_Mhs FROM tb_pmb_tr_camaba WHERE Id_Camaba='$id_c')");
            if($res2->num_rows()==0) $res=false; else $res=true;
        }else $res=true;
        return $res;
    }
    function setReqSekolah($p){
        $data=array(
            "Nama_Pemohon"=>$p['nama'],
            "Asal_SMU"=>$p['form_sma_lain'],
            "Alamat_SMU"=>$p['form_alamat_sma_lain'],
            "Kode_Kota"=>$p['kode_kota'],
            "Telp"=>$p['form_telp_sma_lain'],
            "Email"=>$p['form_email_sma_lain'],
            "Website"=>$p['form_web_sma_lain'],
            "Tags"=>'RegisterPMB',
            "Ref"=>$p['email'],
        );
        $data=$this->addInsertLog($data);
        return $this->db->insert('tb_glb_tr_permohonan_sekolah_baru',$data);
    }
    function getOptProdi(){
        $sql="SELECT
        	prd.Kode_Prodi,
        	CONCAT(jng.Nama_Jenjang,' ',prd.Nama_Prodi) AS `caption`,
        	IFNULL(CONCAT('[\"',GROUP_CONCAT(alt.alt_prodi SEPARATOR '\",\"'),'\"]'),'[]') AS `param`,
        	GROUP_CONCAT(CONCAT(alt_jnj.Nama_Jenjang,' ',alt_prd.Nama_Prodi) SEPARATOR ', ') AS `info`
        FROM
        	tb_akd_rf_prodi prd
        INNER JOIN tb_akd_rf_jenjang jng ON prd.Jenjang=jng.Kode_Jenjang
        LEFT JOIN tb_pmb_rf_alt_prodi alt ON prd.Kode_Prodi=alt.prodi
        LEFT JOIN tb_akd_rf_prodi alt_prd ON alt.alt_prodi=alt_prd.Kode_Prodi
        LEFT JOIN tb_akd_rf_jenjang alt_jnj ON alt_prd.Jenjang=alt_jnj.Kode_Jenjang
        WHERE
        	prd.isAktif = 'YES'
        GROUP BY
        	prd.Kode_Prodi
        ORDER BY
        	caption";
        return $this->db->query($sql);
    }
    function getPilihanProdi($camaba){
        $sql="SELECT
            prd.Kode_Prodi AS id,
        	CONCAT(jng.Nama_Jenjang,' ',prd.Nama_Prodi) AS caption
        FROM
        	tb_pmb_tr_pilihan_prodi opt INNER JOIN tb_akd_rf_prodi prd ON opt.prodi=prd.Kode_Prodi
        INNER JOIN tb_akd_rf_jenjang jng ON prd.Jenjang=jng.Kode_Jenjang
        WHERE
        	id_camaba = '$camaba'";
        return $this->db->query($sql);
    }
    function getProdiDiterima($camaba){
        $sql="SELECT
        	prd.Kode_Prodi AS id,
        	CONCAT(jng.Nama_Jenjang,' ',prd.Nama_Prodi) AS caption
        FROM
        	tb_pmb_tr_camaba cmb
        INNER JOIN tb_akd_rf_prodi prd ON cmb.Kode_Prodi=prd.Kode_Prodi
        INNER JOIN tb_akd_rf_jenjang jng ON prd.Jenjang=jng.Kode_Jenjang
        WHERE
        	cmb.Email = '$camaba'";
        $tmp=$this->db->query($sql)->row_array();
        return $tmp['caption'];
    }
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */