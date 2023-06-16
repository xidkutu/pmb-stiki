<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lp_pmb_camaba extends CI_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk halaman laporan camaba
	 **/
    public function filterData(){
        $cek = $this->session->userdata('logged_in');
            
            $nrp = $this->input->post('nrp');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $kelas = $this->input->post('kelas');
            $agama = $this->input->post('agama');
            $tahun = $this->input->post('tahun');
            $provinsi = $this->input->post('provinsi');
            $prodi = $this->input->post('prodi');
            $smu = $this->input->post('smu');
            $informasi = $this->input->post('informasi');
            $statusDaftar = $this->input->post('statusDaftar');                        
            $statusReg = $this->input->post('statusReg');
            $tglMasuk = $this->input->post('tglMasuk'); 
            $tglMasuk2 = $this->input->post('tglMasuk2');   
                                            
            $sess_filter['class']='lp_pmb_camaba';
            $sess_filter['nrp']=$nrp;
            $sess_filter['nama']=$nama;
            $sess_filter['jk']=$jk;
            $sess_filter['kelas']=$kelas;
            $sess_filter['agama']=$agama;
            $sess_filter['tahun']=$tahun;
            $sess_filter['provinsi']=$provinsi;
            $sess_filter['prodi']=$prodi;
            $sess_filter['smu']=$smu;
            $sess_filter['informasi']=$informasi;
            $sess_filter['statusDaftar']=$statusDaftar;
            $sess_filter['statusReg']=$statusReg;
            $sess_filter['tglMasuk']=$tglMasuk;
            $sess_filter['tglMasuk2']=$tglMasuk2;
            
//            $sess_filter['comparison_sks_sekarang']=$comparison_sks_sekarang;
//            $sess_filter['sks_sekarang']=$sks_sekarang;
//            $sess_filter['comparison_sks_total']=$comparison_sks_total;
//            $sess_filter['sks_total']=$sks_total;
            $this->session->set_userdata($sess_filter);
            
            //print_r($sess_filter);
            $d['Status']='OK';
            echo json_encode($d);
            
        }
    
    public function noFilter(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            
            $sess_filter['class']='lp_pmb_camaba';
            $sess_filter['nrp']='';
            $sess_filter['nama']='';
            $sess_filter['jk']='';
            $sess_filter['kelas']='';
            $sess_filter['agama']='';
            $sess_filter['tahun']='';
            $sess_filter['provinsi']='';
            $sess_filter['prodi']='';
            $sess_filter['smu']='';
            $sess_filter['informasi']='';
            $sess_filter['statusDaftar']='';
            $sess_filter['statusReg']='';
            $sess_filter['tglMasuk']=''; 
            $sess_filter['tglMasuk2']=''; 
                       
            $this->session->set_userdata($sess_filter);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/lp_pmb_camaba');
        }
    }
    
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
        
		if(!empty($cek)){
			$class=$this->session->userdata('class');
            if($class=='lp_pmb_camaba'){

                $nrp = $this->session->userdata('nrp');
                $nama = $this->session->userdata('nama');
                $jk = $this->session->userdata('jk');
                $kelas = $this->session->userdata('kelas');
                $agama = $this->session->userdata('agama');
                $tahun = $this->session->userdata('tahun');
                $provinsi = $this->session->userdata('provinsi');
                $prodi = $this->session->userdata('prodi');
                $smu = $this->session->userdata('smu');
                $informasi = $this->session->userdata('informasi');
                $statusDaftar = $this->session->userdata('statusDaftar');
                $statusReg = $this->session->userdata('statusReg');
                $tglMasuk = $this->session->userdata('tglMasuk');
                $tglMasuk2 = $this->session->userdata('tglMasuk2');
                               
                $d['nrp']=$nrp;
                $d['nama']=$nama;
                $d['jk']=$jk;
                $d['kelas']=$kelas;
                $d['selected_agama']=$agama;
                $d['tahun']=$tahun;
                $d['selected_provinsi']=$provinsi;
                $d['selected_prodi']=$prodi;
                $d['selected_smu']=$smu;
                $d['selected_informasi']=$informasi;
                $d['statusDaftar']=$statusDaftar;
                $d['statusReg']=$statusReg;
                $d['tglMasuk']=$tglMasuk;
                $d['tglMasuk2']=$tglMasuk2;
                
                //print_r($d);
                $where="WHERE Id_Camaba IS NOT NULL";
                if($nrp!='') $where .= (" AND NRP LIKE '%$nrp%'");
                if($nama!='') $where .= (" AND Nama_Mhs LIKE '%$nama%'");
                if($jk!='0' && $jk!='' ) $where .= (" AND JK='$jk'");
                if($kelas!='0' && $kelas!='' ) $where .= (" AND Kelas='$kelas'");
                if($agama!='0' && $agama!='') $where .= (" AND mhs.Agama_id = '$agama'");
                if($tahun!='') $where .= (" AND Tahun_Masuk LIKE '%$tahun%'");
                if($provinsi!='0' && $provinsi!='') $where .= (" AND mhs.Kode_Prop ='$provinsi'");
                if($prodi!='0' && $prodi!='') $where .= (" AND mhs.Kode_Prodi ='$prodi'");
                if($smu!='0' && $smu!='') $where .= (" AND mhs.Kode_SMU ='$smu'");
                if($informasi!='0' && $informasi!='') $where .= (" AND mhs.Id_Informasi ='$informasi'");
                if($statusDaftar!='0' && $statusDaftar!='') $where .= (" AND Status_Daftar ='$statusDaftar'");
                if($statusReg!='0' && $statusReg!='') $where .= (" AND Status_Reg ='$statusReg'");
                
                if($tglMasuk!=''){
                  $tglMasuk = date("Y-m-d", strtotime($tglMasuk));
                  $where .= (" AND DATE_FORMAT(Tgl_Masuk ,'%Y-%m-%d') >= DATE_FORMAT('$tglMasuk','%Y-%m-%d')");  
                } 
                if($tglMasuk2!=''){
                  $tglMasuk2 = date("Y-m-d", strtotime($tglMasuk2));
                  $where .= (" AND DATE_FORMAT(Tgl_Masuk ,'%Y-%m-%d')<=DATE_FORMAT('$tglMasuk2','%Y-%m-%d')");  
                } 
                
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
    			
    			$text = "SELECT
                            COUNT(Id_Camaba) AS Num_Row
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
                $where            ";
                //echo $text;   		
    			$tot_hal = $this->app_model->manualQuery($text);
                $numRow = $tot_hal->result_array();		
    			
    			$d['tot_hal'] = $numRow[0]['Num_Row'];
    			
    			$config['base_url'] = site_url() . '/lp_pmb_camaba/index/';
    			$config['total_rows'] = $numRow[0]['Num_Row'];
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
                                
                                NRP,
                                Nama_Mhs,
                                JK,
                                Kelas,
                                Agama,
                                Nama_Prop,
    	                        Nama_Prodi,
                            	Tahun_Masuk,
                                Asal_SMU,
                                Nama_Informasi,
                                Status_Daftar,
                            	Status_Reg,
                                Tgl_Masuk
                            
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
                //echo $text;
    			$d['data'] = $this->app_model->manualQuery($text);
                
                $queryProdi="SELECT DISTINCT(Nama_Prodi) FROM tb_akd_rf_prodi";
                $d['prodi']=$this->app_model->manualQuery($queryProdi);
//                
                $text = "SELECT Agama_id,Agama FROM tb_peg_rf_agama ORDER BY Agama";
    			$d['agama'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_Prop, Nama_Prop FROM tb_akd_rf_propinsi ORDER BY Nama_Prop";
    			$d['provinsi'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_Prodi, Nama_Prodi FROM tb_akd_rf_prodi ORDER BY Nama_Prodi";
    			$d['prodi'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_SMU, Asal_SMU FROM tb_akd_rf_asal_sekolah ORDER BY Asal_SMU";
    			$d['SMU'] = $this->app_model->manualQuery($text);
                
                 $text = "SELECT Id_Informasi, Nama_Informasi FROM tb_pmb_asal_informasi ORDER BY Nama_Informasi";
    			$d['asalInformasi'] = $this->app_model->manualQuery($text);
                
                //Parse variable
                $d['page_title']='Calon Mahasiswa';
                $d['sub_page_title']='Welcome User';
                
                //Generate menu dari database;
                $d['breadcrumb']=generateBreadcrumb('SIMARU_Laporan_Camaba');
                
                //Toogle manu yang sedang aktif
                $activeMenu=array(
                        0 => 'SIMARU_Laporan',
                        1 => 'SIMARU_Laporan_Camaba',
                    );
                $collapseMenu=array(
                    0 => 'SIMARU_Laporan'
                    );
                $collapseSubMenu=array();
                $d['active_menu']=$activeMenu;
                $d['collapseMenu']=$collapseMenu;
                $d['collapseSubMenu']=$collapseSubMenu;
                
                //Load view
                $d['header']=$this->load->view('required/header',$d,true);
                $d['sidebar_menu']=$this->load->view('required/menu_sidebar',$d,true);
                $d['content']=$this->load->view('lp/pmb_camaba/view',$d,true);
                $this->load->view('main_page',$d);
                }else
                $this->noFilter();
		}else{
			header('location:'.base_url());
		}
	}
    
    public function getEnumFieldValues($table,$field){
        $text = "SHOW COLUMNS FROM $table WHERE FIELD='$field'";
        $res=$this->app_model->manualQuery($text);
        $result=$res->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0]['Type'];   
        }
        return $hasil;
    }
    
//   	public function detail()
//	{
//		$cek = $this->session->userdata('logged_in');
//		if(!empty($cek)){
//			
//			$nrp = $this->input->post('nrp');
//
//            $text = "SELECT
//                    	DISTINCT(
//                    	prwlian.Tahun),
//                    	prwlian.Periode_Sem,
//                    	Nama_Jenjang,
//                    	Nama_Prodi,
//                    	prwlian.NRP,
//                    	Nama_Mhs,
//                    	CONCAT(IFNULL(gelar_depan,''),IFNULL(nama,''),IFNULL(gelar_belakang,'')) as Dosen_Wali
//                    FROM
//                    	tb_akd_tr_ambil_mk amblMK
//                    INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
//                    INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK = mk.Kode_MK
//                    INNER JOIN tb_akd_rf_mahasiswa mhs ON prwlian.NRP=mhs.NRP
//                    INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi=prodi.Kode_Prodi
//                    INNER JOIN tb_akd_rf_jenjang jnjg ON jnjg.Kode_Jenjang=prodi.Jenjang
//                    INNER JOIN tb_peg_rf_pegawai peg ON mhs.Dosen_Wali=peg.nip
//                    WHERE
//                    	amblMK.Kode_DropMK IS NULL
//                    AND prwlian.NRP = '$nrp'
//                    AND prwlian.Tahun = (
//                    	SELECT DISTINCT
//                    		(Tahun)
//                    	FROM
//                    		tb_akd_tr_perwalian
//                    	WHERE
//                    		Tanggal = (
//                    			SELECT
//                    				MAX(Tanggal)
//                    			FROM
//                    				tb_akd_tr_perwalian
//                    		)
//                    )
//                    AND prwlian.Periode_Sem = (
//                    	SELECT DISTINCT
//                    		(Periode_Sem)
//                    	FROM
//                    		tb_akd_tr_perwalian
//                    	WHERE
//                    		Tanggal = (
//                    			SELECT
//                    				MAX(Tanggal)
//                    			FROM
//                    				tb_akd_tr_perwalian
//                    		)
//                    )"; 
//                    
//			$data = $this->app_model->manualQuery($text);
//                foreach($data->result() as $db){
//                    $d['Tahun']=$db->Tahun;
//                    $d['Periode_Sem']=$db->Periode_Sem;
//                    $d['Nama_Jenjang']=$db->Nama_Jenjang;
//                    $d['Nama_Prodi']=$db->Nama_Prodi;
//                    $d['NRP']=$db->NRP;
//                    $d['Nama_Mhs']=$db->Nama_Mhs;
//                    $d['Dosen_Wali']=$db->Dosen_Wali;
//				}
//                
//            $text="SELECT
//                	amblMK.Kode_MK,
//                	Nama_MK,
//                    Kelas,
//                	sks,
//                	Pengambilan_Ke
//                FROM
//                	tb_akd_tr_ambil_mk amblMK
//                INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
//                INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK = mk.Kode_MK
//                WHERE
//                	amblMK.Kode_DropMK IS NULL
//                AND NRP = '$nrp'
//                AND prwlian.Tahun = (
//                	SELECT DISTINCT
//                		(Tahun)
//                	FROM
//                		tb_akd_tr_perwalian
//                	WHERE
//                		Tanggal = (
//                			SELECT
//                				MAX(Tanggal)
//                			FROM
//                				tb_akd_tr_perwalian
//                		)
//                )
//                AND prwlian.Periode_Sem = (
//                	SELECT DISTINCT
//                		(Periode_Sem)
//                	FROM
//                		tb_akd_tr_perwalian
//                	WHERE
//                		Tanggal = (
//                			SELECT
//                				MAX(Tanggal)
//                			FROM
//                				tb_akd_tr_perwalian
//                		)
//                )";
//            $result_ambilMK='';
//            $data = $this->app_model->manualQuery($text);
//            if ($data->num_rows()>0){
//                foreach($data->result() as $i=>$db){
//                    $result_ambilMK=$result_ambilMK."<tr class='det_item-row-pra'>
//                    <td align='center'>".($i+1)."</td>
//                    <td align='center'>".$db->Kode_MK."</td>
//                    <td>".$db->Nama_MK."</td>
//                    <td align='center'>".$db->Kelas."</td>
//                    <td align='center'>".$db->sks."</td>
//                    <td align='center'>".$db->Pengambilan_Ke."</td>
//                    </tr>";
//				}
//            }else
//            {
//                $result_ambilMK="<tr class='det_item-row-pra'><td colspan='5' align='center'> Tidak ada data </td> ";
//            }
//            $d['result_ambilMK']=$result_ambilMK;
//
//            echo json_encode($d);
//			
//		}else{
//			$d['signout']='YES';
//            echo json_encode($d);
//		}
//	}

    public function getDataToCetak(){
        $nrp = $this->session->userdata('nrp');
        $nama = $this->session->userdata('nama');
        $jk = $this->session->userdata('jk');
        $kelas = $this->session->userdata('kelas');
        $agama = $this->session->userdata('agama');
        $tahun = $this->session->userdata('tahun');
        $provinsi = $this->session->userdata('provinsi');
        $prodi = $this->session->userdata('prodi');
        $smu = $this->session->userdata('smu');
        $informasi = $this->session->userdata('informasi');
        $statusDaftar = $this->session->userdata('statusDaftar');
        $statusReg = $this->session->userdata('statusReg');
        $tglMasuk = $this->session->userdata('tglMasuk');
        $tglMasuk2 = $this->session->userdata('tglMasuk2');
                                               
        //print_r($d);
        $where="WHERE Id_Camaba IS NOT NULL";
        if($nrp!='') $where .= (" AND NRP LIKE '%$nrp%'");
        if($nama!='') $where .= (" AND Nama_Mhs LIKE '%$nama%'");
        if($jk!='0' && $jk!='' ) $where .= (" AND JK='$jk'");
        if($kelas!='0' && $kelas!='' ) $where .= (" AND Kelas='$kelas'");
        if($agama!='0' && $agama!='') $where .= (" AND mhs.Agama_id = '$agama'");
        if($tahun!='') $where .= (" AND Tahun_Masuk LIKE '%$tahun%'");
        if($provinsi!='0' && $provinsi!='') $where .= (" AND mhs.Kode_Prop ='$provinsi'");
        if($prodi!='0' && $prodi!='') $where .= (" AND mhs.Kode_Prodi ='$prodi'");
        if($smu!='0' && $smu!='') $where .= (" AND mhs.Kode_SMU ='$smu'");
        if($informasi!='0' && $informasi!='') $where .= (" AND mhs.Id_Informasi ='$informasi'");
        if($statusDaftar!='0' && $statusDaftar!='') $where .= (" AND Status_Daftar ='$statusDaftar'");
        if($statusReg!='0' && $statusReg!='') $where .= (" AND Status_Reg ='$statusReg'");
        
        if($tglMasuk!=''){
          $tglMasuk = date("Y-m-d", strtotime($tglMasuk));
          $where .= (" AND DATE_FORMAT(Tgl_Masuk ,'%Y-%m-%d') >= DATE_FORMAT('$tglMasuk','%Y-%m-%d')");  
        } 
        if($tglMasuk2!=''){
          $tglMasuk2 = date("Y-m-d", strtotime($tglMasuk2));
          $where .= (" AND DATE_FORMAT(Tgl_Masuk ,'%Y-%m-%d')<=DATE_FORMAT('$tglMasuk2','%Y-%m-%d')");  
        } 
        $text = "SELECT
                        
                        NRP,
                        Nama_Mhs,
                        JK,
                        Kelas,
                        Agama,
                        Nama_Prop,
                        Nama_Prodi,
                    	Tahun_Masuk,
                        Asal_SMU,
                        Nama_Informasi,
                        Status_Daftar,
                    	Status_Reg,
                        Tgl_Masuk
                    
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
       	NRP ASC";
        //echo $text;
		$data = $this->app_model->manualQuery($text);

        $result_laporan_camaba='';
            
        if ($data->num_rows()>0){
            foreach($data->result() as $i=>$db){
                $result_laporan_camaba=$result_laporan_camaba."<tr class='cetak_data'>
                <td align='center'>".($i+1)."</td>
                <td>".$db->NRP."</td>
                <td align='center'>".$db->Nama_Mhs."</td>
                <td align='center'>".$db->JK."</td>
                <td align='center'>".$db->Kelas."</td>
                <td align='center'>".$db->Agama."</td>
                <td align='center'>".$db->Tahun_Masuk."</td>
                <td align='center'>".$db->Nama_Prop."</td>
                <td align='center'>".$db->Nama_Prodi."</td>
                <td align='center'>".$db->Asal_SMU."</td>
                <td align='center'>".$db->Nama_Informasi."</td>
                <td align='center'>".$db->Status_Daftar."</td>
                <td align='center'>".$db->Status_Reg."</td>
                <td align='center'>".$db->Tgl_Masuk."</td>
                </tr>";
			}
        }else
        {
            $result_laporan_camaba="<tr bgcolor='#fff' class='cetak_data'><td colspan=7 align='center'> Tidak ada data </td> ";
        }
            $d['laporan_camaba']=$result_laporan_camaba;
            
            echo json_encode($d);
    }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
