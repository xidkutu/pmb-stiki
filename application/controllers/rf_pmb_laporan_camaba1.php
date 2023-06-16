<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_laporan_camaba extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    //public function cekFileUploaded(){
//        $result['namaUploaded'] = $this->session->userdata('oploaded');
//        $result['filename']=base_url().'asset/photo/'.$result['namaUploaded'];
//        
//        echo json_encode($result);
//    }
    
    //public function showUploader(){
//        $this->load->view('rf/camaba/uploader');
//    }
    
    //public function saveFile(){
//        $cek = $this->session->userdata('logged_in');
//		if(!empty($cek)){
//		      
//            /** Inserting Data Program Studi **/
//            $this->load->library('upload');
//                        
//            $config['upload_path'] = './asset/photo/';
//    		$config['allowed_types'] = '7zip|zip|rar|bmp|jpg|png';
//    		$config['max_size']	= '0';
//            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
//            $config['remove_spaces']='true';
//            $d['nama_file']=$_FILES['userfile']['name'];
//            $this->upload->initialize($config);
//                      
//    		if ( ! $this->upload->do_upload())
//    		{
//    			$error = array('error' => $this->upload->display_errors('',''));
//                $d['pesan']=$error['error'].'asdasdada';
//		 	    
//                $sess_file['oploaded']='';
//                $this->session->set_userdata($sess_file);
//                
//                $this->load->view('rf/camaba/upload_success', $d);
//    		}
//    		else
//    		{   
//                $data=$this->upload->data();
//                $d['pesan']='success';
//                $sess_file['oploaded']=$data['file_name'];
//                $this->session->set_userdata($sess_file);
//                
//		 	    $this->load->view('rf/camaba/upload_success', $d);
//    		}
//    }
//    }
    
   // public function cari(){
//        $cek = $this->session->userdata('logged_in');
//        if(!empty($cek)){
//            $cari = $this->input->post('txt_cari');
//            
//            $sess_cari['class']='rf_pmb_laporan_camaba';
//            $sess_cari['keyword']=$cari;
//            $this->session->set_userdata($sess_cari);
//            
//            $this->load->helper('url');
//            redirect(base_url().'index.php/rf_pmb_laporan_camaba');
//        }
//    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='rf_pmb_laporan_camaba';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_laporan_camaba');
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
        $sess_cari['oploaded']='';
        $this->session->set_userdata($sess_cari);
        
		if(!empty($cek)){
            $class=$this->session->userdata('class');
            if($class=='rf_pmb_laporan_camaba'){
                  $cari = $cek = $this->session->userdata('keyword');
                $d['keyword']=$cari;
    			if(empty($cari)){
    				$where = " ";
    			}else{
    				$where = " WHERE ( NRP LIKE '%$cari%' OR Nama_Mhs LIKE '%$cari%' OR Nomer_Tes LIKE '%$cari%' 
                                        OR JK LIKE '%$cari%' OR Kelas LIKE '%$cari%' OR Status_Daftar LIKE '%$cari%' OR Status_Reg LIKE '%$cari%' OR Id_Camaba LIKE '%$cari%')";
    			}
    			
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Laporan Camaba";
    			
    			//paging
    			$page=$this->uri->segment(3);
    			$limit=$this->config->item('limit_data');
    			if(!$page):
    			$offset = 0;
    			else:
    			$offset = $page;
    			endif;
    			
    			$text = "SELECT count(NRP) as halaman FROM tb_pmb_camaba $where ";		
    			$tot_hal = $this->app_model->manualQuery($text);		
                
                foreach($tot_hal->result() as $db){
    			$d['tot_hal'] = $db->halaman;
    			}
                
    			$config['base_url'] = site_url() . '/laporan_camaba/index/';
    			$config['total_rows'] = $d['tot_hal'];
    			$config['per_page'] = $limit;
    			$config['uri_segment'] = 3;
    			$config['next_link'] = 'Lanjut &raquo;';
    			$config['prev_link'] = '&laquo; Kembali';
    			$config['last_link'] = '<b>Terakhir &raquo; </b>';
    			$config['first_link'] = '<b> &laquo; Pertama</b>';
    			$this->pagination->initialize($config);
    			$d["paginator"] =$this->pagination->create_links();
    			$d['hal'] = $offset;
                
                $text = "SELECT
                            Id_Camaba,
                            Nomer_Tes,
                            NRP,
                            Nama_Mhs,
                            JK,
                            Kelas,
                            Agama,
                            Nama_Prop,
	                        Nama_Prodi,
                        	Tlp_HP,
                            Asal_SMU,
                            Nama_Informasi,
                            Status_Daftar,
                        	Status_Reg
                        
                        FROM
                       	(
                            (
                                (
                                    (
                                        (
                        			     tb_pmb_camaba mhs
                        			INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi = prodi.Kode_Prodi
                        		)
                       		   INNER JOIN tb_akd_rf_jenjang jen ON prodi.Jenjang = jen.Kode_Jenjang
                        	)
                       	INNER JOIN tb_peg_rf_agama agm ON mhs.Agama_id = agm.Agama_id 
                    ) 
                    INNER JOIN tb_akd_rf_propinsi prop ON mhs.Kode_Prop = prop.Kode_Prop
                )
                INNER JOIN tb_akd_rf_asal_sekolah sklh ON mhs.Kode_SMU = sklh.Kode_SMU
            )
            INNER JOIN tb_pmb_asal_informasi info ON mhs.Id_Informasi = info.Id_Informasi     
                        
            $where
            ORDER BY
           Id_Camaba ASC,
           	NRP ASC
            LIMIT $limit OFFSET $offset";
                
    			$d['data'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Agama_id, Agama FROM tb_peg_rf_agama";
    			$d['agama'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kd_Pekerjaan, Pekerjaan FROM tb_akd_rf_pekerjaan";
    			$d['pekerjaan'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_SMU, Asal_SMU FROM tb_akd_rf_asal_sekolah";
    			$d['sekolah'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_Prodi, Nama_Prodi FROM tb_akd_rf_prodi";
    			$d['Prodi'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_Prop, Nama_Prop FROM tb_akd_rf_propinsi";
    			$d['provinsi'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Id_Jurusan, Nama_Jurusan FROM tb_pmb_rf_jurusan";
    			$d['jurusan'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Id_Informasi, Nama_Informasi FROM tb_pmb_asal_informasi";
    			$d['informasi'] = $this->app_model->manualQuery($text);
                
    			$d['content'] = $this->load->view('rf/laporan_camaba/view', $d, true);		
    			
                $this->load->view('home',$d);  
            }else
                $this->awal();
		}else{
			header('location:'.base_url());
		}
	}
     
   public function getFileNamaFromURL($fileurl){
       $filename=explode('/',$fileurl);
       $filename=end($filename);
        return $filename;
    }
    
   
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
