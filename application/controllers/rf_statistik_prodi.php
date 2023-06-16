<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rf_statistik_prodi extends CI_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman statistik prodi
	 **/
	
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='Rf_statistik_prodi';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/Rf_statistik_prodi');
        }
    }
    
    public function getDataFromDB($table,$id,$idField,$resultField){
        $temp = $this->app_model->getDataFromDB($table,$id,$idField,$resultField);
        $result=$temp->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0][$resultField];   
        }
        return $hasil;
    }
    
    public function getDataFromDBJson(){
        $id = $this->input->post('id');
        $idField = $this->input->post('idField');
        $resultField =$this->input->post('resultField');
        $table = $this->input->post('table');
        
        $result['result'] = $this->getDataFromDB($table,$id,$idField,$resultField);
        
        echo json_encode($result);
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
    
    
    
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
        
		if(!empty($cek)){
            $class=$this->session->userdata('class');
            if($class=='Rf_statistik_prodi'){
                $cari=$this->session->userdata('keyword');
                $d['keyword']=$cari;
    			if(empty($cari)){
    				$where = ' ';
    			}else{
    				$where = "";
    			}
    			
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Statistik Prodi";
    			
                $text="SELECT COUNT(NRP) as max1 FROM tb_akd_rf_prodi prodi LEFT JOIN tb_pmb_camaba maba ON prodi.Kode_Prodi=maba.Kode_Prodi";
                $res=$this->db->query($text);
                
                $max=0;
                foreach($res->result() as $t){
                    $max=$t->max1;
                }
 			
                $text="SELECT Nama_Prodi,COUNT(NRP) as n FROM tb_akd_rf_prodi prodi LEFT JOIN tb_pmb_camaba maba ON prodi.Kode_Prodi=maba.Kode_prodi GROUP BY prodi.Kode_Prodi";
                $res=$this->db->query($text);
                $d['data']=$res->result_array();
                $legend=array();
                $n=array();
                
                foreach($res->result() as $t){
                    $legend[]=$t->Nama_Prodi;
                    $n[]=$t->n;
                };
            		
		            $this->graph->set_data( $n );
                    $this->graph->bar_glass( 55, '#fff', '#fff', ' Statistik Prodi', 11  );
                    
                    $this->graph->set_x_labels( $legend );
                    
            		$this->graph->set_y_max( $max );
            		$this->graph->width=900;
            		$this->graph->height=400;
            		$this->graph->y_label_steps( 10 );
            		$this->graph->bg_colour='#d7ebf9';
            		$this->graph->set_x_legend( 'STATISTIK PRODI', 14, '#736AFF' );
            		
            		$this->graph->set_output_type("js");
                    //Parse variable
                $d['page_title']='Statistik Prodi Pilihan Pendaftar';
                $d['sub_page_title']='Welcome User';
                
                //Generate menu dari database;
                $d['breadcrumb']=generateBreadcrumb('SIMARU_statistik_prodi');
                
                //Toogle manu yang sedang aktif
                $activeMenu=array(
                        0 => 'SIMARU_Statistik',
                        1 => 'SIMARU_statistik_prodi',
                    );
                $collapseMenu=array(
                    0 => 'SIMARU_Statistik'
                    );
                $collapseSubMenu=array();
                $d['active_menu']=$activeMenu;
                $d['collapseMenu']=$collapseMenu;
                $d['collapseSubMenu']=$collapseSubMenu;
                
                //Load view
                $d['header']=$this->load->view('required/header',$d,true);
                $d['sidebar_menu']=$this->load->view('required/menu_sidebar',$d,true);
                $d['content']=$this->load->view('rf/statistik_prodi/view',$d,true);
                $this->load->view('main_page',$d); 
            }else
                $this->awal();
		}else{
			header('location:'.base_url());
		}
	}
    
   
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */