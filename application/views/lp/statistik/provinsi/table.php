<table class="table" id="my_tabel">
    <tr>
        <th>No</th>
        <th>Provinsi</th>
        <th>Jumlah</th>
    </tr>
    <?php 
    if($data->num_rows()>0){
        $tot=0;
        foreach($data->result_array() as $i=>$d){
        $tot+=$d['N'];
        ?>
        <tr class="clickable detail-table" onclick="detailMhs('Prov','<?php echo $d['Kode_Prop']?>')">
            <td><?php echo($i+1)?></td>
            <td><?php echo $d['Nama_Prop']?></td>
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