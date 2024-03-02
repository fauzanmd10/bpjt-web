
	<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('info-tarif-tol'); ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="<?php echo site_url('tarif-tol'); ?>"><?php echo lang('tabel-tarif-tol'); ?></a></li>
				</ol>
			</div>
		</section>

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
					
									<form>
									<div class="form-group">
										<select id="toll-roads" class="form-select">
											<?php foreach($toll_roads as $toll_road) { ?>
												<option value="<?php echo $toll_road->id; ?>" data-imgurl="<?php echo $toll_road->url; ?>"><?php echo $toll_road->name; ?></option>
											<?php } ?>
									</select>
									<input type="button" id="get-image" value="Lihat Tarif Tol" class="button" style="margin-left:0px;" />
									</div>

									<div class="table-responsive">
										<div id="kepmen" class="alert alert-info"></div>
										<table id="tariffs-table" class="table table-striped table-bordered dataTable">
										  <thead>
											<tr>
											  <th rowspan="2">Asal Perjalanan</th>
											  <th rowspan="2">Tujuan Perjalanan</th>
											  <th colspan="<?php echo count($vehicle_groups); ?>">Golongan Kendaraan</th>
											</tr>
											<tr>
											  <?php foreach($vehicle_groups as $group) { ?>
											  <th><?php echo $group->name; ?></th>
											  <?php } ?>
											</tr>
										  </thead>
										  <tbody>
										  </tbody>
										</table>
									</div>
									</form>
								</div>
							</div>
						</div> <!-- End Post Content
						============================================= -->
				
				<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget clearfix">

									<div class="tabs mb-0 clearfix" id="sidebar-tabs">

										<ul class="tab-nav clearfix">
											<li><a href="#tabs-1"><?php echo lang('berita-terpopuler'); ?></a></li>
										</ul>

										<div class="tab-container">

											<div class="tab-content clearfix" id="tabs-1">
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

            </div> <!-- /#artikel -->
        </div> <!-- /#collapse-profil -->
		</section>

        <hr class="border-primary">

    </div> <!-- /#content -->
