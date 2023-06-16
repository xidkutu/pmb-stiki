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
	window.location.assign('<?php echo base_url();?>index.php/rf_pmb_asal_sekolah');
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
    var string = "Kode_SMU="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/rf_pmb_asal_sekolah/detail",
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
            
          //  var temp = document.getElementById("detail_Id_Camaba");
//            temp.innerHTML=data.Id_Camaba;
            
            document.getElementById("kode_smu").innerHTML=data.kode_smu;
            document.getElementById("asal_smu").innerHTML=data.asal_smu;
            document.getElementById("alamat_smu").innerHTML=data.alamat_smu;
            document.getElementById("kota_smu").innerHTML=data.kota_smu;
            document.getElementById("telp").innerHTML=data.telp;
            document.getElementById("email").innerHTML=data.email;
            }
            }
    });
}   

$("#editData").click(function(){
    var id=document.getElementById("kode_smu").innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

function editData(id){
	var string = "Kode_SMU="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_asal_sekolah/detail",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
                $("#detail").hide();
				$("#form").show();
                //hideFormEdit();
                //$("#form_dataDiri").show();
                document.getElementById('form_kode_smu').readOnly=true;
    
                $("#form_kode_smu").val(data.kode_smu);
                $("#form_asal_smu").val(data.asal_smu);
                $("#form_alamat_smu").val(data.alamat_smu);
                $("#form_kota_smu").val(data.kota_smu);
                $("#form_telp").val(data.telp);
                $("#form_email").val(data.email);
                $("#saveas").val('edit');
				return false;
			}
	});
}

$("#simpan").click(function(){
		var kode_smu    = $("#form_kode_smu").val();
        var asal_smu    = $("#form_asal_smu").val();
       	var alamat_smu  = $("#form_alamat_smu").val();
        var kota_smu    = $("#form_kota_smu").val();   
        var telp        = $("#form_telp").val();
        var email       = $("#form_email").val(); 
        var saveas=$("#saveas").val();  
               
		var string = "Kode_SMU="+kode_smu+"&Asal_SMU="+asal_smu+"&Alamat_SMU="+alamat_smu+"&Kota_SMU="+kota_smu+"&Telp="+telp+"&Email="+email;
        
       		
		if(kode_smu.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Kode harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#kode_smu").focus();
		}
        
        if(asal_smu.length==0){
			$.messager.show({
				title:'Simaru',
				msg:'Asal SMU harus diisi',
				timeout:2000,
				showType:'slide'
			});
			$("#asal_smu").focus();
		}
                
        var urladd='';
        if(saveas=='baru'){
		  urladd="<?php echo site_url(); ?>/rf_pmb_asal_sekolah/simpan"
		}else{
		  urladd="<?php echo site_url(); ?>/rf_pmb_asal_sekolah/simpanEdit"
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
	<td width="10%">Kode SMU</td>
    <td width="5">:</td>
    <td id="kode_smu" ></td>
</tr>
<tr>    
    <td width="10%">Asal SMU</td>
    <td width="5">:</td>
    <td id="asal_smu" ></td>
</tr>
<tr>    
    <td width="10%">Alamat SMU</td>
    <td width="5">:</td>
    <td id="alamat_smu" ></td>
</tr>
<tr>    
    <td width="10%">Kota SMU</td>
    <td width="5">:</td>
    <td id="kota_smu" ></td>
</tr>
<tr>    
    <td width="10%">Telepon SMU</td>
    <td width="5">:</td>
    <td id="telp" ></td>
    
</tr>
<tr>    
    <td width="10%">Email SMU</td>
    <td width="5">:</td>
    <td id="email" ></td>
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
    <a href="<?php echo base_url();?>index.php/rf_pmb_asal_sekolah/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
    <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/rf_pmb_asal_sekolah/cari">
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
	<th>Kode SMU</th>
    <th>Asal SMU</th>
    <th>Alamat SMU</th>
    <th>Kota SMU</th>
    <th>Telepon SMU</th>
    <th>Email SMU</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr onclick="showDetail('<?php echo $data['Kode_SMU']; ?>')">
			<td align="center" width="30"><?php echo $no; ?></td>
            <td align="center" width="80" ><?php echo $data['Kode_SMU']; ?></td>
            <td align="center" width="160" ><?php echo $data['Asal_SMU']; ?></td>
            <td align="center" width="100"><?php echo $data['Alamat_SMU']; ?></td>
            <td align="center" width="100"><?php echo $data['Kota_SMU']; ?></td> 
            <td align="center" width="100"><?php echo $data['Telp']; ?></td>
            <td align="center" width="100"><?php echo $data['Email']; ?></td>          
            
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
<div id="formAsalSMU">
<fieldset class="atas">
<table width="100%">
    <tr>
    <td width="10%">Kode SMU</td>
    <td width="10px">:</td>
    <td><input type="text" name="form_kode_smu" id="form_kode_smu"  size="5" maxlength="254"/></td>
    <input type='hidden' id="saveas"/>
    </tr>
    <tr>
    <td>Asal SMU</td>
    <td>:</td>
    <td><input type="text" name="form_asal_smu" id="form_asal_smu"  size="30" maxlength="254"/></td>
    </tr>
    <tr>
    <td>Alamat SMU</td>
    <td>:</td>
    <td><input type="text" name="form_alamat_smu" id="form_alamat_smu"  size="30" maxlength="254"/></td>
    </tr>
    <tr>
    <td>Kota SMU</td>
    <td>:</td>
    <td><input type="text" name="form_kota_smu" id="form_kota_smu"  size="30" maxlength="254"/></td>
    </tr>
    <tr>
    <td>Telpon</td>
    <td>:</td>
    <td><input type="text" name="form_telp" id="form_telp"  size="30" maxlength="254"/></td>
    </tr>
    <tr>
    <td>Email SMU</td>
    <td>:</td>
    <td><input type="text" name="form_email" id="form_email"  size="30" maxlength="254"/></td>
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
