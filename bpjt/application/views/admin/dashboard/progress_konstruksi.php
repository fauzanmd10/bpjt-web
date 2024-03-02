<?php if (!empty($flash)) { ?>
<div class="alert alert-error">
    Anda tidak berhak mengakses halaman yang ingin Anda tuju.
</div>
<?php } ?>

<div>Tahun: <?php echo $year; ?></div>
<div>Bulan: <?php echo $month; ?></div>
<div>Minggu: <?php echo $week; ?></div>

<div class="row-fluid">
    <div id="dashboard-left" class="span8">
        <table id="dyntable" class="table table-bordered responsive">
		    <colgroup>
		        <col class="con0" style="align: center; width: 4%" />
		        <col class="con1" />
		        <col class="con0" />
		        <col class="con1" />
                <col class="con1" />
		        <col class="con0" />
		        <col class="con1" />
                <col class="con0" />
		    </colgroup>
		    <thead>
		        <tr>
		            <th class="head0 nosort"><input type="checkbox" id="checkall" /></th>
		            <th class="head0">No.</th>
		            <th class="head1">Ruas Tol</th>
                    <th class="head0">PJG (KM)</th>
		            <th class="head0">Rencana (%)</th>
		            <th class="head1">Realisasi (%)</th>
		            <th class="head0">Deviasi (%)</th>
                    <th class="head1">Status Update</th>
		        </tr>
		    </thead>
		    <tbody>
		        <!-- Data generated via AJAX -->
		    </tbody>
		</table>

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