<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_pendaftar extends MY_Form_Camaba {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk asal informasi
	 **/
	
	public function index($key='')
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        $this->mydata['key']=transHtmlCode($key);
        $this->mydata['jsInclude']=getJsIncludeFormByClass('tr_pmb_insert_data');
        //Load Modal
        
        $this->mydata['content']=$this->load->view('tr/pendaftar/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_tr_pendaftar';
         
        // Table's primary key
        $primaryKey = 'email';
        $columns = array(
            array( 'db' => 'nama', 'dt' => 0 ),
            array( 'db' => 'Nama_Prop',  'dt' => 1 ),
            array( 'db' => 'Nama_Kota',   'dt' => 2 ),
            array( 'db' => 'Asal_SMU',   'dt' => 3 ),
            array( 'db' => 'email',   'dt' => 4 ),
            array( 'db' => 'telp',   'dt' => 5 ),
            array( 'db' => 'action',   'dt' => 6 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            //Action dropdown
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$content[$i][4].'","'.$content[$i][0].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][4].'")';
            $aksiLihat='lihat_'.$this->mydata['page_id'].'("'.$content[$i][4].'")';
            $aksiKartuUjian='kartuUjian_'.$this->mydata['page_id'].'("'.$content[$i][4].'")';
            $content[$i][6]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiLihat'>Lihat Profile</a></li>
                                  <li><a href='#' onclick='$aksiKartuUjian'>Kartu Ujian</a></li>
                                  <li><a href='#' onclick='$aksiEdit'>Edit</a></li>
                                  <li class='divider'></li>
                                  <li><a href='#' onclick='$aksiHapus'>Delete</a>
                                  </li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
    }
    public function load_profile(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->load->view('application/profile/profile_base',$this->mydata,true);
    }
    public function loadPage(){
        $page=$this->getProfile();
        echo $page;
    }
    public function getProfileCamaba(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        echo json_encode($res);
    }
    public function load_form(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->genFormCamaba();
    }
    public function load_kartuUjian(){
        $user=$this->input->post('id');
        if(!empty($user))$cur_user=$user; else $cur_user=$this->session->userdata('username');
        $this->session->set_userdata(array('cur_user'=>$cur_user)); 
        
        echo $this->getKartuUjian();
    }
    public function load_profile_bc(){
        echo $this->load->view('tr/pendaftar/bc_profile',false,true);
    }
    public function load_edit_bc(){
        echo $this->load->view('tr/pendaftar/bc_input',false,true);
    } 
    public function simpan()
	{
	   $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_pmb_rf_asal_informasi",$data);
        if($p['saveas']=='baru'){
            $data['isAktif']='YES';
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_pmb_rf_asal_informasi",$data);   
        }else{
            $key = array(
                'Id_Informasi' => $data['Id_Informasi'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_pmb_rf_asal_informasi',$data,$key);
        }		
		
        echo json_encode($res);
	}
    
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusPendaftar($id);
        
        echo 'succed';
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
