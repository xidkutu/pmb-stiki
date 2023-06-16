
<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PORTLET -->
		<div class="portlet light " style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Biodata Calon Mahasiswa</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
			</div>
			<div class="portlet-body">
                <table class="table table-striped table-hover">
                <?php echo $data_diri[0]?>
                </table>
                <div class="tabbable-custom ">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_5_1" data-toggle="tab">
							Data Diri </a>
						</li>
						<li>
							<a href="#tab_5_2" data-toggle="tab">
							Orang Tua </a>
						</li>
						<li>
							<a href="#tab_5_3" data-toggle="tab">
							Wali </a>
						</li>
                        <li>
							<a href="#tab_5_4" data-toggle="tab">
							Sekolah </a>
						</li>
                        <li>
							<a href="#tab_5_5" data-toggle="tab">
							Pekerjaan </a>
						</li>
                        <li>
							<a href="#tab_5_6" data-toggle="tab">
							Pilihan Daftar </a>
						</li>
                        <li>
							<a href="#tab_5_7" data-toggle="tab">
							Berkas </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_5_1">
                            <div class="panel-group accordion scrollable" id="accordion2">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1">
										Pribadi </a>
										</h4>
									</div>
									<div id="collapse_2_1" class="panel-collapse in">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[1]?>
                                            </table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2">
										Alamat Tinggal </a>
										</h4>
									</div>
									<div id="collapse_2_2" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[2]?>
                                            </table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_3">
										Alamat Asal </a>
										</h4>
									</div>
									<div id="collapse_2_3" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[3]?>
                                            </table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_5_2">
                            <table class="table table-striped table-hover">
                                <?php echo $data_diri[4]?>
                            </table>
							<div class="panel-group accordion scrollable" id="accordion3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">
										Ayah </a>
										</h4>
									</div>
									<div id="collapse_3_1" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[5]?>
                                            </table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2">
										Ibu </a>
										</h4>
									</div>
									<div id="collapse_3_2" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[6]?>
                                            </table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_5_3">
							<table class="table table-striped table-hover">
                            <?php echo $data_diri[7]?>
                            </table>
						</div>
                        <div class="tab-pane" id="tab_5_4">
							<div class="panel-group accordion scrollable" id="accordion4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_1">
										SMA / SMK </a>
										</h4>
									</div>
									<div id="collapse_4_1" class="panel-collapse in">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[8]?>
                                            </table>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_2">
										Perguruan Tinggi </a>
										</h4>
									</div>
									<div id="collapse_4_2" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table table-striped table-hover">
                                            <?php echo $data_diri[9]?>
                                            </table>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="tab-pane" id="tab_5_5">
							<table class="table table-striped table-hover">
                            <?php echo $data_diri[10]?>
                            </table>
						</div>
                        <div class="tab-pane" id="tab_5_6">
							<table class="table table-striped table-hover">
                            <?php echo $data_diri[11]?>
                            </table>
						</div>
                        <div class="tab-pane" id="tab_5_7">
                            <div class="panel-group accordion scrollable" id="accordion5">
							<?php 
                            if(isset($berkas)){
                                $curSec='';
                                foreach($berkas->result() as $i=>$b){
                                    if($curSec!=$b->id_berkas){
                                    $curSec=$b->id_berkas;
                                    ?>
    								<div class="panel panel-default">
    									<div class="panel-heading">
    										<h4 class="panel-title">
    										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#collapse_5_<?php echo $b->id_berkas?>">
    										<?php echo $b->detail_berkas?> </a>
    										</h4>
    									</div>
    									<div id="collapse_5_<?php echo $b->id_berkas?>" class="panel-collapse <?php if($i==0) echo 'in'; else echo 'collapse';?>">
    										<div class="panel-body">
    											<div class="row mix-grid">
            										<?php foreach($berkas->result() as $j=>$f){ 
                                                        if($f->id_berkas == $curSec){
                                                        $filename=$f->NamaFile;
                                                        $tmp=explode('.',$filename);
                                                        $etx=$tmp[count($tmp)-1];
                                                        if(strtolower($etx)=='pdf'){
                                                            $katEtx=1;
                                                            $newFileUrl=base_url()."assets/additional/img/pdfdraaien.png";
                                                        }else{
                                                            $katEtx=2;
                                                            $newFileUrl=$f->fileUrl;   
                                                        }
                                                        ?>
                                                        <div class="col-md-3 col-sm-4 mix category_1">
                                                            <div class="mix-inner">
                                                                <?php if($katEtx==1){?>
                                                                    <a class="pdf_file" href="#" data-src="<?php echo $f->fileUrl;?>" data-name="<?php echo $f->NamaFileOri?>">    
                                                                <?php }else{?>
                                                                    <a class="group" href="<?php echo $newFileUrl;?>">
                                                                <?php }?>
                                                                
                												<img class="img-responsive" src="<?php echo $newFileUrl;?>" alt="">
                                                                </a>
                												<div class="mix-details">
                													<small><?php echo $f->NamaFileOri;?></small>
                												</div>
                											</div>
                                                        </div>
                                                    <?php } } ?>
                                                </div>
    										</div>
    									</div>
    								</div>
                                <?php
                                    } 
                                }
                            }
                            ?>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>

<div class="modal fade bs-modal-lg" id="prev_pdf" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="modal-title-pdf">Modal Title</h4>
			</div>
			<div class="modal-body" style="max-height: 500px;">
				 <div class="iframe-container" style="width:100%;">
                    <iframe id="iframe_pdf" src="" width="100%"></iframe>
                </div>
			</div>
			<div class="modal-footer">
				<div style="height: 10px;"></div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    getProfileCamaba('<?php echo str_replace('%40','@',$this->session->userdata('cur_user'))?>');
    $(document).ready(function(){
        //loadData();
        $("a#single_image").fancybox();
    
    	/* Apply fancybox to multiple items */
    	
    	$("a.group").fancybox({
    		'transitionIn'	:	'elastic',
    		'transitionOut'	:	'elastic',
    		'speedIn'		:	600, 
    		'speedOut'		:	200, 
    		'overlayShow'	:	true,
    	});
    });
    var MOBILE = $('html').hasClass('touch');
    var TABLET = $(MOBILE && screen.width>=768);
    
    if(TABLET){
        $('.fancybox-overlay').insertBefore($('.fancybox-wrap'));
    }
});
(function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 350px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog modal-lg">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);
$(".pdf_file").click(function(){
    $("#modal-title-pdf").html($(this).attr('data-name'));
    $("#iframe_pdf").attr('src',$(this).attr('data-src'));
    $("#prev_pdf").modal('show');
    
    return false;
})

function getProfileCamaba(id){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getProfileCamaba',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            fill_detail('form_tr_camaba',data)
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>