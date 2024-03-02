<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a276345d0d09bcb"></script>

<!-- Slider -->
<div id="slider-profil" class="container-fluid">
	<div class="row">
		<img src="<?php echo base_url(); ?>assets/images/Berita.jpg" alt="Slide 1" class="img-responsive">
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
                    <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i> Cari</button>
                </div>
                
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter social-links col-mobile">
                    <a class="social-list" target="_blank" href="https://twitter.com/pupr_bpjt"><i class="fa fa-twitter"></i></a>
                    <a class="social-list" href="https://www.facebook.com/puprbpjt" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="social-list" href="https://www.youtube.com/c/PUPRBPJT" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a class="social-list" href="https://www.instagram.com/pupr_bpjt/" target="_blank"><i class="fa fa-instagram"></i></a>
                      
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 no-gutter saran col-mobile">
                    <a href="http://www3.pu.go.id/saran/penjelasan" class=""><i class="fa fa-podcast fa-2x"></i> SARAN & PENGADUAN</a>
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
	.rata p{
		text-align: justify;
		text-justify: inter-word;
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
			width: 92%;
			margin: 3px 1px;
        }
    }
	#artikel .body .content .bxslider img {
    padding: 2%;
    max-height: 560px;
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
		<div id="index-berita" class="col-sm-12 col-md-4 collapsible-box hidden-xs">
			<div class="panel-group" id="accordionProfil" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingProfil">
						<h4 class="panel-title">
							<a class="main-title" role="button" data-toggle="collapse" data-parent="#accordionProfil" href="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil"><?php echo lang('index-berita'); ?></a>
						</h4>
					</div>
					<div id="collapseProfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseProfil">
						<div class="panel-body">
						<?php foreach($headlines as $headline) { ?>
							<div class="panel-group subpanel" id="accordion0" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="heading0">
										<h4 class="panel-title">
											<a class="collapsed" href="<?php echo site_url('berita/' . $headline->slug); ?>">
											<?php echo $headline->title; ?></a>
										</h4>
									</div>
								</div>
							</div>
						<?php } ?>	
							
						</div> <!-- /.panel-body -->
					</div> <!-- /#collapseProfil -->
				</div> <!--- /.panel -->
			</div> <!-- /#accordion -->

    
<!-- Accordion Berita Terkini -->
<div class="panel-group" id="accordionBerita">
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
                <!-- Accordion Capaian -->
				<?php foreach($popular_articles as $popular_article) { ?>
                <div class="panel-group subpanel" id="accordionCapaian">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingCapaian">
                            <h4 class="panel-title">
								<a style="text-transform:capitalize" href="<?php echo site_url('berita/' . $popular_article->slug); ?>">
                                <?php echo $popular_article->title; ?>                                </a>
                            </h4>
                        </div>
                    </div>
                </div> <!-- /#accordionCapaian -->
                <?php } ?>

            </div> <!-- /.panel-body -->
        </div> <!-- /#collapseInfoUmum -->
    </div> <!--- /.panel -->
</div> <!-- /#accordionBerita -->

<!-- Accordion Berita Terkait -->
<div class="panel-group" id="accordionBerita">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingBerita">
            <h4 class="panel-title">
                <p>
                    <span class="pull-left"><?php echo lang('berita-terkait'); ?>&nbsp;[<?php echo $article->category_name; ?> / <?php echo $article->sub_category_name; ?>]</span>
                   
                </p>
            </h4>
        </div>
        <div id="collapseBerita" role="tabpanel" aria-labelledby="collapseBerita">
            <div class="panel-body">                
                <!-- Accordion Capaian -->
				<?php foreach($related_articles as $related_article) { ?>
				<div class="panel-group subpanel" id="accordionCapaian">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingCapaian">
                            <h4 class="panel-title">
								<a style="text-transform:capitalize" href="<?php echo site_url('berita/' . $related_article->slug); ?>">
                                <?php echo $related_article->title; ?></a>
                            </h4>
                        </div>
                    </div>
                </div> <!-- /#accordionCapaian -->
                <?php } ?>

            </div> <!-- /.panel-body -->
        </div> <!-- /#collapseInfoUmum -->
		
		
		
    </div> <!--- /.panel -->
</div> <!-- /#accordionBeritaTerkait -->
<div class="panel-group" id="accordionProfil" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div id="collapseProfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseProfil">
							<!--a href="<?php echo site_url('berita'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-index-berita'); ?>" alt="" title="<?php echo lang('index-berita'); ?>" class="icon-fr"/></a-->
							<a href="http://gis.bpjt.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-gis'); ?>" alt="" title="<?php echo lang('gis-bpjt'); ?>" class="icon-fr"/></a>
							<a href="<?php echo site_url('spm'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-spm'); ?>" alt="" title="<?php echo lang('standar-pelayanan-minimal'); ?>" class="icon-fr"/></a>
							<!--a href="#modal" data-toggle="modal" data-target="#Modal"><img src="<?php echo base_url(); ?><?php echo lang('gambar-peluang-investasi'); ?>" alt="" title="<?php echo lang('peluang-investasi'); ?>" class="icon-fr"/></a>
							<!--a href="<?php echo site_url('konten/bujt'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-bujt'); ?>" alt="" title="<?php echo lang('bujt-long'); ?>" class="icon-fr"/></a-->
							<a href="<?php echo site_url('cek-tarif-tol'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarif'); ?>" alt="" title="<?php echo lang('cek-tarif-tol'); ?>" class="icon-fr"/></a>
							<a href="/tarif" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarifmap'); ?>" alt="" title="<?php echo lang('cek-tarif-tolmap'); ?>" class="icon-fr"/></a>
							<!--a href="http://binamarga.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/icon-bm.jpg" alt="" title="Bina Marga" class="icon-fr"/></a-->
							</div>
					</div>
				</div>
           
</div> <!-- /#profil -->

<!-- Artikel -->
<div id="artikel" class="col-sm-12 col-md-8">

<ul class="breadcrumb" style="padding-left: 0px; background-color:#fff;">
	<li><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a> <span class="separator"></span></li>
	<li><a href="<?php echo site_url('berita'); ?>"><?php echo lang('berita'); ?></a> <span class="separator"></span></li>
	<li></li>
</ul>

    <h4 class="title"><?php echo $article->title; ?></h4>
    <hr class="divider">
                    
		<p class="date">
			<span class="pull-left"><i class="fa fa-clock-o"></i><?php echo print_casual_date($article->created_at); ?> | <i class="glyphicon glyphicon-folder-open"></i> &nbsp;  <?php echo $article->category_name; ?>/<?php echo $article->sub_category_name; ?>&nbsp;  | <i class="glyphicon glyphicon-eye-open"></i>&nbsp;  <?php echo $article->viewed; ?></span>
		</p>
                
		<div class="body">
			<div class="image">
				<img src="<?php echo $this->media->get_image_by_style($article->image_name, 'pn640'); ?>" onerror="this.src='/bpjt_ci3/assets/images/no-image.jpg'" class="img-responsive" alt="<?php echo $article->title; ?>" title="<?php echo $article->title; ?>" style="width:100%;">
				<i style="font-size:10px;position:relative;top:-15px"><?php echo lang('foto'); ?> : <?php echo $article->title; ?></i>
				

			</div>


        <div class="content rata">
        <p><?php echo $article->content; ?></p>
		</div>
		
        </div>
			<p> SHARE: <div class="addthis_inline_share_toolbox"></div></p>
		


</div> <!-- /#collapse-profil -->
	
</div>

        <hr class="border-primary">

</div> <!-- /#content -->

