		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('index-berita'); ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo lang('berita'); ?></li>
				</ol>
			</div>

		</section><!-- #page-title end -->
		
		
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row">
						<div class="postcontent col-lg-9">

							<div class="row">
							
							<?php foreach($articles as $article) { ?>
							
								<div class="entry event col-12">
									<div class="grid-inner row g-0 p-4">
										<div class="col-md-5 mb-md-0">
											<a href="#" class="entry-image">
												<img src="<?php echo (isset($article->image_name)) ? $this->media->get_image_by_style($article->image_name, 'pn640') : base_url() . "bpjt_ci3/assets/images/no-image.jpg"; ?>" alt="<?php echo $article->title; ?>" onerror="this.src='/bpjt_ci3/assets/images/no-image.jpg'">
												
											</a>
										</div>
										<div class="col-md-7 ps-md-4">
											<div class="entry-title title-sm">
												<h2><a href="<?php echo site_url('berita/' . $article->slug); ?>"><?php echo $article->title; ?></a></h2>
											</div>
											<div class="entry-meta">
												<ul>
													<li><span class="badge bg-warning text-dark py-1 px-2"><?php echo $article->category_name; ?></span></li>
													<li><a href="#"><i class="icon-calendar3"></i> <?php echo print_casual_date($article->created_at); ?></a></li>

												</ul>
											</div>
											<div class="entry-content">
												<p><?php echo $article->excerpt; ?></p>
												<a href="<?php echo site_url('berita/' . $article->slug); ?>" class="btn btn-danger"><?php echo lang('selengkapnya'); ?></a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?> 
							
							</div>
							
							<!-- Pager
							============================================= -->
							<div class="d-flex justify-content-between">
								<div class="row gutter-40 col-mb-80">
									<ul class="pagination pagination-rounded pagination-inside-transparent pagination-button pagination-sm">
									<?php for($i=1; $i<=$total_page; $i++) { ?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
										</li>
									<?php } ?>
									</ul>
								</div>
							</div>
							<!-- .pager end -->
							
						</div>
						
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">
							
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
			</div>
		</section>
