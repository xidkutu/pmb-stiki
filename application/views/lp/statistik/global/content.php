<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light ">
			<div class="portlet-title">
				<form role="form">
                    <div class="form-body">
                        <div class="col-md-3">        
                            <div class="form-group">
								<label>Tipe</label>
								<select class="form-control" id="filtr_tipe">
                                    <option value>--PILIH--</option>
                                    <option value="1">Pendaftar</option>
                                    <option value="2">Mahasiswa Diterima</option>
                                    <option value="3">Pembayaran Diterima</option>
                                </select>
							</div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
								<label>Tanggal</label>
								<div id="daterangepicker2" class="btn default form-control"><i class="fa fa-calendar"></i>&nbsp; <span></span><b class="fa fa-angle-down"></b></div>
							</div>
                        </div>
                    </div>    
                </form>
			</div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
            			<div class="portlet light ">
                			<div class="portlet-title">
                				<div class="caption caption-md">
                					<i class="icon-bar-chart theme-font-color hide"></i>
                					<span class="caption-subject theme-font-color bold uppercase">Tabel</span>
                					<span class="caption-helper hide">weekly stats...</span>
                				</div>
                				<div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default export-excel" href="#" target-table="my_tabel">
									<i class="fa fa-file-excel-o"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default tutup" href="#">
									<i class="icon-tutup fa fa-chevron-down"></i>
                                </a>
                                <a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
                				</div>
                			</div>
                			<div class="portlet-body" id="body-tabel">
                                <table class="table" id="my_tabel">
                                    <tr><td colspan="3" style="text-align: center;">Tidak ada data</td></tr>
                                </table>
                			</div>
                		</div>	
                    </div>
                    <div class="col-md-6 col-sm-12">
            			<div class="portlet light ">
                			<div class="portlet-title">
                				<div class="caption caption-md">
                					<i class="icon-bar-chart theme-font-color hide"></i>
                					<span class="caption-subject theme-font-color bold uppercase">Diagram Pie</span>
                					<span class="caption-helper hide">weekly stats...</span>
                				</div>
                                <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default tutup" href="#">
									<i class="icon-tutup fa fa-chevron-down"></i>
                                </a>
                                <a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
                				</div>
                			</div>
                			<div class="portlet-body">
                				<div id="chart_7" class="chart" style="height: 340px;">
                				</div>
                			</div>
                		</div>	
                    </div>
                </div>
			</div>
            <!-- END PORTLET-->
		</div>
    </div>
</div>
<!-- BEGIN PAGE CONTENT INNER -->
	
<?php if(isset($modal_mhs)) echo $modal_mhs;?>	
		<!-- END PAGE CONTENT INNER -->

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
<script src="<?php echo base_url()?>assets/additional/scripts/dashboard/charts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

 <!--END PAGE LEVEL PLUGINS -->
 <script type="text/javascript" src="<?php echo base_url()?>assets/additional/js/application/rep_stat_sch/my_script.js"></script>
<script>
jQuery(document).ready(function() {    
   //Metronic.init(); // init metronic core componets
   //Layout.init(); // init layout
   Demo.init(); // init demo features
   initDateRangePicker();
   initMyToolsPortlet();
});
var dateStart=moment();
var dateEnd=moment();

function getReport(){
    var tipe=$("#filtr_tipe").val();
    if(tipe.length>0 && !jQuery.isEmptyObject(dateStart) && !jQuery.isEmptyObject(dateEnd)){
        Metronic.startPageLoading({animate: true});
        $.post( "<?php echo base_url();?>index.php/<?php echo $page_id?>/getReport",{tipe:tipe,start:dateStart.format('YYYY-MM-DD'),end:dateEnd.format('YYYY-MM-DD')}, function( data ) {
           //ChartsAmcharts.init(data);
           $("#body-tabel").html(data);
           getReport_pie();
           Metronic.stopPageLoading();
        });    
    }
}
function getReport_pie(){
    var tipe=$("#filtr_tipe").val();
    if(tipe.length>0 && !jQuery.isEmptyObject(dateStart) && !jQuery.isEmptyObject(dateEnd)){
        Metronic.startPageLoading({animate: true});
        $.post( "<?php echo base_url();?>index.php/<?php echo $page_id?>/getReport_pie",{tipe:tipe,start:dateStart.format('YYYY-MM-DD'),end:dateEnd.format('YYYY-MM-DD')}, function( data ) {
           ChartsAmcharts.init(data);
           initTooltip();
           Metronic.stopPageLoading();
        },'json');    
    }
}
function initTooltip(){
    $('.detail-table').tooltip('destroy');
    
    $('.detail-table').tooltip({
        container: 'body',
        title: 'Klik untuk melihat detail'
    });
    $('.detail-table').tooltip('hide');
    $('.tooltip').hide();
}
</script>
<!-- END JAVASCRIPTS -->