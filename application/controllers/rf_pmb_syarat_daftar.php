<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_syarat_daftar extends MY_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : -
	 **/

	public function index()
	{  
        $genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('rf/syarat_pendaftaran/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/syarat_pendaftaran/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_rf_syarat_daftar';
         
        // Table's primary key
        $primaryKey = 'Id_SyaratDaftar';
         
        $columns = array(
            array( 'db' => 'Id_SyaratDaftar', 'dt' => 0 ),
            array( 'db' => 'Detail_SyaratDaftar',  'dt' => 1 ),
            array( 'db' => 'isAktif',   'dt' => 2 ),
            array( 'db' => 'action',   'dt' => 3 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            $aksi='setChangeActive_'.$this->mydata['page_id'].'("'.$content[$i][0].'")';
            if($content[$i][2]=='checkYES'){
                $content[$i][2]=
                    "<input type='checkbox' checked class='make-switch' data-size='small' onchange='$aksi'>";
            }else{
                $content[$i][2]=
                    "<input type='checkbox' class='make-switch' data-size='small' onchange='$aksi'>";
            }
            //Action dropdown
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'","'.$content[$i][1].'")';
            $content[$i][3]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left' role='menu'>
                                 <li role='presentation'>
				                    <a role='menuitem' tabindex='-1' href='#' onclick='$aksiEdit'>Ubah</a>
								 </li>
                                 <li role='presentation' class='divider'></li>
                                 <li role='presentation'>
                                    <a role='menuitem' tabindex='-1' href='#' onclick='$aksiHapus'>Hapus</a>
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
        $res=$this->app_model->changeAktif('tb_pmb_rf_syarat_daftar','Id_SyaratDaftar',$id);
        
        echo 'succed';
    }
    
    public function simpan()
	{
	   $p=$this->input->post();
       $id_syarat=$this->input->post('id_syarat');
       $detail_syarat=$this->input->post('detail_syarat');
       
       if($p['saveas']=='baru'){
           $databaru = array(
                'Detail_SyaratDaftar' => $p['Detail_SyaratDaftar'],
                'isAktif' => 'YES',
           );
           $databaru=$this->addInsertLog($databaru);
           $res['isSuccess']=$this->db->insert("tb_pmb_rf_syarat_daftar",$databaru);
       }else{
            $databaru = array(
                'Detail_SyaratDaftar' => $p['Detail_SyaratDaftar'],
           );
           $databaru=$this->addUpdateLog($databaru);
           $key=array(
            'Id_SyaratDaftar' => $p['Id_SyaratDaftar'],
           );
           $res['isSuccess']=$this->db->update("tb_pmb_rf_syarat_daftar",$databaru,$key);
       }		
       echo json_encode($res);
	}
	
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusSyaratDaftar($id);
        echo $res;
    }
    
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
