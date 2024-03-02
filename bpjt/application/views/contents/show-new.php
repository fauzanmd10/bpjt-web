<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a276345d0d09bcb"></script>

	<!-- Page Title
		============================================= -->
		<section id="page-title">
			<?php $lang = $this->session->userdata('lang'); ?>
			<div class="container clearfix">
				<h1><?php echo ($lang == 'id') ? $parent_menu->name : $parent_menu->name_en; ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo ($lang == 'id') ? $parent_menu->name : $parent_menu->name_en; ?></a></li>
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
										<h2><?php echo $content->title; ?></h2>
									</div><!-- .entry-title end -->


									<!-- Entry Image
									============================================= -->
									<div class="entry-image">
										<?php if (!empty($show_image)) { ?>
										<?php if ($show_image[0]->meta_value == 'yes' && isset($content->image_name)) { ?>
										<img src="<?php echo $this->media->get_image_by_style($content->image_name, 'pn640'); ?>" onerror="this.src='/bpjt_ci3/assets/images/no-image.jpg'" alt="" /> 
										<?php } ?>
									  <?php } ?>
									</div><!-- .entry-image end -->

									<!-- Entry Content
									============================================= -->
									<div class="entry-content mt-0">

										<p><?php echo $content->content; ?></p>

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

							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget clearfix">
								<?php if (!empty($menus)) { ?>
								<?php $lang = $this->session->userdata('lang'); ?> 
									<div class="list-group">
										<a href="#" class="list-group-item list-group-item-action active">
										<?php echo ($lang == 'id') ? $parent_menu->name : $parent_menu->name_en; ?>
										</a>
										<?php foreach ($menus as $menu) { ?>
										<?php
											$ext = "";
											$menu_name = $menu->name;
											if ($lang == 'en') {
											  $ext = "en/";
											  $menu_name = $menu->name_en;
											}
										  ?>
										<a href="<?php echo site_url('konten/' . $ext . $main_segment . '/' . $menu->slug); ?>" class="list-group-item list-group-item-action"  title="<?php echo $menu_name; ?>"><?php echo $menu_name; ?></a>
										<?php } ?>
									</div>
									<?php } else { ?>
										<div class="widget clearfix"></div>
									<?php } ?>
								</div>
								
								<div class="widget clearfix">
									<h4>Link Terkait</h4>
									
									<ul class="list-group list-group-flush">
									  <li class="list-group-item"><a href="http://gis.bpjt.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-gis'); ?>" alt="" title="<?php echo lang('gis-bpjt'); ?>"/></a></li>
									  <li class="list-group-item"><a href="<?php echo site_url('cek-tarif-tol'); ?>"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarif'); ?>" alt="" title="<?php echo lang('cek-tarif-tol'); ?>"/></a></li>
									  <li class="list-group-item"><a href="https://bpjt.pu.go.id/tarif" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-cek-tarifmap'); ?>" alt="" title="<?php echo lang('cek-tarif-tolmap'); ?>" class="icon-fr"/></a></li>
									  <li class="list-group-item"><a href="https://bpjt.pu.go.id/kuesioner" target="_blank"><img src="<?php echo base_url(); ?><?php echo lang('gambar-kuesioner'); ?>" alt="" title="<?php echo lang('kuesioner'); ?>"/></a></li>
									  <li class="list-group-item"><a href="https://bpjt.pu.go.id/minigame/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/webp/ayo-parkir-id.webp" alt="Ayo Parkir!" title="Ayo Parkir!"/></a></li>
									</ul>
									
								</div>

							</div>
						</div><!-- .sidebar end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->
