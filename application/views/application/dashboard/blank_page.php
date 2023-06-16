
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb hide">
	<li>
		<a href="#">Home</a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		 Dashboard
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE CONTENT INNER -->

<!-- END PAGE CONTENT INNER -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="<?php echo base_url()?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features 
    Index.init(); // init index page
 Tasks.initDashboardWidget(); // init tash dashboard widget  
});
</script>
<!-- END JAVASCRIPTS -->