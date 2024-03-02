	<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('kuesioner'); ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="<?php echo site_url('kuesioner'); ?>"><?php echo lang('kuesioner'); ?></a></li>
					<li class="breadcrumb-item"><a href="#">Kuesioner Individu</a></li>
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

						<iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSRWkihNZNSB0rO4fZNsRkqncrf-c6RnNnfzUcgScA3oKuhTHg9QNAIhrwiSu5ZMyeFpuCojmUuXMUt/pubhtml?gid=1741849167&amp;single=true&amp;widget=true&amp;headers=false"  width="100%" height="780" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>
					</div>

				
					<div class="sidebar col-lg-3">
						<div class="sidebar-widgets-wrap">
						<h4><?php echo lang('berita-terpopuler'); ?></h4>
							<div class="widget clearfix">
								<div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
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
												<div class="entry-meta">
													<ul>
														<li><?php echo print_casual_date($popular_article->created_at); ?></li>
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
				</div>
			</div>
		</section><!-- #content end --> <!-- /#content -->
