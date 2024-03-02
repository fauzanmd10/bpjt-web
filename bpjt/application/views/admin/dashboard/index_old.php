<?php if (!empty($flash)) { ?>
<div class="alert alert-error">
    Anda tidak berhak mengakses halaman yang ingin Anda tuju.
</div>
<?php } ?>

<div class="row-fluid">
    <div id="dashboard-left" class="span8">
        <ul class="shortcuts">            
            <li class="teknik">
                <a href="http://25.51.235.246:8802/bpjtweb" target="_blank">
                    <span class="shortcuts-icon iconsi-teknik"></span>
                    <span class="shortcuts-label">Bidang Teknik</span>
                </a>
            </li>
            <li class="inves">
                <a href="http://25.51.235.246:8802/bpjtweb" target="_blank">
                    <span class="shortcuts-icon iconsi-inves"></span>
                    <span class="shortcuts-label">Bidang Investasi</span>
                </a>
            </li>
            <li class="pantau">
                <a href="http://25.51.235.246:8802/bpjtweb" target="_blank">
                    <span class="shortcuts-icon iconsi-pantau"></span>
                    <span class="shortcuts-label">Bid. Pengawasan & Pemantauan</span>
                </a>
            </li>
            <li class="umum">
                <a href="<?php echo site_url('admin/bidang-umum'); ?>" id="btn-bidang-umum">
                    <span class="shortcuts-icon iconsi-umum"></span>
                    <span class="shortcuts-label">Bidang Umum</span>
                </a>
            </li>
            <li class="dana">
                <a href="http://25.51.235.246:8802/bpjtweb" target="_blank">
                    <span class="shortcuts-icon iconsi-dana"></span>
                    <span class="shortcuts-label">Bidang Pendanaan</span>
                </a>
            </li>              
        </ul>
        <br />
    </div><!--span8-->
    
    <div id="dashboard-right" class="span4">
        <h5 class="subtitle">Pengumuman</h5>
        <div class="divider15"></div>
        <div class="alert alert-block">
            <button data-dismiss="alert" class="close" type="button">&times;</button>
            <h4>Berita dan Pengumuman</h4>

            <?php if (empty($events)) { ?>
            <p style="margin: 8px 0">Tidak ada agenda rapat pada bulan ini.</p>
            <?php } else { ?>
            <ul class="event-announcement">
                <?php foreach($events as $event) { ?>
                <li>
                    <div class="event-title" style="font-size:14px;"><a href="<?php echo site_url('admin/calendars'); ?>"><?php echo $event->title; ?></a></div>
                    <div class="event-time">
                        <?php
                            $start_date = explode(' ', $event->start_date);
                            $date = explode("-", $start_date[0]);
                        ?>
                        <a href="<?php echo site_url('admin/calendars'); ?>">
                            <?php echo $date[2] . " " . $this->months[intval($date[1])] . " " . $date[0]; ?>
                            <?php echo $this->time_collection[$start_date[1]]; ?>
                        </a>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div><!--alert-->
        <br />
        <div class="widgetbox">                        
            <h4 class="widgettitle"><a class="sidebar" href="">SPM</a></h4>
            <ul class="nav nav-tabs nav-stacked">
                <li><a href="<?php echo site_url('admin/spm_classifications'); ?>">Klasifikasi</a></li>
                <li><a href="<?php echo site_url('admin/spm_scores'); ?>">Point</a></li>
            </ul>
        	<br />
        </div>
        
        <div class="widgetbox">                        
        	<h4 class="widgettitle"><a class="sidebar" href="<?php echo site_url('admin/peta_cetak'); ?>">Peta Ruas Jalan Tol (Peta Cetak)</a></h4>
			<br />
		</div>
        
        <div class="widgetbox">                        
            <h4 class="widgettitle"><a class="sidebar" href="<?php echo site_url('admin/progres-konstruksi'); ?>">Progress Konstruksi</a></h4>
        	<br />
        </div>
        
        <!-- <h4 class="widgettitle">Kalender</h4> -->
        <div class="widgetcontent nopadding">
            <div id="datepicker"></div>
        </div>

         <br />
</div><!--row-fluid-->