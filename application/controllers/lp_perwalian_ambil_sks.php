<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lp_perwalian_ambil_sks extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
    public function filterData(){
        $cek = $this->session->userdata('logged_in');
            
            $jenjang = $this->input->post('jenjang');
            $prodi = $this->input->post('prodi');
            $nrp = $this->input->post('nrp');
            $nama = $this->input->post('nama');
            $comparison_sks_sekarang = $this->input->post('comparison_sks_sekarang');
            $sks_sekarang = $this->input->post('sks_sekarang');
            $comparison_sks_total = $this->input->post('comparison_sks_total');
            $sks_total = $this->input->post('sks_total');
            
            if($jenjang=="0") $jenjang='';
            if($prodi=="0") $prodi='';
                        
            $sess_filter['class']='lp_perwalian_ambil_sks';
            $sess_filter['jenjang']=$jenjang;
            $sess_filter['prodi']=$prodi;
            $sess_filter['nrp']=$nrp;
            $sess_filter['nama']=$nama;
            $sess_filter['comparison_sks_sekarang']=$comparison_sks_sekarang;
            $sess_filter['sks_sekarang']=$sks_sekarang;
            $sess_filter['comparison_sks_total']=$comparison_sks_total;
            $sess_filter['sks_total']=$sks_total;
            $this->session->set_userdata($sess_filter);
            
            $d['Status']='OK';
            echo json_encode($d);
            
        }
    
    public function noFilter(){
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $sess_filter['class']='lp_perwalian_ambil_sks';
            $sess_filter['jenjang']='';
            $sess_filter['prodi']='';
            $sess_filter['nrp']='';
            $sess_filter['nama']='';
            $sess_filter['comparison_sks_sekarang']='';
            $sess_filter['sks_sekarang']='';
            $sess_filter['comparison_sks_total']='';
            $sess_filter['sks_total']='';
            
            $this->session->set_userdata($sess_filter);
            
            $this->load->helper('url');
            redirect(base_url().'index.php/lp_perwalian_ambil_sks');
        }
    }
    
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
        
		if(!empty($cek)){
			$class=$this->session->userdata('class');
            if($class=='lp_perwalian_ambil_sks'){

                $jenjang = $this->session->userdata('jenjang');
                $prodi = $this->session->userdata('prodi');
                $nrp = $this->session->userdata('nrp');
                $nama = $this->session->userdata('nama');
                $comparison_sks_sekarang = $this->session->userdata('comparison_sks_sekarang');
                $sks_sekarang = $this->session->userdata('sks_sekarang');
                $comparison_sks_total = $this->session->userdata('comparison_sks_total');
                $sks_total = $this->session->userdata('sks_total');
               
                $d['jenjangSelected']=$jenjang;
                $d['prodiSelected']=$prodi;
                $d['nrp']=$nrp;
                $d['nama']=$nama;
                $d['comparison_sks_sekarangSelected']=$comparison_sks_sekarang;
                $d['sks_sekarang']=$sks_sekarang;
                $d['comparison_sks_totalSelected']=$comparison_sks_total;
                $d['sks_total']=$sks_total;
                
                $where="WHERE skrng.NRP is NOT null";
                if($jenjang!='') $where .= (" AND Prodi.Jenjang='$jenjang'");
                if($prodi!='') $where .= (" AND Nama_Prodi='$prodi'");
                if($nrp!='') $where .= (" AND skrng.NRP LIKE'%$nrp%'");
                if($nama!='') $where .= (" AND Nama_Mhs LIKE '%$nama%'");
                if($sks_sekarang!=''){
                    if($comparison_sks_sekarang=='0') $where .= (" AND SKS_Sekarang =$sks_sekarang");
                    if($comparison_sks_sekarang=='1') $where .= (" AND SKS_Sekarang <$sks_sekarang"); else
                    if($comparison_sks_sekarang=='2') $where .= (" AND SKS_Sekarang <=$sks_sekarang"); else
                    if($comparison_sks_sekarang=='3') $where .= (" AND SKS_Sekarang >$sks_sekarang"); else
                    if($comparison_sks_sekarang=='4') $where .= (" AND SKS_Sekarang >='$sks_sekarang");
                } 
                if($sks_total!=''){
                    if($comparison_sks_total == '0') $where .= (" AND SKS_Kumulatif =$sks_total");
                    if($comparison_sks_total=='1') $where .= (" AND SKS_Kumulatif <$sks_total"); else
                    if($comparison_sks_total=='2') $where .= (" AND SKS_Kumulatif <=$sks_total"); else
                    if($comparison_sks_total=='3') $where .= (" AND SKS_Kumulatif >$sks_total"); else
                    if($comparison_sks_total=='4') $where .= (" AND SKS_Kumulatif >=$sks_total");
                }
                
    			$d['prg']= $this->config->item('prg');
    			$d['web_prg']= $this->config->item('web_prg');
    			
    			$d['nama_program']= $this->config->item('nama_program');
    			$d['instansi']= $this->config->item('instansi');
    			$d['usaha']= $this->config->item('usaha');
    			$d['alamat_instansi']= $this->config->item('alamat_instansi');
    
    			
    			$d['judul']="Pengambilan SKS Mahasiswa";
    			
    			//paging
    			$page=$this->uri->segment(3);
    			$limit=$this->config->item('limit_data');
    			if(!$page):
    			$offset = 0;
    			else:
    			$offset = $page;
    			endif;
    			
    			$text = "SELECT
                    	   COUNT(skrng.NRP) as Num_Row
                    FROM(
                    SELECT
                    	NRP,
                    	SUM(sks) as SKS_Sekarang
                    FROM
                    	tb_akd_tr_ambil_mk amblMK
                    INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                    INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                    WHERE amblMK.Kode_DropMK is null
                    AND prwlian.Tahun=(SELECT DISTINCT(Tahun) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT DISTINCT(MAX(Tanggal)) FROM tb_akd_tr_perwalian))
                    AND prwlian.Periode_Sem=(SELECT DISTINCT(Periode_Sem) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT DISTINCT(MAX(Tanggal)) FROM tb_akd_tr_perwalian))
                    GROUP BY NRP
                    ) skrng
                    INNER JOIN
                    (
                    SELECT
                    	NRP,
                    	SUM(sks) as SKS_Kumulatif
                    FROM
                    	tb_akd_tr_ambil_mk amblMK
                    INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                    INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                    WHERE amblMK.Kode_DropMK is null
                    GROUP BY NRP
                    ) kmltf ON skrng.NRP=kmltf.NRP
                    INNER JOIN tb_akd_rf_mahasiswa mhs ON kmltf.NRP=mhs.NRP
                    INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi=prodi.Kode_Prodi
                    INNER JOIN tb_akd_rf_jenjang jnjng ON prodi.Jenjang=jnjng.Kode_Jenjang
                    $where";
                        		
    			$tot_hal = $this->app_model->manualQuery($text);
                $numRow = $tot_hal->result_array();		
    			
    			$d['tot_hal'] = $numRow[0]['Num_Row'];
    			
    			$config['base_url'] = site_url() . '/lp_perwalian_ambil_sks/index/';
    			$config['total_rows'] = $numRow[0]['Num_Row'];
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
                            Prodi.Jenjang,
                        	Nama_Jenjang,
                        	Nama_Prodi,
                        	skrng.NRP,
                        	Nama_Mhs,
                        	SKS_Sekarang,	
                        	SKS_Kumulatif
                        FROM(
                        SELECT
                        	NRP,
                        	SUM(sks) as SKS_Sekarang
                        FROM
                        	tb_akd_tr_ambil_mk amblMK
                        INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                        INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                        WHERE amblMK.Kode_DropMK is null
                        AND prwlian.Tahun=(SELECT DISTINCT(Tahun) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT MAX(Tanggal) FROM tb_akd_tr_perwalian))
                        AND prwlian.Periode_Sem=(SELECT DISTINCT(Periode_Sem) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT MAX(Tanggal) FROM tb_akd_tr_perwalian))
                        GROUP BY NRP
                        ) skrng
                        INNER JOIN
                        (
                        SELECT
                        	NRP,
                        	SUM(sks) as SKS_Kumulatif
                        FROM
                        	tb_akd_tr_ambil_mk amblMK
                        INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                        INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                        WHERE amblMK.Kode_DropMK is null
                        GROUP BY NRP
                        ) kmltf ON skrng.NRP=kmltf.NRP
                        INNER JOIN tb_akd_rf_mahasiswa mhs ON kmltf.NRP=mhs.NRP
                        INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi=prodi.Kode_Prodi
                        INNER JOIN tb_akd_rf_jenjang jnjng ON prodi.Jenjang=jnjng.Kode_Jenjang
                        $where
    					LIMIT $limit OFFSET $offset";
                //echo $text;
    			$d['data'] = $this->app_model->manualQuery($text);
                
                $d['periodeSem']=$this->getEnumFieldValues('tb_akd_tr_ambil_mk','Periode_Sem');
                
                $queryProdi="SELECT DISTINCT(Nama_Prodi) FROM tb_akd_rf_prodi";
                $d['prodi']=$this->app_model->manualQuery($queryProdi);
                
                $queryJenjangAll="SELECT Kode_Jenjang,Nama_Jenjang FROM tb_akd_rf_jenjang";
                $d['jenjangAll']=$this->app_model->manualQuery($queryJenjangAll);
                
                $queryJenisMK="SELECT
                    	Kode_JenisMK,
                    	Nama_JenisMK
                    FROM
                    	tb_akd_rf_jenismk";
                $d['jenismk']=$this->app_model->manualQuery($queryJenisMK);
                
                $queryJenjang="SELECT DISTINCT(Jenjang),Nama_Jenjang FROM tb_akd_rf_prodi prodi INNER JOIN tb_akd_rf_jenjang tbjen ON prodi.Jenjang=tbjen.Kode_Jenjang";
                $d['jenjang']=$this->app_model->manualQuery($queryJenjang);
                
                $text = "SELECT Kode_JenisMK, Nama_JenisMK FROM tb_akd_rf_jenismk";
    			$d['jenismk'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_Kelompok, Nama_Kelompok FROM tb_akd_rf_kelompok_mk";
    			$d['kelompokmk'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_MK, Nama_MK FROM tb_akd_rf_mata_kuliah where isAktif='YES'
                        ORDER BY Nama_MK ASC";
    			$d['mkpra'] = $this->app_model->manualQuery($text);
                
                $text = "SELECT Kode_MK, Nama_MK FROM tb_akd_rf_mata_kuliah
                        ORDER BY Nama_MK ASC";
    			$d['riwayat'] = $this->app_model->manualQuery($text);
                
    			$d['content'] = $this->load->view('lp/perwalian_ambil_sks/view', $d, true);		
    			//log_message('error', print_r($d, TRUE));
                $this->load->view('home',$d);
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
    
   	public function detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$nrp = $this->input->post('nrp');

            $text = "SELECT
                    	DISTINCT(
                    	prwlian.Tahun),
                    	prwlian.Periode_Sem,
                    	Nama_Jenjang,
                    	Nama_Prodi,
                    	prwlian.NRP,
                    	Nama_Mhs,
                    	CONCAT(IFNULL(gelar_depan,''),IFNULL(nama,''),IFNULL(gelar_belakang,'')) as Dosen_Wali
                    FROM
                    	tb_akd_tr_ambil_mk amblMK
                    INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                    INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK = mk.Kode_MK
                    INNER JOIN tb_akd_rf_mahasiswa mhs ON prwlian.NRP=mhs.NRP
                    INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi=prodi.Kode_Prodi
                    INNER JOIN tb_akd_rf_jenjang jnjg ON jnjg.Kode_Jenjang=prodi.Jenjang
                    INNER JOIN tb_peg_rf_pegawai peg ON mhs.Dosen_Wali=peg.nip
                    WHERE
                    	amblMK.Kode_DropMK IS NULL
                    AND prwlian.NRP = '$nrp'
                    AND prwlian.Tahun = (
                    	SELECT DISTINCT
                    		(Tahun)
                    	FROM
                    		tb_akd_tr_perwalian
                    	WHERE
                    		Tanggal = (
                    			SELECT
                    				MAX(Tanggal)
                    			FROM
                    				tb_akd_tr_perwalian
                    		)
                    )
                    AND prwlian.Periode_Sem = (
                    	SELECT DISTINCT
                    		(Periode_Sem)
                    	FROM
                    		tb_akd_tr_perwalian
                    	WHERE
                    		Tanggal = (
                    			SELECT
                    				MAX(Tanggal)
                    			FROM
                    				tb_akd_tr_perwalian
                    		)
                    )"; 
                    
			$data = $this->app_model->manualQuery($text);
                foreach($data->result() as $db){
                    $d['Tahun']=$db->Tahun;
                    $d['Periode_Sem']=$db->Periode_Sem;
                    $d['Nama_Jenjang']=$db->Nama_Jenjang;
                    $d['Nama_Prodi']=$db->Nama_Prodi;
                    $d['NRP']=$db->NRP;
                    $d['Nama_Mhs']=$db->Nama_Mhs;
                    $d['Dosen_Wali']=$db->Dosen_Wali;
				}
                
            $text="SELECT
                	amblMK.Kode_MK,
                	Nama_MK,
                    Kelas,
                	sks,
                	Pengambilan_Ke
                FROM
                	tb_akd_tr_ambil_mk amblMK
                INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK = mk.Kode_MK
                WHERE
                	amblMK.Kode_DropMK IS NULL
                AND NRP = '$nrp'
                AND prwlian.Tahun = (
                	SELECT DISTINCT
                		(Tahun)
                	FROM
                		tb_akd_tr_perwalian
                	WHERE
                		Tanggal = (
                			SELECT
                				MAX(Tanggal)
                			FROM
                				tb_akd_tr_perwalian
                		)
                )
                AND prwlian.Periode_Sem = (
                	SELECT DISTINCT
                		(Periode_Sem)
                	FROM
                		tb_akd_tr_perwalian
                	WHERE
                		Tanggal = (
                			SELECT
                				MAX(Tanggal)
                			FROM
                				tb_akd_tr_perwalian
                		)
                )";
            $result_ambilMK='';
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows()>0){
                foreach($data->result() as $i=>$db){
                    $result_ambilMK=$result_ambilMK."<tr class='det_item-row-pra'>
                    <td align='center'>".($i+1)."</td>
                    <td align='center'>".$db->Kode_MK."</td>
                    <td>".$db->Nama_MK."</td>
                    <td align='center'>".$db->Kelas."</td>
                    <td align='center'>".$db->sks."</td>
                    <td align='center'>".$db->Pengambilan_Ke."</td>
                    </tr>";
				}
            }else
            {
                $result_ambilMK="<tr class='det_item-row-pra'><td colspan='5' align='center'> Tidak ada data </td> ";
            }
            $d['result_ambilMK']=$result_ambilMK;

            echo json_encode($d);
			
		}else{
			$d['signout']='YES';
            echo json_encode($d);
		}
	}

    public function getDataToCetak(){
        $jenjang = $this->session->userdata('jenjang');
        $prodi = $this->session->userdata('prodi');
        $nrp = $this->session->userdata('nrp');
        $nama = $this->session->userdata('nama');
        $comparison_sks_sekarang = $this->session->userdata('comparison_sks_sekarang');
        $sks_sekarang = $this->session->userdata('sks_sekarang');
        $comparison_sks_total = $this->session->userdata('comparison_sks_total');
        $sks_total = $this->session->userdata('sks_total');

        $where="WHERE skrng.NRP is NOT null";
        if($jenjang!='') $where .= (" AND Prodi.Jenjang='$jenjang'");
        if($prodi!='') $where .= (" AND Nama_Prodi='$prodi'");
        if($nrp!='') $where .= (" AND skrng.NRP LIKE'%$nrp%'");
        if($nama!='') $where .= (" AND Nama_Mhs LIKE '%$nama%'");
        if($sks_sekarang!=''){
            if($comparison_sks_sekarang=='0') $where .= (" AND SKS_Sekarang =$sks_sekarang");
            if($comparison_sks_sekarang=='1') $where .= (" AND SKS_Sekarang <$sks_sekarang"); else
            if($comparison_sks_sekarang=='2') $where .= (" AND SKS_Sekarang <=$sks_sekarang"); else
            if($comparison_sks_sekarang=='3') $where .= (" AND SKS_Sekarang >$sks_sekarang"); else
            if($comparison_sks_sekarang=='4') $where .= (" AND SKS_Sekarang >='$sks_sekarang");
        } 
        if($sks_total!=''){
            if($comparison_sks_total == '0') $where .= (" AND SKS_Kumulatif =$sks_total");
            if($comparison_sks_total=='1') $where .= (" AND SKS_Kumulatif <$sks_total"); else
            if($comparison_sks_total=='2') $where .= (" AND SKS_Kumulatif <=$sks_total"); else
            if($comparison_sks_total=='3') $where .= (" AND SKS_Kumulatif >$sks_total"); else
            if($comparison_sks_total=='4') $where .= (" AND SKS_Kumulatif >=$sks_total");
        }
        
        $text = "SELECT
                    Prodi.Jenjang,
                	Nama_Jenjang,
                	Nama_Prodi,
                	skrng.NRP,
                	Nama_Mhs,
                	SKS_Sekarang,	
                	SKS_Kumulatif
                FROM(
                SELECT
                	NRP,
                	SUM(sks) as SKS_Sekarang
                FROM
                	tb_akd_tr_ambil_mk amblMK
                INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                WHERE amblMK.Kode_DropMK is null
                AND prwlian.Tahun=(SELECT DISTINCT(Tahun) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT MAX(Tanggal) FROM tb_akd_tr_perwalian))
                AND prwlian.Periode_Sem=(SELECT DISTINCT(Periode_Sem) FROM tb_akd_tr_perwalian WHERE Tanggal=(SELECT MAX(Tanggal) FROM tb_akd_tr_perwalian))
                GROUP BY NRP
                ) skrng
                INNER JOIN
                (
                SELECT
                	NRP,
                	SUM(sks) as SKS_Kumulatif
                FROM
                	tb_akd_tr_ambil_mk amblMK
                INNER JOIN tb_akd_tr_perwalian prwlian ON amblMK.Kd_Perwalian = prwlian.Kd_perwalian
                INNER JOIN tb_akd_rf_mata_kuliah mk ON amblMK.Kode_MK=mk.Kode_MK
                WHERE amblMK.Kode_DropMK is null
                GROUP BY NRP
                ) kmltf ON skrng.NRP=kmltf.NRP
                INNER JOIN tb_akd_rf_mahasiswa mhs ON kmltf.NRP=mhs.NRP
                INNER JOIN tb_akd_rf_prodi prodi ON mhs.Kode_Prodi=prodi.Kode_Prodi
                INNER JOIN tb_akd_rf_jenjang jnjng ON prodi.Jenjang=jnjng.Kode_Jenjang
                $where";
                
                //echo $text;
    	$data = $this->app_model->manualQuery($text);
        
        $result_ambilsks='';
            
        if ($data->num_rows()>0){
            foreach($data->result() as $i=>$db){
                $result_ambilsks=$result_ambilsks."<tr class='cetak_data'>
                <td align='center'>".($i+1)."</td>
                <td>".$db->Nama_Jenjang."</td>
                <td>".$db->Nama_Prodi."</td>
                <td align='center'>".$db->NRP."</td>
                <td>".$db->Nama_Mhs."</td>
                <td align='center'>".$db->SKS_Sekarang."</td>
                <td align='center'>".$db->SKS_Kumulatif."</td>
                </tr>";
			}
        }else
        {
            $result_ambilsks="<tr bgcolor='#fff' class='cetak_data'><td colspan=7 align='center'> Tidak ada data </td> ";
        }
            $d['ambilsks']=$result_ambilsks;
            
            echo json_encode($d);
    }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
