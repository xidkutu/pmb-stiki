<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_validasi extends CI_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman validasi
	 **/
	
    public function cekFileUploaded(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/berkas/'.$result['namaUploaded'];
        
        echo json_encode($result);
    }
    
    public function showUploader(){
        $this->load->view('rf/camaba/uploader');
    }
    
    public function saveFile(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            /** Inserting Data Program Studi **/
            $this->load->library('upload');
                        
            $config['upload_path'] = './asset/berkas/';
    		$config['allowed_types'] = '7zip|zip|rar|bmp|jpg|png';
    		$config['max_size']	= '0';
            $config['file_name']= $file = md5($this->today()).'_'.$_FILES['userfile']['name'];
            $config['remove_spaces']='true';
            $d['nama_file']=$_FILES['userfile']['name'];
            $this->upload->initialize($config);
                      
    		if ( ! $this->upload->do_upload())
    		{
    			$error = array('error' => $this->upload->display_errors('',''));
                $d['pesan']=$error['error'].'asdasdada';
		 	    
                $sess_file['oploaded']='';
                $this->session->set_userdata($sess_file);
                
                $this->load->view('rf/validasi/upload_success', $d);
    		}
    		else
    		{   
                $data=$this->upload->data();
                $d['pesan']='success';
                $sess_file['oploaded']=$data['file_name'];
                $this->session->set_userdata($sess_file);
                
		 	    $this->load->view('rf/validasi/upload_success', $d);
    		}
    }
    }
    
    public function cari(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $cari = $this->input->post('txt_cari');
            
            $sess_cari['class']='rf_pmb_validasi';
            $sess_cari['keyword']=$cari;
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_validasi');
        }
    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='rf_pmb_validasi';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_validasi');
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
            if($class=='rf_pmb_validasi'){
                  $cari = $cek = $this->session->userdata('keyword');
                $d['keyword']=$cari;
    			if(empty($cari)){
    				$where = " ";
    			}else{
    				$where = " WHERE ( Id_Reg LIKE '%$cari%' OR Nama LIKE '%$cari%')";
    			}
    			
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Validasi Pembayaran";
    			
    			//paging
    			$page=$this->uri->segment(3);
    			$limit=$this->config->item('limit_data');
    			if(!$page):
    			$offset = 0;
    			else:
    			$offset = $page;
    			endif;
    			
    			$text = "SELECT count(Id_Reg) as halaman FROM tb_pmb_registrasi $where ";		
    			$tot_hal = $this->app_model->manualQuery($text);		
                
                foreach($tot_hal->result() as $db){
    			$d['tot_hal'] = $db->halaman;
    			}
                
    			$config['base_url'] = site_url() . '/rf_pmb_validasi/index/';
    			$config['total_rows'] = $d['tot_hal'];
    			$config['per_page'] = $limit;
    			$config['uri_segment'] = 3;
    			$config['next_link'] = 'Lanjut &raquo;';
    			$config['prev_link'] = '&laquo; Kembali';
    			$config['last_link'] = '<b>Terakhir &raquo; </b>';
    			$config['first_link'] = '<b> &laquo; Pertama</b>';
                $config['full_tag_open'] = "<ul class='pagination'>";
                $config['full_tag_close'] ="</ul>";
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
                $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
                $config['next_tag_open'] = "<li>";
                $config['next_tagl_close'] = "</li>";
                $config['prev_tag_open'] = "<li>";
                $config['prev_tagl_close'] = "</li>";
                $config['first_tag_open'] = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open'] = "<li>";
                $config['last_tagl_close'] = "</li>";
    			$this->pagination->initialize($config);
    			$d["paginator"] =$this->pagination->create_links();
    			$d['hal'] = $offset;
                
                $text = "SELECT
                            Id_Reg,
                            Kode_Reg,
                            Nama,
                            Alamat,
                            Email,
                            HP,
                            Uname,
                            Pwd,
                            status,
                            Jumlah,
                        	Tanggal,
                            Tipe_Pembayaran,
                            Bank_Tujuan,
                            Nama_Bank,
                            Bank_Asal,
                        	No_Rekening,
                            Atas_Nama
                        
                        FROM
                            tb_pmb_registrasi
                       	
                            $where
                            ORDER BY
                            Tanggal DESC,
                            Id_Reg ASC
           	                
                            LIMIT $limit OFFSET $offset";
                
    			$d['data'] = $this->app_model->manualQuery($text);
                
                $d['page_title']='Konfirmasi Pembayaran';
                $d['sub_page_title']='Welcome User';
                
                //Generate menu dari database;
                $d['breadcrumb']=generateBreadcrumb('SIMARU_Transaksi_Bayar');
                
                //Toogle manu yang sedang aktif
                $activeMenu=array(
                        0 => 'SIMARU_Transaksi',
                        1 => 'SIMARU_Transaksi_Bayar',
                    );
                $collapseMenu=array(
                    0 => 'SIMARU_Transaksi'
                    );
                $collapseSubMenu=array();
                $d['active_menu']=$activeMenu;
                $d['collapseMenu']=$collapseMenu;
                $d['collapseSubMenu']=$collapseSubMenu;
                
                //Load view
                $d['header']=$this->load->view('required/header',$d,true);
                $d['sidebar_menu']=$this->load->view('required/menu_sidebar',$d,true);
                $d['content']=$this->load->view('rf/validasi/view',$d,true);
                $this->load->view('main_page',$d); 
            }else
                $this->awal();
		}else{
			header('location:'.base_url());
		}
	}
    
   
    public function detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$idReg = $this->input->post('Id_Reg');  //$this->uri->segment(3);
			
             
            $text = "SELECT
                            Id_Reg,
                            Kode_Reg,
                            Nama,
                            Alamat,
                            Email,
                            HP,
                            Uname,
                            Pwd,
	                        status,
                            Jumlah,
                        	Tanggal,
                            Tipe_Pembayaran,
                            Bank_Tujuan,
                            Nama_Bank,
                            Bank_Asal,
                        	No_Rekening,
                            URL_File,
                            Atas_Nama
                    FROM
                     
		                  tb_pmb_registrasi
		                                       
                    WHERE Id_Reg='$idReg'"; 
                    
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['Kode_Reg']=$db->Kode_Reg;
                    $d['Nama']=$db->Nama;
                    //$d['Alamat']=$db->Email;  
                    //$d['Email']=$db->Email;                    
                    //$d['HP']=$db->HP;
                    //$d['Username']=$db->Username;
                    //$d['Password']=$db->Password;
                    $d['URL_File']=$db->URL_File;
                    //$d['Nama_Pemilik_Rek']=$db->Nama_Pemilik_Rek;
                    $d['status']=$db->status;
                    $d['Jumlah']=$db->Jumlah;
                    $d['Tanggal']=$db->Tanggal;
                    $d['Tipe_Pembayaran']=$db->Tipe_Pembayaran;
                    $d['Bank_Tujuan']=$db->Bank_Tujuan;
                    $d['Nama_Bank']=$db->Nama_Bank;
                    $d['Bank_Asal']=$db->Bank_Asal;
                    $d['No_Rekening']=$db->No_Rekening;
                    $d['Atas_Nama']=$db->Atas_Nama;                                       
                    
                }       
                echo json_encode($d);
	         }else{
			$d['signout']='YES';
            echo json_encode($d);
		}
          }
    
    
    
    public function getFileNamaFromURL($fileurl){
        $filename=explode('/',$fileurl);
        $filename=end($filename);
        return $filename;
    }
    
    public function simpanEdit()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

            $originalDate = $this->input->post('tanggal');
            $tanggal = date("Y-m-d", strtotime($originalDate)); 
            
            $namaFile=$this->input->post('urlFoto');
                        
            /** Updating Data **/
            $databaru = array(
                'Id_Reg' =>  $this->input->post('Id_Reg'),
                'status' =>  'Sudah',
                'uname' =>  $this->app_model->getKodeReg($this->input->post('Id_Reg')),
                'pwd' =>  $this->app_model->getRandomPassword(),
//                'Alamat' =>  $this->input->post('Ala'mat'),
//                'Email' =>  $this->input->post('Email'),
//                'Username' =>  $this->input->post('Username'),
//                'Password' =>  $this->input->post('Password'),
//                'URL_File' =>  $this->input->post('URL_File'),
//                'Nama_Pemilik_Rek' =>  $this->input->post('Nama_Pemilik_Rek'),
                
//                 'Jumlah' =>  $this->input->post('Jumlah'),
//                               
//                'Tanggal' =>  $tanggal,
//                'Tipe_Pembayaran' =>  $this->input->post('Tipe_Pembayaran'),
//                'Bank_Tujuan' =>  $this->input->post('Bank_Tujuan'),
//                'Bank_Asal' =>  $this->input->post('Bank_Asal'),
//                'No_Rekening' =>  $this->input->post('No_Rekening'),
//                'Atas_Nama' =>  $this->input->post('Atas_Nama'),
//                'Nama_Bank' =>  $this->input->post('Nama_Bank'),
                'Modified_by' => $this->session->userdata('username'),
                'Modified_date' => $this->today(),
            );
            
            $simpan = $this->input->post('saveas');
            $key['Id_Reg']=$this->input->post('Id_Reg');
            
                
			if($simpan == 'edit'){
                $this->app_model->updateData("tb_pmb_registrasi",$databaru,$key);		
			}                
            echo 'Validasi data berhasil';    
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
