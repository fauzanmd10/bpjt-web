<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
      <?php
        $accesses = $this->access->get_user_accesses_by_group($this->session->userdata('user_group_id'));
        $accesses = $this->access->reorganize_accesses($accesses);
      ?>
    	<li class="nav-header">Navigasi</li>
        
      <li class="dropdown <?php echo ($this->router->fetch_class() == 'lelangdoc' ) ? "active" : ""; ?>">
        <a href="#"><span class="iconfa-file"></span>Dokumen Lelang</a>
        <ul <?php echo ($this->router->fetch_class() == 'lelangdoc') ? "style='display:block;'" : ""; ?>>
          <?php if ($accesses['lelangusers']['single'] == 1) { ?>
          <li><a href="<?php echo site_url('auctions'); ?>?id_ruas=85" <?php echo ($this->router->fetch_class() == 'lelangdoc') && $this->input->get('id_ruas') == 85 ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>LELANG GAETACIM</a></li>
          <li><a href="<?php echo site_url('auctions'); ?>?id_ruas=63" <?php echo ($this->router->fetch_class() == 'lelangdoc') && $this->input->get('id_ruas') == 63 ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>LELANG GILMENG</a></li>
          <?php } ?>                  
        </ul>
      </li>
        
      <li class="dropdown <?php echo ($this->router->fetch_class() == 'lelangs' ) ? "active" : ""; ?>">
        <a href="#"><span class="iconfa-user"></span> Peserta Lelang</a>
        <ul <?php echo ($this->router->fetch_class() == 'lelangs') ? "style='display:block;'" : ""; ?>>
        <?php if ($accesses['lelangusers']['single'] == 1) { ?>
              <li><a href="<?php echo site_url('auctions_list'); ?>?id_ruas=85" <?php echo ($this->router->fetch_class() == 'lelangs') && $this->input->get('id_ruas') == 85 ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Informasi Peserta GAETACIM</a></li>
              <li><a href="<?php echo site_url('auctions_list'); ?>?id_ruas=63" <?php echo ($this->router->fetch_class() == 'lelangs') && $this->input->get('id_ruas') == 63 ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Informasi Peserta GILMENG</a></li>
              <?php } ?>
        </ul>
      </li>
       
    </ul>
</div><!--leftmenu-->
