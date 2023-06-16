<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
    
	$("#view").show();
    $("#detail").hide();
    $("#cetak").hide();
    $("#header_cetak").hide();
});    

    $.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return d+'-'+m+'-'+y;
    }

//function showDetail(nrp,total){
//    var string = "nrp="+nrp;
//    
//    $.ajax({
//        type    :'POST',
//        url     : "<?php echo site_url(); ?>/lp_pmb_camaba/detail",
//        data    : string,
//        cache   : true,
//        dataType : "json",
//        success : function(data){
//            if(data.signout=='YES'){
//                location.reload();
//            }else
//            {
//            $("#view").hide();
//            $("#form").hide();
//            $("#detail").show();  
//
//            document.getElementById('detail_tahun').innerHTML=data.Tahun;
//            document.getElementById('detail_periodeSem').innerHTML=data.Periode_Sem;
//            document.getElementById('detail_jenjang').innerHTML=data.Nama_Jenjang;
//            document.getElementById('detail_prodi').innerHTML=data.Nama_Prodi;
//            document.getElementById('detail_nrp').innerHTML=data.NRP;
//            document.getElementById('detail_nama').innerHTML=data.Nama_Mhs;
//            document.getElementById('detail_dosenWali').innerHTML=data.Dosen_Wali;
//            document.getElementById('totalSKS').innerHTML=total;
//            $(".det_item-row-pra").remove();
//            $(".det_item-row-pra-title").after(data.result_ambilMK);
//            
//
//            }
//        }
//    });
//}

$("#fltr_nrp").blur(function(){
    generateData();
})

$("#fltr_nama").blur(function(){
    generateData();
})

$("#fltr_jk").change(function(){
    generateData();
})

$("#fltr_kelas").change(function(){
    generateData();
})

$("#fltr_agama").change(function(){
    generateData();
})

$("#fltr_tahun").blur(function(){
    generateData();
})

$("#fltr_provinsi").change(function(){
    generateData();
})

$("#fltr_prodi").change(function(){
    generateData();
})

$("#fltr_smu").change(function(){
    generateData();
})

$("#fltr_asalInformasi").change(function(){
    generateData();
})

$("#fltr_statusDaftar").change(function(){
    generateData();
})

$("#fltr_statusReg").change(function(){
    generateData();
})

$("#fltr_tglMasuk").blur(function(){
    generateData();
})

$("#fltr_tglMasuk2").change(function(){
   generateData();
})


function generateData(){
    var nrp = $("#fltr_nrp").val();
    var nama = $("#fltr_nama").val();
    var jk = $("#fltr_jk").val();
    var kelas= $("#fltr_kelas").val();
    var agama= $("#fltr_agama").val();
    var tahun= $("#fltr_tahun").val();
    var provinsi= $("#fltr_provinsi").val();
    var prodi= $("#fltr_prodi").val();
    var smu= $("#fltr_smu").val();
    var informasi= $("#fltr_asalInformasi").val();
    var statusDaftar= $("#fltr_statusDaftar").val();
    var statusReg= $("#fltr_statusReg").val();
    var tglMasuk= $("#fltr_tglMasuk").datebox('getValue');
    var tglMasuk2= $("#fltr_tglMasuk2").datebox('getValue');
    
    var string ="nrp="+nrp+"&nama="+nama+"&jk="+jk+"&kelas="+kelas
    +"&agama="+agama+"&tahun="+tahun
    +"&provinsi="+provinsi+"&prodi="+prodi+"&smu="+smu+"&informasi="+informasi+"&statusDaftar="+statusDaftar+"&statusReg="+statusReg+
    "&tglMasuk="+tglMasuk+"&tglMasuk2="+tglMasuk2;
    
   // alert(string);
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/lp_pmb_camaba/filterData",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            if(data.Status=='OK'){
                location.reload();
            }
        }
    })
}


$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});


function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which:event.keyCode
    if(charCode >31 && (charCode<48 || charCode>57)) return false; return true;
};

//table to excell
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()




//button ekspor excell
$("#ekspor_excell").click(function(){
   $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/lp_pmb_camaba/getDataToCetak",
        cache   : true,
        dataType : "json",
        success : function(data){
            $(".cetak_data").remove();
            $(".cetak_title").after(data.laporan_camaba);
           tableToExcel('tableCetak', 'SIMARU');
        }
    }); 
})


//$("#ekspor_pdf").click(function(){
//   $.ajax({
//        type    :'POST',
//        url     : "<?php echo site_url(); ?>/lp_pmb_camaba/getDataToCetak",
//        cache   : true,
//        dataType : "json",
//        success : function(data){
//            $(".cetak_data").remove();
//            $(".cetak_title").after(data.laporan_camaba);
//            doCetak("cetak");
//           
//        }
//    }); 
//})
//
//$("#detail_ekspor_pdf").click(function(){
//  doCetak("cetak_detail"); 
//})
//
//function doCetak(isi){
//    document.getElementById("tabelPra").setAttribute("border","1");
//    var data = document.getElementById(isi).innerHTML;
//    //alert(data);
//    $.ajax({
//        type    :'POST',
//        url     : "<?php echo site_url(); ?>/pdf_exporter/generateHTML",
//        data    : data,
//        cache   : true,
//        contentType:"application/json",
//        dataType : "json",
//        converters:{'text json':true},
//        success : function(data){
//            //if(isi=='cetak')
//            //window.location.assign("<?php //echo site_url(); ?>/pdf_exporter/eksporPdfLandscape");
//            //else
//            window.location.assign("<?php echo site_url(); ?>/pdf_exporter/eksporPdf");
//                //location.reload();
//            document.getElementById("tabelPra").removeAttribute("border");
//        }
//    });
//}
//
</script>

<!--<div id="detail">
 <div>
<button type="submit" name="detail_ekspor_pdf" id="detail_ekspor_pdf" class="easyui-linkbutton" data-options="iconCls:'icon-docmnt-pdf'">Ekspor</button> 
</div> 
<br />
<fieldset class="atas">
<div id="cetak_detail">

<table width="100%" id="header_cetak">
    <tr>
        <td colspan="4"><img src="<?php echo base_url()."asset/img/Kop_BAA.png"?>" width="10%"/></td>
    </tr>
    <tr>
        <td colspan="4" align="center"><h3><?php echo $judul?></h3></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>


<table id="detail" width="100%">
<tr>
	<td width="150">Tahun</td>
    <td width="5">:</td>
    <td id="detail_tahun" ></td>
</tr>
<tr>    
	<td>Periode Semester</td>
    <td>:</td>
    <td id="detail_periodeSem"></td>
</tr>
<tr>    
	<td>Jenjang</td>
    <td>:</td>
    <td id="detail_jenjang"></td>
</tr>
<tr>    
	<td>Program Studi</td>
    <td>:</td>
    <td id="detail_prodi"></td>
</tr>
<tr>    
	<td>NRP</td>
    <td>:</td>
    <td id="detail_nrp"></td>
</tr>
<tr>    
	<td>Nama</td>
    <td>:</td>
    <td id="detail_nama"></td>
</tr>
<tr>    
	<td>Dosen Wali</td>
    <td>:</td>
    <td id="detail_dosenWali"></td>
</tr>
<tr>    
    <td colspan="3">
    <br />
    Pengambilan Mata Kuliah :
        <table id='tabelPra'>
            <tr class="det_item-row-pra-title">
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Kelas</th>
                <th>SKS</th>
                <th>Pengambilan Ke-</th>
            </tr>
            <tr class="det_item-row-pra">
                <td colspan="5" align="center">Tidak ada data</td>
            </tr>
            <tr class="tot_item-row-pra">
                <th colspan="4" align="right">Total :</th>
                <td align="right" id="totalSKS">0</td>
                <td align="left">SKS</td>
            </tr>
        </table>
    </td>
</tr>
</table>
</div>
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
-----------------not use------------------------!> 

<!--
Tampilan VIEW untuk grid data
--!>
<div id="view">

    <div style="float:left; padding-bottom:5px;">
    <a href="<?php echo base_url();?>index.php/lp_pmb_camaba/noFilter">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    <button type="button" name="ekspor_excell" id="ekspor_excell" class="easyui-linkbutton" data-options="iconCls:'icon-excel'">Export Excell</button>
    </div>
    <!-- <button type="button" name="ekspor_pdf" id="ekspor_pdf" class="easyui-linkbutton" data-options="iconCls:'icon-excell'">Export PDF</button> --!>
        
<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th rowspan="2">No</th>
    
    <th>NRP</th>
    <th>Nama Mhs</th>
    <th>Jenis Kelamin</th>    
    <th>Kelas</th>
    <th>Agama</th>
    <th>Tahun Masuk</th>
    <th>Provinsi</th>
    <th>Prodi</th>
    <th>SMU Asal</th>
    <th>Asal Informasi</th>
    <th>Status Daftar</th>
    <th>Status Daftar Ulang</th>
    <th>Dari Tanggal</th>
    <th>Sampai Tanggal</th>
</tr>
<tr>
    
    <td class="td_filter">
        <input type="text" name="fltr_nrp" id="fltr_nrp" maxlength="11" value="<?php echo $nrp; ?>" style="text-transform: uppercase;" />    
    </td>
    
    <td class="td_filter">
        <input type="text" name="fltr_nama" id="fltr_nama" maxlength="100" value="<?php echo $nama; ?>" style="text-transform: uppercase;" />
    </td>
    <td class="td_filter">
        <select name="fltr_jk" id="fltr_jk" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <option value="L" <?php if($jk=='L') echo 'selected="selected"' ?>>Laki-laki</option>
        <option value="P" <?php if($jk=='P') echo 'selected="selected"' ?>>Perempuan</option>
        </select>    
    </td>
    
    </td>
    <td class="td_filter">
        <select name="fltr_kelas" id="fltr_kelas" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <option value="R" <?php if($kelas=='R') echo 'selected="selected"' ?>>Reguler</option>
        <option value="N" <?php if($kelas=='N') echo 'selected="selected"' ?>>Non Reguler</option>
        <option value="K" <?php if($kelas=='K') echo 'selected="selected"' ?>>Kerja sama</option>
        </select> 
    </td>
    <td class="td_filter">
         <select name="fltr_agama" id="fltr_agama" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($agama->result() as $t){
    	?>
        <option value="<?php echo $t->Agama_id;?>" <?php if($t->Agama_id==$selected_agama) echo "selected='selected'";?> ><?php echo $t->Agama;?></option>
        <?php } ?>
        </select>
    </td>
    </td>
    <td class="td_filter">
        <input type="text" name="fltr_tahun" id="fltr_tahun" maxlength="11" value="<?php echo $tahun; ?>" style="text-transform: uppercase;" />
    </td>
    <td class="td_filter">
     <select name="fltr_provinsi" id="fltr_provinsi" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($provinsi->result() as $t){
    	?>
        <option value="<?php echo $t->Kode_Prop;?>" <?php if($t->Kode_Prop==$selected_provinsi) echo "selected='selected'";?> ><?php echo $t->Nama_Prop;?></option>
        <?php } ?>
        </select>
    </td>
    
    <td class="td_filter">
      <select name="fltr_prodi" id="fltr_prodi" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($prodi->result() as $t){
    	?>
        <option value="<?php echo $t->Kode_Prodi;?>" <?php if($t->Kode_Prodi==$selected_prodi) echo "selected='selected'";?> ><?php echo $t->Nama_Prodi;?></option>
        <?php } ?>
        </select> 
    </td>
    
    <td class="td_filter">
    <select name="fltr_smu" id="fltr_smu" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($SMU->result() as $t){
    	?>
        <option value="<?php echo $t->Kode_SMU;?>" <?php if($t->Kode_SMU==$selected_smu) echo "selected='selected'";?> ><?php echo $t->Asal_SMU;?></option>
        <?php } ?>
        </select>
        
    </td>
    </td>
    <td class="td_filter">
      <select name="fltr_asalInformasi" id="fltr_asalInformasi" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($asalInformasi->result() as $t){
    	?>
        <option value="<?php echo $t->Id_Informasi;?>" <?php if($t->Id_Informasi==$selected_informasi) echo "selected='selected'";?> ><?php echo $t->Nama_Informasi;?></option>
        <?php } ?>
        </select>
    </td>
    <td class="td_filter">
       <select name="fltr_statusDaftar" id="fltr_statusDaftar" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <option value="online" <?php if($statusDaftar=='online') echo 'selected="selected"' ?>>Online</option>
        <option value="offline" <?php if($statusDaftar=='offline') echo 'selected="selected"' ?>>Offline</option>
        </select>
    </td>
    
    <td class="td_filter">
       <select name="fltr_statusReg" id="fltr_statusReg" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <option value="Yes" <?php if($statusReg=='Yes') echo 'selected="selected"' ?>>YES</option>
        <option value="No" <?php if($statusReg=='No') echo 'selected="selected"' ?>>NO</option>
        </select>   
    </td>
    
    <td class="td_filter">
     <input type="text" id="fltr_tglMasuk" name="fltr_tglMasuk" class="easyui-datebox" style="width: 100%" value="<?php echo $tglMasuk?>" />
         
    </td> 
        
   <td class="td_filter">
       <input type="text" id="fltr_tglMasuk2" name="fltr_tglMasuk2" class="easyui-datebox" style="width: 100%" value="<?php echo $tglMasuk2?>"/>
        
    </td> 
    
    
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr onclick="showDetail('<?php echo $data['NRP']; ?>')">
			<td align="center" width="50"><?php echo $no; ?></td>
            <td align="center" width="160" ><?php echo $data['NRP']; ?></td>
            <td align="center" width="250"><?php echo $data['Nama_Mhs']; ?></td>
            <td align="center" width="250"><?php echo $data['JK']; ?></td>
            <td align="center" width="50"><?php echo $data['Kelas']; ?></td>
            <td align="center" width="100"><?php echo $data['Agama']; ?></td>
            <td align="center" width="75"><?php echo $data['Tahun_Masuk']; ?></td>
            <td align="center" width="25"><?php echo $data['Nama_Prop']; ?></td>
            <td align="center" width="100"><?php echo $data['Nama_Prodi']; ?></td>
            <td align="center" width="150"><?php echo $data['Asal_SMU']; ?></td>
            <td align="center" width="300"><?php echo $data['Nama_Informasi']; ?></td>
            <td align="center" width="350"><?php echo $data['Status_Daftar']; ?></td>
            <td align="center" width="350"><?php echo $data['Status_Reg']; ?></td> 
            <td align="center" width="350" colspan="2"><?php echo $data['Tgl_Masuk']; ?></td>       

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



<div id="cetak">
<table width="100%">
    <tr>
        <td colspan="4"><img src="<?php echo base_url()."asset/img/Kop_PMB.png"?>" width="10%"/></td>
    </tr>
    <tr>
        <td colspan="4" align="center"><h3><?php echo $judul?></h3></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<table id="tableCetak" border="1">
<tr class="cetak_title">
	<th>No</th>
    <th>NRP</th>
    <th>Nama Mhs</th>
    <th>Jenis Kelamin</th>
    <th>Kelas</th>
    <th>Agama</th>
    <th>Tahun Masuk</th>
    <th>Provinsi</th>
    <th>Prodi</th>
    <th>SMU Asal</th>
    <th>Asal Informasi</th>
    <th>Status Daftar</th>
    <th>Status Daftar Ulang</th>
    <th>Tanggal Masuk</th>
    
    
</tr>
</table>
</div>
