<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_berkas extends MY_Controller {

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
        $this->mydata['modal']=$this->load->view('rf/berkas/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('rf/berkas/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('datatable');          
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
          	
        $kolom = array('id_berkas','detail_berkas','isAktif','options-no-db');        
		$pk = 'id_berkas';
		$sql = "
			(
				SELECT id_berkas,detail_berkas,isAktif FROM  tb_pmb_rf_berkas			
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksi='setChangeActive_'.$this->mydata['page_id'].'("'.$row->id_berkas.'")';
            if($row->isAktif=='YES'){
                $content=
                    "<input type='checkbox' checked class='make-switch' data-size='small' onchange='$aksi'>";
            }else{
                $content=
                    "<input type='checkbox' class='make-switch' data-size='small' onchange='$aksi'>";
            }
            
            $aksiHapus='deleteRecord_'.$this->mydata['page_id'].'("'.$row->id_berkas.'","'.$row->detail_berkas.'")';
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$row->id_berkas.'","'.$row->detail_berkas.'")';
            
			$new_data[] = array(
				$row->id_berkas,				
				$row->detail_berkas,
                $content,            			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left' role='menu'>
                     <li role='presentation'>
	                    <a role='menuitem' tabindex='-1' href='#' onclick='$aksiEdit'>Ubah</a>
					 </li>
                     <li role='presentation' class='divider'></li>
                     <li role='presentation'>
                        <a role='menuitem' tabindex='-1' href='#' onclick='$aksiHapus'>Hapus</a>
					 </li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function changeAktif(){
        $id=$this->input->post('id');
        $res=$this->app_model->changeAktif('tb_pmb_rf_berkas','id_berkas',$id);
        
        echo 'succed';
    }
    
    public function simpan()
	{
	   $p=$this->input->post();
       if($p['saveas']=='baru'){
           $databaru = array(
                'detail_berkas' => $p['detail_berkas'],
                'isAktif' => 'YES',
           );
           $databaru=$this->addInsertLog($databaru);
           $res['isSuccess']=$this->db->insert("tb_pmb_rf_berkas",$databaru);
       }else{
            $databaru = array(
                'detail_berkas' => $p['detail_berkas'],
           );
           $databaru=$this->addUpdateLog($databaru);
           $key=array(
            'id_berkas' => $p['id_berkas'],
           );
           $res['isSuccess']=$this->db->update("tb_pmb_rf_berkas",$databaru,$key);
       }		
       echo json_encode($res);
	}
	
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->app_model->hapusBerkas($id);
        echo $res;
    }
    
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
