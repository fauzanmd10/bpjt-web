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
    <div id="profil-berita" class="col-sm-12 col-md-4 collapsible-box hidden-xs">
        
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
           
</div> <!-- /#profil -->

            <!-- Artikel -->
            <div id="artikel" class="col-sm-12 col-md-8">
                <h4 class="title"><?php echo lang('index-berita'); ?></h4>
                <hr class="divider">

                <div class="body">
				<?php foreach($articles as $article) { ?>
                    <div class="galeri-foto col-sm-12">
                        <div class="col-sm-3">
                            <img src="<?php echo (isset($article->image_name)) ? $this->media->get_image_by_style($article->image_name, 'pn640') : base_url() . "/assets/images/no-image.jpg"; ?>" alt="<?php echo $article->title; ?>" onerror="this.src='/assets/images/no-image.jpg'" class="img-responsive galeri-img">
                        </div>
                        <div class="col-sm-9">
                            <p class="galeri-meta"><?php echo print_casual_date($article->created_at); ?></p>
                            <h5 class="galeri-heading"><a href="<?php echo site_url('berita/' . $article->slug); ?>"><?php echo $article->title; ?></a></h5>
                            <p class="description"><?php echo $article->excerpt; ?> ... </p>
                        </div>
                    </div>
                <?php } ?>   
                <nav>
					<ul class="pagination">
					<?php for($i=1; $i<=$total_page; $i++) { ?>
						<li <?php echo ($i==$page) ? "class='active'" : ""; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						</li>
					<?php } ?>
					</ul>
				</nav>                                      
                </div>
            </div> <!-- /#artikel -->
        </div> <!-- /#collapse-profil -->

        <hr class="border-primary">

    </div> <!-- /#content -->

        <hr class="border-primary">

    </div> <!-- /#content -->
