<div class="input-group">
    <ul class="list-group" id="listgroup-pilprodi" style="margin-bottom: 0px;">
        <?php foreach($opts->result_array() as $i=>$r){?>
            <li class="list-group-item" data-id="<?php echo $r['id']?>">
                <?php echo ($i+1).'. '.$r['caption']?>
        	</li>
        <?php }?>
    </ul>
</div>