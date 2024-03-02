
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first the head any other head content must come *after* these tags -->
        <meta name="description" content="Badan Pengatur Jalan Tol Direktorat Jenderal Bina Marga Kementerian Pekerjaan Umum dan Perumahan Rakyat">
        <meta name="keywords" content="BPJT, bpjt, tol, jalan, PU, jalan tol, tarif tol, gis, bebas hambatan, BUJT, bujt">
		<meta name="author" content="">
        
                <link rel="icon" href="https://www.pu.go.id/assets/images/content/LOGO_PU.jpg">
        <title>BPJT - Badan Pengatur Jalan Tol</title>

        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,600,700">
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url(); ?>templates/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->

        <link href="<?php echo base_url(); ?>templates/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- prettyPhoto -->

        <link href="<?php echo base_url(); ?>templates/frontend/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
        <!-- CSS -->

                        <link href="<?php echo base_url(); ?>templates/frontend/css/custom_css.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>templates/frontend/css/carousel.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>templates/frontend/css/slider/slider.css" rel="stylesheet" type="text/css" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        
        <!-- jQuery-->
        <script src="<?php echo base_url(); ?>/templates/frontend/js/jquery-1.12.4.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="<?php echo base_url(); ?>/templates/frontend/js/bootstrap.min.js"></script>
        <!-- jQuery Easing plugin -->
        <script src="<?php echo base_url(); ?>/templates/frontend/js/jquery.easing.min.js"></script>
        <!-- prettyPhoto -->
        <script src="<?php echo base_url(); ?>/templates/frontend/js/jquery.prettyPhoto.js"></script>
        <!-- JS -->
        <script src="<?php echo base_url(); ?>/templates/frontend/js/app.js"></script>
		<script src="<?php echo base_url(); ?>/templates/frontend/js/slick.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url(); ?>/templates/frontend/js/slider/slider.js" type="text/javascript" charset="utf-8"></script>
		

		<?php if (isset($jscripts)) { ?>
			<?php foreach($jscripts as $key => $value) { ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script> 
			<?php } ?>
		<?php } ?>

		
        <style type="text/css">
            .default-color-r {
                color: #45678d !important;
            }
            @media (width: 1280px) {
                #artikel .artikel-img {
                    max-height: 200px !important;
                }
            }
            @media (width: 1360px) {
                #artikel .artikel-img {
                    max-height: 215px !important;
                }
            }
            @media (width: 1600px) {
                #artikel .artikel-img {
                    max-height: 260px !important;
                }
            }
            @media (width: 1920px) {
                #artikel .artikel-img {
                    max-height: 320px !important;
                }
            }
            @media (max-width: 768px) {
                .navbar-brand {
                    width: 75% !important;
                }
                .no-margin-top-r {
                    margin-top: 0px !important;
                }
                .no-margin-bottom-r {
                    margin-bottom: 0px !important;
                }
                .no-margin-lr-r {
                    margin-left: 0px !important;
                    margin-right: 0px !important;
                }
                .no-padding-bottom-r {
                    padding-bottom: 0 !important;
                }
                .custom-padding-r {
                    padding-left: 15px !important; 
                    padding-right: 15px !important; 
                    padding-top: 0px !important; 
                    padding-bottom: 0px !important;
                }
                .font-12 {
                    font-size: 12px !important;
                }
                #bendera {
                    padding-top: 0px !important;
                    padding-bottom: 80px !important;
                    margin-top: -20px;
                }
                .carousel-caption {
                    bottom: 0px !important;
                    padding-top: 0px !important;
                }
            }
			
			.dropdown-menu>li>a {
				color: #45678d;
			}
			.dropdown-submenu {
				position: relative;
				
			}

			.dropdown-submenu>.dropdown-menu {
				top: 0;
				left: 100%;
				margin-top: -6px;
				margin-left: -1px;
				-webkit-border-radius: 0 6px 6px 6px;
				-moz-border-radius: 0 6px 6px;
				border-radius: 0 6px 6px 6px;
				    box-sizing: border-box;
					width: 80%;
			}


			.dropdown-submenu>a:after {
				display: block;
				content: " ";
				float: right;
				width: 0;
				height: 0;
				border-color: transparent;
				border-style: solid;
				border-width: 5px 0 5px 5px;
				border-left-color: #ccc;
				margin-top: 5px;
				margin-right: -10px;
			}


			
			#language {
				display: block;
				float: right;
				margin: 5px 5px 0 10px;
				padding: 0 0 0 20px;
			}
			a.id {
				background-image: url("../assets/images/flags/id.png");
				background-position: 0 50%;
				background-repeat: no-repeat;
				width: 17px;
			}
			a.id span {
				font-size: 10px;
				margin-left: 20px;
				text-align: right;
				position:relative;
				top:-1px;
				color:#ffffff;
				font-family:Arial, Helvetica, sans-serif;
			}
			a.id span.selected, a.en span.selected {
				background: #FBC100;
				padding:1px 4px 0px 4px;  
			}

			a:hover.id span {
				color:#FECB00;
			}


			a.en {
				background-image: url("../assets/images/flags/gb.png");
				background-position: 0 50%;
				background-repeat: no-repeat;
				font-size: 10px;
				margin-right: 10px;
				width: 17px;
			}
			a.en span {
				font-size: 10px;
				margin-left: 20px;
				text-align: right;
				position:relative;
				top:-1px;
				color:#ffffff;
				font-family:Arial, Helvetica, sans-serif;

			}

			a:hover.en span {
				color:#FECB00;
			}
			
			ul li a.mudik {
				color:#23527c;
				background-color:#fac51c;
			}
			ul li a:hover.mudik{
				color:#fac51c;
				background-color:#354777;
			}
			
			/* Firefox old*/
			@-moz-keyframes blink {
				0% {
					opacity:1;
				}
				50% {
					opacity:0;
				}
				100% {
					opacity:1;
				}
			} 

			@-webkit-keyframes blink {
				0% {
					opacity:1;
				}
				50% {
					opacity:0;
				}
				100% {
					opacity:1;
				}
			}
			/* IE */
			@-ms-keyframes blink {
				0% {
					opacity:1;
				}
				50% {
					opacity:0;
				}
				100% {
					opacity:1;
				}
			} 
			/* Opera and prob css3 final iteration */
			@keyframes blink {
				0% {
					opacity:1;
				}
				50% {
					opacity:0;
				}
				100% {
					opacity:1;
				}
			} 
			.blink-image {
				-moz-animation: blink normal 2s infinite ease-in-out; /* Firefox */
				-webkit-animation: blink normal 2s infinite ease-in-out; /* Webkit */
				-ms-animation: blink normal 2s infinite ease-in-out; /* IE */
				animation: blink normal 2s infinite ease-in-out; /* Opera and prob css3 final iteration */
			}
        </style>
        <!--![endif]-->

        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XE88R2P9DK"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-XE88R2P9DK');
        </script>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WJGL26H');</script>
        <!-- End Google Tag Manager -->
    </head>

    <body class=''>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJGL26H"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->


        <!-- Top Bar -->
<div id="topbar" class="container-fluid">
    <div class="row top-bar">
        <div class="col-sm-12">
            <p><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>templates/frontend/img/home-logo.png" class="img-responsive" alt="Home Logo"></a></p>

            <p class="pu-net"><a style="color: inherit" href="https://www.pu.go.id/"><strong>PU</strong>-net</a></p>

			<?php $lang = $this->session->userdata('lang'); ?>
			<p class="language"><span class="pull-right" id="language">
				<a href="<?php echo site_url('/home/set_lang/id'); ?>" title="Indonesia" class="id"><span <?php echo ($lang == 'id') ? "class='selected'" : ""; ?>>ID</span></a>
				<a href="<?php echo site_url('/home/set_lang/en'); ?>" title="English" class="en"><span <?php echo ($lang == 'en') ? "class='selected'" : ""; ?>>EN</span></a>
			</p></span>
			
            <p class="date"><span class="pull-right" id="clock"></span></p>

            <p class="hidden-xs"><a href="http://itv.pu.go.id"><span class="pull-right"><img src="<?php echo base_url(); ?>templates/frontend/img/puprtv_logo.png" class="img-responsive puprtv" alt="Puprtv"></span></a></p>
			
			
        </div>
    </div> <!-- /.row -->
</div> <!-- /#top-bar -->

        <!-- Nav Bar -->
        <nav class="no-margin-top-r no-margin-bottom-r no-padding-bottom-r no-margin-lr-r navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"><?php
						  $ext = "";
						  if ($lang == 'en') {
							$ext = "en/";
						  }
						?></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand custom-padding-r" href="#" style="margin-bottom: 20px;">
                        <img style="width: 100% !important;" src="<?php echo base_url(); ?>templates/frontend/img/logo2.png" class="img-responsive logo2" alt="Logo">
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse" style="font-family: 'Roboto', sans-serif; display: block;text-transform: uppercase;font-weight: normal;">
                    <ul class="dropdown-submenu nav navbar-nav navbar-right">

                        <li><a class="<?php echo ($this->router->fetch_class() == 'home') ? "active" : ""; ?> iconhome mobile" href="<?php echo site_url('/'); ?>" title="<?php echo lang('home'); ?>"><?php echo lang('home'); ?></a>
						</li>
							  <?php
								$collections = $this->menu->get_parsedtree_menus_frontend();
								$this->menu->print_frontend_menu2($collections);
							  ?>
						
						<li><a class="<?php echo ($this->router->fetch_class() == 'jalan-tol') ? "active" : ""; ?> last dropdown-toggle default-color-r test" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" title="<?php echo lang('jalan-tol'); ?>"><?php echo lang('jalan-tol'); ?><span class="caret"></span></a>
							<ul class="dropdown-menu"><?php $jalan_tols = $this->menu->get_menu_jalantol(); ?>
							  <?php foreach($jalan_tols as $jalan_tol) { ?>
							  <li><a href="<?php echo site_url('konten/jalan-tol/' . $jalan_tol->slug); ?>" title="<?php echo $jalan_tol->name; ?>"><?php echo lang($jalan_tol->slug); ?></a></li>
							  	  <?php }?>
							  <li class="dropdown-submenu"><a href="#" class="test" title="progress"><?php echo lang('progress'); ?></a>	  
								  <?php $progresss = $this->menu->get_menu_progress(); ?>
								  <ul class="dropdown-menu">
										<?php foreach($progresss as $progress) { ?>
									    <li><a href="<?php echo site_url('konten/progress/' . $progress->slug); ?>" title="<?php echo $progress->name; ?>"><?php echo lang($progress->slug); ?></a></li>
										<?php }?>
								  </ul>
							  </li>
							  <li class="dropdown-submenu"><a class="test" href="#" title="monitoring">Monitoring</a>	  
								  <?php $monitorings = $this->menu->get_menu_monitoring(); ?>
								  <ul class="dropdown-menu">
										<?php foreach($monitorings as $monitoring) { ?>
									    <li><a href="<?php echo site_url('konten/monitoring/' . $monitoring->slug); ?>" title="<?php echo $monitoring->name; ?>"><?php echo lang($monitoring->slug); ?></a></li>
										<?php }?>
								  </ul>
							  </li>
							  <li class="dropdown-submenu"><a  class="test" href="#" title="SPM">SPM</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo site_url('spm'); ?>" title="<?php echo lang('spm'); ?>"><?php echo lang('spm'); ?></a></li>
										<li><a href="<?php echo site_url('konten/'.$ext.'spm/definisi-spm'); ?>" title="<?php echo lang('definisi-spm'); ?>"><?php echo lang('definisi-spm'); ?></a></li>
										<li><a href="<?php echo site_url('spm/rekapitulasi'); ?>" title="Rekapitulasi SPM"><?php echo lang('rekapitulasi-spm'); ?></a></li>
									</ul>
								</li>
							</ul>
						</li>
						
						<li><a class="<?php echo ($this->router->fetch_class() == 'spm' || ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'spm' && $this->uri->segment(4) == 'definisi-spm') || ($this->uri->segment(2) == 'spm' && $this->uri->segment(3) == 'definisi-spm')))) ? "active" : ""; ?> last dropdown-toggle default-color-r test" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" title="Produk"><?php echo lang('produk'); ?><span class="caret"></span></a>
							<ul class="dropdown-menu">
								
								<li><a href="http://gis.bpjt.pu.go.id/" target="_blank" title="<?php echo lang('gis-bpjt'); ?>"><?php echo lang('gis-bpjt'); ?></a></li>
								<li class="dropdown-submenu"><a class="test" href="#" title="<?php echo lang('peraturan'); ?>"><?php echo lang('peraturan'); ?></a>
									<ul class="dropdown-menu" style="display: block; width:130%;">
										<li><a href="<?php echo site_url('peraturan/undang-undang'); ?>" title="<?php echo lang('undang-undang'); ?>"><?php echo lang('undang-undang'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/peraturan-pemerintah'); ?>" title="<?php echo lang('peraturan-pemerintah'); ?>"><?php echo lang('peraturan-pemerintah'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/peraturan-presiden'); ?>" title="<?php echo lang('peraturan-presiden'); ?>"><?php echo lang('peraturan-presiden'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/peraturan-menteri'); ?>" title="<?php echo lang('peraturan-menteri'); ?>"><?php echo lang('peraturan-menteri'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/keputusan-menteri'); ?>" title="<?php echo lang('keputusan-menteri'); ?>"><?php echo lang('keputusan-menteri'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/keputusan-kepala-bpjt'); ?>" title="<?php echo lang('keputusan-kepala-bpjt'); ?>"><?php echo lang('keputusan-kepala-bpjt'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/keputusan-gubernur'); ?>" title="<?php echo lang('keputusan-gubernur'); ?>"><?php echo lang('keputusan-gubernur'); ?></a></li>
										<li><a href="<?php echo site_url('peraturan/lainnya'); ?>" title="<?php echo lang('lainnya'); ?>"><?php echo lang('lainnya'); ?></a></li>
										<li><a href="http://jdih.pu.go.id/" target="_blank" title="JDIH">JDIH</a></li>
									</ul>
								</li>
							</ul>
						</li>
						
						<!-- menu spm -- li class='dropdown'><a class="<?php echo ($this->router->fetch_class() == 'spm' || ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'spm' && $this->uri->segment(4) == 'definisi-spm') || ($this->uri->segment(2) == 'spm' && $this->uri->segment(3) == 'definisi-spm')))) ? "active" : ""; ?>dropdown-toggle default-color-r" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" title="SPM">SPM<span class="caret"></span></a>
							<ul class="dropdown-menu">
							  <li><a href="<?php echo site_url('spm'); ?>" title="SPM">SPM</a></li>
							  <li><a href="<?php echo site_url('konten/'.$ext.'spm/definisi-spm'); ?>" title="<?php echo lang('definisi-spm'); ?>"><?php echo lang('definisi-spm'); ?></a></li>
							  <li><a href="<?php echo site_url('spm/rekapitulasi'); ?>" title="Rekapitulasi SPM"><?php echo lang('rekapitulasi-spm'); ?></a></li>
							</ul>
						</li-->
						<!--li><a class="<?php echo ($this->router->fetch_class() == 'photo_galleries') ? "active" : ""; ?> last dropdown-toggle default-color-r test" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" title="<?php echo lang('galeri'); ?>"><?php echo lang('galeri'); ?><span class="caret"></span></a>
							<ul class="dropdown-menu">
							  <li class="dropdown"><a href="<?php echo site_url('galeri-foto'); ?>"><?php echo lang('galeri-foto'); ?></a><?php $photo_albums = $this->album->get_published_albums($this->session->userdata('lang'), 'photo', false); ?>
									<ul class="dropdown-menu">
									  <?php foreach($photo_albums as $photo_album) { ?>
									  <li><a href="<?php echo site_url('galeri-foto/album-foto/' . $photo_album->slug); ?>" title="<?php echo $photo_album->name; ?>"><?php echo $photo_album->name; ?></a></li>
									  <?php }?>
									</ul>
							  </li>
							  <li class="dropdown"><a href="<?php echo site_url('galeri-video'); ?>"><?php echo lang('galeri-video'); ?></a>
									<?php $video_albums = $this->album->get_published_albums($this->session->userdata('lang'), 'video', false); ?>
									<ul class="dropdown-menu">
									  <?php foreach($video_albums as $video_album) { ?>
									  <li><a href="<?php echo site_url('galeri-video/album-video/' . $video_album->slug); ?>" title="<?php echo $video_album->name; ?>"><?php echo $video_album->name; ?></a></li>
									  <?php }?>
									</ul>
							  </li>
							</ul>
						</li-->
						<li><a class="<?php echo ($this->router->fetch_class() == 'toll_roads' || ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'golongan-kendaraan') || ($this->uri->segment(2) == 'golongan-kendaraan')))) ? "active" : ""; ?>dropdown-toggle default-color-r" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" title="<?php echo lang('info-tarif-tol'); ?>"><?php echo lang('info-tarif-tol'); ?><span class="caret"></span></a>
							<ul class="dropdown-menu">
							  <li><a href="<?php echo site_url('tabel-tarif-tol'); ?>" title="<?php echo lang('tabel-tarif-tol'); ?>"><?php echo lang('tabel-tarif-tol'); ?></a></li>
							  <li><a href="<?php echo site_url('cek-tarif-tol'); ?>" title="<?php echo lang('cek-tarif-tol'); ?>"><?php echo lang('cek-tarif-tol'); ?></a></li>
							  <li><a href="<?php echo site_url('konten/'.$ext.'golongan-kendaraan'); ?>" title="<?php echo lang('golongan-kendaraan'); ?>"><?php echo lang('golongan-kendaraan'); ?></a></li>
							  <!--li><a href="<?php echo site_url('bpjt_api'); ?>" title="<?php echo lang('tarif-tol-navigasi'); ?>"><?php echo lang('tarif-tol-navigasi'); ?></a></li-->			
							</ul>
						</li>
						<!--li class="mudik" ><a href="<?php echo site_url('konten/'.$ext.'info-mudik'); ?>" title="<?php echo lang('info-mudik'); ?>" class="mudik"><?php echo lang('info-mudik'); ?></a>
						</li-->
					</ul>
                </div><!--/.nav-collapse -->
            </div> <!-- /,container-fluid -->
        </nav> <!-- /.nav -->

		<?php echo $content; ?>

		
        <footer>
<div class="container-fluid"><!-- Footer Link -->
<div id="footer-link">
<div class="row box"><!-- Profil -->
<div class="col-sm-3 hidden-xs">
<h4 class="footer-title"><?php echo lang('profil'); ?></h4>
	<ul id="contact-footer" class="list-unstyled social-media">
	<?php $profils = $this->menu->get_menu_profil(); ?>
		<?php foreach($profils as $profil) { ?>
		<li><a href="<?php echo site_url('konten/bpjt/' . $profil->slug); ?>"><?php echo lang($profil->slug); ?></a></li>
		<?php } ?>
		<li><a href="<?php echo site_url(); ?>konten/bpjt/faq"><?php echo lang('faq'); ?></a></li>
	</ul>
</div>
<div class="col-sm-3"><!-- BUJT investasi -->
<a href="<?php echo site_url(); ?>konten/bujt"><h4 class="footer-title"><?php echo lang('bujt');?></h4></a>
<br/>
<h4 class="footer-title"><?php echo lang('investasi'); ?></a></h4>	
	<ul id="contact-footer" class="list-unstyled social-media">
	<?php $invests = $this->menu->get_menu_invest(); ?>
		<?php foreach($invests as $invest) { ?>
		<li><a href="<?php echo site_url('konten/investasi/' . $invest->slug); ?>"><?php echo lang($invest->slug); ?></a></li>
		<?php } ?>
	</ul></br>
</div>
<!-- Gallery -->
<div class="col-sm-3">
<h4 class="footer-title"><?php echo lang('galeri'); ?></h4>	
	<ul id="contact-footer" class="list-unstyled social-media">
		<li><a href="<?php echo site_url(); ?>/galeri-foto"><?php echo lang('galeri-foto'); ?></a></li>
		<li><a href="https://www.youtube.com/c/PUPRBPJT"><?php echo lang('galeri-video'); ?></li>
		<li><a href="https://bpjt.pu.go.id/video_konstruksi/" target="_blank"><?php echo lang('galeri-video-drone'); ?></a></li>
	</ul>
<br/>
<h4 class="footer-title"><?php echo lang('navigasi'); ?></h4>	
	<ul id="contact-footer" class="list-unstyled social-media">
		<li><a href="https://eppid.pu.go.id/" target="_blank">e-PPID</a></li>
		<li><a href="http://jdih.pu.go.id/" target="_blank">JDIH</a></li>
		<li><a href="<?php echo site_url(); ?>/peta-situs"><?php echo lang('peta-situs'); ?></a></li>

	</ul><br/>
</div>
<!-- Kontak Kami -->
<div class="col-sm-3">
<h4 class="footer-title"><?php echo lang('kontak-kami'); ?>&nbsp;<i class="fa fa-envelope-o"></i></h4>
<ul class="list-unstyled social-media">
	<ul id="contact-footer" class="list-unstyled social-media">
		<li>Badan Pengatur Jalan Tol</li>
		<li>Gd. Binamarga Lt. 2-3, Jl. Pattimura No. 20 Kebayoran Baru</li>
		<li>Jakarta Selatan 12110</li>
	</ul>
	</ul>
	<img src="https://counter11.whocame.ovh/private/freecounterstat.php?c=cqqca8ut9use6rdcacmzx8u1qttrz3r5" border="0" title="website hit counter" alt="website hit counter">
	</div>
<!-- /.row --></div>
<!-- Copyright -->
<div id="copyright">
<div class="row">
<div class="col-sm-12">
<center>
<?php $footer = $this->content->get_content_by_paths_and_lang('footer', '', $this->session->userdata('lang')); ?>
    <?php if (empty($footer)) { ?>
	<p>Hak Cipta &copy; 2020 Badan Pengatur Jalan Tol (BPJT) | Kementerian Pekerjaan Umum Dan Perumahan Rakyat Republik Indonesia.</p>
	<?php } else { ?>
            <?php echo strip_tags($footer[0]->content, 'br')?>
    <?php } ?>
	</center>
</div>
</div>
<!-- /.row --></div>
</div>
<!-- /.container-fluid -->
</footer>

<div class="col-xs-12 hidden-md hidden-lg text-center">
    <a id="desktop-view" href="#">Lihat Versi Desktop</a>
</div>

<script>
    var targetWidth =2048; 
    $('#desktop-view').bind('click', function(e){ 
        $('meta[name="viewport"]').attr('content', 'width=' + targetWidth);
        e.preventDefault();
    });
</script>
       <!-- Back to Top -->
        <a id="back-to-top" href="#" class="btn back-to-top" title="Back to Top" data-toggle="tooltip" data-placement="left"><i class="fa fa-chevron-up fa-2x"></i></a>

<script>
$(document).ready(function(){
  $('.dropdown-menu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>   

        <script>
            $(document).ready(function () {
                
                $('.video-thumb').click(function () {
                    var srcvideo = $(this).data('video');
                    var youtubetitle = $(this).attr('data-title');

                    $('.video-thumb').attr('class', 'img-responsive video-thumb');
                    $(this).attr('class', 'img-responsive video-thumb active');
                    $('.youtube-video').fadeOut('fast').attr('src', srcvideo).fadeIn('fast');
                    $('.youtube-title').fadeOut('fast').text(youtubetitle).fadeIn('fast');
                });


                $('.thumb').click(function () {
                    var srcimg = $(this).attr('src');
                    var newsId = $(this).attr('data-id');
                    var newsContent = $('#news-content-' + newsId).html();
                    $('#news-content').html(newsContent);

                    $('.thumb').attr('class', 'img-responsive thumb');
                    $(this).attr('class', 'img-responsive thumb active');
                    $('.artikel-img').fadeOut('fast').attr('src', srcimg).fadeIn('fast');
                    $('.prettyPhoto').attr('href', srcimg);
                });

                // beranda-pusat.html
                // Membuat Berita Slider
                var currentIndex = 0,
                        items = $('#berita-slider .slider .container .slide'),
                        itemAmt = items.length;

                function cycleItems() {
                    var item = $('#berita-slider .slider .container .slide').eq(currentIndex);
                    items.hide();
                    item.css('display', 'inline-block');
                }

                var autoSlide = setInterval(function () {
                    currentIndex += 1;
                    if (currentIndex > itemAmt - 1) {
                        currentIndex = 0;
                    }
                    cycleItems();
                }, 5000);
                
                

                $('#berita-slider .slider .next').click(function () {
                    clearInterval(autoSlide);
                    currentIndex += 1;
                    if (currentIndex > itemAmt - 1) {
                        currentIndex = 0;
                    }
                    cycleItems();
                });

                $('#berita-slider .slider .prev').click(function () {
                    clearInterval(autoSlide);
                    currentIndex -= 1;
                    if (currentIndex < 0) {
                        currentIndex = itemAmt - 1;
                    }
                    cycleItems();
                });

            });

        </script>


        


<style>
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        background-color: rgba(,,, 1);
    }
    
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        background-color: rgba(,,, 1);
    }
    
    #topbar.container-fluid {
        background-color: rgba(,,, 1);
    }
    
    #kilas-berita.container-fluid {
        background-color: rgba(,,, 0.8);
    }
    
    #profil-artikel #accordionProfil .panel .panel-heading {
        background-color: rgba(,,, 1);
        border-color: rgba(,,, 1);
    }
    
    #profil-artikel #accordionBerita .panel .panel-heading {
        background-color: rgba(,,, 1);
        border-color: rgba(,,, 1);
    }
    
    footer #copyright .row {
        background-color: rgba(,,, 1);
    }
    
    li.dropdown a {
        color: rgba(,,, 1);
    }
    
    #collapse .panel-group > .panel-default > div.panel-heading:not(#headingLayanan) {
        background-color: rgba(,,, 1);
        border-color: rgba(,,, 1);
    }
    
    #collapse2 .title {
        background-color: rgba(,,, 1);
        border-color: rgba(,,, 1);
    }
    
    #lpse #lpse-table thead {
        background-color: rgba(,,, 0.7);
        
    }
    
    
    #search.container-fluid .saran a {
        color: rgba(,,, 0.7);
    }
    
    
    #search.container-fluid .btn-search {
        background-color: rgba(,,, 1);
    }
    
    #search.container-fluid .searchtext {
        color: rgba(,,, 0.7);
    }
    
    #artikel .artikel-body .title {
        color: rgba(,,, 0.7);
    }
    
    #artikel .artikel-body .subtitle {
        color: rgba(,,, 0.6);
    }
    
    .text-primary {
        color: rgba(,,, 0.8);
    }
    
    #profil-artikel #artikel .title {
        color: rgba(,,, 0.8);
    }
    
    .description a {
        color: rgba(,,, 0.8);
    }
    
    .galeri-heading a {
        color: rgba(,,, 0.8);
    }
    
    
    .berita-title a {
        color: rgba(,,, 0.8);
    }
    
    .panel-heading:not(#headingCapaian):not(#headingLayanan) h4.panel-title > a {
        color: #ffffff;
    }
    
    
    .fa-angle-double-right:before {
        color: #ffffff;
    }
    
    #profil-artikel #accordionProfil .subpanel .panel .panel-heading i {
        color: #ffffff;
    }
    
    .pagination>li>a, .pagination>li>span {
        color: rgba(,,, 0.8);
    }
    
</style>
<script>
    
    function hex2rgb(hex, opacity) {
        var h=hex.replace('#', '');
        h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

        for(var i=0; i<h.length; i++)
            h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

        if (typeof opacity != 'undefined')  h.push(opacity);

        return 'rgba('+h.join(',')+')';
}

    $(document).ready(function() {
        var custom_color = '';
        
        if(custom_color) {
            //$('.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover').css('background-color', hex2rgb('', 1));
            //$('.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover').css('border-color', hex2rgb('', 1));
            
            //$("#topbar.container-fluid").css('background-color', hex2rgb('', 1));
            //$('#kilas-berita.container-fluid').css('background-color', hex2rgb('', 0.8));
            
            //$('#profil-artikel #accordionProfil .panel .panel-heading').css('background-color', '');
            //$('#profil-artikel #accordionProfil .panel .panel-heading').css('border-color', '');
             
            //$('#profil-artikel #accordionBerita .panel > .panel-heading').first().css('background-color', '');
            //$('#profil-artikel #accordionBerita .panel > .panel-heading').first().css('border-color', '');
            
            //$('footer #copyright .row').css('background-color', '');
            //$('li.dropdown a').css('color', '');
            //$('#collapse .panel-group > .panel-default > div.panel-heading:not(#headingLayanan)').css('background-color', '');
            //$('#collapse .panel-group > .panel-default > div.panel-heading:not(#headingLayanan)').css('border-color', '');
            
            //$('#collapse2 .title').css('background-color', '');
            //$('#collapse2 .title').css('border-color', '');
            //$('#lpse #lpse-table thead').css('background-color', hex2rgb('', 0.7));
            
            //$('#search.container-fluid .saran a').css('color', hex2rgb('', 0.7));
            
            //$('#search.container-fluid .btn-search').css('background-color', hex2rgb('', 1));
            
            //$('#search.container-fluid .searchtext').css('color', hex2rgb('', 0.7));
            
            //$('#artikel .artikel-body .title').css('color', hex2rgb('', 0.7));
            
            //$('#artikel .artikel-body .subtitle').css('color', hex2rgb('', 0.6));
            
            //$('.text-primary').css('color', hex2rgb('', 0.8));
            
            //$('#profil-artikel #artikel .title').css('color', hex2rgb('', 0.8));
            
            //$('.description a').css('color', hex2rgb('', 0.8));
            //$('.galeri-heading a').css('color', hex2rgb('', 0.8));
            //$('.berita-title a').css('color', hex2rgb('', 0.8));
            //$('.panel-heading:not(#headingCapaian):not(#headingLayanan h4.panel-title > a').css('color', '#ffffff');
            
            
            //$('.fa-angle-double-right:before').css('color', '#ffffff');
            //$('#profil-artikel #accordionProfil .subpanel .panel .panel-heading i').css('color', '#ffffff');
            
            
            
            //$('.pagination>li>a, .pagination>li>span').css('color', hex2rgb('', 0.8));
           
            
}    
        });
        
        
        
        
        
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.customer-logos').slick({
				slidesToShow: 6,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 1000,
				arrows: false,
				dots: false,
					pauseOnHover: false,
					responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 4
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 3
					}
				}]
			});
		});
	</script>
	<script>

        $(document).ready(function () {
            $('.bxslider').bxSlider({
                pagerCustom: '#bx-pager',
                captions: true,
                auto: true,
                useCSS: false,
                autoControls: true,
                easing: 'easeInOutBack',
                speed: 2000
              });
        });

        $('.img-height').on('click', function () {
            var src = $(this).attr('src');
            $('.modal-body').find('img').attr('src', src);
            $('#myModal').modal('show');
        });
		
    </script>

	   <!--script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'd3df20d9-96f7-416c-828b-7302de1378c3', f: true }); done = true; } }; })();</script--></body>
</html>
