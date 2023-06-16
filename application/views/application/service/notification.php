<li class="external">
	<h3><span class="bold"><?php echo $notif->num_rows()?> pemberitahuan </span>baru</h3>
	<a href="extra_profile.html">lihat semua</a>
</li>
<li>
	<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
        <?php 
        foreach($notif->result_array() as $n){?>
        <li>
			<a href="#" onclick="onClickNotification('<?php echo $n['Id_Notif']?>','<?php echo $n['Target_Link']?>')">
			<span class="time"><?php echo fbdate($n['Created_Date'])?></span>
			<span class="details">
			<span class="label label-sm label-icon label-success">
			<i class="fa fa-plus"></i>
			</span>
			<?php echo $n['Message']?></span>
			</a>
		</li>            
        <?php }?>
	</ul>
</li>
<li class="external">
	<a href="#" onclick="markAllAsRead()">Mark all as read</a>
</li>
<script>
    function onClickNotification(id,target){
        $.post( "<?php echo base_url(); ?>index.php/server/app_service/markAsReadNotif",{id:id}).done(function() {
            window.location.href = target;
          });
    }
    function markAllAsRead(){
        $.post( "<?php echo base_url(); ?>index.php/server/app_service/markAllAsReadNotif").done(function() {
            getNumUnreadNotif();
          });
    }
</script>