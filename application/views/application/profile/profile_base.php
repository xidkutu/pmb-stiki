<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>

<!-- CSS -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/demo.css"> -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/imgpicker.css">

<!-- JavaScript -->
<!-- <script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery-1.11.0.min.js"></script> -->
<script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery.imgpicker.js"></script>
    
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar not-printable my_profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a href="#" data-ip-modal="#avatarModal">
                        <img src="<?php echo $no_picture_url?>" class="img-responsive" id="img_profile" alt="">
                    </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                        
					</div>
					<div class="profile-usertitle-job">
				        
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons" style="padding: 10px;">
					<button type="button" id="btneditpic" data-ip-modal="#avatarModal" class="btn btn-circle green-haze btn-sm">Ganti Foto Profile</button>					
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu my_banners">
                <img src="http://files.stiki.ac.id/repository/Images/banners/banner.jpg" style="max-width: 100%;" />
					
				</div>
				<!-- END MENU -->
			</div>
			<!-- END PORTLET MAIN -->
		</div>
		<!-- END BEGIN PROFILE SIDEBAR -->
		<!-- BEGIN PROFILE CONTENT -->
		<div class="profile-content">
			
		</div>
		<!-- END PROFILE CONTENT -->
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- Avatar Modal -->
<div class="ip-modal" id="avatarModal">
	<div class="ip-modal-dialog">
		<div class="ip-modal-content">
			<div class="ip-modal-header">
				<a class="ip-close" title="Close">&times;</a>
				<h4 class="ip-modal-title">Ganti Foto Profile</h4>
			</div>
			<div class="ip-modal-body">
				<div class="btn btn-primary ip-upload">Upload Foto (*.jpg)<input type="file" name="file" class="ip-file"></div>
				<button class="btn btn-primary ip-webcam">Webcam</button>
				<button type="button" class="btn btn-info ip-edit">Edit</button>
				<button type="button" class="btn btn-danger ip-delete">Delete</button>
				
				<div class="alert ip-alert"></div>				
                <div class="ip-info">Untuk memotong foto, geser bingkai dibawah kemudian klik "Simpan Foto"</div>
				<div class="ip-preview"></div>
				<div class="ip-rotate">
					<button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
					<button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i class="icon-cw"></i></button>
				</div>
				<div class="ip-progress">
					<div class="text">Uploading</div>
					<div class="progress progress-striped active"><div class="progress-bar"></div></div>
				</div>
			</div>
			<div class="ip-modal-footer">
				<div class="ip-actions">
					<button class="btn btn-success ip-save" id="btnsaveimg">Simpan Foto</button>
					<button class="btn btn-primary ip-capture">Ambil Gambar</button>
					<button class="btn btn-default ip-cancel">Batal</button>
				</div>
				<button class="btn btn-default ip-close">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- end Modal -->

<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
var curImg;
$(document).ready(function(){
    loadPage();
    loadData('<?php echo $this->session->userdata('cur_user')?>');
    
    var time = function(){return'?'+new Date().getTime()};
    	
    <?php 
        if($this->session->userdata('role')=='camaba'){ ?>
          $('#avatarModal').imgPicker({
				url: '<?php echo base_url()?>index.php/tr_pmb_insert_data/uploadavatar',
				aspectRatio: 0.75,
				deleteComplete: function() {
					$('#img_profile').attr('src', '<?php echo $no_picture_url?>');
					this.modal('hide');
				},
				uploadSuccess: function(image) {
					// Calculate the default selection for the cropper
					var select = (image.width > image.height) ? 
							[(image.width-image.height)/2, 0, image.height, image.height] : 
							[0, (image.height-image.width)/2, image.width, image.width];

					this.options.setSelect = select;
				},
				cropSuccess: function(image) {
				    var imgUrl=image.url;
                    var imgUrlarr=imgUrl.split(".");
                    var etx=imgUrlarr[imgUrlarr.length-1];
                    imgUrlarr.pop();
                    var filename=imgUrlarr.join(".");
					$('#img_profile').attr('src', filename+"-thumb."+etx );
                    $('#img_pojok').attr('src', filename+"-thumb."+etx );
					this.modal('hide');
                    
                    curImg=filename+"-thumb."+etx;
                    //$.post("<?php echo base_url(); ?>profile/uploadftp");
                    uploadPhoto();
				}
        });   
    <?php }else{ ?>
            $('#avatarModal').imgPicker({
				url: '<?php echo base_url()?>index.php/profile/uploadavatar',
				aspectRatio: 1,
				deleteComplete: function() {
					$('#img_profile').attr('src', '<?php echo $no_picture_url?>');
					this.modal('hide');
				},
				uploadSuccess: function(image) {
					// Calculate the default selection for the cropper
					var select = (image.width > image.height) ? 
							[(image.width-image.height)/2, 0, image.height, image.height] : 
							[0, (image.height-image.width)/2, image.width, image.width];

					this.options.setSelect = select;
				},
				cropSuccess: function(image) {
				    this.modal('hide');
                    
                    $.post("<?php echo base_url(); ?>index.php/profile/uploadftp",function(data){
                        var d = new Date();
                        var n = d.getTime();
                        
                        $('#img_profile').attr('src', data+'?'+n );
                        $('#img_pojok').attr('src', data+'?'+n );    
                    });
				}
                }); 
        <?php }
    ?>
       
    
});

function uploadPhoto(){
    $.post( "<?php echo base_url(); ?>index.php/file_uploader/uploadPhotoDataDiri",{username:'<?php echo $this->session->userdata('username')?>'}, function( data ){
        var imgUrl=curImg.split("/");
        var filename=imgUrl[imgUrl.length-1];
        var d = new Date();
        var n = d.getTime();
      $('#img_pojok').attr('src', '<?php echo $this->config->item('ftp_domain').$this->config->item('ftp_loc_img')?>'+filename+'?'+n );
    },'json' );
}
function loadData(id){
    Metronic.startPageLoading({animate: true});
    $.post( "<?php echo base_url(); ?>index.php/profile/getUserData",{id:id}, function( data ){
      $( ".profile-usertitle-name" ).html( data.namaLengkap );
      $( ".profile-usertitle-job" ).html( data.Role_Name );
      $( "#img_profile" ).attr( "src",data.photo );
      Metronic.stopPageLoading();
    }, "json" );
}
function loadPage(){
    Metronic.startPageLoading({animate: true});
    $.post( "<?php echo base_url(); ?>index.php/<?php echo $page_id?>/loadPage", function( data ) {
      $( ".profile-content" ).html( data );
      Metronic.stopPageLoading();
    });
}
</script>