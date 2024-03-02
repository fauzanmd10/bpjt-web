<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a276345d0d09bcb"></script>

	<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('berita'); ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="<?php echo site_url('berita'); ?>"><?php echo lang('berita'); ?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->


		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9">

							<div class="single-post mb-0">

								<!-- Single Post
								============================================= -->
								<div class="entry clearfix">

									<!-- Entry Title
									============================================= -->
									<div class="entry-title">
										<h2><?php echo $article->title; ?></h2>
									</div><!-- .entry-title end -->

									<!-- Entry Meta
									============================================= -->
									<div class="entry-meta">
										<ul>
											<li><i class="icon-calendar3"></i> <?php echo print_casual_date($article->created_at); ?></li>
											<li><i class="icon-folder-open"></i> <a href="#"><?php echo $article->category_name; ?></a>, <a href="#"><?php echo $article->sub_category_name; ?></a></li>
											<li><a href="#"><i class="icon-eye"></i> <?php echo $article->viewed; ?></a></li>
										</ul>
									</div><!-- .entry-meta end -->

									<!-- Entry Image
									============================================= -->
									<div class="entry-image">
										<?php if( file_exists($this->media->get_image_by_style($article->image_name, 'pn640'))){ ?>
											<a href="#"><img src="<?php echo $this->media->get_image_by_style($article->image_name, 'pn640'); ?>" alt="<?php echo $article->title; ?>" title="<?php echo $article->title; ?>" onerror="this.src='assets/images/no-image.jpg'"></a>
										<?php }else{ ?>
											<a href="#"><img src="<?php echo $this->media->get_image_by_style($article->image_name, ''); ?>" alt="<?php echo $article->title; ?>" title="<?php echo $article->title; ?>" onerror="this.src='assets/images/no-image.jpg'"></a>
										<?php }; ?>
									</div><!-- .entry-image end -->

									<!-- Entry Content
									============================================= -->
									<div class="entry-content mt-0">

										<p><?php echo $article->content; ?></p>

										<div class="clear"></div>

										<!-- Post Single - Share
										============================================= -->
										<div class="si-share border-0 d-flex justify-content-between align-items-center">
											<span>Share Berita Ini</span>
											<div>
												<div class="addthis_inline_share_toolbox"></div>
											</div>
										</div><!-- Post Single - Share End -->

									</div>
								</div><!-- .entry end -->

								<h4><?php echo lang('berita-terkait'); ?></h4>

								<div class="related-posts row posts-md col-mb-30">
								<?php foreach($related_articles as $related_article) { ?>
									<div class="entry col-12 col-md-6">
										<div class="grid-inner row align-items-center gutter-20">
											<div class="col-4">
												<div class="entry-image">
													<a href="<?php echo site_url('berita/' . $related_article->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($related_article->image_name, 'pn640'); ?>" alt="<?php echo $related_article->title; ?>" onerror="this.src='./assets/images/no-image.jpg'" ></a>
												</div>
											</div>
											<div class="col-8">
												<div class="entry-title title-xs">
													<h3><a href="<?php echo site_url('berita/' . $related_article->slug); ?>"><?php echo $related_article->title; ?></a></h3>
												</div>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-calendar3"></i> <?php echo print_casual_date($related_article->created_at); ?></li>
														<li><a href="#"><i class="icon-eye"></i> <?php echo $related_article->viewed; ?></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>


								</div>

							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget clearfix">

									<div class="tabs mb-0 clearfix" id="sidebar-tabs">

										<ul class="tab-nav clearfix">
											<li><a href="#tabs-1"><?php echo lang('berita-terpopuler'); ?></a></li>
											<li><a href="#tabs-2">Indeks</a></li>
										</ul>

										<div class="tab-container">

											<div class="tab-content clearfix" id="tabs-1">
												<div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
													<?php foreach($popular_articles as $popular_article) { ?>
													<div class="entry col-12">
														<div class="grid-inner row g-0">
															<div class="col-auto">
																<div class="entry-image">
																	
																	<?php if( file_exists($this->media->get_image_by_style($popular_article->image_name, 'pn640'))){ ?>
																		<a href="<?php echo site_url('berita/' . $popular_article->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($popular_article->image_name, 'pn640'); ?>" alt="<?php echo $popular_article->title; ?>" title="<?php echo $popular_article->title; ?>" onerror="this.src='./assets/images/no-image.jpg'"></a>
																	<?php }else{ ?>
																		<a href="<?php echo site_url('berita/' . $popular_article->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($popular_article->image_name, ''); ?>" alt="<?php echo $popular_article->title; ?>" title="<?php echo $popular_article->title; ?>" onerror="this.src='./assets/images/no-image.jpg'"></a>
																	<?php }; ?>
																	
																	</div>
															</div>
															<div class="col ps-3">
																<div class="entry-title">
																	<h4>
																	<a href="<?php echo site_url('berita/' . $popular_article->slug); ?>"><?php echo $popular_article->title; ?></a>
																	</h4>
																</div>
																<!--div class="entry-meta">
																	<ul>
																		<li><i class="icon-eye"></i> <?php echo $popular_article->viewed; ?></li>
																	</ul>
																</div-->
															</div>
														</div>
													</div>
													<?php } ?>
												</div>
											</div>
											<div class="tab-content clearfix" id="tabs-2">
												<div class="posts-sm row col-mb-30" id="recent-post-list-sidebar">
													<?php foreach($headlines as $headline) { ?>
													<div class="entry col-12">
														<div class="grid-inner row g-0">
															<div class="col-auto">
																<div class="entry-image">
																
																	<?php if( file_exists($this->media->get_image_by_style($headline->image_name, 'pn640'))){ ?>
																		<a href="<?php echo site_url('berita/' . $headline->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($headline->image_name, 'pn640'); ?>" alt="<?php echo $article->title; ?>" title="<?php echo $article->title; ?>" onerror="this.src='./assets/images/no-image.jpg'"></a>
																	<?php }else{ ?>
																		<a href="<?php echo site_url('berita/' . $headline->slug); ?>"><img src="<?php echo $this->media->get_image_by_style($headline->image_name, ''); ?>" alt="<?php echo $article->title; ?>" title="<?php echo $article->title; ?>" onerror="this.src='./assets/images/no-image.jpg'"></a>
																	<?php }; ?>
																</div>
															</div>
															<div class="col ps-3">
																<div class="entry-title">
																	<h4><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><?php echo $headline->title; ?></a></h4>
																</div>
																<div class="entry-meta">
																	<ul>
																		<li><?php echo print_casual_date($headline->created_at); ?></li>
																	</ul>
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

								<!--div class="widget clearfix">

									<h4>Instagram Photos</h4>
									<div id="instagram-photos" class="instagram-photos masonry-thumbs grid-container grid-4" data-user="pupr_bpjt"></div>

								</div-->

								<div class="widget clearfix">
									<h4>Link Terkait</h4>
									<a href="http://gis.bpjt.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-gis'); ?>" alt="" title="<?php echo lang('gis-bpjt'); ?>" class="icon-fr"/></a>
									<!--a href="#modal" data-toggle="modal" data-target="#Modal"><img src="<?php echo base_url(); ?><?php echo lang('gambar-peluang-investasi'); ?>" alt="" title="<?php echo lang('peluang-investasi'); ?>" class="icon-fr"/></a>
									<!--a href="<?php echo site_url('konten/bujt'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-bujt'); ?>" alt="" title="<?php echo lang('bujt-long'); ?>" class="icon-fr"/></a-->
									<a href="<?php echo site_url('cek-tarif-tol'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarif'); ?>" alt="" title="<?php echo lang('cek-tarif-tol'); ?>" class="icon-fr"/></a>
									<a href="tarif" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarifmap'); ?>" alt="" title="<?php echo lang('cek-tarif-tolmap'); ?>" class="icon-fr"/></a>
									<!--a href="http://binamarga.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/icon-bm.jpg" alt="" title="Bina Marga" class="icon-fr"/></a-->
									

								</div>

							</div>
						</div><!-- .sidebar end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->
