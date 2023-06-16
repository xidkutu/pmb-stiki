<!-- CSS -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/demo.css"> -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/additional/imgPicker/css/imgpicker.css">

<!-- JavaScript -->
<!-- <script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery-1.11.0.min.js"></script> -->
<script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery.Jcrop.min.js"></script>
<script src="<?php echo base_url()?>assets/additional/imgPicker/js/jquery.imgpicker.js"></script>
<!-- Avatar Modal -->

<div class="ip-modal" id="avatarModal">
	<div class="ip-modal-dialog" style="z-index: 10050;">
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
                <input type="hidden" id="isProfile"/>
			</div>
		</div>
	</div>
</div>
<!-- end Modal -->
<script type="text/javascript">
var curImg;
$(document).ready(function(){
    var time = function(){return'?'+new Date().getTime()};
    	
    $('#avatarModal').imgPicker({
				url: '<?php echo base_url()?>index.php/tr_pmb_insert_data/uploadavatar',
				aspectRatio: <?php echo $img_aspect_ratio;?>,
                //minSize:[200,300],
//                maxSize:[200,300],
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
					$('#img_profile').attr('src', filename+"-avatar."+etx );
                    curImg=filename+"-thumb."+etx;
                    $("#isProfile").val("yes");
					this.modal('hide');
				}
        });    
    
});
</script>