<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/style.css?v=<?php echo time()?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>templates/css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="https://www.pu.go.id/assets/images/content/LOGO_PU.jpg">


	<!-- Document Title
	============================================= -->
	<title><?php echo isset($prefix_title) ? $prefix_title : '' ?>Badan Pengatur Jalan Tol Kementerian Pekerjaan Umum dan Perumahan Rakyat</title>
	
	
	<style>
		.mfp-close-btn-in .mfp-close { color: #FFF; }

		.mfp-content > div { margin: 0 auto; }

		.modal-bottom-right .mfp-content,
		.modal-bottom-left .mfp-content {
			position: absolute;
			left: auto;
			top: auto;
			right: auto;
			bottom: auto;
			width: auto;
		}
		.modal-bottom-right .mfp-content {
			right: 20px;
			bottom: 30px;
		}
		.modal-bottom-left .mfp-content {
			bottom: 30px;
			left: 20px;
		}
		.custom-control-label { line-height: 22px; }
		.mfp-close { display: none !important; }
		.berita{
		  width:300px;
		  height:250px;
		  object-fit:cover;
		  background-position:center;
		}

		.entry-content table tr td {
			border: 1px solid #999;
		}

		table ul,
		table.table ul {
			margin-left: 20px;
		}
	</style>
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XE88R2P9DK"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-XE88R2P9DK');
	</script>

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-9TS5YYQ03K"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-9TS5YYQ03K');
	</script>

	<!-- JavaScripts
	============================================= -->
	<script src="<?php echo base_url(); ?>templates/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>templates/js/plugins.min.js"></script>
	
</head>

<body class="stretched modal-bottom-right">
	
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

    <!-- Top Bar
		============================================= -->
		<div id="top-bar">
			<div class="container">

				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
                        <p class="mb-0 py-2 text-center text-md-start"><a href="http://pu.go.id" target="_blank"><img src="<?php echo base_url(); ?>templates/demo/images/punet.png" alt="PU-Net"></a>
						</p>
					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links on-click">
                            <ul class="top-links-container">
								<a href="https://www.facebook.com/puprbpjt" target="_blank" class="social-icon si-small si-borderless si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="https://twitter.com/pupr_bpjt" target="_blank" class="social-icon si-small si-borderless si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="https://www.youtube.com/c/PUPRBPJT" target="_blank" class="social-icon si-small si-borderless si-youtube">
									<i class="icon-youtube"></i>
									<i class="icon-youtube"></i>
								</a>

								<a href="https://instagram.com/pupr_bpjt" target="_blank" class="social-icon si-small si-borderless si-instagram">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>

								<?php $lang = $this->session->userdata('lang'); ?>
								<li class="top-links-item"><a href="#"><i class="icon-line-stack"></i></a>
									<ul class="top-links-sub-menu" style="bg-color:#c11717;">
										<li class="top-links-item"><a href="<?php echo site_url('/home/set_lang/id'); ?>"> ID</a></li>
										<li class="top-links-item"><a href="<?php echo site_url('/home/set_lang/en'); ?>"> EN</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- .top-links end -->

					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="<?php echo site_url('/'); ?>" class="standard-logo" data-dark-logo="<?php echo base_url(); ?>templates/demo/images/logo-dark.png"><img src="<?php echo base_url(); ?>templates/demo/images/logo.png" alt="Canvas Logo"></a>
							<a href="<?php echo site_url('/'); ?>" class="retina-logo" data-dark-logo="<?php echo base_url(); ?>templates/demo/images/logo-dark@2x.png"><img src="<?php echo base_url(); ?>templates/demo/images/logo@2x.png" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">
						<?php
							$ext = "";
							if ($lang == 'en') {
								$ext = "en/";
							}

							$menu_data = $this->cache->file->get('menu_data');
							if(!$menu_data){
								$menu_data = [
									'collections' => $this->menu->get_parsedtree_menus_frontend(),
									'jalan_tol' => $this->menu->get_menu_jalantol(),
									'progress' => $this->menu->get_menu_progress(),
									'monitoring' => $this->menu->get_menu_monitoring(),
									'profil' => $this->menu->get_menu_profil(),
									'invest' => $this->menu->get_menu_invest()
								];

								$this->cache->file->save('menu_data', $menu_data, 60);
							}
						?>
							<ul class="menu-container">
								<li class="menu-item">
									<a class="menu-link" href="<?php echo site_url('/'); ?>"><div><?php echo lang('home'); ?></div></a>
								</li>
								<li class="menu-item">
									<?php
										$collections = $menu_data['collections'];
										$this->menu->print_frontend_menu_new($collections);
									?>
								</li>

								<li class="menu-item">
									<a class="menu-link" href="#"><div><?php echo lang('jalan-tol'); ?></div></a>
											<ul class="sub-menu-container"><?php $jalan_tols = $menu_data['jalan_tol']; ?>
												<?php foreach($jalan_tols as $jalan_tol) { ?>
												<li class="menu-item">
													<a class="menu-link" href="<?php echo site_url('konten/jalan-tol/' . $jalan_tol->slug); ?>"><div><?php echo lang($jalan_tol->slug); ?></div></a>
												</li>
												<?php }?>
													<?php $progresss = $menu_data['progress']; ?>
													<ul class="sub-menu-container">
														<?php foreach($progresss as $progress) { ?>
														<li class="menu-item">
															<a class="menu-link" href="<?php echo site_url('konten/progress/' . $progress->slug); ?>"><div><?php echo lang($progress->slug); ?></div></a>
														</li>
														<?php }?>
													</ul>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="#"><div>Monitoring</div></a>
									<?php $monitorings = $menu_data['monitoring']; ?>
									<ul class="sub-menu-container">
										<?php foreach($monitorings as $monitoring) { ?>
										<li class="menu-item">
											<a class="menu-link" href="<?php echo site_url('konten/monitoring/' . $monitoring->slug); ?>"><div><?php echo lang($monitoring->slug); ?></div></a>
										</li>
										<?php }?>
									</ul>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="#"><div>SPM</div></a>
									<ul class="sub-menu-container">
										<li class="menu-item"><a class="menu-link" href="<?php echo site_url('spm'); ?>"><div><?php echo lang('spm'); ?></div></a></li>
										<li class="menu-item"><a class="menu-link" href="<?php echo site_url('konten/'.$ext.'spm/definisi-spm'); ?>"><div><?php echo lang('definisi-spm'); ?></div></a></li>
										<li class="menu-item"><a class="menu-link" href="<?php echo site_url('spm/rekapitulasi'); ?>"><div><?php echo lang('rekapitulasi-spm'); ?></div></a></li>
									</ul>
								</li>
														
											</ul>
								<li class="menu-item">
									<a class="menu-link" href="#"><div><?php echo lang('produk'); ?></div></a>
										<ul class="sub-menu-container">
											<li class="menu-item">
												<a class="menu-link" href="https://sigi.pu.go.id/portalpupr/apps/dashboards/ad691982b770462d8e236f8ca7e450f4" target="_blank"><div><?php echo lang('gis-bpjt'); ?></div></a>
											</li>
											<li class="menu-item">
												<a class="menu-link" href="https://bpjt.pu.go.id/buku_tahunan"><div><?php echo lang('buku-tahunan'); ?></div></a>
											</li>
											<li class="menu-item">
												<a class="menu-link" href="#"><div><?php echo lang('peraturan'); ?></div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/undang-undang'); ?>" title="<?php echo lang('undang-undang'); ?>"><?php echo lang('undang-undang'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/peraturan-pemerintah'); ?>" title="<?php echo lang('peraturan-pemerintah'); ?>"><?php echo lang('peraturan-pemerintah'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/peraturan-presiden'); ?>" title="<?php echo lang('peraturan-presiden'); ?>"><?php echo lang('peraturan-presiden'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/peraturan-menteri'); ?>" title="<?php echo lang('peraturan-menteri'); ?>"><?php echo lang('peraturan-menteri'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/keputusan-menteri'); ?>" title="<?php echo lang('keputusan-menteri'); ?>"><?php echo lang('keputusan-menteri'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/keputusan-kepala-bpjt'); ?>" title="<?php echo lang('keputusan-kepala-bpjt'); ?>"><?php echo lang('keputusan-kepala-bpjt'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/keputusan-gubernur'); ?>" title="<?php echo lang('keputusan-gubernur'); ?>"><?php echo lang('keputusan-gubernur'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="<?php echo site_url('peraturan/lainnya'); ?>" title="<?php echo lang('lainnya'); ?>"><?php echo lang('lainnya'); ?></a></li>
													<li class="menu-item"><a class="menu-link" href="https://jdih.pu.go.id/" target="_blank" title="JDIH">JDIH</a></li>
												</ul>
											</li>
										</ul>		
								</li>
								<li class="menu-item">
									<a class="menu-link" href="#"><div><?php echo lang('info-tarif-tol'); ?></div></a>
										<ul class="sub-menu-container">
											<li class="menu-item"><a class="menu-link" href="<?php echo site_url('tabel-tarif-tol'); ?>" title="<?php echo lang('tabel-tarif-tol'); ?>"><?php echo lang('tabel-tarif-tol'); ?></a></li>
											<li class="menu-item"><a class="menu-link" href="<?php echo site_url('cek-tarif-tol'); ?>" title="<?php echo lang('cek-tarif-tol'); ?>"><?php echo lang('cek-tarif-tol'); ?></a></li>
											<li class="menu-item"><a class="menu-link" href="<?php echo site_url('konten/'.$ext.'golongan-kendaraan'); ?>" title="<?php echo lang('golongan-kendaraan'); ?>"><?php echo lang('golongan-kendaraan'); ?></a></li>
											<li class="menu-item"><a class="menu-link" href="http://bpjt.pu.go.id/tarif/" target="_blank" title="<?php echo lang('tarif-tol-navigasi'); ?>"><?php echo lang('tarif-tol-navigasi'); ?></a></li>			
										</ul>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="<?php echo site_url('cari'); ?>" method="get">
							<input type="text" name="keyword" class="form-control" value="" placeholder="<?php echo lang('ketik-cari'); ?>" autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->


		<?php echo $content; ?>


		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">

					<div class="row col-mb-50">
						<div class="col-lg-8">

							<div class="row col-mb-50">
								<div class="col-md-4">

									<div class="widget clearfix">

										<img src="<?php echo base_url(); ?>templates/demo/images/footer-widget-logo.png" alt="Image" class="footer-logo">

										<p><strong>Badan Pengatur Jalan Tol</strong> Kementerian Pekerjaan Umum dan Perumahan Rakyat</p>

										<div style="background: url('<?php echo base_url(); ?>templates/demo/images/world-map.png') no-repeat center center; background-size: 100%;">
											<address>
												<strong>Gd. Binamarga Lt. 2-3, Jl. Pattimura No. 20</strong><br>
												Kebayoran Baru<br>
												Jakarta Selatan 12110<br>
											</address>
										</div>

									</div>

								</div>

								<div class="col-md-4">

									<div class="widget widget_links clearfix">

										<h4><?php echo lang('profil'); ?></h4>

										<ul>
										<?php $profils = $menu_data['profil']; ?>
										<?php foreach($profils as $profil) { ?>
											<li><a href="<?php echo site_url('/konten/bpjt/' . $profil->slug); ?>"><?php echo lang($profil->slug); ?></a></li>
										<?php } ?>
											<li><a href="<?php echo site_url(); ?>/konten/bpjt/faq"><?php echo lang('faq'); ?></a></li>
										</ul>

									</div>

								</div>

								<div class="col-md-4">

									<div class="widget clearfix">
										<h4><?php echo lang('investasi'); ?></h4>
										<ul>
										<?php $invests = $menu_data['invest']; ?>
										<?php foreach($invests as $invest) { ?>	
											<li><a href="<?php echo site_url('/konten/investasi/' . $invest->slug); ?>"><?php echo lang($invest->slug); ?></a></li>
										<?php } ?>
										</ul>
										<a href="<?php echo site_url(); ?>/konten/jalan-tol/bujt"><h4 class="footer-title"><h4>BUJT</h4></a>

										
									</div>

								</div>
							</div>

						</div>

						<div class="col-lg-4">

                        <div class="widget widget_links clearfix">
                            
										<h4><?php echo lang('galeri'); ?></h4>

										<ul>
											<li><a href="<?php echo site_url(); ?>/galeri-foto"><?php echo lang('galeri-foto'); ?></a></li>
											<li><a href="https://www.youtube.com/c/PUPRBPJT" target="_blank"><?php echo lang('galeri-video'); ?></a></li>
											<li><a href="https://bpjt.pu.go.id/video_konstruksi/" target="_blank"><?php echo lang('galeri-video-drone'); ?></a></li>
										</ul>

                                <br/><br/>
							<div class="row col-mb-50">
								<!--div class="col-md-4 col-lg-12">
									<div class="widget clearfix" style="margin-bottom: -20px;">

										<div class="row">
											<div class="col-lg-6 bottommargin-sm">
												<div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
												<h5 class="mb-0">Jumlah Pengunjung</h5>
											</div>

										</div>

									</div>
								</div-->


							</div>

						</div>
					</div></div>

				</div><!-- .footer-widgets-wrap end -->



			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-start">
                            Hak Cipta &copy; 2023 | Badan Pengatur jalan Tol All Rights Reserved<br>
						</div>

						<div class="col-md-6 text-center text-md-end">
						

							<div class="clear"></div>

							<i class="icon-envelope2"></i> informasibpjt@pu.go.id
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	
	<!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>/templates/frontend/js/bootstrap.min.js"></script>
        

	<!-- Footer Scripts
	============================================= -->
	<script src="<?php echo base_url(); ?>templates/js/functions.js"></script>

	<script>

		jQuery(document).ready( function(){

			$('#modal-feedback').on( 'formSubmitSuccess', function(){
				setTimeout(function(){
					$('.modal-feedback-success-modal').magnificPopup('close');
				}, 500);
			});
		});

	</script>

	<?php if (isset($jscripts)) { ?>
			<?php foreach($jscripts as $key => $value) { ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script> 
			<?php } ?>
		<?php } ?>
		


</body>

	
	
</html>