<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password extends MY_Form_Camaba {
	
    public function index(){
        $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
    }
    
    public function loadPage(){
        $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        $par['Nama_Instansi']=$this->app_model->getConfigItem('pt_long_name');        
        echo $this->load->view('application/profile/change_password',$par,true);                
    }
    
    public function simpan(){
        $role = $this->session->userdata('login_role');        
        $password=$this->input->post('txtNewPassword');        
        $user=$this->session->userdata('username');        
        
        $roles=array('role_as_camaba');
		if(in_array($role,$roles)){
            $this->db->trans_begin();
            $query = "select email from tb_pmb_tr_camaba_reg where email = '$user'";            
            $hasil = $this->db->query($query);
            $appid = $this->config->item('application_id');
            if($hasil->num_rows()>0){
                $query="UPDATE tb_pmb_tr_camaba_reg
                            SET pwd = MD5('$password'),
                            Modified_App='$appid',
                            Modified_By='$user',
                            Modified_Date=now() 
                            WHERE
                            	email = '$user'";                  
                $this->db->query($query);                                
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $this->db->trans_commit();
                    echo 'ok';
                }                
            }else
                echo 'not ok';		  
          
            
		}else{
            $this->db->trans_begin();        
            $query="SELECT user_username FROM tb_app_rf_user WHERE user_username='$user'";            
            $hasil=$this->db->query($query);            
            if($hasil->num_rows()>0){
                $query="UPDATE tb_app_rf_user
                            SET user_password = MD5(PASSWORD('$password')),
                            Modified_App='SIAKAD',
                            Modified_By='$user',
                            Modified_Date=now() 
                            WHERE
                            	user_username = '$user'";   
                $this->db->query($query);    
                $this->change_pwd_mikrotik($user,$password);            
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $this->db->trans_commit();
                    echo 'ok';
                }                
            }else
                echo 'not ok';
		  
		}
	}
    
    function change_pwd_mikrotik($username,$newpassword){
		$newpassword=$this->system_model->mikrotik_encrypt($newpassword);
        if($this->app_model->getConfigItem('pmb_integrated_mikrotik')=='YES'){
    	    $ip           = $this->app_model->getConfigItem('mikrotik_ip');
            $old_name     = $username; 
            $new_password = $newpassword; 
            $cmmnd        = "=password=";
            $cmmnd       .= $new_password;
            $status       = '';        
                    
            if ((!empty($old_name)) && (!empty($new_password)))
            {                                
                $this->load->library('routeros_api');
                $this->routeros_api->debug = false;
                
                if ($this->routeros_api->connect($ip, $this->app_model->getConfigItem('mikrotik_username'), $this->app_model->getConfigItem('mikrotik_passwd')))
                {
                    $this->routeros_api->write('/ip/hotspot/user/getall',false);
                    $this->routeros_api->write('?name='.$old_name);
                    $READ = $this->routeros_api->read(false);
                    $ARRAY = $this->routeros_api->parse_response($READ);
                    $NILAI = $ARRAY[0]['password'];
                    
                    $this->routeros_api->write('/ip/hotspot/user/set',false);
                    $this->routeros_api->write('=.id='.$old_name ,false);
                    $this->routeros_api->write('=name='.$old_name ,false);
                    $this->routeros_api->write($cmmnd);
                    
                    $READ = $this->routeros_api->read(false);
                    $ARRAY = $this->routeros_api->parse_response($READ);                        
                    $status = 'ok';
                    $this->routeros_api->disconnect();
                }
                else
                {                  
                  $status = 'not ok';
                  $this->routeros_api->disconnect();
                }
            }
            else
            {                
                $status = 'not ok';
            }
        } else $status='ok';
        return $status;
	}
    
}