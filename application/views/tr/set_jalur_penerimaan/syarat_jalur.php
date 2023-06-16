<div class="input-group">
    <ul class="list-group" id="listgroup-syaratdaftar">
        <?php foreach($obj_syarat->result_array() as $i=>$r){?>
            <li class="list-group-item">
                <div class="icheck-list">
    				<label>
    				<input type="checkbox" class="icheck check-syaratdaftar" value="<?php echo $r['Id_SyaratDaftar']?>" <?php if(strtoupper($r['is_Passed'])=='YES') echo 'checked="checked"'?>)? > <?php echo ($i+1).'. '.$r['Detail_SyaratDaftar']; ?>
                    </label>
    	        </div> 
        	</li>
        <?php }?>
    </ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square',
    radioClass: 'iradio_square',
    increaseArea: '20%' // optional
  });
});
</script>