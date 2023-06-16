<div class="note note-info">
	<p>
        <strong>Info !</strong><br />
        <?php if($jenis==1){
            $idTable='my_tabel';
            echo 'Usulan jalur penerimaan adalah jalur penerimaan yang diusulkan oleh pendaftar sebelum ditentukan oleh operator.';
        }else{
            $idTable='my_tabel_beri';
            echo 'Pemberian jalur penerimaan adalah jalur penerimaan yang ditentukan oleh operator untuk masing-masing pendaftar.';
        }
        ?>
	</p>
</div>
<table class="table" id="<?php echo $idTable?>">
    <tr>
        <th>No</th>
        <th>Jalur Penerimaan</th>
        <th>Jumlah</th>
    </tr>
    <?php 
    if($data->num_rows()>0){
        $tot=0;
        foreach($data->result_array() as $i=>$d){
        $tot+=$d['N'];
        ?>
        <tr class="clickable detail-table" onclick="detailMhs('<?php echo $idTable?>','<?php echo $d['Id_JalurPenerimaan']?>')">
            <td><?php echo($i+1)?></td>
            <td><?php echo $d['Nama_JalurPenerimaan']?></td>
            <td><?php echo $d['N']?></td>
        </tr>        
    <?php } ?>
    <tr>
        <th colspan="2">Total</th>
        <th><?php echo $tot;?></th>
    </tr>  
    <?php }else{?>
        <tr>
            <td colspan="3" style="text-align: center;">Tidak ada data</td>
        </tr>
    <?php }?>
</table>
<script>
function detailMhs(jenis,id){
    var tipe=$("#filtr_tipe").val();
    if(tipe.length>0 && !jQuery.isEmptyObject(dateStart) && !jQuery.isEmptyObject(dateEnd)){
        Metronic.startPageLoading({animate: true});
        $.post( "<?php echo base_url();?>index.php/<?php echo $page_id?>/detailMhs",
        {tipe:tipe,start:dateStart.format('YYYY-MM-DD'),end:dateEnd.format('YYYY-MM-DD'),
        jenis:jenis,id:id}, function( data ) {
            $("#modal-mhs-content").html(data);
           $("#<?php echo $page_id;?>ModalMhs").modal('show');
           Metronic.stopPageLoading();
        });    
    }
}
</script>