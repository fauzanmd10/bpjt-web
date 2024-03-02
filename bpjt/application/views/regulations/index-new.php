	
	<!-- Page Title
		============================================= -->
		<section id="page-title">
			<?php $lang = $this->session->userdata('lang'); ?>
			<div class="container clearfix">
				<h1><?php echo $titles; ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo lang('peraturan'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo $titles; ?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->


				<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
					<div class="postcontent col-lg-9">
						<div class="fancy-title title-border">
							<h3><?php echo $titles; ?></h3>
						</div>

						<?php echo form_open(site_url('peraturan'), array('method'=>'get', 'class'=>'searchform')); ?>
						<div class="form-group">
							<!--label class="cari"><?php echo lang('cari'); ?></label-->
							<input class="s form-control" type="text" name="filename" value="<?php echo (isset($_GET['filename']) && $_GET['filename'] != '') ? clean_str($_GET['filename']) : ''; ?>" placeholder="Cari Peraturan...">
						</div>

						<div class="row">
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
									<button  type="submit" class="button button-rounded button-reveal button-large button-red text-end"><i class="icon-line-search"></i><?php echo lang('terapkan'); ?></button>
								</div>
								<?php echo form_close(); ?>
								
								<div class="style-msg infomsg">
									<div class="sb-msg"><i class="icon-info-sign"></i><strong><?php echo lang('ditemukan'); ?>  <?php echo $count_regulations; ?> </strong> <?php echo lang('dokumen'); ?>,  <?php echo lang('halaman'); ?> <?php echo $page; ?> <?php echo lang('dari'); ?> <?php echo $total_page; ?></div>
								</div>
								<div class="widget clearfix"></div>
								<?php foreach($regulations as $regulation) { ?>
						
									<div class="feature-box fbox-effect">
										<div class="fbox-icon mb-4">
											<i class="icon-book3 i-alt"></i>
										</div>
										<div class="fbox-content">
											<h3><?php echo $regulation->title; ?></h3><span class="badge bg-warning rounded-pill"><?php echo $this->types[$regulation->sub_content_type]; ?></span>
											<p><?php echo $regulation->caption; ?></p><a href="<?php echo site_url('peraturan/dokumen/' . $regulation->slug); ?>" class="button button-rounded button-reveal button-small button-red text-end"><i class="icon-download"></i><span><?php echo lang('unduh'); ?></span></a>
									
										</div>
									</div>
									

									<div class="divider"></div>
								<?php } ?> 
							<!-- Pager
							============================================= -->
							<div class="d-flex justify-content-between">
								<div class="row gutter-40 col-mb-80">
									<ul class="pagination pagination-rounded pagination-inside-transparent pagination-button pagination-sm">
									<?php for($i=1; $i<=$total_page; $i++) { ?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?page=<?php echo $i . $query_vars; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
									<?php } ?>
									</ul>
								</div>
							</div>
							<!-- .pager end --> 
						</div>
					</div> <!-- End-of-postponed
		============================================= -->
					<div class="sidebar col-lg-3"> <!-- Sidebar -->
							<div class="sidebar-widgets-wrap">

								<div class="widget clearfix">
									<div class="list-group">
										<a <?php echo ($content_type == "") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('semua-peraturan'); ?>" href="<?php echo site_url('peraturan'); ?>"  class="list-group-item list-group-item-action"  ><?php echo lang('semua-peraturan'); ?></a>
										<a <?php echo ($content_type == "undang-undang") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('undang-undang'); ?>" href="<?php echo site_url('peraturan/undang-undang'); ?>" class="list-group-item list-group-item-action"   ><?php echo lang('undang-undang'); ?></a>
										<a <?php echo ($content_type == "peraturan-pemerintah") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('peraturan-pemerintah'); ?>" href="<?php echo site_url('peraturan/peraturan-pemerintah'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('peraturan-pemerintah'); ?></a>
										<a <?php echo ($content_type == "peraturan-presiden") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('peraturan-presiden'); ?>" href="<?php echo site_url('peraturan/peraturan-presiden'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('peraturan-presiden'); ?></a>
										<a <?php echo ($content_type == "peraturan-menteri") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('peraturan-menteri'); ?>" href="<?php echo site_url('peraturan/peraturan-menteri'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('peraturan-menteri'); ?></a>
										<a <?php echo ($content_type == "keputusan-menteri") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('keputusan-menteri'); ?>" href="<?php echo site_url('peraturan/keputusan-menteri'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('keputusan-menteri'); ?></a>
										<a <?php echo ($content_type == "keputusan-kepala-bpjt") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('keputusan-kepala-bpjt'); ?>" href="<?php echo site_url('peraturan/keputusan-kepala-bpjt'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('keputusan-kepala-bpjt'); ?></a>
										<a <?php echo ($content_type == "keputusan-gubernur") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('keputusan-gubernur'); ?>" href="<?php echo site_url('peraturan/keputusan-gubernur'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('keputusan-gubernur'); ?></a>
										<a <?php echo ($content_type == "lainnya") ? "class='list-group-item list-group-item-action active'" : ""; ?> title="<?php echo lang('lainnya'); ?>" href="<?php echo site_url('peraturan/lainnya'); ?>" class="list-group-item list-group-item-action"  ><?php echo lang('lainnya'); ?></a>
								
									</div>
								</div>

								<div class="widget clearfix">

										<h4><?php echo lang('berita-terpopuler'); ?></h4>
										<div class="posts-sm row col-mb-30" id="post-list-sidebar">
											<?php foreach($popular_articles as $popular_article) { ?>
											<div class="entry col-12">
												<div class="grid-inner row g-0">
													<div class="col-auto">
														<div class="entry-image">
															<a href="<?php echo site_url('berita/' . $popular_article->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($popular_article->image_name, 'pn640'); ?>" alt="<?php echo $popular_article->title; ?>"></a>
														</div>
													</div>
													<div class="col ps-3">
														<div class="entry-title">
															<h4><a href="<?php echo site_url('berita/' . $popular_article->slug); ?>"><?php echo $popular_article->title; ?></a></h4>
														</div>
													</div>
												</div>
											</div>
											 <?php } ?>

										
										</div>
								
								</div>
							</div>
					</div>
				</div>
			</div>
		</section><!-- End Content
		============================================= -->