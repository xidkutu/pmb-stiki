<table class="table" style="margin-left: 20px; margin-right: 20px;" id="detail-table-mhs">
    <tr>
        <th>No</th>
        <th>No. Tes</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telp</th>
    </tr>
    <?php 
        if($data->num_rows()>0){
            foreach($data->result_array() as $i=>$r){?>
            <tr>
                <td><?php echo ($i+1)?></td>
                <td><?php echo ($r['No_Ujian'])?></td>
                <td><?php echo ($r['nama'])?></td>
                <td><?php echo ($r['email'])?></td>
                <td><?php echo ($r['telp'])?></td>
            </tr>                            
    <?php }
        }else{ ?>
        <tr><td colspan="5" style="text-align: center;">Tidak ada data</td></tr>        
    <?php }
    ?>
</table>