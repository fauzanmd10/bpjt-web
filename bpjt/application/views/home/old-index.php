<!-- container -->
  <div class="container">
    <div class="sixteen columns1">
      <div class = 'fluidHeight'>
          
        <div class = 'sliderContainer'>
          <!-- <div class="overlay"></div> -->
          <div class = 'iosSlider'>
          
            <div class = 'slider'>
              <?php 
                $item = 1; 
                foreach($headlines as $headline) {
              ?>
              <div class = 'item item<?php echo $item; ?>'>
                  <div class = 'inner'>
                    <!--<img src="<?php //echo base_url(); ?>assets/images/sliders/iosslider/2-b.png"/>-->
                    <img src="<?php echo $this->media->get_image_by_style($headline->image, 'fx960'); ?>"/>
                    <div class = 'kategori'><p class="title"><?php echo $headline->category_name; ?> / <?php echo $headline->sub_category_name; ?></p></div>
                    <div class = 'text1'>
                      <div><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><?php echo $headline->title; ?></a></div>
                      <div class ='date'><span class="date"><?php echo print_formatted_date($headline->created_at); ?></span><span class="white">| By <?php echo $headline->username; ?></span></div>
                    </div>   
                    <div class = 'text2'>
                      <span><?php echo $headline->excerpt; ?></span>
                      <div class="morebut"><a href="<?php echo site_url('berita/' . $headline->slug); ?>"><?php echo lang('selengkapnya'); ?></a></div>
                    </div>
                  </div>
              </div>
              <?php 
                  $item++;
                } 
              ?>                    
            </div> 
             
          </div>
              
          <div class = 'slideSelectors'>
            <?php 
              $item = 1; 
              foreach($headlines as $headline) {
            ?>
            <div class='item <?php echo ($item == 1) ? "selected" : ""; ?>'>
                <ul class="iosslider-item-list">
                    <li <?php echo ($item == 1) ? "class='first'" : ""; ?>>
                      <i class="iosslider-item-simg1"><img src="<?php echo $this->media->get_image_by_style($headline->image, 'sq54'); ?>" width="54" height="54" /></i>
                      <strong><a href="#"><?php echo $headline->title; ?></a></strong>
                    </li>
                </ul>
            </div>
            <?php
                $item++;
              }
            ?>
          </div>
        </div>
      </div>  
    </div>
  </div>
  <!-- end container -->

  <!-- page content -->
  <section class="page-content main-section">
    <div class="container running-text">
      <div class="left-side eleven columns">
        <div class="ticker1 modern-ticker mticker-round">
          <div class="mticker-label"><?php echo lang('pengumuman'); ?><span class="total-news"><?php echo count($newstickers); ?></span></div>
            <div class="mticker-news">
              <?php if (!empty($newstickers)) { ?>
              <ul>
                <?php foreach($newstickers as $newsticker) {
                $text=$newsticker->content;
				?>
                <li><p><span><?php echo print_casual_date($newsticker->created_at); ?></span><?php echo strip_tags($text,'<a>'); ?></p></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
            <div class="mticker-controls">
              <div class="mticker-prev"></div>
              <div class="mticker-play"></div>
              <div class="mticker-next"></div>
            </div>
          </div>
        </div>
        <div class="right-side five columns">
          <!-- single widget -->
          <div class="widget">
            <div class="widget-content">
              <?php echo form_open('search', array('method'=>'get', 'class'=>'searchform')); ?>
                <input type="text" class="s" required="required" name="keyword" placeholder="<?php echo lang('cari'); ?>">
                <input type="submit" value="" class="submit search-icon" />
              <?php echo form_close(); ?>
            </div>
            <!-- end widget content -->
          </div>
          <!-- end widget -->
        </div> 
      </div>

      <!-- container -->
      <div class="container bg">
        <div class="sixteen columns">
          <!-- box 284 column -->
          <div class="box284 grid-blog style-featured">
            <!-- grids -->
            <div class="grids">
              <!-- sinlge -post -->
              
              <div class="single-post">
                
                <div class="meta">
                  <h4><a href="<?php echo site_url('/gis'); ?>" target="_blank" title="<?php echo lang('gis-bpjt'); ?>"><?php echo lang('gis-bpjt-long'); ?></a></h4>
                </div>
                <div class="image"><a href="<?php echo site_url('/gis'); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/map.png" alt="" title="<?php echo lang('gis-bpjt'); ?>"/></a></div>
              </div>
              <!-- end single post -->
              <!-- sinlge -post -->
              <div class="single-post">
                
                <div class="meta">
                  <h4><a href="<?php echo site_url('spm'); ?>" title="<?php echo lang('standar-pelayanan-minimal'); ?>"><?php echo lang('standar-pelayanan-minimal'); ?></a></h4>
                </div>
                <div class="image"><a href="<?php echo site_url('spm'); ?>"><img src="<?php echo base_url(); ?>assets/images/spm.png" alt="" title="<?php echo lang('standar-pelayanan-minimal'); ?>"/></a></div>
              </div>
              <!-- end single post -->
              <!-- sinlge -post -->
              <div class="single-post">
                <?php $lang = $this->session->userdata('lang'); ?>
                <?php
                  $ext = "";
                  if ($lang == 'en') {
                    $ext = "en/";
                  }
                ?>
                <div class="meta">
                  <h4><a href="<?php echo site_url('konten/'.$ext.'bujt'); ?>" title="<?php echo lang('bujt-long'); ?>"><?php echo lang('bujt-long'); ?></a></h4>
                </div>
                <div class="image"><a href="<?php echo site_url('konten/'.$ext.'bujt'); ?>"><img src="<?php echo base_url(); ?>assets/images/bujt.png" alt="" title="<?php echo lang('bujt-long'); ?>" /></a></div>
              </div>
              <!-- end single post -->
              
              <div class="single-post">  
                <div class="meta">
                  <h4><a href="http://jasamargalive.com" target="_blank" title="CCTV">CCTV</a></h4>
                </div>
                <div class="image"><a href="http://jasamargalive.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/cctv.png" alt="" title="CCTV"/></a></div>
              </div>
              <!-- end single post -->
              
              <!-- sinlge -post -->
              <div class="single-post">
                <div class="meta">
                  <h4><a href="<?php echo (empty($documents)) ? '#' : $documents[0]->url; ?>" title="<?php echo lang('peluang-investasi'); ?>" target="_blank"><?php echo lang('peluang-investasi'); ?></a></h4>
                </div>
                <div class="image"><a href="<?php echo (empty($documents)) ? '#' : $documents[0]->url; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/peluanginvestasi.png" alt="" title="<?php echo lang('peluang-investasi'); ?>" /></a></div>
              </div>
              <!-- end single post -->
              
              <!-- sinlge -post -->
              <div class="single-post">    
                <div class="meta">
                  <h4><a href="http://www.pu.go.id/saran" target="_blank" title="<?php echo lang('saran-pengaduan'); ?>"><?php echo lang('saran-pengaduan'); ?></a></h4>
                </div>
                <div class="image"><a href="http://www.pu.go.id/saran" target="_blank"><img src="<?php echo base_url(); ?>assets/images/saran-pengaduan.png" alt="" title="<?php echo lang('saran-pengaduan'); ?>" /></a></div>
              </div>
              <!-- end single post -->
              
            </div>
            <!-- end grids -->
          </div>
          <!-- end box 284 -->            
      </div>
    </div>
  </section>
  <!-- end page content -->
<div class="container bg">
  <div class="offset-by-one fourteen columns">
      <!-- customer/partners logos -->    
     <div class="home-cplogoes-section">
              
        <div class="section-box">
        <i class="titles-icon6"></i>
        <h2><?php echo lang('situs-terkait'); ?></h2>
                   
                 
           <div class = 'short-width-slider-3'>
      
            <div class = 'slider'>
              <?php if (empty($sites)) { ?>          
              <div class = 'item' id = '1'>
                  <div class="freshwork-img-box"><a href="http://www.pu.go.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/logo-pu.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '2'>
                  <div class="freshwork-img-box"><a href="http://www.jasamarga.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jasamarga.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '3'>
                  <div class="freshwork-img-box"><a href="http://www.jlj.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jlj.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '4'>
                  <div class="freshwork-img-box"><a href="http://www.transmargajateng.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/tmj.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '5'>
                  <div class="freshwork-img-box"><a href="http://id.citramarga.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/citramarga.png" alt="" /></a></div>
              </div>
               <div class = 'item' id = '6'>
                  <div class="freshwork-img-box"><a href="http://www.nusantarainfrastructure.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/nusantara.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '7'>
                  <div class="freshwork-img-box"><a href="http://www.jasa-sarana.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/jasasarana.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '8'>
                  <div class="freshwork-img-box"><a href="http://www.mtn.co.id" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/mtn.png" alt="" /></a></div>
              </div>
              <div class = 'item' id = '9'>
                  <div class="freshwork-img-box"><a href="http://www.mtdcap.com" target="_blank"><img src="<?php echo base_url(); ?>assets/images/situsterkait/mtd.png" alt="" /></a></div>
              </div>
              <?php } else { ?>
                <?php foreach($sites as $site) { ?>
                <?php $logo = $this->content->get_content_meta($site->id, 'logo');?>
                  <?php if (!empty($logo)) { ?>
                  <div class = 'item' id = '<?php echo $site->id; ?>'>
                      <div class="freshwork-img-box">
                        <a href="<?php echo $site->content; ?>" target="_blank">
                          <img src="<?php echo $logo[0]->meta_value; ?>" alt="" width="58" />
                        </a>
                    </div>
                  </div>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
           </div>
          
          <div class = 'forum-bpjt' style="float:right;margin-top:20px;"><a href="http://bpjt.pu.go.id/kc" target="_blank">Forum BPJT</a></div>
          <div class = 'prev'></div>
          <div class = 'next'></div>
         </div>
      </div>
      </div><!-- end customer/partners logos -->
  </div>
</div>