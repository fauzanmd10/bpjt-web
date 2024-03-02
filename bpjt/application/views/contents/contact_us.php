<div class="container shadow-bottom-menu">
</div>

<!-- page content -->
<section class="page-content main-section">
  <!-- container -->
  <div class="container">
    <!-- sixteen -->
    <div class="fifteen columns  row">
      <!-- section -->
      <div class="section">
        <!-- header -->
        <div class="header">
          <h3><?php echo lang('lokasi-kami'); ?></h3>
          <span></span> </div>
        <!-- end header -->
        <!-- page content -->
        <div class="page-content">
         <!-- map -->
          <div class="map">
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.id/maps?f=q&amp;source=s_q&amp;hl=id&amp;geocode=&amp;q=kementerian+pekerjaan+umum&amp;aq=&amp;sll=-6.229746,106.829518&amp;sspn=0.357677,0.617294&amp;ie=UTF8&amp;hq=kementerian+pekerjaan+umum&amp;hnear=&amp;ll=-6.236573,106.801406&amp;spn=0.001397,0.002411&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=17207105523959024476&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.id/maps?f=q&amp;source=embed&amp;hl=id&amp;geocode=&amp;q=kementerian+pekerjaan+umum&amp;aq=&amp;sll=-6.229746,106.829518&amp;sspn=0.357677,0.617294&amp;ie=UTF8&amp;hq=kementerian+pekerjaan+umum&amp;hnear=&amp;ll=-6.236573,106.801406&amp;spn=0.001397,0.002411&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=17207105523959024476" style="color:#0000FF;text-align:left">Lihat Peta Lebih Besar</a></small>iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.id/maps?f=q&amp;source=s_q&amp;hl=id&amp;geocode=&amp;q=kementerian+pekerjaan+umum&amp;aq=&amp;sll=-6.229746,106.829518&amp;sspn=0.357677,0.617294&amp;ie=UTF8&amp;hq=kementerian+pekerjaan+umum&amp;hnear=&amp;ll=-6.236573,106.801406&amp;spn=0.001397,0.002411&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=17207105523959024476&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.id/maps?f=q&amp;source=embed&amp;hl=id&amp;geocode=&amp;q=kementerian+pekerjaan+umum&amp;aq=&amp;sll=-6.229746,106.829518&amp;sspn=0.357677,0.617294&amp;ie=UTF8&amp;hq=kementerian+pekerjaan+umum&amp;hnear=&amp;ll=-6.236573,106.801406&amp;spn=0.001397,0.002411&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=17207105523959024476" style="color:#0000FF;text-align:left">Lihat Peta Lebih Besar</a></small>
             
            <br />
          </div>
          <!-- end map -->
          <!-- margin -->
          <div class="margin"></div>
          <!-- contact info -->
          <div class="five columns">
            <!-- header -->
            <div class="header">
              <h3><?php echo lang('lokasi-kami'); ?></h3>
              <span></span> </div>
            <!-- end header -->
            <!-- content -->
            <div class="content">
              <?php $alamat = $this->content->get_content_by_paths_and_lang('alamat', '', 'id'); ?>
              <?php if (!empty($alamat)) { ?>
                <?php if ($alamat[0]->content != "") { ?>
              <p><?php echo $alamat[0]->content; ?></p>
                <?php } ?>
              <?php } ?>
              <div class="margin-half"></div>

              <?php $phone = $this->content->get_content_by_paths_and_lang('telepon', '', 'id'); ?>
              <?php if (!empty($phone)) { ?>
                <?php if ($phone[0]->content != "") { ?>
              <!--  list -->
              <div class="list-doc">
                <ul>
                  <li>
                    <p><img alt="" src="<?php echo base_url(); ?>assets/images/phone.png">  <?php echo strip_tags($phone[0]->content); ?></p>
                  </li>
                </ul>
              </div>
              <!-- end list -->
                <?php } ?>
              <?php } ?>

              <?php $fax = $this->content->get_content_by_paths_and_lang('fax', '', 'id'); ?>
              <?php if (!empty($fax)) { ?>
                <?php if ($fax[0]->content != "") { ?>
              <!-- phone list -->
              <div class="list-phone">
                <ul>
                  <li>
                    <p><img alt="" src="<?php echo base_url(); ?>assets/images/fax.png">  <?php echo strip_tags($fax[0]->content); ?></p>
                  </li>
                </ul>
              </div>
              <!-- end phone list -->
                <?php } ?>
              <?php } ?>

              <?php $email = $this->content->get_content_by_paths_and_lang('email', '', 'id'); ?>
              <?php if (!empty($email)) { ?>
                <?php if ($email[0]->content != "") { ?>
              <!-- email list -->
              <div class="list-email">
                <ul>
                  <li>
                    <p><img alt="" src="<?php echo base_url(); ?>assets/images/email-kontak.png">  <?php echo strip_tags($email[0]->content); ?></p>
                  </li>
                </ul>
              </div>
              <!-- end email list -->
                <?php } ?>
              <?php } ?>
            </div>
            <!-- end content -->
          </div>
          <!-- end contact info -->
          
        </div>
        <!-- end page content -->
      </div>
      <!-- end section -->
    </div>
    <!-- end sixteen -->
  </div>
  <!-- end container -->
</section>
<!-- end page content -->