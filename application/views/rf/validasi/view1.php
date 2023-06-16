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
	window.location.assign('<?php echo base_url();?>index.php/rf_pmb_validasi');
	return false;
});	

$("#kembali_detail").click(function(){
   	$("#view").show();
	$("#form").hide();
    $("#detail").hide(); 
});


function showDetail(id){
    var string = "Id_Reg="+id;
    
    $.ajax({
        type    :'POST',
        url     : "<?php echo site_url(); ?>/rf_pmb_validasi/detail",
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
            
            var temp = document.getElementById("detail_idReg");
            temp.innerHTML=id; 
            
            var temp = document.getElementById("detail_nama");
            temp.innerHTML=data.Nama;
            
//            var temp = document.getElementById("detail_alamat");
//            temp.innerHTML=data.Alamat;
            
//            var temp = document.getElementById("detail_email");
//            temp.innerHTML=data.Email;
            
//            var temp = document.getElementById("detail_hp");
//            temp.innerHTML=data.HP;
           
//            var temp = document.getElementById("detail_userName");
//            temp.innerHTML=data.Username;
//           
//            var temp = document.getElementById("detail_password");
//            temp.innerHTML=data.Password;
            if(data.status=='Sudah') $("#validasi").hide(); else $("#validasi").show(); 
            
            //var temp = document.getElementById("detail_pemilikRek");
            //temp.innerHTML=data.Nama_Pemilik_Rek;            

            var temp = document.getElementById("detail_status");
            temp.innerHTML=data.status;
           
            var temp = document.getElementById("detail_jumlah");
            temp.innerHTML=data.Jumlah;
            
            var temp = document.getElementById("detail_tanggal");
            temp.innerHTML=data.Tanggal;
                     
            var temp = document.getElementById("detail_pembayaran");
            temp.innerHTML=data.Tipe_Pembayaran;
            
             var temp = document.getElementById("detail_bankTujuan");
            temp.innerHTML=data.Bank_Tujuan;
            
            var temp = document.getElementById("detail_namaBank");
            temp.innerHTML=data.Nama_Bank;
            
            var temp = document.getElementById("detail_bankAsal");
            temp.innerHTML=data.Bank_Asal;
            
            var temp = document.getElementById("detail_noRekening");
            temp.innerHTML=data.No_Rekening;
            
            var temp = document.getElementById("detail_atasNama");
            temp.innerHTML=data.Atas_Nama;
            
           
            if(data.URL_File!=null){
                
            var temp = document.getElementById("detail_urlFile");
            temp.innerHTML='<img src="'+data.URL_File+'" width="100px"/>';
           }else{
            var temp = document.getElementById("detail_urlFile");
            temp.innerHTML='';
           }
            hideEditStatus();
             //$(".item-row-data").remove();
            //$(".item-row-title").after(data.Data_Akademis);
            
            //$(".item-row-data-RA").remove();
        //    $(".item-row-title-RA").after(data.Data_Riwayat_Akademik);
            }
           }
        }  );
    }   
            
            //===============================Data Diri==========================           
            
            //===============================Data Orang Tua==========================
                       
            //===============================Data Sekolah Menengah==========================
                      
            //==============Perguruan Tinggi Asal========================
            
            //=======Data Camaba==================================
           

$("#editData").click(function(){
    var temp = document.getElementById("detail_Id_Camaba");
    var id=temp.innerHTML;
    $('#saveas').val('edit');
    editData(id);
});

function cekFileUploaded(){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_validasi/cekFileUploaded",
			cache	: false,
            dataType : "json",
			success	: function(data){
				
                $("#namaFile").val(data.namaUploaded);
                var temp = document.getElementById("form_photo_img").setAttribute('src',data.filename);
				return false;
			}
		});
}

//function editData(id){
//	var string = "Id_Reg="+id;
//	$.ajax({
//			type	: 'POST',
//			url		: "<?php echo site_url(); ?>/rf_pmb_validasi/edit",
//			data	: string,
//			cache	: true,
//			dataType : "json",
//			success	: function(data){
//			     
//				$("#view").hide();
//                $("#detail").hide();
//				$("#form").show();
//                hideFormEdit();
//                $("#form_dataDiri").show();
//                
//                document.getElementById('form_Id_Reg').readOnly=true;
//                
//                $("#form_Id_Reg").val(data.Id_Reg);
//                $("#nrp").val(data.NRP);
//                var temp = document.getElementById("form_photo_img").setAttribute('src',data.URL_Photo);
//                
//                $("#form_tglMasuk").datebox('setValue', data.Tgl_Masuk);
//                $("#form_tglLahir").datebox('setValue', data.Tanggal_Lahir);
//                $("#form_wn : checked").val(data.wn);              
//                showDetailSekolah(data.Kode_SMU);
//                $("#saveas").val('edit');
//				return false;
//			}
//	});
//}

$("#validasi").click(function(){
        var idReg = document.getElementById('detail_idReg').innerHTML;
        var status = $("#form_status").val();
        var saveas ='edit';
//        var urlFoto = document.getElementById('form_photo_img').getAttribute('src');
		
		var string = "Id_Reg="+idReg+"&status="+status+"&saveas="+saveas;
        		        
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rf_pmb_validasi/simpanEdit",
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


$("#form_sekolah").change(function(){
   showDetailSekolah($("#form_sekolah").val());
})

function showEditStatus(){
    $("#detail_status").hide();
    $("#edStatus").show();
    $("#simpan").show();
}

function hideEditStatus(){
    $("#detail_status").show();
    $("#edStatus").hide();
    $("#simpan").hide();
}

//----------------------------------------------Navigasi Form Edit--------------------------------------
</script>

<div id="detail">
<fieldset class="atas">
<table id="detail" width="100%">

<tr>    
	<td>ID Reg</td>
    <td>:</td>
    <td id="detail_idReg"></td>
</tr>

<tr>
	<td width="10%">Nama</td>
    <td width="5">:</td>
    <td width="30%" id="detail_nama" ></td>
    <td rowspan="10" id="detail_urlFile"></td>
</tr>


<tr>    
	<td>Status</td>
    <td>:</td>
    <td>
    <div id="detail_status"></div>
    </div>
    </td> 
</tr>
<tr>    
	<td>Jumlah</td>
    <td>:</td>
    <td id="detail_jumlah"></td>
</tr>

<tr>    
	<td>Tanggal</td>
    <td>:</td>
    <td id="detail_tanggal"></td>
</tr>

<tr>    
	<td>Tipe Pembayaran</td>
    <td>:</td>
    <td id="detail_pembayaran"></td>
</tr>

<tr>    
	<td>Bank Tujuan</td>
    <td>:</td>
    <td id="detail_bankTujuan"></td>
</tr>

<tr>    
	<td>Nama Bank</td>
    <td>:</td>
    <td id="detail_namaBank"></td>
</tr>

<tr>    
	<td>Bank Asal</td>
    <td>:</td>
    <td id="detail_bankAsal"></td>
</tr>

<tr>    
	<td>No Rekening</td>
    <td>:</td>
    <td id="detail_noRekening"></td>
</tr>

<tr>    
	<td>Atas Nama</td>
    <td>:</td>
    <td id="detail_atasNama"></td>
</tr>

</table>
</fieldset>




<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
  <!--<button type="submit" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">Validasi</button>-->
    <button type="button" name="validasi" id="validasi" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">VALIDASI</button> 
    <button type="button" name="kembali_detail" id="kembali_detail" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    
    </td>
</tr>
</table>  
</fieldset>  
</div>
 

<!--
Tampilan VIEW untuk grid data -->

<div id="view">

    <div style="float:left; padding-bottom:5px;">    
    <a href="<?php echo base_url();?>index.php/rf_pmb_validasi/awal">
    <button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
    </a>
    </div>
 <!--</a>   <div style="float:right; padding-bottom:5px;">
    <form name="form" method="post" action="<?php echo base_url();?>index.php/rf_pmb_validasi/cari">
    //<?php
    //echo 'Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" value="'.$keyword.'" size="50" />'
  //  ?> 
    <button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
    </form>
    </div> -->

<div style="padding:10px;"></div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
 <!--  <th>ID Daftar</th> -->
    <th>Kode Reg</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Email</th>
    <th>No HP</th>
    <th>User Name</th>    
    <th>Password</th>
    <th>status</th>
    <th>Jumlah</th>
    <th>Tanggal</th>
    <th>Tipe Pembayaran</th>
    <th>Bank Tujuan</th>
    <th>Nama Bank </th>
    <th>Bank Asal</th>
    <th>No Rekening</th>
    <th>Atas Nama</th>
   
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $data){  
		?>    
    	<tr onclick="showDetail('<?php echo $data['Id_Reg']; ?>')">
			<td align="center" width="50"><?php echo $no; ?></td>
           <!-- <td align="center" width="250" ><?php echo $data['Id_Reg']; ?> -->
            <td align="center" width="250" ><?php echo $data['Kode_Reg']; ?></td>
            <td align="center" width="250" ><?php echo $data['Nama']; ?></td>
            <td align="center" width="160" ><?php echo $data['Alamat']; ?></td>
            <td align="center" width="250"><?php echo $data['Email']; ?></td>
            <td align="center" width="250"><?php echo $data['HP']; ?></td>
            <td align="center" width="250"><?php echo $data['Uname']; ?></td>
            <td align="center" width="250"><?php echo $data['Pwd']; ?></td>
           
            <td align="center" width="75"><?php echo $data['status']; ?></td>
            <td align="center" width="25"><?php echo $data['Jumlah']; ?></td>
            <td align="center" width="25"><?php echo $data['Tanggal']; ?></td>
            <td align="center" width="100"><?php echo $data['Tipe_Pembayaran']; ?></td>
            <td align="center" width="150"><?php echo $data['Bank_Tujuan']; ?></td>
            <td align="center" width="150"><?php echo $data['Nama_Bank']; ?></td>
            <td align="center" width="300"><?php echo $data['Bank_Asal']; ?></td>
            <td align="center" width="350"><?php echo $data['No_Rekening']; ?></td>
            <td align="center" width="350"><?php echo $data['Atas_Nama']; ?></td>        
            
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

</div>
