	<!-- Page Title
		============================================= -->
		<section id="page-title">
			<?php $lang = $this->session->userdata('lang'); ?>
			<div class="container clearfix">
				<h1><?php echo lang('spm'); ?></h1>
        <span> <?php echo lang('standar-pelayanan-minimal'); ?></span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo lang('jalan-tol'); ?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->


    <section id="content">
				<div class="container clearfix">
    

	<!-- post meta -->
        <div class="post-meta">
          <!-- <h3 class="noimage">Semua SPM</h3> -->
        </div>
        <!-- end post meta -->
        <!-- post content -->
        <div class="post-content section">
        	<!--
            <div class="right-side1 three columns">
                <label class="cari">Kata Kunci</label>
                <form class="searchform" method="post" action="result.html">
                    <input class="s" type="text" name="s" required="required">
                    <input class="submit search-icon" type="submit" value="">
                </form>
            </div>
        	-->
            <div class="clear"></div>
            <div class="right-side six columns">
                <form action="">
				<div class="form-group">
	                <label class="bulan"><?php echo lang('ruas'); ?></label> 
	                <?php echo form_dropdown('toll_road_id', $toll_roads, '', "class='uniformselect form-control' id='toll-road-id'"); ?>   
                </form>
				</div>
            </div> 
            <div class="right-side five columns">
                <form action="">
				<div class="form-group">
					<label class="bulan">Semester</label>    
					<select id="semester" class="form-control">
						<!-- <option selected="selected" value=""> </option> -->
						<option value="0">Pilih Semester</option>
						<option value="1">Semester I</option>
						<option value="2">Semester II</option>
					</select>
                </div>
				</form>
            </div>
            <div class="right-side three columns">
                <form action="">
				<div class="form-group">
	                <label class="tahun"><?php echo lang('tahun'); ?></label>    
	                <select id="year" class="form-control">
		                <!-- <option selected="selected" value=""> </option> -->
		                <option value="0">Pilih Tahun</option>
		                <?php for($i=2011; $i<=2050; $i++) { ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		                <?php } ?>
	                </select>
				</div>
                </form>
            </div>
            <div class="form-group">
            <button id="apply-filter" class="button button-rounded button-reveal button-small button-red text-end" type="submit" style="margin-top:0;"><i class="icon-angle-right"></i><span><?php echo lang('tampilkan'); ?></span></button>
            </div>
            <div class="post-meta"></div>
        </div>
        <div class="post-meta">
          <div class="widget clearfix">
            <div class="buttontopdf" style="float:right;">
                <?php echo form_open('/spm/spmtopdf', array('method'=>'post', 'id'=>'form-spm')); ?>
                    <input type="hidden" name="toll_road_id" value="" id="input-toll-road-id" />
                      <input type="hidden" name="semester" value="" id="input-semester" />
                      <input type="hidden" name="year" value="" id="input-year" />
                    <?php echo form_close(); ?>
                    <a href="#" id="print-to-pdf"><img title="pdf" src="<?php echo base_url(); ?>assets/images/pdf-icon.png"></a>
            </div>
          </div>
            <br />
                  <div class="form-group">
                  <div class="style-msg infomsg">
                    <div class="sb-msg"><i class="icon-info-sign"></i><strong>1.</strong> Kondisi Jalan Tol</div>
                  </div>
                  <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head1">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Kekesatan</td>
                              <td>&gt;0,33 µm</td>
                              <td id='kondisi_jalan_tol_kekesatan_condition'></td>
                              <td id='kondisi_jalan_tol_kekesatan_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Kerataan</td>
                              <td>IRI &lt; 4 m/km</td>
                              <td id='kondisi_jalan_tol_kerataan_condition'></td>
                              <td id='kondisi_jalan_tol_kerataan_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Lubang</td>
                              <td>100%</td>
                              <td id='kondisi_jalan_tol_lubang_condition'></td>
                              <td id='kondisi_jalan_tol_lubang_remarks'></td>
                            </tr>
                            <tr>
                              <td>d</td>
                              <td>Rutting</td>
                              <td>100%</td>
                              <td id='kondisi_jalan_tol_rutting_condition'></td>
                              <td id='kondisi_jalan_tol_rutting_remarks'></td>
                            </tr>
                            <tr>
                              <td>e</td>
                              <td>Retak</td>
                              <td>100%</td>
                              <td id='kondisi_jalan_tol_retak_condition'></td>
                              <td id='kondisi_jalan_tol_retak_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    
                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>2.</strong> Kecepatan Tempuh Rata-Rata</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Kecepatan Tempuh Rata-Rata</td>
                              <td>&gt;1,80 kali kecepatan non tol (jalan tol luar kota), &lt;1,60 kali kecepatan non tol (jalan tol dalam kota)</td>
                              <td id='kecepatan_tempuh_condition'></td>
                              <td id='kecepatan_tempuh_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>3.</strong> Aksesibilitas</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Kecepatan Rata-Rata Transaksi</td>
                              <td>
                                Terbuka<br />
                                &lt; 8 detik setiap Kendaraaan<br/><br/>

                                Tertutup<br/>
                                Gardu Masuk<br/>
                                &lt; 7 detik setiap Kendaraan<br/><br/>

                                Gardu Keluar<br/>
                                &lt; 11 detik setiap kendaraan
                              </td>
                              <td id='aksesibilitas_kecepatan_transaksi_condition'></td>
                              <td id='aksesibilitas_kecepatan_transaksi_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Kapasitas Gardu Tol</td>
                              <td>&lt; 450 kendaraan per jam per Gardu</td>
                              <td id='aksesibilitas_kapasitas_gardu_condition'></td>
                              <td id='aksesibilitas_kapasitas_gardu_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>4.</strong> Mobilitas (Kecepatan Penanganan Hambatan Lalu Lintas)</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Wilayah pengamatan/observasi patroli</td>
                              <td>30 menit per siklus pengamatan</td>
                              <td id='mobilitas_wilayah_patroli_condition'></td>
                              <td id='mobilitas_wilayah_patroli_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Mulai informasi diterima sampai tempat kejadian</td>
                              <td>&lt; 30 menit</td>
                              <td id='mobilitas_informasi_condition'></td>
                              <td id='mobilitas_informasi_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Penanganan akibat kendaraan mogok</td>
                              <td>Melakukan penderekan ke Pintu Gerbang Tol terdekat</td>
                              <td id='mobilitas_kendaraan_mogok_condition'></td>
                              <td id='mobilitas_kendaraan_mogok_remarks'></td>
                            </tr>
                            <tr>
                              <td>d</td>
                              <td>Patroli kendaraan derek</td>
                              <td>30 menit per siklus pengamatan</td>
                              <td id='mobilitas_derek_condition'></td>
                              <td id='mobilitas_derek_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>5.</strong> Keselamatan</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Perambuan</td>
                              <td>Kelengkapan dan Kejelasan 100%</td>
                              <td id='keselamatan_perambuan_condition'></td>
                              <td id='keselamatan_perambuan_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Marka jalan</td>
                              <td>Jumlah 100 % dan Reflektifitas &gt; 80%</td>
                              <td id='keselamatan_marka_jalan_condition'></td>
                              <td id='keselamatan_marka_jalan_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Guide post dan reflector</td>
                              <td>Jumlah 100 % dan Reflektifitas &gt; 80%</td>
                              <td id='keselamatan_guide_post_condition'></td>
                              <td id='keselamatan_guide_post_remarks'></td>
                            </tr>
                            <tr>
                              <td>d</td>
                              <td>Patok KM</td>
                              <td>100%</td>
                              <td id='keselamatan_patok_km_condition'></td>
                              <td id='keselamatan_patok_km_remarks'></td>
                            </tr>
                            <tr>
                              <td>e</td>
                              <td>Penerangan Jalan Umum</td>
                              <td>Lampu Menyala 100%</td>
                              <td id='keselamatan_penerangan_condition'></td>
                              <td id='keselamatan_penerangan_remarks'></td>
                            </tr>
                            <tr>
                              <td>f</td>
                              <td>Pagar rumija</td>
                              <td>Keberadaan 100%</td>
                              <td id='keselamatan_pagar_rumija_condition'></td>
                              <td id='keselamatan_pagar_rumija_remarks'></td>
                            </tr>
                            <tr>
                              <td>g</td>
                              <td>Penanganan kecelakaan</td>
                              <td>Melakukan penderekan gratis sampai ke pool derek</td>
                              <td id='keselamatan_penanganan_kecelakaan_condition'></td>
                              <td id='keselamatan_penanganan_kecelakaan_remarks'></td>
                            </tr>
                            <tr>
                              <td>h</td>
                              <td>Pengamanan dan penegakan hukum</td>
                              <td>Keberadaan Polisi Patroli Jalan Raya (PJR) yang siap panggil 24 jam</td>
                              <td id='keselamatan_pengamanan_condition'></td>
                              <td id='keselamatan_pengamanan_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>6.</strong> Unit Pertolongan/Penyelamatan dan Bantuan Pelayanan</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Ambulan</td>
                              <td>1 Unit per 25 km atau minimum 1 unit</td>
                              <td id='pertolongan_ambulan_condition'></td>
                              <td id='pertolongan_ambulan_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Kendaraan Derek</td>
                              <td>1 Unit per 5 km atau minimum 1 unit (LHR &gt; 100.000) 1 Unit per 10 km atau minimum 1 unit (LHR ≤ 100.000)</td>
                              <td id='pertolongan_derek_condition'></td>
                              <td id='pertolongan_derek_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Polisi PJR</td>
                              <td>1 Unit per 15 km atau minimum 1 unit (LHR &gt; 100.000) 1 Unit per 20 km atau minimum 1 unit (LHR ≤ 100.000)</td>
                              <td id='pertolongan_polisi_pjr_condition'></td>
                              <td id='pertolongan_polisi_pjr_remarks'></td>
                            </tr>
                            <tr>
                              <td>d</td>
                              <td>Patroli jalan raya (operator)</td>
                              <td>1 Unit per 15 km atau minimum 2 unit</td>
                              <td id='pertolongan_patroli_condition'></td>
                              <td id='pertolongan_patroli_remarks'></td>
                            </tr>
                            <tr>
                              <td>e</td>
                              <td>Rescue</td>
                              <td>1 Unit per ruas Jalan Tol (dilengkapi dengan peralatan penyelamatan)</td>
                              <td id='pertolongan_rescue_condition'></td>
                              <td id='pertolongan_rescue_remarks'></td>
                            </tr>
                            <tr>
                              <td>f</td>
                              <td>Sistem informasi</td>
                              <td>Setiap Gerbang Masuk</td>
                              <td id='pertolongan_sistem_informasi_condition'></td>
                              <td id='pertolongan_sistem_informasi_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>7.</strong> Lingkungan</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Kebersihan</td>
                              <td></td>
                              <td id='lingkungan_kebersihan_condition'></td>
                              <td id='lingkungan_kebersihan_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>Tanaman</td>
                              <td></td>
                              <td id='lingkungan_tanaman_condition'></td>
                              <td id='lingkungan_tanaman_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Rumput</td>
                              <td></td>
                              <td id='lingkungan_rumput_condition'></td>
                              <td id='lingkungan_rumput_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />

                    <div class="style-msg infomsg">
                      <div class="sb-msg"><i class="icon-info-sign"></i><strong>8.</strong> TI & TIP</div>
                    </div>
                    <table id="kondisi-jalan-tol" class="table table-bordered" border='1'>
                        <thead>
                            <tr>
                                <th class="head0">No.</th>
                                <th class="head1">Indikator</th>
                                <th class="head0">Tolak Ukur</th>
                                <th class="head0">Kondisi Saat Ini</th>
                                <th class="head0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>a</td>
                              <td>Kondisi Jalan</td>
                              <td></td>
                              <td id='ti_jalan_condition'></td>
                              <td id='ti_jalan_remarks'></td>
                            </tr>
                            <tr>
                              <td>b</td>
                              <td>On/Off Ramp</td>
                              <td></td>
                              <td id='ti_ramp_condition'></td>
                              <td id='ti_ramp_remarks'></td>
                            </tr>
                            <tr>
                              <td>c</td>
                              <td>Toilet</td>
                              <td></td>
                              <td id='ti_toilet_condition'></td>
                              <td id='ti_toilet_remarks'></td>
                            </tr>
                            <tr>
                              <td>d</td>
                              <td>Parkir Kendaraan</td>
                              <td></td>
                              <td id='ti_parkir_condition'></td>
                              <td id='ti_parkir_remarks'></td>
                            </tr>
                            <tr>
                              <td>e</td>
                              <td>Penerangan</td>
                              <td></td>
                              <td id='ti_penerangan_condition'></td>
                              <td id='ti_penerangan_remarks'></td>
                            </tr>
                            <tr>
                              <td>f</td>
                              <td>Stasiun Pengisian Bahan Bakar</td>
                              <td></td>
                              <td id='ti_stasiun_condition'></td>
                              <td id='ti_stasiun_remarks'></td>
                            </tr>
                            <tr>
                              <td>g</td>
                              <td>Bengkel Umum</td>
                              <td></td>
                              <td id='ti_bengkel_condition'></td>
                              <td id='ti_bengkel_remarks'></td>
                            </tr>
                            <tr>
                              <td>h</td>
                              <td>Tempat Makan & Minum</td>
                              <td></td>
                              <td id='ti_makan_condition'></td>
                              <td id='ti_makan_remarks'></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                  </div>

          <p><br /></p>
        </div>
        <!-- end pagination -->
      </div>
      <!-- end single post content -->
    <!-- end leftside -->
  <!-- end container -->
</div>
<!-- end page content -->
</section>