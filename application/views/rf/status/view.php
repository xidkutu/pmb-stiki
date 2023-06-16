<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});   
 });
 
 function pilihSemuaChange(){
    if($("#pilihSemua").attr('checked')=='checked'){
        $(".cb_camaba").attr('checked',true)
    }else{
        $(".cb_camaba").attr('checked',false)
    }
 }
 
 
 $("#simpan").click(function(){
    var selected='';
   	$(".cb_camaba").each(function(i){
   	    if($(this).attr('checked')=='checked'){
   	        selected=selected+','+$(this).val();
   	    }
   	})
    var string = "selected="+selected;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_status/simpan",
			data	: string,
			cache	: true,
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

 
</script>

<div id="form">

<div id="form_dataOrtu">
<fieldset class="atas">
<form name="form" method="post" action="<?php echo base_url();?>index.php/rf_pmb_status">
<table>
<tr>
<div style="float:left; padding-bottom:5px;">    
    <a href="<?php echo base_url();?>index.php/rf_pmb_status/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
	<td>Dari </td>
    <td>:</td>
    <td><input type="text" name="form_dari" id="form_dari"  placeholder="id daftar"size="10" maxlength="254"/ value="<?php if(isset($dari_sel)) echo $dari_sel;?>"></td>
   	<td>Sampai </td>
    <td>:</td>
    <td><input type="text" name="form_sampai" id="form_sampai" placeholder="id daftar" size="10" maxlength="254"/ value="<?php if(isset($sampai_sel)) echo $sampai_sel;?>"></td>
    <td><button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button></td>
</tr>
</table>
<table id="tabelPra">
<tr>
    <th>No</th>
	<th>ID Camaba</th>
    <th>Nama Mhs</th>
    <th>NRP</th>
    <th>Kode Prodi</th>
    <th>Kelas</th>
    <th>Status Daftar Ulang</th>
    <th>Status Camaba</th>
    <th>Pilih Semua <input type="checkbox" id="pilihSemua" onchange="pilihSemuaChange();"/></th>
    
</tr>
<?php
    $n=0;
    foreach($data->result_array() as $d){
        $n++;?>
        <tr>
            <td><?php echo $n?></td>
            <td style="text-align: center;"><?php echo $d['Id_Camaba']?></td>
            <td><?php echo $d['Nama_Mhs']?></td>
            <td><?php echo $d['NRP']?></td>
            <td style="text-align: center;"><?php echo $d['Kode_Prodi']?></td>
            <td style="text-align: center;"><?php echo $d['Kelas']?></td>
            <td style="text-align: center;"><?php echo $d['Status_Reg']?></td>
            <td style="text-align: center;"><?php echo $d['Status_Camaba']?></td>
            <td style="text-align: center;"><input type="checkbox" class="cb_camaba" value="<?php echo $d['Id_Camaba']?>"/></td>
        </tr>
    <?php }
?>

</table>


</form>
    
</fieldset>

<fieldset class="bawah">
<table width="100%">
    <tr>
        <td colspan="1" align="center">
        <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-redo'">Kirim</button>
        </td>
    </tr>
</table>
</fieldset>    

</div>




</div>
