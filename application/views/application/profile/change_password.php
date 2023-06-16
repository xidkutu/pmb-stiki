<div class="row">
	<div class="col-md-12">        
         <div class="portlet light " style="margin-right: 20px;">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Ganti Password</span>
					<span class="caption-helper hide">weekly stats...</span>
				</div>
			</div>
			<div class="portlet-body">
              <form action="" id="frmchangepassword" class="form-horizontal">              
               <div class="form-group">
                	<label class="col-md-3 control-label">Password Baru</label>
                	<div class="col-md-4">
                		<input type="password" class="form-control" placeholder="Masukkan password baru" id="txtNewPassword" name="txtNewPassword">
                		<span class="help-block">
                		Minimal 4 karakter. </span>
                	</div>
                </div>
                <div class="form-group">
                	<label class="col-md-3 control-label">Ulangi Password Baru</label>
                	<div class="col-md-4">
                		<input type="password" class="form-control" placeholder="Masukkan lagi password baru" id="txtConfirmPassword" name="txtConfirmPassword">                		
                        <div id="divCheckPasswordMatch"></div>                        
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-circle blue">Ubah Password</button>
                        <button type="reset" class="btn btn-circle default">Clear</button>
                    </div>
                </div>                
                </form>
            </div>
        </div>
	</div>    
</div>

<script type="text/javascript">
    $(document).ready(function(){        
        $('#txtConfirmPassword').on('keyup',function(){
            checkPasswordMatch();
        })
        
        $('#frmchangepassword').submit(function() {             
            var url = '<?php echo base_url()?>index.php/change_password/simpan';     
            $.ajax({
                   type: 'POST',
                   url: url,
                   data: $('#frmchangepassword').serialize(), 
                   success: function(data)
                   {   
                       if (data=='ok') toastr['success']("Perubahan berhasil tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                       else
                        toastr['error']("Tidak berhasil menyimpan perubahan, terjadi kesalahan '"+kesalahan+"' hubungi Administrator", "<?php echo $page_info['Nama_Menu']?>");
                        
                       $('#frmchangepassword').trigger('reset');
                       $('#divCheckPasswordMatch').html('');                                                                     
                   }
                 });            
            return false; 
        });        
        
    });          

    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
                
        if (password != confirmPassword)
            $("#divCheckPasswordMatch").html("Password tidak sama!");
        else
            $("#divCheckPasswordMatch").html("Password sama.");
    }
</script>