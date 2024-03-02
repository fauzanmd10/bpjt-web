<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
      <?php
        $accesses = $this->access->get_user_accesses_by_group($this->session->userdata('user_group_id'));
        $accesses = $this->access->reorganize_accesses($accesses);
      ?>
    	<li class="nav-header">Navigasi</li>
        <li <?php echo ($this->router->fetch_class() == 'dashboard') ? "class='active'" : ''; ?>>
          <a href="<?php echo site_url('admin/dashboard'); ?>"><span class="iconfa-laptop"></span> Dashboard</a>
        </li>
        <li><a href="<?php echo site_url('/'); ?>" target="_blank"><span class="iconfa-globe"></span> Website</a></li>
        
        <?php if ($accesses['knowledge_center']['single'] == 1) { ?>
        <li><a href="<?php echo site_url('kc'); ?>" target="_blank"><span class="iconfa-file"></span> Knowledge Center</a></li>
        <?php } ?>

        <?php
          $route_check = true;
          if ($this->router->fetch_class() == 'contents') {
            $content_type = $this->uri->segment(2);
            $sub_content_type = $this->uri->segment(3);
            $menu = $this->menu->get_menu_by_slug($content_type);
            $sub_menu = $this->menu->get_menu_by_slug($sub_content_type);
            if (empty($menu) && empty($sub_menu)) {
              $route_check = false;
            } 
          } else {
            $route_check = false;
          }
        ?>

        <li class="dropdown <?php echo ($route_check || $this->router->fetch_class() == 'menus' || $this->router->fetch_class() == 'articles' || $this->router->fetch_class() == 'announcements' || $this->router->fetch_class() == 'article_categories' || $this->router->fetch_class() == 'article_sub_categories' || $this->router->fetch_class() == 'contents' || $this->router->fetch_class() == 'spm_classifications' || $this->router->fetch_class() == 'spm' || $this->router->fetch_class() == 'spm_reports' || $this->router->fetch_class() == 'spm_scores' || $this->router->fetch_class() == 'spm_score_remarks' || $this->router->fetch_class() == 'toll_roads' || $this->router->fetch_class() == 'toll_gates' || $this->router->fetch_class() == 'toll_tariffs' || $this->router->fetch_class() == 'vehicle_groups' || $this->router->fetch_class() == 'regulations' || $this->router->fetch_class() == 'comments') ? "active" : ''; ?>">
          <a href="#"><span class="iconfa-file"></span>Menu Utama</a>
          <ul <?php echo ($this->router->fetch_class() == 'menus' || $this->router->fetch_class() == 'articles' || $this->router->fetch_class() == 'announcements' || $this->router->fetch_class() == 'article_categories' || $this->router->fetch_class() == 'article_sub_categories' || $this->router->fetch_class() == 'contents' || $this->router->fetch_class() == 'spm_classifications' || $this->router->fetch_class() == 'spm' || $this->router->fetch_class() == 'spm_reports' || $this->router->fetch_class() == 'spm_scores' || $this->router->fetch_class() == 'spm_score_remarks' || $this->router->fetch_class() == 'toll_roads' || $this->router->fetch_class() == 'toll_gates' || $this->router->fetch_class() == 'toll_tariffs' || $this->router->fetch_class() == 'vehicle_groups' || $this->router->fetch_class() == 'regulations' || $this->router->fetch_class() == 'comments') ? "style='display:block;'" : ''; ?>>
              <li class="dropdown"><a href="#">Artikel</a>
                  <ul <?php echo ($this->router->fetch_class() == 'articles' || $this->router->fetch_class() == 'announcements' || $this->router->fetch_class() == 'article_categories' || $this->router->fetch_class() == 'article_sub_categories') ? "style='display:block;'" : ''; ?>>
                      <?php if ($accesses['artikel_berita']['single'] == 1) { ?>
                      <li><a href="<?php echo site_url('admin/articles'); ?>" <?php echo ($this->router->fetch_class() == 'articles') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Berita</a></li>
                      <?php } ?>

                      <?php if ($accesses['artikel_pengumuman']['single'] == 1) { ?>
                      <li><a href="<?php echo site_url('admin/announcements'); ?>" <?php echo ($this->router->fetch_class() == 'announcements') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Pengumuman</a></li>
                      <?php } ?>

                      <?php if ($accesses['artikel_kategori_berita']['single'] == 1) { ?>
                      <li><a href="<?php echo site_url('admin/article_categories'); ?>" <?php echo ($this->router->fetch_class() == 'article_categories') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Kategori Berita</a></li>
                      <?php } ?>

                      <?php if ($accesses['artikel_sub_kategori_berita']['single'] == 1) { ?>
                      <li><a href="<?php echo site_url('admin/article_sub_categories'); ?>" <?php echo ($this->router->fetch_class() == 'article_sub_categories') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Sub Kategori Berita</a></li>
                      <?php } ?>
                  </ul>
              </li>

              <?php if ($accesses['konten_dinamis']['single'] == 1) { ?>
              <li class="dropdown">
                <a href="#">Konten Dinamis</a>
                <ul <?php echo ($this->router->fetch_class() == 'menus' || $route_check) ? "style='display:block;'" : ""; ?>>
                  <li><a href="<?php echo site_url('admin/menus') ;?>" <?php echo ($this->router->fetch_class() == 'menus') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Menu</a></li>
                  <?php 
                    $collections = $this->menu->get_parsedtree_menus();
                    $this->menu->print_admin_menu($collections);
                  ?>
                </ul>
              </li>
              <?php } ?>
              <!-- <li class="dropdown">
                <a href="#">BPJT</a>
                <ul <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bpjt') ? "style='display:block;'" : ""; ?>>
                  <li><a href="<?php //echo site_url('admin/contents/bpjt/sekilas-bpjt'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bpjt' && $this->uri->segment(4) == 'sekilas-bpjt') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Sekilas BPJT</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/bpjt/visi-misi'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bpjt' && $this->uri->segment(4) == 'visi-misi') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Visi dan Misi</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/bpjt/struktur-organisasi'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bpjt' && $this->uri->segment(4) == 'struktur-organisasi') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Struktur Organisasi</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/bpjt/tugas-bpjt'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bpjt' && $this->uri->segment(4) == 'tugas-bpjt') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tugas BPJT</a></li>
                </ul>
              </li> -->
              <!-- <li class="dropdown">
                <a href="#">Jalan Tol</a>
                <ul <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol') ? "style='display:block;'" : ""; ?>>
                  <li><a href="<?php //echo site_url('admin/contents/jalan-tol/sejarah'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol' && $this->uri->segment(4) == 'sejarah') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Sejarah</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/jalan-tol/tujuan-manfaat'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol' && $this->uri->segment(4) == 'tujuan-manfaat') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tujuan dan Manfaat</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/jalan-tol/kebijakan-percepatan-pembangunan'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol' && $this->uri->segment(4) == 'kebijakan-percepatan-pembangunan') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Kebijakan Percepatan Pembangunan</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/jalan-tol/nama-ruas-tol'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol' && $this->uri->segment(4) == 'nama-ruas-tol') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Nama Ruas Tol</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/jalan-tol/trafik-pengguna'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'jalan-tol' && $this->uri->segment(4) == 'trafik-pengguna') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Trafik Pengguna</a></li>
                </ul>
              </li> -->
              <li class="dropdown">
                <a href="#">SPM</a>
			          <ul <?php echo ($this->router->fetch_class() == 'spm' || $this->router->fetch_class() == 'spm_reports' || $this->router->fetch_class() == 'spm_classifications' || $this->router->fetch_class() == 'spm_scores' || $this->router->fetch_class() == 'spm_score_remarks' || $this->router->fetch_class() == 'spm_recpas' || ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'spm' && $this->uri->segment(4) == 'definisi-spm')) ? "style='display:block;'" : ""; ?>>
                  <?php //if ($accesses['spm_klasifikasi']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm'); ?>" <?php echo ($this->router->fetch_class() == 'spm') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>SPM</a></li>
                  <?php //} ?>

                  <?php //if ($accesses['spm_klasifikasi']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm_reports'); ?>" <?php echo ($this->router->fetch_class() == 'spm_reports') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Laporan SPM</a></li>
                  <?php //} ?>

                  <?php if ($accesses['spm_klasifikasi']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm_classifications'); ?>" <?php echo ($this->router->fetch_class() == 'spm_classifications') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Klasifikasi</a></li>
                  <?php } ?>

                  <?php if ($accesses['spm_penilaian']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm_scores'); ?>" <?php echo ($this->router->fetch_class() == 'spm_scores') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Penilaian</a></li>
                  <?php } ?>

                  <?php if ($accesses['spm_keterangan_penilaian']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm_score_remarks'); ?>" <?php echo ($this->router->fetch_class() == 'spm_score_remarks') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Keterangan Penilaian</a></li>
                  <?php } ?>

                  <?php if ($accesses['spm_keterangan_definisi']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/spm/definisi-spm'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'spm' && $this->uri->segment(4) == 'definisi-spm') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Definisi SPM</a></li>
                  <?php } ?>

                  <?php if ($accesses['spm_keterangan_rekapitulasi']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/spm_recaps'); ?>" <?php echo ($this->router->fetch_class() == 'spm_recaps') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Rekapitulasi SPM</a></li>
                  <?php } ?>
                </ul>
              </li>
              <!-- <li><a href="<?php //echo site_url('admin/contents/bujt'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'bujt') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>BUJT</a></li> -->
              <li class="dropdown">
                <a href="#">Info Tarif Tol</a>
                <ul <?php echo ($this->router->fetch_class() == 'toll_roads' || $this->router->fetch_class() == 'toll_gates' || $this->router->fetch_class() == 'toll_tariffs' || $this->router->fetch_class() == 'vehicle_groups' || ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'golongan-kendaraan')) ? "style='display:block;'" : ""; ?>>
                  <?php if ($accesses['info_tarif_tol_konten']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/golongan-kendaraan'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'golongan-kendaraan') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Konten Golongan Kendaraan</a></li>
                  <?php } ?>

                  <?php if ($accesses['info_tarif_tol_golongan_kendaraan']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/vehicle_groups'); ?>" <?php echo ($this->router->fetch_class() == 'vehicle_groups') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Golongan Kendaraan</a></li>
                  <?php } ?>

                  <?php if ($accesses['info_tarif_tol_ruas_tol']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/toll_roads'); ?>" <?php echo ($this->router->fetch_class() == 'toll_roads') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Ruas Jalan Tol</a></li>
                  <?php } ?>

                  <?php if ($accesses['info_tarif_tol_gerbang_tol']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/toll_gates'); ?>" <?php echo ($this->router->fetch_class() == 'toll_gates') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Gerbang Tol</a></li>
                  <?php } ?>

                  <?php if ($accesses['info_tarif_tol']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/toll_tariffs'); ?>" <?php echo ($this->router->fetch_class() == 'toll_tariffs') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tarif Tol</a></li>
                  <?php } ?>
                </ul>
              </li>
              <!-- <li class="dropdown">
                <a href="#">Investasi</a>
                <ul <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'investasi') ? "style='display:block;'" : ""; ?>>
                  <li><a href="<?php //echo site_url('admin/contents/investasi/prinsip-penyelenggaraan'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'investasi' && $this->uri->segment(4) == 'prinsip-penyelenggaraan') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Prinsip Penyelenggaraan</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/investasi/skema-investasi'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'investasi' && $this->uri->segment(4) == 'skema-investasi') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Skema Investasi</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/investasi/tahapan-makro-pengusahaan-jalan-tol'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'investasi' && $this->uri->segment(4) == 'tahapan-makro-pengusahaan-jalan-tol') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tahapan Makro Pengusahaan Jalan Tol</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/investasi/prosedur-investasi'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'investasi' && $this->uri->segment(4) == 'prosedur-investasi') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Prosedur Investasi</a></li>
                </ul>
              </li> -->
              <!-- <li class="dropdown">
                <a href="#">Progress</a>
                <ul <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan') ? "style='display:block;'" : ""; ?>>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/rencana'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'rencana') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Rencana</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/ruas-tol'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'ruas-tol') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Ruas Tol</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/progress'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'progress') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Progress</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/beroperasi'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'beroperasi') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Beroperasi</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/jalan-tol-ppjt'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'jalan-tol-ppjt') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Jalan Tol PPJT</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/tender-tender'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'tender-tender') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tender-Tender</a></li>
                  <li><a href="<?php //echo site_url('admin/contents/progress-pembangunan/persiapan-tender'); ?>" <?php //echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(3) == 'progress-pembangunan' && $this->uri->segment(4) == 'persiapan-tender') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Persiapan Tender</a></li>
                </ul>
              </li> -->
              <?php if ($accesses['peraturan']['single'] == 1) { ?>
              <li><a href="<?php echo site_url('admin/regulations'); ?>" <?php echo ($this->router->fetch_class() == 'regulations') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Peraturan</a></li>
              <?php } ?>

              <li class="dropdown">
                <a href="#">Pengaturan Konten Statis</a>
                <ul <?php echo ($this->router->fetch_class() == 'contents' && ($this->uri->segment(4) == 'syarat-ketentuan' || $this->uri->segment(4) == 'tentang-kami' || $this->uri->segment(4) == 'footer' || $this->uri->segment(4) == 'telepon' || $this->uri->segment(4) == 'fax' || $this->uri->segment(4) == 'email' || $this->uri->segment(4) == 'alamat')) ? "style='display:block'" : ""; ?>>
                  <?php if ($accesses['konten_statis_syarat_ketentuan']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/syarat-ketentuan'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'syarat-ketentuan') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Kamus &amp; Istilah</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_tentang_kami']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/tentang-kami'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'tentang-kami') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Tentang Kami</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_footer']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/footer'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'footer') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Footer</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_telepon']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/telepon'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'telepon') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Telepon</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_fax']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/fax'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'fax') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Fax</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_email']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/email'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'email') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Email</a></li>
                  <?php } ?>

                  <?php if ($accesses['konten_statis_alamat']['single'] == 1) { ?>
                  <li><a href="<?php echo site_url('admin/contents/cms/alamat'); ?>" <?php echo ($this->router->fetch_class() == 'contents' && $this->uri->segment(4) == 'alamat') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Alamat</a></li>
                  <?php } ?>
                </ul>
              </li>
              <li>
                <a href="<?php echo site_url('admin/cctv'); ?>">CCTV</a>
              </li>
              <li>
                <a href="<?php echo site_url('admin/banner'); ?>">Banner</a>
              </li>
              <!--<li><a href="#">Publikasi</a></li>
              <li><a href="<?php //echo site_url('admin/comments'); ?>" <?php //echo ($this->router->fetch_class() == 'comments') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Komentar</a></li>-->
          </ul>
        </li>
        <!--
        <li class="dropdown"><a href="#"><span class="iconfa-upload"></span> Upload/Download</a>
            <ul>
                  <li><a href="#">SPM</a></li>
                  <li><a href="#">Publikasi</a></li>
                  <li><a href="#">Peraturan</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#"><span class="iconfa-folder-open"></span> Direktori</a>
            <ul>
                  <li><a href="#">Karyawan</a></li>
                  <li><a href="#">Mitra Kerja</a></li>
                  <li><a href="#">Kementerian RI</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#"><span class="iconfa-star-empty"></span> IDE</a>
            <ul>
                  <li><a href="#">Bidang Teknik</a></li>
                  <li><a href="#">Bidang Investasi</a></li>
                  <li><a href="#">Bidang Pengawasan dan Pemantauan</a></li>
                  <li><a href="#">Bidang Umum</a></li>
                  <li><a href="#">Bidang Pendanaan</a></li>
                  <li><a href="#">Lainnya</a></li>
            </ul>
        </li>
        -->
        <!--<li><a href="#"><span class="iconfa-comment-alt"></span> Forum</a></li>-->
        <!--
        <li class="dropdown"><a href="#"><span class="iconfa-edit"></span> Rapat</a>
            <ul>
              <li><a href="#">Agenda Rapat</a></li>
              <li><a href="#">Download Notulen [PDF]</a></li>
            </ul>
        </li>
        -->
        <?php if ($accesses['situs_terkait']['single'] == 1) { ?>
        <li <?php echo ($this->router->fetch_class() == "sites") ? 'class="active"' : ""; ?>>
          <a href="<?php echo site_url('admin/sites'); ?>"><span class="iconfa-link"></span> Situs Terkait</a>
        </li>
        <?php } ?>

        <li class="dropdown <?php echo ($this->router->fetch_class() == 'photo_albums' || $this->router->fetch_class() == 'video_albums' || $this->router->fetch_class() == 'photo_galleries' || $this->router->fetch_class() == 'video_galleries') ? "active" : ""; ?>"><a href="#"><span class="iconfa-picture"></span> Galeri</a>
          <ul <?php echo ($this->router->fetch_class() == 'photo_albums' || $this->router->fetch_class() == 'video_albums' || $this->router->fetch_class() == 'photo_galleries' || $this->router->fetch_class() == 'video_galleries') ? "style='display:block;'" : ""; ?>>
            <?php if ($accesses['album_foto']['single'] == 1 || $accesses['galeri_foto']['single'] == 1) { ?>
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'photo_albums' || $this->router->fetch_class() == 'photo_galleries') ? "active" : ""; ?>">
              <a href="#">Galeri Foto</a>
              <ul <?php echo ($this->router->fetch_class() == 'photo_albums' || $this->router->fetch_class() == 'photo_galleries') ? "style='display:block;'" : ""; ?>>
                <?php if ($accesses['album_foto']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/photo_albums'); ?>" <?php echo ($this->router->fetch_class() == 'photo_albums') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Album Foto</a></li>
                <?php } ?>

                <?php if ($accesses['galeri_foto']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/photo_galleries'); ?>" <?php echo ($this->router->fetch_class() == 'photo_galleries') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Galeri Foto</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>

            <?php if ($accesses['album_video']['single'] == 1 || $accesses['galeri_video']['single'] == 1) { ?>
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'video_albums' || $this->router->fetch_class() == 'video_galleries') ? "active" : ""; ?>">
              <a href="#">Galeri Video</a>
              <ul <?php echo ($this->router->fetch_class() == 'video_albums' || $this->router->fetch_class() == 'video_galleries') ? "style='display:block;'" : ""; ?>>
                <?php if ($accesses['album_video']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/video_albums'); ?>" <?php echo ($this->router->fetch_class() == 'video_albums') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Album Video</a></li>
                <?php } ?>

                <?php if ($accesses['galeri_video']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/video_galleries'); ?>" <?php echo ($this->router->fetch_class() == 'video_galleries') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Galeri Video</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </li>

        <?php if ($accesses['peluang_investasi']['single'] == 1) { ?>
        <li <?php echo ($this->router->fetch_class() == 'investment_opportunities') ? "class='active'" : ""; ?>>
          <a href="<?php echo site_url('admin/investment_opportunities'); ?>"><span class="iconfa-file"></span> Peluang Investasi</a>
        </li>
        <?php } ?>
        <!--
        <li class="dropdown"><a href="#"><span class="iconfa-file"></span> Dokumen Internal</a>
            <ul>
              <li><a href="#">Bidang Teknik [ PDF download ]</a></li>
              <li><a href="#">Bidang Investasi [ PDF download ]</a></li>
              <li><a href="#">Bidang Pengawasan dan Pemantauan [ PDF download ]</a></li>
              <li><a href="#">Bidang Umum [ PDF download ]</a></li>
              <li><a href="#">Bidang Pendanaan [ PDF download ]</a></li>
              <li><a href="#">Lainnya [ PDF download ]</a></li>
            </ul>
        </li>
        -->
        <!--<li><a href="#"><span class="iconfa-comments"></span> Jajak Pendapat</a></li>-->
        <?php if ($accesses['kalender_rapat']['single'] == 1) { ?>
        <li <?php echo ($this->router->fetch_class() == 'calendars') ? "class='active'" : ""; ?>>
          <a href="<?php echo site_url('admin/calendars'); ?>"><span class="iconfa-calendar"></span> Kalender Rapat</a>
        </li>
        <?php } ?>
        <!--<li><a href="#"><span class="iconfa-thumbs-up"></span> Penghargaan</a></li>-->
        <!--<li><a href="#"><span class="iconfa-book"></span> Majalah Digital</a></li>-->
        <?php if ($accesses['log']['single'] == 1) { ?>
        <li <?php echo ($this->router->fetch_class() == 'user_logs') ? "class='active'" : ""; ?>>
          <a href="<?php echo site_url('admin/user_logs'); ?>"><span class="iconfa-user"></span> User Log</a>
        </li>
        <?php } ?>

        <li class="dropdown <?php echo ($this->router->fetch_class() == 'constructions' || $this->router->fetch_class() == 'bujts' || $this->router->fetch_class() == 'constructing_toll_roads' || $this->router->fetch_class() == 'toll_road_sections') ? "class='active'" : ""; ?>">
          <a href="#"><span class="iconfa-user"></span> Progres Konstruksi</a>
          <ul <?php echo ($this->router->fetch_class() == 'constructions' || $this->router->fetch_class() == 'bujts' || $this->router->fetch_class() == 'constructing_toll_roads' || $this->router->fetch_class() == 'toll_road_sections') ? "style='display:block;'" : ""; ?>>
            <?php if ($accesses['progres_konstruksi_daftar_bujt']['single'] == 1) { ?>
            <li><a href="<?php echo site_url('admin/bujts'); ?>" <?php echo ($this->router->fetch_class() == 'bujts') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Daftar BUJT</a></li>
            <?php } ?>

            <?php if ($accesses['progres_konstruksi_ruas_tol']['single'] == 1) { ?>
            <li><a href="<?php echo site_url('admin/constructing_toll_roads'); ?>" <?php echo ($this->router->fetch_class() == 'constructing_toll_roads') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Ruas Tol</a></li>
            <?php } ?>

            <?php if ($accesses['progres_konstruksi_segment_ruas_tol']['single'] == 1) { ?>
            <li><a href="<?php echo site_url('admin/toll_road_sections'); ?>" <?php echo ($this->router->fetch_class() == 'toll_road_sections') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Segment Ruas Tol</a></li>
            <?php } ?>

            <?php if ($accesses['progres_konstruksi']['single'] == 1) { ?>
            <li><a href="<?php echo site_url('admin/constructions'); ?>" <?php echo ($this->router->fetch_class() == 'constructions') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Progres Konstruksi</a></li>
            <?php } ?>
          </ul>
        </li>
        <li class="dropdown <?php echo ($this->router->fetch_class() == 'employees' || $this->router->fetch_class() == 'provinces' || $this->router->fetch_class() == 'districts' || $this->router->fetch_class() == 'subdistricts' || $this->router->fetch_class() == 'instances' || $this->router->fetch_class() == 'merk_types' || $this->router->fetch_class() == 'inventory_types' || $this->router->fetch_class() == 'buildings' || $this->router->fetch_class() == 'building_rooms' || $this->router->fetch_class() == 'inventories' || $this->router->fetch_class() == 'applied_inventories' || $this->router->fetch_class() == 'measurements') ? "active" : ""; ?>">
          <a href="#"><span class="iconfa-desktop"></span> Sistem Informasi</a>
          <ul <?php echo ($this->router->fetch_class() == 'employees' || $this->router->fetch_class() == 'provinces' || $this->router->fetch_class() == 'districts' || $this->router->fetch_class() == 'subdistricts' || $this->router->fetch_class() == 'instances' || $this->router->fetch_class() == 'merk_types' || $this->router->fetch_class() == 'inventory_types' || $this->router->fetch_class() == 'buildings' || $this->router->fetch_class() == 'building_rooms' || $this->router->fetch_class() == 'inventories' || $this->router->fetch_class() == 'applied_inventories' || $this->router->fetch_class() == 'measurements') ? "style='display:block;'" : ""; ?>>
    				<li class="dropdown"><a href="#">Kepegawaian</a>
    					<ul <?php echo ($this->router->fetch_class() == 'employees' || $this->router->fetch_class() == 'provinces' || $this->router->fetch_class() == 'districts' || $this->router->fetch_class() == 'subdistricts') ? "style='display:block;'" : ""; ?>>
                <?php if ($accesses['kepegawaian_sistem_informasi_kepegawaian']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/employees'); ?>" <?php echo ($this->router->fetch_class() == 'employees') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Sistem Informasi Kepegawaian</a></li>
                <?php } ?>

                <?php if ($accesses['kepegawaian_propinsi']['single'] == 1) { ?>
    						<li><a href="<?php echo site_url('admin/provinces'); ?>" <?php echo ($this->router->fetch_class() == 'provinces') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Propinsi</a></li>
                <?php } ?>

                <?php if ($accesses['kepegawaian_kecamatan']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/districts'); ?>" <?php echo ($this->router->fetch_class() == 'districts') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Kota / Kabupaten</a></li>
                <?php } ?>

                <?php if ($accesses['kepegawaian_kabupaten']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/subdistricts'); ?>" <?php echo ($this->router->fetch_class() == 'subdistricts') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Kecamatan</a></li>
                <?php } ?>
              </ul>
    				</li>	
            <li class="dropdown"><a href="#">Manajemen Aset</a>
              <ul <?php echo ($this->router->fetch_class() == 'instances' || $this->router->fetch_class() == 'merk_types' || $this->router->fetch_class() == 'inventory_types' || $this->router->fetch_class() == 'buildings' || $this->router->fetch_class() == 'building_rooms' || $this->router->fetch_class() == 'inventories' || $this->router->fetch_class() == 'applied_inventories' || $this->router->fetch_class() == 'measurements') ? "style='display:block;'" : ""; ?>>
                <?php if ($accesses['manajemen_aset_instansi']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/instances'); ?>" <?php echo ($this->router->fetch_class() == 'instances') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Instansi</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_jenis_merk']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/merk_types'); ?>" <?php echo ($this->router->fetch_class() == 'merk_types') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Jenis Merk</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_jenis_inventaris']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/inventory_types'); ?>" <?php echo ($this->router->fetch_class() == 'inventory_types') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Jenis Inventaris</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_satuan_ukur']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/measurements'); ?>" <?php echo ($this->router->fetch_class() == 'measurements') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Satuan Ukur</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_bangunan']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/buildings'); ?>" <?php echo ($this->router->fetch_class() == 'buildings') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Bangunan</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_ruang_bangunan']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/building_rooms'); ?>" <?php echo ($this->router->fetch_class() == 'building_rooms') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Ruang Bangunan</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_inventaris']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/inventories'); ?>" <?php echo ($this->router->fetch_class() == 'inventories') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Inventaris</a></li>
                <?php } ?>

                <?php if ($accesses['manajemen_aset_inventaris_bangunan']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/applied_inventories'); ?>" <?php echo ($this->router->fetch_class() == 'applied_inventories') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Inventaris Ruangan</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php if ($accesses['perkantoran']['single'] == 1) { ?>
            <li><a href="http://10.10.100.100/perkantoran-bpjt" target="_blank">Perkantoran</a></li>
            <?php } ?>
			      <!-- <li><a href="#">Database</a></li> 
            <li><a href="#">Aset Manajemen</a></li>-->
          </ul> 
        </li>
        <li class="dropdown <?php echo ($this->router->fetch_class() == 'user_groups' || $this->router->fetch_class() == 'user_accesses' || $this->router->fetch_class() == 'users') ? "active" : ""; ?>">
          <a href="#"><span class="iconfa-cogs"></span>Pengaturan</a>
          <ul <?php echo ($this->router->fetch_class() == 'user_groups' || $this->router->fetch_class() == 'user_accesses' || $this->router->fetch_class() == 'users') ? "style='display:block;'" : ""; ?>>
            <li class="dropdown">
              <a href="#">Pengguna</a>
              <ul <?php echo ($this->router->fetch_class() == 'user_groups' || $this->router->fetch_class() == 'user_accesses' || $this->router->fetch_class() == 'users') ? "style='display:block;'" : ""; ?>>
                <?php if ($accesses['pengguna_grup_pengguna']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/user_groups'); ?>" <?php echo ($this->router->fetch_class() == 'user_groups') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Grup Pengguna</a></li>
                <?php } ?>

                <?php if ($accesses['hak_akses_pengguna']['single'] == 1) { ?>
                <li><a href="<?php echo site_url('admin/user_accesses'); ?>" <?php echo ($this->router->fetch_class() == 'user_accesses') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Hak Akses Pengguna</a></li>
                <?php } ?>
                  <!-- <li><a href="<?php //echo site_url('admin/users'); ?>" <?php //echo ($this->router->fetch_class() == 'users') ? "style='text-decoration:none;background-color:rgb(255, 255, 255);color:rgb(234, 178, 0);'" : ""; ?>>Daftar Pengguna</a></li> -->
              </ul>
            </li>
            <!--
            <li><a href="menu.html">Menu</a></li>
            <li><a href="acess-level.html">Acess Level</a></li>
            <li><a href="site.html">Site</a></li>
            <li><a href="pengguna.html">Users</a></li>
          -->
          </ul>
        </li>
    </ul>
</div><!--leftmenu-->
