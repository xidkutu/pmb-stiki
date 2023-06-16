<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 **/
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');                
        $this->load->helper(array('form', 'url', 'captcha'));        
    }
         
	public function index()
	{
	   $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $this->load->helper('url');
            redirect(base_url().'index.php/dashboard');   
        }
        else{
            $d['ms']=$this->app_model->getConfigItem('mac_secure');
			$d['username'] = array('name' => 'username',
					'id' => 'username',
					'type' => 'text',
					'class' => 'input-teks-login',
					'autocomplete' => 'off',
					'size' =>'30',
					'placeholder' => 'Masukkan username.....'
			);
			$d['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'class' => 'input-teks-login',
					'autocomplete' => 'off',
					'size' =>'30',
					'placeholder' => 'Masukkan password.....'
			);
			$d['submit'] = array('name' => 'submit',
					'id' => 'submit',
					'type' => 'submit',
					'class' => 'easyui-linkbutton',
					'data-options' => 'iconCls:\'icon-lock_open\''
			);
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
	
    
            /* CAPTCHA init */            
            $userCaptcha = $this->input->post('captcha');
            $word = $this->session->userdata('PMBONLINELogin');
            
            if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0){
              $this->session->unset_userdata('PMBONLINELogin');
            }else{
              $vals = array(
                'img_path' => 'assets/frontend/onepage/static/',
                'img_url' => base_url().'assets/frontend/onepage/static/',
                'result' => 'gagal'
                );                            
              $captcha = create_captcha($vals);
              
              $this->session->set_userdata('PMBONLINELogin', $captcha['word']);                    
              $d['captcha'] = $captcha;              
            }
            /* CAPTCHA end */ 			
			  
			if ($this->form_validation->run() == FALSE){
                $d['ws']=$this->app_model->getConfigItem('ws_portal');
                $d['m']=$this->app_model->getConfigItem('mikrotik_login');
                $d['s']=$this->app_model->getConfigItem('mikrotik_sender');
    			$this->load->view('application/login/view',$d);	
			}else{
				$u = $this->input->post('username');
				$p = $this->input->post('password');
                $t=$this->getTracking($this->input->post());
                //print_r($t);
				$this->app_model->doCekLogin($u,$p,$t);
			}
            
        }
	}
    public function isPv(){
        if($this->ip_is_private($this->input->ip_address()))
        echo true; else echo false;
    }
    function ip_is_private ($ip) {
        $pri_addrs = array (
                          '10.0.0.0|10.255.255.255', // single class A network
                          '172.16.0.0|172.31.255.255', // 16 contiguous class B network
                          '192.168.0.0|192.168.255.255', // 256 contiguous class C network
                          '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
                          '127.0.0.0|127.255.255.255' // localhost
                         );
        $pub_ip=$this->app_model->getConfigItem('mikrotik_local_ip');
        $pub_ip=explode(',',$pub_ip);
        
        $long_ip = ip2long ($ip);
        if ($long_ip != -1) {
    
            foreach ($pri_addrs AS $pri_addr) {
                list ($start, $end) = explode('|', $pri_addr);
    
                 // IF IS PRIVATE
                 if(in_array($ip,$pub_ip)){
                    return true;
                 }
                 if ($long_ip >= ip2long ($start) && $long_ip <= ip2long ($end)) {
                     return true;
                 }
            }
        }
    
        return false;
    }
    public function getTracking($p){
        if(isset($p['browser']) && isset($p['fingerprint']) && isset($p['appVersion'])){
            $res=array();
            $browser=json_decode($p['browser']);
            foreach($browser as $key=>$b){
                if($key!='webkit' && $b===true) $res['browser']=($key.'/'.$browser->version);
            }
            $res['fingerprint']=$p['fingerprint'];
            
            $app=explode(' ',$p['appVersion']);
            $os=$app['1'].' '.$app['2'].' '.$app['3'];
            $os=substr($os,1,strlen($os)-2);
            $res['os']=$os;
            $osName=$this->app_model->getOsMarketName($os);
            if(!empty($osName)) $res['os'].=(' ('.$osName.')');
            
            $token=base64_decode(base64_decode($p['wtoken']));
            $t=json_decode($token);
            
            if(empty($t->i))
            $res['ip']=$this->input->ip_address();
            else $res['ip']=$t->i;
            
            if(!empty($p['wtoken'])){
                $res['mac']=$t->m;
                $res['NUser']=$t->u;
            }else{
                $res['mac']='';
                $res['NUser']='';
            }
            
            
        }else $res=false;
        return $res;
    }
    
	public function logout(){
		$this->session->sess_destroy();
		header('location:'.base_url().'index.php');
	}
    
    public function refresh_captcha(){        
        $this->session->unset_userdata('PMBONLINELogin');        
        $vals = array(
            'img_path' => 'assets/frontend/onepage/static/',
            'img_url' => base_url().'assets/frontend/onepage/static/',
            'result' => 'gagal'
            );
        $captcha = create_captcha($vals);      
        $this->session->set_userdata('PMBONLINELogin', $captcha['word']);                    
        
        echo $captcha['image'];
    }
    
    public function forgotpassword(){ 
        $response = array();
        $user     = $this->input->post('email');        
        $captcha  = $this->input->post('captcha');
        $word     = $this->session->userdata('PMBONLINELogin'); 
        $res_cap  = '';        
//        echo $word;
//        die;
        
        if (strcmp(strtoupper($captcha),strtoupper($word)) != 0){            
            $res_cap = 'not ok';
            $response = array (
                    'res_cap'   => $res_cap                
            );
            $this->session->unset_userdata('PMBONLINELogin');            
            echo json_encode($response);
            die;
        }
        
              
        //$usr = explode('@',$user);
        $today=$this->today();        
        $pwd_baru=$this->randomPassword();          
                      
        $appId=$this->config->item('application_id');        
        $strsql = "select email,telp as hp from tb_pmb_tr_camaba_reg where email='$user'";                                 
        $hasil=$this->db->query($strsql);        
        
        if($hasil->num_rows()>0){            
            $row = $hasil->row();                                               
            $pesansms   = $pwd_baru." is your STIKI PMB verification code.";
            $telp       = $row->hp;
            $this->system_model->sendsms($telp,$pesansms); 
            $res_sms    = 'ok';
            
            /* masukkan ke database */
            $data = array (
            	'Username'     => $user,
            	'ClassName'    => 'Login',
            	'FunctionName' => 'forgotpassword',
            	'Message'      => $pwd_baru,
            	'Tags'         => 'kirimsmsverifikasi',
            	'App_id'       => $appId,
                'RelatedTo'    => $telp
            	
            );
            $this->db->insert('tb_app_tr_log',$data);
            $res_log    = 'ok';
            
            $response = array (
                'res_sms'   => $res_sms,
                'res_log'   => $res_log
            );
             
		}else{
            $response = array (
                'res_log'   => 'not ok'
            );
		}
        echo json_encode($response);
    }
    
    function today(){
        //$temp = $this->app_model->getToday();
        $temp = $this->db->query('SELECT now() as today');
        $result = $temp->result_array();
        
        $today='';
        if (count($result)!=0){
            $today = $result[0]['today'];   
        }
        return $today;
    }
    
    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    function kirim_email($pengirim,$ke,$subyek,$pesan) {
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
    
    function verifikasi_krm_email(){
        $kodeverifikasi = $this->input->post('verifikasi');
        $email_forgot   = $this->input->post('email_forgot');        
        $today=$this->today();
        $pwd_baru=$this->randomPassword();
        $hasil          = '';
        
        $appId=$this->config->item('application_id');
        $sqlstr = "select Username,ClassName,FunctionName,Message,Tags,ExecutionTime
                from tb_app_tr_log
                where App_id='$appId' and Username = '$email_forgot' and Tags = 'kirimsmsverifikasi' and Message = '$kodeverifikasi' and 
                ExecutionTime BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 30 MINUTE)) AND timestamp(NOW()) order by ExecutionTime desc limit 1";                                                       
        $query = $this->db->query($sqlstr);
        if ($query->num_rows() > 0)
        {    
                        
            $query="UPDATE tb_pmb_tr_camaba_reg
                        SET pwd =  MD5('$pwd_baru'),
                        Modified_App='$appId',
                        Modified_By='$email_forgot',
                        Modified_Date='$today'
                        WHERE
                        	email = '$email_forgot'";   
            $this->db->query($query);
            
            $pengirim   = 'STIKI PMBOnline';
            $subyek     = 'Reset Password STIKI PMBOnline';
            $pesan      = '<strong>Berikut Password yang baru :</strong> :<br/> User Name : '.$email_forgot.'<br/>Password : '.$pwd_baru.'<br/>Untuk merubah password setelah login sistem, dari menu Pengaturan -> Ubah Password';
            $this->kirim_email($pengirim,$email_forgot,$subyek,$pesan);
            
            /* Bikin Log Success*/
            $data = array (
            	'Username'     => $email_forgot,
            	'ClassName'    => 'Login',
            	'FunctionName' => 'verifikasi_krm_email',
            	'Message'      => 'OK pwd='.$pwd_baru,
            	'Tags'         => 'KrmNewPwdViaEmail',
            	'App_id'       => $appId            	
            );
            $this->db->insert('tb_app_tr_log',$data);
            $hasil = 'ok';
                     
        }else{
            /* Bikin Log Not Success*/
            $data = array (
            	'Username'     => $email_forgot,
            	'ClassName'    => 'Login',
            	'FunctionName' => 'verifikasi_krm_email',
            	'Message'      => 'NOT OK',
            	'Tags'         => 'KrmNewPwdViaEmail',
            	'App_id'       => $appId            	
            );
            $this->db->insert('tb_app_tr_log',$data);
            
            $hasil  = 'not ok';
        }
        echo json_encode($hasil);
    }        
    
    function cekverifikasi(){
        $kodeverifikasi = $this->input->post('verifikasi');
        $email_forgot   = $this->input->post('email_forgot');        
        $hasil = '';
        
        $appId=$this->config->item('application_id');
        $sqlstr = "select Username,ClassName,FunctionName,Message,Tags,ExecutionTime
                from tb_app_tr_log
                where App_id = '$appId' and Username = '$email_forgot' and Tags = 'kirimsmsverifikasi' and Message = '$kodeverifikasi' and 
                ExecutionTime BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 30 MINUTE)) AND timestamp(NOW()) order by ExecutionTime desc limit 1";                                                         
        $query = $this->db->query($sqlstr);
        if ($query->num_rows() > 0)
        {            
            /* Bikin Log */
            $data = array (
            	'Username'     => $email_forgot,
            	'ClassName'    => 'Login',
            	'FunctionName' => 'cekverifikasi',
            	'Message'      => 'OK',
            	'Tags'         => 'CekSmsVerifikasi',
            	'App_id'       => $appId            	
            );
            $this->db->insert('tb_app_tr_log',$data);
            $hasil = 'ok';
        }else{
            /* Bikin Log */
            $data = array (
            	'Username'     => $email_forgot,
            	'ClassName'    => 'Login',
            	'FunctionName' => 'cekverifikasi',
            	'Message'      => 'NOT OK',
            	'Tags'         => 'CekSmsVerifikasi',
            	'App_id'       => $appId            	
            );
            $this->db->insert('tb_app_tr_log',$data);
            $hasil = 'not ok';
        }        
        
        echo json_encode($hasil);        
    }
    public function receiver($param = false)
	{
        $m=$this->app_model->getConfigItem('mikrotik_login');
        $s=$this->app_model->getConfigItem('mikrotik_sender');
        if (!$param || $this->input->server('HTTP_REFERER') != $m.'/'.$s)
		{
			show_404();
			die;
		}
		$this->session->set_userdata('wtoken', $param);
		redirect(base_url().'index.php/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */