<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rf_pmb_status extends CI_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman transfer data
	 **/
	
    public function awal(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_cari['class']='rf_pmb_status';
            $sess_cari['keyword']='';
            $this->session->set_userdata($sess_cari);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/rf_pmb_status');
        }
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
            if($class=='rf_pmb_status'){
                //echo $cekRole;
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Ubah Status Camaba";    		
                
                $dari=$this->input->post('form_dari');
                $sampai=$this->input->post('form_sampai');
                
                $d['dari_sel']=$dari;
                $d['sampai_sel']=$sampai;
                
                $text = "SELECT 
                    Id_Camaba,
                    Nama_Mhs,
                    NRP,
                    Kode_Prodi, 
                    Kelas,
                    Status_Reg,
                    Status_Camaba
                 FROM 
                    tb_pmb_camaba 
                 Where Id_Camaba<='$sampai' AND Id_Camaba>='$dari' AND Status_Camaba ='No'";
            
                
    			$d['data'] = $this->app_model->manualQuery($text);
                
    			$d['content'] = $this->load->view('rf/status/view', $d, true);		
    			
                $this->load->view('home',$d);  
            }else
                $this->awal();
		} else
        {
			header('location:'.base_url());
		}
	}
    
    public function simpan(){
       $selected=$this->input->post('selected');
 
       $selected=substr($selected,1,strlen($selected));

       $text="INSERT INTO tb_akd_rf_mahasiswa
                SELECT NRP,Kode_Prodi,Kelas,Tgl_Masuk,Tahun_Masuk, Semester_Masuk, Status_Masuk, Batas_Studi,
                Nama_Mhs, Alamat, Kota, Alamat_asl,Kota_asl, JK, Tempat_Lahir, Tgl_Lahir,Agama_id,NULL as Dosen_Wali, URL_Foto, 'A' AS Status_Akademis,NULL as NRP_lama,NULL as Tgl_Lulus, NULL as No_ijazah,
                NULL as Kode_AmbilTA, Telp, Tlp_HP, Email, Kode_SMU, Nama_Ayah, No_KTP_Ayah, Nama_Ibu, No_KTP_Ibu, Alamat_Ortu, Kota_Ortu,Kd_Pekerjaan_Ayah,Kd_Pekerjaan_Ibu,
                Telp_Ortu, Telp_HP_Ortu, Nama_Wali, No_KTP_Wali, Alamat_Wali, Kota_Wali, Kd_Pekerjaan_Wali, Telp_Wali, Telp_HP_Wali, Kd_pekerjaan_mhs, Nama_Kantor,
                Alamat_Kantor, Telp_Kantor, 'YES' as Is_CardAktif,'SIMARU' as Created_App,'' as Created_By,NOW() as Created_Date,NULL AS Modified_App,NULL as Modified_By, NULL as Modified_Date  FROM tb_pmb_camaba WHERE Id_Camaba IN ($selected)";
        $this->db->query($text);  
        
        $text="UPDATE tb_pmb_camaba SET Status_Camaba='YES' WHERE id_camaba IN ($selected)";
        $this->db->query($text);
          
        echo 'Transfer data berhasil';              
    }
 
 }

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
