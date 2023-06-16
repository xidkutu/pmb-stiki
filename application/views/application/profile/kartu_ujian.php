<div class="row">
	<div class="col-md-12 not-printable">
       <div class="note note-info" style="margin-right: 20px;">
			<h4 class="block">Info! Pelaksaan Ujian Masuk</h4>
            <p>
                Anda ditetapkan mendaftar melalui jalur <strong><?php if(isset($Nama_JalurPenerimaan)) echo $Nama_JalurPenerimaan?></strong> dengan jalur <strong>Melalui Ujian</strong>.
			</p>
			<p>
				 Silahkan buka halaman ujian online <a href="<?php echo conf_link($url_ujian_online);?>" target="_blank"><?php echo $url_ujian_online;?></a>, Login dengan nomor test pada kartu ujian berikut sebagai username dan password sama dengan yang anda dapat pada saat registrasi. Cetak kartu ujian berikut sebagai syarat mengukuti ujian. Untuk hasil terbaik, disarankan mencetak dengan menggunakan kertas legal.
			</p>
		</div>
		<!-- BEGIN PORTLET -->
		<div class="portlet light " style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Kartu Ujian Calon Mahasiswa</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
                <div class="actions">
					<a href="#" class="btn btn-default btn-circle" onclick="printKartuUjian();">
					<i class="fa fa-print"></i>
					<span class="hidden-480">
					Cetak </span>
					</a>
                    <a href="#" class="btn btn-default btn-circle" onclick="previewPDF()">
					<i class="fa fa-file-pdf-o"></i>
					<span class="hidden-480">
					Preview PDF </span>
					</a>
				</div>
			</div>
			<div class="portlet-body">
                <div class="row" id="biodata_peserta" style="padding: 0px 15px 0px 15px;">
                    <table class="table table-condensed table-printed">
                        <?php echo $data_diri[0]?>
                        <tr>
                            <td colspan="2"><h4><strong>Asal SMU</strong></h4></td>
                        </tr>
                        <?php echo $data_diri[1]?>
                        <tr>
                            <td colspan="2"><h4><strong>Orang Tua / Wali</strong></h4></td>
                        </tr>
                        <?php echo $data_diri[2]?>
                        <tr>
                            <td colspan="2"><h4><strong>Pilihan Jurusan</strong></h4></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h4><strong><span id="detail_NamaPilihanProdi"></span></strong></h4></td>
                        </tr>
                    </table>
                </div>
                <div class="row" id="kartu_peserta" style="padding: 0px 20px 0px 20px;">
                    <table style="border: 3px;border-style: dashed;width: 100%;">
                        <tr>
                            <td style="width: 50%;border-right:1px solid;vertical-align: top;">
                                <table class="tablePad5">
                                    <tr>
                                        <td colspan="2"><u><span id="me_kartu_tahun"></span></u></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><u>MATERI &amp; PELAKSANAAN UJIAN</u></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;vertical-align: top;" id="me_kartu_mataujian">
                                            
                                        </td>
                                        <td style="border: 1px;border-style: solid;">
                                        Aturan:<br />
                                        - Membawa alat tulis<br />
                                        - Bersepatu<br />
                                        - Baju berkerah
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Ujian</td>
                                        <td id="me_kartu_tglUjian"></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Ujian</td>
                                        <td id="me_kartu_waktuUjian"></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;" >Tempat Ujian</td>
                                        <td id="me_kartu_tempatUjian"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 50%;padding-left: 5px; vertical-align: top;">
                                <table class="tablePad5" style="width: 100%; padding: 5px;">
                                    <tr>
                                        <td>
                                        <img src="<?php echo $logo; ?>" style="width: 40px;"/>
                                        </td>
                                        <td>
                                        <u><span>KARTU PESERTA UJIAN MASUK</span></u>
                                        </td>
                                    </tr>
                                </table>
                                <table class="tablePad5" style="width: 100%;">
                                    <tr>
                                        <td>NAMA</td>
                                        <td id="me_kartu_nama"></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Tes</td>
                                        <td id="me_kartu_notes"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">PILIHAN JURUSAN</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" id="me_kartu_jurusan"></td>
                                    </tr>
                                </table> 
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="vertical-align: top;padding-top: 10px;" id="me_kartu_ttd"></td>
                                        <td style="text-align: center;"><img id="me_kartu_foto" src="<?php echo base_url()?>assets/documents/images/no-profile-pic.jpg" style="width: 100px;"/></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
			</div>
		</div>
		<!-- END PORTLET -->
        <div id="panelhasil" class="alert alert-putih"></div>
         
	</div>
    <div id="printable" class="printThis" style="padding: 0px 5px 0px 20px; display: none;">
        <div id='printable-head' style="width: 100%; text-align: center;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 10%;">
                        <img src="<?php echo $logo?>" style="width: 65px;"/>
                    </td>
                    <td style="width: 90%; text-align: center;">
                        <strong>BIODATA CALON MAHASISWA BARU</strong><br />
                        <strong><?php echo strtoupper($Nama_Instansi)?></strong><br />
                        <strong><?php echo $alamat?></strong>
                    </td>
                </tr>
            </table>
            <hr style="border-top: 2px solid black;"/>
        </div>
        <div id="printable-body">
        </div>
        <div class="printable-ttd">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;text-align: center;">
                        Tanda Tangan Calon Mahasiswa<br />
                        <?php echo $Kota_Tgl?>
                        <br /><br /><br /><br />
                        <span id="ttd_nama"></span><br /><br />
                    </td>
                </tr>
            </table>    
        </div>
        <div class="printable-foot">
             
        </div>
    </div>
</div>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/additional/jsPDF/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/additional/jsPDF/jspdf.debug.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/additional/jsPDF/addimage.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    getProfileCamaba('<?php echo str_replace('%40','@',$this->session->userdata('cur_user'))?>');
    
    
});

/* modal pdf preview */
(function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog modal-lg">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);

function printKartuUjian(){
    $("#printable-body").html($("#biodata_peserta").html());
    $(".printable-foot").html($("#kartu_peserta").html());
    $(".table-printed tr th").css('text-align','left');
    $(".printThis table").removeClass();
    
   
             
    javascript:window.print();
    //PrintElem("Kartu Ujian Calon Mahasiswa Baru","printable");
}

function previewPDF(){
    $("#printable-body").html($("#biodata_peserta").html());
    $(".printable-foot").html($("#kartu_peserta").html());
    $(".table-printed tr th").css('text-align','left');
    $(".printThis table").removeClass();
        
    $('#panelhasil').show();
    $('#panelhasil').html($('#printable').html());
    
    /* menggunakan addHTML */    
    var doc = new jsPDF('p','mm','legal');
           
    margins = {
        top: 20,
        bottom: 60,
        left: 10,
        width: 522
    };
      
    doc.addHTML($("#panelhasil"),
    margins.left,
    margins.top,        
    function() {
        var string = doc.output('datauristring');
        var iframe = '<div class="iframe-container" style="width:100%;"><iframe src="'+string+'" width="100%"></iframe></div>'
        $.createModal({
        title:'PDF Preview Cetak Kartu Ujian Mahasiswa',
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        $("#panelhasil").hide();
    });    
    return false;
}

function PrintElem(popup_title,elem)
    {
        Popup(popup_title,$("#"+elem).html());
    }

    function Popup(popup_title,data) 
    {
        var mywindow = window.open('', popup_title, 'height=600,width=800');
        mywindow.document.write('<html><head><title>'+popup_title+'</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body ><div>');
        mywindow.document.write(data);
        mywindow.document.write('</div></body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
function getProfileCamaba(id){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getProfileCamaba',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            fill_detail('kartu_ujian',data);
            $("#ttd_nama").html(data.Nama_Mhs);
            $("#me_kartu_foto").attr('src',data.Url_Foto);
            $("#me_kartu_nama").html(data.Nama_Mhs);
            $("#me_kartu_notes").html(data.Nomer_Tes);
            $("#detail_NamaPilihanProdi").html(data.NamaPilihanProdi);
            $("#me_kartu_jurusan").html(data.NamaPilihanProdi);
            $("#me_kartu_tahun").html('PMB '+data.tahun_penerimaan);
            $("#me_kartu_mataujian").html(data.mata_ujian);
            $("#me_kartu_tglUjian").html(data.waktu_ujian.Tgl_Ujian);
            $("#me_kartu_waktuUjian").html(data.waktu_ujian.WaktuUjian);
            $("#me_kartu_ttd").html(data.kota_instansi+', '+data.today+'<br />PANITIA PMB');
            $("#me_kartu_tempatUjian").html(data.tmp_ujian);
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>