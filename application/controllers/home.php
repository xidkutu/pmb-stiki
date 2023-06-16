<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');                
        $this->load->helper(array('form', 'url', 'captcha'));        
    }
    
    public function index(){
        $cur_user=$this->session->userdata('username');
        
        $userCaptcha = $this->input->post('captcha');
        $word = $this->session->userdata('PMBONLINE');
        
        if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0){
          $this->session->unset_userdata('PMBONLINE');
                      
          $this->load->view('application/home/view');
        }else{
          $vals = array(
            'img_path' => 'assets/frontend/onepage/static/',
            'img_url' => base_url().'assets/frontend/onepage/static/',
            'result' => 'gagal'
            );
          $captcha = create_captcha($vals);
          
          $this->session->set_userdata('PMBONLINE', $captcha['word']);                    
          $d['captcha'] = $captcha;
          $d['propinsi'] = $this->app_model->getDaftarPropinsi();
          $d['username'] = $cur_user;
          $d['pt_sort_name']=$this->app_model->getConfigItem('pt_sort_name');
          $this->load->view('application/home/view',$d);
          
        }        
    }
	
    public function refresh_captcha(){        
        $this->session->unset_userdata('PMBONLINE');        
        $vals = array(
            'img_path' => 'assets/frontend/onepage/static/',
            'img_url' => base_url().'assets/frontend/onepage/static/',
            'result' => 'gagal'
            );
        $captcha = create_captcha($vals);      
        $this->session->set_userdata('PMBONLINE', $captcha['word']);                    
        
        echo $captcha['image'];
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
    
    public function getSmaByKota(){
        $sma=$this->input->post("sma");
        $res=$this->app_model->getListOfSmaByKota($sma);
        $opt="<option value=''>-PILIH SMA-</option>";
        foreach($res->result() as $ct){
            $opt.="<option value='".$ct->Kode_SMU."'>".$ct->Asal_SMU.' - '.$ct->Alamat_SMU."</option>";
        }
        $opt.="<option value='{0}'>--Lainnya--</option>";
        $d['opt']=$opt;
        echo json_encode($d);
    }
    
    function cekemail(){
        $email = $this->input->post('email');
        $query = $this->db->query("select email from tb_pmb_tr_camaba_reg where email='".$email."'");
        // jika email sudah ada
        if ($query->num_rows() > 0){
            $result = 'ya';
        }else{
            $result = 'tidak';
        }
        echo json_encode($result);
    } 
    
    public function login(){
        $result='gagal';
        $p = $this->input->post();
        if ($p){
            $this->app_model->doCekLogin($p['frmlogin_email'],$p['frmlogin_pwd']);
        }
        echo $result;
    }
    
    public function register(){
        $this->form_validation->set_rules('nama', "Nama", 'required');
        $this->form_validation->set_rules('form_provLahir', "Propinsi", 'required');
        $this->form_validation->set_rules('form_kotaLahir', "Kota", 'required');
        $this->form_validation->set_rules('form_sma', "SMA Asal", 'required');
        $this->form_validation->set_rules('form_email', "Email", 'required');
        $this->form_validation->set_rules('form_nohp', "No. HP", 'required');
        $this->form_validation->set_rules('form_captcha', "Captcha", 'required'); 
        
        $pwdnya = "";
        $result = "";
        $strsql = "";
                
        $p = $this->input->post(); 
              
        if($p){
            $nama           = str_replace("'","",$p['nama']);      
            $kode_prop      = $p['kode_prop'];                        
            $kode_kota      = $p['kode_kota'];
            $kode_smu       = $p['kode_smu'];            
            $email          = $p['email'];
            $nohp           = $p['nohp'];
            $captcha        = $p['captcha'];
                        
            if ($this->form_validation->run() == TRUE && (strcmp(strtoupper($captcha),strtoupper($word)) == 0)){
              $this->session->unset_userdata('PMBONLINE');   
              $result = 'gagal';                                   
            }else{
                $query = $this->db->query("select email from tb_pmb_tr_camaba_reg where email='".$email."'");
                // jika email sudah ada
                if ($query->num_rows() > 0){
                    $result = 'sudah ada';
                }else{
                    // bila member masih baru
                    // generate password
                    $pwdnya=$this->randomPassword();
                    
                    // masukkan ke database
                    if($kode_smu=='{0}'){
                        $this->app_model->setReqSekolah($p);
                        $kode_smu="NULL";    
                        $this->system_model->writeNotifForUserOnGroupOfRole($this->config->item('application_id'),$this->system_model->getConfigItem('target_group_role_register'),'Permohonan penambahan sekolah baru.',base_url().'index.php/rf_pmb_req_sch/index/'.specialCharToHtmlCode($email));
                    }else $kode_smu="'$kode_smu'";
                    
                    
                    $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
                    $strsql = "insert into tb_pmb_tr_camaba_reg (Tahun_Penerimaan,tgl,nama,kode_prop,kode_kota,kode_smu,email,telp,pwd,Id_Langkah_Daftar,created_by,created_date) values 
                                ('".$tahun."',now(),'".$nama."','".$kode_prop."',".$kode_kota.",$kode_smu,'".$email."','".$nohp."',MD5('".$pwdnya."'),'3','$email',NOW())";
                                
                    $result = $this->db->query($strsql);    
                    
                    $conf_pt_sort_name=$this->app_model->getConfigItem('pt_sort_name');
                    $conf_pt_long_name=$this->app_model->getConfigItem('pt_long_name');
                    $conf_pt_address=$this->app_model->getConfigItem('pt_address');
                    
                    $isEmail = $this->app_model->getConfigItem('isSend_Email_Register');
                    if ($isEmail=='YES'){
                        $pesan="<p>email    : $email<br />password :$pwdnya</p>";                                                                       
                    
                        $pengirim   = $conf_pt_sort_name.' PMB Online';
                        $subyek     = 'UserID Password Pendaftaran Online';
                        $pesan      = 
"Yth ".$p['nama'].",
<br /><br />
Terima kasih telah mendaftar di ".$conf_pt_sort_name." PMB Online, portal pendaftaran calon mahasiswa baru ".$conf_pt_long_name." (".$conf_pt_sort_name."). 
Akun Anda telah diproses dan Anda kini dapat login menggunakan informasi berikut:<br /><br />
Alamat email: ".$email."<br />
Password: ".$pwdnya."<br />
<br />
<em>** Password bersifat case sensitive. Anda bisa merubah password tersebut setelah berhasil login kedalam sistem.</em>
<br /><br />
Untuk login, silakan ke ".base_url()."/login
<br /><br /><br />
$conf_pt_long_name($conf_pt_sort_name)<br />
$conf_pt_address";
                        
                        // kirim email
                        $this->kirim_email($pengirim,$email,$subyek,$pesan);               
                    }
                                   
                    // kirim sms
                    $isSms = $this->app_model->getConfigItem('isSend_SMS_Register');
                    if ($isSms=='YES'){
                        $pesansms   = "STIKI PMB Online"." \n";
                        $pesansms  .= "Email=".$email." \n";
                        $pesansms  .= "Password=".$pwdnya;
                        $this->system_model->sendsms($nohp,$pesansms);                
                    }
                         //
//                    $sess_data['username'] = $email;
//                    $this->session->set_userdata($sess_data);           
                    if ($result) $result = 'sukses'; else $result = 'gagal';                                    
                }
            }
            
            //$this->session->destroy();                                
            $this->system_model->writeNotifForUserOnGroupOfRole($this->config->item('application_id'),$this->system_model->getConfigItem('target_group_role_register'),'Pendaftar baru '.$nama,base_url().'index.php/tr_pendaftar/index/'.$nama);            
            echo $result;
           
        }
        
    }
        
    function forgotpassword(){
        $email = $this->input->post('email');                        
        $telp='';
        $hasil='';
        $query = $this->db->query("select telp from tb_pmb_tr_camaba_reg where email='".$email."'");
        if ($query->num_rows() > 0)
        {
            foreach($query->result() as $row){
                $telp = $row->telp; 
                
                $pwdnya=$this->randomPassword();
                $strsql = "update tb_pmb_tr_camaba_reg set pwd=MD5('".$pwdnya."'),modified_date=NOW() where email='".$email."'";
                $this->db->query($strsql);

                $isEmail = $this->app_model->getConfigItem('isSend_Email_Register');
                if ($isEmail=='YES'){
                    $pengirim   = 'STIKI PMB Online';
                    $subyek     = 'Reset Password STIKI PMB Online';
                    $pesan      = '<strong>Ini untuk login</strong> :<br/> Email User : '.$email.'<br/>Password : '.$pwdnya;
                    $this->kirim_email($pengirim,$email,$subyek,$pesan);               
                }
                                 
                $isSms = $this->app_model->getConfigItem('isSend_SMS_Register');                
                if ($isSms=='YES'){
                    
                    $pesansms   = "STIKI PMB Online"." \n";            
                    $pesansms  .= "Reset Password=".$pwdnya;       
                    $this->system_model->sendsms($telp,$pesansms);                                
                }
                $hasil = 'Password berhasil direset via email dan SMS';
            }
        }else{
            $hasil = 'Email tidak ditemukan';
        }
        echo json_encode($hasil);
    }

    function randomPassword() {
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
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
    function visitorTracking(){
        $byGeo=$this->input->post();
        if($byGeo['isok']==1){
            $data=$this->getLocationByGeo($byGeo['geo_lat'],$byGeo['geo_long']);
        }else{
            $data=$this->getLocationByIp();
        }
        echo $this->system_model->set_dailyVisitorCounter($data);
    }
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    public function getLocationByIp(){
        $ip=$this->get_client_ip();
        $this->load->library('myip2locationlite');
        
        //Load the class
        $ipLite = new ip2location_lite;
        $ipLite->setKey($this->config->item('key_ipinfodb'));
         
        //Get errors and locations
        $locations = $ipLite->getCity($ip);
        $errors = $ipLite->getError();
        if (!empty($locations) && is_array($locations)){
            $mydata['cityName']=$locations['cityName'];
            $mydata['country_code']=$locations['countryCode'];
            $mydata['region_name']=$locations['regionName'];
            
            return $mydata;
        }else return $errors;
    }
    
    public function getLocationByGeo($lat,$long){
        $apiKey=$this->config->item('key_google');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=".$apiKey;
        $data = @file_get_contents($url);
        $jsondata = json_decode($data,true);
        if(is_array($jsondata) && $jsondata['status'] == "OK")
        {
            $mydata['cityName']=$jsondata['results'][0]['address_components'][3]['short_name'];
            $mydata['country_code']=$jsondata['results'][0]['address_components'][5]['short_name'];
            $mydata['region_name']=$jsondata['results'][0]['address_components'][4]['short_name'];
        }
        return $mydata;
    }
    
}