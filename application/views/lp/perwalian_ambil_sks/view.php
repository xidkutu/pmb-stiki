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


function showDetail(nrp,total){
    var string = "nrp="+nrp;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/lp_perwalian_ambil_sks/detail",
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

            document.getElementById('detail_tahun').innerHTML=data.Tahun;
            document.getElementById('detail_periodeSem').innerHTML=data.Periode_Sem;
            document.getElementById('detail_jenjang').innerHTML=data.Nama_Jenjang;
            document.getElementById('detail_prodi').innerHTML=data.Nama_Prodi;
            document.getElementById('detail_nrp').innerHTML=data.NRP;
            document.getElementById('detail_nama').innerHTML=data.Nama_Mhs;
            document.getElementById('detail_dosenWali').innerHTML=data.Dosen_Wali;
            document.getElementById('totalSKS').innerHTML=total;
            $(".det_item-row-pra").remove();
            $(".det_item-row-pra-title").after(data.result_ambilMK);
            

            }
        }
    });
}

$("#fltr_jenjang").change(function(){
    generateData();
})

$("#fltr_prodi").change(function(){
    generateData();
})

$("#fltr_nrp").blur(function(){
    generateData();
})

$("#fltr_nama").blur(function(){
    generateData();
})

$("#fltr_comparison_sks_sekarang").change(function(){
    if($("#fltr_sks_sekarang").val()!='') generateData();
})

$("#fltr_sks_sekarang").blur(function(){
    generateData();
})

$("#fltr_comparison_sks_total").change(function(){
    if($("#fltr_sks_total").val()!='') generateData();
})

$("#fltr_sks_total").blur(function(){
    generateData();
})



function generateData(){
    var jenjang = $("#fltr_jenjang").val();
    var prodi = $("#fltr_prodi").val();
    var nrp = $("#fltr_nrp").val();
    var nama = $("#fltr_nama").val();
    var comparison_sks_sekarang = $("#fltr_comparison_sks_sekarang").val();
    var sks_sekarang = $("#fltr_sks_sekarang").val();
    var comparison_sks_total = $("#fltr_comparison_sks_total").val();
    var sks_total = $("#fltr_sks_total").val();
    
    var string ="jenjang="+jenjang+"&prodi="+prodi+"&nrp="+nrp+"&nama="+nama
    +"&comparison_sks_sekarang="+comparison_sks_sekarang+"&sks_sekarang="+sks_sekarang
    +"&comparison_sks_total="+comparison_sks_total+"&sks_total="+sks_total;

    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/lp_perwalian_ambil_sks/filterData",
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

$("#ekspor_pdf").click(function(){
   $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/lp_perwalian_ambil_sks/getDataToCetak",
        cache   : true,
        dataType : "json",
        success : function(data){
            $(".cetak_data").remove();
            $(".cetak_title").after(data.ambilsks);
            doCetak("cetak");
           
        }
    }); 
})

//$("#detail_ekspor_pdf").click(function(){
//  doCetak("cetak_detail"); 
//})

function doCetak(isi){
    document.getElementById("tabelPra").setAttribute("border","1");
    var data = document.getElementById(isi).innerHTML;
    //alert(data);
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/pdf_exporter/generateHTML",
        data    : data,
        cache   : true,
        contentType:"application/json",
        dataType : "json",
        converters:{'text json':true},
        success : function(data){
            //if(isi=='cetak')
            //window.location.assign("<?php //echo site_url(); ?>/pdf_exporter/eksporPdfLandscape");
            //else
            window.location.assign("<?php echo site_url(); ?>/pdf_exporter/eksporPdf");
                //location.reload();
            document.getElementById("tabelPra").removeAttribute("border");
        }
    });
}

</script>
<div id="detail">
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
    <a href="<?php echo base_url();?>index.php/lp_perwalian_ambil_sks/noFilter">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    <button type="submit" name="ekspor_pdf" id="ekspor_pdf" class="easyui-linkbutton" data-options="iconCls:'icon-docmnt-pdf'">Ekspor</button>
    </div>
        
<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th rowspan="2">No</th>
    <th>Jenjang</th>
    <th>Program Studi</th>
    <th>NRP</th>
    <th>Nama</th>
    <th>SKS Sekarang</th>
    <th>SKS Total</th>
</tr>
<tr>
    <td class="td_filter">
        <select name="fltr_jenjang" id="fltr_jenjang" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($jenjangAll->result() as $t){
    	?>
        <option value="<?php echo $t->Kode_Jenjang;?>" <?php if($t->Kode_Jenjang==$jenjangSelected) echo "selected='selected'";?> ><?php echo $t->Nama_Jenjang;?></option>
        <?php } ?>
        </select>
    </td>
    <td class="td_filter">
        <select name="fltr_prodi" id="fltr_prodi" class="combo" style="width: 100%">
        <option value="0">Semua</option>
        <?php
    	foreach($prodi->result() as $t){
    	?>
        <option value="<?php echo $t->Nama_Prodi;?>" <?php if($t->Nama_Prodi==$prodiSelected) echo "selected='selected'";?> ><?php echo $t->Nama_Prodi;?></option>
        <?php } ?>
        </select>
    </td>
    <td class="td_filter"><input type="text" name="fltr_nrp" id="fltr_nrp" maxlength="10" value="<?php echo $nrp; ?>" style="text-transform: uppercase;" /></td>
    <td class="td_filter"><input type="text" name="fltr_nama" id="fltr_nama" maxlength="100" value="<?php echo $nama; ?>" style="text-transform: uppercase;" /></td>
    <td class="td_filter_no_strecth">
    <select class="combo" id="fltr_comparison_sks_sekarang">
        <option value="0" <?php if($comparison_sks_sekarangSelected=="0") echo "selected='selected'"; ?> > = </option>
        <option value="1" <?php if($comparison_sks_sekarangSelected=="1") echo "selected='selected'"; ?> > &lt; </option>
        <option value="2" <?php if($comparison_sks_sekarangSelected=="2") echo "selected='selected'"; ?> > &le; </option>
        <option value="3" <?php if($comparison_sks_sekarangSelected=="3") echo "selected='selected'"; ?> > &gt; </option>
        <option value="4" <?php if($comparison_sks_sekarangSelected=="4") echo "selected='selected'"; ?> > &ge; </option>
    </select>
    <input type="text" name="fltr_sks_sekarang" id="fltr_sks_sekarang" maxlength="3"  size="3" value="<?php echo $sks_sekarang; ?>" onkeypress="return isNumberKey(event)" />
    </td>
    <td class="td_filter_no_strecth">
    <select class="combo" id="fltr_comparison_sks_total">
        <option value="0" <?php if($comparison_sks_totalSelected=="0") echo "selected='selected'"; ?> > = </option>
        <option value="1" <?php if($comparison_sks_totalSelected=="1") echo "selected='selected'"; ?> > &lt; </option>
        <option value="2" <?php if($comparison_sks_totalSelected=="2") echo "selected='selected'"; ?> > &le; </option>
        <option value="3" <?php if($comparison_sks_totalSelected=="3") echo "selected='selected'"; ?> > &gt; </option>
        <option value="4" <?php if($comparison_sks_totalSelected=="4") echo "selected='selected'"; ?> > &ge; </option>
    </select>
    <input type="text" name="fltr_sks_total" id="fltr_sks_total" maxlength="3" size="3" value="<?php echo $sks_total; ?>" onkeypress="return isNumberKey(event)" />
    </td>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr onclick="showDetail(<?php echo "'".$db['NRP']."','".$db['SKS_Sekarang']."'" ?>)">
			<td align="center" width="30"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['Nama_Jenjang']; ?></td>
            <td width="250"><?php echo $db['Nama_Prodi']; ?></td>
            <td align="center" width="80"><?php echo $db['NRP']; ?></td>
            <td ><?php echo $db['Nama_Mhs']; ?></td>
            <td width="100" align="center"><?php echo $db['SKS_Sekarang']; ?></td>
            <td width="100" align="center"><?php echo $db['SKS_Kumulatif']; ?></td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
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
<table id="tableCetak" border="1">
<tr class="cetak_title">
	<th>No</th>
    <th>Jenjang</th>
    <th>Program Studi</th>
    <th>NRP</th>
    <th>Nama</th>
    <th>SKS Sekarang</th>
    <th>SKS Total</th>
</tr>
</table>
</div>
