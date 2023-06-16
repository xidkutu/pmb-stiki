<p>Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?></b> di Sistem Informasi Penerimaan Mahasiswa Baru (SIMARU) STIKI Malang.</p>
<br />
<table class="list" width="100%">
	<thead>
    <td class="btn" colspan="6"><center><b>Beranda</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/rf_pmb_camaba"><img src="<?php echo base_url();?>asset/images/data_maba.png" /><br />
        <b>Data Maba</b></a>
        </td>
        <td align="center" width="20%"><a href="<?php echo base_url();?>index.php/rf_pmb_validasi"><img src="<?php echo base_url();?>asset/images/validasi.png" /><br />
        <b>Validasi Pembayaran</b></a>
        </td>
        <td  class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/rf_statistik_informasi"><img src="<?php echo base_url();?>asset/images/statistik_info.png" /><br />
        <b>Statistik Informasi</b></a>
        </td>
		<td align="center" width="20%"><a href="<?php echo base_url();?>index.php/lp_pmb_camaba"><img src="<?php echo base_url();?>asset/images/report.png" /><br />
        <b>Laporan maba</b></a>
        </td>
        <td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/tr_pmb_insert_data"><img src="<?php echo base_url();?>asset/images/insert.png" /><br />
        <b>Tambah Data Mhs</b></a>
        </td>
	</tr>       
</table> 
