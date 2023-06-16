<script src="<?php echo base_url()?>/assets/additional/plugin/test/dropzone-master/downloads/dropzone.js"></script>
<link href="<?php echo base_url()?>assets/additional/plugin/test/dropzone-master/downloads/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/additional/plugin/test/dropzone-master/downloads/css/basic.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url()?>assets/metronic/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<div class="dropzone" id="dropzonePhotoMhs">
  <small>Drag dan drop file disini atau klik untuk membuka upload dialog</small>
</div>
<div id="test">
asdasdasd
</div>
<form action="<?php echo $this->config->item('file_server')?>index.php/file_uploader/doUploadImage"
      class="dropzone"
      id="my-awesome-dropzone"></form>
      
<script type="text/javascript">
    $(document).ready(function(){
        //var myDropzone = new Dropzone("div#dropzonePhotoMhs", { url: "<?php echo $this->config->item('file_server')?>index.php/file_uploader/doUploadImage"});
        //var myDropzone = new Dropzone("div#dropzonePhotoMhs", { url: "/file/post"});
        //$("#dropzonePhotoMhs").dropzone({ url: "/file/post" });
        //alert($('div#test').innerHTML);
        //var test=document.getElementById('test').innerHTML;
        //alert(test);
    })
    var myDropzone = new Dropzone("div#dropzonePhotoMhs", { url: "/file/post"});
</script>