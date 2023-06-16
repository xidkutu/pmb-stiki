<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tr_verifikasi_bayar_daftar extends MY_Form_Camaba {

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
        $this->mydata['modal']=$this->load->view('tr/verifikasi_bayar_daftar/modal_input',$this->mydata,true);
        
        $this->mydata['content']=$this->load->view('tr/verifikasi_bayar_daftar/content',$this->mydata,true);
        $this->load->view('main_page',$this->mydata);
	}
    
    function get_datatable()
	{		
        $this->load->library('datatable');
        $tahun=$this->system_model->getConfigItem('tahun_penerimaan');
        
		$tglmulai = $this->input->get('tglmulai');
        $tglsmp   = $this->input->get('tglsmp');

        if ($tglmulai==''){            
            $where = " YEAR(tgl) = YEAR(CURDATE()) AND MONTH(tgl) = MONTH(CURDATE()) ";
        }else{
            $where = " Tanggal_Bayar between '".$tglmulai."' and '".$tglsmp."' ";            
        }
            	
        $kolom = array('tgl','email', 'nama', 'nominal',  'isAproved','options-no-db');        
		$pk = 'Email';
		$sql = '
			(
				SELECT
                	Username_Reg AS email,
                	reg.nama,
                	CONCAT(\'Rp. \', FORMAT(Nominal, 2)) AS nominal,
                	DATE_FORMAT(Tanggal_Bayar,\'%d-%m-%Y\') AS tgl,
                	isAproved
                FROM
                	tb_pmb_tr_bayar_daftar byrDftr INNER JOIN tb_pmb_tr_camaba_reg reg ON byrDftr.Username_Reg=reg.email   
				WHERE '.$where.' AND reg.Tahun_Penerimaan="'.$tahun.'"  order by tgl DESC
				
			)';					
        
		$data = $this->datatable->render($kolom, $sql, $pk, true, true);
		
		$new_data = array();
		if(is_array($data->data)) foreach ($data->data as $row)
		{
			$new_data[] = array(
                $row->tgl,
                $row->email,
                $row->nama,
                $row->nominal,
                $row->isAproved,
                '<div class="btn-group"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i></a>
                   <ul class="dropdown-menu pull-right text-left">
                      <li><a href="#" onclick="'.'edit_'.trim($this->mydata['page_id']).'(&quot;'.trim($row->email).'&quot;)'.'">Verifikasi</a></li>
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
    public function simpan()
	{
	    $p=$this->input->post();
        $data=$p;
        $data=mappingColumn("tb_pmb_tr_bayar_daftar",$data);
        $key = array(
            'Username_Reg' => $data['Username_Reg'],
        );
        $data=$this->addUpdateLog($data);
        $res['isSuccess']=$this->db->update('tb_pmb_tr_bayar_daftar',$data,$key);
		if($res['isSuccess']){
		  $this->system_model->writeNotifForUser($this->config->item('application_id')
            ,$data['Username_Reg'],'Pembayaran biaya pendaftaran anda sudah '.$data['isAproved'],base_url().'index.php/biaya_daftar');
            
            if(strtolower($data['isAproved'])=='diterima'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($data['Username_Reg'],2,5);}
            else
            if(strtolower($data['isAproved'])=='menunggu verifikasi'){            
		      $this->app_model->updateLangkahPendaftaranCamaba($data['Username_Reg'],3,3);}
            else
                $this->app_model->updateLangkahPendaftaranCamaba($data['Username_Reg'],3,4);
		}
        echo json_encode($res);
	}
    public function kirim_email_verifikasi_bayar($penerima,$status){
        $pengirim   = 'STIKI PMB Online';
        $subyek     = 'Verifikasi Pembayaran Biaya Pendaftaran';
        $pesan      = '<strong>Ini untuk login</strong> :<br/> Email User : '.$email.'<br/>Password : '.$pwdnya;
        $this->kirim_email($pengirim,$penerima,$subyek,$pesan);
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
