<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rep_Model extends MY_Model {

	/**
	 * @author : Ahmad Rianto
	 **/
     public $tahun;
     function __construct() {
		parent::__construct();
        $this->tahun=$this->getConfigItem('tahun_penerimaan');
	}
     function getStatProv_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	prov.Kode_Prop,
            	Nama_Prop,
            	COUNT(camaba.email) N
            FROM
            	tb_akd_rf_propinsi prov INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop=kota.Kode_Prop
            LEFT JOIN tb_pmb_tr_camaba_reg camaba ON camaba.Kode_Kota=kota.Kode_Kota
            AND (camaba.tgl BETWEEN '$tglStart 00:00:00' AND '$tglEnd 23:59:59')
            AND camaba.Tahun_Penerimaan='".$this->tahun."'
            WHERE
            	isAktif = 'YES'
            GROUP BY
            	Kode_Prop
            ORDER BY
            	N DESC, Nama_Prop");
     }
     function getDetailProv_Pendaftar($kodeProv,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	reg.nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_propinsi prov
        INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop = kota.Kode_Prop
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_Kota = kota.Kode_Kota
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba=ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND kota.Kode_Prop='$kodeProv'
        ORDER BY
        	No_Ujian,nama");
     }
     function getStatProv_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	prov.Kode_Prop,
        	Nama_Prop,
        	COUNT(camaba.email) N
        FROM
        	tb_akd_rf_propinsi prov
        INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop = kota.Kode_Prop
        LEFT JOIN (
        	tb_pmb_tr_camaba camaba
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.email=camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Alamat_Kode_Kota = kota.Kode_Kota
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang >= '$tglStart 00:00:00'
        	AND dftrUlang.Tgl_DaftarUlang <= '$tglEnd 23:59:59'
        )
        WHERE
        	isAktif = 'YES'
        GROUP BY
        	Kode_Prop
        ORDER BY
        	N DESC,
        	Nama_Prop");
     }
     function getDetailProv_Mhs($kodeProv,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs as nama,
            	camaba.email,
            	camaba.telp
            FROM
            	tb_akd_rf_propinsi prov
            INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop = kota.Kode_Prop
            INNER JOIN (
            	tb_pmb_tr_camaba camaba
                INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.email=camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
            ) ON camaba.Alamat_Kode_Kota = kota.Kode_Kota
            AND dftrUlang.isDaftar_Ulang = 'YES'
            AND (
            	dftrUlang.Tgl_DaftarUlang >= '$tglStart 00:00:00'
            	AND dftrUlang.Tgl_DaftarUlang <= '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON ujian.Id_Camaba=camaba.Id_Camaba
            WHERE
            	isAktif = 'YES'
            AND kota.Kode_Prop='$kodeProv'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     function getStatProv_PembayaranDiterima($tglStart,$tglEnd){
        return $this->db->query("SELECT
                	prov.Kode_Prop,
                	Nama_Prop,
                	COUNT(camaba.email) N
                FROM
                	tb_akd_rf_propinsi prov INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop=kota.Kode_Prop
                LEFT JOIN (
                	tb_pmb_tr_camaba_reg camaba INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg = camaba.email 
                    and bayar.isAproved = 'Diterima'
                ) ON camaba.Kode_Kota=kota.Kode_Kota
                AND camaba.Tahun_Penerimaan='".$this->tahun."'
                AND (bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00' AND '$tglEnd 23:59:59')
                WHERE
                	isAktif = 'YES' 
                GROUP BY
                	Kode_Prop
                ORDER BY
                	N DESC, Nama_Prop");
     }
     function getDetailProv_PembayaranDiterima($kodeProv,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	reg.nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_propinsi prov
        INNER JOIN tb_glb_rf_kota kota ON prov.Kode_Prop = kota.Kode_Prop
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_Kota = kota.Kode_Kota
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg=reg.email AND bayar.isAproved='Diterima'
        AND (
        	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba=ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND kota.Kode_Prop='$kodeProv'
        ORDER BY
        	No_Ujian,nama");
     }
     function getStatKota_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	kota.Kode_Kota,
        	CONCAT(kota.Kota_Kabupaten,' ',Nama_Kota) AS Nama_Kota,
        	COUNT(reg.email) AS N
        FROM
        	tb_glb_rf_kota kota
        INNER JOIN tb_pmb_tr_camaba_reg reg ON kota.Kode_Kota = reg.Kode_Kota
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        GROUP BY
        	kota.Kode_Kota
        ORDER BY
        	N DESC,
        	Nama_Kota");
     }
     function getDetailKota_Pendaftar($kodeKota,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	reg.nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_glb_rf_kota kota
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_Kota = kota.Kode_Kota
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba=ujian.Id_Camaba
        WHERE
        	kota.Kode_Kota='$kodeKota'
        ORDER BY
        	No_Ujian,nama");
     }
     function getStatKota_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	kota.Kode_Kota,
            	CONCAT(
            		kota.Kota_Kabupaten,
            		' ',
            		Nama_Kota
            	) AS Nama_Kota,
            	COUNT(reg.email) AS N
            FROM
            	tb_glb_rf_kota kota
            INNER JOIN tb_pmb_tr_camaba_reg reg ON kota.Kode_Kota = reg.Kode_Kota
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND bayar.isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            GROUP BY
            	kota.Kode_Kota
            ORDER BY
            	N DESC,
            	Nama_Kota");
     }
     function getDetailKota_Bayar($kodeKota,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	reg.nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_glb_rf_kota kota
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_Kota = kota.Kode_Kota
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg=reg.email AND isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	kota.Kode_Kota = '$kodeKota'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     function getStatKota_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	kota.Kode_Kota,
        	CONCAT(kota.Kota_Kabupaten,' ',Nama_Kota) AS Nama_Kota,
        	COUNT(camaba.email) AS N
        FROM
        	tb_glb_rf_kota kota
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
            INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Alamat_Kode_Kota = kota.Kode_Kota
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        GROUP BY
        	kota.Kode_Kota
        ORDER BY
        	N DESC,
        	Nama_Kota");
     }
     function getDetailKota_Mhs($kodeProv,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs as nama,
            	camaba.email,
            	camaba.telp
            FROM
                tb_glb_rf_kota kota
            INNER JOIN (
                tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
            ) ON camaba.Alamat_Kode_Kota = kota.Kode_Kota
            AND dftrUlang.isDaftar_Ulang = 'YES'
            AND (
            	dftrUlang.Tgl_DaftarUlang >= '$tglStart 00:00:00'
            	AND dftrUlang.Tgl_DaftarUlang <= '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON ujian.Id_Camaba=camaba.Id_Camaba
            WHERE
            	kota.Kode_Kota='$kodeProv'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     
     function getStatSch_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	sch.Kode_SMU,
        	sch.Asal_SMU,
        	CONCAT(kota.Kota_Kabupaten,' ',Nama_Kota) AS Kota,
        	Nama_Prop,
        	COUNT(reg.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop=prov.Kode_Prop
        GROUP BY
        	sch.Kode_SMU
        ORDER BY
        	N DESC,
        	Asal_SMU");
     }
     
     function getStatProvSch_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	kota.Kode_Prop,
            	Nama_Prop,
            	COUNT(reg.email) AS N
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            AND (
            	reg.tgl BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
            LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop=prov.Kode_Prop
            GROUP BY
            	kota.Kode_Prop
            ORDER BY
            	N DESC,
            	Nama_Prop");
     }
     
     function getStatKotaSch_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	sch.Kode_Kota,
        	CONCAT(
        		kota.Kota_Kabupaten,
        		' ',
        		Nama_Kota
        	) AS Kota,
        	Nama_Prop,
        	COUNT(reg.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
        GROUP BY
        	sch.Kode_Kota
        ORDER BY
        	N DESC,
        	Asal_SMU");
     }
     
     function getStatSch_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	sch.Kode_SMU,
        	sch.Asal_SMU,
        	CONCAT(
        		kota.Kota_Kabupaten,
        		' ',
        		Nama_Kota
        	) AS Kota,
        	Nama_Prop,
        	COUNT(camaba.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN (
            tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Kode_SMU = sch.Kode_SMU
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
        GROUP BY
        	sch.Kode_SMU
        ORDER BY
        	N DESC,
        	Asal_SMU");
     }
     
     function getStatProvSch_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	prov.Kode_Prop,
        	Nama_Prop,
        	COUNT(camaba.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Kode_SMU = sch.Kode_SMU
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
        GROUP BY
        	prov.Kode_Prop
        ORDER BY
        	N DESC,
        	Nama_Prop");
     }
     
     function getStatKotaSch_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	sch.Kode_Kota,
        	CONCAT(
        		kota.Kota_Kabupaten,
        		' ',
        		Nama_Kota
        	) AS Kota,
        	Nama_Prop,
        	COUNT(camaba.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Kode_SMU = sch.Kode_SMU
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
        GROUP BY
        	sch.Kode_Kota
        ORDER BY
        	N DESC,
        	Kota");
     }
     
     function getDetailSch_Pendaftar($Kode_SMU,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email=reg.email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba=ujian.Id_Camaba
        WHERE
        	reg.Kode_SMU = '$Kode_SMU'
        ORDER BY
        	No_Ujian,nama ASC");
     }
     
     function getDetailSch_Mhs($Kode_SMU,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs as nama,
            	camaba.email,
            	camaba.telp
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN (
            	tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
            ) ON camaba.Kode_SMU = sch.Kode_SMU
            AND dftrUlang.isDaftar_Ulang='YES'
            AND (
            	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	camaba.Kode_SMU = '$Kode_SMU'
            ORDER BY
            	No_Ujian,nama ASC");
     }
     
     function getDetailProvSch_Pendaftar($Kode_Prov,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.Tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        INNER JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
        LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email = reg.email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	kota.Kode_Prop='$Kode_Prov'
        ORDER BY
        	No_Ujian,
        	nama ASC");
     }
     
     function getDetailProvSch_Mhs($Kode_Prov,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	camaba.email,
        	camaba.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Kode_SMU = sch.Kode_SMU
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        INNER JOIN tb_glb_rf_kota kota ON sch.Kode_Kota=kota.Kode_Kota
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	kota.Kode_Prop = '$Kode_Prov'
        ORDER BY
        	No_Ujian,
        	nama ASC");
     }
     
     function getDetailKotaSch_Pendaftar($Kode_Kota,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        AND (
        	reg.Tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email = reg.email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	sch.Kode_Kota='$Kode_Kota'
        ORDER BY
        	No_Ujian,
        	nama ASC");
     }
     
     function getDetailKotaSch_Mhs($Kode_Kota,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	camaba.email,
        	camaba.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON camaba.email=reg.email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON camaba.Kode_SMU = sch.Kode_SMU
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	sch.Kode_Kota = '$Kode_Kota'
        ORDER BY
        	No_Ujian,
        	nama ASC");
     }
     function getStatSch_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	sch.Kode_SMU,
        	sch.Asal_SMU,
        	CONCAT(
        		kota.Kota_Kabupaten,
        		' ',
        		Nama_Kota
        	) AS Kota,
        	Nama_Prop,
        	COUNT(reg.email) AS N
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND bayar.isAproved='Diterima'
        AND (
        	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
        LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
        GROUP BY
        	sch.Kode_SMU
        ORDER BY
        	N DESC,
        	Asal_SMU");
     }
     function getDetailSch_Bayar($Kode_SMU,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_asal_sekolah sch
        INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND isAproved='Diterima'
        AND (
        	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email = reg.email
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	reg.Kode_SMU = '$Kode_SMU'
        ORDER BY
        	No_Ujian,
        	nama ASC");
     }
     function getStatProvSch_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	kota.Kode_Prop,
            	Nama_Prop,
            	COUNT(reg.email) AS N
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg=reg.email AND bayar.isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
            LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
            GROUP BY
            	kota.Kode_Prop
            ORDER BY
            	N DESC,
            	Nama_Prop");
     }
     function getDetailProvSch_Bayar($Kode_Prov,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg=reg.email AND bayar.isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            INNER JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
            LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email = reg.email
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	kota.Kode_Prop = '$Kode_Prov'
            ORDER BY
            	No_Ujian,
            	nama ASC");
     }
     function getStatKotaSch_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	sch.Kode_Kota,
            	CONCAT(
            		kota.Kota_Kabupaten,
            		' ',
            		Nama_Kota
            	) AS Kota,
            	Nama_Prop,
            	COUNT(reg.email) AS N
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_glb_rf_kota kota ON sch.Kode_Kota = kota.Kode_Kota
            LEFT JOIN tb_akd_rf_propinsi prov ON kota.Kode_Prop = prov.Kode_Prop
            GROUP BY
            	sch.Kode_Kota
            ORDER BY
            	N DESC,
            	Asal_SMU");
     }
     function getDetailKotaSch_Bayar($Kode_Kota,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_akd_rf_asal_sekolah sch
            INNER JOIN tb_pmb_tr_camaba_reg reg ON reg.Kode_SMU = sch.Kode_SMU
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND bayar.isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_camaba camaba ON camaba.Email = reg.email
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	sch.Kode_Kota = '$Kode_Kota'
            ORDER BY
            	No_Ujian,
            	nama ASC");
     }
     function getStatJalurUsul_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	Id_JalurPenerimaan,
            	Nama_JalurPenerimaan,
            	COUNT(camaba.Id_Camaba) AS N
            FROM
            	tb_pmb_rf_jalur_penerimaan jalur
            LEFT JOIN (
            tb_pmb_tr_camaba_reg reg
            INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            ) ON jalur.Id_JalurPenerimaan=camaba.Usulan_Jalur_Penerimaan
            AND (
            	reg.Tgl BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            WHERE
            	isAktif = 'YES'
            GROUP BY
            	jalur.Id_JalurPenerimaan
            ORDER BY
            	N DESC,
            	Nama_JalurPenerimaan");
     }
     function getStatJalurUsul_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_JalurPenerimaan,
        	Nama_JalurPenerimaan,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        LEFT JOIN (
        tb_pmb_tr_camaba_reg reg 
        INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON jalur.Id_JalurPenerimaan=camaba.Usulan_Jalur_Penerimaan
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        WHERE
        	isAktif = 'YES'
        GROUP BY
        	jalur.Id_JalurPenerimaan
        ORDER BY
        	N DESC,
        	Nama_JalurPenerimaan");
     }
     
     function getStatJalurBeri_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	Id_JalurPenerimaan,
            	Nama_JalurPenerimaan,
            	COUNT(camaba.Id_Camaba) AS N
            FROM
            	tb_pmb_rf_jalur_penerimaan jalur
            LEFT JOIN (
            tb_pmb_tr_camaba_reg reg 
            INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
            ) ON jalur.Id_JalurPenerimaan=camaba.Jalur_Penerimaan
            AND (
            	reg.Tgl BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            WHERE
            	isAktif = 'YES'
            GROUP BY
            	jalur.Id_JalurPenerimaan
            ORDER BY
            	N DESC,
            	Nama_JalurPenerimaan");
     }
     
     function getStatJalurBeri_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_JalurPenerimaan,
        	Nama_JalurPenerimaan,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        LEFT JOIN (
        tb_pmb_tr_camaba_reg reg 
        INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
        AND reg.Tahun_Penerimaan='".$this->tahun."'
        INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON jalur.Id_JalurPenerimaan=camaba.Jalur_Penerimaan
        AND dftrUlang.isDaftar_Ulang='YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        WHERE
        	isAktif = 'YES'
        GROUP BY
        	jalur.Id_JalurPenerimaan
        ORDER BY
        	N DESC,
        	Nama_JalurPenerimaan");
     }
     function getDetailStatJalurUsul_Pendaftar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs AS nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_pmb_rf_jalur_penerimaan jalur
            LEFT JOIN (
            	tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            ) ON jalur.Id_JalurPenerimaan = camaba.Usulan_Jalur_Penerimaan
            AND (
            	reg.Tgl BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	isAktif = 'YES'
            AND Id_JalurPenerimaan='$id'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     function getDetailStatJalurUsul_Mhs($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON jalur.Id_JalurPenerimaan = camaba.Usulan_Jalur_Penerimaan
        AND dftrUlang.isDaftar_Ulang = 'YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND Id_JalurPenerimaan='$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     
     function getDetailStatJalurBeri_Pendaftar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        ) ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
        AND (
        	reg.Tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND Id_JalurPenerimaan='$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     
     function getDetailStatJalurBeri_Mhs($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        ) ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
        AND dftrUlang.isDaftar_Ulang = 'YES'
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND Id_JalurPenerimaan='$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     function getStatJalurUsul_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_JalurPenerimaan,
        	Nama_JalurPenerimaan,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND bayar.isAproved='Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON jalur.Id_JalurPenerimaan = camaba.Usulan_Jalur_Penerimaan
        WHERE
        	isAktif = 'YES'
        GROUP BY
        	jalur.Id_JalurPenerimaan
        ORDER BY
        	N DESC,
        	Nama_JalurPenerimaan");
     }
     function getDetailStatJalurUsul_Bayar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg=reg.email AND bayar.isAproved='Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON jalur.Id_JalurPenerimaan = camaba.Usulan_Jalur_Penerimaan
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND Id_JalurPenerimaan = '$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     function getStatJalurBeri_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_JalurPenerimaan,
        	Nama_JalurPenerimaan,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON bayar.Username_Reg = reg.email
        	AND bayar.isAproved = 'Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
        WHERE
        	isAktif = 'YES'
        GROUP BY
        	jalur.Id_JalurPenerimaan
        ORDER BY
        	N DESC,
        	Nama_JalurPenerimaan");
     }
     function getDetailStatJalurBeri_Bayar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_jalur_penerimaan jalur
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email = bayar.Username_Reg
        	AND bayar.isAproved = 'Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON jalur.Id_JalurPenerimaan = camaba.Jalur_Penerimaan
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	isAktif = 'YES'
        AND Id_JalurPenerimaan = '$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     function getStatProdi_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_KelasKuliah,
        	Nama_Prodi,
        	Jenjang,
        	klsMhs.Kelas_Deskripsi,
            CONCAT(Jenjang,' ',Nama_Prodi,' (',Kelas_Deskripsi,')') AS caption,
        	count(Id_Camaba) AS N
        FROM
        	tb_akd_rf_kelas_kuliah kelasKul
        INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi=prodi.Kode_Prodi
        INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas=klsMhs.Kelas_Mhs
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        ) ON camaba.Kode_Prodi = prodi.Kode_Prodi AND camaba.Kelas=kelasKul.Kelas
        AND (
        	reg.Tgl BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        WHERE
        	kelasKul.isAktif='YES'
        GROUP BY
        	kelasKul.Id_KelasKuliah
        ORDER BY
        	N DESC,
            Jenjang,
        	Nama_Prodi,
        	Kelas_Deskripsi");
     }
     
     function getStatProdi_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	Id_KelasKuliah,
        	Nama_Prodi,
        	Jenjang,
        	klsMhs.Kelas_Deskripsi,
        	CONCAT(Jenjang,' ',Nama_Prodi,' (',Kelas_Deskripsi,')') AS caption,
        	count(camaba.Id_Camaba) AS N
        FROM
        	tb_akd_rf_kelas_kuliah kelasKul
        INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi=prodi.Kode_Prodi
        INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas=klsMhs.Kelas_Mhs
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        	AND dftrUlang.isDaftar_Ulang='YES'
        ) ON camaba.Kode_Prodi = prodi.Kode_Prodi AND camaba.Kelas=kelasKul.Kelas
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        WHERE
        	kelasKul.isAktif='YES'
        GROUP BY
        	kelasKul.Id_KelasKuliah
        ORDER BY
        	N DESC,
        	Jenjang,
        	Nama_Prodi,
        	Kelas_Deskripsi");
     }
     
     function getDetailStatProdi_Pendaftar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs AS nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_akd_rf_kelas_kuliah kelasKul
            INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi = prodi.Kode_Prodi
            INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas = klsMhs.Kelas_Mhs
            LEFT JOIN (
            	tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            ) ON camaba.Kode_Prodi = prodi.Kode_Prodi
            AND camaba.Kelas = kelasKul.Kelas
            AND (
            	reg.Tgl BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	kelasKul.isAktif = 'YES'
            AND kelasKul.Id_KelasKuliah='$id'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     
     function getDetailStatProdi_Mhs($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_akd_rf_kelas_kuliah kelasKul
        INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi = prodi.Kode_Prodi
        INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas = klsMhs.Kelas_Mhs
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlang ON camaba.Id_Camaba = dftrUlang.Id_Camaba
        	AND dftrUlang.isDaftar_Ulang = 'YES'
        ) ON camaba.Kode_Prodi = prodi.Kode_Prodi
        AND camaba.Kelas = kelasKul.Kelas
        AND (
        	dftrUlang.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	kelasKul.isAktif = 'YES'
        AND kelasKul.Id_KelasKuliah='$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     function getStatProdi_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
            	Id_KelasKuliah,
            	Nama_Prodi,
            	Jenjang,
            	klsMhs.Kelas_Deskripsi,
            	CONCAT(
            		Jenjang,
            		' ',
            		Nama_Prodi,
            		' (',
            		Kelas_Deskripsi,
            		')'
            	) AS caption,
            	count(Id_Camaba) AS N
            FROM
            	tb_akd_rf_kelas_kuliah kelasKul
            INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi = prodi.Kode_Prodi
            INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas = klsMhs.Kelas_Mhs
            LEFT JOIN (
            	tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email=bayar.Username_Reg AND bayar.isAproved='Diterima'
            AND (
            	bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            	AND '$tglEnd 23:59:59'
            )
            ) ON camaba.Kode_Prodi = prodi.Kode_Prodi
            AND camaba.Kelas = kelasKul.Kelas
            WHERE
            	kelasKul.isAktif = 'YES'
            GROUP BY
            	kelasKul.Id_KelasKuliah
            ORDER BY
            	N DESC,
            	Jenjang,
            	Nama_Prodi,
            	Kelas_Deskripsi");
     }
     function getDetailStatProdi_Bayar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	camaba.Nama_Mhs AS nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_akd_rf_kelas_kuliah kelasKul
            INNER JOIN tb_akd_rf_prodi prodi ON kelasKul.Prodi = prodi.Kode_Prodi
            INNER JOIN tb_akd_rf_kelas_mhs klsMhs ON kelasKul.Kelas = klsMhs.Kelas_Mhs
            LEFT JOIN (
            	tb_pmb_tr_camaba_reg reg
            	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email = bayar.Username_Reg
            	AND bayar.isAproved = 'Diterima'
            	AND (
            		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
            		AND '$tglEnd 23:59:59'
            	)
            ) ON camaba.Kode_Prodi = prodi.Kode_Prodi
            AND camaba.Kelas = kelasKul.Kelas
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	kelasKul.isAktif = 'YES'
            AND kelasKul.Id_KelasKuliah = '$id'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     function getStatInfo_Pendaftar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	info.Id_Informasi,
        	Nama_Informasi,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_asal_informasi info
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg 
            INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        ) ON camaba.Id_Informasi=info.Id_Informasi
        AND (
        		reg.tgl BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        WHERE
        	info.isAktif='YES'
        GROUP BY
        	info.Id_Informasi
        ORDER BY
        	N DESC,
        	Nama_Informasi ASC");
     }
     
     function getStatInfo_Mhs($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	info.Id_Informasi,
        	Nama_Informasi,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_asal_informasi info
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlg ON camaba.Id_Camaba = dftrUlg.Id_Camaba
        	AND dftrUlg.isDaftar_Ulang = 'YES'
        ) ON camaba.Id_Informasi = info.Id_Informasi
        AND (
        	dftrUlg.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        WHERE
        	info.isAktif = 'YES'
        GROUP BY
        	info.Id_Informasi
        ORDER BY
        	N DESC,
        	Nama_Informasi ASC");
     }
     
     function getDetailStatInfo_Mhs($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	camaba.Nama_Mhs AS nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_asal_informasi info
        INNER JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_daftar_ulang dftrUlg ON camaba.Id_Camaba = dftrUlg.Id_Camaba
        	AND dftrUlg.isDaftar_Ulang = 'YES'
        ) ON camaba.Id_Informasi = info.Id_Informasi
        AND (
        	dftrUlg.Tgl_DaftarUlang BETWEEN '$tglStart 00:00:00'
        	AND '$tglEnd 23:59:59'
        )
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	info.isAktif = 'YES'
        AND info.Id_Informasi='$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
     
     function getDetailStatInfo_Pendaftar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
            	ujian.No_Ujian,
            	nama,
            	reg.email,
            	reg.telp
            FROM
            	tb_pmb_rf_asal_informasi info
            LEFT JOIN (
            	tb_pmb_tr_camaba_reg reg 
                INNER JOIN tb_pmb_tr_camaba camaba ON reg.email=camaba.Email
                AND reg.Tahun_Penerimaan='".$this->tahun."'
            ) ON camaba.Id_Informasi=info.Id_Informasi
            AND (
            		reg.tgl BETWEEN '$tglStart 00:00:00'
            		AND '$tglEnd 23:59:59'
            	)
            LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
            WHERE
            	info.isAktif = 'YES'
            AND info.Id_Informasi='$id'
            ORDER BY
            	No_Ujian,
            	nama");
     }
     function getStatInfo_Bayar($tglStart,$tglEnd){
        return $this->db->query("SELECT
        	info.Id_Informasi,
        	Nama_Informasi,
        	COUNT(camaba.Id_Camaba) AS N
        FROM
        	tb_pmb_rf_asal_informasi info
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email = bayar.Username_Reg
        	AND bayar.isAproved = 'Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON camaba.Id_Informasi = info.Id_Informasi
        WHERE
        	info.isAktif = 'YES'
        GROUP BY
        	info.Id_Informasi
        ORDER BY
        	N DESC,
        	Nama_Informasi ASC");
     }
     function getDetailStatInfo_Bayar($id,$tglStart,$tglEnd){
        return $this->db->query("SELECT
        	ujian.No_Ujian,
        	nama,
        	reg.email,
        	reg.telp
        FROM
        	tb_pmb_rf_asal_informasi info
        LEFT JOIN (
        	tb_pmb_tr_camaba_reg reg
        	INNER JOIN tb_pmb_tr_camaba camaba ON reg.email = camaba.Email
            AND reg.Tahun_Penerimaan='".$this->tahun."'
        	INNER JOIN tb_pmb_tr_bayar_daftar bayar ON reg.email = bayar.Username_Reg
        	AND bayar.isAproved = 'Diterima'
        	AND (
        		bayar.Tanggal_Bayar BETWEEN '$tglStart 00:00:00'
        		AND '$tglEnd 23:59:59'
        	)
        ) ON camaba.Id_Informasi = info.Id_Informasi
        LEFT JOIN tb_pmb_tr_ujian_masuk ujian ON camaba.Id_Camaba = ujian.Id_Camaba
        WHERE
        	info.isAktif = 'YES'
        AND info.Id_Informasi = '$id'
        ORDER BY
        	No_Ujian,
        	nama");
     }
}