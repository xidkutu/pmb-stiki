<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
    
    $("#view").show();
    $("#form").hide();F
    $("#detail").hide(); 
 });
 
$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/kalender_akademik');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});

function kosong(){
	$("#tahun").val('');
    $("#periodeSem").val('0');
    document.getElementById('frame_upload').setAttribute('src','<?php echo site_url(); ?>/kalender_akademik/showUploader');

    $("#saveas").val('baru');
    $("#view").hide();
	$("#form").show();
    document.getElementById('tahun').readOnly=false;
    document.getElementById('periodeSem').removeAttribute('disabled');
	$("#tahun").focus();
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
        var tahun = cell.innerHTML;
        
        var cell=this.getElementsByTagName("td")[2];
        var periodeSem = cell.innerHTML;
        
        var cell=this.getElementsByTagName("td")[3];
        var keterangan = cell.innerHTML;
        
        showDetail(tahun,periodeSem,keterangan);
    }
}


function showDetail(tahun,periodeSem,keterangan){
	var tahun = tahun;
    var periodeSem	= periodeSem;
    		
	var string = "tahun="+tahun+"&periodeSem="+periodeSem;
        		
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/kalender_akademik/detail",
        data    : string,
        cache   : true,
        dataType : "json",
        success : function(data){
            if(data.signout=='YES'){
                location.reload();   
            }else
            {
            var temp = document.getElementById("kalender_akademik");
            temp.setAttribute('src',data.URL_Kalender_Akd);
            
            $('#det_tahun').val(tahun);
            $('#det_periodeSem').val(periodeSem);
            $('#det_keterangan').val(keterangan);
            $("#namaFile").val(data.filename);
            
            $("#view").hide();
            $("#form").hide();
            $("#detail").show();  
            }
        }
    });
}   

$("#editData").click(function(){
    var tahun = $('#det_tahun').val();
    var periodeSem=$('#det_periodeSem').val();
    var keterangan=$('#det_keterangan').val();
                
    $('#saveas').val('edit');
    editData(tahun,periodeSem,keterangan);
});

function editData(tahun,periodeSem,keterangan){
    $('#tahun').val(tahun);
    $('#periodeSem').val(periodeSem);
    $('#keterangan').val(keterangan);
    document.getElementById('tahun').readOnly=true;
    document.getElementById('periodeSem').setAttribute('disabled','disabled');
    $("#saveas").val('edit');
    $("#view").hide();
    $("#form").show();
    $("#detail").hide();
}

function cekFileUploaded(){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/kalender_akademik/cekFileUploaded",
			cache	: false,
            dataType : "json",
			success	: function(data){
				if(data.signout=='YES'){
				    location.reload();
				}else
                {
                $("#namaFile").val(data.namaUploaded);
                }
				return false;
			}
		});
}

$("#hapusData").click(function(){
    var respon=confirm('Anda yakin ingin menghapus kalender akademik tersebut ?');
    
    if(respon==true){
    var tahun = $('#det_tahun').val();
    var periodeSem=$('#det_periodeSem').val();
    
    var string="tahun="+tahun+"&periodeSem="+periodeSem;
    
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/kalender_akademik/hapus",
			data	: string,
			cache	: false,
			success	: function(data){
                if(data=='signout'){
                    location.reload();
                }else
                {
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
                }
                location.reload();
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
    }
		return false;    
});

$("#simpan").click(function(){
		var tahun = $("#tahun").val();
        var periodeSem	= $("#periodeSem").val();
        var saveas =$("#saveas").val();
        var filename = $("#namaFile").val();
        var keterangan = $("#keterangan").val();
        		
		var string = "tahun="+tahun+"&periodeSem="+periodeSem+"&filename="+filename+"&saveas="+saveas+"&keterangan="+keterangan;
        		
		if(tahun.length!=4){
			$.messager.show({
				title:'Siakad',
				msg:'Tahun tidak valid',
				timeout:2000,
				showType:'slide'
			});
			$("#tahun").focus();
			return false;
		}
        
        if(periodeSem==0){
			$.messager.show({
				title:'Siakad',
				msg:'Periode semester harus dipilih',
				timeout:2000,
				showType:'slide'
			});
			$("#periodeSem").focus();
			return false;
		}
        
        if(filename.length==0){
			$.messager.show({
				title:'Siakad',
				msg:'Tidak ada file yang diupload',
				timeout:2000,
				showType:'slide'
			});
			return false;
		}
        
		var urladd='';
        if(saveas=='baru'){
		  urladd="<?php echo site_url(); ?>/kalender_akademik/simpan"
		}else{
		  urladd="<?php echo site_url(); ?>/kalender_akademik/simpanEdit"
		}
        
		$.ajax({
			type	: 'POST',
			url		: urladd,
			data	: string,
			cache	: false,
			success	: function(data){
                if(data=='signout'){
                    location.reload();
                }else
                {
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
                }
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



//----------------------------------Validasi Input------------------------------------------------------------//
$("#kodeJenjang").blur(function(){
    var kodeJenjang = $('#kodeJenjang').val();
    var table = 'tb_akd_rf_jenjang';
    var idField = 'Kode_Jenjang';
    var resultField = 'Nama_Jenjang';

    var string = "id="+kodeJenjang+'&table='+table+'&idField='+idField+'&resultField='+resultField;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jenjang/getDataFromDBJson",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
                if($('#saveas').val()=='baru'){
                    if (data.result!=''){
                        
                        $("#msg_kodeJenjang").html('Kode jenjang studi sudah terdaftar !');  
                    }
                    else
                    {
                        $("#msg_kodeJenjang").html('');
                    }			
                }
				return false;
			}
	});
});

</script>

<div id="detail">
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
<td align="center">
<embed id="kalender_akademik" src=""/>
<input type="hidden" name="det_tahun" id="det_tahun"  size="10" maxlength="5" />
<input type="hidden" name="det_periodeSem" id="det_periodeSem"  size="10" maxlength="50" />
<input type="hidden" name="det_keterangan" id="det_keterangan"  size="10" maxlength="50" />
</td>
</tr>
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="editDatca" id="editData" class="easyui-linkbutton" data-options="iconCls:'icon-edit'">UBAH</button>
    <button type="button" name="hapusData" id="hapusData" class="easyui-linkbutton" data-options="iconCls:'icon-remove'">HAPUS</button>
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
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
    
    <a href="<?php echo base_url();?>index.php/kalender_akademik/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/kalender_akademik/cari">
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
    <th>Tahun</th>
    <th>Periode Semester</th>
    <th>Keterangan</th>

</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="30"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['Tahun']; ?></td>
            <td align="center"><?php echo $db['Periode_Sem']; ?></td>
            <td><?php echo $db['Keterangan']; ?></td>
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
	<td width="10%">Tahun</td>
    <td width="5">:</td>
    <td><input type="text" name="tahun" id="tahun"  size="4" maxlength="4" style="text-transform: uppercase;"/>
    <input type="hidden" name="saveas" id="saveas"  size="10" maxlength="4" />
    <div class="errMsg" id="msg_kodeJenjang"></div>
    </td>
</tr>
<tr>
	<td>Periode Semester</td>
    <td>:</td>
    <td>
        <select name="periodeSem" id="periodeSem" class="combo">
        <option value="0">-PILIH-</option>
        <?php
    	foreach(explode("','",substr($periode_sem,6,-2)) as $option){
    	?>
        <option value="<?php echo $option;?>"><?php echo $option;?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
<td>File (*.pdf)</td>
<td>:</td>
<td>
<iframe id="frame_upload" src="<?php echo site_url(); ?>/kalender_akademik/showUploader" onload="cekFileUploaded();" style="border: 0; width:100%; height:60px;"></iframe>
<input type="hidden" name="namaFile" id="namaFile"  size="50" maxlength="254" />
</td>
</tr>
<tr>
<td>Keterangan</td>
<td>:</td>
<td><input type="text" name="keterangan" id="keterangan"  size="100" maxlength="254"/></td>
</tr>
</table>
</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="submit" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>
</fieldset>   
</div>
