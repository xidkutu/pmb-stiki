<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public $var=array();
    
    function __construct() {
		parent::__construct();
        $db=$this->db;
        
        $this->var['db_app']=$db->db_app;
        $this->var['db_akd']=$db->db_akd;
        $this->var['db_peg']=$db->db_peg;
        $this->var['db_keu']=$db->db_keu;
        //$this->var['db_trash']=$db->db_trash;
	}
    
    function getConfigItem($key){
        $res=$this->db->query("SELECT `value` FROM tb_app_rf_config WHERE conf_name='$key'");
        $res=$res->row_array();
        if(isset($res['value'])) return $res['value']; else return false;
    }
    
    function addInsertLog($data){
        $data['Created_App']= $this->config->item('application_id');
        $data['Created_By']= $this->session->userdata('username');
        $data['Created_Date']=$this->getTodayAsString();
        return $data;
    }
    function addUpdateLog($data){
        $data['Modified_App']= $this->config->item('application_id');
        $data['Modified_By']= $this->session->userdata('username');
        $data['Modified_Date']=$this->getTodayAsString();
        return $data;
    }
    public function getTodayAsString(){
		$res = $this->db->query('SELECT now() as today');
        $res = $res->result_array();
        
        $today='';
        if (count($res)!=0){
            $today = $res[0]['today'];   
        }
        return $today;
	}
    public function getTodayFormated($format='%d %M %Y jam %H:%i:%s'){
		$res = $this->db->query("SELECT CONCAT(DAYNAME(NOW()),', ',DATE_FORMAT(NOW(),'$format')) as today");
        $res = $res->result_array();
        
        $today='';
        if (count($res)!=0){
            $today = $res[0]['today'];   
        }
        return $today;
	}
    public function getPeriodeByNrp($nrp){
        $res=$this->db->query("SELECT
            	Perwalian_Tahun AS Tahun,
            	Perwalian_Semester AS Semester
            FROM
            	tb_akd_rf_mahasiswa mhs
            INNER JOIN tb_akd_rf_kelas_kuliah klsKuliah ON mhs.Kode_Prodi = klsKuliah.Prodi
            AND mhs.Kelas=klsKuliah.Kelas
            WHERE mhs.NRP='$nrp'");
        
        if($res->num_rows()<1){
            $res=$this->db->query("SELECT
                	Periode.Tahun,
                	Periode.Semester
                FROM
                	tb_akd_rf_mahasiswa mhs
                INNER JOIN tb_akd_rf_periode Periode ON mhs.Kode_Prodi = Periode.Kode_Prodi
                AND mhs.Kelas = Periode.Kelas
                WHERE
                	mhs.NRP = '$nrp'
                AND Periode.isAktif='YES'");
                if($res->num_rows()<1){
                    return false;
                }else
                if($res->num_rows()==1){
                    return $res->row_array();
                }else{
                    foreach($res->result_array() as $r){
                        if(!$this->is_containStr(strtolower($r['Semester']),'pendek'))
                            return $r;
                    }
                }
        }else{
            return $res->row_array();
        }
        return false;
    }
    public function getNumPeriode($tahun,$semester){
        $res=$this->db->query("SELECT CONCAT('$tahun',Order_Sem) AS numPeriode FROM tb_hlp_order_semester WHERE Periode_Sem='$semester'");
        $numPeriode='';
        foreach($res->result() as $r){
            $numPeriode=$r->numPeriode;
        }
        return $numPeriode;
    }
    function is_containStr($str,$find){
        if (strpos($str,$find !== false)) return true; else return false;
        
    }
    public function writeLog($username,$className,$functionName,$message,$tags,$related){
        $app=$this->config->item('application_id');
        $this->db->query("INSERT INTO `tb_app_tr_log` (
                	`Username`,
                	`ClassName`,
                	`FunctionName`,
                	`Message`,
                	`Tags`,
                    `App_id`,
                	`RelatedTo`
                )
                VALUES
                	(
                		'$username',
                		'$className',
                		'$functionName',
                		'$message',
                		'$tags',
                        '$app',
                		'$related'
                	);");
        return false;
    }
    
    public function kirim_email($pengirim,$ke,$subyek,$pesan) {
       $result=false;
       $this->load->library('email');
       $this->email->initialize(array(
             'protocol' => $this->config->item('email_protocol'),
             'smtp_host' => $this->config->item('email_smtp_host'),
             'smtp_user' => $this->config->item('email_smtp_user'),
             'smtp_pass' => $this->config->item('email_smtp_pass'),
             'smtp_port' => $this->config->item('email_smtp_port'),
             'mailtype' => $this->config->item('email_mailtype'),
             'charset'  => $this->config->item('email_charset'),
             'newline' => $this->config->item('email_newline') // kode yang harus di tulis pada konfigurasi controler email
       ));
    
       $from = $this->config->item('email_smtp_user');
       if(empty($pengirim)) $pengirim=$this->config->item('email_smtp_user');
       $nama = $pengirim;
       $to = $ke;
       $subject = $subyek;
       $message = $pesan;
       $this->email->from($from, $nama )
                   ->to($to)
                   ->subject($subject)
                   ->message($message);
    
       if ($this->email->send()) {
          //$this->session->set_flashdata('success', 'Email berhasil dikirim.');
          $result = 'sukses';
       } else {
          show_error($this->email->print_debugger());
          $result = 'gagal';
       }
       return $result;
    }  
    
    function getAlertDetail($id){
        $res=$this->db->query("SELECT DISTINCT
            	GROUP_CONCAT((
            		IFNULL(peg.email, mhs.Email)
            	)) AS email,
            	secAlrt.sender,
            	secAlrt.`subject`,
            	secAlrt.pesan,
                secAlrt.id
            FROM
            tb_app_rf_security_alert secAlrt
            INNER JOIN tb_app_rf_security_alert_recipient alrt ON secAlrt.id=alrt.id_alert
            INNER JOIN tb_app_rf_user usr ON alrt.user_username = usr.user_username
            LEFT JOIN tb_peg_rf_pegawai peg ON usr.NIP = peg.nip
            LEFT JOIN tb_akd_rf_mahasiswa mhs ON usr.NRP = mhs.NRP
            WHERE
            	alrt.id_alert = '$id'");
        $result=$res->row_array();
        $result['recipient']=explode(',',$result['email']);
        return $result;
    }
    
    function isBrowserBanned($id){
        $res=$this->db->query("SELECT
            	browser_fingerprint
            FROM
            	tb_app_tr_banned_browser
            WHERE
            	browser_fingerprint = '$id'");
        if($res->num_rows()>0) return true; else return false;
    }
    function isRecognizedDevice($user,$finger){
        $res=$this->db->query("SELECT user_username FROM tb_app_tr_user_browser WHERE user_username='$user' AND browser_fingerprint='$finger'");
        if($res->num_rows()>0) return true; else return false;
    }
    function convert_id($tags,$id){
        $sql="SELECT to_id FROM tb_glb_rf_convert_id WHERE from_id='$id' AND tags LIKE '%$tags%'";
        $res=$this->db->query($sql);
        if($res->num_rows()==1){
            $res=$res->row_array();
            return $res['to_id'];
        }else return $id;
    }
}