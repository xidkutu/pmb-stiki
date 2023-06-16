<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_Model extends CI_Model {

	/**
	 * @author : omar hamdani
	 * @web : 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
    public function dbGetUnReadMessage(){
        $usr=$this->session->userdata('username');
        $res=$this->db->query("SELECT
            	Id_Message,
            	Sender,
            	Reciever,
            	CONCAT(
            		SUBSTRING_INDEX(Message_Content, ' ', 10),
            		'...'
            	) AS Message_Teaser,
            	DATE_FORMAT(Sending_Time,'%d/%m/%y %h:%i:%s') AS Sending_Time,
            	Read_Time,
            	`Status`,
            	Starred,
            	IFNULL(Nama_Mhs,CONCAT(IFNULL(gelar_depan,''),nama,IFNULL(gelar_belakang,''))) AS Sender_Name,
            	CONCAT(Domain,Direktori,NamaFile) AS photo
            FROM
            	tb_app_tr_messages msg INNER JOIN tb_app_rf_user usr ON msg.Sender=usr.user_username
            LEFT JOIN tb_peg_rf_pegawai peg ON usr.NIP=peg.nip
            LEFT JOIN tb_akd_rf_mahasiswa mhs ON usr.NRP=mhs.NRP
            LEFT JOIN tb_app_rf_files files ON peg.IDFile=files.IDFile
            WHERE
            	Reciever = '$usr'
            AND `Status` <> 'Read'
            GROUP BY
            	Sender
            ORDER BY
            	Sending_Time DESC");
        
        return $res; 
    }
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */