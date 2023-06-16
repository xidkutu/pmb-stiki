<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_statistik_informasi1 extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    public function cekFileUploaded(){
        $result['namaUploaded'] = $this->session->userdata('oploaded');
        $result['filename']=base_url().'asset/photo/'.$result['namaUploaded'];
        
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
                        
            $config['upload_path'] = './asset/photo/';
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
                
		 	    $this->load->view('rf/statistik_informasi/upload_success', $d);
    		}
    }
    }
    
    public function cari(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $cari = $this->input->post('txt_cari');
            
            $sess_cari['class']='rf_statistik_informasi';
            $sess_cari['keyword']=$cari;
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_statistik_informasi');
        }
    }
    
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='rf_statistik_informasi';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_statistik_informasi');
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
        
		if(!empty($cek)){
            $class=$this->session->userdata('class');
            if($class=='rf_statistik_informasi'){
       			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="statistik asal informasi";
    			
    			//paging            
    			$d['content'] = $this->load->view('rf/statistik_informasi/view', $d, true);		
    			
                $text="SELECT Nama_Informasi,COUNT(NRP) as n FROM tb_pmb_asal_informasi info LEFT JOIN tb_pmb_camaba maba ON info.Id_Informasi=maba.Id_Informasi GROUP BY info.Id_Informasi";
                $res=$this->db->query($text);
                $legend=array();
                $n=array();
                
                foreach($res->result() as $t){
                    $legend[]=$t->Nama_Informasi;
                    $n[]=$t->n;
                };
                
                $this->graph->set_data( $n );
                    $this->graph->bar_glass( 55, '#FF9900', '#C31812', ' IP', 11  );
                    
		            $this->graph->set_data( $n );
                    $this->graph->bar_glass( 55, '#fff', '#fff', ' IPK', 11  );
                    
                    $this->graph->set_x_labels( $legend );
                    
            		$this->graph->set_y_max( 100 );
            		$this->graph->width=420;
            		$this->graph->height=800;
            		$this->graph->y_label_steps( 30 );
            		$this->graph->bg_colour='#d7ebf9';
            		$this->graph->set_x_legend( 'STATISTIK IPK', 14, '#736AFF' );
            		
            		$this->graph->set_output_type("js");
                $this->load->view('home',$d);  
            }else
                $this->awal();
		}else{
			header('location:'.base_url());
		}
	}
    
   
    //public function detail()
//	{
//		$cek = $this->session->userdata('logged_in');
//		if(!empty($cek)){
//			
//			$idReg = $this->input->post('Id_Reg');  //$this->uri->segment(3);
//			
//             
//            $text = "SELECT
//                            Id_Reg,
//                            Nama,
//                            Alamat,
//                            Email,
//                            HP,
//                            Username,
//                            Password,
//                            URL_File,
//                            Nama_Pemilik_Rek,
//	                        status,
//                            Jumlah,
//                        	Tanggal,
//                            Tipe_Pembayaran,
//                            Bank_Tujuan,
//                            Nama_Bank,
//                            Bank_Asal,
//                        	No_Rekening,
//                            Atas_Nama
//                    FROM
//                     
//		                  tb_pmb_registrasi
//		                                       
//                    WHERE Id_Reg='$idReg'"; 
//                    
//			$data = $this->app_model->manualQuery($text);
//                foreach($data->result() as $db){
//                    $d['Id_Reg']=$db->Id_Reg;
//                    $d['Nama']=$db->Nama;
//                    //$d['Alamat']=$db->Email;  
//                    //$d['Email']=$db->Email;                    
//                    //$d['HP']=$db->HP;
//                    //$d['Username']=$db->Username;
//                    //$d['Password']=$db->Password;
//                    $d['URL_File']=$db->URL_File;
//                    $d['Nama_Pemilik_Rek']=$db->Nama_Pemilik_Rek;
//                    $d['status']=$db->status;
//                    $d['Jumlah']=$db->Jumlah;
//                    $d['Tanggal']=$db->Tanggal;
//                    $d['Tipe_Pembayaran']=$db->Tipe_Pembayaran;
//                    $d['Bank_Tujuan']=$db->Bank_Tujuan;
//                    $d['Nama_Bank']=$db->Nama_Bank;
//                    $d['Bank_Asal']=$db->Bank_Asal;
//                    $d['No_Rekening']=$db->No_Rekening;
//                    $d['Atas_Nama']=$db->Atas_Nama;                                       
//                    
//                }       
//                echo json_encode($d);
//	         }else{
//			$d['signout']='YES';
//            echo json_encode($d);
//		}
//          }
    
    
    
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
                'status' =>  $this->input->post('status'),
                //'Nama' =>  $this->input->post('Nama'),
//                'Alamat' =>  $this->input->post('Alamat'),
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
            echo 'Ubah data Sukses';    
		}else{
				header('location:'.base_url());
		}
	
	}
     public function getDataToCetak(){
        $cek = $this->session->userdata('logged_in');
        $sess_cari['oploaded']='';
        $this->session->set_userdata($sess_cari);
        
		if(!empty($cek)){
            $class=$this->session->userdata('class');
            if($class=='rf_statistik_informasi'){
                  $cari = $cek = $this->session->userdata('keyword');
                $d['keyword']=$cari;
    			if(empty($cari)){
    				$where = " ";
    			}else{
    				$where = " WHERE ( Id_Reg LIKE '%$cari%' OR Nama LIKE '%$cari')";
    			}
    			
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="statistik informasi";
                
         
                $text = "SELECT
                    Kode_Reg,
                	Nama,
                	Alamat,
                	Email,
                	HP,
                	Status
                
                FROM
                	tb_pmb_registrasi
                
                $where";
                
                //echo $text;
    	$data = $this->app_model->manualQuery($text);
        
        $result_laporan='';
            
        if ($data->num_rows()>0){
            foreach($data->result() as $i=>$db){
                $result_laporan=$result_laporan."<tr class='cetak_data'>
                <td align='center' >".($i+1)."</td>
                <td align='center' >".$db->Kode_Reg."</td>
                <td align='center' >".$db->Nama."</td>
                <td align='center' >".$db->Alamat."</td>
                <td align='center' >".$db->Email."</td>
                <td align='center' >".$db->HP."</td>
                <td align='center' >".$db->Status."</td>
                
                
                </tr>";
			}
        }else
        {
            $result_laporan="<tr bgcolor='#fff' class='cetak_data'><td colspan=10 align='center'> Tidak ada data </td> ";
        }
            $d['cetak_laporan']=$result_laporan;
            
            echo json_encode($d);
    }
        


    
    }
    }
    }

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
