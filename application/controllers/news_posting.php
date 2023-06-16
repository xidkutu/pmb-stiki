<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news_posting extends MY_Controller {
	
	public function index()
	{
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        $this->mydata['isCookieEnabled']=$this->isCookieEnabled();
        
        //Load Modal
        $this->mydata['modal']=$this->load->view('application/news_posting/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('application/news_posting/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function retrieveData()
	{		
        $this->load->library('datatable');            	
        $kolom = array('Kode_Pengumuman','Judul_Pengumuman','Publish_Time','isAktif','options-no-db');        
		$pk = 'email';
		$sql = "
			(
				SELECT
                	DISTINCT(annc.Kode_Pengumuman),
                	Judul_Pengumuman,
                	Publish_Time,
                	isAktif,
                	'action'
                FROM
                	tb_akd_tr_pengumuman annc INNER JOIN tb_glb_tr_target_pengumuman trgtApp ON annc.Kode_Pengumuman=trgtApp.Kode_Pengumuman
                WHERE
                	trgtApp.Target_App = '".$this->config->item('application_id')."'
                ORDER BY
                	Publish_Time DESC
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
            $aksi='setChangeActive_'.$this->mydata['page_id'].'("'.$row->Kode_Pengumuman.'")';
            if($row->isAktif=='YES'){
                $content="<input type='checkbox' checked class='make-switch' data-size='small' onchange='$aksi'>";
            }else{
                $content="<input type='checkbox' class='make-switch' data-size='small' onchange='$aksi'>";
            }	
			$new_data[] = array(
				$row->Kode_Pengumuman,				
				$row->Judul_Pengumuman,
				$row->Publish_Time,
                $content,						
				'<div class="btn-group"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i></a>
					 <ul class="dropdown-menu pull-right text-left">
							<li><a class="clickable" href="'.base_url().'index.php/news/read/'.$row->Kode_Pengumuman.'" target="_blank">Lihat</a></li>
                            <li><a class="clickable" onclick="edit_'.$this->mydata['page_id'].'(\''.$row->Kode_Pengumuman.'\')">Ubah</a></li>
                            <li class=\'divider\'></li>
                            <li><a class="clickable" onclick="deleteRecord_'.$this->mydata['page_id'].'(\''.$row->Kode_Pengumuman.'\',\''.$row->Judul_Pengumuman.'\')">Hapus</a></li>
					 </ul>
				</div>' 
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
	}
    
    public function changeAktif(){
        $id=$this->input->post('id');
        $res=$this->app_model->changeAktif('tb_akd_tr_pengumuman','Kode_Pengumuman',$id);
        if($res) echo 'succed'; else echo 'failed';
    }
    
    public function simpan()
	{
        $p=$this->input->post();
        if(isset($_COOKIE['Keterangan'])){
            $p['Keterangan']=$_COOKIE['Keterangan'];
        }
        if(isset($_COOKIE['Teaser'])){
            $p['Teaser']=$_COOKIE['Teaser'];
        }
        $data=$p;
        $data=mappingColumn("tb_akd_tr_pengumuman",$data);
        $data['Target_App']=$this->config->item('application_id');
        
        if(empty($p['Kode_Pengumuman'])){
            $data['isAktif']='YES';
            $data['Publish_Time']=$this->app_model->getToday();
            $data=$this->addInsertLog($data);
            $data=array_filter($data);
            $res['isSuccess']=$this->db->insert("tb_akd_tr_pengumuman",$data);
            $id=$this->db->insert_id();
            
            if($res['isSuccess']){
               $target=$this->app_model->getConfigItem('pmb_pengumuman_targetApp'); 
               $target=explode(',',$target);
               
               $trgt=array();
               foreach($target as $i=>$t){
                    $trgt[$i]['Kode_Pengumuman']=$id;
                    $trgt[$i]['Target_App']=$t;
                    $trgt[$i]=$this->addInsertLog($trgt[$i]);
               }
               $res['isSuccess']=$this->db->insert_batch('tb_glb_tr_target_pengumuman',$trgt);
            } 
        }else{
            $key = array(
                'Kode_Pengumuman' => $data['Kode_Pengumuman'],
            );
            $data=$this->addUpdateLog($data);
            $data=array_filter($data);
            $res['isSuccess']=$this->db->update('tb_akd_tr_pengumuman',$data,$key);
        }		
		
        echo json_encode($res);
	}
    
    public function detail(){
        $id=$this->input->post('id');
        
        $res=$this->system_model->getDetailNews($id);
        echo json_encode($res);
    }
    
    public function hapus(){
        $id=$this->input->post('id');
        $res=$this->system_model->hapusAsalInformasi($id);
        
        echo 'succed';
    }
    
    public function isCookieEnabled(){
        setcookie("test_cookie", "test", time() + 3600, '/');

        if(count($_COOKIE) > 0) return true; else return false;
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
