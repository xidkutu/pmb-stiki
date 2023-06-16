<form class="form-horizontal" role="form">
<?php 
    foreach($data->result() as $d){?>
        <div class="form-body">
    		<div class="form-group" id="form-group-berkas-<?php echo $d->id_berkas?>">
    			<label class="col-md-3 control-label"><?php echo $d->detail_berkas?></label>
                <div class="col-md-8">
                    <div class="dropzone form_berkas" id="berkas-<?php echo $d->id_berkas?>"></div>
                    <div class="berkas_existed" id="berkas_existed_<?php echo $d->detail_berkas;?>">
                        <ul class="list-group">
                            <?php foreach($uploaded->result() as $up){
                                if($up->id_berkas == $d->id_berkas){?>
                                    <li class="list-group-item">
                    					 <span class="berkas-namaFile" id="berkas-namaFile-<?php echo $up->Id_Files?>" idfile="<?php echo $up->Id_Files?>"><?php echo $up->NamaFileOri?></span>
                                         <a><span class="glyphicon glyphicon-trash pull-right popovers berkas-hapus" id="berkas-hapus-<?php echo $up->Id_Files?>" hapus-target="<?php echo $up->Id_Files?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Hapus berkas"></span></a>
                                         <a><span style="display: none;" class="fa fa-undo pull-right popovers berkas-undo" id="berkas-undo-<?php echo $up->Id_Files?>" hapus-target="<?php echo $up->Id_Files?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Batalkan pengapusan"></span></a>
                    				</li>
                                <?php }
                            }?>
            			</ul>
                    </div>
                </div>
    		</div>
        </div>            
<?php }
?>
</form>
<script type="text/javascript">
    <?php foreach($data->result() as $d){?>
        var mydrop<?php echo $d->id_berkas?>;
        var isComplete<?php echo $d->id_berkas?>=true;
    <?php }?>
    function resetDropBerkas(){
        <?php foreach($data->result() as $d){?>
            isComplete<?php echo $d->id_berkas?>=true;
        <?php }?>    
    }
    $(document).ready(function(){
        <?php foreach($data->result() as $d){?>
            $(function(){
                mydrop<?php echo $d->id_berkas?> = new Dropzone("div#berkas-<?php echo $d->id_berkas?>",
                {url: "<?php echo base_url()?>index.php/file_uploader/doUploadBerkasDaftar?id=<?php echo $d->id_berkas?>",
                addRemoveLinks:true,
                autoProcessQueue:false,
                maxFilesize:<?php echo $max_filesize;?>,
                parallelUploads:20,
                acceptedFiles:'image/*,application/pdf'});
                
                mydrop<?php echo $d->id_berkas?>.on("removedfile",function(file){
                    $.post( "<?php echo base_url(); ?>index.php/file_uploader/removeberkas",{id:file.name,berkas:'<?php echo $d->id_berkas?>'}, function( data ){
                        //alert(data.msg);
                    }, "json" );
                });
            }) 
        <?php }?>
        
        var lastPopedPopover;
        $('.popovers').popover();
        
        // close last displayed popover
        $(document).on('click.bs.popover.data-api', function(e) {
            if (lastPopedPopover) {
                lastPopedPopover.popover('hide');
            }
        });
    });
    
    function doUpload(){
        <?php
        $dataArr=$data->result_array();
        if(count($dataArr)>0){?>
            doUploadDrop<?php echo $dataArr[0]['id_berkas'];?>();
        <?php }?>
    };
    
    
    <?php 
    $dataArr=$data->result_array();
    foreach($dataArr as $i=>$d){?>
    function doUploadDrop<?php echo $d['id_berkas']?>(){
        var fileque<?php echo $d['id_berkas']?>=mydrop<?php echo $d['id_berkas']?>.getQueuedFiles();
        if(fileque<?php echo $d['id_berkas']?>.length>0) mydrop<?php echo $d['id_berkas']?>.processFile(fileque<?php echo $d['id_berkas']?>[0]);
        else{
            if($("#isCanChange").val()!=''){
                <?php if($i==(count($dataArr)-1)){?>
                    isAllCompleteAndProcess();  
                <?php }else{?>
                    doUploadDrop<?php echo $dataArr[($i+1)]['id_berkas']?>();
                <?php }?>   
            }
        }
    }
    
    mydrop<?php echo $d['id_berkas']?>.on("complete", function(file){
        if($("#isCanChange").val()!=''){
            var fileque<?php echo $d['id_berkas']?>=mydrop<?php echo $d['id_berkas']?>.getQueuedFiles();
            if(fileque<?php echo $d['id_berkas']?>.length>0) doUploadDrop<?php echo $d['id_berkas']?>();
        }
    })
    
    mydrop<?php echo $d['id_berkas']?>.on("queuecomplete", function(file) {
        if($("#isCanChange").val()!=''){
            isComplete<?php echo $d['id_berkas']?>=true;
            <?php if($i==(count($dataArr)-1)){?>
                isAllCompleteAndProcess();  
            <?php }else{?>
                doUploadDrop<?php echo $dataArr[($i+1)]['id_berkas']?>();
            <?php }?>
        }       
    });
        
    mydrop<?php echo $d['id_berkas']?>.on("addedfile", function(file) {
          isComplete<?php echo $d['id_berkas']?>=false;
        });
    <?php }?>
    
    function isAllComplete(){
        if(
        <?php foreach($data->result() as $d){?>
            isComplete<?php echo $d->id_berkas?> &&
        <?php }?>
        true ) return true; else return false;
    }
    
    function isAllCompleteAndProcess(){
        if(
        <?php foreach($data->result() as $d){?>
            isComplete<?php echo $d->id_berkas?> &&
        <?php }?>
        true ) doSimpan();
    }
    
    $(".berkas-hapus").click(function(){
        $("#berkas-namaFile-"+$(this).attr('hapus-target')).css('text-decoration','line-through');
        $("#berkas-namaFile-"+$(this).attr('hapus-target')).addClass('deleted');
        $("#berkas-hapus-"+$(this).attr('hapus-target')).hide(400);
        $("#berkas-undo-"+$(this).attr('hapus-target')).show(400);
    })
    $(".berkas-undo").click(function(){
        $("#berkas-namaFile-"+$(this).attr('hapus-target')).css('text-decoration','');
        $("#berkas-namaFile-"+$(this).attr('hapus-target')).removeClass('deleted');
        $("#berkas-hapus-"+$(this).attr('hapus-target')).show(400);
        $("#berkas-undo-"+$(this).attr('hapus-target')).hide(400);
    })
    function getDeletedFile(){
        var res='';
        $(".berkas-namaFile.deleted").each(function(){
            res+=$(this).attr('idfile')+'-';
        });
        res=res.substr(0,res.length-1);
        return res;
    }    
</script>