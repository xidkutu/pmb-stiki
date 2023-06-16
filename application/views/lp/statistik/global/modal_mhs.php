<div id="<?php echo $page_id;?>ModalMhs" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="<?php echo $page_id;?>ModalDetailTitle">Detail Mahasiswa</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <a href="#" class="btn btn-circle default pull-right export-excel-detail">
				                <i class="fa fa-file-excel-o"></i> Export Excel
				            </a>
                        </div>
                    </div>
					<div class="row" id="modal-mhs-content">
                        <table class="table table-striped table-hover" style="margin-left: 20px; margin-right: 20px;">
                        
                        </table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(".export-excel-detail").click(function(){
        var idtable=$("#modal-mhs-content > table").attr('id');
        tableToExcel(idtable,idtable);
    })
</script>
