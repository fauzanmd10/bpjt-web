
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
				Selamat Datang di Website Badan Pengatur Jalan Tol
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
							Selamat Datang di Website Badan Pengatur Jalan Tol
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
							Selamat Datang di Website Badan Pengatur Jalan Tol
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
	.panel-news {
		background-color: #fff;
		border: 1px solid transparent;
		padding: 10px;
		border-radius: 15px;
		margin: 0 5px 10px;
	}
	.panel-doc {
		background-color: #fff;
		border: 1px solid transparent;
		border-radius: 4px;
		padding: 10px;
		border-radius: 15px;
		margin: 0 5px 10px;
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
        border-radius: 15px;
    }
	.judul {
		margin-top: 10px;
		font-size:16px;
		font-weight: bold;
	}
	.tanggal {
		font-size: 12px;
		color: #bfbebe;
	}
	.isi {
		text-align: left;
	}
    
    #search .social-list {
        margin-left: 5px;
    }
	
	@media (min-width: 992px) {
        .icon-fr {
            width: 45%;
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
			width: 30%;
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

        <!-- Profil & Artikel-->
        <div id="profil-artikel" class="row">
            

            <!-- Artikel -->
            <!-- Artikel -->
            <div class="col-md-12">
                <div class="alert alert-success col-sm-12" style="margin-left:5px; width:93%;" role="alert">
				<h4 class="title"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
				<?php echo lang('hasil-pencarian'); ?>
				<strong>"<?php echo clean_str($_GET['keyword']); ?>"</strong> &nbsp;<?php echo lang('ditemukan'); ?> <?php echo lang('dalam')?> <strong>"<?php echo $found_articles; ?>"</strong> <?php echo lang('berita'); ?>
                dan <strong>"<?php echo $count_regulations; ?>"</strong> <?php echo lang('dokumen'); ?> </h4>
				</div>
				<div class="body">
				<div class="panel-news col-sm-6">
				<?php foreach($articles as $article) { ?>
                    <div class="galeri-foto col-sm-12">
                            <p class="judul"><a href="<?php echo site_url('berita/' . $article->slug); ?>"><?php echo $article->title; ?></a></hp>
                            <p class="tanggal"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <?php echo print_casual_date($article->created_at); ?></p>
                            <!--p class="description"><?php echo $article->excerpt; ?> ... </p-->
                    
                    </div>
                <?php } ?> 
					<div class="halaman"> <?php echo lang('halaman'); ?> <?php echo $page; ?> <?php echo lang('dari'); ?> <?php echo $total_page; ?>  <?php echo lang('halaman-berita'); ?></div>				
                <nav>
					<ul class="pagination">
						<?php for($i=1; $i<=$total_page; $i++) { ?>
						<li><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='active'" : ""; ?>><?php echo $i; ?></a></li>
						<?php } ?>
					</ul>
				</nav> 
				</div>
				<div class="panel-doc col-sm-5">
				<div class="galeri-foto col-sm-12">
				<?php if (empty($content_type)) { ?>	
				<?php } ?>
					<?php foreach($regulations as $regulation) { ?>
            
                            <h5><a href="<?php echo site_url('peraturan/dokumen/' . $regulation->slug); ?>"><?php echo $regulation->title; ?></a></h5>
                            <p class="tanggal"><span class="label label-primary"><?php echo $regulation->sub_content_type; ?></span> <?php echo $formatted_text = str_replace(['<p>', '</p>'], '', $regulation->caption); ?> </p>
							<hr>
					<?php } ?> 
					
					<div class="halaman"> <?php echo lang('halaman'); ?> <?php echo $doc; ?> <?php echo lang('dari'); ?> <?php echo $total_doc; ?>  <?php echo lang('halaman-doc'); ?></div>
				<nav>
					<ul class="pagination">
						<?php for($i=1; $i<=$total_doc; $i++) { ?>
							<li><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='active'" : ""; ?>><?php echo $i; ?></a></li>
						<?php } ?>
					</ul>
				</nav>
				</div></div>
                </div>
            </div> <!-- /#artikel -->
        </div> <!-- /#collapse-profil -->

        <hr class="border-primary">

    </div> <!-- /#content -->
