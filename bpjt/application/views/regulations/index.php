<!-- Slider -->
<div id="slider-profil" class="container-fluid">
	<div class="row">
		<img src="<?php echo base_url(); ?>assets/images/v2/peraturan.jpg" alt="Slide 1" class="img-responsive">
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
                    <a class="social-list" target="_blank" href="https://twitter.com/bpjt_info"><i class="fa fa-twitter"></i></a>
                    <a class="social-list" href="https://www.facebook.com/BPJTInfo/" target="_blank"><i class="fa fa-facebook"></i></a>
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
    
	<div class="panel-group" id="accordionProfil" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingProfil">
				<h4 class="panel-title">
                <a class="main-title" role="button" data-toggle="collapse" data-parent="#accordionProfil" href="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil"><?php echo lang('peraturan'); ?></a>
                </h4>
			</div>
			<div id="collapseProfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseProfil">
				<div class="panel-body">
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "") ? "class='active'" : ""; ?> title="<?php echo lang('semua-peraturan'); ?>" href="<?php echo site_url('peraturan'); ?>"><?php echo lang('semua-peraturan'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "undang-undang") ? "class='active'" : ""; ?> title="<?php echo lang('undang-undang'); ?>" href="<?php echo site_url('peraturan/undang-undang'); ?>"><?php echo lang('undang-undang'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "peraturan-pemerintah") ? "class='active'" : ""; ?> title="<?php echo lang('peraturan-pemerintah'); ?>" href="<?php echo site_url('peraturan/peraturan-pemerintah'); ?>"><?php echo lang('peraturan-pemerintah'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "peraturan-presiden") ? "class='active'" : ""; ?> title="<?php echo lang('peraturan-presiden'); ?>" href="<?php echo site_url('peraturan/peraturan-presiden'); ?>"><?php echo lang('peraturan-presiden'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "peraturan-menteri") ? "class='active'" : ""; ?> title="<?php echo lang('peraturan-menteri'); ?>" href="<?php echo site_url('peraturan/peraturan-menteri'); ?>"><?php echo lang('peraturan-menteri'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "keputusan-menteri") ? "class='active'" : ""; ?> title="<?php echo lang('keputusan-menteri'); ?>" href="<?php echo site_url('peraturan/keputusan-menteri'); ?>"><?php echo lang('keputusan-menteri'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "keputusan-kepala-bpjt") ? "class='active'" : ""; ?> title="<?php echo lang('keputusan-kepala-bpjt'); ?>" href="<?php echo site_url('peraturan/keputusan-kepala-bpjt'); ?>"><?php echo lang('keputusan-kepala-bpjt'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "keputusan-gubernur") ? "class='active'" : ""; ?> title="<?php echo lang('keputusan-gubernur'); ?>" href="<?php echo site_url('peraturan/keputusan-gubernur'); ?>"><?php echo lang('keputusan-gubernur'); ?></a>
								</h4>
							</div>
						</div>
					</div>
					<div class="panel-group subpanel" id="accordion11" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading11">
								<h4 class="panel-title">
								<a <?php echo ($content_type == "lainnya") ? "class='active'" : ""; ?> title="<?php echo lang('lainnya'); ?>" href="<?php echo site_url('peraturan/lainnya'); ?>"><?php echo lang('lainnya'); ?></a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    
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
                <h4 class="title"><?php echo lang('peraturan'); ?></h4>
                <hr class="divider"><br/>
					<?php echo form_open(site_url('peraturan'), array('method'=>'get', 'class'=>'searchform')); ?>
						<div class="form-group">
							<!--label class="cari"><?php echo lang('cari'); ?></label-->
							<input class="s form-control" type="text" name="filename" value="<?php echo (isset($_GET['filename']) && $_GET['filename'] != '') ? clean_str($_GET['filename']) : ''; ?>" placeholder="Cari Peraturan...">
						</div>
                <div class="body">
				<?php if (empty($content_type)) { ?>
					<div class="form-group">
					  <label class="semua"><?php echo lang('kategori'); ?></label>    
						  <select id="selectList" name="doctype" class="form-control">
							<!-- <option selected="selected" value=""> </option> -->
							<option value="all"><?php echo lang('semua'); ?></option>
							<option value="undang-undang" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'undang-undang') ? "selected" : ""; ?>>Undang-Undang</option>
							<option value="peraturan-pemerintah" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'peraturan-pemerintah') ? "selected" : ""; ?>>Peraturan Pemerintah</option>
							<option value="peraturan-presiden" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'peraturan-presiden') ? "selected" : ""; ?>>Peraturan Presiden</option>
							<option value="peraturan-menteri" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'peraturan-menteri') ? "selected" : ""; ?>>Peraturan Menteri</option>
							<option value="keputusan-menteri" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'keputusan-menteri') ? "selected" : ""; ?>>Keputusan Menteri</option>
							<option value="keputusan-kepala-bpjt" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'keputusan-kepala-bpjt') ? "selected" : ""; ?>>Keputusan Kepala BPJT</option>
							<option value="keputusan-gubernur" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'keputusan-gubernur') ? "selected" : ""; ?>>Keputusan Gubernur</option>
							<option value="lainnya" <?php echo (isset($_GET['doctype']) && $_GET['doctype'] == 'lainnya') ? "selected" : ""; ?>>Lainnya</option>
						  </select>
					</div>
					<?php } ?>
					<div class="right-side two columns">
						<button class="apply btn-primary" type="submit"><?php echo lang('terapkan'); ?></button>
					</div>
					<?php echo form_close(); ?>
					
					<h3 class="lead"><?php echo lang('ditemukan'); ?> : <strong>"<?php echo $count_regulations; ?>"</strong> <?php echo lang('dokumen'); ?> <div class="halaman"> <?php echo lang('halaman'); ?> <?php echo $page; ?> <?php echo lang('dari'); ?> <?php echo $total_page; ?>  </div></h3>
					
					<?php foreach($regulations as $regulation) { ?>
            
                    <div class="galeri-foto col-sm-12">
                        
                        <div class="col-sm-9">
							<span class="label label-primary"><?php echo $this->types[$regulation->sub_content_type]; ?></span>
                            <h5><a href="<?php echo site_url('peraturan/dokumen/' . $regulation->slug); ?>"><?php echo $regulation->title; ?></a></h5>
                            <p><?php echo $regulation->caption; ?> </p>
							<hr>
						</div>
                    </div>
					<?php } ?> 
                <nav>
					<ul class="pagination">
						<?php for($i=1; $i<=$total_page; $i++) { ?>
							<li><a href="?page=<?php echo $i . $query_vars; ?>" <?php echo ($i==$page) ? "class='active'" : ""; ?>><?php echo $i; ?></a></li>
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
