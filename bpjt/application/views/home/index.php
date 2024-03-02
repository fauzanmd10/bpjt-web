
        <!-- Slider -->
        <div id="slider" class="container-fluid">
            <div class="row">
                <div class="col-sm-7 col-sm-push-5 no-gutter">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
					
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner " role="listbox">
                            <?php foreach($galleries2 as $gallery2) { ?>
							 <div class="item active" data-bg="">
                                    <a href="#"><img src="<?php echo $this->media->get_image_by_style($gallery2->url, 'pn820'); ?>" class="img-responsive" alt="<?php echo $gallery2->title; ?>"  onerror="this.src='/assets/images/no-image.jpg'"></a>
                                </div>
                             <?php
								} 
							  ?> 
							<?php  
								foreach($galleries3 as $gallery3) {
							 ?>
							 <div class="item " data-bg="">
                                    <a href="#"><img src="<?php echo $this->media->get_image_by_style($gallery3->url, 'pn820'); ?>" class="img-responsive" alt="<?php echo $gallery3->title; ?>"  onerror="this.src='/assets/images/no-image.jpg'"></a>
                                </div>
                             <?php 
								} 
							  ?> 							  
                        </div>
                    </div> <!-- /.carousel -->
                </div>
                <div id="bendera" class="col-sm-5 col-sm-pull-7 no-gutter">
                    <div id="slider_captions">
					<?php 
								$item = 0; 
								foreach($db_medias as $gallery) {
							 ?>
                        <div>
                            <div id="caption-<?php echo $item; ?>" class="carousel-caption">
							<h1 class="link font-12"><?php echo $gallery->title; ?></h1>
							</div>
                                                            
                        </div>
						<?php 
							  $item++;
							} 
						  ?>

                        <div class="hidden-xs"><!-- Controls -->
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <i class="fa fa-caret-left fa-2x"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <i class="fa fa-caret-right fa-2x"></i>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
						
                    </div>
                </div>
				

            </div> <!-- /.row -->
        </div> <!-- /#slider -->

        <!-- Kilas Berita -->
<div id="kilas-berita" class="container-fluid announcement-area">
        <marquee class="hidden-md hidden-lg" style=" padding-top: 10px; padding-bottom: 10px; color: #fff;">
			<?php if (!empty($newstickers)) { ?>
			<?php foreach($newstickers as $newsticker) { 
						$text=$newsticker->content;
						?>
				<?php echo strip_tags($text,'<a>'); ?>
			<?php } ?>
				<?php } else { ?>
				Selamat Datang di Website Badan Pengatur Jalan Tol (BPJT)
			<?php } ?>
		</marquee>
    <div class="row box hidden-sm hidden-xs">
        <div class="col-sm-12">


            <p class="headline"><?php echo lang('pengumuman'); ?>&nbsp;(<?php echo count($newstickers); ?>)&nbsp;&nbsp;</p>
            <div id="carousel-pengumuman" class="carousel slide" data-ride="carousel" data-interval="6000">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
					<?php if (!empty($newstickers2)) { ?>
					<?php foreach($newstickers2 as $newsticker2) { 
						$text=$newsticker2->content;
						?>
						<div class="item active">
							<?php echo print_casual_date($newsticker2->created_at); ?>&nbsp;-&nbsp;<?php echo strip_tags($text,'<a>'); ?>
						</div>
					<?php } ?>
					<?php } else { ?>
						<div class="item active">
							Selamat Datang di Website Badan Pengatur Jalan Tol (BPJT)
						</div>
					<?php } ?>
					
					<?php if (!empty($newstickers3)) { ?>
					<?php foreach($newstickers3 as $newsticker3) { 
						$text=$newsticker3->content;
						?>
						<div class="item">
							<?php echo print_casual_date($newsticker3->created_at); ?>&nbsp;-&nbsp;<?php echo strip_tags($text,'<a>'); ?>
						</div>
					<?php } ?>
					<?php } else { ?>
						<div class="item">
							Selamat Datang di Website Badan Pengatur Jalan Tol (BPJT)
						</div>
					<?php } ?>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-pengumuman" role="button" style="margin-left: 5px" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-pengumuman" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div id="triangle-right" class="hidden"></div>
        </div>
    </div> <!-- /.row -->
</div> <!-- /#kilas-berita -->

        <!-- Search -->
<div id="search" class="container-fluid hidden-xs">
    <div class="row box">
        <div class="col-sm-12">
            <?php echo form_open('cari', array('method'=>'get', 'class'=>'searchform')); ?>
                <div class="col-xs-12 col-sm-2 col-md-1 col-mobile">
                    <p class="searchtext"><?php echo lang('cari2'); ?></p>
                </div>
                <div name="form-group" class="col-xs-12 col-sm-5 col-md-6 no-padding-right col-mobile">
                    <input class="s form-control searchbox2" required="required" name="keyword" placeholder="Masukan kata kunci...">
                </div>
                <div class="col-xs-4 col-sm-2 col-md-1 col-mobile">
                    <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i> <?php echo lang('cari'); ?></button>
                </div>
                
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter social-links col-mobile">
                    <a class="social-list" target="_blank" href="https://twitter.com/pupr_bpjt"><i class="fa fa-twitter"></i></a>
                    <a class="social-list" href="https://www.facebook.com/puprbpjt" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="social-list" href="https://www.youtube.com/c/PUPRBPJT" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a class="social-list" href="https://www.instagram.com/pupr_bpjt/" target="_blank"><i class="fa fa-instagram"></i></a>
                    
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter saran col-mobile">
                    <a href="https://pengaduan.pu.go.id/" class=""><i class="fa fa-podcast fa-2x"></i> <?php echo lang('saran-pengaduan'); ?></a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div> <!-- /.row -->
</div> <!-- /#search -->

<style>
    .fa-twitter {
        background: #55acee;
        
    }
    
    .fa-facebook {
        background: #3b5999;
    }
    
    .fa-youtube {
        background: #cd201f;   
    }
    
    .fa-instagram {
        background: #e4405f;
    }
    
    .social-list i {
        color: #fff;
        border-radius: 20px;
        width: 35px;
        height: 35px;
        font-size: 20px;
        text-align: center;
        margin-right: 10px;
        padding-top: 15%;
    }

    .searchbox2 {
        outline: none;
        box-shadow: none !important;
        border-radius: 0;
    }
	.image-popup {
		cursor: -webkit-zoom-in;
		cursor: -moz-zoom-in;
		cursor: zoom-in;
	}
	.photography-entry {
		height: 60px;
		min-width: 110px;
		display: block;
		z-index: 0;
		position: relative;
		margin-bottom: 10px;
		margin-left: -10px;
	}
	.align-items-end {
		-webkit-box-align: end !important;
		-ms-flex-align: end !important;
		align-items: flex-end !important;
	}

	.justify-content-start {
		-webkit-box-pack: start !important;
		-ms-flex-pack: start !important;
		justify-content: flex-start !important;
	}
	.d-flex {
		display: -webkit-box !important;
		display: -ms-flexbox !important;
		display: flex !important;
	}
	.photography-entry .text {
		opacity: 0;
		-moz-transition: all 0.3s ease;
		-o-transition: all 0.3s ease;
		-webkit-transition: all 0.3s ease;
		-ms-transition: all 0.3s ease;
		transition: all 0.3s ease;
	}

	.ml-4, .mx-4 {
		margin-left: 2.0rem !important;
	}
	.mb-4, .my-4 {
		margin-bottom: 1.5rem !important;
	}
	.photography-entry:hover .overlay, .photography-entry:focus .overlay {
		opacity: .7;
	}

	.photography-entry .overlay {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: -1;
		background: #000000;
		opacity: 0;
		-moz-transition: all 0.3s ease;
		-o-transition: all 0.3s ease;
		-webkit-transition: all 0.3s ease;
		-ms-transition: all 0.3s ease;
		transition: all 0.3s ease;
	}
	.photography-entry .text h3 {
		color: #fff;
		font-size: 20px;
	}
	.photography-entry .text span.tag {
       font-size: 12px;
	   margin: auto;
       color: rgba(255, 255, 255, 0.8);
	   text-align: center;
	   }
	.photography-entry:hover .overlay, .photography-entry:focus .overlay {
		opacity: .7; }
	.photography-entry:hover .text, .photography-entry:focus .text {
		opacity: 1; }

	.video-panel {
		background-color: #45678d;
		color: #fff;
		height: 40px;
		padding: 8px 15px;
		margin-bottom: 10px;
	}
	.video-panel a{
		color: #f6f6f6;
	}
	
	/* Modal Content (Image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 100%;
	  max-width: 1000px;
	}
	.modal-body {
		position: relative;
		padding: 0;
	}

	/* Caption of Modal Image (Image Text) - Same Width as the Image */
	#caption {
	  display: block;
	  width: 100%;
	  max-width: 1000px;
	  text-align: center;
	  padding: -10px 0;
	  height: auto;
	  color: #bfbebe;
	}
	#judul {
	  margin: auto;
	  display: block;
	  width: 100%;
	  max-width: 1000px;
	  text-align: center;
	  color: #000;
	  padding: 10px 0;
	  height: auto;
	}
	
	.panel {
		margin-bottom: 20px;
		background-color: #fff;
		border: 1px solid transparent;
		border-radius: 4px;
		-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
		box-shadow: 0 1px 1px rgba(0,0,0,.05);
	}
	.panel-heading {
		background-color: #45678d !important;
		border-left: 10px solid #fba026 !important;
		color: #fff !important;
	}
	.panel-body {
		padding: 15px;
	}
	.panel-body p {
		margin-right: 15px;
		margin-left: 15px;
	}
	.pnlKiri {
		padding: 0PX;
		border: solid 3PX #ffc800;
		background-color: rgba(255, 255, 255, 0);
	}
    
    #search .social-list {
        margin-left: 5px;
    }
	@media (min-width: 992px) {
         .icon-fr {
            width: 100%;
			margin: 3px 1px;
        }
		.icon-lpse {
			width: 91%;
			margin: 3px 1px;
		}
		.height-infografis {
			height: 280px;
		}
		img.infografis-img {
			width: 100% !important;
		}
		gal-4 {
			width: 30%;
			margin: 5 0;
		}
		.links {
			width: 30%;
			margin: 3px 2 px;
		}
    }
    @media (max-width: 768px) {
		#artikel-mobile-img {
			margin-top: 20px;
			margin-right:auto;
			margin-left:20px;
		}
        .icon-fr {
			width: 100%;
			margin: 3px 0 3px -20px;
        }
		.icon-lpse {
			width: 92%;
			margin: 3px 1px;
		}
		.photography-entry {
			height: 60px;
			max-width: 10px;
			display: block;
			z-index: 0;
			position: relative;
			margin-bottom: 10px;
			margin-left: -15px;
			padding: 0 10px;
		}
		.links {
			width: 40%;
			margin: 3px 1 px;
		}
    }
    </style>
    <script type="text/javascript">
        $('form[name="form_search"]').on('submit', function() {
            if ($('input[name="searchbox"]').val() == '') {
                $('div[name="form-group"]').addClass('has-error');
            }
            else {
                this.submit();
            }
            return false;
        });
    </script>
        <!-- Content -->
        <div id="content" class="container-fluid">

            <!-- Video & Artikel -->
            <div id="video-artikel" class="row" >
            
			<div id="artikel-mobile" class="col-xs-12 hidden-sm hidden-md hidden-lg center-block" style="margin-top: 20px;">
                    <div class="panel">
					<div class="panel-heading">
                    <?php echo lang('berita-terkini'); ?><span class="pull-right subtitle" ><a href="berita" style="color: #fff; "><?php echo lang('index-berita'); ?>    <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></span>
					</div>
					<div class="panel-body">
						<div class="row">
							<?php foreach($headlines as $headline) { ?>
							<div class="col-xs-12 no-gutter artikel-mobile-box">
								<div class="col-xs-3 no-gutter">
									<img src="<?php echo $this->media->get_image_by_style($headline->image, 'pn640'); ?>" onerror="this.src='/assets/images/no-image.jpg'" class="img-responsive" alt="Artikel Thumb">
								</div>
								<div class="col-xs-9 no-gutter">
									<p class="date"><?php echo print_casual_date($headline->created_at); ?></p>
									<p class="title"><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><?php echo $headline->title; ?></a></p>
								</div>
							</div>
							<hr class="artikel-mobile-divider">
							<?php } ?>
						</div>
					</div>
					<!--center><a href="<?php echo site_url('berita'); ?>" target="_blank" style="background-color: #45678d;color: #fff; padding: 5px 10px;"><?php echo lang('index-berita'); ?>  <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></center-->
				</div>
			</div>
			

                <!-- Artikel -->
                <div id="artikel" class="hidden-xs col-sm-12 col-md-8 video-artikel-box" style="padding: 0px;">
                  <div class="panel-heading" style="margin-bottom:10px;">
								<?php echo lang('berita-terkini'); ?> <span class="pull-right subtitle" ><a style="color:#fff;" href="<?php echo site_url('berita'); ?>"><?php echo lang('index-berita'); ?>   <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></span>
				</div> 
                    
                    <div class="clearfix"></div>
                    <div class="col-sm-12 col-md-6">
					<?php foreach($headlines2 as $headline2) { ?>
                        <img src="<?php echo $this->media->get_image_by_style($headline2->image, 'pn640'); ?>" onerror="this.src='/assets/images/no-image.jpg'" class="img-responsive artikel-img center-block" alt="Artikel">
					<?php } ?> 
                        <hr class="divider">

                        <div id="carousel-artikel" class="carousel slide" data-ride="carousel" data-interval="false">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
								<?php foreach($headlines3 as $headline3) { ?>
									<img src="<?php echo $this->media->get_image_by_style($headline3->image, 'pn640'); ?>" onerror="this.src='/assets/images/no-image.jpg'" data-id='<?php echo $headline3->id; ?>' style="width: 100px; height: 80px;" class="img-responsive thumb active" alt="Artikel Thumb">   
								<?php } ?> 
								</div>
                                <div class="item">
                                    <?php foreach($headlines4 as $headline4) { ?>
									<img src="<?php echo $this->media->get_image_by_style($headline4->image, 'pn640'); ?>" onerror="this.src='/assets/images/no-image.jpg'" data-id='<?php echo $headline4->id; ?>' style="width: 100px; height: 80px;" class="img-responsive thumb active" alt="Artikel Thumb">   
								<?php } ?> 
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-artikel" role="button" data-slide="prev">
                                <i class="fa fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-artikel" role="button" data-slide="next">
                                <i class="fa fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 artikel-body">
                        <?php foreach($headlines2 as $headline2) { ?>
						<div id="news-content">
                            <a  href="<?php echo site_url('berita/' . $headline2->slug); ?>"><h4 class="title default-color-r"><?php echo $headline2->title; ?></h4></a>
                            <p class="date"><i class="fa fa-clock-o"></i>&nbsp;<?php echo print_casual_date($headline2->created_at); ?></p>
                            <p class="content"><p style="text-align: justify; text-justify: inter-word;"><?php echo $headline2->excerpt; ?></p>
                            <a class="text-primary default-color-r" href="<?php echo site_url('berita/' . $headline2->slug); ?>"><?php echo lang('selengkapnya'); ?>..</a>
                        </div>
						<?php } ?>
                    </div>

                    <div style="display: none;">
							<?php
							  foreach($headlines3 as $headline3) { ?>
							<div id="news-content-<?php echo $headline3->id; ?>">

                                <a href="<?php echo site_url('berita/' . $headline3->slug); ?>"><h4 class="title default-color-r"><?php echo $headline3->title; ?></h4></a>
                                <p class="date"><i class="fa fa-clock-o"></i>&nbsp;<?php echo print_casual_date($headline3->created_at); ?></p>
                                <p class="content"><p style="text-align: justify; text-justify: inter-word;"><?php echo $headline3->excerpt; ?></p>
                                <a class="text-primary default-color-r" href="<?php echo site_url('berita/' . $headline3->slug); ?>">Selengkapnya..</a>
                            </div>
							<?php }?>
							<?php
							  foreach($headlines4 as $headline4) { ?>
							<div id="news-content-<?php echo $headline4->id; ?>">

                                <a href="<?php echo site_url('berita/' . $headline4->slug); ?>"><h4 class="title default-color-r"><?php echo $headline4->title; ?></h4></a>
                                <p class="date"><i class="fa fa-clock-o"></i><?php echo print_casual_date($headline4->created_at); ?></p>
                                <p class="content"><p style="text-align: justify; text-justify: inter-word;"><?php echo $headline4->excerpt; ?></p>
                                <a class="text-primary default-color-r" href="<?php echo site_url('berita/' . $headline4->slug); ?>">Selengkapnya..</a>
                            </div>
							<?php }?>
                    </div>
                </div> <!-- /#artikel -->

				<div id="artikel-mobile-img" class="col-xs-12 col-md-4">
					<!--a href="<?php echo site_url('berita'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-index-berita'); ?>" alt="" title="<?php echo lang('index-berita'); ?>" class="icon-fr"/></a-->
						<a href="http://gis.bpjt.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-gis'); ?>" alt="" title="<?php echo lang('gis-bpjt'); ?>" class="icon-fr"/></a>
						<a href="<?php echo site_url('spm'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-spm'); ?>" alt="" title="<?php echo lang('standar-pelayanan-minimal'); ?>" class="icon-fr"/></a>
						<!--a href="#modal" data-toggle="modal" data-target="#Modal"><img src="<?php echo base_url(); ?><?php echo lang('gambar-peluang-investasi'); ?>" alt="" title="<?php echo lang('peluang-investasi'); ?>" class="icon-fr"/></a-->
						<!--a href="<?php echo site_url('konten/bujt'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-bujt'); ?>" alt="" title="<?php echo lang('bujt-long'); ?>" class="icon-fr"/></a-->
						<a href="<?php echo site_url('cek-tarif-tol'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarif'); ?>" alt="" title="<?php echo lang('cek-tarif-tol'); ?>" class="icon-fr"/></a>
						<a href="tarif" target="_blank"  class="blink-image"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarifmap'); ?>" alt="" title="<?php echo lang('cek-tarif-tolmap'); ?>" class="icon-fr"/></a>
						<a href="kuesioner" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-kuesioner'); ?>" alt="" title="<?php echo lang('kuesioner'); ?>" class="icon-fr"/></a>
						<!--a href="https://lpse.pu.go.id/eproc4/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/lpse.png" alt="" title="LPSE" class="icon-fr"/></a-->
						<a href="https://bpjt.pu.go.id/minigame/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/ayo-parkir-id.png" alt="Ayo Parkir!" title="Ayo Parkir!" class="icon-fr"/></a>
						<!--a href="http://binamarga.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/icon-bm.jpg" alt="" title="Bina Marga" class="icon-fr"/></a-->
						<!--a href="https://sip3rumijatol.binamarga.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/icon-sip3rumijatol.jpg" alt="" title="SIP3 Rumija Tol" class="icon-fr"/></a-->
					</div>
				

            </div> <!-- /#video-artikel -->
			
			<!-- /#row atas -->
			<div id="video-artikel" class="row">
				<div id="info-umum" class="col-sm-4 collapsible-box">
				<div class="panel">
					<div class="panel-heading">
						<?php echo lang('berita-lainnya'); ?> <span class="pull-right subtitle" ><a style="color:#fff;" href="https://twitter.com/pupr_bpjt" target="_blank"><?php echo lang('selengkapnya'); ?>   <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></span>
					</div>
					<div class="panel-body" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
						<div class="row" style="width:80%; margin:0 20px;">
								<a class="twitter-timeline" href="https://twitter.com/pupr_bpjt?ref_src=twsrc%5Etfw">Tweets by pupr_bpjt</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						</div>
					</div>
				</div>
				</div>
				
				<div id="info-umum" class="col-sm-4 collapsible-box">
				<div class="panel" style="margin-bottom:5px;">
					<div class="panel-heading">
						<?php echo lang('info-video'); ?> 
					</div>
				</div>
					<div class="embed-responsive embed-responsive-16by9">		
						<iframe class="embed-responsive-item youtube-video" src="https://www.youtube.com/embed/v5OulQulBqg" frameborder="0" allowfullscreen=""></iframe>
					</div>
					<div class="video-panel">
                        <a href="https://www.youtube.com/c/PUPRBPJT" target="_blank"><?php echo lang('indeks-video'); ?></a> <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span>
                    </div>
				</div>
				
				<div id="info-umum" class="col-sm-4 collapsible-box">
						<div class="panel">
							<div class="panel-heading">
								<?php echo lang('glossary'); ?>
							</div>
							<div class="panel-body">
								<div class="row">
									
										<?php $syarat_ketentuan = $this->content->get_content_by_paths_and_lang('syarat-ketentuan', '', $this->session->userdata('lang')); ?>
											<?php if (empty($syarat_ketentuan)) { ?>
											Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
											<?php } else { ?>
											<p style="font-size: 14px; text-align: justify; text-justify: inter-word;">
											<?php echo ($syarat_ketentuan[0]->content); ?>
											</p>
										<?php } ?>
								
																	
								</div>
							</div>
						</div>
				</div>
				
			</div>
			
			<!-- /#row bawah -->
			<div id="video-artikel" class="row">
				<div id="info-umum" class="col-sm-4 collapsible-box">
				
			<!-- Buku Tahunan  -->	
				<div id="artikel-mobile-img" style="margin-bottom:20px;">
					
						<a href="https://bit.ly/BukuAnnualReportBPJT2021" target="_blank"  class="blink-image"><img src="<?php echo base_url(); ?>templates/frontend/img/buku-tahunan-link-2021.webp" alt="Buku BPJT 2021" title="Buku BPJT 2021" class="icon-fr"/></a>
					
				</div>
			<!-- End of Buku Tahunan  -->	
				
				<div class="panel">
							<div class="panel-heading">
								<?php echo lang('galeri-foto'); ?> <span class="pull-right subtitle" ><a style="color:#fff;" href="<?php echo site_url('galeri-foto'); ?>"><?php echo lang('selengkapnya'); ?>   <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></span>
							</div>
							<div class="panel-body">
								<div class="row">
								<div class="photograhy">
								<?php foreach($galleries as $galeri) { ?>
									<div class="col-xs-4 col-md-4 ftco-animate fadeInUp ftco-animated">
										<a href="#" class="photography-entry img d-flex justify-content-start align-items-end" style="background-image: url(<?php echo $this->media->get_image_by_style($galeri->url, 'fx185');?>); background-size: 100%; background-repeat: no-repeat;"  data-toggle="modal" data-target="#<?php echo $galeri->id;?>"  onerror="this.src='/assets/images/no-image.jpg'" >
											<div class="overlay"></div>
											<div class="text ml-4 mb-4">
												<span class="tag"><?php echo $galeri->album_name;?></span>
											</div>
										</a>
									</div>
									
									<div id="<?php echo $galeri->id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  
									  <div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<img src="<?php echo $galeri->url;?>" class="img-responsive">
											</div>
											<div id="judul"><?php echo $galeri->title;?> </div>
										</div>
									  </div>
									</div>
								<?php } ?>
								</div>
								</div>
							</div>
				</div>
				
				
				</div>
				
				
				<div id="profil-berita" class="col-sm-12 col-md-4 collapsible-box hidden-xs">
					<div class="panel-heading"><?php echo lang('infografis'); ?><span class="pull-right subtitle" ><a style="color:#fff;" href="<?php echo site_url('galeri-foto'); ?>"><?php echo lang('selengkapnya'); ?>  <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true" style="color:#fba026;"></span></a></span></div>
					
					<div class="panel-body">
							<div id="carousel-example-generic3" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
								<li data-target="#carousel-example-generic3" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-generic3" data-slide-to="1" class=""></li>
								<li data-target="#carousel-example-generic3" data-slide-to="2" class=""></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
								<?php foreach($infografis1 as $info) { ?>

								<div class="item active col-sm-12 col-md-12">
								  <img style="width:100%;" src="<?php echo $this->media->get_image_by_style($info->url, 'pn820'); ?>" alt="<?php echo $info->title; ?>" class="infografis-img" onerror="this.src='/assets/images/no-image.jpg'" >

								  <!-- <div class="carousel-caption">
									Caption Slide 2
								  </div> -->
								</div> 
								<?php } ?>
								<?php foreach($infografis2 as $info2) { ?>
								<div class="item">
								  <img style="width:100%;" src="<?php echo $this->media->get_image_by_style($info2->url, 'pn820'); ?>" alt="<?php echo $info2->title; ?>" class="infografis-img" onerror="this.src='/assets/images/no-image.jpg'" >

								  <!-- <div class="carousel-caption">
									Caption Slide 2
								  </div> -->
								</div>
								<?php } ?>
							  </div>

							  <!-- Controls -->
							  <a class="left carousel-control" href="#carousel-example-generic3" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							  </a>
							  
							  <a class="right carousel-control" href="#carousel-example-generic3" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							  </a>
							</div>
					</div>
						
				</div>
				
				<div id="info-umum" class="col-sm-4 collapsible-box">
				
				<!-- Download BPJT Info -->	
				<div id="artikel-mobile-img" style="margin-bottom:20px;">
					
						<a href="#modal" data-toggle="modal" data-target="#Modal-unduh"><img src="<?php echo base_url(); ?>templates/frontend/img/link-download-bpjt-info.webp" alt="Download BPJT Info" title="Download BPJT Info" class="icon-fr"/></a>
					
				</div>
			<!-- End of Download BPJT Info  -->
				
						<div class="panel">
							<div class="panel-heading">
								<?php echo lang('informasi-umum'); ?>
							</div>
							<div class="panel-body">
								<div class="row" style="margin-left:10px;margin-bottom:10px;">
									
										<a href="https://jdih.pu.go.id/" target="_blank"><img src="/assets/images/link-umum/jdih.png" style="margin:2px 2px 10px 2px" class="links" alt="JDIH" title="Jaringan Dokumentasi dan Informasi Hukum"  onerror="this.src='/assets/images/no-image.jpg'" /></a>
										<a href="/konten/informasi-publik/zona-integritas" target="_blank"><img src="/assets/images/link-umum/stop-gratifikasi.png" style="margin:2px 2px 10px 2px" class="links" alt="Stop Gratifikasi" title="Stop Gratifikasi" onerror="this.src='/assets/images/no-image.jpg'" /></a>
										<a href="https://wispu.pu.go.id/" target="_blank"><img src="/assets/images/link-umum/wisp-logo.png" style="margin:2px 2px 10px 2px" class="links" alt="Whistleblowing System Kementerian PUPR" title="Whistleblowing System Kementerian PUPR" onerror="this.src='/assets/images/no-image.jpg'" /></a>
										<a href="https://www.lapor.go.id/" target="_blank"><img src="/assets/images/link-umum/lapor.png" style="margin:2px 2px 10px 2px" class="links" alt="Lapor" title="Layanan Aspirasi dan Pengaduan Online Rakyat" onerror="this.src='/assets/images/no-image.jpg'" /></a>							
										<!--a href="https://pengaduan.pu.go.id/" target="_blank"><img src="/bpjt/assets/images/link-umum/saran-dan-pengaduan.png" style="margin:2px 2px 10px 2px" class="links" alt="Saran dan Pengaduan" title="Saran dan Pengaduan" onerror="this.src='/assets/images/no-image.jpg'" /></a-->
										<a href="https://lpse.pu.go.id/eproc4/" target="_blank"><img src="/assets/images/link-umum/lpse.png" style="margin:2px 2px 10px 2px" class="links" alt="LPSE PUPR" title="LPSE PUPR" onerror="this.src='/assets/images/no-image.jpg'" /></a>
										<a href="https://eppid.pu.go.id/" target="_blank"><img src="/assets/images/link-umum/e-ppid.png" style="margin:2px 2px 10px 2px" class="links" alt="e-PPID PUPR" title="e-PPID PUPR" onerror="this.src='/assets/images/no-image.jpg'" /></a>							
										<a href="https://sippn.menpan.go.id/" target="_blank"><img src="/assets/images/link-umum/sipp-parnb.png" style="margin:2px 2px 10px 2px" class="links" alt="Sistem Informasi Pelayanan Publik Nasional" title="Sistem Informasi Pelayanan Publik Nasional" onerror="this.src='/assets/images/no-image.jpg'" /></a>							
										<a href="https://sip3rumijatol.binamarga.pu.go.id/" target="_blank"><img src="/assets/images/link-umum/sip3rumijatol.png" style="margin:2px 2px 10px 2px" class="links" alt="SIP3Rumija Tol" title="Sistem Informasi Pelayanan Perizinan Pemanfaatan Rumija Tol" onerror="this.src='/assets/images/no-image.jpg'" /></a>
										
								</div>
							</div>
						</div>
				</div>
				
				</div>
			</div>
			
			<!-- Modal -->
			<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content media">
				  <div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel"><?php echo (empty($documents)) ? '#' : $documents[0]->title; ?></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body media-left media-middle"">
					<img class="media-object" src="<?php echo base_url(); ?>assets/images/icons/pel-inv.jpg" alt="" style="padding:10px" />
				  </div>
				  <div class="media-body">	
					<p><?php echo (empty($documents)) ? '#' : $documents[0]->caption; ?></p>
				  </div>
				  <div class="modal-footer">
				  <a  href="<?php echo base_url(); ?>uploads/investment/<?php echo $documents[0]->id; ?>/<?php echo $documents[0]->filename; ?>" target="_blank"><button type="button" class="btn btn-secondary">Download</button></a>
					
				  </div>
				</div>
			  </div>
			</div>
			
			<!-- Modal Unduh BPJT Info -->
			<div class="modal fade" id="Modal-unduh" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content media">
				  <div class="modal-header">
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body media-left media-middle"">
					<img src="<?php echo base_url(); ?>templates/frontend/img/icon-bpjt-info.webp" alt="" style="padding:10px; max-width:150px"/>
				  </div>
				  <div class="media-body">	
				    <h3 class="modal-title" id="exampleModalLabel">BPJT Info Tol</h3>
					<p>Aplikasi <b>BPJT Info Tol</b> merupakan aplikasi yanng berfungsi sebagai wadah, yang memudahkan pengguna jalan tol dalam mencari informasi-informasi terkait jalan tol melalui mobile apps</p>
					<p>Aplikasi ini tersedia dalam versi Android dan IOS, silakan klik tautan dibawah ini untuk mengunduh sesuai dengan sistem operasi di perangkat mobile yang Anda gunakan</p>
						<a href="https://apps.apple.com/id/app/bpjt-info/id1552154927?l=id" target="_blank"><img src="<?php echo base_url(); ?>templates/frontend/img/icon-app-store.webp" alt="BPJT Info Tol versi IOS" title="BPJT Info Tol versi IOS" style="width:35%;"/></a>
						<a href="https://play.google.com/store/apps/details?id=id.go.pu.bpjt.info" target="_blank"><img src="<?php echo base_url(); ?>templates/frontend/img/icon-play-store.webp" alt="BPJT Info Tol versi Android" title="BPJT Info Tol versi Android" style="width:35%;"/></a>
				  <br/>
				  </div>
				  <div class="modal-footer">
				  </div>
				  </div>
				</div>
			  </div>
			</div>
			<!-- Modal Unduh BPJT Info -->

            <style type="text/css">
    @media (min-width: 992px) {
        .title-height-r {
            height: 50px;
            font-weight: 600 !important;
            font-size: 12px !important;
        }
    }
    @media (max-width: 768px) {
        .title-height-r {
            height: 50px;
            font-weight: 500 !important;
            font-size: 11px !important;
        }
    }
</style>
<!-- Berita Slider -->
<!--div id="berita-slider" class="row">
    <div class="col-sm-12">
	<center><h4><span class="title" style="color: rgba(13,45,108, 0.7);font-weight: 700;margin-bottom: 10px; padding-top: 10px;"><?php echo lang('situs-terkait'); ?></span></h4></center>
    
        <!-- Slider --
        <div class="row" style="padding: 2% 0;">
				<div class="container">
                <section class="customer-logos slider">  
				<?php if (empty($sites)) { ?>
					  <div class = 'item' id = '1'>
						  <div class="freshwork-img-box"><a href="http://www.pu.go.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/logo-pu.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '2'>
						  <div class="freshwork-img-box"><a href="http://www.jasamarga.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jasamarga.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '3'>
						  <div class="freshwork-img-box"><a href="http://www.jlj.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jlj.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '4'>
						  <div class="freshwork-img-box"><a href="http://www.transmargajateng.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/tmj.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '5'>
						  <div class="freshwork-img-box"><a href="http://id.citramarga.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/citramarga.png" alt="" /></a></div>
					  </div>
					   <div class = 'item' id = '6'>
						  <div class="freshwork-img-box"><a href="http://www.nusantarainfrastructure.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/nusantara.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '7'>
						  <div class="freshwork-img-box"><a href="http://www.jasa-sarana.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jasasarana.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '8'>
						  <div class="freshwork-img-box"><a href="http://www.mtn.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/mtn.png" alt="" /></a></div>
					  </div>
					  <div class = 'item' id = '9'>
						  <div class="freshwork-img-box"><a href="http://www.mtdcap.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/mtd.png" alt="" /></a></div>
					  </div> 
              <?php } else { ?>
			  <?php foreach($sites as $site) { ?>
			  <?php $logo = $this->content->get_content_meta($site->id, 'logo');?>	
			  <?php if (!empty($logo)) { ?>	
				
				<div class="slide" style="width:50%;"><a href="<?php echo $site->content; ?>" target="_blank"><img src="<?php echo $logo[0]->meta_value; ?>" onerror="this.src='/assets/images/no-image.jpg'" width="58px"/></a></div>
                
			   <?php } ?>
               <?php } ?>
               <?php } ?>
                </section>                                               
                </div>
                                
                
               
            </div>
			
         
</div-->
</div>
