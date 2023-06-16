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
    
    public function retrieveData(){
        $this->load->library('ssp');
        $table = 'vpmb_tr_verifikasi_bayar_daftar';
         
        // Table's primary key
        $primaryKey = 'Email';
        $columns = array(
            array( 'db' => 'Email', 'dt' => 0 ),
            array( 'db' => 'nama',  'dt' => 1 ),
            array( 'db' => 'Frmt_Nominal',   'dt' => 2 ),
            array( 'db' => 'Frmt_Tgl',   'dt' => 3 ),
            array( 'db' => 'isAproved',   'dt' => 4 ),
            array( 'db' => 'action',   'dt' => 5 ),
        );
        
        //print_r($_GET);
        $data=$this->ssp->cust_simple( $_GET, $table, $primaryKey, $columns );
        
        $content=$data['data'];
     
        for($i=0;$i<count($content);$i++){
            //Action dropdown
            $aksiEdit='edit_'.$this->mydata['page_id'].'("'.$content[$i][0].'")';
            $content[$i][5]="<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
                               <ul class='dropdown-menu pull-right text-left'>
                                  <li><a href='#' onclick='$aksiEdit'>Verifikasi</a></li>
                               </ul>
                            </div>";
        }
        $data['data']=$content;
        echo json_encode(
            $data
        );
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
