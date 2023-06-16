<?php if(isset($cssInclude)) echo $cssInclude?>
<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
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
                <table class="table">
                <?php echo $detTbl?>
                </table>
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        loadData();
        $("a#single_image").fancybox();
	
    	/* Using custom settings */
    	
    	$("a#inline").fancybox({
    		'hideOnContentClick': true
    	});
    
    	/* Apply fancybox to multiple items */
    	
    	$("a.group").fancybox({
    		'transitionIn'	:	'elastic',
    		'transitionOut'	:	'elastic',
    		'speedIn'		:	600, 
    		'speedOut'		:	200, 
    		'overlayShow'	:	false
    	});
    });
    function loadData(){
        $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getDetaiStatus", function( data ) {
          fill_detail('form_bayar_daftar',data);
          $("#detail_IdFile").html('<a id="single_image" href="'+data.UrlFile+'"><img src="'+data.UrlFile+'" style="width: 60%;;"/></a>')
          
          if(data.isAproved.toLowerCase()=='diterima') var clr='success';
          else if(data.isAproved.toLowerCase()=='menunggu verifikasi') var clr='warning';
          else var clr='danger' 
          $("#detail_isAproved").html('<span class="badge badge-'+clr+'"><strong>'+data.isAproved+'</strong></span>')
        },"json");
    }
    
</script>
<?php echo $js_global_method?>