<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_set_jalur_terima extends MY_Controller {

	public function index()
	{
        $prop=array(
            "tab"=>array(
                    0=>array(
                        "from"=>0,
                        "to"=>0,
                    ),
                    1=>array(
                        "from"=>1,
                        "to"=>3,
                    ),
                    2=>array(
                        "from"=>4,
                        "to"=>10,
                    ),
                )
        );
		$genForm=$genForm=genFormInputByClassWithProperty($this->mydata['page_id'],$prop);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        //Load Modal
        $this->mydata['doneTypingInterval']=$this->system_model->getConfigItem('doneTypingInterval');
        $this->mydata['modal']=$this->load->view('tr/set_jalur_penerimaan/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('tr/set_jalur_penerimaan/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    public function retrieveData(){
        $this->load->library('datatable');          
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
          	
        $kolom = array('Id_Camaba','Nama_Mhs','Pilihan_Prodi','Kelas_Deskripsi','Status_Masuk','Nama_JalurPenerimaan','isUjian','options-no-db');        
		$pk = 'Id_Camaba';
		$sql = "
			(
				
                SELECT
                	camaba.Id_Camaba,
                	Nama_Mhs,
                	GROUP_CONCAT(CONCAT(opt_prd.pilihan_ke,'. ',prd.Jenjang,' ',prd.Nama_Prodi) ORDER BY opt_prd.pilihan_ke SEPARATOR ', ') AS Pilihan_Prodi,
                	klsMhs.Kelas_Deskripsi,
                	camaba.Status_Masuk,
                	IFNULL(
                		jalur.Nama_JalurPenerimaan,
                		'Belum Ditentukan'
                	) AS Nama_JalurPenerimaan,
                	camaba.isUjian
                FROM
                	tb_pmb_tr_camaba camaba
                INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON camaba.Kelas = klsMhs.Kelas_Mhs
                LEFT JOIN tb_pmb_rf_jalur_penerimaan jalur ON camaba.Jalur_Penerimaan = jalur.Id_JalurPenerimaan
                LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
                LEFT JOIN (
                	tb_pmb_tr_pilihan_prodi opt_prd 
                INNER JOIN tb_akd_rf_prodi prd ON opt_prd.prodi=prd.Kode_Prodi
                )
                ON camaba.Id_Camaba=opt_prd.id_camaba
                WHERE
                	camaba.Tahun_Masuk = '$tahun'
                AND isCanChange = 'NO'
                GROUP BY
                	camaba.Id_Camaba			
			)";
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->Nama_Mhs,				
				$row->Pilihan_Prodi,
                $row->Kelas_Deskripsi,
                $row->Status_Masuk,
                $row->Nama_JalurPenerimaan,
                $row->isUjian,                			
				"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                   <ul class='dropdown-menu pull-right text-left'>
                      <li><a href='#' onclick='edit_".trim($this->mydata['page_id'])."(\"".trim($row->Id_Camaba)."\")'".">Setting Jalur Penerimaan</a></li>
                   </ul>
                </div>"
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
    }
    
    public function lihat(){
        $id=$this->input->post('id');
        $res=$this->app_model->getDetailSetUjian($id);
        if(empty($res['Jalur_Penerimaan'])) $res['Jalur_Penerimaan']=$res['Usulan_Jalur_Penerimaan'];
        $res['det_syarat']=$this->getSyarat($res['Jalur_Penerimaan'],$id);
        $res['det_prodi']=$this->getPlihanProdi($id);
        
        $data['berkas']=$this->app_model->getBerkasCamaba($res['Camaba_Username']);
        $res['det_berkas']=$this->load->view('tr/set_jalur_penerimaan/berkas_uploaded',$data,true);
        
        if(empty($res['No_Ujian'])) $res['No_Ujian']=$this->getNoUjian($res['Jalur_Penerimaan'],$res['Id_Camaba']);
        echo json_encode($res);
    }
    
    public function getSyarat($jalur,$idCamaba){
        $data['obj_syarat']=$this->app_model->getListOfSyaratByJalurDaftar_Camaba(array("Id_JalurPenerimaan"=>$jalur,"Id_Camaba"=>$idCamaba));
        return $this->load->view('tr/set_jalur_penerimaan/syarat_jalur',$data,true);
    }
    
    function getPlihanProdi($id){
        $data['opts']=$this->app_model->getPilihanProdi($id);
        return $this->load->view('tr/set_jalur_penerimaan/pilihan_prodi',$data,true);
    }
    
    public function getNoUjian($jalur,$idCamaba){
        $this->load->helper('rules_helper');
        $komTes=$this->app_model->getKomponenNoTes($idCamaba);
        $jalur=$this->app_model->convert_id('pmb_no_ujian',$jalur);
        $res=getNewNoTes($komTes['Kode_Prodi'],$jalur,$idCamaba);
        return $res;
    }
    
    public function getSyaratAjax(){
        $p=$this->input->post();
        $res['syarat']=$this->getSyarat($p['idJalur'],$p['Id_Camaba']);
        
        $res['No_Ujian']=$this->getNoUjian($p['idJalur'],$p['Id_Camaba']);
        echo json_encode($res);
    }
    
    public function isNoUjianUsed(){
        $p=$this->input->post();
        $res['isExist']=$this->app_model->isNoUjianExist($p['Id_Camaba'],$p['No_Ujian']);
        if($res['isExist']) $res['New_No']=$this->getNoUjian($p['idJalur'],$p['Id_Camaba']);
        echo json_encode($res);
    }
    
    public function simpan()
	{
        $p=$this->input->post();
        $this->db->trans_begin();        
                
        $data=$p;
        if(!empty($p['Tgl_Ujian']))
            $data['Tgl_Ujian'] = date("Y-m-d", strtotime($p['Tgl_Ujian']));
        
        $res1=$this->db->update('tb_pmb_tr_camaba',array("isUjian"=>$p["isUjian"],"Jalur_Penerimaan"=>$p["Jalur_Penerimaan"]),array("Id_Camaba"=>$p['Id_Camaba']));
        
        if(strtoupper($p['isUjian'])=='YES'){
            $isExistUjian=$this->app_model->isUjianExist($p['Id_Camaba']);
            if($isExistUjian['isExist']){            
                $res2=$this->app_model->setUjianUpdate($data);
            }else{
                $res2=$this->app_model->setUjianInsert($data);    
            };   
        }else $res2=$this->app_model->setUjianHapus($data);
        
        $res3=$this->db->delete('tb_pmb_tr_draft_no_ujian',array("Id_Camaba"=>$p['Id_Camaba']));
        //Syarat Daftar
        $res3=$this->db->delete('tb_pmb_tr_syaratdaftar_camaba',array("Id_Camaba"=>$p['Id_Camaba']));
        $syaratDaftar=explode(',',$p['syaratDaftar']);
        if(isset($syaratDaftar[0]) && !empty($syaratDaftar[0])){
            foreach($syaratDaftar as $i=>$s){
                $syarat=explode('is',$s);
                $syaratCamaba[$i]['Id_Camaba']=$p['Id_Camaba'];
                $syaratCamaba[$i]['Id_SyaratDaftar']=$syarat[0];
                $syaratCamaba[$i]['is_Passed']=$syarat[1];
                $syaratCamaba[$i]=$this->addInsertLog($syaratCamaba[$i]);
            }
            $res3=$this->db->insert_batch('tb_pmb_tr_syaratdaftar_camaba',$syaratCamaba);   
        }else $res3=true;
        
        if ($this->db->trans_status() === FALSE || !$res1 || !$res2 || !$res3)
        {
            $res['isSuccess']=false;
            $res['msg']='Gagal menyimpan perubahan';
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            $res['isSuccess']=true;
            $res['msg']='';    
        }   		
		if($res['isSuccess']){
            $p['Email']=$this->app_model->getEmailById($p['Id_Camaba']);
            if(strtolower($data['isUjian'])=='yes'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],4,11);
              $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Jadwal ujian anda telah ditentukan.',"#");
              }
            else
            if(strtolower($data['isUjian'])=='no'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],4,10);
              $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Anda tidak perlu mengikuti ujian.',"#");
              }
            else{
                $this->app_model->updateLangkahPendaftaranCamaba($p['Email'],4,9 );
                $this->system_model->writeNotifForUser($this->config->item('application_id')
                ,$p['Email'],'Menunggu setting ujian dari operator',"#");   
            }
		}
        echo json_encode($res);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
