<script src="<?php echo base_url()?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('.scroller').each(function () {
            var height;
            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }
            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                size: '7px',
                color: ($(this).attr("data-handle-color")  ? $(this).attr("data-handle-color") : '#bbb'),
                railColor: ($(this).attr("data-rail-color")  ? $(this).attr("data-rail-color") : '#eaeaea'),
                position: 'right',
                height: height,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });
        });
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which:event.keyCode
        if(charCode >31 && (charCode<48 || charCode>57)) return false; return true;
    };
    function isDoubleNumberKey(evt){
        var charCode = (evt.which) ? evt.which:event.keyCode
        if((charCode>=48 && charCode<=57) || charCode==46) return true; return false;
    };
    function replaceAll(string, find, replace) {
      return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
    }
    function escapeRegExp(string) {
        return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
    }
    function setChangeActive_<?php echo $page_id;?>(id){
        var string="id="+id;
        $.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/changeAktif",
			data	: string,
			cache	: false,
			success	: function(data){
				toastr['success']("Perubahan aktif/non-aktif tersimpan", "<?php echo $page_info['Nama_Menu']?>");
                reloadTable();
			},
			error : function(xhr, teksStatus, kesalahan) {
                toastr['error']("Perubahan aktif/non-aktif gagal", "<?php echo $page_info['Nama_Menu']?>");
				return false;
			}
		});
    }
    function deleteRecord_<?php echo $page_id;?>(id,text){
        bootbox.confirm("Anda yakin ingin menghapus <?php echo $page_info['Nama_Menu']?> "+text+" ?", function(result) {
            if(result){
                var string="id="+id;
                $.ajax({
        			type	: 'POST',
        			url		: "<?php echo base_url(); ?>index.php/<?php echo $page_id;?>/hapus",
        			data	: string,
        			cache	: false,
        			success	: function(data){
        				toastr['success']("<?php echo $page_info['Nama_Menu']?> berhasil dihapus", "<?php echo $page_info['Nama_Menu']?>")
                        reloadTable();
        			},
        			error : function(xhr, teksStatus, kesalahan) {
        				toastr['error']("<?php echo $page_info['Nama_Menu']?> tidak berhasil dihapus", "<?php echo $page_info['Nama_Menu']?>")
        				return false;
        			}
        		});  
            }
        });
    }
    function reloadTable(){
        if ( $( "#data_<?php echo $page_id;?>" ).length ) {
            var table = $('#data_<?php echo $page_id;?>').DataTable().ajax.reload();
        }
    }
    
    function doExportExcel_<?php echo $page_id;?>(){
        var colCount = -1;
        $('#data_<?php echo $page_id;?> tr:nth-child(1) th').each(function () {
            if ($(this).attr('colspan')) {
                colCount += +$(this).attr('colspan');
            } else {
                colCount++;
            }
        });
        var tableContent = document.getElementById("data_<?php echo $page_id;?>").innerHTML;
        document.getElementById("temp_data_<?php echo $page_id;?>").innerHTML=tableContent;
        $("#temp_data_<?php echo $page_id;?> tfoot").remove();
        $("#temp_data_<?php echo $page_id;?> tr").find('td:eq('+colCount+'),th:eq('+colCount+')').remove();
        $("table#temp_data_<?php echo $page_id;?> div.bootstrap-switch-on" ).replaceWith( "YES" );
        $("table#temp_data_<?php echo $page_id;?> div.bootstrap-switch-off" ).replaceWith( "NO" );
        tableToExcel('temp_data_<?php echo $page_id;?>','PMB_<?php echo $page_id;?>');
        
        toastr['success']("Ekspor Excel berhasil !", "<?php echo $page_info['Nama_Menu']?>");
    }
    /* EXPORT EXCELL */
    var tableToExcel = (function() {
      var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
      }
    })()
</script>