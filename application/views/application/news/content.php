<link href="<?php echo base_url()?>/assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<!-- END PLUGINS USED BY X-EDITABLE -->
<div class="row">
	<div class="col-md-12">
		<!-- Begin: life time stats -->
		<div class="portlet light">
			<div class="portlet-body">
                <div class="row">
					<div class="col-md-12 news-page">
						<h1 style="margin-top:0">Berita Terbaru</h1>
						<div class="row">
							<div class="col-md-5">
								<div id="myCarousel" class="carousel image-carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<img src="<?php echo base_url()?>assets/admin/pages/media/gallery/image5.jpg" class="img-responsive" alt="">
											<div class="carousel-caption">
												<h4>
												<a href="page_news_item.html">
												First Thumbnail label </a>
												</h4>
												<p>
													 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
												</p>
											</div>
										</div>
										<div class="item">
											<img src="<?php echo base_url()?>assets/admin/pages/media/gallery/image2.jpg" class="img-responsive" alt="">
											<div class="carousel-caption">
												<h4>
												<a href="page_news_item.html">
												Second Thumbnail label </a>
												</h4>
												<p>
													 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
												</p>
											</div>
										</div>
										<div class="item">
											<img src="<?php echo base_url()?>assets/admin/pages/media/gallery/image1.jpg" class="img-responsive" alt="">
											<div class="carousel-caption">
												<h4>
												<a href="page_news_item.html">
												Third Thumbnail label </a>
												</h4>
												<p>
													 Cras justo odio, dapibus ac facilisis in, egestas eget quam.
												</p>
											</div>
										</div>
									</div>
									<!-- Carousel nav -->
									<a class="carousel-control left" href="#myCarousel" data-slide="prev">
									<i class="m-icon-big-swapleft m-icon-white"></i>
									</a>
									<a class="carousel-control right" href="#myCarousel" data-slide="next">
									<i class="m-icon-big-swapright m-icon-white"></i>
									</a>
									<ol class="carousel-indicators">
										<li data-target="#myCarousel" data-slide-to="0" class="active">
										</li>
										<li data-target="#myCarousel" data-slide-to="1">
										</li>
										<li data-target="#myCarousel" data-slide-to="2">
										</li>
									</ol>
								</div>
                                <?php
                                    $num=($data->num_rows()+1);
                                    $perCol=floor($num/3);
                                    $mod=$num % 3;
                                    switch($mod){
                                        case 0:
                                            $firRow=$perCol-1;
                                            $secRow=$firRow+$perCol;   
                                            break;
                                        case 1:
                                            $firRow=$perCol;
                                            $secRow=$firRow+$perCol;
                                            break;
                                        case 2:
                                            $firRow=$perCol;
                                            $secRow=$firRow+$perCol+1;
                                            break;
                                    };
                                    foreach($data->result() as $i=>$d){?>
                                <div class="news-blocks">
									<h3>
									<a href="<?php echo base_url()?>index.php/news/read/<?php echo $d->Kode_Pengumuman?>"><?php echo $d->Judul_Pengumuman ?></a>
									</h3>
									<div class="news-block-tags">
										<strong><?php echo $this->config->item('nama_program').', '.$this->config->item('nama_instansi')?></strong>
										<em><?php echo fbdateTask($d->Publish_Time)?></em>
									</div>
									<p>
										<?php echo $d->Teaser?>
									</p>
									<a href="<?php echo base_url()?>index.php/news/read/<?php echo $d->Kode_Pengumuman?>" class="news-block-btn">
									Read more <i class="m-icon-swapright m-icon-black"></i>
									</a>
								</div>  
                                <?php
                                if(($i+1)==$firRow) echo '</div><div class="col-md-4">';
                                if(($i+1)==$secRow) echo '</div><div class="col-md-3">';
                                }?>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
<script type="text/javascript">

</script>
<?php echo $js_global_method?>
