<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends MY_Form_Camaba {
    
    public function index($user=false){
        if($user)$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        $this->mydata['content']=$this->load->view('application/profile/profile_base',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
    }
    public function loadPage(){
        $page=$this->getProfile();
        echo $page;
    }
    public function getUserData(){
        $id=$this->input->post('id');
        if(empty($id)) $id=$this->session->userdata('username');
        $data=$this->app_model->getUserData($id);
        
        //$tempImg=$data['photo'];
//        $tempArr=explode("/",$tempImg);
//        $filename=$tempArr[count($tempArr)-1];
//        array_pop($tempArr);
//        $filePath=implode("/",$tempArr);
//        $tempArr=explode(".",$filename);
//        $etx=$tempArr[count($tempArr)-1];
        
        $data['photo']=$data['photo_thumb'];
        //echo $data['photo'];
        
        if(isset($data['photo'])){
            if($data['photo']==''
                || $this->is_url_exist($data['photo'])==false
            ){
                $data['photo']=conf_link($this->app_model->getConfigItem('no_picture_url'));
            }    
        }else $data['photo']=conf_link($this->app_model->getConfigItem('no_picture_url'));
        
        echo json_encode($data);
    }
    public function getProfileCamaba(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        echo json_encode($res);
    }
    
    public function getProfilePegawai(){
        $user=$this->session->userdata('username');
        $res=$this->app_model->getProfilePeg($user);
        echo json_encode($res);
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
                    'versions' => array(
                    	'avatar' => array(
                    		'crop' => true,
                    		'max_width' => 200,
                    		'max_height' => 200
                    	),
                    ),
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
                		$image->name = $username . md5(date('mdY')). '.' . $image->type;
                	},
                	'crop_complete' => function($image, $instance) {
                	}
                );
        $this->load->library('imgpicker',$options);
    }
    
    function uploadftp(){                
        $parts    = explode("@", $this->session->userdata('username'));
        $email    = $this->session->userdata('username');
        $username = $parts[0];
        $filename = $username.md5(date('mdY')).'-avatar.jpg'; //md5(date('mdY')) // file thumbnail
        $filenamepath_thumb = $this->config->item('file_loc_img').$filename; // file thumbail
        $filenamepath = $this->config->item('file_loc_img').$username.md5(date('mdY')).'.jpg'; // file ori
        $ftppath = $this->config->item('ftp_loc_img').$username.md5(date('mdY')).'-avatar.jpg';
        $ftppath_lgkp = $this->config->item('ftp_domain').$this->config->item('ftp_dir_img').$username.md5(date('mdY')).'-avatar.jpg';
        
        $sess_file['oploaded']=$filename; // file thumbnail
        if (@getimagesize($ftppath_lgkp)==1) $this->hapus_file_FTP($ftppath); 
        $this->doUploadFTP($sess_file); 
        
        $data=array(
                'fileowner'=>$email,
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_img'),
                'NamaFile'=>$filename,
                'NamaFileOri'=>$filename,
                'Direktori_Thumb'=>$this->config->item('ftp_dir_img'),
                'Thumbnail'=>$filename
            );
            
        $id=$this->app_model->setSaveFile($data);
        
        $peg=$this->app_model->getProfilePeg($this->session->userdata('username'));
        $strsql = "update tb_peg_rf_pegawai set IDFile=".$id['ID']." where nip='".$peg['nip']."'";
            
        $this->db->query($strsql);
                
        $this->session->set_userdata('my_photo', $ftppath_lgkp);  
        
        if (file_exists($filenamepath_thumb)==1) unlink($filenamepath_thumb);
        if (file_exists($filenamepath)==1) unlink($filenamepath); 
        
        echo $ftppath_lgkp;     
    }   
    
    function coba(){
        $ftppath_lgkp = $this->config->item('ftp_domain').$this->config->item('ftp_loc_img').'udin'.md5(date('mdY')).'-avatar.jpg';
        echo $ftppath_lgkp.'<br/>';
        echo '<img src="'.$ftppath_lgkp.'" />';
    }     
    
    function hapus_file_FTP($filename){
        $this->load->library('ftp');

        $config['hostname'] = $this->config->item('ftp_host');
        $config['username'] = $this->config->item('ftp_username');
        $config['password'] = $this->config->item('ftp_password');
        $config['port']     = 21;
        ///$config['passive']  = FALSE;
        $config['debug']    = TRUE;        
        $this->ftp->connect($config);
        $this->ftp->delete_file($filename);
        $this->ftp->close();
    }
    
}