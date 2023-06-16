<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
    
    $("#view").show();
    $("#form").hide();
    $("#detail").hide(); 
    
 });
 
    $.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return d+'-'+m+'-'+y;
    }
 
$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/mahasiswa');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});

var myTab = document.getElementById("dataTable");
var rows = myTab.getElementsByTagName("tr");
for(var i=0;i<rows.length;i++){
    row = myTab.rows[i];
    row.onclick = function(){
        var cell=this.getElementsByTagName("td")[5];
        var id = cell.innerHTML;
        showDetail(id);
    }
}


function showDetail(id){
    var string = "id="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/mahasiswa/detail",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            if(data.signout=='YES'){
                    location.reload();
                }else
                {
            $("#view").hide();
            $("#form").hide();
            $("#detail").show();  
            
            var temp = document.getElementById("detail_nrp");
            temp.innerHTML=data.NRP;
            
            var temp = document.getElementById("detail_nama");
            temp.innerHTML=data.Nama_Mhs;
            
            var temp = document.getElementById("detail_prodi");
            temp.innerHTML=data.Prodi;
            
            var temp = document.getElementById("detail_jenjang");
            temp.innerHTML=data.Jenjang;
            
            var temp = document.getElementById("detail_jalur");
            temp.innerHTML=data.Jalur;
            
            var temp = document.getElementById("detail_statusMasuk");
            temp.innerHTML=data.Status_Masuk;
            
            var temp = document.getElementById("detail_tahunMasuk");
            temp.innerHTML=data.Tahun_Masuk;
            
            var temp = document.getElementById("detail_batasStudi");
            temp.innerHTML=data.Batas_Studi;
            
            //var temp = document.getElementById("detail_dosenWali");
//            temp.innerHTML=data.Dosen_Wali;
            
            var temp = document.getElementById("detail_status_akademis");
            temp.innerHTML=data.Status_Akademis;
            
            var temp = document.getElementById("detail_photo");
            temp.innerHTML='<img src="'+data.URL_Photo+'" width="200px"/>';
            
            //===============================Data Diri==========================
            var temp = document.getElementById("detail_jk");
            temp.innerHTML=data.JK;
            
            var temp = document.getElementById("detail_agama");
            temp.innerHTML=data.Agama;
            
            var temp = document.getElementById("detail_alamatMhs");
            temp.innerHTML=data.Alamat;
            
            var temp = document.getElementById("detail_kotaMhs");
            temp.innerHTML=data.Kota_Mhs;
            
            var temp = document.getElementById("detail_alamatAsalMhs");
            temp.innerHTML=data.Alamat_Asal_Mhs;
            
            var temp = document.getElementById("detail_kotaAsalMhs");
            temp.innerHTML=data.Kota_Asal_Mhs;
            
            var temp = document.getElementById("detail_tempatLahir");
            temp.innerHTML=data.Tempat_Lahir;
            
            var temp = document.getElementById("detail_tanggalLahir");
            temp.innerHTML=data.Tanggal_Lahir;
            
            var temp = document.getElementById("detail_telepon");
            temp.innerHTML=data.Telepon;
            
            var temp = document.getElementById("detail_hp");
            temp.innerHTML=data.HP;
            
            var temp = document.getElementById("detail_email");
            temp.innerHTML=data.Email;
            
            var temp = document.getElementById("detail_pekerjaanMhs");
            temp.innerHTML=data.Pekerjaan_Mhs;
            
            var temp = document.getElementById("detail_namaPerusahaan");
            temp.innerHTML=data.Nama_Kantor;
            
            var temp = document.getElementById("detail_alamatPerusahaan");
            temp.innerHTML=data.Alamat_Kantor;
            
            var temp = document.getElementById("detail_teleponPerusahaan");
            temp.innerHTML=data.Telp_Kantor;
            
            //===============================Data Orang Tua==========================
            var temp = document.getElementById("detail_namaAyah");
            temp.innerHTML=data.Nama_Ayah;
            
            var temp = document.getElementById("detail_noKTPAyah");
            temp.innerHTML=data.No_KTP_Ayah;
            
            var temp = document.getElementById("detail_namaIbu");
            temp.innerHTML=data.Nama_Ibu;
            
            var temp = document.getElementById("detail_noKTPIbu");
            temp.innerHTML=data.No_KTP_Ibu;
            
            var temp = document.getElementById("detail_alamatOrtu");
            temp.innerHTML=data.Alamat_Ortu;
            
            var temp = document.getElementById("detail_kotaOrtu");
            temp.innerHTML=data.Kota_Ortu;
            
            var temp = document.getElementById("detail_pekerjaanAyah");
            temp.innerHTML=data.Pekerjaan_Ayah;
            
            var temp = document.getElementById("detail_pekerjaanIbu");
            temp.innerHTML=data.Pekerjaan_Ibu;
            
            var temp = document.getElementById("detail_teleponOrtu");
            temp.innerHTML=data.Telp_Ortu;
            
            var temp = document.getElementById("detail_hpOrtu");
            temp.innerHTML=data.Telp_HP_Ortu;
            
            //===============================Data Wali==========================
            var temp = document.getElementById("detail_namaWali");
            temp.innerHTML=data.Nama_Wali;
            
            var temp = document.getElementById("detail_noKTPWali");
            temp.innerHTML=data.No_KTP_Wali;
            
            var temp = document.getElementById("detail_alamatWali");
            temp.innerHTML=data.Alamat_Wali;
            
            var temp = document.getElementById("detail_kotaWali");
            temp.innerHTML=data.Kota_Wali;
            
            var temp = document.getElementById("detail_pekerjaanWali");
            temp.innerHTML=data.Pekerjaan_Wali;
            
            var temp = document.getElementById("detail_teleponWali");
            temp.innerHTML=data.Telp_Wali;
            
            var temp = document.getElementById("detail_hpWali");
            temp.innerHTML=data.Telp_HP_Wali;
            
            //===============================Data Sekolah Menengah==========================
            var temp = document.getElementById("detail_namaSMU");
            temp.innerHTML=data.Nama_SMU;
            
            var temp = document.getElementById("detail_alamatSMU");
            temp.innerHTML=data.Alamat_SMU;
            
            var temp = document.getElementById("detail_kotaSMU");
            temp.innerHTML=data.Kota_SMU;
            
            var temp = document.getElementById("detail_teleponSMU");
            temp.innerHTML=data.Telp_SMU;
            
            var temp = document.getElementById("detail_emailSMU");
            temp.innerHTML=data.Email_SMU;
            
            //==============Perguruan Tinggi Asal========================
            if(data.Status_Masuk=='Pindahan'){
                $('#ptAsl').show();
                document.getElementById('detail_nim_asal').innerHTML=data.NIM_Asal;
                document.getElementById('detail_jenjang_asal').innerHTML=data.Nama_Jenjang;
                document.getElementById('detail_kode_pt_asal').innerHTML=data.Kode_PT_Asal;
                document.getElementById('detail_prodi_asal').innerHTML=data.Program_Studi;
                document.getElementById('detail_nama_pt_asal').innerHTML=data.Nama_PT;
                document.getElementById('detail_sks_diakui').innerHTML=data.SKS_Diakui;
                document.getElementById('detail_propinsi_pt_asal').innerHTML=data.Nama_Prop;
            }else
            {
                $('#ptAsl').hide();
            }
            
            //=======Data akademis mahasisaw==================================
            $(".item-row-data").remove();
            $(".item-row-title").after(data.Data_Akademis);
            
            $(".item-row-data-RA").remove();
            $(".item-row-title-RA").after(data.Data_Riwayat_Akademik);
            }
        }
    });
}   

$("#editData").click(function(){
    var temp = document.getElementById("detail_nrp");
    var id=temp.innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

function cekFileUploaded(){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/cekFileUploaded",
			cache	: false,
            dataType : "json",
			success	: function(data){
				
                $("#namaFile").val(data.namaUploaded);
                var temp = document.getElementById("form_photo_img").setAttribute('src',data.filename);
				return false;
			}
		});
}

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
                $("#detail").hide();
				$("#form").show();
                hideFormEdit();
                $("#form_dataDiri").show();
                document.getElementById('nrp').readOnly=true;
                
                $("#nrp").val(data.NRP);
                var temp = document.getElementById("form_photo_img").setAttribute('src',data.URL_Photo);
                
                $("#form_nama").val(data.Nama_Mhs);
                $("#form_alamat").val(data.Alamat);
                $("#form_kota").val(data.Kota_Mhs);
                $("#form_alamatAsal").val(data.Alamat_Asal_Mhs);
                $("#form_kotaAsal").val(data.Kota_Asal_Mhs);
                $("#form_jk").val(data.JK);
                $("#form_tempatLahir").val(data.Tempat_Lahir);
                $("#form_tglLahir").datebox('setValue', data.Tanggal_Lahir);
                $("#form_agama").val(data.Agama);
                $("#form_telepon").val(data.Telepon);
                $("#form_hp").val(data.HP);
                $("#form_email").val(data.Email);
                $("#form_pekerjaanMhs").val(data.Pekerjaan_Mhs);
                $("#form_namaPerusahaan").val(data.Nama_Kantor);
                $("#form_alamatPerusahaan").val(data.Alamat_Kantor);
                $("#form_teleponPerusahaan").val(data.Telp_Kantor);
                
                //=========================Data Ortu========================
                $("#form_namaAyah").val(data.Nama_Ayah);
                $("#form_noKTPAyah").val(data.No_KTP_Ayah);
                $("#form_pekerjaanAyah").val(data.Pekerjaan_Ayah);
                $("#form_namaIbu").val(data.Nama_Ibu);
                $("#form_noKTPIbu").val(data.No_KTP_Ibu);
                $("#form_pekerjaanIbu").val(data.Pekerjaan_Ibu);
                $("#form_alamatOrtu").val(data.Alamat_Ortu);
                $("#form_kotaOrtu").val(data.Kota_Ortu);
                $("#form_teleponOrtu").val(data.Telp_Ortu);
                $("#form_hpOrtu").val(data.Telp_HP_Ortu);
                
                //=========================Data Wali========================
                $("#form_namaWali").val(data.Nama_Wali);
                $("#form_noKTPWali").val(data.No_KTP_Wali);
                $("#form_pekerjaanWali").val(data.Pekerjaan_Wali);
                $("#form_alamatWali").val(data.Alamat_Wali);
                $("#form_kotaWali").val(data.Kota_Wali);
                $("#form_teleponWali").val(data.Telp_Wali);
                $("#form_hpWali").val(data.Telp_HP_Wali);
                $("#form_sekolah").val(data.Kode_SMU);
                
                ////==============Perguruan Tinggi Asal========================
//                $("#form_namaWali").val(data.Nama_Wali);
//                $("#form_noKTPWali").val(data.No_KTP_Wali);
//                $("#form_pekerjaanWali").val(data.Pekerjaan_Wali);
//                $("#form_alamatWali").val(data.Alamat_Wali);
//                $("#form_kotaWali").val(data.Kota_Wali);
//                $("#form_teleponWali").val(data.Telp_Wali);
//                $("#form_hpWali").val(data.Telp_HP_Wali);
//                $("#form_sekolah").val(data.Kode_SMU);
                
                showDetailSekolah(data.Kode_SMU);
                $("#saveas").val('edit');
				return false;
			}
	});
}

$("#simpan").click(function(){
		var nrp = $("#nrp").val();
        var namaMhs= $("#form_nama").val();
        var jk =$("#form_jk").val();
        var tempatLahir =$("#form_tempatLahir").val();
        var tanggalLahir =$("#form_tglLahir").datebox('getValue');
        var agama = $("#form_agama").val();
        var telepon = $("#form_telepon").val();
        var hp = $("#form_hp").val();
        var email = $("#form_email").val();
        var alamat = $("#form_alamat").val();
        var kota = $("#form_kota").val();
        var alamatAsal = $("#form_alamatAsal").val();
        var kotaAsal = $("#form_kotaAsal").val();
        var pekerjaanMhs = $("#form_pekerjaanMhs").val();
        var namaPerusahaan = $("#form_namaPerusahaan").val();
        var alamatPerusahaan = $("#form_alamatPerusahaan").val();
        var teleponPerusahaan = $("#form_teleponPerusahaan").val();
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
        var sekolah = $("#form_sekolah").val();
        var saveas =$("#saveas").val();
        var urlFoto = document.getElementById('form_photo_img').getAttribute('src');
		
		var string = "nrp="+nrp+"&namaMhs="+namaMhs+"&jk="+jk+"&tempatLahir="+tempatLahir+"&tanggalLahir="+tanggalLahir+
        "&agama="+agama+"&telepon="+telepon+"&hp="+hp+"&email="+email+"&alamat="+alamat+"&kota="+kota+"&alamatAsal="+alamatAsal+
        "&kotaAsal="+kotaAsal+"&pekerjaanMhs="+pekerjaanMhs+"&namaPerusahaan="+namaPerusahaan+"&alamatPerusahaan="+alamatPerusahaan+
        "&teleponPerusahaan="+teleponPerusahaan+"&namaAyah="+namaAyah+"&noKTPAyah="+noKTPAyah+
        "&pekerjaanAyah="+pekerjaanAyah+"&namaIbu="+namaIbu+"&noKTPIbu="+noKTPIbu+"&pekerjaanIbu="+pekerjaanIbu+"&alamatOrtu="+alamatOrtu+"&kotaOrtu="+kotaOrtu
        +"&teleponOrtu="+teleponOrtu+"&hpOrtu="+hpOrtu+"&namaWali="+namaWali+"&noKTPWali="+noKTPWali+"&pekerjaanWali="+pekerjaanWali+"&alamatWali="+alamatWali
        +"&kotaWali="+kotaWali+"&teleponWali="+teleponWali+"&hpWali="+hpWali+"&urlFoto="+urlFoto
        +"&sekolah="+sekolah+"&saveas="+saveas;
        		
		if(namaMhs.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Nama mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#nip").focus();
			return false;
		}

        if(namaAyah.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Nama ayah mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#nip").focus();
			return false;
		}
        
        if(noKTPAyah.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'No KTP ayah mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#nip").focus();
			return false;
		}
        
        if(namaIbu.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Nama ibu mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#nip").focus();
			return false;
		}
        
        if(noKTPIbu.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'No KTP ibu mahasiswa harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#nip").focus();
			return false;
		}
        
        if(agama==0){
			$.messager.show({
				title:'Siakad',
				msg:'Agama harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#dosenWali").focus();
			return false;
		}
        
        if(sekolah==0){
			$.messager.show({
				title:'Siakad',
				msg:'Asal sekolah harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#dosenWali").focus();
			return false;
		}
        
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/simpanEdit",
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
				return false();
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
			url		: "<?php echo site_url(); ?>/mahasiswa/detailSekolah",
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

//----------------------------------Validasi Input------------------------------------------------------------//
$("#nip").blur(function(){
    var nip = $('#nip').val();

    var string = "id="+nip;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/dosen/getData",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
                if($('#saveas').val()=='baru'){
                    if (data.record==0){
                        $("#msg_nip").html('');
                    }else
                    {
                        $("#msg_nip").html('Pegawai sudah terdaftar sebagai dosen');
                    }
                    
                    if (data.dataNum==0){
                        $("#msg_nip").html('Data pegawai tidak ditemukan');
                        var temp = document.getElementById("form_nidn");
                        temp.innerHTML='';
                        
                        var temp = document.getElementById("form_nama");
                        temp.innerHTML='';
                        
                        var temp = document.getElementById("form_jenisDosen");
                        temp.innerHTML=''; 
                        
                        var temp = document.getElementById("form_photo");
                        temp.innerHTML='';
                    }else{
                        var temp = document.getElementById("form_nidn");
                        temp.innerHTML=data.NIDN;
                        
                        var temp = document.getElementById("form_nama");
                        temp.innerHTML=data.Nama;
                        
                        var temp = document.getElementById("form_jenisDosen");
                        temp.innerHTML=data.Status; 
                        
                        var temp = document.getElementById("form_photo");
                        temp.innerHTML='<img src="'+data.URL_Photo+'" width="200px"/>'; 
                    }
                    			
                }
				return false;
			}
	});
});

$("#form_sekolah").change(function(){
   showDetailSekolah($("#form_sekolah").val());
})

//----------------------------------------------Navigasi Form Edit--------------------------------------
function hideFormEdit(){
    $("#form_dataDiri").hide();
    $("#form_dataOrtu").hide();
    $("#form_dataWali").hide();
    $("#form_dataSMU").hide();
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
</script>

<div id="detail">
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
	<td width="10%">NRP</td>
    <td width="5">:</td>
    <td width="30%" id="detail_nrp" ></td>
    <td rowspan="10" id="detail_photo"></td>
</tr>
<tr>    
	<td>Nama</td>
    <td>:</td>
    <td id="detail_nama"></td>
</tr>
<tr>    
	<td>Program Studi</td>
    <td>:</td>
    <td id="detail_prodi"></td>
</tr>
<tr>    
	<td>Jenjang Studi</td>
    <td>:</td>
    <td id="detail_jenjang"></td>
</tr>
<tr>    
	<td>Jalur Studi</td>
    <td>:</td>
    <td id="detail_jalur"></td>
</tr>
<tr>    
	<td>Status Masuk</td>
    <td>:</td>
    <td id="detail_statusMasuk"></td>
</tr>
<tr>    
	<td>Tahun Masuk</td>
    <td>:</td>
    <td id="detail_tahunMasuk"></td>
</tr>
<tr>    
	<td>Batas Studi</td>
    <td>:</td>
    <td id="detail_batasStudi"></td>
</tr>
<tr>    
	<td>Dosen Wali</td>
    <td>:</td>
    <td id="detail_dosenWali"></td>
</tr>
<tr>    
	<td>Status Akademis</td>
    <td>:</td>
    <td id="detail_status_akademis"></td>
</tr>
</table>
</fieldset>

<!-----------------------Data Diri---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Data Pribadi</div></td>
</tr>
<tr>
	<td width="10%">Jenis Kelamin</td>
    <td width="2">:</td>
    <td width="38%" id="detail_jk" ></td>
   	<td width="10%">Telepon</td>
    <td width="2">:</td>
    <td width="38%" id="detail_telepon"></td>
</tr>
<tr>    
	<td>Agama</td>
    <td>:</td>
    <td id="detail_agama"></td>
   	<td>Handphone</td>
    <td>:</td>
    <td id="detail_hp"></td>
</tr>
<tr>    
	<td>Alamat</td>
    <td>:</td>
    <td id="detail_alamatMhs"></td>
   	<td>E-mail</td>
    <td>:</td>
    <td id="detail_email"></td>
</tr>
<tr>    
	<td>Kota</td>
    <td>:</td>
    <td id="detail_kotaMhs"></td>
   	<td>Pekerjaan</td>
    <td>:</td>
    <td id="detail_pekerjaanMhs"></td>
</tr>
<tr>    
	<td>Alamat Asal</td>
    <td>:</td>
    <td id="detail_alamatAsalMhs"></td>
	<td>Nama Perusahaan</td>
    <td>:</td>
    <td id="detail_namaPerusahaan"></td>
</tr>
<tr>    
	<td>Kota Asal</td>
    <td>:</td>
    <td id="detail_kotaAsalMhs"></td>
   	<td>Alamat Perusahaan</td>
    <td>:</td>
    <td id="detail_alamatPerusahaan"></td>
</tr>
<tr>    
	<td>Tempat Lahir</td>
    <td>:</td>
    <td id="detail_tempatLahir"></td>
   	<td>Telepon Perusahaan</td>
    <td>:</td>
    <td id="detail_teleponPerusahaan"></td>
</tr>
<tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td id="detail_tanggalLahir"></td>
</tr>
</table>
</fieldset>

<!-----------------------Orang Tua---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Orang Tua</div></td>
</tr>
<tr>
	<td width="10%">Nama Ayah</td>
    <td width="2">:</td>
    <td width="38%" id="detail_namaAyah" ></td>
	<td width="10%">Alamat Orang Tua</td>
    <td width="2">:</td>
    <td width="38%" id="detail_alamatOrtu"></td>
</tr>
<tr>    
	<td>No KTP Ayah</td>
    <td>:</td>
    <td id="detail_noKTPAyah"></td>
	<td>Kota Orang Tua</td>
    <td>:</td>
    <td id="detail_kotaOrtu"></td>
</tr>
<tr>    
   	<td>Pekerjaan Ayah</td>
    <td>:</td>
    <td id="detail_pekerjaanAyah"></td>
   	<td>Telepon Orang Tua</td>
    <td>:</td>
    <td id="detail_teleponOrtu"></td>
</tr>
<tr>    
	<td>Nama Ibu</td>
    <td>:</td>
    <td id="detail_namaIbu"></td>
   	<td>HP Orang Tua</td>
    <td>:</td>
    <td id="detail_hpOrtu"></td>
</tr>
<tr>
	<td>No KTP Ibu</td>
    <td>:</td>
    <td id="detail_noKTPIbu"></td>
</tr>
<tr>    
   	<td>Pekerjaan Ibu</td>
    <td>:</td>
    <td id="detail_pekerjaanIbu"></td>

</tr>
</table>
</fieldset>

<!-----------------------Wali Mahasiswa---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Wali</div></td>
</tr>
<tr>
	<td width="10%">Nama Wali</td>
    <td width="2">:</td>
    <td width="38%"id="detail_namaWali" ></td>
   	<td width="10%">Pekerjaan Wali</td>
    <td width="2">:</td>
    <td width="38%" id="detail_pekerjaanWali"></td>
</tr>
<tr>    
	<td>No KTP Wali</td>
    <td>:</td>
    <td id="detail_noKTPWali"></td>
   	<td>Telepon Wali</td>
    <td>:</td>
    <td id="detail_teleponWali"></td>
</tr>
<tr>    
   	<td>Alamat Wali</td>
    <td>:</td>
    <td id="detail_alamatWali"></td>
   	<td>HP Wali</td>
    <td>:</td>
    <td id="detail_hpWali"></td>
</tr>
<tr>    
	<td>Kota Wali</td>
    <td>:</td>
    <td id="detail_kotaWali"></td>
</tr>
</table>
</fieldset>

<!-----------------------Asal Sekolah Menengah---------------------------------!>
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Asal Sekolah</div></td>
</tr>
<tr>
	<td width="10%">Nama</td>
    <td width="2">:</td>
    <td width="38%"id="detail_namaSMU" ></td>
   	<td width="10%">Telepon</td>
    <td width="2">:</td>
    <td width="38%" id="detail_teleponSMU"></td>
</tr>
<tr>    
	<td>Alamat</td>
    <td>:</td>
    <td id="detail_alamatSMU"></td>
   	<td>Email</td>
    <td>:</td>
    <td id="detail_emailSMU"></td>
</tr>
<tr>    
   	<td>Kota</td>
    <td>:</td>
    <td id="detail_kotaSMU"></td>
</tr>
</table>
</fieldset>
<!-----------------------Perguruan Tinggi Asal---------------------------------!>
<div id="ptAsl">
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Perguruan Tinggi Asal</div></td>
</tr>
<tr>
	<td width="10%">NIM di P.T Asal</td>
    <td width="2">:</td>
    <td width="38%"id="detail_nim_asal" ></td>
   	<td width="10%">Jenjang Studi</td>
    <td width="2">:</td>
    <td width="38%" id="detail_jenjang_asal"></td>
</tr>
<tr>    
	<td>Kode P.T Asal</td>
    <td>:</td>
    <td id="detail_kode_pt_asal"></td>
   	<td>Program Studi</td>
    <td>:</td>
    <td id="detail_prodi_asal"></td>
</tr>
<tr>    
   	<td>Nama P.T Asal</td>
    <td>:</td>
    <td id="detail_nama_pt_asal"></td>
    <td>SKS Diakui</td>
    <td>:</td>
    <td id="detail_sks_diakui"></td>
</tr>
<tr>    
   	<td>Propinsi</td>
    <td>:</td>
    <td id="detail_propinsi_pt_asal"></td>
</tr>
</table>
</fieldset>
</div>
<!-----------------------Data Akademis Mahasiswa---------------------------------!>

<fieldset class="atas">
<table id="detail">
<tr>
    <td colspan="4"><div id="tabelTitle">Data Akademis Mahasiswa</div></td>
</tr>
<tr>
<table width="100%">
<tr>
    <td width='30%' class="rataAtas">
        <table id="tabelCo">
            <tr>
                <th colspan="3">Riwayat Akademik</th>
            </tr>
            <tr class="item-row-title-RA">
                <th>Tahun</th>
                <th>Periode Semester</th>
                <th>Status Akademis</th>
            </tr>
            <tr class="item-row-data-RA">
                <td colspan="12" align="center">Tidak ada data</td>
            </tr>
        </table>
    </td>
    <td width='70%' class="rataAtas">
    <table id='tabelCo'>
            <tr>
                <th colspan="2" width='20%'>Periode</th>
                <th colspan="5" width='40%'>Per Term / Semester</th>
                <th colspan="5" width='40%'>Kumulatif</th>
            </tr>
            <tr class="item-row-title">
                <th width='10%'>Tahun</th>
                <th width='10%'>Semester</th>
                <th width='8%'>MK</th>
                <th width='8%'>SKS A</th>
                <th width='8%'>SKS L</th>
                <th width='8%'>Mutu</th>
                <th width='%'>IP</th>
                <th width='8%'>SKS A</th>
                <th width='8%'>SKS L</th>
                <th width='8%'>Mutu</th>
                <th width='8%'>IPK</th>
                <th width='%'>SKS DPO</th>
            </tr>
            <tr class="item-row-data">
                <td colspan="12" align="center">Tidak ada data</td>
            </tr>
    </table>
    </td>
</tr>
</table>
</tr>
<tr>
    <td></td>
</tr>
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="editData" id="editData" class="easyui-linkbutton" data-options="iconCls:'icon-edit'">UBAH</button>
    <button type="button" name="kembali_detail" id="kembali_detail" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>  
</fieldset>  
</div>
 

<!--
Tampilan VIEW untuk grid data
--!>
<div id="view">

    <div style="float:left; padding-bottom:5px;">    
    <a href="<?php echo base_url();?>index.php/mahasiswa/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/mahasiswa/cari">
    <?php
    echo 'Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" value="'.$keyword.'" size="50" />'
    ?>
    <button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    </form>
    </div>

<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Angkatan</th>
    <th>Nama Program Studi</th>
    <th>Nama Jenjang Studi</th>
    <th>Jalur Studi</th>
    <th>NRP</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Telepon</th>
    <th>Status Akademis</th>

</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr>
			<td align="center" width="30"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $data['Tahun_Masuk']; ?></td>
            <td align="center" width="160" ><?php echo $data['Nama_Prodi']; ?></td>
            <td align="center" width="100"><?php echo $data['Nama_Jenjang']; ?></td>
            <td align="center" width="70"><?php
            if($data['Kelas']=='R'){
                echo 'Regular';   
            }else
            if($data['Kelas']=='N')
            {
                echo 'Non Reguler';
            }else
            if($data['Kelas']=='K'){
                echo 'Kerjasama';
            }
            ?></td>
            <td align="center" width="100"><?php echo $data['NRP']; ?></td>
            <td align="left"><?php echo $data['Nama_Mhs']; ?></td>
            <td align="center" width="150" ><?php 
            if($data['JK']=='L'){
                echo 'Laki-laki';   
            }else
            if($data['JK']=='P')
            {
                echo 'Perempuan';
            }?></td>
            <td align="center" width="100" ><?php echo $data['Tlp_HP']; ?></td>
            <td align="center" width="100" ><?php echo $data['Status_Akademis']; ?></td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="10" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>

<div id="form">
<div id="form_dataDiri">
<fieldset class="atas">
<table width="100%">
<tr>
<td colspan="4"><div id="tabelTitle">Data Akademis Mahasiswa</div></td>
</tr>
<tr>
	<td width="10%">NRP</td>
    <td width="5">:</td>
    <td width="30%"><input type="text" name="nrp" id="nrp"  size="10" maxlength="9" style="text-transform: uppercase;"/>
    <input type="hidden" name="saveas" id="saveas"  size="10" maxlength="4" />
    <div class="errMsg" id="msg_nip"></div>
    </td>
    <td rowspan="5">
        <img id="form_photo_img" src="" width="200px"/>
        <iframe id="frame_upload" src="<?php echo site_url(); ?>/mahasiswa/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:60px;">
        </iframe>
        <input type="hidden" name="namaFile" id="namaFile"  size="50" maxlength="254" />
    </td>
</tr>
<tr>
	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name="form_nama" id="form_nama"  size="50" maxlength="99" style="text-transform: uppercase;"/></td>
</tr>
<tr>
	<td>Jenis Kelamin</td>
    <td>:</td>
    <td>
    <select name="form_jk" id="form_jk" class="combo">
    <option value="0">-PILIH-</option>
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
    </select>
    </td>
</tr>
<tr>
	<td>Tempat Lahir</td>
    <td>:</td>
    <td><input type="text" name="form_tempatLahir" id="form_tempatLahir"  size="20" maxlength="40"/></td>
</tr>
<tr>    
	<td>Tanggal Lahir</td>
    <td>:</td>
    <td><input type="text" id="form_tglLahir" name="form_tglLahir" class="easyui-datebox"/></td>
</tr>
<tr>    
	<td>Agama</td>
    <td>:</td>
    <td>
    <select name="form_agama" id="form_agama" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($agama->result() as $t){
	?>
    <option value="<?php echo $t->agama_id;?>"><?php echo $t->agama;?></option>
    <?php } ?>
    </select>
    </td>
</tr>
<tr>
	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="form_telepon" id="form_telepon"  size="14" maxlength="13"/></td>
</tr>
<tr>
	<td>Handphone</td>
    <td>:</td>
    <td><input type="text" name="form_hp" id="form_hp"  size="14" maxlength="13"/></td>
</tr>
<tr>
	<td>E-mail</td>
    <td>:</td>
    <td><input type="text" name="form_email" id="form_email"  size="30" maxlength="50"/></td>
</tr>
<tr>
	<td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="form_alamat" id="form_alamat"  size="50" maxlength="254"/></td>
</tr>
<tr>
	<td>Kota</td>
    <td>:</td>
    <td><input type="text" name="form_kota" id="form_kota"  size="20" maxlength="40"/></td>
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
	<td>Nama Perusahaan</td>
    <td>:</td>
    <td><input type="text" name="form_namaPerusahaan" id="form_namaPerusahaan"  size="30" maxlength="50"/></td>
</tr>
<tr>
	<td>Alamat Perusahaan</td>
    <td>:</td>
    <td><input type="text" name="form_alamatPerusahaan" id="form_alamatPerusahaan"  size="50" maxlength="254"/></td>
</tr>
<tr>
	<td>Telepon Perusahaan</td>
    <td>:</td>
    <td><input type="text" name="form_teleponPerusahaan" id="form_teleponPerusahaan"  size="14" maxlength="13"/></td>
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
<td colspan="4"><div id="tabelTitle">Data Orang Tua</div></td>
</tr>
<tr>
	<td width="10%">Nama Ayah</td>
    <td width="5">:</td>
    <td width="30%"><input type="text" name="form_namaAyah" id="form_namaAyah"  size="50" maxlength="99" style="text-transform: uppercase;"/>
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
    <td><input type="text" name="form_namaIbu" id="form_namaIbu"  size="50" maxlength="99" style="text-transform: uppercase;"/></td>
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
<td colspan="4"><div id="tabelTitle">Data Wali</div></td>
</tr>
<tr>
	<td width="10%">Nama Wali</td>
    <td width="5">:</td>
    <td width="30%"><input type="text" name="form_namaWali" id="form_namaWali"  size="50" maxlength="99" style="text-transform: uppercase;"/>
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
<td colspan="4"><div id="tabelTitle">Asal Sekolah</div></td>
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
