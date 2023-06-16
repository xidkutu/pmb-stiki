<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lp_terima_mhs extends MY_Form_Camaba {

	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('lp/mhs_diterima/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('lp/mhs_diterima/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function get_datatable()
	{		
        $this->load->library('datatable');
        
		$tglmulai = $this->input->get('tglmulai');
        $tglsmp   = $this->input->get('tglsmp');

        if ($tglmulai==''){            
            $where = " YEAR(Tgl_Diterima) = YEAR(CURDATE()) AND MONTH(Tgl_Diterima) = MONTH(CURDATE()) ";
        }else{
            $where = " DATE_FORMAT(Tgl_Diterima,'%Y-%m-%d') between '".$tglmulai."' and '".$tglsmp."' ";            
        }
            	
        $kolom = array('Tgl_Diterima','Nama_Mhs','Email','Jenjang','Nama_Prodi','Kelas_Deskripsi','IsDiterima','Status_Masuk','Nama_JalurPenerimaan','options-no-db');        
		$pk = 'Email';
		$sql = '
			(
				SELECT date_format(Tgl_Diterima,\'%d-%m-%Y\')Tgl_Diterima,Nama_Mhs,camaba.Email,prodi.Jenjang,prodi.Nama_Prodi,kls.Kelas_Deskripsi,IsDiterima,Status_Masuk,jalur.Nama_JalurPenerimaan
                FROM tb_pmb_tr_camaba camaba
                INNER JOIN tb_akd_rf_prodi prodi ON camaba.Kode_Prodi = prodi.Kode_Prodi
                LEFT JOIN tb_akd_rf_kelas_mhs kls ON kls.Kelas_Mhs=camaba.Kelas
                LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON jalur.Id_JalurPenerimaan=camaba.Jalur_Penerimaan   
				WHERE '.$where.'  order by Tgl_Diterima DESC
				
			)';					
        
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
                $row->Tgl_Diterima,
                $row->Nama_Mhs,
                $row->Email,
                $row->Jenjang,
                $row->Nama_Prodi,
                $row->Kelas_Deskripsi,
                $row->IsDiterima,
                $row->Status_Masuk,
                $row->Nama_JalurPenerimaan,            
				'<div class="btn-group"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i></a>
					 <ul class="dropdown-menu pull-right text-left">
							<li><a class="clickable" onclick="lihat_'.trim($this->mydata['page_id']).'(\''.$row->Email.'\',\''.$row->Tgl_Diterima.'\')" data-toggle="modal" data-target="#main-modal-lg">Lihat Profile</a></li>
					 </ul>
				</div>' 
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_tr_terima_mhs';
         
        // Table's primary key
        $primaryKey = 'Id_Camaba';
         
        $columns = array(
            array( 'db' => 'Id_Camaba', 'dt' => -1 ),
            array( 'db' => 'Nama_Mhs',  'dt' => 0 ),
            array( 'db' => 'Jenjang',   'dt' => 1 ),
            array( 'db' => 'Nama_Prodi',   'dt' => 2 ),
            array( 'db' => 'Kelas_Deskripsi',   'dt' => 3 ),
            array( 'db' => 'Status_Masuk',   'dt' => 4 ),
            array( 'db' => 'Nama_JalurPenerimaan',   'dt' => 5 ),
            array( 'db' => 'IsDiterima',   'dt' => 6 ),
            array( 'db' => 'action',   'dt' => 7 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            //Action dropdown
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][-1].'")';
            $content[$i][7]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Ubah Penerimaan</a>
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
        $page=$this->getProfile('camaba');
        echo $page;
    }
    public function load_profile_bc(){
        echo $this->load->view('lp/mhs_diterima/bc_profile',false,true);
    }
    public function getProfileCamaba(){
        $user=$this->input->post('id');
        $res=$this->app_model->getProfileCamaba($user);
        echo json_encode($res);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
