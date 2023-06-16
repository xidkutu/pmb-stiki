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
 
 function kosong(){
    $("#saveas").val('baru');
    $("#view").hide();
	$("#form").show();
	return false;
};

 
$("#kembali").click(function(){ 
	window.location.assign('<?php echo base_url();?>index.php/rf_pmb_pekerjaan');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});

$("#tambah").click(function(){
	kosong();
	return false;
});

function showDetail(id){
    var string = "kd_pekerjaan="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/rf_pmb_pekerjaan/detail",
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
            
            document.getElementById("Kd_Pekerjaan").innerHTML=data.Kd_Pekerjaan;
            document.getElementById("Pekerjaan").innerHTML=data.Pekerjaan;
            document.getElementById("Keterangan").innerHTML=data.Keterangan;
            
            }
            }
    });
}   

$("#editData").click(function(){
    var id=document.getElementById("Kd_Pekerjaan").innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

function editData(id){
	var string = "kd_pekerjaan="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_pekerjaan/detail",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
                $("#detail").hide();
				$("#form").show();
                //hideFormEdit();
                //$("#form_dataDiri").show();
                document.getElementById('form_Kd_Pekerjaan').readOnly=true;
    
                $("#form_Kd_Pekerjaan").val(data.Kd_Pekerjaan);
                $("#form_Pekerjaan").val(data.Pekerjaan);
                $("#form_Keterangan").val(data.Keterangan);
                $("#saveas").val('edit');
				return false;
			}
	});
}

$("#simpan").click(function(){
		var Kd_Pekerjaan = $("#form_Kd_Pekerjaan").val();
        var Pekerjaan = $("#form_Pekerjaan").val();
       	var Keterangan = $("#form_Keterangan").val();  
        var saveas=$("#saveas").val();     
		var string = "Kd_Pekerjaan="+Kd_Pekerjaan+"&Pekerjaan="+Pekerjaan+"&Keterangan="+Keterangan;
        
       		
		if(Kd_Pekerjaan.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Kode pekerjaan harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#Kd_Pekerjaan").focus();
		}
        
        if(Pekerjaan.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Pekerjaan harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#Pekerjaan").focus();
		}
        if(Keterangan.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Keterangan harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#Keterangan").focus();
		}
        
        var urladd='';
        if(saveas=='baru'){
		  urladd="<?php echo site_url(); ?>/rf_pmb_pekerjaan/simpan"
		}else{
		  urladd="<?php echo site_url(); ?>/rf_pmb_pekerjaan/simpanEdit"
		}
        
        
		$.ajax({
			type	: 'POST',
			url		: urladd,
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

</script>

<div id="detail">
<fieldset class="atas">
<table id="detail" width="100%">
<tr>
	<td width="10%">Kode Pekerjaan</td>
    <td width="5">:</td>
    <td id="Kd_Pekerjaan" ></td>
</tr>
<tr>    
    <td width="10%">Pekerjaan</td>
    <td width="5">:</td>
    <td id="Pekerjaan" ></td>
</tr>
<tr>    
    <td width="10%">Keterangan</td>
    <td width="5">:</td>
    <td id="Keterangan" ></td>
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
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>    
    <a href="<?php echo base_url();?>index.php/rf_pmb_pekerjaan/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/rf_pmb_pekerjaan/cari">
    <?php
    echo 'Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" value="'.$keyword.'" size="50" />'
    ?>
    <button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    </form>
    </div>

<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
<!--	<th>No</th> -->
    <th>Kode Pekerjaan</th>
    <th>Pekerjaan</th>
    <th>Keterangan</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr onclick="showDetail('<?php echo $data['Kd_Pekerjaan']; ?>')">
		<!--	<td align="center" width="30"><?php echo $no; ?></td> -->
            <td align="center" width="80" ><?php echo $data['Kd_Pekerjaan']; ?></td>
            <td align="center" width="160" ><?php echo $data['Pekerjaan']; ?></td>
            <td align="center" width="100"><?php echo $data['Keterangan']; ?></td>
           
            
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
<div id="form_pekerjaan">
<fieldset class="atas">
<table width="100%">
    <tr>
    <td width="10%">Kode Pekerjaan</td>
    <td width="10px">:</td>
    <td><input type="text" name="Kd_Pekerjaan" id="form_Kd_Pekerjaan"  size="5" maxlength="254"/></td>
    <input type='hidden' id="saveas"/>
    </tr>
    <tr>
    <td>Pekerjaan</td>
    <td>:</td>
    <td><input type="text" name="Pekerjaan" id="form_Pekerjaan"  size="30" maxlength="254"/></td>
    </tr>
     <td>Keterangan</td>
    <td>:</td>
    <td><input type="text" name="Keterangan" id="form_Keterangan"  size="30" maxlength="254"/></td>
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
