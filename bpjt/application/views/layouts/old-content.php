<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>BPJT - Badan Pengatur Jalan Tol</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>assets/css/fonts.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/default.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/layout.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-nav.css" type="text/css" />
  <link rel="stylesheet" media="print" href="<?php echo base_url(); ?>assets/css/default-print.css" type="text/css" />
  <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>assets/js/vendor/iosslider/common.css" />
  <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>assets/js/vendor/shortslide/common.css" />
  <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>assets/css/signin.css" />

  <?php if (isset($stylesheets)) { ?>
    <?php foreach($stylesheets as $stylesheet) { ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $stylesheet; ?>">
    <?php } ?>
  <?php } ?>

  <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" /><![endif]-->

  <!--[if lt IE 9]>
  		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->
  <!-- Favicons -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
  <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png">
</head>
<body>
  <div id="wrapper">
    <div id="wrapper-inside">

      <p class="back-top" style="display: none;">
        <a href="#top">
          <span></span>
          <?php echo lang('kembali-ke-atas'); ?>
        </a>
      </p>

      <div id="header">
      <!-- Menu Atas -->
      <section class="menuatas main-section">
        <!-- container -->
        <div class="container">
          <div class="eight columns">
            <nav class="top-menu1">
              <ul>
                <li><a href="<?php echo site_url('peta-situs'); ?>" title="<?php echo lang('peta-situs'); ?>"><?php echo lang('peta-situs'); ?></a></li>
                <!-- <li><a href="#" title="<?php //echo lang('situs-terkait'); ?>"><?php //echo lang('situs-terkait'); ?></a></li> -->
                <li><a href="<?php echo site_url('kontak'); ?>" title="<?php echo lang('kontak'); ?>"><?php echo lang('kontak'); ?></a></li>
                <!-- <li><a href="" title="<?php //echo lang('bantuan'); ?>"><?php //echo lang('bantuan'); ?></a></li> -->
              </ul>
            </nav>
          </div>
      
          <!-- end ten -->
          <?php $lang = $this->session->userdata('lang'); ?>
          <div class="five columns">
            <div id="box-kanan">
              <div id="date">
                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/tanggal.js"></script>
              </div>
              <div id="language">
                <a href="<?php echo site_url('/home/set_lang/id'); ?>" title="Indonesia" class="id"><span <?php echo ($lang == 'id') ? "class='selected'" : ""; ?>>Indonesia</span></a>
                <a href="<?php echo site_url('/home/set_lang/en'); ?>" title="English" class="en"><span <?php echo ($lang == 'en') ? "class='selected'" : ""; ?>>English</span></a>
              </div>
            </div>
          </div>

          <!-- end five -->
          <div class="one columns alpha">
            <div class="login-right">
              <a href="login" class="signin"><span><?php echo lang('masuk'); ?></span></a> 
              <fieldset id="signin_menu">
                <?php echo form_open('admin/home/processing', array('id'=>'login')); ?>
                  <p>
                    <label for="username"><?php echo lang('nama-pengguna'); ?></label>
                    <input id="username" name="username" value="" title="username" tabindex="4" type="text" placeholder="<?php echo lang('nama-pengguna'); ?>">
                  </p>
                  <p>
                    <label for="password"><?php echo lang('kata-kunci'); ?></label>
                    <input id="password" name="password" value="" title="password" tabindex="5" type="password" placeholder="<?php echo lang('kata-kunci'); ?>">
                  </p>
                  <p class="remember">
                    <input id="signin_submit" value="<?php echo lang('MASUK'); ?>" tabindex="6" type="submit">
                    <!-- <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
                    <label for="remember">Ingat Aku</label> -->
                  </p>
                  <!-- <p class="forgot"> <a href="#" id="resend_password_link">Lupa Kata Kunci?</a> </p>
                  <p class="forgot-username"> <A id=forgot_username_link 
                    title="If you remember your password, try logging in with your email" 
                    href="#">Lupa Nama Pengguna?</A> </p> -->
                <?php echo form_close(); ?>
              </fieldset>
            </div>               
          </div>
        </div>
        <!-- end container -->
      </section>
      <!-- end menuatas -->
      
      <!-- logo nad tagline -->
      <section class="logo main-section">
        <!-- container -->
        <div class="container">
          <div class="sixteen columns">
            <!-- logo wrapper -->
            <div class="logo-wrapper"> 
              <a href="<?php echo site_url('/'); ?>" title="BPJT - Badan Pengatur Jalan Tol"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Logo"/></a>
              <!-- tagline -->
              <span></span> 
            </div>
            <!-- end logo wrapper -->
            <!-- tagline -->
            <div class="tagline"> <img src="<?php echo base_url(); ?>assets/images/ad.png" alt="Tagline" /> </div>
            <!-- end tagline -->
          </div>
          <!-- end sixteen -->
        </div>
        <!-- end container -->
      </section>
      <!-- end logo -->
	  	  
      <!-- navigation -->
      <div class="container bg-menu">
        

        <a class="toggleMenu" style="color: rgb(255, 255, 255);" href="#">Buka Menu</a>
        <?php
          $ext = "";
          if ($lang == 'en') {
            $ext = "en/";
          }
        ?>
        <ul class="nav">
          <li><a class="<?php echo ($this->router->fetch_class() == 'home') ? "active" : ""; ?> iconhome mobile" href="<?php echo site_url('/'); ?>" title="<?php echo lang('home'); ?>"><?php echo lang('home'); ?></a></li>
          <?php
            $collections = $this->menu->get_parsedtree_menus();
            $this->menu->print_frontend_menu($collections);
          ?>
          <!-- <li><a class="<?php //echo ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'bpjt' && ($this->uri->segment(4) == 'sekilas-bpjt' || $this->uri->segment(4) == 'visi-misi' || $this->uri->segment(4) == 'struktur-organisasi' || $this->uri->segment(4) == 'tugas-bpjt')) || ($this->uri->segment(2) == 'bpjt' && ($this->uri->segment(3) == 'sekilas-bpjt' || $this->uri->segment(3) == 'visi-misi' || $this->uri->segment(3) == 'struktur-organisasi' || $this->uri->segment(3) == 'tugas-bpjt')))) ? "active" : ""; ?>" href="#" title="BPJT">BPJT</a>
            <ul>
              <li><a href="<?php //echo site_url('konten/'.$ext.'bpjt/sekilas-bpjt'); ?>" title="<?php //echo lang('sekilas-bpjt'); ?>"><?php //echo lang('sekilas-bpjt'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'bpjt/visi-misi'); ?>" title="<?php //echo lang('visi-misi'); ?>"><?php //echo lang('visi-misi'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'bpjt/struktur-organisasi'); ?>" title="<?php //echo lang('struktur-organisasi'); ?>"><?php //echo lang('struktur-organisasi'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'bpjt/tugas-bpjt'); ?>" title="tugas-bpjt"><?php //echo lang('tugas-bpjt'); ?></a></li>
            </ul>
          </li> -->
          <!-- <li><a class="<?php //echo ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'jalan-tol' && ($this->uri->segment(4) == 'sejarah' || $this->uri->segment(4) == 'tujuan-manfaat' || $this->uri->segment(4) == 'kebijakan-percepatan-pembangunan' || $this->uri->segment(4) == 'nama-ruas-tol' || $this->uri->segment(4) == 'trafik-pengguna')) || ($this->uri->segment(2) == 'jalan-tol' && ($this->uri->segment(3) == 'sejarah' || $this->uri->segment(3) == 'tujuan-manfaat' || $this->uri->segment(3) == 'kebijakan-percepatan-pembangunan' || $this->uri->segment(3) == 'nama-ruas-tol' || $this->uri->segment(3) == 'trafik-pengguna')))) ? "active" : ""; ?>" href="#" title="<?php echo lang('jalan-tol'); ?>"><?php echo lang('jalan-tol'); ?></a>
            <ul>
              <li><a href="<?php //echo site_url('konten/'.$ext.'jalan-tol/sejarah'); ?>" title="<?php //echo lang('sejarah'); ?>"><?php //echo lang('sejarah'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'jalan-tol/tujuan-manfaat'); ?>" title="<?php //echo lang('tujuan-manfaat'); ?>"><?php //echo lang('tujuan-manfaat'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'jalan-tol/kebijakan-percepatan-pembangunan'); ?>" title="<?php //echo lang('kebijakan-percepatan-pembangunan'); ?>"><?php //echo lang('kebijakan-percepatan-pembangunan'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/jalan-tol/nama-ruas-tol'); ?>" title="<?php //echo lang('nama-ruas-tol'); ?>"><?php //echo lang('nama-ruas-tol'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/jalan-tol/trafik-pengguna'); ?>" title="<?php //echo lang('trafik-pengguna'); ?>"><?php //echo lang('trafik-pengguna'); ?></a></li>
            </ul>
          </li> -->
          <li>
            <a class="<?php echo ($this->router->fetch_class() == 'spm' || ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'spm' && $this->uri->segment(4) == 'definisi-spm') || ($this->uri->segment(2) == 'spm' && $this->uri->segment(3) == 'definisi-spm')))) ? "active" : ""; ?>" href="#" title="SPM">SPM</a>
            <ul>
              <li><a href="<?php echo site_url('spm'); ?>" title="SPM">SPM</a></li>
              <li><a href="<?php echo site_url('konten/'.$ext.'spm/definisi-spm'); ?>" title="<?php echo lang('definisi-spm'); ?>"><?php echo lang('definisi-spm'); ?></a></li>
              <li><a href="<?php echo site_url('spm/rekapitulasi'); ?>" title="Rekapitulasi SPM"><?php echo lang('rekapitulasi-spm'); ?></a></li>
            </ul>
            <!--
            <ul>
              <li><a href="#" title="Kondisi Jalan Tol">Kondisi Jalan Tol</a></li>
              <li><a href="#" title="Kecepatan Tempuh Rata-Rata">Kecepatan Tempuh Rata-Rata</a></li>
              <li><a href="#" title="Aksesbilitas">Aksesibilitas</a></li>
              <li><a href="#" title="Mobilitas">Mobilitas</a></li>
              <li><a href="#" title="Keselamatan">Keselamatan</a></li>
              <li><a href="#" title="Pertolongan Pertama">Pertolongan Pertama</a></li>
            </ul>
            -->
          </li>
          <!-- <li><a class="<?php //echo ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'bujt') || ($this->uri->segment(2) == 'bujt'))) ? "active" : ""; ?>" href="<?php //echo site_url('konten/'.$ext.'bujt'); ?>" title="BUJT">BUJT</a></li> -->
          <li>
            <a class="<?php echo ($this->router->fetch_class() == 'toll_roads' || ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'golongan-kendaraan') || ($this->uri->segment(2) == 'golongan-kendaraan')))) ? "active" : ""; ?>" href="#" title="<?php echo lang('info-tarif-tol'); ?>"><?php echo lang('info-tarif-tol'); ?></a>
            <ul>
              <li><a href="<?php echo site_url('info-tarif-tol'); ?>" title="<?php echo lang('info-tarif-tol'); ?>"><?php echo lang('info-tarif-tol'); ?></a></li>
              <li><a href="<?php echo site_url('konten/'.$ext.'golongan-kendaraan'); ?>" title="<?php echo lang('golongan-kendaraan'); ?>"><?php echo lang('golongan-kendaraan'); ?></a></li>
            </ul>
          </li>
          <!-- <li><a class="<?php //echo ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'investasi' && ($this->uri->segment(4) == 'prinsip-penyelenggaraan' || $this->uri->segment(4) == 'skema-investasi' || $this->uri->segment(4) == 'tahapan-makro-pengusahaan-jalan-tol' || $this->uri->segment(4) == 'prosedur-investasi')) || ($this->uri->segment(2) == 'investasi' && ($this->uri->segment(3) == 'prinsip-penyelenggaraan' || $this->uri->segment(3) == 'skema-investasi' || $this->uri->segment(3) == 'tahapan-makro-pengusahaan-jalan-tol' || $this->uri->segment(3) == 'prosedur-investasi')))) ? "active" : ""; ?>" href="#" title="Investasi"><?php echo lang('investasi'); ?></a>
            <ul>
              <li><a href="<?php //echo site_url('konten/'.$ext.'investasi/prinsip-penyelenggaraan'); ?>" title="<?php //echo lang('prinsip-penyelenggaraan'); ?>"><?php //echo lang('prinsip-penyelenggaraan'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'investasi/skema-investasi'); ?>" title="<?php //echo lang('skema-investasi'); ?>"><?php //echo lang('skema-investasi'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'investasi/tahapan-makro-pengusahaan-jalan-tol'); ?>" title="<?php //echo lang('tahapan-makro-pengusahaan-jalan-tol'); ?>"><?php //echo lang('tahapan-makro-pengusahaan-jalan-tol'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'investasi/prosedur-investasi'); ?>" title="<?php //echo lang('prosedur-investasi'); ?>"><?php //echo lang('prosedur-investasi'); ?></a></li>
            </ul>
          </li> -->
          <!-- <li><a class="<?php //echo ($this->router->fetch_class() == 'contents' && (($this->uri->segment(2) == 'en' && $this->uri->segment(3) == 'progress-pembangunan' && ($this->uri->segment(4) == 'progress' || $this->uri->segment(4) == 'beroperasi' || $this->uri->segment(4) == 'jalan-tol-ppjt' || $this->uri->segment(4) == 'tender-tender')) || ($this->uri->segment(2) == 'progress-pembangunan' && ($this->uri->segment(3) == 'progress' || $this->uri->segment(3) == 'beroperasi' || $this->uri->segment(3) == 'jalan-tol-ppjt' || $this->uri->segment(3) == 'tender-tender')))) ? "active" : ""; ?>" href="#" title="<?php echo lang('progress'); ?>"><?php echo lang('progress'); ?></a>
            <ul>
              <li><a href="<?php //echo site_url('konten/progress-pembangunan/rencana'); ?>" title="Rencana">Rencana</a></li>
              <li><a href="<?php //echo site_url('konten/progress-pembangunan/ruas-tol'); ?>" title="Ruas Tol">Ruas Tol</a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'progress-pembangunan/progress'); ?>" title="<?php //echo lang('progress'); ?>"><?php //echo lang('progress'); ?></a>
                <ul>
                  <li><a href="" title="Pilih Status Pembangunan">Pilih Status Pembangunan</a></li>
                </ul>
              </li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'progress-pembangunan/beroperasi'); ?>" title="<?php //echo lang('beroperasi'); ?>"><?php //echo lang('beroperasi'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'progress-pembangunan/jalan-tol-ppjt'); ?>" title="<?php //echo lang('jalan-tol-ppjt'); ?>"><?php //echo lang('jalan-tol-ppjt'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/'.$ext.'progress-pembangunan/tender-tender'); ?>" title="<?php //echo lang('tender-tender'); ?>"><?php //echo lang('tender-tender'); ?></a></li>
              <li><a href="<?php //echo site_url('konten/progress-pembangunan/persiapan-tender'); ?>" title="Persiapan Tender">Persiapan Tender</a>
                <ul>
                  <li><a href="" title="<?php //echo lang('peluang-investasi'); ?>"><?php //echo lang('peluang-investasi'); ?></a></li>
                </ul>
              </li>
            </ul>
          </li> -->
          <li><a href="#" title="<?php echo lang('gis-bpjt'); ?>"><?php echo lang('gis-bpjt'); ?></a>
            <ul>
              <li><a href="<?php echo site_url('/gis'); ?>" target="_blank" title="<?php echo lang('gis-bpjt'); ?>"><?php echo lang('gis-bpjt'); ?></a></li>
            </ul>
          </li>
          <li><a class="<?php echo ($this->router->fetch_class() == 'regulations') ? "active" : ""; ?>" href="<?php echo site_url('peraturan'); ?>" title="<?php echo lang('peraturan'); ?>"><?php echo lang('peraturan'); ?></a>
            <ul>
              <li><a href="<?php echo site_url('peraturan/undang-undang'); ?>" title="<?php echo lang('undang-undang'); ?>"><?php echo lang('undang-undang'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/peraturan-pemerintah'); ?>" title="<?php echo lang('peraturan-pemerintah'); ?>"><?php echo lang('peraturan-pemerintah'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/peraturan-presiden'); ?>" title="<?php echo lang('peraturan-presiden'); ?>"><?php echo lang('peraturan-presiden'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/peraturan-menteri'); ?>" title="<?php echo lang('peraturan-menteri'); ?>"><?php echo lang('peraturan-menteri'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/keputusan-menteri'); ?>" title="<?php echo lang('keputusan-menteri'); ?>"><?php echo lang('keputusan-menteri'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/keputusan-kepala-bpjt'); ?>" title="<?php echo lang('keputusan-kepala-bpjt'); ?>"><?php echo lang('keputusan-kepala-bpjt'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/keputusan-gubernur'); ?>" title="<?php echo lang('keputusan-gubernur'); ?>"><?php echo lang('keputusan-gubernur'); ?></a></li>
              <li><a href="<?php echo site_url('peraturan/lainnya'); ?>" title="<?php echo lang('lainnya'); ?>"><?php echo lang('lainnya'); ?></a></li>
            </ul>
          </li>
          <li><a class="<?php echo ($this->router->fetch_class() == 'photo_galleries') ? "active" : ""; ?> last" href="#" title="<?php echo lang('galeri'); ?>"><?php echo lang('galeri'); ?></a>
            <ul>
              <li>
                <a href="#"><?php echo lang('galeri-foto'); ?></a>
                <?php $photo_albums = $this->album->get_published_albums($this->session->userdata('lang'), 'photo', false); ?>
                <ul>
                  <?php foreach($photo_albums as $photo_album) { ?>
                  <li><a href="<?php echo site_url('galeri-foto/album-foto/' . $photo_album->slug); ?>" title="<?php echo $photo_album->name; ?>"><?php echo $photo_album->name; ?></a></li>
                  <?php }?>
                </ul>
              </li>
              <li>
                <a href="#"><?php echo lang('galeri-video'); ?></a>
                <?php $video_albums = $this->album->get_published_albums($this->session->userdata('lang'), 'video', false); ?>
                <ul>
                  <?php foreach($video_albums as $video_album) { ?>
                  <li><a href="<?php echo site_url('galeri-video/album-video/' . $video_album->slug); ?>" title="<?php echo $video_album->name; ?>"><?php echo $video_album->name; ?></a></li>
                  <?php }?>
                </ul>
              </li>
            </ul>
          </li>
          <li><a class="<?php echo ($this->router->fetch_class() == 'articles') ? "active" : ""; ?>" href="<?php echo site_url('berita'); ?>" title="<?php echo lang('index-berita'); ?>"><?php echo lang('index-berita'); ?></a></li>
        </ul>
      </div>
      <!-- End Navigaton-->
      </div>
	
      <?php echo $content; ?>

  <!-- footer -->
  <footer class="footer main-section">
    <!-- widgets -->
    <div class="widgets">
      <!-- widget-container -->
      <div class="widgets-container container">
       
        <div class="sixteen columns">
          <!-- single widget -->
          <div class="widget col300">
            <div class="header">
              <h4><?php echo lang('tentang-kami'); ?></h4>
            </div>
            <div class="widget-content">
              <p class="ratakiri">
                <?php $tentang_kami = $this->content->get_content_by_paths_and_lang('tentang-kami', '', $this->session->userdata('lang')); ?>
                <?php if (empty($tentang_kami)) { ?>
                Badan Pengatur Jalan Tol (BPJT) adalah badan yang berwenang untuk melaksanakan sebagian penyelenggaraan jalan tol meliputi pengaturan, pengusahaan dan pengawasan Badan Usaha Jalan Tol.
                <?php } else { ?>
                <?php echo strip_tags($tentang_kami[0]->content); ?>
                <?php } ?>
              </p>
            </div>
          </div>
          <!-- end single widget -->
          <!-- single widget -->
          <div class="widget col300">
            <div class="header">
              <h4><?php echo lang('syarat-ketentuan'); ?></h4>
            </div>
            <!-- Latest -->
            <div class="widget-content">
              <!-- tweets -->
              <div>
                <div>
                  <p class="ratakiri">
                    <?php $syarat_ketentuan = $this->content->get_content_by_paths_and_lang('syarat-ketentuan', '', $this->session->userdata('lang')); ?>
                    <?php if (empty($syarat_ketentuan)) { ?>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                    <?php } else { ?>
                    <?php echo strip_tags($syarat_ketentuan[0]->content); ?>
                    <?php } ?>
                  </p>
                </div>
             
              </div>
              <!-- end tweets -->
            </div>
            <!-- end widget content -->
          </div>
          <!-- end single widget -->
          <!-- single widget [galeri] -->
          <div class="widget col300">
            <div class="header">
              <h4><?php echo lang('galeri-photo'); ?></h4>
            </div>
            <!-- widget content -->
            <div class="widget-content">
              <!-- galeri -->
              <div class="galeri-photo">
                <?php foreach($galleries as $gallery) { ?>
                <div class="photo"><a href="<?php echo site_url('galeri-foto/album-foto/' . $gallery->album_slug . '/show/' . create_slug($gallery->title) . '/' . $gallery->id); ?>"><img src="<?php echo $this->media->get_image_by_style($gallery->url, 'sq57'); ?>" alt="" width="57" height="57" /></a></div>
                <?php } ?>
              </div>
              <!-- end galeri -->
            </div>
            <!-- end widget content -->
          </div>
          <!-- end single widget -->
        </div>
        <!-- end sixteen -->
      </div>
      <!-- end widgets container -->
    </div>
    <!-- end widgets -->
    
     <div class="widgets1"></div>
    <!-- copyrights -->
    <div class="copyrights container">
     
      <!-- right -->
      <div class="sixteen columns">
        <p>
          <span class="tengah">
            <?php $footer = $this->content->get_content_by_paths_and_lang('footer', '', $this->session->userdata('lang')); ?>
            <?php if (empty($footer)) { ?>
            Copyright © 2016 Badan Pengatur Jalan Tol (BPJT)
            <br/>
            Jl. Pattimura 20, Kebayoran Baru Jakarta Selatan 12110
            <?php } else { ?>
            <?php echo strip_tags($footer[0]->content, 'br')?>
            <?php } ?>
          </span>
        </p>
      </div>
      <!-- end right -->
    </div>
    <!-- end copyrights -->
  </footer>
  <!-- end footer -->
  </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/plugins.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/flex-slider-min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/fe-custom.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/init.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.li-scroller.1.0.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.modern-ticker.min.js"></script>
  <!-- shortslide -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/shortslide/_js/common.js"></script>
  <!-- iosSlider plugin -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/iosslider/_src/jquery.iosslider.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/script.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.leanModal.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.tipsy.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/video.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/application/content.js" type="text/javascript"></script>

  <?php if (isset($jscripts)) { ?>
    <?php foreach($jscripts as $key => $value) { ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script> 
    <?php } ?>
  <?php } ?>
</body>
</html>

<div id="signup">
  <div id="signup-ct">
    <div id="signup-header">
      <h2>Masuk</h2>
      <a class="modal_close" href="#"></a>
    </div>
  
    <?php echo form_open('admin/home/processing', array('id'=>'login')); ?>
      <div class="txt-fld">
        <label for="">Username</label>
        <input id="" class="good_input" name="username" type="text" />
      </div>

      <div class="txt-fld">
        <label for="">Password</label>
        <input id="" name="password" type="password" />
      </div>

      <div class="btn-fld">
        <button type="submit">Masuk</button>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
