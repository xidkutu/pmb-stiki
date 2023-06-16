<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class file_uploader extends MY_Form_Camaba {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
	 
	public function index()
	{
        
	}
    
    public function doUploadImage(){
        $tempFile = $_FILES['file']['tmp_name'];
        $mime=$this->getMimeType($tempFile);
        if(in_array(strtolower($mime['type']),array('image'))){
            $targetPath = $this->config->item('file_loc_img');
            $filename = conf_filename($_FILES['file']['name']);
            $ext=end(explode('.',$filename));
            $filename=substr($filename,0,strlen($filename)-(strlen($ext)+1));
            $filename=str_replace(' ','_',$filename);
            $filename = $filename."_".md5($this->app_model->getToday());
            $targetFile = $targetPath.$filename.'.'.$ext;
            //echo $targetFile;
            $sess_file['oploaded']=$filename.'.'.$ext;
            
            move_uploaded_file($tempFile, $targetFile);
            
            $config['hostname'] = $this->config->item('ftp_host');
            $config['username'] = $this->config->item('ftp_username');
            $config['password'] = $this->config->item('ftp_password');
            $config['debug']	= TRUE;
            
            $sourcePath=$this->config->item('file_loc_img').$sess_file['oploaded'];
            $ftpPath=$this->config->item('ftp_loc_img').$sess_file['oploaded'];
            $this->ftp->connect($config);
            //echo $ftpPath;
            $this->ftp->upload($sourcePath, $ftpPath, 'auto', 0775);
            
            $this->ftp->close();
            
            unlink($sourcePath);
            
            $data=array(
                'fileowner'=>$this->session->userdata('username'),
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_img'),
                'NamaFile'=>$filename.'.'.$ext,
                'NamaFileOri'=>strip_quotes($_FILES['file']['name']),
                'Direktori_Thumb'=>null,
                'Thumbnail'=>null
            );
            
            $id=$this->app_model->setSaveFile($data);
            
            $sess_file['idFile']=$id['ID'];
            $this->session->set_userdata($sess_file);
            echo 'succes';
        }else{
            echo 'file type not allowed';
            http_response_code(403);  
        } 
    }
    
    public function doUploadDocument(){
        $tempFile = $_FILES['file']['tmp_name'];
        $mime=$this->getMimeType($tempFile);
        if(in_array(strtolower($mime['type']),array('image')) || $mime['mime']=='application/pdf'
        || $mime['mime']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        || $mime['mime']=='application/msword'
        ){
            $targetPath = $this->config->item('file_loc_doc');
            $filename = $_FILES['file']['name'];
            $ext=end(explode('.',$filename));
            $filename=substr($filename,0,strlen($filename)-(strlen($ext)+1));
            $filename=str_replace(' ','_',$filename);
            $filename = $filename."_".md5($this->app_model->getToday());
            $targetFile = $targetPath.$filename.'.'.$ext;
            //echo $targetFile;
            $sess_file['oploaded']=$filename.'.'.$ext;
            
            move_uploaded_file($tempFile, $targetFile);
            
            $config['hostname'] = $this->config->item('ftp_host');
            $config['username'] = $this->config->item('ftp_username');
            $config['password'] = $this->config->item('ftp_password');
            $config['debug']	= TRUE;
            
            $sourcePath=$this->config->item('file_loc_doc').$sess_file['oploaded'];
            $ftpPath=$this->config->item('ftp_loc_doc').$sess_file['oploaded'];
            $this->ftp->connect($config);
            echo $ftpPath;
            $this->ftp->upload($sourcePath, $ftpPath, 'auto', 0775);
            
            $this->ftp->close();
            
            unlink($sourcePath);
            
            $data=array(
                'fileowner'=>$this->session->userdata('username'),
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_img'),
                'NamaFile'=>$filename.'.'.$ext,
                'NamaFileOri'=>strip_quotes($_FILES['file']['name']),
                'Direktori_Thumb'=>null,
                'Thumbnail'=>null
            );
            
            $id=$this->app_model->setSaveFile($data);
            
            $sess_file['idFile']=$id['ID'];
            $this->session->set_userdata($sess_file);
            echo 'succes';
        }else{
            echo 'File type not allowed';
            http_response_code(403); 
        } 
    }
    
    public function doUploadBerkasDaftar(){
        $tempFile = $_FILES['file']['tmp_name'];
        $mime=$this->getMimeType($tempFile);
        if(in_array(strtolower($mime['type']),array('image')) || $mime['mime']=='application/pdf'){
            $targetPath = $this->config->item('file_loc_doc');
            $filename = $_FILES['file']['name'];
            $ext=end(explode('.',$filename));
            $filename=substr($filename,0,strlen($filename)-(strlen($ext)+1));
            $filename=str_replace(' ','_',$filename);
            $filename = $filename.$this->input->get('id')."_".md5($this->app_model->getToday());
            $targetFile = $targetPath.$filename.'.'.$ext;
            //echo $targetFile;
            $sess_file['oploaded']=$filename.'.'.$ext;
            
            move_uploaded_file($tempFile, $targetFile);
            
            $config['hostname'] = $this->config->item('ftp_host');
            $config['username'] = $this->config->item('ftp_username');
            $config['password'] = $this->config->item('ftp_password');
            $config['debug']	= TRUE;
            
            $sourcePath=$this->config->item('file_loc_doc').$sess_file['oploaded'];
            $ftpPath=$this->config->item('ftp_loc_doc').$sess_file['oploaded'];
            $this->ftp->connect($config);
            //echo $ftpPath;
            $this->ftp->upload($sourcePath, $ftpPath, 'auto', 0775);
            
            $this->ftp->close();
            
            unlink($sourcePath);
            
            $data=array(
                'fileowner'=>$this->session->userdata('username'),
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_doc'),
                'NamaFile'=>$filename.'.'.$ext,
                'NamaFileOri'=>strip_quotes($_FILES['file']['name']),
                'Direktori_Thumb'=>null,
                'Thumbnail'=>null
            );
            
            $id=$this->app_model->setSaveFile($data);
            
            $files=json_decode($this->session->userdata('my_berkas_files'),true);
            
            $berkas=array(
                'Username_Camaba'=>$this->session->userdata('username'),
                'Id_Files'=>$id['ID'],
                'id_berkas'=>$this->input->get('id'),
                'NamaFileOri'=>strip_quotes($_FILES['file']['name']),
                'ftp_path'=>$ftpPath
            );
            $berkas=$this->app_model->addInsertLog($berkas);
            
            if(is_array($files)){
                array_push($files,$berkas);    
            }else{
                $files[0]=$berkas;
            }
            
            $json_files=json_encode($files);
            $this->session->set_userdata('my_berkas_files',$json_files);
            echo 'succes';
        }else{
            echo 'File type not allowed';
            http_response_code(403); 
        }
    }
    
    public function removeberkas(){
        $id=$this->input->post('id');
        $berkas=$this->input->post('berkas');
        $files=json_decode($this->session->userdata('my_berkas_files'),true);
        $newFiles=array();
        foreach($files as $i=>$f){
            if($f['NamaFileOri']==$id && $f['id_berkas']==$berkas){
                $this->delFile($f['ftp_path']);
                $this->system_model->files_del($f['Id_Files']);
            }else{
                if(count($newFiles)>0){
                    array_push($newFiles,$f);    
                }else{
                    $newFiles[0]=$f;
                }
            }
        }
        //print_r($newFiles);
        $json_files=json_encode($newFiles);
        $this->session->set_userdata('my_berkas_files',$json_files);
        $res['msg']=$id;
        echo json_encode($res);
    }
    
    public function delFile($path){
        $config['hostname'] = $this->config->item('ftp_host');
        $config['username'] = $this->config->item('ftp_username');
        $config['password'] = $this->config->item('ftp_password');
        $config['debug']	= TRUE;
        
        $this->ftp->connect($config);
        //echo $ftpPath;
        $this->ftp->delete_file($path);
        
        $this->ftp->close();
    }
    
    public function doUploadProfilePictureCamaba(){
        $tempFile = $_FILES['file']['tmp_name'];
        $mime=$this->getMimeType($tempFile);
        if(in_array(strtolower($mime['type']),array('image'))){
            $targetPath = $this->config->item('ftp_loc_img');
            $filename = $_FILES['file']['name'];
            $ext=end(explode('.',$filename));
            $filename=substr($filename,0,strlen($filename)-(strlen($ext)+1));
            $filename=str_replace(' ','_',$filename);
            $filename = $filename."_".md5($this->app_model->getToday());
            $targetFile = $targetPath.$filename.'.'.$ext;
            //echo $targetFile;
            $sess_file['oploaded']=$filename.'.'.$ext;
            
            move_uploaded_file($tempFile, $targetFile);
            
            $config['hostname'] = $this->config->item('ftp_host');
            $config['username'] = $this->config->item('ftp_username');
            $config['password'] = $this->config->item('ftp_password');
            $config['debug']	= TRUE;
            
            $sourcePath=$this->config->item('ftp_loc_img').$sess_file['oploaded'];
            $ftpPath=$this->config->item('ftp_loc_img').$sess_file['oploaded'];
            $this->ftp->connect($config);
            echo $ftpPath;
            $this->ftp->upload($sourcePath, $ftpPath, 'auto', 0775);
            
            $this->ftp->close();
            
            unlink($sourcePath);
            
            $data=array(
                'fileowner'=>$this->session->userdata('username'),
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_img'),
                'NamaFile'=>$filename.'.'.$ext,
                'NamaFileOri'=>strip_quotes($_FILES['file']['name']),
                'Direktori_Thumb'=>null,
                'Thumbnail'=>null
            );
            
            $id=$this->app_model->setSaveFile($data);
            
            $sess_file['idFile']=$id['ID'];
            $this->session->set_userdata($sess_file);
            echo 'succes';
        }else echo 'failed';
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
    
    function uploadPhotoDataDiri(){                
        $parts    = explode("@", $this->session->userdata('username'));
        $email    = $this->session->userdata('username');
        $username = $parts[0];
        
        $filename = $username.md5(date('mdY')).'.jpg'; //file ori
        $ftppath = $this->config->item('ftp_loc_img').$filename;
        $ftppath_lgkp = $this->config->item('ftp_domain').$ftppath;
        $filenamepath_loc = $this->config->item('file_loc_img').$filename;
        
        $filename_avatar = $username.md5(date('mdY')).'-avatar.jpg'; //file avatar
        $ftppath_avatar = $this->config->item('ftp_loc_img').$filename_avatar;
        $ftppath_lgkp_avatar = $this->config->item('ftp_domain').$ftppath_avatar;
        $filenamepath_loc_avatar = $this->config->item('file_loc_img').$filename_avatar;
        
        $filename_thumb = $username.md5(date('mdY')).'-thumb.jpg'; //file thumbnail
        $ftppath_thumb = $this->config->item('ftp_loc_img').$filename_thumb;
        $ftppath_lgkp_thumb = $this->config->item('ftp_domain').$ftppath_thumb;
        $filenamepath_loc_thumb = $this->config->item('file_loc_img').$filename_thumb;
        
        $sess_file['oploaded']=$filename; // file thumbnail
        if (@getimagesize($ftppath_lgkp)==1) $this->delFile($ftppath); 
        $this->doUploadFTP($sess_file);
        
        $sess_file['oploaded']=$filename_avatar; // file thumbnail
        if (@getimagesize($ftppath_lgkp_avatar)==1) $this->delFile($ftppath_avatar); 
        $this->doUploadFTP($sess_file);  
        
        $sess_file['oploaded']=$filename_thumb; // file thumbnail
        if (@getimagesize($ftppath_lgkp_thumb)==1) $this->delFile($ftppath_thumb); 
        $this->doUploadFTP($sess_file);  
        
        
        $data=array(
                'fileowner'=>$email,
                'Domain'=>$this->config->item('ftp_domain'),
                'Direktori'=>$this->config->item('ftp_dir_img'),
                'NamaFile'=>$filename_avatar,
                'NamaFileOri'=>$filename,
                'Direktori_Thumb'=>$this->config->item('ftp_dir_img'),
                'Thumbnail'=>$filename_thumb
            );
            
        $id=$this->app_model->setSaveFile($data);
        
        if($this->session->userdata('role')=='camaba')
            $strsql = "update tb_pmb_tr_camaba_reg set ID_File_Photo=".$id['ID']." where email='".$this->input->post('username')."'";
        else{
            $nip=$this->system_model->getNipByUsername($this->input->post('username'));
            $strsql = "update tb_peg_rf_pegawai set IDFile=".$id['ID']." where NIP='$nip'";
        }
            
        $res['isSuccess']=$this->db->query($strsql);
                
        $this->session->set_userdata('my_photo', $ftppath_lgkp_thumb);  
        
        if (file_exists($filenamepath_loc)) unlink($filenamepath_loc);
        if (file_exists($filenamepath_loc_avatar)) unlink($filenamepath_loc_avatar);
        if (file_exists($filenamepath_loc_thumb)) unlink($filenamepath_loc_thumb);
        
        echo json_encode($res);      
    }  
    
    function uploadPhotoPeg(){  
        $parts    = explode("@", $this->session->userdata('username'));
        $email    = $this->session->userdata('username');
        $username = $parts[0];
        
        $filename = $username.md5(date('mdY')).'.jpg'; //file ori
        $ftppath = $this->config->item('ftp_loc_img').$filename;
        $ftppath_lgkp = $this->config->item('ftp_domain').$ftppath;
        $filenamepath_loc = $this->config->item('file_loc_img').$filename;
        
        $sess_file['oploaded']=$filename; // file thumbnail
        if (@getimagesize($ftppath_lgkp)==1) $this->delFile($ftppath); 
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
        
        $nip=$this->system_model->getNipByUsername($this->input->post('username'));
        $strsql = "update tb_peg_rf_pegawai set IDFile=".$id['ID']." where NIP='$nip'";
            
        $res['isSuccess']=$this->db->query($strsql);
                
        $this->session->set_userdata('my_photo', $ftppath_lgkp);  
        
        if (file_exists($filenamepath_loc)) unlink($filenamepath_loc);
        echo json_encode($res);      
    }  
	function getMimeType($filename){
	   $mimes=mime_content_type ( $filename );
       $tmp=explode('/',$mimes);
       $res=array(
            'type'=>$tmp[0],
            'mime'=>$mimes
       );
       return $res;
	}
}
