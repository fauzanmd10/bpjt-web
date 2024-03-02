<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
      <?php
        $accesses = $this->access->get_user_accesses_by_group($this->session->userdata('user_group_id'));
        $accesses = $this->access->reorganize_accesses($accesses);
      ?>
    	<li class="nav-header">Navigasi</li>
        
        <li class="dropdown">
                <a href="#"><span class="iconfa-file"></span>Dokumen Lelang</a>
			          <ul <?php //echo ($this->router->fetch_class() == 'lelangusers') ? "style='display:block;'" : ""; ?>>
                  <?php if ($accesses['lelangusers']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('auctions'); ?>" <?php echo ($this->router->fetch_class() == 'lelangusers') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>LELANG</a></li>
                  <?php } ?>

                  
                </ul>
              </li>
        
          <li class="dropdown <?php echo ($this->router->fetch_class() == 'lelangusers' ) ? "active" : ""; ?>">
          <a href="#"><span class="iconfa-user"></span> Peserta Lelang</a>
          <ul <?php echo ($this->router->fetch_class() == 'lelangusers') ? "style='display:block;'" : ""; ?>>
          <?php if ($accesses['lelangusers']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('auctions_list'); ?>" <?php echo ($this->router->fetch_class() == 'lelangusers') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Informasi Peserta</a></li>
                <?php } ?>
          </ul>
        </li>
       
    </ul>
</div><!--leftmenu-->
