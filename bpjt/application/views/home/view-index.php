		
		<section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header" data-autoplay="6000" data-speed="650" data-loop="true">
			<div class="slider-inner">

				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">
						<?php
						if($banners ?? null):
							foreach($banners as $banner):
								if($banner->jenis == 'image'):
						?>
							<div class="swiper-slide dark">
								<div class="container">
									<div class="slider-caption slider-caption-center">
										<h2 data-animate="fadeInUp"><?php echo strip_tags($banner->judul)?></h2>
										<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"><?php echo strip_tags($banner->deskripsi)?></p>
									</div>
								</div>
								<div class="swiper-slide-bg" style="background-image: url('<?php echo base_url() . 'front/img/banner/' . $banner->image; ?>');"></div>
							</div>
						<?php
								else:
						?>
							<div class="swiper-slide dark">
								<div class="container">
									<div class="slider-caption slider-caption-center">
										<h2 data-animate="fadeInUp"><?php echo strip_tags($banner->judul)?></h2>
										<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"><?php echo strip_tags($banner->deskripsi)?></p>
									</div>
								</div>
								<div class="video-wrap">
									<video id="slide-video" poster="<?php echo base_url() . 'front/img/banner/' . $banner->image; ?>" preload="auto" loop autoplay muted>
										<source src='<?php echo $banner->url_video ?>' type='video/mp4' />
									</video>
									<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
								</div>
							</div>
						<?php
								endif;
							endforeach;
						endif;
						?>
						<!-- <div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
                                    <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Selamat Datang di</p>
									<h2 data-animate="fadeInUp">BADAN PENGATUR JALAN TOL</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('<?php echo base_url(); ?>templates/demo/images/slider/swiper/banner3.jpg');"></div>
						</div>
						<div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
									<h2 data-animate="fadeInUp">Pelayanan Publik PUPR BPJT</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Menyediakan pengelolaan dan pelayanan informasi publik BPJT dengan cepat, mudah, dan sederhana sesuai standar pelayanan informasi publik serta ketentuan peraturan perundang-undangan, secara transparan dan bertanggung jawab.</p>
								</div>
							</div>
							<div class="video-wrap">
								<video id="slide-video" poster="<?php echo base_url(); ?>templates/demo/images/videos/explore-poster.jpg" preload="auto" loop autoplay muted>
									source src='<?php echo base_url(); ?>templates/demo/images/videos/explore.webm' type='video/webm' /
									<source src='<?php echo base_url(); ?>templates/demo/images/videos/pelayanan.mp4' type='video/mp4' />
								</video>
								<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="container">
								<div class="slider-caption">
									<h2 data-animate="fadeInUp"> </h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"> </p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('<?php echo base_url(); ?>templates/demo/images/slider/swiper/banner2_2.jpg'); background-position: center top;"></div>
						</div>
						<div class="swiper-slide">
							<div class="container">
								<div class="slider-caption">
									<h2 data-animate="fadeInUp"> </h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"> </p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('<?php echo base_url(); ?>templates/demo/images/slider/swiper/banner5.jpg'); background-position: center top;"></div>
						</div> -->
						<!--div class="swiper-slide">
							<div class="container">
								<div class="slider-caption">
									<h2 data-animate="fadeInUp"> </h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"> </p>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background-image: url('<?php echo base_url(); ?>templates/demo/images/slider/swiper/4.jpg'); background-position: center top;"></div>
						</div-->
					</div>
					<div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
					<div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
				</div>

				<a href="#" data-scrollto="#content" data-offset="100" class="one-page-arrow dark"><i class="icon-angle-down infinite animated fadeInDown"></i></a>

			</div>
		</section>
		
		<!-- Content
		============================================= -->
		<section id="content">
		<style>
		.spinny-words span{
			animation: rotateWord <?php echo (count($newstickers) * 5)?>s linear infinite 0s;
		}
		</style>
		
		<div class="d-lg-none">
		<div class="section m-0 bg-color center text-end header-stick" style="padding: 20px 0 30px 0; height:100%">
					<div class="container clearfix">
					<div class="row">
					  <div class="col-md-12 spinny-wrapper">
						<h6 class="font-weight-semibold text-color-dark mb-0 word-rotator slide is-full-width">
						<span class="col-md-2" style="color:#fff;">Pengumuman: </span>
						<span class="col-md-9 spinny-words" style="color:#fff;margin-top:-20px;">
							<?php if (!empty($newstickers)) { ?>
							<?php foreach($newstickers as $newsticker) { 
										$text=$newsticker->content;
										?>
								<span><?php echo strip_tags($text,'<p><a>'); ?></span>
							<?php } ?>
								<?php } else { ?>
								<span>Selamat Datang di Website Badan Pengatur Jalan Tol (BPJT)</span>
							<?php } ?>
										
						</span>
						</h6>
					  </div>
					</div>
				</div>
		</div>
		</div>
		
		<div class="d-none d-lg-block">
		<div class="section m-0 bg-color center text-end header-stick" style="padding: 20px 0 30px 0; height:100%">
					<div class="container clearfix">
					<div class="row">
					  <div class="col-md-12 spinny-wrapper">
						<h5 class="font-weight-semibold text-color-dark mb-0 word-rotator slide is-full-width">
						<span class="col-md-2" style="color:#fff;">Pengumuman: </span>
						<span class="col-md-9 spinny-words" style="color:#fff;margin-top:-20px;">
							<?php if (!empty($newstickers)) { ?>
							<?php foreach($newstickers as $newsticker) { 
										$text=$newsticker->content;
										?>
								<span><?php echo strip_tags($text,'<p><a>'); ?></span>
							<?php } ?>
								<?php } else { ?>
								<span>Selamat Datang di Website Badan Pengatur Jalan Tol (BPJT)</span>
							<?php } ?>
										
						</span>
						</h5>
					  </div>
					</div>
				</div>
		</div>
		</div>

        <div class="row clearfix align-items-stretch bottommargin-lg">

            <div class="col-lg-3 col-md-6 center col-padding" style="background-color: #E2E2E2;">
			<a href="konten/progress/beroperasi" target="_blank">
                <i class="i-plain i-xlarge mx-auto icon-line2-directions"></i>
                <div class="counter counter-lined"><span data-from="800" data-to="2816" data-refresh-interval="50" data-speed="2000"></span></div>
                <h5>Total KM Tol Operasi</h5>
			</a>
            </div>

            <div class="col-lg-3 col-md-6 center col-padding" style="background-color: #E9E9E9;">
			<a href="konten/progress/beroperasi" target="_blank">
                <i class="i-plain i-xlarge mx-auto icon-line2-graph"></i>
                <div class="counter counter-lined"><span data-from="20" data-to="73" data-refresh-interval="100" data-speed="2500"></span></div>
                <h5>Jumlah Tol Operasi</h5>
			</a>
            </div>

            <div class="col-lg-3 col-md-6 center col-padding" style="background-color: #EEE;">
			<a href="konten/monitoring/trans-jawa" target="_blank">
                <i class="i-plain i-xlarge mx-auto icon-line2-layers"></i>
                <div class="counter counter-lined"><span data-from="3" data-to="23" data-refresh-interval="25" data-speed="3500"></span></div>
                <h5>Jumlah Tol Konstruksi</h5>
			</a>
            </div>

            <div class="col-lg-3 col-md-6 center col-padding" style="background-color: #F2F2F2;">
			<a href="konten/jalan-tol/bujt" target="_blank">
                <i class="i-plain i-xlarge mx-auto icon-briefcase"></i>
                <div class="counter counter-lined"><span data-from="2" data-to="59" data-refresh-interval="30" data-speed="2700"></span></div>
                <h5>BUJT <br/>    (Badan Usaha Jalan Tol)</h5>
			</a>
            </div>

        </div>

        <!-- Berita
		============================================= -->
				<div class="container">
					<div class="row posts-md col-mb-30">
                    <div class="fancy-title title-border">
                        <h4><?php echo lang('berita-terkini'); ?></h4>
                    </div>
					<?php foreach($headlines as $headline) { ?>
						<div class="col-lg-3 col-md-6">
							<div class="entry">
								<div class="entry-image">
									<?php if(file_exists($this->media->get_image_by_style($headline->image, 'pn640'))){ ?>
									<a href="#"><img style="height: 250px; object-fit: cover" src="<?php echo $this->media->get_image_by_style($headline->image, 'pn640'); ?>"  onerror="this.src='/assets/images/no-image.jpg'" alt="Image"></a>
								<?php }else{ ?>
									<a href="#"><img style="height: 250px; object-fit: cover" src="<?php echo $this->media->get_image_by_style($headline->image, ''); ?>"  onerror="this.src='/assets/images/no-image.jpg'" alt="Image"></a>
								<?php }; ?>
								</div>
								<div class="entry-title title-xs nott">
									<h3><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><?php echo $headline->title; ?></a></h3>
								</div>
								<div class="entry-meta">
									<ul>
										<li><i class="icon-calendar3"></i> <?php echo print_casual_date($headline->created_at); ?></li>
										<li><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><i class="icon-eye-open"></i> <?php echo $headline->viewed; ?></a></li>
									</ul>
								</div>
								<div class="entry-content">
									</div>
							</div>
						</div>
					<?php } ?>
					</div>
					<div class="divider divider-center">
						<a href="<?php echo site_url('berita'); ?>" class="button text-end"><?php echo lang('index-berita'); ?> <i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>

            <!-- end of berita
            ========================= -->
			

            <!-- produk
            ================================================= -->

            <div class="section topmargin mb-0 border-bottom-0">
					<div class="container clearfix">
						<div class="heading-block center m-0">
							<h3>Pelayanan Publik</h3>
						</div>
					</div>
				</div>
				
				
								 <!-- Parallax GIS BJT
            ========================= -->

				<div class="section parallax dark m-0 border-0 skrollable skrollable-between" style="padding: 50px 0px; background-image: url(&quot;<?php echo base_url(); ?>templates/demo/images/parallax/home/5.jpg&quot;); background-position: 0px -190.396px;" data-bottom-top="background-position:0px -300px;" data-top-bottom="background-position:0px -300px;">
					<div class="container text-center">

						<div class="emphasis-title">
							<h3 class="topmargin-sm" style="text-transform: uppercase; margin:10px 0; padding:10px 0;"><?php echo lang('peta'); ?></h3>
							<h2 style="text-transform: uppercase;"><?php echo lang('jalan-tol-indonesia'); ?></h2>
						</div>

						<a href="https://sigi.pu.go.id/portalpupr/apps/dashboards/ad691982b770462d8e236f8ca7e450f4" target="_blank" class="button button-border button-rounded button-light button-large"><?php echo lang('selengkapnya'); ?></a>

					</div>
				</div>
			
				<!-- End ofParallax GIS BPJT
            ========================= -->

				<div id="portfolio" class="portfolio row g-0 portfolio-reveal grid-container">

					<article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics pf-uielements">
						<div class="grid-inner">
							<div class="portfolio-image">
								<a href="#">
									<img src="<?php echo base_url(); ?>templates/demo/images/portfolio/4/3.jpg" alt="Mac Sunglasses">
								</a>
								<div class="bg-overlay">
									<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
										<a href="tarif" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-money-check"></i></a>
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="https://bpjt.pu.go.id/tarif">Cek Tarif Tol</a></h3>
								<span><a href="https://bpjt.pu.go.id/tarif">Antar Ruas</a>, <a href="#">Total Tarif</a></span>
							</div>
						</div>
					</article>

					<article class="portfolio-item col-6 col-md-4 col-lg-3 pf-illustrations">
						<div class="grid-inner">
							<div class="portfolio-image">
								<a href="buku_tahunan">
									<img src="<?php echo base_url(); ?>templates/demo/images/portfolio/4/2.jpg" alt="Buku Tahunan BPJT">
								</a>
								<div class="bg-overlay">
									<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
										<a href="buku_tahunan" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" title="Buku Tahunan BPJT"><i class="icon-readme"></i></a>
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="buku_tahunan">Buku Tahunan BPJT</a></h3>
								<span><a href="buku_tahunan">Annual Report BPJT dari tahun ke tahun</a></span>
							</div>
						</div>
					</article>

					<article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics pf-uielements">
						<div class="grid-inner">
							<div class="portfolio-image">
								<a href="#">
									<img src="<?php echo base_url(); ?>templates/demo/images/portfolio/4/1.jpg" alt="Kuesioner Survey Layanan Informasi Publik">
								</a>
								<div class="bg-overlay">
									<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
										<a href="kuesioner" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-question1"></i></a>
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="kuesioner">Kuesioner</a></h3>
								<span><a href="kuesioner">Survey Layanan Informasi Publik</a></span>
							</div>
						</div>
					</article>

					<article class="portfolio-item col-6 col-md-4 col-lg-3 pf-icons pf-illustrations">
						<div class="grid-inner">
							<div class="portfolio-image">
								<a href="portfolio-single.html">
									<img src="<?php echo base_url(); ?>templates/demo/images/portfolio/4/4.jpg" alt="Open Imagination">
								</a>
								<div class="bg-overlay" data-lightbox="gallery">
									<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
										<a href="spm" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-check1"></i></a>
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
								</div>
							</div>
							<div class="portfolio-desc">
								<h3><a href="spm">Lihat lebih lanjut</a></h3>
								<span><a href="spm">Standar Pelayanan Minimal</a></span>
							</div>
						</div>
					</article>


				</div>

                <!-- end of produk 
                ===========================  -->

				<div class="row align-items-center" style="--bs-gutter-x: 0;">
					<div class="col-lg-6">
						<div class="section parallax dark m-0 border-0 skrollable skrollable-between" style="padding: 50px 0px; background-image: url(&quot;<?php echo base_url(); ?>templates/demo/images/parallax/home/cctv.jpg&quot;); background-position: 0px -190.396px;" data-bottom-top="background-position:0px -300px;" data-top-bottom="background-position:0px 0px;">
							<div class="text-center">

								<div class="emphasis-title">
									<h2 style="text-transform: uppercase;">CCTV</h2>
									<h3 style="text-transform: uppercase;"><?php echo lang('jalan-tol-indonesia'); ?></h3>
								</div>

								<a href="<?php echo base_url(); ?>cctv/cctv_inframe" target="_blank" class="button text-end button-large"><?php echo lang('selengkapnya'); ?>  <i class="icon-video1"></i> </a>

							</div>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="section parallax dark m-0 border-0 skrollable skrollable-between" style="padding: 50px 0px; background-image: url(&quot;<?php echo base_url(); ?>templates/demo/images/parallax/home/mlff.jpg&quot;); background-position: 0px -190.396px;" data-bottom-top="background-position:0px -300px;" data-top-bottom="background-position:0px 0px;">
							<div class="text-center">

								<div class="emphasis-title">
									<h2 style="text-transform: uppercase;">FAQ MLFF</h2>
									<h3><i class="icon-car-alt"></i><i>   Multi-Lane Free Flow</i></h3>
								</div>

								<a href="https://bit.ly/FAQMLFF" target="_blank" class="button text-end button-large"><?php echo lang('selengkapnya'); ?>  <i class="icon-circle-arrow-right"></i> </a>

							</div>
						</div>
					</div>
				</div>


			<!--  BPJT Info TOl Mobile
            ========================= -->

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="heading-block topmargin-lg center">
						<h2>Tol Kita</h2>
						<span class="mx-auto">merupakan aplikasi yanng berfungsi sebagai wadah,  yang memudahkan pengguna jalan tol dalam mencari informasi-  informasi terkait jalan tol melalui mobile apps.</span>
					</div>

					<div class="row align-items-center col-mb-50 mb-4">
						<div class="col-lg-4 col-md-6">

							<div class="feature-box flex-md-row-reverse text-md-end" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-heart"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Cek Tarif Tol</h3>
									<p>Menampilkan informasi estimasi total tarif yang harus dikeluarkan antar ruas tol</p>
								</div>
							</div>

							<div class="feature-box flex-md-row-reverse text-md-end mt-5" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-paper"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Peta Jalan Tol</h3>
									<p>Menampilkan informasi ruas tol di indonesia</p>
								</div>
							</div>

							<div class="feature-box flex-md-row-reverse text-md-end mt-5" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-layers"></i></a>
								</div>
								<div class="fbox-content">
									<h3>CCTV</h3>
									<p>Menampilkan informasi kondisi jalan tol terkini berupa video dan foto/gambar</p>
								</div>
							</div>

						</div>

						<div class="col-lg-4 d-md-none d-lg-block text-center">
							<img src="<?php echo base_url(); ?>templates/demo/images/services/iphone7.png" alt="iphone 2">
                            <br/><a data-bs-toggle="modal" data-bs-target="#myModal1" class="button button-xlarge text-end">Unduh<i class="icon-circle-arrow-right"></i></a>
						</div>

						<div class="col-lg-4 col-md-6">

							<div class="feature-box" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-power"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Call Center</h3>
									<p>Menampilkan informasi call center jalan tol yang bisa  dihubungi</p>
								</div>
							</div>

							<div class="feature-box mt-5" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-check"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Pengaduan</h3>
									<p>Memungkinkan pengguna melakukan pengaduan/kontak langsung dengan BUJT terkait jalan tol yang dilewati</p>
								</div>
							</div>

							<div class="feature-box mt-5" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-bulb"></i></a>
								</div>
								<div class="fbox-content">
									<h3>News update</h3>
									<p>Memberikan informasi berita terkait jalan tol  terkini</p>
								</div>
							</div>

						</div>
					</div>

				</div>
				
				
	<!-- Modal Unduh BPJT Info -->
			<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Tol Kita</h4>
							<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
					<div class="modal-body">
						<!--img src="<?php echo base_url(); ?>templates/frontend/img/icon-bpjt-info.webp" alt="" style="padding:10px; max-width:150px"/-->
						<p>Aplikasi <b>Tol Kita</b> merupakan aplikasi yanng berfungsi sebagai wadah, yang memudahkan pengguna jalan tol dalam mencari informasi-informasi terkait jalan tol melalui mobile apps</p>
						<p>Aplikasi ini tersedia dalam versi Android dan IOS, silakan klik tautan dibawah ini untuk mengunduh sesuai dengan sistem operasi di perangkat mobile yang Anda gunakan</p>
						<a href="https://apps.apple.com/id/app/tol-kita/id1552154927" target="_blank"><img src="<?php echo base_url(); ?>templates/frontend/img/icon-app-store.webp" alt="BPJT Info Tol versi IOS" title="BPJT Info Tol versi IOS" style="width:35%;"/></a>
						<a href="https://play.google.com/store/apps/details?id=id.go.pu.bpjt.info" target="_blank"><img src="<?php echo base_url(); ?>templates/frontend/img/icon-play-store.webp" alt="BPJT Info Tol versi Android" title="BPJT Info Tol versi Android" style="width:35%;"/></a>
					</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
	<!-- End of Modal Unduh BPJT Info -->
	
				<div class="container clearfix">
                <div class="row align-items-center col-mb-50">
                    <div class="col-lg-4">
                        <div class="fancy-title title-border">
                            <h4>Video</h4>
                        </div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/cFTzM0xzYTs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-4">
                        <div class="fancy-title title-border">
                            <h4>Info Grafis</h4>
                        </div>
                        <div id="oc-slider" class="owl-carousel carousel-widget owl-loaded owl-drag with-carousel-dots" data-margin="0" data-items="1" data-animate-in="zoomIn" data-speed="450" data-animate-out="fadeOut">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-2592px, 0px, 0px); transition: all 0s ease 0s; width: 5184px;">
								<?php foreach($infografis as $info) { ?>
									<div class="owl-item" style="width: 1296px;">
										<a href="#"><img src="<?php echo $info->url; ?>" alt="<?php echo $info->title; ?>" onerror="this.src='/assets/images/no-image.jpg'" ></a>
                                    </div>
								<?php } ?>
                                </div>
                                <div class="owl-nav">
                                    <button type="button" role="presentation" class="owl-prev"><i class="icon-angle-left"></i>
                                    </button>
                                    <button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i>
                                    </button></div>
                                    <button role="button" class="owl-dot active"><span></span>
                                    </button>
                                    <button role="button" class="owl-dot"><span></span>
                                    </button>
                                </div>
                            </div>
					</div>
                    <div class="col-lg-4">
                        <div class="fancy-title title-border">
                            <h4>Twitter</h4>
                        </div>
						
						<div style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
							<div style="width:80%; margin:0 20px;">
									<!-- <a class="twitter-timeline" href="https://twitter.com/pupr_bpjt?ref_src=twsrc%5Etfw">Tweets by pupr_bpjt</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
									<blockquote class="twitter-tweet"><p lang="in" dir="ltr">Yuk <a href="https://twitter.com/hashtag/SobatBPJT?src=hash&amp;ref_src=twsrc%5Etfw">#SobatBPJT</a> bantu mimin mengisi Survei Layanan Informasi Publik BPJT link dibawah ini yaa😊<a href="https://t.co/OHJeqbI12X">https://t.co/OHJeqbI12X</a><a href="https://twitter.com/hashtag/SigapMembangunNegeri?src=hash&amp;ref_src=twsrc%5Etfw">#SigapMembangunNegeri</a> <a href="https://t.co/ADQkMFqULp">pic.twitter.com/ADQkMFqULp</a></p>&mdash; Badan Pengatur Jalan Tol (@pupr_bpjt) <a href="https://twitter.com/pupr_bpjt/status/1626107888413589504?ref_src=twsrc%5Etfw">February 16, 2023</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
						</div>

                        <!--iframe border=0 frameborder=0 height=250 width=550 src="https://twitter.com/pupr_bpjt?ref_src=twsrc%5Etfw"-->
                        </iframe>
                    </div>
                    </div>
                </div>
				</div>


				<div class="container clearfix"> <!-- .Informasi Umum -->
                    <div class="fancy-title title-border">
                        <h4><?php echo lang('informasi-umum'); ?></h4>
                    </div>
					<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="60" data-loop="true" data-nav="false" data-autoplay="3000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">

						<div class="oc-item"><a href="https://jdih.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/jdih.png" alt="Jaringan Dokumentasi dan Informasi Hukum"></a></div>
						<div class="oc-item"><a href="konten/informasi-publik/zona-integritas"><img src="<?php echo base_url(); ?>assets/images/link-umum/stop-gratifikasi.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://wispu.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/wisp-logo.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://www.lapor.go.id/instansi/kementerian-pekerjaan-umum-dan-perumahan-rakyat"><img src="<?php echo base_url(); ?>assets/images/link-umum/lapor.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://lpse.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/lpse.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://eppid.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/e-ppid.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://sippn.menpan.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/sipp-parnb.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="https://sip3rumijatol.binamarga.pu.go.id/" target="_blank"><img src="<?php echo base_url(); ?>assets/images/link-umum/sip3rumijatol.png" alt="Clients"></a></div>
						<!--div class="oc-item"><a href="#"><img src="<?php echo base_url(); ?>assets/images/link-umum/jdih.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="<?php echo base_url(); ?>assets/images/link-umum/jdih.png" alt="Clients"></a></div-->

					</div>


				</div>
			</div>
		</section><!-- #content end -->		
		
