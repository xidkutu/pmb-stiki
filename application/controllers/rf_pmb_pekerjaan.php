<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_pekerjaan extends MY_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman pekerjaan
	 **/
	
	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/pekerjaan/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/pekerjaan/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_pekerjaan';
         
        // Table's primary key
        $primaryKey = 'Kd_Pekerjaan';
         
        $columns = array(
            array( 'db' => 'Kd_Pekerjaan', 'dt' => 0 ),
            array( 'db' => 'Pekerjaan',  'dt' => 1 ),
            array( 'db' => 'Keterangan',  'dt' => 2 ),
            array( 'db' => 'isAktif',   'dt' => 3 ),
            array( 'db' => 'action',   'dt' => 4 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            $aksi='setChangeActive_'.$this->mydata['page_id'].'("'.$content[$i][0].'")';
            if($content[$i][3]=='checkYES'){
                $content[$i][3]=
                    "<input type='checkbox' checked class='make-switch' data-size='small' onchange='$aksi'>";
            }else{
                $content[$i][3]=
                    "<input type='checkbox' class='make-switch' data-size='small' onchange='$aksi'>";
            }
            //Action dropdown
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][4]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Edit</a>
                                  </li>
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
    
    public function changeAktif(){
        $id=$this->input->post('id');
        $res=$this->app_model->changeAktif('tb_akd_rf_pekerjaan','Kd_Pekerjaan',$id);
        
        echo 'succed';
    }

    public function simpan()
	{
	   $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_akd_rf_pekerjaan",$data);
        $data=array_filter($data);
        if($p['saveas']=='baru'){
            $data['isAktif']='YES';
            $data=$this->addInsertLog($data);
            $res['isSuccess']=$this->db->insert("tb_akd_rf_pekerjaan",$data);   
        }else{
            $key = array(
                'Kd_Pekerjaan' => $data['Kd_Pekerjaan'],
            );
            $data=$this->addUpdateLog($data);
            $res['isSuccess']=$this->db->update('tb_akd_rf_pekerjaan',$data,$key);
        }		
		
        echo json_encode($res);  
	}
    public function detail(){
        $id=$this->input->post('id');
        
        $res=$this->app_model->getDetailPekerjaan($id);
        echo json_encode($res);
    }
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusPekerjaan($id);
        
        echo 'succed';
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
