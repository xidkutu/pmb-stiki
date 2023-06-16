<table class="table" id="my_tabel_kota">
    <tr>
        <th>No</th>
        <th>Kota</th>
        <th>Provinsi</th>
        <th>Jumlah</th>
    </tr>
    <?php 
    if($data->num_rows()>0){
        $tot=0;
        foreach($data->result_array() as $i=>$d){
        $tot+=$d['N'];
        ?>
        <tr class="clickable detail-table" onclick="detailMhs('kota','<?php echo $d['Kode_Kota']?>')">
            <td><?php echo($i+1)?></td>
            <td><?php echo $d['Kota']?></td>
            <td><?php echo $d['Nama_Prop']?></td>
            <td><?php echo $d['N']?></td>
        </tr>        
    <?php } ?>  
      <tr>
        <th colspan="3">Total</th>
        <th><?php echo $tot;?></th>
    </tr>
    <?php }else{?>
        <tr>
            <td colspan="3" style="text-align: center;">Tidak ada data</td>
        </tr>
    <?php }?>
</table>