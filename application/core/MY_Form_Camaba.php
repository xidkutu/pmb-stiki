<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_Camaba extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : 
	 **/
    
    function  __construct() {
        parent::__construct();
    }
    
    public function genFormCamaba(){
        $prop=array(
            "tab"=>array(
                    0=>array(
                        "from"=>0,
                        "to"=>15,
                    ),
                    1=>array(
                        "from"=>16,
                        "to"=>27,
                    ),
                    2=>array(
                        "from"=>28,
                        "to"=>30,
                    ),
                    3=>array(
                        "from"=>31,
                        "to"=>35,
                    ),
                    4=>array(
                        "from"=>36,
                        "to"=>37,
                    ),
                    5=>array(
                        "from"=>38,
                        "to"=>55,
                    ),
                    6=>array(
                        "from"=>56,
                        "to"=>67,
                    ),
                    7=>array(
                        "from"=>68,
                        "to"=>68,
                    ),
                    8=>array(
                        "from"=>69,
                        "to"=>75,
                    ),
                    9=>array(
                        "from"=>76,
                        "to"=>79,
                    ),
                    10=>array(
                        "from"=>80,
                        "to"=>81,
                    ),
                    11=>array(
                        "from"=>91,
                        "to"=>92,
                    ),
                    12=>array(
                        "from"=>93,
                        "to"=>93,
                    ),
                    13=>array(
                        "from"=>94,
                        "to"=>94,
                    ),
                    14=>array(
                        "from"=>95,
                        "to"=>95,
                    ),
                ),
            "divSize"=>6,
        );
        $mydata=$this->mydata;
        $genForm=genFormInputByClassWithProperty('tr_pmb_insert_data',$prop);
        $mydata=array_merge($mydata,$genForm);
        $mydata['doneTypingInterval']=$this->system_model->getConfigItem('doneTypingInterval');
        $mydata['conf_ketentuan_photo']=$this->system_model->getConfigItem('ketentuan_photo');
        //Load Modal
        $mydata['img_aspect_ratio']=$this->system_model->getConfigItem('img_aspect_ratio');
        $mydata['modal_avatar']=$this->load->view('tr/pmb_insert_data/modal_profile',$mydata,true);
        $mydata['opt']['prodi']=$this->app_model->getOptProdi();
        
        $content=$this->load->view('tr/pmb_insert_data/content',$mydata,true);
        return $content;
    }
    public function getProfile($role=null){
        if(empty($role))$role=$this->session->userdata('role');
        if(strtolower($role)=='camaba'){
            $prop=array(
                    "tab"=>array(
                            0=>array(
                                "from"=>0,
                                "to"=>4,
                            ),
                            1=>array(
                                "from"=>5,
                                "to"=>13,
                            ),
                            2=>array(
                                "from"=>14,
                                "to"=>23,
                            ),
                            3=>array(
                                "from"=>24,
                                "to"=>26,
                            ),
                            4=>array(
                                "from"=>27,
                                "to"=>32,
                            ),
                            5=>array(
                                "from"=>33,
                                "to"=>38,
                            ),
                            6=>array(
                                "from"=>39,
                                "to"=>44,
                            ),
                            7=>array(
                                "from"=>45,
                                "to"=>56,
                            ),
                            8=>array(
                                "from"=>57,
                                "to"=>63,
                            ),
                            9=>array(
                                "from"=>64,
                                "to"=>67,
                            ),
                            10=>array(
                                "from"=>68,
                                "to"=>72,
                            ),
                            11=>array(
                                "from"=>73,
                                "to"=>85,
                            ),
                        ),
                    );
            $curUser=$this->session->userdata('cur_user');
            $par['berkas']=$this->app_model->getBerkasCamaba($curUser);
            $par['data_diri']=genDetailByClassWithProperty('tr_pmb_insert_data',$prop);
            $page=$this->load->view('application/profile/camaba',$par,true);    
        }else{
            $par['data_diri']=genDetailByClass('profile_pegawai');
            $page=$this->load->view('application/profile/pegawai',$par,true);
        }
        
        return $page;
    }
    public function getKartuUjian(){
        $prop=array(
                "tab"=>array(
                        0=>array(
                            "from"=>0,
                            "to"=>5,
                        ),
                        1=>array(
                            "from"=>6,
                            "to"=>8,
                        ),
                        2=>array(
                            "from"=>9,
                            "to"=>14,
                        ),
                        3=>array(
                            "from"=>23,
                            "to"=>25,
                        ),
                        4=>array(
                            "from"=>26,
                            "to"=>30,
                        ),
                        5=>array(
                            "from"=>31,
                            "to"=>36,
                        ),
                        6=>array(
                            "from"=>37,
                            "to"=>42,
                        ),
                        7=>array(
                            "from"=>43,
                            "to"=>53,
                        ),
                        8=>array(
                            "from"=>54,
                            "to"=>59,
                        ),
                        9=>array(
                            "from"=>60,
                            "to"=>63,
                        ),
                        10=>array(
                            "from"=>64,
                            "to"=>67,
                        ),
                        11=>array(
                            "from"=>68,
                            "to"=>74,
                        ),
                    ),
                );
        $par['Nama_Instansi']=$this->app_model->getConfigItem('pt_long_name');
        $par['alamat']=$this->app_model->getConfigItem('pt_address').' Telp. '.$this->app_model->getConfigItem('pt_telp');
        $par['logo']=conf_link($this->app_model->getConfigItem('pt_url_logo'));
        $par['url_ujian_online']=conf_link($this->app_model->getConfigItem('url_ujian_online'));
        $par['Kota_Tgl']=$this->app_model->getConfigItem('pt_city').', '.$this->app_model->getTodayByFormat();
        $par['data_diri']=genDetailByClassWithProperty('kartu_ujian',$prop);
        $isUjian=$this->app_model->getCamabaIsUjianAndJalur($this->session->userdata('cur_user'));
        $par['Nama_JalurPenerimaan']=$isUjian['Nama_JalurPenerimaan'];
        $page=$this->load->view('application/profile/kartu_ujian',$par,true);
        return $page;
    }
    
    public function doUploadFTP($sess_file){
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
        return 'succes';   
    }
}
?>