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
            <?php echo form_open('search', array('method'=>'get', 'class'=>'searchform')); ?>
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
                    <a class="social-list" href="https://www.youtube.com/channel/UCEMaY1KP0A0AWWCN8xr8GIA" target="_blank"><i class="fa fa-youtube"></i></a>
                    <a class="social-list" href="https://instagram.com/bpjt_info" target="_blank"><i class="fa fa-instagram"></i></a>
                    
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

        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeLwgcdhLlp66B2ci7gr4LeLGkX83lgkI1YWgcvvb89rdPMiQ/viewform?usp=sf_link/viewform?embedded=true" width="100%" height="1630" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
        </div> <!-- /#collapse-profil -->

        <hr class="border-primary">

    </div> <!-- /#content -->
