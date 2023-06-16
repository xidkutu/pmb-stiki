<?php

    class checkpermition {
                
        public function construct(){
            
        }
        
        public function run(){
            $CI = &get_instance();
            $CI->load->library('session');
            $CI->load->model('system_model');
            //echo "it's work";
            $classFunction=$CI->session->userdata('class_function');
            $loggedIn=$CI->session->userdata('logged_in');
            
            $uri =& load_class('URI', 'core');

            $className = $uri->rsegment(1);
            $functionName =$uri->rsegment(2);
            
            $classExclude=array('login','home','security_center');
            
            if(!empty($loggedIn)){
                if(!in_array($className,$classExclude)){
                    if($CI->system_model->isActionPermit($CI->session->userdata('role'),$className,$functionName)){
                        //do nothing
                    }
                    else{
                        $CI->system_model->writeLog(
                            $CI->session->userdata('username'),
                            $className,
                            $functionName,
                            'Try access denied message',
                            'deniedMessage',
                            $CI->session->userdata('username')
                        );
                        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
                            $CI->session->set_flashdata("sec_error_msg","Access denied !");
                            $CI->session->set_flashdata('log_message',"Try access forbidden function");
                            $CI->session->set_flashdata('log_tag',"Access Denied");
                            $CI->session->set_flashdata('log_classname',$className);
                            $CI->session->set_flashdata('log_functionname',$functionName);
                            //echo $className." ".$functionName;
                            redirect(base_url()."index.php/security_center/deniedMessage"); 
                        }else{
                            $CI->session->set_flashdata("sec_error_msg","Access denied !");
                            $CI->session->set_flashdata('log_message',"Try access forbidden function");
                            $CI->session->set_flashdata('log_tag',"Access Denied");
                            $CI->session->set_flashdata('log_classname',$className);
                            $CI->session->set_flashdata('log_functionname',$functionName);
                            redirect(base_url().'index.php/dashboard');
                        }  
                    } 
                }
            }else{
                if(!in_array($className,$classExclude)){
                    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
                        echo '{logout}';
                    }else
                        redirect(base_url());
                }
            }
            
//            if(!in_array($className,$classExclude)){
//                if(!empty($loggedIn)){
//                    if(count($classFunction)!=0){
//                        if(in_array(array('Class_Name'=>$className,'FunctionName'=>$functionName),$classFunction)){
//                            //do nothing
//                        }
//                        else{
//                            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
//                                $CI->session->set_flashdata("sec_error_msg","Access denied !");
//                                $CI->session->set_flashdata('log_message',"Try access forbidden function");
//                                $CI->session->set_flashdata('log_tag',"Access Denied");
//                                $CI->session->set_flashdata('log_classname',$className);
//                                $CI->session->set_flashdata('log_functionname',$functionName);
//                                //echo $className." ".$functionName;
//                                redirect(base_url()."index.php/security_center/deniedMessage"); 
//                            }else{
//                                $CI->session->set_flashdata("sec_error_msg","Access denied !");
//                                $CI->session->set_flashdata('log_message',"Try access forbidden function");
//                                $CI->session->set_flashdata('log_tag',"Access Denied");
//                                $CI->session->set_flashdata('log_classname',$className);
//                                $CI->session->set_flashdata('log_functionname',$functionName);
//                                redirect(base_url().'index.php/dashboard');
//                            }  
//                        }     
//                    }else
//                        redirect(base_url());
//                }else{
//                    if(!in_array($className,$classExclude)) redirect(base_url());
//                }
//            }else{
//                //if(!empty($loggedIn) && $className=='login' && $functionName=='logout'){
//                    //do nothing
//                //}else{
//                    
//                //}
//                //if(!empty($loggedIn)) redirect(base_url().'index.php/dashboard');
//            }
        }   
    }

?>