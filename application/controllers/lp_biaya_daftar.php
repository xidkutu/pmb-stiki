<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lp_biaya_daftar extends MY_Form_Camaba {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : Controller untuk asal informasi
	 **/
	
	public function index($key='')
	{
	    
		$genForm=genFormInputByClass($this->mydata['page_id']);
        $this->mydata=array_merge($this->mydata,$genForm);
        
        $this->mydata['key']=transHtmlCode($key);
        $this->mydata['jsInclude']=getJsIncludeFormByClass('tr_pmb_insert_data');
        //Load Modal
        $this->mydata['modal']=$this->load->view('lp/bayar_daftar/modal_detail',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('lp/bayar_daftar/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function get_datatable()
	{		
        $this->load->library('datatable');
        
		$tglmulai = $this->input->get('tglmulai');
        $tglsmp   = $this->input->get('tglsmp');

        if ($tglmulai==''){            
            $where = " YEAR(tgl) = YEAR(CURDATE()) AND MONTH(reg.tgl) = MONTH(CURDATE()) ";
        }else{
            $where = " byrDftr.Tanggal_Bayar between '".$tglmulai."' and '".$tglsmp."' ";
            //$where = " and presensi.tgl between '2015-05-04' and '2015-05-04' ";
        }
            	
        $kolom = array('tgl','nama','nominal','Prodi','isAproved','email','telp','options-no-db');        
		$pk = 'email';
		$sql = '
			(
				SELECT DATE_FORMAT(Tanggal_Bayar, \'%d-%m-%Y\') AS tgl,Username_Reg AS email,reg.nama,CONCAT(\'Rp. \', FORMAT(Nominal, 2)) AS nominal,
                GROUP_CONCAT(CONCAT(plh_prd.pilihan_ke,\'. \',prd.Jenjang,\' \',prd.Nama_Prodi) ORDER BY plh_prd.pilihan_ke SEPARATOR \'<br />\') AS Prodi,isAproved
                FROM tb_pmb_tr_bayar_daftar byrDftr
                INNER JOIN tb_pmb_tr_camaba_reg reg ON byrDftr.Username_Reg = reg.email  
                LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
                LEFT JOIN tb_pmb_tr_pilihan_prodi plh_prd ON camaba.Id_Camaba=plh_prd.id_camaba
                LEFT JOIN tb_akd_rf_prodi prd ON plh_prd.prodi=prd.Kode_Prodi
                WHERE '.$where.'  
                GROUP BY
                	byrDftr.Username_Reg
                order by byrDftr.Tanggal_Bayar DESC
				
			)';
			//and YEAR(presensi.tgl) = YEAR(CURDATE()) AND MONTH(presensi.tgl) = MONTH(CURDATE())
		
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
				$row->tgl,				
				$row->email,
				$row->nama,
				$row->nominal,
                $row->Prodi,
				$row->isAproved,								
				'<div class="btn-group"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i></a>
					 <ul class="dropdown-menu pull-right text-left">
							<li><a class="clickable" onclick="lihat_'.$this->mydata['page_id'].'(\''.$row->email.'\')" data-toggle="modal" data-target="#main-modal-lg">Lihat detail</a></li>
					 </ul>
				</div>' 
			);
		}
		$data->data = $new_data; 
		
		echo json_encode($data);
	}
    
    public function getDetaiStatus(){
        $res=$this->app_model->getDetailOfBayarDaftar($this->input->post('id'));
        echo json_encode($res);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
    