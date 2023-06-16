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

<div id="prev_pdf" class="modal container fade" tabindex="-1" data-focus-on="input:first" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title" id="modal-title-pdf">Stack Two</h4>
	</div>
	<div class="modal-body" style="max-height: 400px;">
		<div class="iframe-container" style="width:100%;">
            <iframe id="iframe_pdf" src="" width="100%"></iframe>
        </div>
	</div>
	<div class="modal-footer">
		<div style="height: 10px;"></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true,
	});
});

$(".pdf_file").click(function(){
    $("#modal-title-pdf").html($(this).attr('data-name'));
    $("#iframe_pdf").attr('src',$(this).attr('data-src'));
    $("#prev_pdf").modal('show');
    
    return false;
})
</script>