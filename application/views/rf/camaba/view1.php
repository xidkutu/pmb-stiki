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
    $("#detail_preview").hide(); 
    
 });
 
    $.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return d+'-'+m+'-'+y;
    }
 
$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/rf_pmb_camaba');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide();
    $("#print").show();
     
});

$("#kembali_print").click(function(){
   	$("#view").show();
    $("#detail_preview").hide();
     
});


$("#tanggal_ujian").click(function(){
   	$("#datebox").show();
    $("#tanggal_ujian").hide(); 
    $("#btn").show(); 
});

$("#btn").click(function(){
   	$("#datebox").hide();
    $("#tanggal_ujian").show(); 
    $("#btn").hide(); 
    
    var tgl_ujian = $("#tgl_ujian").datebox('getValue');   
    
    document.getElementById('tanggal_ujian').innerHTML=tgl_ujian;
});

$("#waktu_ujian").click(function(){
   	$("#waktuUjian").show();
    $("#waktu_ujian").hide(); 
    $("btn1").show(); 
});

$("#btn1").click(function(){
   	$("#waktuUjian").hide();
    $("#waktu_ujian").show(); 
    $("#btn1").hide(); 
    
    var waktu_ujian = $("#spinner").timespinner('getValue'); 
      
    document.getElementById('waktu_ujian').innerHTML=waktu_ujian;
});

$("#ekspor_pdf").click(function(){
  doCetak('printable');
})

//$("#detail_ekspor_pdf").click(function(){
//  doCetak("cetak_detail"); 
//})

function doCetak(isi){
    var tempCode=document.getElementById('datebox').innerHTML;
    document.getElementById('datebox').innerHTML='';
    var tempCodeJam=document.getElementById('waktuUjian').innerHTML;
    document.getElementById('waktuUjian').innerHTML='';
    var data = document.getElementById(isi).innerHTML;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/pdf_exporter/generateHTML",
        data    : data,
        cache   : true,
        contentType:"application/json",
        dataType : "json",
        converters:{'text json':true},
        success : function(data){
            document.getElementById('datebox').innerHTML=tempCode;
            document.getElementById('waktuUjian').innerHTML=tempCodeJam;
            window.location.assign("<?php echo site_url(); ?>/pdf_exporter/eksporPdf");
        }
    });
}

function showDetail(id){
    var string = "Id_Camaba="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/rf_pmb_camaba/detail",
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
            $("#detail_preview").hide();  
            
            var temp = document.getElementById("detail_Id_Camaba");
            temp.innerHTML=data.Id_Camaba;
                      
            var temp = document.getElementById("detail_nrp");
            temp.innerHTML=data.NRP;
            
            var temp = document.getElementById("detail_notes");
            temp.innerHTML=data.Nomer_Tes;
            
            var temp = document.getElementById("detail_prodi");
            temp.innerHTML=data.Prodi;
            
            var temp = document.getElementById("detail_kelas");
            temp.innerHTML=data.Kelas;
           
            var temp = document.getElementById("detail_tglMasuk");
            temp.innerHTML=data.Tgl_Masuk;
           
            var temp = document.getElementById("detail_jalur");
            temp.innerHTML=data.Jalur;
            
            var temp = document.getElementById("detail_tahunMasuk");
            temp.innerHTML=data.Tahun_Masuk;            
            
            var temp = document.getElementById("detail_semesterMasuk");
            temp.innerHTML=data.Semester_Masuk;
           
            var temp = document.getElementById("detail_statusMasuk");
            temp.innerHTML=data.Status_Masuk;
            
            var temp = document.getElementById("detail_batasStudi");
            temp.innerHTML=data.Batas_Studi;
                     
            var temp = document.getElementById("detail_nama");
            temp.innerHTML=data.Nama_Mhs;
                              
            var temp = document.getElementById("detail_photo");
            temp.innerHTML='<img src="'+data.URL_Photo+'" width="200px"/>';
            
            //===============================Data Diri==========================
            
            var temp = document.getElementById("detail_alamatMhs");
            temp.innerHTML=data.Alamat;
            
            var temp = document.getElementById("detail_kotaMhs");
            temp.innerHTML=data.Kota_Mhs;
            
            var temp = document.getElementById("detail_alamatAsalMhs");
            temp.innerHTML=data.Alamat_Asal_Mhs;
            
            var temp = document.getElementById("detail_kotaAsalMhs");
            temp.innerHTML=data.Kota_Asal_Mhs;
            
            var temp = document.getElementById("detail_provinsi");
            temp.innerHTML=data.Provinsi;           
            
            var temp = document.getElementById("detail_jk");
            temp.innerHTML=data.JK;
            
            var temp = document.getElementById("detail_tempatLahir");
            temp.innerHTML=data.Tempat_Lahir;
            
            var temp = document.getElementById("detail_tanggalLahir");
            temp.innerHTML=data.Tanggal_Lahir;
            
            var temp = document.getElementById("detail_anak");
            temp.innerHTML=data.Anak_ke;
            
            var temp = document.getElementById("detail_jmlSaudara");
            temp.innerHTML=data.jmlsdr;
            
            var temp = document.getElementById("detail_wargaNegara");
            temp.innerHTML=data.wn;
            
            var temp = document.getElementById("detail_agama");
            temp.innerHTML=data.Agama;
            
            var temp = document.getElementById("detail_telepon");
            temp.innerHTML=data.Telepon;
            
            var temp = document.getElementById("detail_hp");
            temp.innerHTML=data.HP;
            
            var temp = document.getElementById("detail_email");
            temp.innerHTML=data.Email;
            
            var temp = document.getElementById("detail_jurusan");
            temp.innerHTML=data.Jurusan;
            
            var temp = document.getElementById("detail_nilaiUAN");
            temp.innerHTML=data.Nilai_UAN;
            
            var temp = document.getElementById("detail_asalInformasi");
            temp.innerHTML=data.Asal_Informasi;
            
            var temp = document.getElementById("detail_pekerjaanMhs");
            temp.innerHTML=data.Pekerjaan_Mhs;
            
            var temp = document.getElementById("detail_namaKantor");
            temp.innerHTML=data.Nama_Kantor;
            
            var temp = document.getElementById("detail_alamatKantor");
            temp.innerHTML=data.Alamat_Kantor;
            
            var temp = document.getElementById("detail_teleponKantor");
            temp.innerHTML=data.Telp_Kantor;
            
            var temp = document.getElementById("detail_statusRegistrasi");
            temp.innerHTML=data.Status_Registrasi; 
            
            var temp = document.getElementById("detail_statusDaftar");
            temp.innerHTML=data.Status_Daftar; 
            
            var temp = document.getElementById("detail_statusCamaba");
            temp.innerHTML=data.Status_Camaba;
            
            
            
            //===============================Data Orang Tua==========================
            var temp = document.getElementById("detail_namaAyah");
            temp.innerHTML=data.Nama_Ayah;
            
            var temp = document.getElementById("detail_noKTPAyah");
            temp.innerHTML=data.No_KTP_Ayah;
            
            var temp = document.getElementById("detail_pekerjaanAyah");
            temp.innerHTML=data.Pekerjaan_Ayah;
           
            var temp = document.getElementById("detail_namaIbu");
            temp.innerHTML=data.Nama_Ibu;
            
            var temp = document.getElementById("detail_noKTPIbu");
            temp.innerHTML=data.No_KTP_Ibu;
            
            var temp = document.getElementById("detail_pekerjaanIbu");
            temp.innerHTML=data.Pekerjaan_Ibu;
            
            var temp = document.getElementById("detail_alamatOrtu");
            temp.innerHTML=data.Alamat_Ortu;
            
            var temp = document.getElementById("detail_kotaOrtu");
            temp.innerHTML=data.Kota_Ortu;          
            
            var temp = document.getElementById("detail_teleponOrtu");
            temp.innerHTML=data.Telp_Ortu;
            
            var temp = document.getElementById("detail_hpOrtu");
            temp.innerHTML=data.Telp_HP_Ortu;
            
            //===============================Data Wali==========================
            var temp = document.getElementById("detail_namaWali");
            temp.innerHTML=data.Nama_Wali;
            
            var temp = document.getElementById("detail_noKTPWali");
            temp.innerHTML=data.No_KTP_Wali;
            
            var temp = document.getElementById("detail_pekerjaanWali");
            temp.innerHTML=data.Pekerjaan_Wali;
            
            var temp = document.getElementById("detail_alamatWali");
            temp.innerHTML=data.Alamat_Wali;
            
            var temp = document.getElementById("detail_kotaWali");
            temp.innerHTML=data.Kota_Wali;
            
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
            
            //==============Berkas Pendaftaran========================
            
             var temp = document.getElementById("detail_pasPhoto");
            temp.innerHTML=data.Pas_Photo;
            
            var temp = document.getElementById("detail_SKHUN");
            temp.innerHTML=data.SKHUN;
            
            var temp = document.getElementById("detail_akteKelahiran");
            temp.innerHTML=data.Akte_Kelahiran;
            
            var temp = document.getElementById("detail_ijazah");
            temp.innerHTML=data.Ijazah;
            
            var temp = document.getElementById("detail_rapor");
            temp.innerHTML=data.Rapor;
            
            var temp = document.getElementById("detail_berkas");
            temp.innerHTML='<a href="http://'+data.berkas+'">Download</a>';
            
          //==============Print Preview========================
            document.getElementById('detail_printNomerTes').innerHTML=data.Nomer_Tes;
            document.getElementById('detail_printNama').innerHTML=data.Nama_Mhs;
            document.getElementById('detail_printJK').innerHTML=data.JK;
            document.getElementById('detail_printTempatLahir').innerHTML=data.Tempat_Lahir;
            document.getElementById('detail_printTanggalLahir').innerHTML=data.Tanggal_Lahir;
            document.getElementById('detail_printWargaNegara').innerHTML=data.wn;
            document.getElementById('detail_printAgama').innerHTML=data.Agama;
            document.getElementById('detail_printAsalSMU').innerHTML=data.Nama_SMU;
            document.getElementById('detail_printAlamatSMU').innerHTML=data.Alamat_SMU;
            document.getElementById('detail_printKotaSMU').innerHTML=data.Kota_SMU;
            document.getElementById('detail_printJurusan').innerHTML=data.Jurusan;
            document.getElementById('detail_printNamaAyah').innerHTML=data.Nama_Ayah;
            document.getElementById('detail_printPekerjaanAyah').innerHTML=data.Pekerjaan_Ayah;
            document.getElementById('detail_printNamaIbu').innerHTML=data.Nama_Ibu;
            document.getElementById('detail_printPekerjaanIbu').innerHTML=data.Pekerjaan_Ibu;
            document.getElementById('detail_printAlamatOrtu').innerHTML=data.Alamat_Ortu;
            document.getElementById('detail_printKota').innerHTML=data.Kota_Ortu;
            document.getElementById('detail_printPropinsi').innerHTML=data.Provinsi;
            document.getElementById('detail_printTelepon').innerHTML=data.Telp_Ortu;
            document.getElementById('detail_printAnakKe').innerHTML=data.Anak_ke;
            document.getElementById('detail_printJumlahSaudara').innerHTML=data.jmlsdr;
            document.getElementById('detail_printProdi').innerHTML=data.Prodi;
            document.getElementById('detail_printAlamat').innerHTML=data.Alamat;
            document.getElementById('namattd').innerHTML=data.Nama_Mhs;
            document.getElementById('nama_kartu').innerHTML=data.Nama_Mhs;
            document.getElementById('no_kartu').innerHTML=data.Nomer_Tes;
            document.getElementById('prodi_kartu').innerHTML=data.Prodi;
            document.getElementById('bahan_ujian_kartu').innerHTML=data.ujian;
            
            
            }
           }
        } 
    );
 }   
            
            
            //=======Data Camaba==================================
//            $(".item-row-data").remove();
//            $(".item-row-title").after(data.Data_Akademis);
//            
//            $(".item-row-data-RA").remove();
//            $(".item-row-title-RA").after(data.Data_Riwayat_Akademik);
            

$("#editData").click(function(){
    var temp = document.getElementById("detail_Id_Camaba");
    var id=temp.innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

$("#print").click(function(){
    $("#detail_preview").show();
    $("#view").hide();
    $("#form").hide();
    $("#detail").hide();
});

function cekFileUploaded(){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_camaba/cekFileUploaded",
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
	var string = "Id_Camaba="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_camaba/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
			     
				$("#view").hide();
                $("#detail").hide();
				$("#form").show();
                hideFormEdit();
                $("#form_dataDiri").show();
                
                document.getElementById('form_Id_Camaba').readOnly=true;
                
                $("#form_Id_Camaba").val(data.Id_Camaba);
                $("#nrp").val(data.NRP);
                var temp = document.getElementById("form_photo_img").setAttribute('src',data.URL_Photo);
                
                $("#form_notes").val(data.Nomer_Tes);
                $("#form_prodi").val(data.Prodi);
                $("#form_kelas").val(data.Kelas);
                $("#form_tglMasuk").datebox('setValue', data.Tgl_Masuk);
    //val(data.Tgl_Masuk);
                $("#form_jalurMasuk").val(data.Jalur);
    //alert(data.Nama_Mhs);
                $("#form_tahunMasuk").val(data.Tahun_Masuk);
                $("#form_semesterMasuk").val(data.Semester_Masuk);
                $("#form_statusMasuk").val(data.Status_Masuk);
                $("#form_batasStudi").val(data.Batas_Studi);
                
                $("#form_nama").val(data.Nama_Mhs);
                $("#form_alamat").val(data.Alamat);
                $("#form_kota").val(data.Kota_Asal_Mhs);
                $("#form_alamatAsal").val(data.Alamat_Asal_Mhs);
                $("#form_kotaAsal").val(data.Kota_Asal_Mhs);
                $("#form_provinsi").val(data.Provinsi);
                $("#form_provinsi").val(data.Provinsi);
                    
                  if(data.JK=="L")  
                $("#form_jk_l").prop("checked",true);
                else
                $("#form_jk_p").prop("checked",true);
                
                $("#form_tempatLahir").val(data.Tempat_Lahir);
                $("#form_tglLahir").datebox('setValue', data.Tanggal_Lahir);
                $("#form_anak").val(data.Anak_ke);
                $("#form_jmlSdr").val(data.jmlsdr);
                
                   if(data.wn=="WNI")  
                $("#form_wn_i").prop("checked",true);
                else
                $("#form_wn_a").prop("checked",true);
                //$("#form_wn : checked").val(data.wn);              
                $("#form_agama").val(data.Agama);
                $("#form_telepon").val(data.Telepon);
                $("#form_hp").val(data.HP);
                $("#form_email").val(data.Email);
                $("#form_jurusan").val(data.Jurusan);
                $("#form_nilaiUAN").val(data.Nilai_UAN);
                $("#form_informasi").val(data.Asal_Informasi);
                
                $("#form_pekerjaanMhs").val(data.Pekerjaan_Mhs);
                $("#form_namaKantor").val(data.Nama_Kantor);
                $("#form_alamatKantor").val(data.Alamat_Kantor);
                $("#form_teleponKantor").val(data.Telp_Kantor);
                $("#form_statusReg").val(data.Status_Registrasi);
                $("#form_statusDaftar").val(data.Status_Daftar);
                //$("#form_statusCamaba").val(data.Status_Camaba);
                
                
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
                
                ////==============Berkas Pendaftaran========================
                if(data.SKHUN=="yes")
                    $("#form_skhun").prop("checked", true);
                $("#form_skhun").val(data.SKHUN);
                if(data.Pas_Photo=="yes")
                    $("#form_pasPhoto").prop("checked", true);
                //$("#form_pasPhoto").val(data.Pas_Photo);
                if(data.Akte_Kelahiran=="yes")
                    $("#form_akte").prop("checked",true);
                
                if(data.Ijazah=="yes")
                    $("#form_ijazah").prop("checked",true);
                if(data.Rapor=="yes")
                $("#form_rapor").prop("checked",true);
                
                showDetailSekolah(data.Kode_SMU);
                $("#saveas").val('edit');
				return false;
			}
	});
}

$("#simpan").click(function(){
        var idCamaba = $("#form_Id_Camaba").val();
        var nrp = $("#nrp").val();
        var notes = $("#form_notes").val();
        var prodi = $("#form_prodi").val();
        var kelas = $("#form_kelas").val();
        var tglmasuk = $("#form_tglMasuk").datebox('getValue');

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

        if($("#form_jk_l").is(":checked"))  
            var jk="L";
        else
            var jk="P";
        //var jk =$("#form_jk:checked").val();
        var tempatLahir =$("#form_tempatLahir").val();
        var tanggalLahir =$("#form_tglLahir").datebox('getValue');
        var anak = $("#form_anak").val();
        var jmlsaudara = $("#form_jmlSdr").val();
        
        if($("#form_wn_i").is(":checked"))  
            var warganegara="WNI";
        else
            var warganegara="WNA";
        
        //var warganegara = $("#form_wn:checked").val();
        
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
        //var statusCamaba = $("#form_statusCamaba").val();
        
        var sekolah = $("#form_sekolah").val();
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
        
        //var rapor = $("#form_rapor").val();
        
        var saveas =$("#saveas").val();
        var urlFoto = document.getElementById('form_photo_img').getAttribute('src');
       // var url_file_berkas = document.getElementById('form_url_berkas').getAttribute('src');
		
		var string = "nrp="+nrp+"&Id_Camaba="+idCamaba+"&nomer_tes="+notes+"&prodi="+prodi+"&kelas="+kelas+"&tglMasuk="+tglmasuk+"&jalurMasuk="+jalurmasuk+"&tahunMasuk="+thmasuk+"&semesterMasuk="+semestermasuk+"&statusMasuk="+statusmasuk+"&batasStudi="+batasstudi+
        "&namaMhs="+namaMhs+"&jk="+jk+"&tempatLahir="+tempatLahir+"&anak="+anak+"&jmlSdr="+jmlsaudara+"&tanggalLahir="+tanggalLahir+"&wn="+warganegara+
        "&agama="+agama+"&telepon="+telepon+"&hp="+hp+"&email="+email+"&jurusan="+jurusan+"&UAN="+uan+"&informasi="+informasi+"&alamat="+alamat+"&kota="+kota+"&alamatAsal="+alamatAsal+
        "&kotaAsal="+kotaAsalMhs+"&provinsi="+provinsi+"&pekerjaanMhs="+pekerjaanMhs+"&namaKantor="+namakantor+"&alamatKantor="+alamatkantor+
        "&teleponKantor="+teleponkantor+"&namaAyah="+namaAyah+"&noKTPAyah="+noKTPAyah+
        "&pekerjaanAyah="+pekerjaanAyah+"&namaIbu="+namaIbu+"&noKTPIbu="+noKTPIbu+"&pekerjaanIbu="+pekerjaanIbu+"&alamatOrtu="+alamatOrtu+"&kotaOrtu="+kotaOrtu
        +"&teleponOrtu="+teleponOrtu+"&hpOrtu="+hpOrtu+"&namaWali="+namaWali+"&noKTPWali="+noKTPWali+"&pekerjaanWali="+pekerjaanWali+"&alamatWali="+alamatWali
        +"&kotaWali="+kotaWali+"&teleponWali="+teleponWali+"&hpWali="+hpWali+"&urlFoto="+urlFoto+"&sekolah="+sekolah+"&statusReg="+statusReg+"&statusDaftar="+statusDaftar+"&skhun="+skhun+"&pasPhoto="+photo+
        "&akte="+akte+"&ijazah="+ijazah+"&rapor="+rapor+"&saveas="+saveas;
        		
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
				title:'Siakad',
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
				msg:'Asal sekolah harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#form_sekolah").focus();
			return false;
		}
        
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_camaba/simpanEdit",
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
			url		: "<?php echo site_url(); ?>/rf_pmb_camaba/detailSekolah",
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


<div id="detail_preview">

<div id="printable">

<fieldset class="atas">

<table width="100%" id="header_cetak">
    <tr>
        <td colspan="4"><img src="<?php echo base_url()."asset/img/Kop_PMB.png"?>" width="10%"/></td>
    </tr>
    
</table>

<table id="detail_preview" width="100%">
<tr>
	<td width="100px">Nomer Tes</td>
    <td width="10">:</td>
    <td id="detail_printNomerTes" ></td>   	
</tr>

<tr>    
   	<td>Prodi</td>
    <td>:</td>
    <td style="font-weight: bold;"id="detail_printProdi"></td>
</tr>

<tr>    
	<td>Nama</td>
    <td>:</td>
    <td id="detail_printNama"></td>
</tr>

<tr>    
	<td>Jenis Kelamin</td>
    <td>:</td>
    <td id="detail_printJK"></td>
</tr>

<tr>    
	<td>Tempat Lahir</td>
    <td>:</td>
    <td id="detail_printTempatLahir"></td>
</tr>

<tr>    
	<td>Tanggal Lahir</td>
    <td>:</td>
    <td id="detail_printTanggalLahir"></td>
</tr>

<tr>    
   	<td>Alamat</td>
    <td>:</td>
    <td id="detail_printAlamat"></td>
</tr>

<tr>    
	<td>Warga Negara</td>
    <td>:</td>
    <td id="detail_printWargaNegara"></td>
</tr>

<tr>    
	<td>Agama</td>
    <td>:</td>
    <td id="detail_printAgama"></td>
</tr>

<tr>    
	<td>Anak Ke</td>
    <td>:</td>
    <td id="detail_printAnakKe"></td>
</tr>

<tr>    
	<td>Jumlah Saudara Kandung</td>
    <td>:</td>
    <td id="detail_printJumlahSaudara"></td>
</tr>
<tr>
 
    <td><h4>ASAL SMU</h4></td> 
</tr>
<tr>    
	<td>Asal SMU</td>
    <td>:</td>
    <td id="detail_printAsalSMU"></td>
</tr>

<tr>    
	<td>Alamat SMU</td>
    <td>:</td>
    <td id="detail_printAlamatSMU"></td>
</tr>

<tr>    
	<td>Kota SMU</td>
    <td>:</td>
    <td id="detail_printKotaSMU"></td>
</tr>

<tr>    
	<td>Jurusan</td>
    <td>:</td>
    <td id="detail_printJurusan"></td>
</tr>

<tr>
    <td><h4>ORANG TUA</h4></td> 
</tr>
<tr>   
    <td>Nama Ayah</td>
    <td>:</td>
    <td id="detail_printNamaAyah"></td>
</tr>

<tr>    
	<td>Pekerjaan Ayah</td>
    <td>:</td>
    <td id="detail_printPekerjaanAyah"></td>
</tr>

<tr>    
	<td>Nama Ibu</td>
    <td>:</td>
    <td id="detail_printNamaIbu"></td>
</tr>

<tr>    
	<td>Pekerjaan Ibu</td>
    <td>:</td>
    <td id="detail_printPekerjaanIbu"></td>
</tr>

<tr>    
	<td>ALamat Orang Tua</td>
    <td>:</td>
    <td id="detail_printAlamatOrtu"></td>
</tr>

<tr>    
	<td>Kota</td>
    <td>:</td>
    <td id="detail_printKota"></td>
</tr>

<tr>    
	<td>Propinsi</td>
    <td>:</td>
    <td id="detail_printPropinsi"></td>
</tr>

<tr>    
	<td>Telepon</td>
    <td>:</td>
    <td id="detail_printTelepon"></td>
</tr>
</table>
<br />
<!-----------------------tabel print tanda tangan---------------------------------!>
<table>
<tr>
    <td style="width: 300px;"></td>
    <td style="text-align: justify;">
        Tanda Tangan Calon Mahasiswa
        <br /> Malang, <?php echo date("d-m-Y")?>
        <br />
        <br />
        <br />
        <br />
        <br />
        <div style="text-align:center;" id="namattd"></div>
    </td>
</tr>
</table>
<br />

<!-----------------------tabel print materi ujian---------------------------------!>

<table width="80%" style="border-top: solid; border-top-style: dashed; border-bottom: solid; border-bottom-style: dashed;" >
    <tr>
        <td style="width: 10px; vertical-align: top; ">
        PMB 2014<br />
        MATERI DAN PELAKSANAAN UJIAN
        
        <table width="100%" style="border: solid;">
            <tr>
                <td><div id="bahan_ujian_kartu"></div></td>
                <td>Aturan:<br />
                    <table style="border: solid; border-width: 1;">
                        <tr>
                            <td>- Membawa Bolpoint<br />
                            - Bersepatu<br />
                            - Baju Berkerah
                            </td>
                        </tr>
                    </table>  
             </td>
       </td>
       
       
       
             </tr>
     <!---------------------------------error------------------!>       
             <tr> 
                <td colspan="2">
                  <table>
                        <tr> 
                            <td>Tanggal Ujian</td>
                            <td>:</td>
                            <td><div id="tanggal_ujian" class="clickable" ><?php echo date("d-m-Y")?></div> 
                            <div id="datebox"  style="display: none;"> 
                               <input type="text" id="tgl_ujian" name="tgl_ujian" class="easyui-datebox" />
                               <button type="button" name="btn" id="btn" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" >OK</button>                                                     
                            </div>
                            </td>
                        </tr>
                    </table>
               </td>
             </tr> 
         <!---------------------------------error------------------!>  
          
         <!---------------------------------error2------------------!>   
       <tr>
            <td>
                <table>
                    <tr>
                            <td>Waktu Ujian</td>
                            <td>:</td>
                            <td><div id="waktu_ujian" class="clickable">00.00</div>
                            <div id="waktuUjian" style="display: none;">
                            <input class="easyui-timespinner" id="spinner" name="spinner"style="width:80px;" />
                            <button type="button" name="btn1" id="btn1" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" >Set Time</button>
                            </div>
                            </td>
                            
                    </tr>  
                </table>
            </td>
         </tr>
                 
         <!---------------------------------error2------------------!>    
         
          <tr>
            <td colspan="2">
            <table>
                            <td style="vertical-align: top;">Tempat Ujian</td>
                            <td>:</td>
                            <td>Kampus STIKI Jl.Tidar 100 Malang <br />Telp.0341-560823 564006, 566159</td>
         </tr> 
         </td>
         </table>
       </table>
        
        
        <td style="width: 200px; vertical-align: top;">
        <div style="text-align: center; font-weight: bold; " >KARTU PESERTA UJIAN MASUK</div>
        
        <table widht="100%" style="border-left: solid; border-left-style: dotted;">
            <tr>
                <td>NAMA</td>
                <td>:</td>
                <td id="nama_kartu"></td>
            </tr>
            <tr>
                <td>NO FORM</td>
                <td>:</td>
                <td id="no_kartu"></td>
            </tr>
            <tr>
                <td>PILIHAN PRODI</td>
                <td>:</td>
                <td style="font-weight: bold;"id="prodi_kartu"></td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <br /> 
                    <table style="border: solid; border-style: dotted; border-width: medium; border-width: thin;">
                            
                    <td style="width: 125px; height: 125px;"></td>   
                    </table>
                
                </td>
            </tr>
            
            <tr>
            <td></td>
            <td></td>
            <td></td>
                <td><br />Malang,  <?php echo date("d-m-Y")?></td>
        </td>
            </tr>
            
            <tr>
             <td></td>
             <td></td>
             <td></td>

            <td>PANITIA PMB</td>
            </tr>
        </table>
        
    </tr>
</table>
<!------!>

</fieldset>
</div>


<!------------end div printable----------------!>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="2" align="center">
    <button type="button" name="kembali_print" id="kembali_print" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    <button type="button" name="ekspor_pdf" id="ekspor_pdf" class="easyui-linkbutton" data-options="iconCls:'icon-docmnt-pdf'">EKSPOR PDF</button>
    </td>
</tr>
</table>  
</fieldset>  

</div>




<div id="detail">
<fieldset class="atas">
<table id="detail" width="100%">

<tr>    
	<td>ID Daftar</td>
    <td>:</td>
    <td id="detail_Id_Camaba"></td>
</tr>

<tr>
	<td width="10%">NRP</td>
    <td width="5">:</td>
    <td  style="font-weight: bold;"width="30%" id="detail_nrp" ></td>
    <td rowspan="10" id="detail_photo"></td>
</tr>

<tr>    
	<td>Nomer Tes</td>
    <td>:</td>
    <td id="detail_notes"></td>
</tr>

<tr>    
	<td>Program Studi</td>
    <td>:</td>
    <td id="detail_prodi"></td>
</tr>

<tr>    
	<td>Kelas</td>
    <td>:</td>
    <td id="detail_kelas"></td>
</tr>

<tr>    
	<td>Tanggal Masuk</td>
    <td>:</td>
    <td id="detail_tglMasuk"></td>
</tr>

<tr>    
	<td>Jalur Masuk</td>
    <td>:</td>
    <td id="detail_jalur"></td>
</tr>

<tr>    
	<td>Tahun Masuk</td>
    <td>:</td>
    <td id="detail_tahunMasuk"></td>
</tr>

<tr>    
	<td>Semester Masuk</td>
    <td>:</td>
    <td id="detail_semesterMasuk"></td>
</tr>

<tr>    
	<td>Status Masuk</td>
    <td>:</td>
    <td id="detail_statusMasuk"></td>
</tr>

<tr>    
	<td>Batas Studi</td>
    <td>:</td>
    <td id="detail_batasStudi"></td>
</tr>



</table>
</fieldset>

<!-----------------------Detail Data Diri---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Detail Data Pribadi</div></td>
</tr>

<tr>    
	<td>Nama Mhs</td>
    <td>:</td>
    <td id="detail_nama"></td>
    <td>Jurusan</td>
    <td>:</td>
    <td id="detail_jurusan"></td>
     <td>Nilai UAN</td>
    <td>:</td>
    <td id="detail_nilaiUAN"></td>
</tr>
     
 </tr>

<tr>
	<td width="10%">Jenis Kelamin</td>
    <td width="1%">:</td>
    <td width="20%" id="detail_jk" ></td>   
	<td width="10%">Agama</td>
    <td width="1%">:</td>
    <td width="15%" id="detail_agama"></td>
    <td width="10%">Asal Informasi</td>
    <td width="1%">:</td>
    <td id="detail_asalInformasi"></td>

   

<tr>    
	<td>Alamat</td>
    <td>:</td>
    <td id="detail_alamatMhs"></td>
    
    
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td id="detail_tanggalLahir"></td>
     <td>E-mail</td>
    <td>:</td>
    <td id="detail_email"></td>
</tr>

<tr>    
	<td>Kota</td>
    <td>:</td>
    <td id="detail_kotaMhs"></td>
    <td>Tempat Lahir</td>
    <td>:</td>
    <td id="detail_tempatLahir"></td>
    <td>Pekerjaan</td>
    <td>:</td>
    <td id="detail_pekerjaanMhs"></td>
</tr>   

<tr>   
   	<td width="10%">Telepon</td>
    <td width="2">:</td>
    <td width="20%" id="detail_telepon"></td>
    <td>Anak ke</td>
    <td>:</td>
    <td id="detail_anak"></td>
	<td>Nama Kantor</td>
    <td>:</td>
    <td id="detail_namaKantor"></td>
   	
</tr>

<tr>    
   	<td>Handphone</td>
    <td>:</td>
    <td id="detail_hp"></td>
    <td>Jumlah Saudara Kandung</td>
    <td>:</td>
    <td id="detail_jmlSaudara"></td>
    <td>Alamat Kantor</td>
    <td>:</td>
    <td id="detail_alamatKantor"></td>

</tr>

<tr>    
	<td>Alamat Asal</td>
    <td>:</td>
    <td id="detail_alamatAsalMhs"></td>
    <td>Warga Negara</td>
    <td>:</td>
    <td id="detail_wargaNegara"></td>
    <td>Status Daftar</td>
    <td>:</td>
    <td id="detail_statusDaftar"></td>
</tr>
 
<tr>    
	<td>Kota Asal</td>
    <td>:</td>
    <td id="detail_kotaAsalMhs"></td>
    <td>Telepon Kantor</td>
    <td>:</td>
    <td id="detail_teleponKantor"></td>
    <td>Status Camaba</td>
    <td>:</td>
    <td  style="font-size: large; font-weight: bold;"id="detail_statusCamaba"></td>
</tr>

<tr>   
    <td>Provinsi</td>
    <td>:</td>
    <td id="detail_provinsi"></td>
    <td>Status Daftar Ulang</td>
    <td>:</td>
    <td style="font-weight: bold;" id="detail_statusRegistrasi"></td>
</tr>
</table>
</fieldset>

<!-----------------------Detail Orang Tua---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Detail Data Orang Tua</div></td>
</tr>
<tr>
	<td width="10%">Nama Ayah</td>
    <td width="1%">:</td>
    <td width="20%" id="detail_namaAyah" ></td>
	<td width="10%">Alamat Orang Tua</td>
    <td width="1%">:</td>
    <td id="detail_alamatOrtu"></td>
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

<!----------------------- Detail Wali Mahasiswa---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Detail Data Wali</div></td>
</tr>
<tr>
	<td width="10%">Nama Wali</td>
    <td width="1%">:</td>
    <td width="20%"id="detail_namaWali" ></td>
   	<td width="10%">Pekerjaan Wali</td>
    <td width="1%">:</td>
    <td id="detail_pekerjaanWali"></td>
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

<!-----------------------Detail Asal Sekolah Menengah---------------------------------!>
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Detail Asal Sekolah</div></td>
</tr>
<tr>
	<td width="10%">Nama</td>
    <td width="1%">:</td>
    <td width="20%"id="detail_namaSMU" ></td>
   	<td width="10%">Telepon</td>
    <td width="1%">:</td>
    <td id="detail_teleponSMU"></td>
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
<!-----------------------Detail Berkas Pendaftaran---------------------------------!>

<fieldset class="atas">
<table id="detail" width="100%">
<tr>
    <td colspan="4"><div id="tabelTitle">Berkas Pendaftaran</div></td>
</tr>
<tr>
	<td width="10%">Pas Photo</td>
    <td width="1%">:</td>
    <td width="20%"id="detail_pasPhoto" ></td>
   	<td width="10%">SKHUN</td>
    <td width="1%">:</td>
    <td id="detail_SKHUN"></td>
</tr>
<tr>    
	<td>Akte Kelahiran</td>
    <td>:</td>
    <td id="detail_akteKelahiran"></td>
   	<td>Ijazah</td>
    <td>:</td>
    <td id="detail_ijazah"></td>
</tr>
<tr>    
   	<td>Rapor</td>
    <td>:</td>
    <td id="detail_rapor"></td>
</tr>

<tr>    
   	<td>Berkas</td>
    <td>:</td>
    <td id="detail_berkas"> </td>
</tr>


</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="editData" id="editData" class="easyui-linkbutton" data-options="iconCls:'icon-edit'">UBAH</button>
    <button type="button" name="kembali_detail" id="kembali_detail" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    <button type="button" name="print" id="print" class="easyui-linkbutton" data-options="iconCls:'icon-print'">PRINT</button>
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
    <a href="<?php echo base_url();?>index.php/rf_pmb_camaba/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/rf_pmb_camaba/cari">
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
    <th>ID Daftar</th>
    <th>Nomer Tes</th>
    <th>NRP</th>
    <th>Nama Mhs</th>
    <th>Jenis Kelamin</th>    
    <th>Kelas</th>
    <th>Agama</th>
    <th>Telepon</th>
    <th>Provinsi</th>
    <th>Prodi</th>
    <th>SMU Asal</th>
    <th>Asal Informasi</th>
    <th>Status Daftar</th>
    <th>Status Daftar Ulang</th>
    
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr onclick="showDetail('<?php echo $data['Id_Camaba']; ?>')">
			<td align="center" width="50"><?php echo $no; ?></td>
            <td align="center" width="250" ><?php echo $data['Id_Camaba']; ?></td>
            <td align="center" width="250" ><?php echo $data['Nomer_Tes']; ?></td>
            <td align="center" width="160" ><?php echo $data['NRP']; ?></td>
            <td align="center" width="250"><?php echo $data['Nama_Mhs']; ?></td>
            <td align="center" width="250"><?php echo $data['JK']; ?></td>
            <td align="center" width="50"><?php echo $data['Kelas']; ?></td>
            <td align="center" width="100"><?php echo $data['Agama']; ?></td>
            <td align="center" width="75"><?php echo $data['Tlp_HP']; ?></td>
            <td align="center" width="25"><?php echo $data['Nama_Prop']; ?></td>
            <td align="center" width="100"><?php echo $data['Nama_Prodi']; ?></td>
            <td align="center" width="150"><?php echo $data['Asal_SMU']; ?></td>
            <td align="center" width="300"><?php echo $data['Nama_Informasi']; ?></td>
            <td align="center" width="350"><?php echo $data['Status_Daftar']; ?></td>
            <td align="center" width="350"><?php echo $data['Status_Reg']; ?></td>        

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
<td colspan="4"><div id="tabelTitle">Edit Data Camaba</div></td>
</tr>
<tr>
	<td>ID Daftar</td>
    <td>:</td>
    <td><input type="text" name="form_Id_Camaba" id="form_Id_Camaba"  size="5" maxlength="254"/></td>
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
        <iframe id="frame_upload" src="<?php echo site_url(); ?>/rf_pmb_camaba/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:60px;">
        </iframe>
        <input type="hidden" name="namaFile" id="namaFile"  size="50" maxlength="254" />
    </td>
</tr>

<tr>
	<td>Nomer Tes</td>
    <td>:</td>
    <td><input type="text" name="form_notes" id="form_notes"  size="15" maxlength="20"/></td>
</tr>

<tr>    
	<td>Prodi</td>
    <td>:</td>
    <td>
    <select name="form_prodi" id="form_prodi" class="combo">
    <option value="0">-PILIH-</option>
    <?php
        foreach($Prodi->result()as $t){
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
    <td><input type="text" name="form_tglMasuk" id="form_tglMasuk"  class="easyui-datebox"/></td>
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
    <td><input type="text" name="form_tahunMasuk" id="form_tahunMasuk"  size="5" maxlength="4"/></td>
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
    <td><input type="text" name="form_batasStudi" id="form_batasStudi"  size="5" maxlength="4"/></td>
</tr>


<tr>
	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name="form_nama" id="form_nama"  size="50" maxlength="99" style="text-transform: uppercase;"/></td>
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
	foreach($provinsi->result() as $t){
	?>
    <option value="<?php echo $t->Kode_Prop;?>"><?php echo $t->Nama_Prop;?></option>
    <?php } ?>
    </select>
    </td>
</tr>


<tr>
<td><?php echo form_label('Jenis Kelamin: ', 'jenis kelamin'); ?></td>
<td>:</td>
<td>
<?php echo form_radio(array("name"=>"form_jk","id"=>"form_jk_l","value"=>"L",
'checked'=>set_radio('jk', 'L', true))). form_label('Laki-laki', 'laki_laki'); ?>



<?php echo form_radio(array("name"=>"form_jk","id"=>"form_jk_p","value"=>"P", 'checked'=>set_radio('jk', 'P', false))) .form_label('Perempuan', 'perempuan')
;?>
</td>
<td><?php echo form_error('jk'); ?></td>
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
	<td>Anak ke</td>
    <td>:</td>
    <td><input type="text" id="form_anak" name="form_anak" size="5" maxlength="2"/></td>
</tr>

<tr>
	<td>Jumlah Saudara</td>
    <td>:</td>
    <td><input type="text" name="form_jmlSdr" id="form_jmlSdr"  size="5" maxlength="2"/></td>
</tr>

<tr>
<td><?php echo form_label('Warga Negara: ', 'warga negara'); ?></td>
<td>:</td>
<td>
<?php echo form_label('WNI', 'wni'). form_radio(array("name"=>"form_wn","id"=>"form_wn_i","value"=>"WNI",
'checked'=>set_radio('wn', 'WNI', true))); ?>
<?php echo form_label('WNA', 'wna') . form_radio(array("name"=>"form_wn","id"=>"form_wn_a","value"=>"WNA", 'checked'=>set_radio('wn', 'WNA', false)))
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
	foreach($agama->result() as $t){
	?>
    <option value="<?php echo $t->Agama_id;?>"><?php echo $t->Agama;?></option>
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
    <td><input type="text" name="form_hp" id="form_hp"  size="11" maxlength="13"/></td>
</tr>
<tr>
	<td>E-mail</td>
    <td>:</td>
    <td><input type="text" name="form_email" id="form_email"  size="20" maxlength="50"/></td>
</tr>

<tr>    
	<td>Jurusan</td>
    <td>:</td>
    <td>
    <select name="form_jurusan" id="form_jurusan" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($jurusan->result() as $t){
	?>
    <option value="<?php echo $t->Id_Jurusan;?>"><?php echo $t->Nama_Jurusan;?></option>
    <?php } ?>
    </select>
    </td>
</tr>

<tr>
	<td>Nilai UAN</td>
    <td>:</td>
    <td><input type="text" name="form_nilaiUAN" id="form_nilaiUAN"  size="4" maxlength="6"/></td>
</tr>

<tr>    
	<td>Asal Informasi</td>
    <td>:</td>
    <td>
    <select name="form_informasi" id="form_informasi" class="combo">
    <option value="0">-PILIH-</option>
    <?php
	foreach($informasi->result() as $t){
	?>
    <option value="<?php echo $t->Id_Informasi;?>"><?php echo $t->Nama_Informasi;?></option>
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
    <option value="Yes">YES</option>
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
<td colspan="4"><div id="tabelTitle">Edit Data Orang Tua</div></td>
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
<td colspan="4"><div id="tabelTitle">Edit Data Wali</div></td>
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
<td colspan="4"><div id="tabelTitle">Edit Asal Sekolah</div></td>
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
<td colspan="4"><div id="tabelTitle">Edit Berkas Pendaftaran</div></td>
</tr>
<tr>
	<td width="10%">SKHUN</td>
    <td width="5">:</td>
    <td  width="100%"><input type="checkbox" name="form_skhun" id="form_skhun" /></td>
    
   <!-- <td height="0%" ></td>
    <td rowspan="5" style="vertical-align: bottom;">
    <img id="form_url_berkas" src="" width="200px"/>
    <iframe id="frame_upload" src="<?php echo site_url(); ?>/tr_pmb_insert_data/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:40px;">
        </iframe>
     <input type="hidden" name="namaFileBerkas" id="namaFileBerkas"  size="50" maxlength="254" />
 </td>    -->
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
