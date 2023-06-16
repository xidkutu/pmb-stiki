<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_Model extends MY_MODEL {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
    
    public function getToday(){
        return $this->db->query('SELECT now() as today');
	}
    public function getTodayStr(){
        $res=$this->getToday();
        $res=$res->row_array();
        return $res['today'];
    }
    function getConfigItem($key){
        $res=$this->db->query("SELECT `value` FROM tb_app_rf_config WHERE conf_name='$key'");
        $res=$res->row_array();
        if(isset($res['value'])) return $res['value']; else return false;
    }
    
    function addInsertLog($data){
        $data['Created_App']= $this->config->item('application_id');
        $data['Created_by']= $this->session->userdata('username');
        $data['Created_date']=$this->getTodayStr();
        return $data;
    }
    function addUpdateLog($data){
        $data['Modified_App']= $this->config->item('application_id');
        $data['Modified_by']= $this->session->userdata('username');
        $data['Modified_date']=$this->getTodayStr();
        return $data;
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
                SUBSTR(m.URL, 2 ,LENGTH(m.URL)) AS Classname,
            	m.Icon
            FROM
            	tb_app_tr_group_menu g
            INNER JOIN tb_app_rf_menus m ON g.Menu_id = m.Menu_id
            WHERE
            	g.Group_id = "'.$this->session->userdata('role').'"
                AND (m.Induk_Menu = "'.$induk.'" OR m.Induk_Menu = "" OR m.Induk_Menu IS NULL)
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
                    'Classname'   =>$row->Classname,
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
                SUBSTR(m.URL, 2 ,LENGTH(m.URL)) AS Classname,
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
                    'Classname'   =>$row->Classname,
					'child'	=>$this->get_child($row->Menu_id)
				);
		}
		return $data;
	}
    
    public function getPageTitle($classname){
        $appId=$this->config->item('application_id');
        $res=$this->db->query("SELECT Nama_Menu FROM tb_app_rf_menus WHERE URL='/$classname' AND App_id='$appId'");
        if($res->num_rows()>0){
            foreach($res->result() as $r){
                $name=$r->Nama_Menu;
            }
        }else{
            $name="Invalid class name";
        }
        
        return $name;
    }
    public function getPageInfo($classname){
        $appId=$this->config->item('application_id');
        $res=$this->db->query("SELECT Nama_Menu,Keterangan,Icon FROM tb_app_rf_menus WHERE URL='/$classname' AND App_id='$appId'");
        if($res->num_rows()>0){
            return $res->row_array();
        }else{
            $hasil=array(
                "Nama_Menu"=>null,
                "Keterangan"=>null
            );
            return $hasil;
        };
    }
    public function getBreadCrumb($classname){
        $appId=$this->config->item('application_id');
        $res=$this->db->query("SELECT Menu_id,Nama_Menu,URL,Icon,Induk_Menu FROM tb_app_rf_menus WHERE URL='/$classname' AND App_id='$appId' AND isAktif='YES'");
        return $res->row_array();
    }
    
    public function getBreadCrumbByMenuId($id){
        $appId=$this->config->item('application_id');
        $res=$this->db->query("SELECT Menu_id,Nama_Menu,URL,Icon,Induk_Menu FROM tb_app_rf_menus WHERE Menu_id='$id' AND App_id='$appId'");
        $res=$res->result_array();
        $res=$res[0];
        return $res;
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
    
    public function getUsersOnGroup($group){
        $res=$this->db->query("SELECT Username FROM tb_app_tr_user_group WHERE Role_id='$group'");
        return $res;
    }
    
    public function getUsersOnGroupOfRole($group){
        $res=$this->db->query("SELECT
            	Username
            FROM
            	tb_app_tr_group_role grole
            INNER JOIN tb_app_rf_group grp ON grole.Role_id = grp.Role_id
            INNER JOIN tb_app_tr_user_group usrg ON grp.Role_id = usrg.Role_id
            WHERE
            	IdGroup = '$group'
            AND usrg.App_id='".$this->config->item('application_id')."'");
        return $res;
    }
    
    public function getUsersOnGroupOfRole_array($group){
        $res=$this->getUsersOnGroupOfRole($group);
        return $res->result_array();    
    }
    
    public function getUsersOnGroup_array($group){
        $res=$this->getUsersOnGroup($group);
        return $res->result_array();    
    }
    
    public function writeNotifByArray($arr_users,$appTarget,$message,$targetLink){
        $arr_data=array();
        foreach($arr_users as $i=>$user){
           $arr_data[$i]['App_Target']=$appTarget;
           $arr_data[$i]['User_Target']=$user['Username'];
           $arr_data[$i]['Message']=$message;
           $arr_data[$i]['Target_Link']=$targetLink;
           $arr_data[$i]=$this->addInsertLog($arr_data[$i]);
        }
        if(count($arr_data)>0)
            $res=$this->db->insert_batch('tb_app_tr_notification',$arr_data);
        else $res=true;
        return $res;
    }
    
    public function writeNotifForUserOnGroup($appTarget,$groupTarget,$message,$targetLink){
        $users=$this->getUsersOnGroup_array($groupTarget);
        return $this->writeNotifByArray($users,$appTarget,$message,$targetLink);
    }
    public function writeNotifForUserOnGroupOfRole($appTarget,$groupTarget,$message,$targetLink){
        $users=$this->getUsersOnGroupOfRole_array($groupTarget);
        return $this->writeNotifByArray($users,$appTarget,$message,$targetLink);
    }
    public function writeNotifForUser($appTarget,$user,$message,$targetLink){
        $arr_data['App_Target']=$appTarget;
        $arr_data['User_Target']=$user;
        $arr_data['Message']=$message;
        $arr_data['Target_Link']=$targetLink;
        $arr_data=$this->addInsertLog($arr_data);
        
        $res=$this->db->insert('tb_app_tr_notification',$arr_data);
        return $res;
    }
    public function getUnreadNotification(){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_tr_notification
            WHERE
            	(Group_Target = '".$this->session->userdata('role')."'
            OR User_Target = '".$this->session->userdata('username')."')
            AND (App_Target='ALL' OR App_Target='".$this->config->item('application_id')."')
            AND isRead='NO'");
        return $res;
    }
    public function markNotifAsRead($id){
        $res=$this->db->query("UPDATE `tb_app_tr_notification` SET `isRead`='YES' WHERE (`Id_Notif`='$id');");
        return $res;   
    }
    public function markAllNotifAsRead($id){
        $res=$this->db->query("UPDATE `tb_app_tr_notification` SET `isRead`='YES' WHERE (`User_Target`='$id');");
        return $res;   
    }
    public function getEditableConfig(){
        $res=$this->db->query("SELECT
            	conf_name,
            	conf_caption,
            	`value`,
            	deskripsi
            FROM
            	tb_app_rf_config
            WHERE application='".$this->config->item('application_id')."'
            ORDER BY
            	`Order`");
        return $res;
    }
    public function saveChangedConfig($name,$value){
        $key=array('conf_name'=>$name);
        $data=array('value'=>$value);
        $data=$this->addUpdateLog($data);
        return $this->db->update('tb_app_rf_config',$data,$key);
    }
    public function getNews(){
        return $this->db->query("SELECT
            	annc.Kode_Pengumuman,
            	Judul_Pengumuman,
            	Keterangan,
            	Teaser,
            	Publish_Time
            FROM
            	tb_akd_tr_pengumuman annc INNER JOIN tb_glb_tr_target_pengumuman trgtApp ON annc.Kode_Pengumuman=trgtApp.Kode_Pengumuman
            WHERE
            	isAktif = 'YES'
            AND (trgtApp.Target_App='".$this->config->item('application_id')."' OR trgtApp.Target_App='ALL')
            ORDER BY
            	Publish_Time DESC");
    }
    public function getDetailNews($id){
        $res=$this->db->query("
            SELECT
            	Kode_Pengumuman,
            	Judul_Pengumuman,
            	Teaser,
            	Keterangan
            FROM
            	tb_akd_tr_pengumuman
            WHERE
            	Kode_Pengumuman = '$id'");
        return $res->row_array();
    }
    public function getReadNews($id){
        $res=$this->db->query("SELECT
            	Judul_Pengumuman,
            	Keterangan,
            	DATE_FORMAT(Publish_Time, '%d %M %Y') AS Publish_Time
            FROM
            	tb_akd_tr_pengumuman
            WHERE
            	Kode_Pengumuman = '$id'
                AND Target_App='".$this->config->item('application_id')."'");
        return $res->row_array();
    }
    public function hapusAsalInformasi($id){
        $res=$this->db->query("DELETE FROM tb_akd_tr_pengumuman WHERE Kode_Pengumuman='$id'");
        
        return $res;
    }
    public function isDailyVisitorExist($loc){
        $tahun=$this->getConfigItem('tahun_penerimaan');
        $res=$this->db->query("SELECT
            	jumlah
            FROM
            	tb_pmb_tr_visitor_stat_daily
            WHERE
            	DATE_FORMAT(tanggal, '%d/%m/%y') = DATE_FORMAT(NOW(), '%d/%m/%y')
            AND tahun_penerimaan = '$tahun'
            AND country_code='".$loc['country_code']."'
            AND region_name='".$loc['region_name']."'
            AND cityName='".$loc['cityName']."'");
        if($res->num_rows()>0) return true; else return false;
    }
    public function set_dailyVisitorCounter($loc){
        $tahun=$this->getConfigItem('tahun_penerimaan');
        if(! $this->isDailyVisitorExist($loc)){
            $res=$this->db->query("
            INSERT INTO `tb_pmb_tr_visitor_stat_daily` (
            	`tahun_penerimaan`,
            	`tanggal`,
            	`country_code`,
            	`region_name`,
            	`cityName`,
            	`jumlah`
            )
            VALUES
            	(
            		'$tahun',
            		NOW(),
            		'".$loc['country_code']."',
            		'".$loc['region_name']."',
            		'".$loc['cityName']."',
            		1
            	);");
        }else{
            $res=$this->db->query("
            UPDATE `tb_pmb_tr_visitor_stat_daily`
            SET `jumlah` = `jumlah`+1
            WHERE
            	(`tahun_penerimaan` = '$tahun')
            AND (DATE_FORMAT(tanggal,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y'))
            AND (`country_code` = '".$loc['country_code']."')
            AND (`region_name` = '".$loc['region_name']."')
            AND (`cityName` = '".$loc['cityName']."')");
        }
        return $res;
    }
    public function getStatistikDashboard(){
        $tahun=$this->getConfigItem('tahun_penerimaan');
        $data['today_visitor']=$this->getTodayVisitor($tahun);
        $target_tdy_vst=$this->getConfigItem('target_dailyvisitor');
        $data['prog_today_visitor']=round(($data['today_visitor']/$target_tdy_vst)*100,2);
        
        $data['total_visitor']=$this->getTotalVisitor($tahun);
        $target_tot_vst=$this->getConfigItem('target_totalvisitor');
        $data['prog_tot_visitor']=round(($data['total_visitor']/$target_tot_vst)*100,2);
        
        $data['pendaftar']=$this->getNumPendaftar($tahun);
        $target_reg=$this->getConfigItem('target_pendaftar');
        $data['prog_pendaftar']=round(($data['pendaftar']/$target_reg)*100,2);
        
        $data['diterima']=$this->getNumMhsDiterima($tahun);
        $target_diterima=$this->getConfigItem('target_mahasiswa');
        $data['prog_mahasiswa']=round(($data['diterima']/$target_diterima)*100,2);
        
        return $data;
    }
    public function getTodayVisitor($tahun){
        $res=$this->db->query("SELECT
            	IFNULL(SUM(jumlah),0) AS jumlah
            FROM
            	tb_pmb_tr_visitor_stat_daily
            WHERE
            	tahun_penerimaan = '$tahun'
            AND DATE_FORMAT(tanggal, '%d/%m/%y') = DATE_FORMAT(NOW(), '%d/%m/%y')");
        $res=$res->row_array();
        if(isset($res['jumlah'])) return $res['jumlah']; else return false;
    }
    public function getTotalVisitor($tahun){
        $res=$this->db->query("SELECT
            	IFNULL(SUM(jumlah),0) AS jumlah
            FROM
            	tb_pmb_tr_visitor_stat_daily
            WHERE
            	tahun_penerimaan = '$tahun'");
        $res=$res->row_array();
        if(isset($res['jumlah'])) return $res['jumlah']; else return false;
    }
    public function getNumPendaftar($tahun){
        $res=$this->db->query("SELECT IFNULL(COUNT(email),0) AS N FROM tb_pmb_tr_camaba_reg WHERE Tahun_Penerimaan='$tahun'");
        $res=$res->row_array();
        if(isset($res['N'])) return $res['N']; else return false;
    }
    public function getNumMhsDiterima($tahun){
        $res=$this->db->query("SELECT
            	IFNULL(COUNT(camaba.Email), 0) AS N
            FROM
            	tb_pmb_tr_camaba camaba
            INNER JOIN tb_pmb_tr_camaba_reg reg ON camaba.Email = reg.email
            WHERE
            	IsDiterima = 'YES'
            AND reg.Tahun_Penerimaan='$tahun'");
        $res=$res->row_array();
        if(isset($res['N'])) return $res['N']; else return false;
    }
    public function getRegionalVisitor(){
        $tahun=$this->getConfigItem('tahun_penerimaan');
        $res=$this->db->query("SELECT
            	LOWER(Code2) AS reg,
            	SUM(jumlah) AS n
            FROM
            	tb_pmb_tr_visitor_stat_daily stat
            LEFT JOIN tb_glb_rf_negara negara ON stat.country_code = negara.`Code`
            OR stat.region_name = negara.`Code`
            OR stat.region_name = negara.Code2
            OR stat.country_code = negara.Code2
            OR stat.country_code = negara.`Code`
            WHERE
            	tahun_penerimaan = '$tahun'
            AND Code2 IS NOT NULL
            GROUP BY
            	country_code
            ORDER BY
            	n DESC");
        if($res->num_rows()>0){
            $data=array();
            foreach($res->result_array() as $r){
                $data[$r['reg']]=$r['n'];
            }
            return $data;
        }else return false;
    }
    public function getRegionalPie(){
        $tahun=$this->getConfigItem('tahun_penerimaan');
        $res=$this->db->query("SELECT
            	region_name AS reg,
            	SUM(jumlah) AS n
            FROM
            	tb_pmb_tr_visitor_stat_daily stat
                INNER JOIN tb_akd_rf_propinsi prov ON stat.region_name = prov.Nama_Prop
            WHERE
            	tahun_penerimaan = '$tahun'
            AND (region_name IS NOT NULL AND region_name<>'')
            GROUP BY
            	region_name
            ORDER BY N DESC
            LIMIT 10");
        if($res->num_rows()>0){
            $data=$res->result_array();
            foreach($res->result_array() as $i=>$r){
                $reg[$i]=$r['reg'];    
            };
            $reg=implode('","',$reg);
            $reg='"'.$reg.'"';
            $res1=$this->db->query("SELECT
                	SUM(jumlah) AS other
                FROM
                	tb_pmb_tr_visitor_stat_daily
                WHERE
                	region_name NOT IN ($reg)
                AND tahun_penerimaan='$tahun'");
            $res1=$res1->row_array();
            if(isset($res1['other'])){
                $data[count($data)]['reg']='Lainnya';
                $data[count($data)-1]['n']=$res1['other'];   
            }
            return $data;
        }else return false;
    }
    
    function files_del($id){
        return $this->db->query("DELETE FROM tb_app_rf_files WHERE IDFile='$id'");
    }
    
    function getDetailFiles($id){
        $res=$this->db->query("SELECT CONCAT(Direktori,NamaFile) AS ftpPath,CONCAT(Domain,Direktori,NamaFile) AS fullPath FROM tb_app_rf_files WHERE IDFile='$id'");
        return $res->row_array();
    }
    function getNipByUsername($user){
        $res=$this->db->query("SELECT NIP FROM tb_app_rf_user WHERE user_username='$user'");
        $res=$res->row_array();
        return $res['NIP'];
    }
    function isActionPermit($role,$class,$function){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_tr_group_class_function
            WHERE
            	Group_Role_id = '$role'
            AND Class_Name = '$class'
            AND FunctionName = '$function'
            AND Application_Id = '".$this->config->item('application_id')."'");
        if($res->num_rows()>0) return true; else return false;
    }
	function mikrotik_encrypt($str){
        $metode=$this->getConfigItem('mikrotik_encryption');
        $metode=str_replace('<{str}>',$str,$metode);
        $res=$this->db->query("SELECT $metode AS pwd");
        $res=$res->row_array();
        return $res['pwd'];
    }
    function sendsms($phonenumber,$message){
        $sms=$this->config->item('sms');
        $provider=$sms['provider'];
        $conf=$sms[$provider];
        if(strtolower($provider)=='kalkun'){
            if (!file_exists("assets/tmp/cookies.txt")) fopen("assets/tmp/cookies.txt", "w");
            $d['base_url'] = $conf['base_url'];
            $d['session_file'] = $conf['session_file'];
            $d['username'] = $conf['username'];
            $d['password'] = $conf['password'];
            $d['phone_number'] = $phonenumber;
            $d['message'] = $message;
            $this->load->library('kalkun_api',$d);    	 
            $this->kalkun_api->run();   
        }else
        if(strtolower($provider)=='zenziva'){
            $private_key = $conf['private_key'];
    		$url = $conf['base_url'];
    
    		$public_key = md5("pub[$private_key|".date('HmYDi')."]bup");
    		$url = $url.$public_key."?telp=$phonenumber&pesan=".urlencode($message);
    		$curlSession = curl_init();
    		curl_setopt($curlSession, CURLOPT_URL, $url);
    		curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    		$response = curl_exec($curlSession);
    		curl_close($curlSession);
    		$response = json_decode($response);
    		return (isset($response->text) && $response->text == 'Success');
        }
    }
}