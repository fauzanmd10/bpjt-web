<?php if (!empty($flash)) { ?>
<div class="alert alert-error">
    Anda tidak berhak mengakses halaman yang ingin Anda tuju.
</div>
<?php } ?>

<div class="row-fluid">
    <div id="dashboard-left" class="span8">        
        <!-- <h5 class="subtitle">Halaman yang baru dilihat</h5> -->
        <ul class="shortcuts">
             <li class="pegawai">
                <a href="">
                    <span class="shortcuts-icon iconsi-pegawai"></span>
                    <span class="shortcuts-label">Kepegawaian</span>
                </a>
             </li>             
             <!-- <li class="database">
                <a href="">
                    <span class="shortcuts-icon iconsi-database"></span>
                    <span class="shortcuts-label">Database</span>
                </a>
            </li> -->            
            <li class="database">
                <a href="">
                    <span class="shortcuts-icon iconsi-surat"></span>
                    <span class="shortcuts-label">Perkantoran</span>
                </a>
            </li>
            
             <li class="aset">
                <a href="">
                    <span class="shortcuts-icon iconsi-asset"></span>
                    <span class="shortcuts-label">Aset Manajemen</span>
                </a>
             </li>           
            <li class="help">
                <a href="">
                    <span class="shortcuts-icon iconsi-peta"></span>
                    <span class="shortcuts-label">Peta GIS</span>
                </a>
            </li>
            <!-- <li class="sisteminformasi">
                <a href="">
                    <span class="shortcuts-icon iconsi-sisteminformasi"></span>
                    <span class="shortcuts-label">Sistem Informasi</span>
                </a>
            </li> -->            
            <li class="teknik">
                <a href="">
                    <span class="shortcuts-icon iconsi-teknik"></span>
                    <span class="shortcuts-label">Bidang Teknik</span>
                </a>
            </li>
            <li class="inves">
                <a href="">
                    <span class="shortcuts-icon iconsi-inves"></span>
                    <span class="shortcuts-label">Bidang Investasi</span>
                </a>
            </li>
            <li class="pantau">
                <a href="">
                    <span class="shortcuts-icon iconsi-pantau"></span>
                    <span class="shortcuts-label">Bid. Pengawasan & Pemantauan</span>
                </a>
            </li>
            <li class="umum">
                <a href="">
                    <span class="shortcuts-icon iconsi-umum"></span>
                    <span class="shortcuts-label">Bidang Umum</span>
                </a>
            </li>
            <li class="dana">
                <a href="">
                    <span class="shortcuts-icon iconsi-dana"></span>
                    <span class="shortcuts-label">Bidang Pendanaan</span>
                </a>
            </li>            
            <li class="last images">
                <a href="">
                    <span class="shortcuts-icon iconsi-images"></span>
                    <span class="shortcuts-label">Galeri Photo</span>
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
              <p style="margin: 8px 0">Info dan pengumuman.</p>
        </div><!--alert-->        
        <br />
        <h4 class="widgettitle">Kalender</h4>
        <div class="widgetcontent nopadding">
            <div id="datepicker"></div>
        </div>
        <br />                                
    </div><!--span4-->
</div><!--row-fluid-->