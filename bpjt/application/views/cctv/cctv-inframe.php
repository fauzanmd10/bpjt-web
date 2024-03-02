<head>
    <!-- Font Icons -->
    <!-- <link media="all" rel="stylesheet" href="<?php echo base_url(); ?>assets/2021/css/fonts/icomoon/icomoon.min.css"  onload="this.media='all'"> -->
    <link media="all" href="<?php echo base_url(); ?>assets/cctv/css/all.min.css" rel="stylesheet" onload="this.media='all'">
    <!-- Bootstrap 4 -->
    <link media="all" rel="stylesheet" href="<?php echo base_url(); ?>assets/cctv/css/bootstrap.css" onload="this.media='all'">
    <!-- Theme CSS -->
    <link media="all" rel="stylesheet" href="<?php echo base_url(); ?>assets/cctv/css/main.css" onload="this.media='all'">
    <!--    <link href="--><?php //echo base_url(); ?><!--assets/2021/css/video-js.css" rel="stylesheet">-->
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link media="all" rel="stylesheet" href="<?php echo base_url(); ?>assets/cctv/css/construction.css" onload="this.media='all'">

    <script src="<?php echo base_url(); ?>assets/cctv/js/video.js"></script>
    <script src="<?php echo base_url(); ?>assets/cctv/js/videojs-contrib-hls.min.js"></script>
</head>

<style>
    @media screen and (max-width: 768px){
        .cctv-box-title{
            margin-bottom: 20px;
        }

        .cctv-box-item{
            margin-bottom: 13px;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content-block p-0" style="margin-top: 50px;">
        <div class="container">
            <?php if(!empty($id_ruas)){ ?>
                <div class="text-center cctv-box-title">
                    <a href="<?php echo base_url();?>cctv/cctv_inframe"> Kembali ke halaman Ruas CCTV</a>
                </div>
            <?php } ?>
            <div class="row multiple-row" style="margin-bottom: 50px;">
                <?php  if(empty($id_ruas)){ ?>
                    <?php foreach($cctv as $row){?>
                        <div class="col-md-2 col-lg-4 cctv-box-item">
                            <div class="col-wrap">
                                <div class="post-grid">
                                    <div class="post-text-block bg-gray-light has-radius">
                                        Ruas :
                                        <h4 class="mb-0">
                                            <?php echo $row->nama_ruas;?> <i class="icon-line-arrow-right-circle"></i>&nbsp;
                                        </h4>
                                        <div class="post-meta clearfix">
                                            <div class="post-link-holder">
                                                <?php echo strtoupper($row->bujt_nama).'<br /><br />'; ?>
                                                <a style="font-size:10px"  href="<?php echo base_url();?>cctv/cctv_inframe/?id_ruas=<?php echo $row->id_ruas;?>&status=online">
                                                    <button class="button button-mini button-circle button-green"><?php echo $row->jml_cctv_online?> online</button>
                                                </a>
                                                <a style="font-size:10px"  href="<?php echo base_url();?>cctv/cctv_inframe/?id_ruas=<?php echo $row->id_ruas;?>&status=offline">
                                                    <button class="button button-mini button-circle button-red"><?php echo $row->jml_cctv_offline?> offline</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{?>
                    <?php if($cctv){ ?>
                        <?php foreach($cctv as $row){ ?>
                            <div class="col-md-2 col-lg-4 cctv-box-item">
                                <div class="col-wrap">
                                    <div class="post-grid">
                                        <div class="post-text-block bg-gray-light has-radius">
                                            <?php if($row->protocol == 'm3u8'){ ?>
                                                <video id="my_video_<?php echo $row->id?>" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" autoplay data-setup='{}'>
                                                    <source src="<?php echo $row->stream; ?>" type="application/x-mpegURL">
                                                </video>
                                                <script>
                                                    var player<?php echo $row->id?> = videojs('my_video_<?php echo $row->id?>');
                                                    player<?php echo $row->id?>.play();
                                                </script>
                                            <?php }elseif($row->protocol == 'rtsp'){
                                            if(strpos($row->stream, 'rtsp.me')) { ?>
                                                <iframe src="<?php echo $row->stream; ?>" style="width:100%;border:0;height:200px;"></iframe>
                                            <?php }else{ ?>
                                                <video id="my_video_<?php echo $row->id?>" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" autoplay data-setup='{}'>
                                                    <source src="<?php echo $row->stream; ?>" type="application/x-mpegURL">
                                                </video>
                                            <?php } ?>
                                            <?php }elseif($row->protocol == 'mjpg'){ ?>
                                            <img class="img-responsive" id="segment-<?php echo $row->id;?>" src="<?php echo $row->stream;?>">
                                                <script>
                                                    setInterval(function(){
                                                        $("#segment-<?php echo $row->id;?>").attr("src", "<?php echo $row->stream;?>");
                                                    },500);
                                                </script>
                                            <?php }elseif($row->protocol == 'embedded2'){ ?>
                                            <img style="display: block;" src="<?php echo $row->stream;?>" width="100%" height="200">
                                                <!--                                                    <iframe src="--><?php //echo base_url().'index.php/contents/cctv_embedded';?><!--" style="border:0;width:100%;height:180px;padding:0;margin:0;"></iframe>-->
                                            <?php }elseif($row->protocol == 'embedded'){ ?>
                                                <iframe style="display: block;" src="<?php echo $row->stream;?>" width="100%" height="200">
                                                </iframe>
                                            <?php } ?>
                                            <div class="col-lg-12 text-center">
                                                <?php echo '<strong>'.$row->nama_ruas.'</strong><br />'.$row->nama_cctv; ?><br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php }else{?>
                        <div class="col-md-12">
                            <p class="text-center">Tidak ada CCTV  yang online.</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </div>
                    <?php }?>
                <?php }?>
            </div>
        </div>
    </section>
</div>

<!-- jquery library -->
<script defer src="<?php echo base_url(); ?>assets/cctv/js/jquery-2.1.4.min.js"></script>
<!-- external scripts -->
<script defer src="<?php echo base_url(); ?>assets/cctv/js/tether.min.js"></script>
<script defer src="<?php echo base_url(); ?>assets/cctv/js/bootstrap.min.js"></script>
<!-- <script defer src="<?php echo base_url(); ?>assets/cctv/js/jquery.main.js"></script> -->
