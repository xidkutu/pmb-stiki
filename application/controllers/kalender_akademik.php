<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kalender_akademik extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
    
    //function untuk memeriksa ijin dari user yang login terhadap class dan function
    //setiap function harus terlebih dahulu dilakukan pemeriksaan sebelum dikerjakan
    //perijinan terhadap class dan function ini diatur dalam database
    
    public function isPermited($namaClass,$namaFunction){
        $classFunction=$this->session->userdata('class_function');
        if(in_array(array('Class_Name'=>$namaClass,'FunctionName'=>$namaFunction),$classFunction)) $result='YES'; else $result='NO'; 
        return $result;
    }
     
    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
    
    public function getEnumFieldValues($table,$field){
        if($this->isPermited('Kalender_akademik','getEnumFieldValues')=='YES'){
            $text = "SHOW COLUMNS FROM $table WHERE FIELD='$field'";
            $res=$this->app_model->manualQuery($text);
            $result=$res->result_array();
            $hasil='';
            if (count($result)!=0){
                $hasil = $result[0]['Type'];   
            }
            return $hasil;
        }
    }
        
	public function cari(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            if($this->isPermited('Kalender_akademik','cari')=='YES'){
                $cari = $this->input->post('txt_cari');
                
                $sess_cari['class']='kalender_akademik';
                $sess_cari['keyword']=$cari;
                $this->session->set_userdata($sess_cari);
                
                $this->load->helper('url');
                redirect(base_url().'index.php/kalender_akademik');
            }else redirect(base_url().'index.php');
        }
    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            if($this->isPermited('Kalender_akademik','awal')=='YES'){
                $sess_cari['class']='kalender_akademik';
                $sess_cari['keyword']='';
                $this->session->set_userdata($sess_cari);
                
                $this->load->helper('url');
                redirect(base_url().'index.php/kalender_akademik');
            }else
                redirect(base_url().'index.php');
        }
    }
    
    public function getDataFromDB($table,$id,$idField,$resultField){
        if($this->isPermited('Kalender_akademik','getDataFromDB')=='YES'){
            $temp = $this->app_model->getDataFromDB($table,$id,$idField,$resultField);
            $result=$temp->result_array();
            $hasil='';
            if (count($result)!=0){
                $hasil = $result[0][$resultField];   
            }
            return $hasil;
        }
    }
    
    public function getDataFromDBJson(){
        if($this->isPermited('Kalender_akademik','getDataFromDBJson')=='YES'){
            $id = $this->input->post('id');
            $idField = $this->input->post('idField');
            $resultField =$this->input->post('resultField');
            $table = $this->input->post('table');
            
            $result['result'] = $this->getDataFromDB($table,$id,$idField,$resultField);
            
            echo json_encode($result);
        }
    }
    
    public function cekFileUploaded(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            if($this->isPermited('Kalender_akademik','cekFileUploaded')=='YES'){
                $result['namaUploaded'] = $this->session->userdata('oploaded');
                
                echo json_encode($result);
                }else{
                    $d['signout']='YES';
                    echo json_encode($d);
                }
        }
    }
    
    public function today(){
        if($this->isPermited('Kalender_akademik','today')=='YES'){
            $temp = $this->app_model->getToday();
            $result = $temp->result_array();
            
            $today='';
            if (count($result)!=0){
                $today = $result[0]['today'];   
            }
            return $today;
        }
    }
    
	public function index(){
        $cek = $this->session->userdata('logged_in');
        $sess_cari['oploaded']='';
        $this->session->set_userdata($sess_cari);
        
		if(!empty($cek)){
		   if($this->isPermited('Kalender_akademik','index')=='YES'){
                $class=$this->session->userdata('class');
                if($class=='kalender_akademik'){
        			$cari=$this->session->userdata('keyword');
                    $d['keyword']=$cari;
        			if(empty($cari)){
        				$where = ' ';
        			}else{
        				$where = " WHERE (Tahun ='$cari' OR Periode_Sem LIKE '%$cari%')";
        			}
        			
                    //echo $cekRole;
        			$d['prg']= $this->config->item('prg');
        			$d['web_prg']= $this->config->item('web_prg');
        			
        			$d['nama_program']= $this->config->item('nama_program');
        			$d['instansi']= $this->config->item('instansi');
        			$d['usaha']= $this->config->item('usaha');
        			$d['alamat_instansi']= $this->config->item('alamat_instansi');
        
        			
        			$d['judul']="Kalender Akademik";
        			
        			//paging
        			$page=$this->uri->segment(3);
        			$limit=$this->config->item('limit_data');
        			if(!$page):
        			$offset = 0;
        			else:
        			$offset = $page;
        			endif;
        			
        			$text = "SELECT count(URL_Kalender_Akd) as halaman FROM tb_akd_rf_kalender_akd
                     $where ";		
        			$tot_hal = $this->app_model->manualQuery($text);		
        			
                    foreach($tot_hal->result() as $db){
        			$d['tot_hal'] = $db->halaman;
        			}
        			
        			$config['base_url'] = site_url() . '/kalender_akademik/index/';
        			$config['total_rows'] = $db->halaman;
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
                            	Tahun,
                            	Periode_Sem,
                            	URL_Kalender_Akd,
                                Keterangan
                            FROM
                            	tb_akd_rf_kalender_akd
                        $where
        					LIMIT $limit OFFSET $offset";
                    
        			$d['data'] = $this->app_model->manualQuery($text);
                    $d['periode_sem']=$this->getEnumFieldValues('tb_akd_rf_kalender_akd','periode_sem');
                    
        			$d['content'] = $this->load->view('rf/kalender_akademik/view', $d, true);		
        			//log_message('error', print_r($d, TRUE));
                    $this->load->view('home',$d);
                    }else
                   $this->awal();
                }else{
			         header('location:'.base_url());
		          } 
    		}else{
    			header('location:'.base_url());
    		}
	}
    
    public function detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			if($this->isPermited('Kalender_akademik','detail')=='YES'){
    			$tahun = $this->input->post('tahun');
                $periodeSem = $this->input->post('periodeSem');
    
                $text = "SELECT URL_Kalender_Akd FROM tb_akd_rf_kalender_akd
                    WHERE Tahun='$tahun' AND Periode_Sem='$periodeSem'"; 
                        
    			$data = $this->app_model->manualQuery($text);
                    foreach($data->result() as $db){
                        $d['URL_Kalender_Akd']=$db->URL_Kalender_Akd;
                        $d['filename']=$this->getFileNamaFromURL($db->URL_Kalender_Akd);
    				} 
                echo json_encode($d);
            }
		  else{
			$d['signout']='YES';
            echo json_encode($d);
		  }
		}else{
			$d['signout']='YES';
            echo json_encode($d);
		}
	}
    
    public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
            if($this->isPermited('Kalender_akademik','edit')=='YES'){
                $id = $this->input->post('id');
                $text = "SELECT Kode_Jenjang, Nama_Jenjang FROM tb_akd_rf_jenjang WHERE Kode_Jenjang='$id'";
    			$data = $this->app_model->manualQuery($text);
                    foreach($data->result() as $db){
                        $d['Kode_Jenjang']=$db->Kode_Jenjang;
                        $d['Nama_Jenjang']=$db->Nama_Jenjang;
    				}
                    echo json_encode($d);
            }
		}else{
			
		}
	}
    
    public function showUploader(){
        if($this->isPermited('Kalender_akademik','showUploader')=='YES'){
            $this->load->view('rf/kalender_akademik/uploader');
        }
    }
    
    public function saveFile(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		  if($this->isPermited('Kalender_akademik','saveFile')=='YES'){
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/documents/';
    		$config['allowed_types'] = 'pdf';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'];
		 	    
                $sess_file['oploaded']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('rf/kalender_akademik/upload_success', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('rf/kalender_akademik/upload_success', $d);
    		}
        }
    }
    }
    
    public function getFileNamaFromURL($fileurl){
        if($this->isPermited('Kalender_akademik','getFileNamaFromURL')=='YES'){
            $filename=explode('/',$fileurl);
            $filename=end($filename);
            return $filename;
        }
    }
    
    public function simpan()
	{
	   $cek = $this->session->userdata('logged_in');
	   if(!empty($cek)){
	       if($this->isPermited('Kalender_akademik','simpan')=='YES'){
                $tahun=$this->input->post('tahun');
                $periodeSem=$this->input->post('periodeSem');
                $filename=base_url().'asset/documents/'.$this->input->post('filename');
                $keterangan=$this->input->post('keterangan');
                
                $id['Tahun']=$tahun;
                $id['Periode_Sem']=$periodeSem;
                
                $data = $this->app_model->getSelectedData("tb_akd_rf_kalender_akd",$id);
                            
                if($data->num_rows()==0){
                    $databaru = array(
                        'Tahun' => $tahun,
                        'Periode_Sem' =>  $periodeSem,
                        'URL_Kalender_Akd' =>  $filename,
                        'Keterangan'=>$keterangan,
                        'Created_by' => $this->session->userdata('username'),
                        'Created_date' => $this->today(),
                    );
    
                    $simpan = $this->input->post('saveas');
                    
    				if($simpan == 'baru'){
                        $this->app_model->insertData("tb_akd_rf_kalender_akd",$databaru);		
    				}                
                    echo 'Simpan data Sukses';
                }else
                    {echo 'GAGAL : Terdapat data dengan kode yang sama !';}
            }            
		}else{
				echo 'signout';
		}
	}
    
    public function simpanEdit()
	{
    	$cek = $this->session->userdata('logged_in');
    	if(!empty($cek)){
    	   if($this->isPermited('Kalender_akademik','simpanEdit')=='YES'){
                $tahun=$this->input->post('tahun');
                $periodeSem=$this->input->post('periodeSem');
                $keterangan=$this->input->post('keterangan');
                
                $namaFile=base_url().'asset/documents/'.$this->input->post('filename');
                
                $databaru = array(
                    'URL_Kalender_Akd' =>$namaFile,
                    'Keterangan'=>$keterangan,
                    'Modified_by' => $this->session->userdata('username'),
                    'Modified_date' => $this->today(),
                );
        
                $simpan = $this->input->post('saveas');
                $id['Tahun']=$tahun;
                $id['Periode_Sem']=$periodeSem;
                
                //echo print_r($databaru);
        //            echo'<br /><br />';
        //            echo print_r($id);
        		if($simpan == 'edit'){
                    $this->app_model->updateData("tb_akd_rf_kalender_akd",$databaru,$id);		
        		}                
                echo 'Ubah data Sukses';
            }else{
    			echo 'signout';
    	   }    
    	}else{
    			echo 'signout';
    	}
	}
    
    public function hapus()
	{
	   $cek = $this->session->userdata('logged_in');
	   if(!empty($cek)){
	           if($this->isPermited('Kalender_akademik','hapus')=='YES'){
                    $this->db->trans_begin();
                    $tahun=$this->input->post('tahun');
                    $periodeSem=$this->input->post('periodeSem');
                      
                    $key = array(
                        'Tahun' => $tahun,
                        'Periode_Sem' =>  $periodeSem,
                    );
                    $this->db->delete('tb_akd_rf_kalender_akd',$key);
                    if ($this->db->trans_status() === FALSE)
                        {
                            $this->db->trans_rollback();
                        }
                    else
                        {
                            $this->db->trans_commit();
                            echo 'Hapus data Sukses';    
                        }
            }else{
				echo 'signout';
		  }            
		}else{
				echo 'signout';
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */