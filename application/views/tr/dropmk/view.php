<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
    
    $("#form").show();
    $(".tmp_kodemk").hide();
    kosongkanForm();
 });

$("#simpan").click(function(){
    var tahun = $("#tahun").val();
    var periodeSem = $("#periodeSem").val();
    var nrp =$("#nrp").val();
    var alasan =$("#alasan").val();
    var sksDropped = document.getElementById('totalsks').innerHTML;
	
    var mkList = extractDropMK();
    
	var string = "tahun="+tahun+"&periodeSem="+periodeSem+"&nrp="+nrp+"&alasan="+alasan+"&mkList="+mkList+"&sksDropped="+sksDropped;
	
    if(mkList=='invalid'){
		$.messager.show({
			title:'Siakad',
			msg:'Mata kuliah yang hendak dibatalkan tidak valid',
			timeout:2000,
			showType:'slide'
		});
		return false;
	}
    
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
			msg:'Periode semester harus diisi',
			timeout:2000,
			showType:'slide'
		});
        $("#periodeSem").focus();
		return false;
	}
    
    if(nrp.length==0){
		$.messager.show({
			title:'Siakad',
			msg:'NRP mahasiswa harus diisi',
			timeout:2000,
			showType:'slide'
		});
        $("#nrp").focus();
		return false;
	}
    
	$.ajax({
		type	: 'POST',
		url		: "<?php echo site_url(); ?>/tr_dropmk/simpanEdit",
		data	: string,
		cache	: false,
		success	: function(data){
		  if(data=='logout'){
		      location.reload();
		  }else
          {
			$.messager.show({
				title:'Info',
				msg:data,
				timeout:2000,
				showType:'slide'
			});
            kosongkanForm();
            $("#nrp").val('');
            $("#tahun").val('');
            $("#periodeSem").val('0');
            $("#alasan").val('');
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

function extractDropMK(){
    var result='';
    if($("#kodemkpra1").val()!=''){
      $('.kodemkpra').each(function(i){
            kodemk = $(this).val();
            kodemk +=',';
            result += kodemk;
        });   
        
    }else result='invalid';
    
    return result;
}

//----------------------------------Validasi Input------------------------------------------------------------//
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which:event.keyCode
    if(charCode >31 && (charCode<48 || charCode>57)) return false; return true;
};


function kosongkanForm(){  
    document.getElementById("form_nama").innerHTML='';
    document.getElementById("form_email").innerHTML='';
    document.getElementById("form_alamat").innerHTML='';
    document.getElementById("form_telepon").innerHTML='';
    document.getElementById("form_dosenWali").innerHTML='';
    
    $("#kodemkpra1").val('');
    $("#alasan").val('');
    $("#isValidate").val('NO');
    $("#form_kdPerwalain").val('');
    clearRow();
    $("#textCount").val('1');

    }

function getDetailPerwalian(){
    var tahun=$("#tahun").val();
    var periode_sem=$("#periodeSem").val();
    var nrp = $("#nrp").val();
    
    if(tahun.length!=0 && periode_sem!=0 && nrp.length!=0){
        var string = "tahun="+tahun+'&periode_sem='+periode_sem+'&nrp='+nrp;
    	$.ajax({
    			type	: 'POST',
    			url		: "<?php echo site_url(); ?>/tr_dropmk/getDetailPerwalian",
    			data	: string,
    			cache	: true,
    			dataType : "json",
    			success	: function(data){
    			 if(data.signout=='YES'){
    			     location.reload();
    			 }else
                 {
                    if(data.Kd_perwalian!='invalid'){
                        document.getElementById("form_nama").innerHTML=data.Nama_Mhs;
                        document.getElementById("form_email").innerHTML=data.Email;
                        document.getElementById("form_alamat").innerHTML=data.Alamat;
                        document.getElementById("form_telepon").innerHTML=data.Tlp_HP;
                        document.getElementById("form_dosenWali").innerHTML=data.Dosen_Wali;
                        
                        $("#form_kdPerwalain").val(data.Kd_perwalian);                    
                        $("#isValidate").val(data.IsValidate);
                    }else
                    {
                        kosongkanForm();
                    }}
    				return false;
    			}
    	});
    }
    kosongkanForm();
}

$("#tahun").blur(function(){
    getDetailPerwalian();
})

$("#periodeSem").change(function(){
    getDetailPerwalian();
})

$("#nrp").blur(function(){
    getDetailPerwalian();
})

function clearRow(){
    var i=$("#textCount").val();

    for(j=2;j<=i;j++){
        $("#row"+j).remove();   
    }

    document.getElementById("namaMK_pra1").innerHTML='';
    document.getElementById("kelasmk1").innerHTML='';
    document.getElementById("sksmk1").innerHTML='';
    document.getElementById("totalsks").innerHTML='0';
    
    $("#textCount").val('1');
    generateRowNumber();
}

function tambahRow(){
    var n = $("#textCount").val();
    n++;
    $(".item-row-pra:last").after('<tr class="item-row-pra" id="row'+n+'"><td align="center" class="row-number">'+n+'</td><td><input class="kodemkpra" type="text" name="kodemkpra" id="kodemkpra'+n+'" size="12" maxlength="10" onblur="get_detail_mk('+n+');" style="text-transform: uppercase;"/></td><td class="namaMK_pra" id="namaMK_pra'+n+'"></td><td align="center" id="kelasmk'+n+'"></td><td align="center" class="sks" id="sksmk'+n+'"></td><td align="center"><a class="delete" href="javascript:; title="Remove row"><img src="<?php echo base_url();?>asset/images/del.png" title="Hapus"></a></td></tr>');
    $("#textCount").val(n);
    generateRowNumber();
}

function update_total() {
  var total = 0;
  $('.sks').each(function(i){
    sks = $(this).html();
    if (!isNaN(sks)) total += Number(sks);
  });
  
  document.getElementById('totalsks').innerHTML=total;
}

function generateRowNumber(){
    var Num=0;
    $('.row-number').each(function(i){
        Num++;
        $(this).html(Num);
    });
}

$("#tambah_pra").click(function(){
  tambahRow();  
});

$(".delete").live('click',function(){
$(this).parents('.item-row-pra').remove();
update_total();
 generateRowNumber()
});

function get_detail_mk(id){
    var tahun = $("#tahun").val();
    var periodeSem = $("#periodeSem").val();
    var nrp = $("#nrp").val();
    var kodemk=$("#kodemkpra"+id).val();
    
    if(kodemk.length!=0){
    var string = "tahun="+tahun+"&periodeSem="+periodeSem+"&nrp="+nrp+"&kodemk="+kodemk;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/tr_dropmk/getDetailMK",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
			 if(data.signout=='YES'){
			     location.reload();
			 }else{
                if (data.Kd_perwalian!='invalid'){   
                    $('#namaMK_pra'+id).html(data.Nama_MK);
                    $('#kelasmk'+id).html(data.kelas);
                    $('#sksmk'+id).html(data.sks);
                    update_total();
                }else
                {
                    $('#namaMK_pra'+id).html('<div class="errMsg">Mata kuliah ini tidak ditemukan / tidak terdaftar dalam perwalian mahasiswa ini</div>');
                    $('#kelasmk'+id).html('');
                    $('#sksmk'+id).html('');
                    update_total();
                }
                }			
				return false;
			}      
	});
    }else
    {
        $('#namaMK_pra'+id).html('<div class="errMsg"></div>');
        $('#kelasmk'+id).html('');
        $('#sksmk'+id).html('');
        update_total();
    }
    
}

</script>
<div id="form">

<!----------------------Detail Perwalian---------------------------!>
<fieldset class="atas">
<table>
<tr>
	<td width="100">Tahun</td>
    <td width="5">:</td>
    <td>
        <input type="text" name="tahun" id="tahun"  size="5" maxlength="4" onkeypress="return isNumberKey(event)"/>
    </td>
</tr>
<tr>
	<td>Periode Sem</td>
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
	<td>NRP</td>
    <td>:</td>
    <td>
        <input type="text" name="nrp" id="nrp"  size="10" maxlength="9" onkeypress="return isNumberKey(event)"/>
    </td>
</tr>
<tr>
	<td>Nama</td>
    <td>:</td>
    <td>
        <div id="form_nama"></div>
    </td>
</tr>
<tr>
	<td>Email</td>
    <td>:</td>
    <td>
        <div id="form_email"></div>
    </td>
</tr>
<tr>
	<td>Telepon</td>
    <td>:</td>
    <td>
        <div id="form_telepon"></div>
    </td>
</tr>
<tr>
	<td>Alamat</td>
    <td>:</td>
    <td>
        <div id="form_alamat"></div>
    </td>
</tr>
<tr>
	<td>Dosen Wali</td>
    <td>:</td>
    <td>
        <div id="form_dosenWali"></div>
    </td>
</tr>
<tr>
    <td colspan="3"><br />Mata kuliah yang dibatalkan</td>
</tr>
<tr>
    <td colspan="3">
    <table id='tabelPra'>
    <!--<table id='mdPra'tabelPra>-->
        <tr class="item-row-pra">
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th width='60'>Kelas</th>
            <th width='60'>SKS</th>
            <th width='60'>Hapus</th>
        </tr>
        <tr class="item-row-pra">
            <td align="center" class="row-number">1</td>
            <td><input class="kodemkpra" type="text" name="kodemkpra" id="kodemkpra1" size="12" maxlength="10" onblur="get_detail_mk(1);" style="text-transform: uppercase;"/></td>
            <td class="namaMK_pra" id="namaMK_pra1"></td>
            <td align="center" id="kelasmk1"></td>
            <td align="center" class="sks" id="sksmk1"></td>
            <td align="center"></td>
        </tr>
        <tr class="hiderow">
            <td colspan="2">
            <a class ="link-no-hover" id="tambah_pra" href="javascript:;" >Tambah Mata Kuliah</a>
            </td>
            <td colspan="2">
                Total
            </td>
            <td id="totalsks">0</td>
            <td>SKS</td>
        </tr>
    </table>
    
    <input type="hidden" name="textCount" id="textCount" value="1"  size="10" maxlength="4" />
    
    </td>
</tr>
<tr>
<td colspan="3">
<br />
Alasan pembatalan mata kuliah <br />
<input type="text" name="alasan" id="alasan"  size="100" maxlength="254"/><br /><br />
</td>
</tr>
</table>


</fieldset>

<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>
