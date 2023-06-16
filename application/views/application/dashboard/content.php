		<!-- BEGIN PAGE CONTENT INNER -->
		<div class="row margin-top-10">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-green-sharp" id="today_visitor"><?php echo $stat['today_visitor']?></h3>
							<small>Pengunjung Hari Ini</small>
						</div>
						<div class="icon">
							<i class="icon icon-user"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span id="prog_today_visitor" style="width: <?php echo $stat['prog_today_visitor']?>%;" class="progress-bar progress-bar-success green-sharp">
							<span class="sr-only"></span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								 Progress Target
							</div>
							<div class="status-number" id="stat_today_visitor">
								 <?php echo $stat['prog_today_visitor']?>%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-red-haze" id="tot_visitor"><?php echo $stat['total_visitor']?></h3>
							<small>Total Pengunjung</small>
						</div>
						<div class="icon">
							<i class="icon icon-users"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span id="prog_tot_visitor" style="width: <?php echo $stat['prog_tot_visitor']?>%;" class="progress-bar progress-bar-success red-haze">
							<span class="sr-only">85% change</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								 Progress Target
							</div>
							<div class="status-number" id="stat_tot_visitor">
								 <?php echo $stat['prog_tot_visitor']?>%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-blue-sharp" id="pendaftar"><?php echo $stat['pendaftar']?></h3>
							<small>Pendaftar</small>
						</div>
						<div class="icon">
							<i class="icon icon-user-follow"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span id="prog_pendaftar" style="width: <?php echo $stat['prog_pendaftar']?>%;" class="progress-bar progress-bar-success blue-sharp">
							<span class="sr-only">45% grow</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								 Progress target
							</div>
							<div class="status-number" id="stat_pendaftar">
								 <?php echo $stat['prog_pendaftar']?>%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-purple-soft" id="mhs_diterima"><?php echo $stat['diterima']?></h3>
							<small>Mahasiswa Diterima</small>
						</div>
						<div class="icon">
							<i class="icon icon-user-following"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span id="prog_mhs_diterima" style="width: <?php echo $stat['prog_mahasiswa']?>%;" class="progress-bar progress-bar-success purple-soft">
							<span class="sr-only">56% change</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								 Progress target
							</div>
							<div class="status-number" id="stat_mhs_diterima">
								 <?php echo $stat['prog_mahasiswa']?>%
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<!-- BEGIN REGIONAL STATS PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font-color hide"></i>
							<span class="caption-subject theme-font-color bold uppercase">Peta Pengunjung</span>
						</div>
						<div class="actions">
							<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
							<i class="icon-cloud-upload"></i>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
							<i class="icon-wrench"></i>
							</a>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
							</a>
							<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
							<i class="icon-trash"></i>
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<div id="region_statistics_loading">
							<img src="<?php echo base_url()?>assets/admin/layout/img/loading.gif" alt="loading"/>
						</div>
						<div id="region_statistics_content" class="display-none">
							<div class="btn-toolbar margin-bottom-10">
								<div class="btn-group pull-right">
									<a href="" class="btn btn-circle grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									Select Region <span class="fa fa-angle-down">
									</span>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="javascript:;" id="regional_stat_world">
											World </a>
										</li>
                                        <li>
											<a href="javascript:;" id="regional_stat_asia">
											Asia </a>
										</li>
									</ul>
								</div>
							</div>
							<div id="vmap_world" class="vmaps display-none">
							</div>
							<div id="vmap_asia" class="vmaps display-none">
							</div>
						</div>
					</div>
				</div>
				<!-- END REGIONAL STATS PORTLET-->
			</div>
			<div class="col-md-6 col-sm-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font-color hide"></i>
							<span class="caption-subject theme-font-color bold uppercase">Regional Pengunjung</span>
							<span class="caption-helper hide">weekly stats...</span>
						</div>
						<div class="actions">
							<!--<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
								<input type="radio" name="options" class="toggle" id="option1">Today</label>
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
								<input type="radio" name="options" class="toggle" id="option2">Week</label>
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
								<input type="radio" name="options" class="toggle" id="option2">Month</label>
							</div>-->
						</div>
					</div>
					<div class="portlet-body">
						<div id="chart_7" class="chart" style="height: 340px;">
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div>
		
		
		<!-- END PAGE CONTENT INNER -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.asia.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="<?php echo base_url()?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/additional/scripts/dashboard/maps.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/additional/scripts/dashboard/charts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   //Metronic.init(); // init metronic core componets
   //Layout.init(); // init layout
   Demo.init(); // init demo features
   iniOnStart();
   setInterval(function(){ getStatistic(); }, 5000);
});
function getStatistic(){
    $.post( "<?php echo base_url();?>index.php/dashboard/getStatistik", function( data ) {
        $("#today_visitor").html(data.today_visitor);
        $("#prog_today_visitor").css("width",data.prog_today_visitor+"%");
        $("#stat_today_visitor").html(data.prog_today_visitor+"%");
        
        $("#tot_visitor").html(data.total_visitor);
        $("#prog_tot_visitor").css("width",data.prog_tot_visitor+"%");
        $("#stat_tot_visitor").html(data.prog_tot_visitor+"%");
        
        $("#pendaftar").html(data.pendaftar);
        $("#prog_pendaftar").css("width",data.prog_pendaftar+"%");
        $("#stat_pendaftar").html(data.prog_pendaftar+"%");
        
        $("#mhs_diterima").html(data.diterima);
        $("#prog_mhs_diterima").css("width",data.prog_mahasiswa+"%");
        $("#stat_mhs_diterima").html(data.prog_mahasiswa+"%");
    }, "json");
}
function iniOnStart(){
    getRegional();
    getRegionalPie();
}
function getRegional(){
    $.post( "<?php echo base_url();?>index.php/dashboard/getRegionalVisitor", function( data ) {
       Index.init(data); 
    }, "json");
}
function getRegionalPie(){
    $.post( "<?php echo base_url();?>index.php/dashboard/getRegionalVisitor_pie", function( data ) {
       ChartsAmcharts.init(data);
    }, "json");
}
</script>
<!-- END JAVASCRIPTS -->