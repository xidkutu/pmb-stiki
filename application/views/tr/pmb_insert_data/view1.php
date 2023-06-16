<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
    
    $("#view").hide();
    $("#form").show();
    $("#detail").hide(); 
    
 });
 
    $.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return d+'-'+m+'-'+y;
    }

$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/tr_pmb_insert_data');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});


function cekFileUploaded(){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/tr_pmb_insert_data/cekFileUploaded",
			cache	: false,
            dataType : "json",
			success	: function(data){
				
                $("#namaFile").val(data.namaUploaded);
                var temp = document.getElementById("form_photo_img").setAttribute('src',data.filename);
				return false;
			
                 $("#namaFileBerkas").val(data.namaUploaded);
                var temp = document.getElementById("form_url_berkas").setAttribute('src',data.filename);
				return false;
                
            }
		});
}
$("#view").hide();
$("#detail").hide();
$("#form").show();
hideFormEdit();
$("#form_dataDiri").show();

$("#simpan").click(function(){
		var nrp = $("#nrp").val();
        var notes = $("#form_notes").val();
        var prodi = $("#form_prodi").val();  
        var kelas = $("#form_kelas").val(); 
        var tglmasuk = $("#form_tglMasuk"). datebox('getValue');
        var jalurmasuk = $("#form_jalurMasuk").val();     
        var thmasuk = $("#form_tahunMasuk").val();
        var semestermasuk = $("#form_semesterMasuk").val();
        var statusmasuk = $("#form_statusMasuk").val();
        var batasstudi = $("#form_batasStudi").val();
               
        var namaMhs= $("#form_nama").val();
        var alamat = $("#form_alamat").val();
        var kota = $("#form_kota").val();
        var alamatAsal = $("#form_alamatAsal").val();
        var kotaAsalMhs = $("#form_kotaAsal").val();
        var provinsi = $("#form_provinsi").val();
        
        var jk =$("#form_jk:checked").val();
        var tempatLahir =$("#form_tempatLahir").val();
        var anak = $("#form_anak").val();
        var jmlsaudara = $("#form_jmlSdr").val();
        var tanggalLahir =$("#form_tglLahir").datebox('getValue');
        var warganegara = $("#form_wn:checked").val();
        
        var agama = $("#form_agama").val();
        var telepon = $("#form_telepon").val();
        var hp = $("#form_hp").val();
        var email = $("#form_email").val();
        var jurusan = $("#form_jurusan").val();
        var uan = $("#form_nilaiUAN").val();
        var informasi = $("#form_informasi").val();
        
        var pekerjaanMhs = $("#form_pekerjaanMhs").val();
        var namakantor = $("#form_namaKantor").val();
        var alamatkantor = $("#form_alamatKantor").val();
        var teleponkantor = $("#form_teleponKantor").val();
        
        var namaAyah = $("#form_namaAyah").val();
        var noKTPAyah = $("#form_noKTPAyah").val();
        var pekerjaanAyah = $("#form_pekerjaanAyah").val();
        var namaIbu = $("#form_namaIbu").val();
        var noKTPIbu = $("#form_noKTPIbu").val();
        var pekerjaanIbu = $("#form_pekerjaanIbu").val();
        var alamatOrtu = $("#form_alamatOrtu").val();
        var kotaOrtu = $("#form_kotaOrtu").val();
        var teleponOrtu = $("#form_teleponOrtu").val();
        var hpOrtu = $("#form_hpOrtu").val();
        var namaWali = $("#form_namaWali").val();
        var noKTPWali = $("#form_noKTPWali").val();
        var pekerjaanWali = $("#form_pekerjaanWali").val();
        var alamatWali = $("#form_alamatWali").val();
        var kotaWali = $("#form_kotaWali").val();
        var teleponWali = $("#form_teleponWali").val();
        var hpWali = $("#form_hpWali").val();
        var statusReg = $("#form_statusReg").val();
        var statusDaftar = $("#form_statusDaftar").val();
                 
        var sekolah = $("#form_sekolah").val();
//        var alamatsmu = $("#form_alamatSMU").val();
//        var teleponsmu = $("#form_teleponSMU").val();
//        var emailsmu = $("#form_emailSMU").val();
//        var kotaSMU = $("#form_kotaSMU").val();
        
       if (document.getElementById('form_skhun').checked){
            var skhun = "Yes";
        }else
        {
            var skhun = "No";
        }
        if (document.getElementById('form_pasPhoto').checked){
            var photo = "Yes";
        }else
        {
            var photo = "No";
        }
        
        if (document.getElementById('form_akte').checked){
            var akte = "Yes";
        }else
        {
            var akte = "No";
        }
        
        if (document.getElementById('form_ijazah').checked){
            var ijazah = "Yes";
        }else
        {
            var ijazah = "No";
        }
        
        
        //var ijazah = $("#form_ijazah").val();
        
        if (document.getElementById('form_rapor').checked){
            var rapor = "Yes";
        }else
        {
            var rapor = "No";
        }
        
        var saveas =$("#saveas").val();
        var urlFoto = document.getElementById('form_photo_img').getAttribute('src');
        //var url_file_berkas = document.getElementById('form_url_berkas').getAttribute('src');
		
		var string = "nrp="+nrp+"&nomer_tes="+notes+"&prodi="+prodi+"&kelas="+kelas+"&tglMasuk="+tglmasuk+"&jalurMasuk="+jalurmasuk+"&tahunMasuk="+thmasuk+"&semesterMasuk="+semestermasuk+"&statusMasuk="+statusmasuk+"&batasStudi="+batasstudi+
        "&namaMhs="+namaMhs+"&jk="+jk+"&tempatLahir="+tempatLahir+"&anak="+anak+"&jmlSdr="+jmlsaudara+"&tanggalLahir="+tanggalLahir+"&wn="+warganegara+
        "&agama="+agama+"&telepon="+telepon+"&hp="+hp+"&email="+email+"&jurusan="+jurusan+"&UAN="+uan+"&informasi="+informasi+"&alamat="+alamat+"&kota="+kota+"&alamatAsal="+alamatAsal+
        "&kotaAsal="+kotaAsalMhs+"&provinsi="+provinsi+"&pekerjaanMhs="+pekerjaanMhs+"&namaKantor="+namakantor+"&alamatKantor="+alamatkantor+
        "&teleponKantor="+teleponkantor+"&namaAyah="+namaAyah+"&noKTPAyah="+noKTPAyah+
        "&pekerjaanAyah="+pekerjaanAyah+"&namaIbu="+namaIbu+"&noKTPIbu="+noKTPIbu+"&pekerjaanIbu="+pekerjaanIbu+"&alamatOrtu="+alamatOrtu+"&kotaOrtu="+kotaOrtu
        +"&teleponOrtu="+teleponOrtu+"&hpOrtu="+hpOrtu+"&namaWali="+namaWali+"&noKTPWali="+noKTPWali+"&pekerjaanWali="+pekerjaanWali+"&alamatWali="+alamatWali
        +"&kotaWali="+kotaWali+"&teleponWali="+teleponWali+"&hpWali="+hpWali+"&urlFoto="+urlFoto+"&sekolah="+sekolah+""+"&statusReg="+statusReg+"&statusDaftar="+statusDaftar+"&skhun="+skhun+"&pasPhoto="+photo+
        "&akte="+akte+"&ijazah="+ijazah+"&rapor="+rapor+"&saveas="+saveas;
         
         //alert(string);		
		
        if(prodi==0){
			$.messager.show({
				title:'Simaru',
				msg:'Prodi harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_prodi").focus();
			return false;
		}
                      
        if(namaMhs.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Nama mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_nama").focus();
			return false;
		}
        
        if(provinsi==0){
			$.messager.show({
				title:'Simaru',
				msg:'Provinsi harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_provinsi").focus();
			return false;
		}
        
        if(agama==0){
			$.messager.show({
				title:'Simaru',
				msg:'Agama harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_agama").focus();
			return false;
		}
              
        if(hp.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'No HP harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_hp").focus();
			return false;
		}
        
        if(email.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Email harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_email").focus();
			return false;
		}
        
        if(jurusan==0){
			$.messager.show({
				title:'Simaru',
				msg:'Jurusan harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_jurusan").focus();
			return false;
		}
        
        if(informasi==0){
			$.messager.show({
				title:'Simaru',
				msg:'Asal Informasi harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_informasi").focus();
			return false;
		}
              
        if(namaAyah.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Nama ayah mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
            
            $("#page_next_formOrtu").focus();
			$("#form_namaAyah").focus();
			return false;
		}
        
        if(namaIbu.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Nama ibu mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
            $("#form_namaIbu").focus();
			
			return false;
		}
        
       if(namaWali.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Nama Wali mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
            $("#page_next_formWali").focus();
            $("#form_namaWali").focus();
			
			return false;
		} 
                      
             
        if(sekolah=='0'){
			$.messager.show({
				title:'Simaru',
				msg:'Asal Sekolah harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_sekolah").focus();
			return false;
		}       
             
             
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/tr_pmb_insert_data/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
			},
			error : function(xhr, teksStatus, kesalahan) {
				$.messager.show({
					title:'Info',
					msg: 'Server tidak merespon :'+kesalahan,
					timeout:2000,
					showType:'slide'
				});
				return false;
			}	
	});
    return false;
});
$(function() {
	$("#tabelPra tr:even").addClass("stripe1");
	$("#tabelPra tr:odd").addClass("stripe2");
	$("#tabelPra tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});

function showDetailSekolah(id){
var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/tr_pmb_insert_data/detailSekolah",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
            if(data.recNum=='0'){
                var temp = document.getElementById("form_alamatSMU");
                temp.innerHTML='';
                
                var temp = document.getElementById("form_kotaSMU");
                temp.innerHTML='';
                
                var temp = document.getElementById("form_teleponSMU");
                temp.innerHTML='';
                
                var temp = document.getElementById("form_emailSMU");
                temp.innerHTML='';
            }else
            {
            var temp = document.getElementById("form_alamatSMU");
            temp.innerHTML=data.Alamat_SMU;
            
            var temp = document.getElementById("form_kotaSMU");
            temp.innerHTML=data.Kota_SMU;
            
            var temp = document.getElementById("form_teleponSMU");
            temp.innerHTML=data.Telp;
            
            var temp = document.getElementById("form_emailSMU");
            temp.innerHTML=data.Email;
            }
				return false;
			}
	});
}
$("#form_sekolah").change(function(){
   showDetailSekolah($("#form_sekolah").val());
})

//----------------------------------Validasi Input------------------------------------------------------------//

//----------------------------------------------Navigasi Form Edit--------------------------------------
function hideFormEdit(){
    $("#form_dataDiri").hide();
    $("#form_dataOrtu").hide();
    $("#form_dataWali").hide();
    $("#form_dataSMU").hide();
    $("#form_berkas").hide();
    
};

$("#page_next_formOrtu").click(function(){
    hideFormEdit();
    $("#form_dataOrtu").show();
});

$("#page_next_formWali").click(function(){
    hideFormEdit();
    $("#form_dataWali").show();
});

$("#page_next_formSMU").click(function(){
    hideFormEdit();
    $("#form_dataSMU").show();
});

$("#page_next_formSMU").click(function(){
    hideFormEdit();
    $("#form_dataSMU").show();
});

$("#page_next_formBerkas").click(function(){
    hideFormEdit();
    $("#form_berkas").show();
});


$("#page_before_formDiri").click(function(){
    hideFormEdit();
    $("#form_dataDiri").show();
});

$("#page_before_formOrtu").click(function(){
    hideFormEdit();
    $("#form_dataOrtu").show();
});

$("#page_before_formWali").click(function(){
    hideFormEdit();
    $("#form_dataWali").show();
});

$("#page_before_formSekolah").click(function(){
    hideFormEdit();
    $("#form_dataSMU").show();
});

</script>




<!-----------------------Data Diri---------------------------------!>
<!-----------------------Orang Tua---------------------------------!>
<!-----------------------Wali Mahasiswa---------------------------------!>
<!-----------------------Asal Sekolah Menengah---------------------------------!>
<!-----------------------Comment---------------------------------!>

 
<!--
Tampilan VIEW untuk grid data
--!>


<div id="form">
<div id="form_dataDiri">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Entry Data Camaba</div></td>
</tr>
<tr>
	<td width="10%">NRP</td>
    <td width="5">:</td>
    <td width="10%"><input type="text" name="nrp" id="nrp"  size="10" maxlength="9" style="text-transform: uppercase;"/>
    <input type="hidden" name="saveas" id="saveas"  size="10" maxlength="4" />
    <div class="errMsg" id="msg_nip"></div>
    </td>
    <td rowspan="5">
        <img id="form_photo_img" src="" width="200px"/>
        <iframe id="frame_upload" src="<?php echo site_url(); ?>/tr_pmb_insert_data/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:60px;">
        </iframe>
        <input type="hidden" name="namaFile" id="namaFile"  size="50" maxlength="254" />
    </td>
</tr>
<tr>
	<td>Nomer Tes</td>
    <td>:</td>
    <td><input  type="text"  name="form_notes" id="form_notes" size="15" maxlength="20" style="text-transform: uppercase;" /></td>
</tr>

<tr>    
	<td>Prodi</td>
    <td>:</td>
    <td>
    <select name="form_prodi" id="form_prodi" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($prodi->result()as $t){
        ?>    
   <option value="<?php echo $t ->Kode_Prodi;?>"> <?php echo $t->Nama_Prodi;?></option>   
      <?php } ?>       
    </select>
    </td>
</tr>

<tr>
	<td>Kelas</td>
    <td>:</td>
    <td>
    <select name="form_kelas" id="form_kelas" class="combo">
    <option value="0">-PILIH-</option>
    <option value="R">Reguler</option>
    <option value="N">Non-Reguler</option>
    <option value="K">Kerjasama</option>
    </select>
    </td>
</tr>

<tr>
	<td>Tanggal Masuk</td>
    <td>:</td>
    <td><input type="text" name="form_tglMasuk" id="form_tglMasuk" class="easyui-datebox"/></td>
</tr>

<tr>
	<td>Jalur Masuk</td>
    <td>:</td>
    <td>
    <select name="form_jalurMasuk" id="form_jalurMasuk" class="combo">
    <option value="0">-PILIH-</option>
    <option value="Undangan">Undangan</option>
    <option value="Reguler">Reguler</option>
    <option value="BP">Beasiswa Penuh</option>
    <option value="PA">Prestasi Akademik/Non Akademik</option>    
    </select>
    </td>
</tr>

<tr>
	<td>Tahun Masuk</td>
    <td>:</td>
    <td><input type="text" name="form_tahunMasuk" id="form_tahunMasuk"  size="5" maxlength="4" style="text-transform: uppercase;"/></td>
</tr>

<tr>
	<td>Semester Masuk</td>
    <td>:</td>
    <td>
    <select name="form_semesterMasuk" id="form_semesterMasuk" class="combo">
    <option value="0">-PILIH-</option>
    <option value="genap">Genap</option>
    <option value="ganjil">Ganjil</option>
    <option value="pendek_genap">Pendek Genap</option>
    <option value="pendek_ganjil">Pendek Ganjil</option>   
    <option value="1_prf">Periode 1</option>   
    <option value="2_prf">Periode 2</option>
    <option value="3_prf">Periode 3</option>
    </select>
    </td>
</tr>

<tr>
	<td>Status Masuk</td>
    <td>:</td>
    <td>
    <select name="form_statusMasuk" id="form_statusMasuk" class="combo">
    <option value="0">-PILIH-</option>
    <option value="baru">Baru</option>
    <option value="pindahan">Pindahan</option>
    </select>
    </td>
</tr>

<tr>
	<td>Batas Studi</td>
    <td>:</td>
    <td><input type="text" name="form_batasStudi" id="form_batasStudi"  size="5" maxlength="4" style="text-transform: uppercase;"/></td>
</tr>


<tr>
	<td>Nama Mhs</td>
    <td>:</td>
    <td><input type="text" name="form_nama" id="form_nama"  placeholder="required"size="50" maxlength="99" style="text-transform: uppercase;"/></td>
</tr>

<tr>
	<td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="form_alamat" id="form_alamat"  size="50" maxlength="254"/></td>
</tr>

<tr>
	<td>Kota</td>
    <td>:</td>
    <td><input type="text" name="form_kota" id="form_kota"  size="20" maxlength="99"/></td>
</tr>

<tr>
	<td>Alamat Asal</td>
    <td>:</td>
    <td><input type="text" name="form_alamatAsal" id="form_alamatAsal"  size="50" maxlength="254"/></td>
</tr>

<tr>
	<td>Kota Asal</td>
    <td>:</td>
    <td><input type="text" name="form_kotaAsal" id="form_kotaAsal"  size="20" maxlength="40"/></td>
</tr>

<tr>    
	<td>Provinsi</td>
    <td>:</td>
    <td>
    <select name="form_provinsi" id="form_provinsi" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($provinsi->result()as $t){
        ?>    
   <option value="<?php echo $t ->Kode_Prop;?>"> <?php echo $t->Nama_Prop;?></option>   
      <?php } ?>       
    </select>
    </td>
</tr>

<tr>
<td><?php echo form_label('Jenis Kelamin: ', 'jenis kelamin'); ?></td>
<td>:</td>
<td>
<?php echo form_radio(array("name"=>"form_jk","id"=>"form_jk","value"=>"L",
'checked'=>set_radio('jk', 'L', true))) . form_label('Laki-laki', 'laki_laki'); ?>
<?php echo form_radio(array("name"=>"form_jk","id"=>"form_jk","value"=>"P", 'checked'=>set_radio('jk', 'P', false))) . form_label('Perempuan', 'perempuan');?>
</td>
<td><?php echo form_error('jk'); ?></td>
</tr>

<tr>
	<td>Tempat Lahir</td>
    <td>:</td>
    <td><input type="text" name="form_tempatLahir" id="form_tempatLahir"  size="20" maxlength="40"/></td>
</tr>

<tr>    
	<td>Anak Ke</td>
    <td>:</td>
    <td><input type="text" name="form_anak" id="form_anak" size="5" maxlength="2" /></td>
 </tr>
 
 <tr>    
	<td>Jumlah Saudara Kandung</td>
    <td>:</td>
    <td><input type="text" name="form_jmlSdr" id="form_jmlSdr" size="5" maxlength="2" /></td>
 </tr>
 
 <tr>    
	<td>Tanggal Lahir</td>
    <td>:</td>
    <td><input type="text" id="form_tglLahir" name="form_tglLahir" class="easyui-datebox"/></td>
 </tr>
 
<tr>
<td><?php echo form_label('Warga Negara: ', 'warga negara'); ?></td>
<td>:</td>
<td>
<?php echo form_label('WNI', 'wni'). form_radio(array("name"=>"wn","id"=>"form_wn","value"=>"WNI",
'checked'=>set_radio('wn', 'WNI', true))); ?>
<?php echo form_label('WNA', 'wna') . form_radio(array("name"=>"wn","id"=>"form_wn","value"=>"WNA", 'checked'=>set_radio('wn', 'WNA', false)))
;?>
</td>
<td><?php echo form_error('wn'); ?></td>
</tr>

<tr>    
	<td>Agama</td>
    <td>:</td>
    <td>
    <select name="form_agama" id="form_agama" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($agama->result()as $t){
        ?>    
   <option value="<?php echo $t ->Agama_id;?>"> <?php echo $t->Agama;?></option>   
      <?php } ?>       
    </select>
    </td>
</tr>

<tr>
	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="form_telepon" id="form_telepon"  size="10" maxlength="13"/></td>
</tr>
<tr>
	<td>Handphone</td>
    <td>:</td>
    <td><input type="text" name="form_hp" id="form_hp" placeholder="required" size="11" maxlength="13"/></td>
</tr>
<tr>
	<td>Email</td>
    <td>:</td>
    <td><input type="text" name="form_email" id="form_email" placeholder="required" size="20" maxlength="50"/></td>
</tr>

<tr>    
	<td>Jurusan</td>
    <td>:</td>
    <td>
    <select name="form_jurusan" id="form_jurusan" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($jurusan->result()as $t){
        ?>    
   <option value="<?php echo $t ->Id_Jurusan;?>"> <?php echo $t->Nama_Jurusan;?></option>   
      <?php } ?>       
    </select>
    </td>
</tr>

<tr>    
	<td>Nilai UAN</td>
    <td>:</td>
    <td><input type="text" id="form_nilaiUAN" name="form_nilaiUAN" size="4" maxlength="6"/></td>
 </tr>

<tr>    
	<td>Asal Informasi</td>
    <td>:</td>
    <td>
    <select name="form_informasi" id="form_informasi" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($informasi->result()as $t){
        ?>    
   <option value="<?php echo $t ->Id_Informasi;?>"> <?php echo $t->Nama_Informasi;?></option>   
      <?php } ?>       
    </select>
    </td>
</tr>

<tr>    
	<td>Pekerjaan Mahasiswa</td>
    <td>:</td>
 <td>
    <select name="form_pekerjaanMhs" id="form_pekerjaanMhs" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($pekerjaan->result() as $t){
	?>
    <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
    <?php } ?>
    </select>
 </td>
</tr>

<tr>
	<td>Nama Kantor</td>
    <td>:</td>
    <td><input type="text" name="form_namaKantor" id="form_namaKantor"  size="25" maxlength="50"/></td>
</tr>
<tr>
	<td>Alamat Kantor</td>
    <td>:</td>
    <td><input type="text" name="form_alamatKantor" id="form_alamatKantor"  size="40" maxlength="254"/></td>
</tr>
<tr>
	<td>Telepon Kantor</td>
    <td>:</td>
    <td><input type="text" name="form_teleponKantor" id="form_teleponKantor"  size="10" maxlength="13"/></td>
</tr>

<tr>
	<td>Status Daftar Ulang</td>
    <td>:</td>
    <td>
    <select name="form_statusReg" id="form_statusReg" class="combo">
    <option value="0">-PILIH-</option>
    <option value="Yes">YES </option>
    <option value="No">NO</option>
    </select>
    </td>
</tr>

<tr>
	<td>Status Daftar</td>
    <td>:</td>
    <td>
    <select name="form_statusDaftar" id="form_statusDaftar" class="combo">
    <option value="0">-PILIH-</option>
    <option value="online">Online</option>
    <option value="offline">Offline</option>
    </select>
    </td>
</tr>



</table>

<table width="100%">
<tr>
	<td align="center" width="50%">
    </td>
    <td align="center" width="50%">
    <button type="button" name="page_next_formOrtu" id="page_next_formOrtu" class="easyui-linkbutton" data-options="iconCls:'icon-sesudah'">Selanjutnya</button>
    </td>
</tr>
</table>
</fieldset>
</div>
<!--Edit Data Orang Tua--!>
<div id="form_dataOrtu">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Entry Data Orang Tua</div></td>
</tr>
<tr>
	<td width="10%">Nama Ayah</td>
    <td width="5">:</td>
    <td width="30%"><input type="text" name="form_namaAyah" id="form_namaAyah" placeholder="required"  size="50" maxlength="99" style="text-transform: uppercase;"/>
    </td>
    <td rowspan="5"></td>
</tr>
<tr>
	<td>No KTP Ayah</td>
    <td>:</td>
    <td><input type="text" name="form_noKTPAyah" id="form_noKTPAyah"  size="20" maxlength="20" style="text-transform: uppercase;"/></td>
</tr>
<tr>    
	<td>Pekerjaan Ayah</td>
    <td>:</td>
    <td>
    <select name="form_pekerjaanAyah" id="form_pekerjaanAyah" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($pekerjaan->result() as $t){
	?>
    <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
    <?php } ?>
    </select>
    </td>
</tr>
<tr>

	<td>Nama Ibu</td>
    <td>:</td>
    <td><input type="text" name="form_namaIbu" id="form_namaIbu" placeholder="required" size="50" maxlength="99" style="text-transform: uppercase;"/></td>
</tr>
<tr>
	<td>No KTP Ibu</td>
    <td>:</td>
    <td><input type="text" name="form_noKTPIbu" id="form_noKTPIbu"  size="20" maxlength="20" style="text-transform: uppercase;"/></td>
</tr>
<tr>    
	<td>Pekerjaan Ibu</td>
    <td>:</td>
    <td>
    <select name="form_pekerjaanIbu" id="form_pekerjaanIbu" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($pekerjaan->result() as $t){
	?>
    <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
    <?php } ?>
    </select>
    </td>
</tr>
<tr>
	<td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="form_alamatOrtu" id="form_alamatOrtu"  size="50" maxlength="254"/></td>
</tr>
<tr>
	<td>Kota</td>
    <td>:</td>
    <td><input type="text" name="form_kotaOrtu" id="form_kotaOrtu"  size="20" maxlength="40"/></td>
</tr>
<tr>
	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="form_teleponOrtu" id="form_teleponOrtu"  size="14" maxlength="13"/></td>
</tr>
<tr>
	<td>Handphone</td>
    <td>:</td>
    <td><input type="text" name="form_hpOrtu" id="form_hpOrtu"  size="14" maxlength="13"/></td>
</tr>
</table>
<table width="100%">
<tr>
	<td align="center">
    <button type="button" name="page_before_formDiri" id="page_before_formDiri" class="easyui-linkbutton" data-options="iconCls:'icon-sebelum'">KEMBALI</button>
    </td>
    <td align="center">
    <button type="button" name="page_next_formWali" id="page_next_formWali" class="easyui-linkbutton" data-options="iconCls:'icon-sesudah'">Selanjutnya</button>
    </td>
</tr>
</table>
</fieldset>
</div>
<!--Edit Data Wali--!>
<div id="form_dataWali">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Entry Data Wali</div></td>
</tr>
<tr>
	<td width="10%">Nama Wali</td>
    <td width="5">:</td>
    <td width="30%"><input type="text" name="form_namaWali" id="form_namaWali" placeholder="required" size="50" maxlength="99" style="text-transform: uppercase;"/>
    </td>
    <td rowspan="5"></td>
</tr>
<tr>
	<td>No KTP Wali</td>
    <td>:</td>
    <td><input type="text" name="form_noKTPWali" id="form_noKTPWali"  size="20" maxlength="20" style="text-transform: uppercase;"/></td>
</tr>
<tr>    
	<td>Pekerjaan Wali</td>
    <td>:</td>
    <td>
    <select name="form_pekerjaanWali" id="form_pekerjaanWali" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($pekerjaan->result() as $t){
	?>
    <option value="<?php echo $t->Kd_Pekerjaan;?>"><?php echo $t->Pekerjaan;?></option>
    <?php } ?>
    </select>
    </td>
</tr>
<tr>
	<td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="form_alamatWali" id="form_alamatWali"  size="50" maxlength="254"/></td>
</tr>
<tr>
	<td>Kota</td>
    <td>:</td>
    <td><input type="text" name="form_kotaWali" id="form_kotaWali"  size="20" maxlength="40"/></td>
</tr>
<tr>
	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="form_teleponWali" id="form_teleponWali"  size="14" maxlength="13"/></td>
</tr>
<tr>
	<td>Handphone</td>
    <td>:</td>
    <td><input type="text" name="form_hpWali" id="form_hpWali"  size="14" maxlength="13"/></td>
</tr>
</table>
<table width="100%">
<tr>
	<td align="center">
    <button type="button" name="page_before_formOrtu" id="page_before_formOrtu" class="easyui-linkbutton" data-options="iconCls:'icon-sebelum'">KEMBALI</button>
    </td>
    <td align="center">
    <button type="button" name="page_next_formSMU" id="page_next_formSMU" class="easyui-linkbutton" data-options="iconCls:'icon-sesudah'">Selanjutnya</button>
    </td>
</tr>
</table>
</fieldset>
</div>

<!--Edit Asal Sekolah Menengah--!>
<div id="form_dataSMU">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Entry Asal Sekolah</div></td>
</tr>
<tr>
	<td width="10%">Nama Sekolah</td>
    <td width="5">:</td>
    <td width="30%">
    <select name="form_sekolah" id="form_sekolah" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($sekolah->result() as $t){
	?>
    <option value="<?php echo $t->Kode_SMU;?>"><?php echo $t->Asal_SMU;?></option>
    <?php } ?>
    </select>
    </td>
    <td rowspan="5"></td>
</tr>
<tr>    
	<td>Alamat</td>
    <td>:</td>
    <td id="form_alamatSMU"></td>
</tr>
<tr>    
   	<td>Kota</td>
    <td>:</td>
    <td id="form_kotaSMU"></td>
</tr>
<tr>
   	<td>Telepon</td>
    <td>:</td>
    <td id="form_teleponSMU"></td>
</tr>
<tr>
   	<td>Email</td>
    <td>:</td>
    <td id="form_emailSMU"></td>
</tr>
</table>
<table width="100%">
<tr>
	<td width="50%" align="center">
    <button type="button" name="page_before_formWali" id="page_before_formWali" class="easyui-linkbutton" data-options="iconCls:'icon-sebelum'">KEMBALI</button>
    </td>
    <td width="50%" align="center">
    <button type="button" name="page_next_formBerkas" id="page_next_formBerkas" class="easyui-linkbutton" data-options="iconCls:'icon-sesudah'">Selanjutnya</button>
    </td>
    <td width="50%" align="center">
    </td>
</tr>
</table>
</fieldset>
</div>

<!--Cek Berkas Pendaftaran--!>

<div id="form_berkas">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Berkas Pendaftaran</div></td>
</tr>
<tr>
	<td width="10%">SKHUN</td>
    <td width="5">:</td>
    <td width="10"><input type="checkbox" name="form_skhun" id="form_skhun" value="no" value="yes"  /></td>
    
    <td width="0"></td>    
   <!-- <td rowspan="5" style="vertical-align: bottom;">
    <img id="form_url_berkas" src="" width="200px"/>
    <iframe id="frame_upload" src="<?php echo site_url(); ?>/tr_pmb_insert_data/showUploaderBerkas" onload="cekFileUploaded();" style="border: 0; width:100%; height:40px;">
        </iframe>
     <input type="hidden" name="namaFileBerkas" id="namaFileBerkas"  size="50" maxlength="254" />
 </td>  -->  
</tr>
<tr>    
	<td>Pas Photo</td>
    <td>:</td>
    <td><input type="checkbox" id="form_pasPhoto" name="form_pasPhoto" value="no" value="yes" /></td>
    
</tr>
<tr>    
   	<td>Akte Kelahiran</td>
    <td>:</td>
    <td><input type="checkbox" id="form_akte" name="form_akte" value="no" value="yes" /></td>
</tr>
<tr>
   	<td>Ijazah</td>
    <td>:</td>
    <td><input type="checkbox" id="form_ijazah" name="form_ijazah" value="no" value="yes" /></td>
</tr>
<tr>
   	<td>Raport</td>
    <td>:</td>
    <td><input type="checkbox" id="form_rapor" name="form_rapor" value="no" value="yes" /></td>
</tr>
</table>
<br /><br />
<table width="100%">
<tr>
	<td width="50%" align="right">
    <button type="button" name="page_before_formSekolah" id="page_before_formSekolah" class="easyui-linkbutton" data-options="iconCls:'icon-sebelum'">KEMBALI</button>
    </td>
    <td width="50%" align="center">
    </td>
</tr>
</table>
</fieldset>
</div>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>
