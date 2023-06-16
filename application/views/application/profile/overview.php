<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PORTLET -->
		<div class="portlet light" style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Progress Pendaftaran</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
			</div>
			<div class="portlet-body">
                <div class="progress progress-striped">
                    <?php
                        $last=$langkah->result_array();
                        $last=$last[count($last)-1];
                        
                        if($langkahCamaba['Id_Langkah_Daftar']==$last['Id_Langkah'] && strtoupper($langkahCamaba['Status_Langkah_Daftar'])=='COMPLETE') $prog=100;else
                        $prog=round(($langkahCamaba['Langkah_Ke']-1)/$langkah->num_rows()*100,0); 
                        
                    ?>
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog?>%">
						<span>
						<?php echo $prog?>% Complete </span>
					</div>
				</div>
                <div class="profile-usermenu">
					<ul class="nav">
                        <?php foreach($langkah->result_array() as $i=>$l){
                                if($langkahCamaba['Langkah_Ke']==$l['Langkah_Ke']) $aktif='class="langkah active"'; else $aktif='class="langkah"';
                                if($langkahCamaba['Langkah_Ke']>=$l['Langkah_Ke']){
                                    $link=conf_link($l['Link_Target']);
                                    $permit="true";   
                                }else{
                                    $link='#';
                                    $permit="false";
                                }
                            ?>
                            <li <?php echo $aktif?> id="langkah-<?php echo $l['Id_Langkah']?>" data-langkah="<?php echo $l['Id_Langkah']?>">
    							<a href="<?php echo $link;?>" data-permit="<?php echo $permit?>">
    							<?php echo ($i+1).'.  '.$l['Langkah_Daftar'];
                                if($langkahCamaba['Langkah_Ke']>$l['Langkah_Ke']){?>
                                    <i class="glyphicon glyphicon-ok-circle font-green"></i>
                                <?php }else
                                    if($langkahCamaba['Langkah_Ke']==$l['Langkah_Ke']){
                                        if($langkahCamaba['Status_Langkah_Daftar']=='Complete'){?>
                                            <i class="glyphicon glyphicon-ok-circle font-green"></i>
                                            <?php if($langkahCamaba['Id_StatusLangkah']=='8') echo '('.$langkahCamaba['Pesan'].')' ?>
                                        <?php }else
                                        if($langkahCamaba['Status_Langkah_Daftar']=='Wait'){?>
                                            <i class="icon icon-hourglass font-yellow-crusta"></i>(
                                            <?php echo $langkahCamaba['Pesan'] ?>)                                           
                                        <?php }else
                                        if($langkahCamaba['Status_Langkah_Daftar']=='Uncomplete'){?>
                                            <i class="glyphicon glyphicon-remove-circle font-red-thunderbird"></i>(
                                            <?php echo $langkahCamaba['Pesan'] ?>)
                                        <?php }?>
                                <?php }?>
                                </a>
    						</li>
                        <?php }?>
						<!--<li class="active">
							<a href="extra_profile.html">Registrasi pendafaran 
                            <i class="glyphicon glyphicon-ok-circle font-green"></i>
                            </a>
						</li>!-->
					</ul>
				</div>
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>
<script type="text/javascript">
$(".langkah").click(function(){
    if($(this).find('a').attr('href')=='#' && $(this).find('a').attr('data-permit')=='true'){
        loadInfo($(this).attr('data-langkah'));    
    }
})
function loadInfo(id){
    Metronic.startPageLoading({animate: true});
    $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id?>/loadInfo",{id:id}, function( data ) {
      if(data.isEnable){
        $( ".profile-content" ).html( data.page );  
      }
      Metronic.stopPageLoading();
    },'json');
}
</script>