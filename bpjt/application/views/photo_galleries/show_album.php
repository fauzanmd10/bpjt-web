<!-- Slider -->
<div id="slider-profil" class="container-fluid">
	<div class="row">
		<img src="<?php echo base_url(); ?>assets/images/garis.jpg" alt="Slide 1" class="img-responsive">
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
							<?php echo strip_tags($text,'<a>'); ?>
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
							<?php echo strip_tags($text,'<a>'); ?>
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
                    <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i> Cari</button>
                </div>
                
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter social-links col-mobile">
                    <a class="social-list" target="_blank" href="https://twitter.com/pupr_bpjt"><i class="fa fa-twitter"></i></a>
                    <a class="social-list" href="https://www.facebook.com/puprbpjt" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="social-list" href="https://www.youtube.com/c/PUPRBPJT" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a class="social-list" href="https://www.instagram.com/pupr_bpjt/" target="_blank"><i class="fa fa-instagram"></i></a>
                    
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter saran col-mobile">
                    <a href="https://pengaduan.pu.go.id" class=""><i class="fa fa-podcast fa-2x"></i> SARAN & PENGADUAN</a>
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
    
    #search .social-list {
        margin-left: 5px;
    }
	
	@media (min-width: 992px) {
        .icon-fr {
            width: 100%;
			margin: 3px 1px;
        }
    }
    @media (max-width: 768px) {
		.artikel-mobile {
			display:block;
			margin-right:auto;
			margin-left:auto
		}
        .icon-fr {
			width: 100%;
			margin: 3px 1px;
        }
    }
	#artikel .body .content .bxslider img {
    padding: 2%;
    max-height: 560px;
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

        <!-- Profil & Artikel-->
        <div id="profil-artikel" class="row">
            <!-- Accordion Profil -->
            <div id="profil-berita" class="col-sm-12 col-md-4 collapsible-box hidden-xs">

				<!-- Accordion Galeri Foto -->
				<div class="panel-group" id="accordionBerita" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingBerita">
							<h4 class="panel-title">
								<p>
									<a href="<?php echo site_url('galeri-foto'); ?>"><span class="pull-left">&lt;&nbsp;<?php echo lang('galeri-foto'); ?></span></a>
								   
								</p>
							</h4>
						</div>
						
					</div> <!--- /.panel -->
				</div> <!-- /#accordionGaleri -->
				
				<!-- Accordion Berita Terpopuler -->
				<div class="panel-group" id="accordionBerita" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingBerita">
							<h4 class="panel-title">
								<p>
									<span class="pull-left"><?php echo lang('berita-terpopuler'); ?></span>
								   
								</p>
							</h4>
						</div>
						<div id="collapseBerita" role="tabpanel" aria-labelledby="collapseBerita">
							<div class="panel-body">
							<?php foreach($popular_articles as $popular_article) { ?>
								
								<!-- Accordion Capaian -->
								<div class="panel-group subpanel" id="accordionCapaian">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingCapaian">
											<h4 class="panel-title">
												<a style="text-transform:capitalize" href="<?php echo site_url('berita/' . $popular_article->slug); ?>">
												<?php echo $popular_article->title; ?></a>
											</h4>
										</div>
									</div>
								</div> <!-- /#accordionCapaian -->
								
							<?php } ?>
							</div> <!-- /.panel-body -->
						</div> <!-- /#collapseInfoUmum -->
					</div> <!--- /.panel -->
				</div> <!-- /#accordionBerita -->

				<div class="panel-group" id="accordionProfil" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div id="collapseProfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseProfil">
							<a href="http://gis.bpjt.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-gis'); ?>" alt="" title="<?php echo lang('gis-bpjt'); ?>" class="icon-fr"/></a>
							<a href="<?php echo site_url('spm'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-spm'); ?>" alt="" title="<?php echo lang('standar-pelayanan-minimal'); ?>" class="icon-fr"/></a>
							<!--a href="#modal" data-toggle="modal" data-target="#Modal"><img src="<?php echo base_url(); ?><?php echo lang('gambar-peluang-investasi'); ?>" alt="" title="<?php echo lang('peluang-investasi'); ?>" class="icon-fr"/></a>
							<!--a href="<?php echo site_url('konten/bujt'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-bujt'); ?>" alt="" title="<?php echo lang('bujt-long'); ?>" class="icon-fr"/></a-->
							<a href="<?php echo site_url('cek-tarif-tol'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarif'); ?>" alt="" title="<?php echo lang('cek-tarif-tol'); ?>" class="icon-fr"/></a>
							<a href="tarif" target="_blank" class="blink-image"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarifmap'); ?>" alt="" title="<?php echo lang('cek-tarif-tolmap'); ?>" class="icon-fr"/></a>
							<a href="https://bpjt.pu.go.id/minigame/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/ayo-parkir-id.png" alt="Ayo Parkir!" title="Ayo Parkir!" class="icon-fr"/></a>
						<!--a href="kuesioner" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-kuesioner'); ?>" alt="" title="<?php echo lang('kuesioner'); ?>" class="icon-fr"/></a-->
						</div>
					</div>
				</div>
	</div> <!-- /#profil -->

            <!-- Artikel -->
            <div id="artikel" class="col-sm-12 col-md-8">
                <h4 class="title"><?php echo lang('galeri-foto'); ?></h4>
                <hr class="divider">

                <div class="body">
                    <div class="image"></div>
					<div class="content">
					<div class="bx-wrapper">
					<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; max-height: 720px;">
                        <ul class="bxslider">
						<?php 
						foreach($carousels as $carousel) { ?>
							<li><center>
							<img class="img-height" src="<?php echo $this->media->get_image_by_style($carousel->url, 'pn820'); ?>"/></center>
							<div class="bx-caption"><span>
							<?php echo $carousel->title; ?>
							</span></div>
							</li>
						<?php } ?>  
						</ul>
					<div id="bx-pager">
					<?php $item = 0; 
					foreach($carousels as $carousel) { ?>
                        <a data-slide-index="<?php echo $item; ?>" href=""><img style="max-width: 100px" src="<?php echo $this->media->get_image_by_style($carousel->url, 'pn820'); ?>" class="col-md-4"/></a>
                    <?php $item++;} ?>  
					</div>
					
                    </div></div>
					</div>
                </div>



            </div> <!-- /#artikel -->
        </div> <!-- /#collapse-profil -->

        <hr class="border-primary">

    </div> <!-- /#content -->
