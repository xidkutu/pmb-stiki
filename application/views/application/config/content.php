<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
<!-- END PLUGINS USED BY X-EDITABLE -->
<div class="row">
	<div class="col-md-12">
		<!-- Begin: life time stats -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="<?php echo $page_info['Icon']?> font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?php echo $page_info['Nama_Menu']?></span>
					<span class="caption-helper"><?php echo $page_info['Keterangan']?></span>
				</div>
				<div class="actions">
					
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
						<div class="col-md-12">
							<table id="user" class="table table-bordered table-striped">
							<tbody>
                            <?php foreach($data->result_array() as $d){?>
                            <tr>
								<td style="width:25%">
									 <?php echo $d['conf_caption']?>
								</td>
								<td style="width:35%">
									<a href="#" id="<?php echo $d['conf_name']?>" data-type="text" data-pk="1" data-original-title="Enter username">
									<?php echo $d['value']?> </a>
								</td>
								<td style="width:40%">
									<span class="text-muted">
									<?php echo $d['deskripsi']?> </span>
								</td>
							</tr>
                            <?php }?>
							</tbody>
							</table>
						</div>
					</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<!-- END X-EDITABLE PLUGIN -->
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
jQuery(document).ready(function() {
    FormEditable.init();
});   

var FormEditable = function () {

    var initEditables = function () {

        //set editable mode based on URL parameter
        if (Metronic.getURLParameter('mode') == 'inline') {
            $.fn.editable.defaults.mode = 'inline';
            $('#inline').attr("checked", true);
            jQuery.uniform.update('#inline');
        } else {
            $('#inline').attr("checked", false);
            jQuery.uniform.update('#inline');
        }

        //global settings 
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/index.php/" + getUrl.pathname.split('/')[1];
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = baseUrl+'/simpan';
        
        //editables element samples 
        <?php 
        foreach($data->result_array() as $d){?>
        $('#<?php echo $d['conf_name']?>').editable({
            name: '<?php echo $d['conf_name']?>',
            title: 'Masukkan <?php echo $d['conf_caption']?>',
            success: function(response, newValue) {
                if(response){
                    toastr['success']("Perubahan berhasil tersimpan", "Setting");
                }else{
                    toastr['error']("Tidak berhasil menyimpan perubahan, hubungi Administrator", "Setting");
                }
            }
        });
        <?php }?>
    }

    return {
        init: function () {
            initEditables();
            $('#enable').click(function () {
                $('#user .editable').editable('toggleDisabled');
            });
            $('#inline').on('change', function (e) {
                if ($(this).is(':checked')) {
                    window.location.href = 'form_editable.html?mode=inline';
                } else {
                    window.location.href = 'form_editable.html';
                }
            });
            $('#user .editable').on('hidden', function (e, reason) {
                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable');
                    if ($('#autoopen').is(':checked')) {
                        setTimeout(function () {
                            $next.editable('show');
                        }, 300);
                    } else {
                        $next.focus();
                    }
                }
            });
        }
    };
}();
</script>
<?php echo $js_global_method?>
