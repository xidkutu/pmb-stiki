<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PORTLET -->
		<div class="portlet light " style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Biodata Pegawai</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
			</div>
			<div class="portlet-body">
                <table class="table table-striped table-hover">
                <?php echo $data_diri?>
                </table>
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    getProfileCamaba('<?php echo str_replace('%40','@',$this->session->userdata('cur_user'))?>');
});
function getProfileCamaba(id){
    var string = 'id='+id;
        
	$.ajax({
		type	: 'POST',
		url		: '<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/getProfilePegawai',
		data	: string,
		cache	: false,
        dataType : "json",
		success	: function(data){
            fill_detail('form_pegawai',data)
		},
		error : function(xhr, teksStatus, kesalahan) {
			toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
			return false;
        }
	});
	return false;
}
</script>