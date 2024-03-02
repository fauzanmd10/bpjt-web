<style>
.box-dashboard-val .pageicon{
    font-size:65px !important;
}
.box-dashboard{
    width:24%;
    text-align:center;
   
}
.box-dashboard a{
    width:100% !important;
    background:#17a2b8 !important;
    border-radius:10px;
}

.box-dashboard{
    width:23%%; 
    float:left;
    margin-top:15px;
    margin-left:5%;
}
.box-dashboard-val .pageicon{
    width:100%;
    margin:auto;
    background:transparent !important;
    color:black !important;
    opacity:0.2 !important;
    border:0px solid transparent !important;
}
.box-dashboard-val .pageicon:hover{
  
    opacity:1 !important;
}
.box-dashboard-val{
    width:60%;
    float:left;
    margin-top:30px;
}
.box-dashboard h4{
    width:100%;
    float:left;
    text-align:center;
    padding:10px;
    
}
.box-dashboard h2{
    font-weight:700;
    font-family:arial;
    border-bottom:5px dashed white;
    padding:10px;
    width:100%;
}
/* .box-link{
    width:100%;
    float:left;
    background-color:rgba(0,0,0,.15);
} */
.box-artic{
    float:left;
    width:100%;
    background:#17a2b845;
    overflow-x:scroll;
}
.box-artic-en{
    float:left;
    width:100%;
    background:#b5597330;
    overflow-x:scroll;
}
.box-pop{
    width:1200px;
    float:left;
    
    padding:10px;
}
.no-pop{
    width:15px;
    height:15px;
    padding:10px;
    text-align:center;
    
    font-weight:bold;
    float:left;
    background:white;
    border-radius:20px;
}
.isi-pop{
    width:95%;
    padding:2px 5px 5px 5px;
    float:left;
    text-align:middle;
}
.isi-pop button{
    background:#17a2b8;
    border-radius : 10px;
    border:0px solid transparent;
}
#btn-lihat{
    margin-bottom:10px !important;
}
#btn-view{
    margin-left:10px;
}
</style>
<?php if (!empty($flash)) { ?>
<div class="alert alert-error">
    Anda tidak berhak mengakses halaman yang ingin Anda tuju.
</div>
<?php } ?>

<div class="row-fluid">


    <div id="dashboard-left" class="span8">
        <ul class="shortcuts">            
            <li class="box-dashboard">
                <a href="<?php echo base_url();?>admin/articles" target="_blank">
               <div class='box-dashboard'>
               <h2><?php echo $ca;?></h2>
                    <h4>Artikel (ID)</h4>
                </div>
                <div class='box-dashboard-val'>
                    
                    <div class='pageicon'>
                   <span class='iconfa-pencil'></span>
                </div>
                </div>
                <!-- <div class="box-link">Lihat lebih banyak</div> -->
                </a>
            </li>
            <li class="box-dashboard">
                <a href="<?php echo base_url();?>admin/articles" target="_blank" style="background:#b55973 !important;">
               <div class='box-dashboard'>
               <h2><?php echo $ce;?></h2>
                    <h4>Artikel (EN)</h4>
                </div>
                <div class='box-dashboard-val'>
                    
                    <div class='pageicon'>
                   <span class='iconfa-pencil'></span>
                </div>
                </div>
                <!-- <div class="box-link">Lihat lebih banyak</div> -->
                </a>
            </li>
            <li class="box-dashboard"> 
                <a href="<?php echo base_url();?>admin/photo_galleries" target="_blank" style=" background:#fd7e14 !important;">
               <div class='box-dashboard'>
               <h2><?php echo $cg;?></h2>
                    <h4>Galeri</h4>
                </div>
                <div class='box-dashboard-val'>
                    
                    <div class='pageicon'>
                   <span class='iconfa-picture'></span>
                </div>
                </div>   
                <!-- <div class="box-link">Lihat lebih banyak</div> -->
                </a>
            </li>
            <li class="box-dashboard">
                <a href="<?php echo base_url();?>/bpjtweb" target="_blank" style=" background:#007bff !important;">
               <div class='box-dashboard'>
               <h2><?php echo $cr;?></h2>
                    <h4>Peraturan</h4>
                </div>
                <div class='box-dashboard-val'>
                    
                    <div class='pageicon'>
                   <span class='iconfa-cogs'></span>
                </div>
                </div>
                <!-- <div class="box-link">Lihat lebih banyak</div> -->
                </a>
            </li>
            <br>
            <hr style="width:100%;float:left;">
            <h4 style="width:100%;float:left; ">Berita Terpopuler (ID)</h4>
            <div class='col-md-12'>
            <select name="bln" id="bln" class="form-control">
                <option value="-">Bulan</option>
                <?php
                $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                $number=array("01","02","03","04","05","06","07","08","09","10","11","12");
                $jlh_bln=count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){
                    echo"<option value=$number[$c]> $bulan[$c] </option>";
                }
                ?>
            </select>
            <?php
                $now=date('Y');
                echo "<select id='thn' class='form-control'> name=’tahun’><option value='-'>Tahun</option>";
                for ($a=2013;$a<=$now;$a++)
                {
                    echo "<option value='$a'>$a</option>";
                }
                echo "</select>";
                ?>
                <button class='btn btn-primary' onclick='lihat("id")' id='btn-lihat'>Lihat</button>
                <button class='btn btn-danger' onclick='lihat("id","reset")' id='btn-lihat'>Reset</button>
            </div>
  
            <div class='box-artic'>
            </div>
        </ul>
        <br />
        <hr style="width:100%;float:left;">
            <h4 style="width:100%;float:left; ">Berita Terpopuler (EN)</h4>
            <div class='col-md-12'>
            <select name="bln1" id="bln1" class="form-control">
                <option value="-">Bulan</option>
                <?php
                $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                $number=array("01","02","03","04","05","06","07","08","09","10","11","12");
                $jlh_bln=count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){
                    echo"<option value=$number[$c]> $bulan[$c] </option>";
                }
                ?>
            </select>
            <?php
                $now=date('Y');
                echo "<select id='thn1' class='form-control'> name=’tahun1’><option value='-'>Tahun</option>";
                for ($a=2013;$a<=$now;$a++)
                {
                    echo "<option value='$a'>$a</option>";
                }
                echo "</select>";
                ?>
                <button class='btn btn-primary' onclick='lihat("en")' id='btn-lihat'>Lihat</button>
                <button class='btn btn-danger' onclick='lihat("en","reset")' id='btn-lihat'>Reset</button>
            </div>
  
            <div class='box-artic-en'>
            </div>
        </ul>
        <br />
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


 <!-- modal -->
                        <div id="modal-artic" class="modal fade" role="dialog" style="width:60%;left:40% !important;">
                              <div class="modal-dialog">


                                <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title"></h4>  <button style='margin-top:-10px;' type="button" class="close" data-dismiss="modal">&times;</button>

                                  </div>


                                  <div class="modal-body">
                                    </div>
                                </div>

                              </div>
                            </div>

  <!-- modal -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    lihat('id')
    lihat('en')
    format_tanggal()
});


    function format_tanggal(tgl){
        var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        tgl = tgl.split(' ')[0];
        var bulan = bulan[parseInt(tgl.split('-')[1])-1];
        var yuhu = tgl.split('-')[2] + ' ' + bulan + ' ' + tgl.split('-')[0];
        return yuhu;
    }
    function lihat(id,res=''){
                var tahun='-';
                var bulan='-';
                var boxs='';
                if(id=='id'){
                    if(res !=='reset'){
                        tahun = $('#thn').val();
                        bulan = $('#bln').val();
                    }else{
                        $('#thn').val('-');
                        $('#bln').val('-');
                    }
                 boxs='.box-artic';
                 
                }else if(id=='en'){
                    if(res !=='reset'){
                        tahun = $('#thn1').val();
                        bulan = $('#bln1').val();
                    }else{
                        $('#thn1').val('-');
                        $('#bln1').val('-');
                    }
                 boxs='.box-artic-en';
                }
                $(boxs).empty();
                
                var urls = "<?php echo site_url(); ?>/admin/dashboard/tampil_data/"+tahun+"/"+bulan+"/"+id;
            $.ajax({
                url: urls,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (data) {
                    if(data.length==0){
                        alert("Data tidak ditemukan !")
                    }else{
                        for(var i=0; i < data.length; i++){
                        
                            var item = data[i];
                            var no=1+i;
                            var tanggal = format_tanggal(item.created_at)
                            $(boxs).append("<div class='box-pop'><div class='no-pop'>"+no+"</div><div class='isi-pop'>"+item.title+ " <button id='btn-view' class='btn btn-success' style='background:#17a2b8;' onclick='show_artic("+item.id+")'><i class='iconfa-eye-open'></i> "+item.viewed+"</button><button id='btn-view' class='btn btn-success' style='background:#3dad83;'><i class='iconfa-calendar'></i> "+tanggal+"</button></div></div>")
                            
                            
                        }
                    }
                },
                failure: function (errMsg) {
                alert(errMsg);
                }
        });
    }

    function show_artic(id){
        $("#modal-artic").modal('show');
        var urls = "<?php echo base_url(); ?>admin/dashboard/detail_artikel/"+id;
        var url_edit = "<?php echo base_url(); ?>admin/articles/edit/"+id;
        var url_show = "<?php echo base_url(); ?>admin/articles/show/"+id;
            $.ajax({
                url: urls,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: false,
                success: function (data) {
                    $(".modal-title").text(data[0].title)
                    $(".modal-body").html(data[0].content+
                    "<button class='btn btn-primary'><a style='color:white;' href='"+url_edit+"'>Edit</a></button> "+
                    " <button class='btn btn-danger'><a style='color:white;' href='"+url_show+"'>Lihat</a></button>")
                },
                failure: function (errMsg) {
                alert(errMsg);
                }
            })
    }

</script>