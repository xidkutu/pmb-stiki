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
    $("#inputan").hide(); 
    $("#conditional").hide();
 });
 
    $.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return d+'-'+m+'-'+y;
    }
 
$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/prodi');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});

function kosong(){
	$("#kodeProdi").val('');
    $("#namaProdi").val('');
    $("#saveas").val('baru');
    $("#view").hide();
	$("#form").show();
    document.getElementById('form_photo_img').setAttribute('src','');
    document.getElementById('kodeProdi').readOnly=false;
	$("#kodeProdi").focus();
	return false;
};

$("#tambah").click(function(){
	kosong();
	return false;
});

$("#tambah_data").click(function(){
    kosong();
	return false;
});

var myTab = document.getElementById("dataTable");
var rows = myTab.getElementsByTagName("tr");
for(var i=0;i<rows.length;i++){
    row = myTab.rows[i];
    row.onclick = function(){
        var cell=this.getElementsByTagName("td")[1];
        var id = cell.innerHTML;
        showDetail(id);
    }
}

function showDetail(id){
    var string = "id="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/set_periode_aktif/detail",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            if(data.singout=='YES'){
                location.reload();   
            }else
            {
            $("#view").hide();
            $("#form").hide();
            $("#detail").show();
            $("#button-tambah").show();
            $("#inputan").hide();  
            
            $(".det_item-row-pra").remove();
            $(".det_item-row-pra-title").after(data.periode);
            $("#kodeProdi").val(id);
            }
        }
    });
}   

$("#editData").click(function(){
    var temp = document.getElementById("detail_kode_prodi");
    var id=temp.innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/prodi/detail",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
    			if(data.singout=='YES'){
                    location.reload();   
                }else
                {
    				$("#view").hide();
                    $("#detail").hide();
    				$("#form").show();
                    //document.getElementById('form_photo_img').setAttribute('src','');
//                    //console.log(show_pra_mk(data.kodemk_pra));
//                    $('#kodeProdi').val(data.Kode_Prodi);
//                    $('#jenjang').val(data.Jenjang);
//                    $('#namaProdi').val(data.Nama_Prodi);
//                    $('#tglBerdiri').datebox('setValue',data.Tanggal_Berdiri);
//                    $('#email').val(data.Email);
//                    $('#sksLulus').val(data.SKS_Lulus);
//                    $('#kaprodi').val(data.Nip_Kaprodi);
//                    $('#telpKaprodi').val(data.Telepon_Kaprodi);
//                    $('#telpKantorKaprodi').val(data.Telepon_Kantor_Kaprodi);
//                    $('#faxKantorKaprodi').val(data.Fax_Kantor_Kaprodi);
//                    $('#operator').val(data.NIP_Operator);
//                    $('#telpOperator').val(data.Telepon_Operator);
//                    $('#noSKDikti').val(data.Nomor_SK_Dikti);
//                    $('#tglSKDikti').datebox('setValue',data.Tanggal_SK_Dikti);
//                    $('#noSKBanpt').val(data.Nomor_SK_BANPT);
//                    $('#tglSKBanpt').datebox('setValue',data.Tanggal_SK_BANPT);
//                    $('#akreditasi').val(data.Akreditasi);
//                    $('#isAktif').val(data.isAktif);
//                    $('#tglNonAktif').datebox('setValue',data.Tanggal_SK_BANPT);
//                    $('#semesterNonAktif').val(data.Semester_NonAktif);
//                    
//                    document.getElementById('form_photo_img').setAttribute('src',data.URL_Sertifikat_Akreditasi);
//                    document.getElementById('kodeProdi').readOnly=true;
//                    $("#conditional").show();
//                    $("#saveas").val('edit');
    				return false;
                    }
			}
	});
}

$("#simpanPeriode").click(function(){
		var kodeProdi = $("#kodeProdi").val();
        var tahun = $("#tahun").val();
        var semester = $("#form_periodeSem").val();
        var tglMulai = $("#form_tglMulai").datebox('getValue');
        var tglAkhir = $("#form_tglAkhir").datebox('getValue');
        		
        var string = "kodeProdi="+kodeProdi+"&tahun="+tahun+"&semester="+semester+"&tglMulai="+tglMulai+"&tglAkhir="+tglAkhir;

		if(tahun.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Tahun harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#tahun").focus();
			return false;
		}
        if(semester.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Semester harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_periodeSem").focus();
			return false;
		}
        if(tglMulai.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Tanggal mulai berlaku periode harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_tglMulai").focus();
			return false;
		}
        if(tglAkhir.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Tanggal akhir berlaku periode harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#form_tglAkhir").focus();
			return false;
		}
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/set_periode_aktif/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='logout'){
				    location.reload();   
				}else
                $.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
                showDetail(kodeProdi);
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

//----------------------------------Validasi Input------------------------------------------------------------//

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which:event.keyCode
    if(charCode >31 && (charCode<48 || charCode>57)) return false; return true;
};


$("#tambahPeriode").click(function(){
    $("#button-tambah").hide();
    $("#inputan").show();
})

$("#batalPeriode").click(function(){
    $("#button-tambah").show();
    $("#inputan").hide();
})

$("#tahun").blur(function(){
    if($("#tahun").val().length!=0 && $("#form_periodeSem").val().length!=0){
        periksaPeriode($("#kodeProdi").val(),$("#tahun").val(),$("#form_periodeSem").val())   
    }
})

$("#form_periodeSem").change(function(){
    if($("#tahun").val().length!=0 && $("#form_periodeSem").val().length!=0){
        periksaPeriode($("#kodeProdi").val(),$("#tahun").val(),$("#form_periodeSem").val())   
    }
})

function periksaPeriode(kodeProdi,tahun,semester){
    var string = "kodeProdi="+kodeProdi+"&tahun="+tahun+"&semester="+semester;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/set_periode_aktif/periksaPeriode",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            if(data.singout=='YES'){
                location.reload();   
            }else
            {
                if(data.isExist=="YES") document.getElementById("msg_periode").innerHTML="Periode semester sudah digunakan"
                else document.getElementById("msg_periode").innerHTML="";
            }
        }
    });   
}
</script>

<div id="detail">
<fieldset class="atas">
<div id="button-tambah"><tr>
    <button type="button" name="tambahPeriode" id="tambahPeriode" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah</button>
</div>
<div id="inputan">
<table>
<tr>
    <td width="150">Tahun</td>
    <td width="5">:</td>
    <td><input type="text" name="tahun" id="tahun"  size="5" maxlength="4" onkeypress="return isNumberKey(event)"/>
    <input type="hidden" name="kodeProdi" id="kodeProdi"  size="50" maxlength="50"/>
    </td>
</tr>
<tr>
    <td width="150">Semester</td>
    <td width="5">:</td>
    <td>
        <select name="form_periodeSem" id="form_periodeSem" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach(explode("','",substr($periode_sem,6,-2)) as $option){
    	?>
        <option value="<?php echo $option;?>"><?php echo $option;?></option>
        <?php } ?>
        </select>
        <div class="errMsg" id="msg_periode"></div>
    </td>
</tr>
<tr>
    <td width="150">Tanggal Mulai</td>
    <td width="5">:</td>
    <td><input type="text" id="form_tglMulai" name="form_tglLahir" class="easyui-datebox"/></td>
</tr>
<tr>
    <td width="150">Tanggal Akhir</td>
    <td width="5">:</td>
    <td><input type="text" id="form_tglAkhir" name="form_tglLahir" class="easyui-datebox"/></td>
</tr>
<tr>
    <td colspan="3" align="center">
    <button type="button" name="simpanPeriode" id="simpanPeriode" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Simpan</button>
    <button type="button" name="batalPeriode" id="batalPeriode" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">Batal</button>
    </td>
</tr>
</table>
<br />
</div>
<table id="detail" width="100%">
<tr>    
    <td colspan="3">
        <table id='tabelPra' class="table_data">
            <tr class="det_item-row-pra-title">
                <th>No</th>
                <th>Tahun</th>
                <th>Semester</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Aktif</th>
            </tr>
            <tr class="det_item-row-pra">
                <td colspan="6" align="center">Tidak ada data</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="3" align='center'><img id='detail_sertifikat_akreditasi' width="70%"/></td>
</tr>
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
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
    <a href="<?php echo base_url();?>index.php/set_periode_aktif/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/prodi/cari">
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
    <th>Kode Prodi</th>
    <th>Jenjang Studi</th>
    <th>Program Studi</th>
    <th>Periode Aktif</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr onclick="showDetail(<?php echo "'".$db['Kode_Prodi']."'"?>)">
			<td align="center" width="30"><?php echo $no; ?></td>
            <td ><?php echo $db['Kode_Prodi']; ?></td>
            <td ><?php echo $db['Nama_Jenjang']; ?></td>
            <td ><?php echo $db['Nama_Prodi']; ?></td>
            <td><?php echo $db['Periode_Aktif']; ?></td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="4" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>

<div id="form">
<fieldset class="atas">
<table width="100%">
<tr>
	<td width="150">Kode Program Studi</td>
    <td width="5">:</td>
    <td>
    <input type="text" name="kodeProdi" id="kodeProdi"  size="10" maxlength="10" style="text-transform: uppercase;"/>
    <input type="hidden" name="saveas" id="saveas"  size="10" maxlength="4" />
    <div class="errMsg" id="msg_kodeProdi"></div>
    </td>
</tr>
<tr>
	<td>Jenjang Program Studi</td>
    <td>:</td>
    <td>
        <select name="jenjang" id="jenjang" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach($jenjang->result() as $t){
    	?>
        <option value="<?php echo $t->Kode_Jenjang;?>"><?php echo $t->Nama_Jenjang;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
	<td>Nama Program Studi</td>
    <td>:</td>
    <td>
    <input type="text" name="namaProdi" id="namaProdi"  size="50" maxlength="100"/>
    </td>
</tr>
<tr>
    <td>Tanggal Berdiri</td>
    <td>:</td>
    <td>
        <input type="text" id="tglBerdiri" name="tglBerdiri" class="easyui-datebox"/>
    </td>
</tr>
<tr>
	<td>E-Mail</td>
    <td>:</td>
    <td>
    <input type="text" name="email" id="email"  size="30" maxlength="150"/>
    </td>
</tr>
<tr>
	<td>SKS Lulus</td>
    <td>:</td>
    <td>
    <input type="text" name="sksLulus" id="sksLulus"  size="5" maxlength="3" onkeypress="return isNumberKey(event)"/>
    </td>
</tr>
<tr>
	<td>Kepala Program Studi</td>
    <td>:</td>
    <td>
        <select name="kaprodi" id="kaprodi" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach($dosen->result() as $t){
    	?>
        <option value="<?php echo $t->NIP;?>"><?php echo $t->nama;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td>Telepon Kaprodi</td>
    <td>:</td>
    <td>
        <input type="text" name="telpKaprodi" id="telpKaprodi"  size="15" maxlength="13"/>
    </td>
</tr>
<tr>
    <td>Telepon Kantor Kaprodi</td>
    <td>:</td>
    <td>
        <input type="text" name="telpKantorKaprodi" id="telpKantorKaprodi"  size="15" maxlength="13"/>
    </td>
</tr>
<tr>
    <td>Fax Kantor Kaprodi</td>
    <td>:</td>
    <td>
        <input type="text" name="faxKantorKaprodi" id="faxKantorKaprodi"  size="15" maxlength="13"/>
    </td>
</tr>
<tr>
    <td>Operator</td>
    <td>:</td>
    <td>
        <select name="operator" id="operator" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach($pegawai->result() as $t){
    	?>
        <option value="<?php echo $t->nip;?>"><?php echo $t->nama;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td>Telepon Operator</td>
    <td>:</td>
    <td>
        <input type="text" name="telpOperator" id="telpOperator"  size="15" maxlength="13"/>
    </td>
</tr>
<tr>
    <td>Nomor SK DIKTI</td>
    <td>:</td>
    <td>
        <input type="text" name="noSKDikti" id="noSKDikti"  size="40" maxlength="100"/>
    </td>
</tr>
<tr>
    <td>Tanggal SK DIKTI</td>
    <td>:</td>
    <td>
        <input type="text" id="tglSKDikti" name="tglSKDikti" class="easyui-datebox"/>
    </td>
</tr>
<tr>
    <td>Nomor SK BAN-PT</td>
    <td>:</td>
    <td>
        <input type="text" name="noSKBanpt" id="noSKBanpt"  size="40" maxlength="100"/>
    </td>
</tr>
<tr>
    <td>Tanggal SK BAN-PT</td>
    <td>:</td>
    <td>
        <input type="text" id="tglSKBanpt" name="tglSKBanpt" class="easyui-datebox"/>
    </td>
</tr>
<tr>
    <td>Akreditasi</td>
    <td>:</td>
    <td>
        <input type="text" name="akreditasi" id="akreditasi"  size="5" maxlength="24"/>
    </td>
</tr>
<tr>
    <td>Akreditasi</td>
    <td>:</td>
    <td>
        <img id="form_photo_img" src="" width="200px"/>
        <iframe id="frame_upload" src="<?php echo site_url(); ?>/prodi/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:60px;">
        </iframe>
    </td>
</tr>
</table>
<div id="conditional">
<table>
<tr>
	<td>Aktif</td>
    <td>:</td>
    <td>
        <select name="isAktif" id="isAktif" class="combo">
        <?php
    	foreach(explode("','",substr($isAktif,6,-2)) as $option){
    	?>
        <option value="<?php echo $option;?>"><?php echo $option;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td width="150">Tanggal Non-Aktif</td>
    <td width="5">:</td>
    <td>
        <input type="text" id="tglNonAktif" name="tglNonAktif" class="easyui-datebox"/>
    </td>
</tr>
<tr>
    <td>Semester Non-Aktif</td>
    <td>:</td>
    <td>
        <select name="semesterNonAktif" id="semesterNonAktif" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach(explode("','",substr($semester,6,-2)) as $option){
    	?>
        <option value="<?php echo $option;?>"><?php echo $option;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
</table>
</div>

</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>
