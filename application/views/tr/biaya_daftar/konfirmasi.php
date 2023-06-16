<?php if(isset($cssInclude)) echo $cssInclude?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PORTLET -->
		<div class="portlet light" style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Biaya Pendaftaran</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
			</div>
			<div class="portlet-body">
                <div class="note note-info">
					<h4 class="block">Info! Pembayaran Biaya Pendaftaran</h4>
					<p>
				        Pembayaran uang pendaftaran mahasiswa baru <?php echo $pt_long_name?> sebesar <strong><?php echo $biayaDaftar?></strong>. Pembayaran dapat dilakukan melalui bank dengan Account berikut ini : 
					</p>
                    <table class="table table-condensed">
                        <tr>
                            <th>No</th>
                            <th>Nama Bank</th>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                        </tr>
                        <?php 
                        foreach($rekening->result_array() as $i=>$r){?>
                        <tr>
                            <td><?php echo ($i+1)?></td>
                            <td><?php echo $r['Nama_Bank']?></td>
                            <td><?php echo $r['No_Rekening']?></td>
                            <td><?php echo $r['Atas_Nama']?></td>
                        </tr>    
                        <?php }?>
                        
                    </table>
				</div>
                
                <div class="portlet light bg-inverse">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-send-o font-red-flamingo"></i>
							<span class="caption-subject bold font-red-flamingo uppercase">
							Konfirmasi Pembayaran</span>
						</div>
						<div class="tools">
							<a href="" class="collapse">
							</a>
							<a href="javascript:;" class="fullscreen">
							</a>
						</div>
					</div>
					<div class="portlet-body">
					   <?php echo $form?>
                       <div class="col-md-12" style="text-align: center;">
                           <a href="#" class="btn blue" onclick="simpan()">
    					   Kirim <i class="fa fa-send-o"></i>
    					   </a>
                       </div>	
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        init_js();
        $("#Nominal").val("<?php echo $biayaDaftarPlain?>");
    });
//        $IdFile.on("finished", function( file, result ) {
//          console.log("work");
//        });
    function init_js(){
        //Metronic.startPageLoading({animate: true});
        <?php echo $initJs?>
        fillRekeningTujuan();
        //Metronic.stopPageLoading();
    }
    function fillRekeningTujuan(){
        <?php 
        $opt='<option value="">-PILIH-</option>';
        foreach($rekening->result_array() as $i=>$r){
            $opt.='<option value="'.$r['No_Rekening'].'">'.$r['Nama_Bank'].'</option>';
        }?>
        var opt='<?php echo $opt?>';
        $("#Rekening_Tujuan").html(opt);
    }
    $("#Metode_Bayar").change(function(){
        $("#form-group-Rekening_Tujuan").hide();
        $("#form-group-Bank_Asal").hide();
        $("#form-group-Nama_Rekening_Asal").hide();
        
        if($("#Metode_Bayar").val()=='1'){
            $("#form-group-Rekening_Tujuan").show(400);
            $("#form-group-Bank_Asal").show(400);
            $("#form-group-Nama_Rekening_Asal").show(400);
        }else
        if($("#Metode_Bayar").val()=='2'){
            $("#form-group-Rekening_Tujuan").show(400);
        }
    });
    function simpan(){
        Metronic.startPageLoading({animate: true});
        if(validation('<?php echo $Form_Id?>')){
            var string = genDataStringByClass('<?php echo $Form_Id?>');            
        	$.ajax({
        		type	: 'POST',
        		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id?>/simpan',
        		data	: string,
        		cache	: false,
                dataType : "json",
        		success	: function(data){
        		 if(data.isSuccess){
                    toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                    loadPage();
                    Metronic.stopPageLoading();
        		 }else{
                    toastr['error']("Tidak berhasil menyimpan perubahan, hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
                    Metronic.stopPageLoading();
        		 }
        		},
        		error : function(xhr, teksStatus, kesalahan) {
        			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
                    Metronic.stopPageLoading();
        			return false;
                }
        	});
         }
       	return false;
    };
</script>
<?php echo $js_global_method?>