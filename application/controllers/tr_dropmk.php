<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tr_dropmk extends CI_Controller {

	/**
	 * @author : Ahmad Rianto
	 * @web : 
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    public function getDataFromDB($table,$id,$idField,$resultField){
        $temp = $this->app_model->getDataFromDB($table,$id,$idField,$resultField);
        $result=$temp->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0][$resultField];   
        }
        return $hasil;
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
    
    public function getDetailMK(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$tahun = $this->input->post('tahun');
            $periodeSem = $this->input->post('periodeSem');
            $nrp = $this->input->post('nrp');
            $kodemk= $this->input->post('kodemk');
			
            $text = "SELECT
                    	per.Kd_perwalian,
                    	NRP,
                    	det.Kode_MK,
                    	Nama_MK,
                    	kelas,
                        sks
                    FROM
                    	((
                    		tb_akd_tr_perwalian per
                    		INNER JOIN tb_akd_tr_ambil_mk det ON per.Kd_perwalian = det.Kd_Perwalian
                    	)INNER JOIN tb_akd_rf_mata_kuliah mk ON det.Kode_MK=mk.Kode_MK)
                    WHERE
                    	NRP = '$nrp'
                        AND isValidate='YES'
                    AND (
                    	LEFT (per.Kd_perwalian, 4) = '$tahun'
                    	OR YEAR(Tanggal) = '$tahun'
                    )
                    AND per.Periode_Sem = '$periodeSem'
                    AND det.Kode_MK='$kodemk'
                    AND Kode_DropMK is null"; 
                    
            //echo $text;
			$data = $this->app_model->manualQuery($text);
            
            if($data->num_rows()==1){
                foreach($data->result() as $db){
                    $d['Kd_perwalian']=$db->Kd_perwalian;
                    $d['Nama_MK']=$db->Nama_MK;
                    $d['kelas']=$db->kelas;
                    $d['sks']=$db->sks;
				} 
            }else{
                $d['Kd_perwalian']='invalid';
            }
            echo json_encode($d);
		
		}else{
			$d['signout']='YES';
            echo json_encode($d);
		}
    }
    
    public function getDetailPerwalian(){
        $cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$tahun = $this->input->post('tahun');
            $periodeSem = $this->input->post('periode_sem');
            $nrp = $this->input->post('nrp');
			
            $text = "SELECT
                    	Kd_perwalian,
                    	per.NRP,
                    	mhs.Nama_Mhs,
                    	mhs.Email,
                    	mhs.Alamat,
                    	mhs.Tlp_HP,
                    	peg.nama as Dosen_Wali,
                    	IsValidate
                    FROM
                    	(
                    		(
                    			tb_akd_tr_perwalian per
                    			INNER JOIN tb_akd_rf_mahasiswa mhs ON per.NRP = mhs.NRP
                    		)
                    		LEFT JOIN tb_peg_rf_pegawai peg ON mhs.Dosen_Wali=peg.nip
                    	)
                    WHERE
                    	(
                    		LEFT (Kd_perwalian, 4) = '$tahun'
                    		OR YEAR (Tanggal) = '$tahun'
                    	)
                    AND Periode_Sem = '$periodeSem'
                    AND per.NRP = '$nrp'"; 
                    
			$data = $this->app_model->manualQuery($text);
            
            if($data->num_rows()==1){
                foreach($data->result() as $db){
                    $d['Kd_perwalian']=$db->Kd_perwalian;
                    $d['NRP']=$db->NRP;
                    $d['Nama_Mhs']=$db->Nama_Mhs;
                    $d['Email']=$db->Email;
                    $d['Alamat']=$db->Alamat;
                    $d['Tlp_HP']=$db->Tlp_HP;
                    $d['Dosen_Wali']=$db->Dosen_Wali;
                    $d['IsValidate']=$db->IsValidate;
                    $kdPerwalain=$db->Kd_perwalian;
				} 
            }else{
                $d['Kd_perwalian']='invalid';
                $kdPerwalain='invalid';
            }
            
            if($kdPerwalain!='invalid'){
                $queryText="SELECT
                            	amb.Kode_MK,
                            	Nama_MK,
                            	kelas,
                            	Pengambilan_Ke
                            FROM
                            	tb_akd_tr_ambil_mk amb INNER JOIN tb_akd_rf_mata_kuliah mk ON amb.Kode_MK=mk.Kode_MK
                            WHERE
                            	Kd_Perwalian = '$kdPerwalain'";    
                $result_detail='';
                $resDetail = $this->app_model->manualQuery($queryText);
                
                if ($resDetail->num_rows()>0){
                    foreach($resDetail->result() as $i=>$detail){
                        if(($i%2)==0){
                            $color="bgcolor='#fff'";
                        }else
                        {
                            $color="bgcolor='#ecf2f6'";
                        }
                        $result_detail.="<tr ".$color.">
                        <td align='center'>".($i+1)."</td>
                        <td align='center'>".$detail->Kode_MK."</td>
                        <td>".$detail->Nama_MK."</td>
                        <td align='center'>".$detail->kelas."</td>
                        <td align='center'>".$detail->Pengambilan_Ke."</td>";
    				}
                }else
                {
                    $result_detail="<tr bgcolor='#fff'><td colspan=5 align='center'> Tidak ada data </td> ";
                }
                
                $d['detailAmbilMK']=$result_detail;
            }
            echo json_encode($d);
		
		}else{
			$d['signout']='YES';
            echo json_encode($d);
		}
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
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Pembatalan Pengambilan Mata Kuliah";
			
            $d['periode_sem']=$this->getEnumFieldValues('tb_akd_tr_perwalian','periode_sem');
                        
			$d['content'] = $this->load->view('tr/dropmk/view', $d, true);		
			//log_message('error', print_r($d, TRUE));
            $this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}

    public function simpanEdit()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		      
            $this->db->trans_begin();  
            $tahun=$this->input->post('tahun');
            $periodeSem=$this->input->post('periodeSem');
            $nrp=$this->input->post('nrp');
            $alasan=$this->input->post('alasan');
            $mkList=$this->input->post('mkList');
            $sksDropped=$this->input->post('sksDropped');

            //-----------------------------Get Kode Perwalian----------------------------------
            $text = "SELECT
                    	Kd_perwalian
                    FROM
                    	tb_akd_tr_perwalian
                    WHERE
                    	(
                    		Tahun = '$tahun'
                    	)
                    AND Periode_Sem = '$periodeSem'
                    AND NRP = '$nrp'";
			$data = $this->app_model->manualQuery($text);
            $hasilKodePerwalian=$data->result_array();
            if(count($hasilKodePerwalian)==1){
                $kodePerwalian=$hasilKodePerwalian[0]['Kd_perwalian'];
            
            //-----------------------------Get Kode Periode Semester----------------------------------
            $resPeriodeSem = $this->getEnumFieldValues('tb_akd_tr_drop_mk','periode_Sem');
            $no=0;
            $kodeSem='';
                foreach(explode("','",substr($resPeriodeSem,6,-2)) as $option){
                    $no++;
                    if($option==$periodeSem){
                          $kodeSem=$no;
                    }
                }
            
            //-------------------------Generate New Kode Perwalian-------------------------------------
            $text = "SELECT
                    	MAX(Kode_DropMK) AS newInd
                    FROM
                    	tb_akd_tr_drop_mk
                    WHERE
                    	Tahun='$tahun' OR Tahun='$tahun' AND SUBSTR(Kode_DropMK,3,1)='$kodeSem'";
			$data = $this->app_model->manualQuery($text);
            $kodePer=$data->result_array();
            if($kodePer[0]['newInd']==null){
                $kdPer=$tahun.$kodeSem.'0001';
            }else
            {
                $kdPer=($kodePer[0]['newInd']+1);
            }
            
            $databaru = array(
                'Kode_DropMK' => $kdPer,
                'NRP' =>  $nrp,
                'Periode_Sem' => $periodeSem,
                'Tahun' =>  $tahun,
                'Alasan' =>  $alasan,
                'Created_by' => $this->session->userdata('username'),
                'Created_date' => $this->today(),
                
            );

            $this->db->insert("tb_akd_tr_drop_mk",$databaru);
            $detailDrop[]=null;
            $ambilMK[]=null;
            $username=$this->session->userdata('username');
            $today=$this->today();
            foreach(explode(',',substr($mkList,0,strlen($mkList)-1)) as $i=>$kodeMK){
                $kodeMK=strtoupper($kodeMK);
                $detailDrop[$i]['Kode_DropMK']=$kdPer;
                $detailDrop[$i]['Kode_MK']=$kodeMK;
                $detailDrop[$i]['Created_By']=$this->session->userdata('username');
                $detailDrop[$i]['Created_Date']=$this->today();
                
                $dataUpdate=array(
                    'Kode_DropMK'=>$kdPer,
                    'Modified_by'=>$username,
                    'Modified_Date'=>$today,
                );
                
                $keyUpdate=array(
                    'Kd_Perwalian'=>$kodePerwalian,
                    'Kode_MK'=>$kodeMK,
                );
                $this->db->update('tb_akd_tr_ambil_mk',$dataUpdate,$keyUpdate);
            }
            $this->db->insert_batch("tb_akd_tr_detail_dropmk",$detailDrop);
            
            /** =================Ubah Data Statistik Nilai=========================== **/
                /** hitung SKS Sisa terakhir **/
                $queryGetSKS="SELECT 
                                SKS_Sekarang,
                                SKS_Keseluruhan,
                                Num_Semester,
                                (SELECT Max(Num_Semester) FROM tb_akd_tr_statistik_nilai WHERE NRP='$nrp') as Max_Sem
                            FROM
                                tb_akd_tr_statistik_nilai
                            WHERE
                                NRP = '$nrp'
                            AND Tahun = '$tahun'
                            AND Periode_Sem = '$periodeSem'";
                $querySKS=$this->app_model->manualQuery($queryGetSKS);
                
                foreach($querySKS->result() as $stat){
                    $SKS_now = $stat->SKS_Sekarang;
                    $SKS_Tot = $stat->SKS_Keseluruhan;
                    $Num_Sem = $stat->Num_Semester;
                    $Max_Sem = $stat->Max_Sem;
                }
                
                if($Num_Sem==$Max_Sem){ 
                    $newSKS_now = $SKS_now-$sksDropped;
                    $newSKS_Tot = $SKS_Tot-$sksDropped;
                    
                    $dataUpdateStat = array(
                        'SKS_Sekarang'=>$newSKS_now,
                        'SKS_Keseluruhan'=>$newSKS_Tot,
                    );
                    
                    $keyUpdateStat = array(
                        'NRP'=>$nrp,
                        'Tahun'=>$tahun,
                        'Periode_Sem'=>$periodeSem,
                    );
                    
                    $this->db->update('tb_akd_tr_statistik_nilai',$dataUpdateStat,$keyUpdateStat);
                }else
                {
                    $this->db->trans_rollback();
                    echo 'Tidak dapat menyimpan, Mata kuliah sudah melewati masa pembatalan';
                    return false;
                }
                
                //$this->db->trans_rollback();
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $this->db->trans_commit();
                    echo 'Simpan data Sukses';    
                }
              
            }
            else{
                echo 'Terdapat kesalahan pada proses perwaliannya. Mohon diperiksa';
            } 
		}else{
            echo 'logout';				
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */