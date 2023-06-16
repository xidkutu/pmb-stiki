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
	window.location.assign('<?php echo base_url();?>index.php/rf_pmb_laporan_camaba');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});


//
//$("#editData").click(function(){
//    var temp = document.getElementById("detail_Id_Camaba");
//    var id=temp.innerHTML;
//    $('#saveas').val('edit');
//    editData(id);
//});

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



//----------------------------------------------Navigasi Form Edit--------------------------------------
</script> 

<!--Tampilan VIEW untuk grid data--!>

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
    <th>Status Registrasi</th>
    
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


