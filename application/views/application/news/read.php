<div class="row">
	<div class="col-md-12">
        <div class="portlet light" style="margin-right: 20px;">
        	<div class="portlet-body">
        		<div class="row">
        			<div class="col-md-12 news-page blog-page">
        				<div class="row">
        					<div class="col-md-12 blog-tag-data">
        						<h3 style="margin-top:0"><?php echo $data['Judul_Pengumuman']?></h3>
        						<div class="row">
        							<div class="col-md-6">
        								<ul class="list-inline blog-tags">
        									<li>
        										<i class="fa fa-tags"></i>
        										<a href="#">
        										PMB </a>
        									</li>
        								</ul>
        							</div>
        							<div class="col-md-6 blog-tag-data-inner">
        								<ul class="list-inline">
        									<li>
        										<i class="fa fa-calendar"></i>
        										<a href="#">
        										<?php echo $data['Publish_Time']?> </a>
        									</li>
        								</ul>
        							</div>
        						</div>
        						<div class="news-item-page">
        							<?php echo $data['Keterangan']?>
        						</div>
        						<hr/>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>