<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lp_pmb_pendaftar extends MY_Form_Camaba {

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
        
        $this->mydata['content']=$this->load->view('lp/pmb_pendaftar/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function get_datatable()
	{		
        $this->load->library('datatable');
        
		$tglmulai = $this->input->get('tglmulai');
        $tglsmp   = $this->input->get('tglsmp');

        if ($tglmulai==''){            
            $where = " YEAR(tgl) = YEAR(CURDATE()) AND MONTH(reg.tgl) = MONTH(CURDATE()) ";
        }else{
            $where = " DATE_FORMAT(reg.tgl,'%Y-%m-%d') between '".$tglmulai."' and '".$tglsmp."' ";            
        }
            	        
        $kolom = array('tggl','nama','nama_prop','nama_kota','asal_smu','email','telp','options-no-db');        
		$pk = 'email';
		$sql = '
			(
				SELECT date_format(tgl,\'%d-%m-%Y\')tggl,nama,nama_prop,nama_kota,sklh.asal_smu,reg.email,reg.telp
                FROM tb_pmb_tr_camaba_reg reg
                INNER JOIN tb_akd_rf_propinsi prop ON reg.Kode_Prop = prop.Kode_Prop
                INNER JOIN tb_glb_rf_kota kota ON reg.Kode_Kota=kota.Kode_Kota
                INNER JOIN tb_akd_rf_asal_sekolah sklh ON sklh.Kode_SMU=reg.Kode_SMU   
				WHERE '.$where.'  order by reg.tgl DESC
				
			)';
			//and YEAR(presensi.tgl) = YEAR(CURDATE()) AND MONTH(presensi.tgl) = MONTH(CURDATE())
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $new_data[] = array(
				$row->tggl,				
				$row->nama,
				$row->nama_prop,
				$row->nama_kota,
				$row->asal_smu,
                $row->email,
                $row->telp,								
				'<div class="btn-group"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i></a>
                   <ul class="dropdown-menu pull-right text-left">
                	  <li><a href="#" onclick="'.'lihat_'.trim($this->mydata['page_id']).'(&quot;'.trim($row->email).'&quot;)'.'">Lihat Profile</a></li>
                	  <li><a href="#" onclick="'.'kartuUjian_'.$this->mydata['page_id'].'(&quot;'.trim($row->email).'&quot;)'.'">Kartu Ujian</a></li>
                   </ul>
                </div>'                                
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
	}
    
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_tr_pendaftar';
         
        // Table's primary key
        $primaryKey = 'email';
        $columns = array(
            array( 'db' => 'tgl', 'dt' => 0 ),
            array( 'db' => 'nama', 'dt' => 1 ),
            array( 'db' => 'Nama_Prop',  'dt' => 2 ),
            array( 'db' => 'Nama_Kota',   'dt' => 3 ),
            array( 'db' => 'Asal_SMU',   'dt' => 4 ),
            array( 'db' => 'email',   'dt' => 5 ),
            array( 'db' => 'telp',   'dt' => 6 ),
            array( 'db' => 'action',   'dt' => 7 ),
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
        $page=$this->getProfile('camaba');
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
        echo $this->load->view('lp/pmb_pendaftar/bc_profile',false,true);
    }
    public function load_edit_bc(){
        echo $this->load->view('lp/pmb_pendaftar/bc_input',false,true);
    } 
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
