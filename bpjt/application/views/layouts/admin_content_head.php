<ul class="breadcrumbs">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <?php foreach($breadcrumbs as $key => $value) { ?>
        <?php if ($key == '#') { ?>
        <li><a href="#"><?php echo $value; ?></a> <span class="separator"></span></li>
        <?php } elseif ($key != '') { ?>
        <li><a href="<?php echo site_url($key); ?>"><?php echo $value; ?></a> <span class="separator"></span></li>
        <?php } else { ?>
        <li><?php echo $value; ?></li>
        <?php } ?>
    <?php } ?>
    
    <li class="right">
        <span data-toggle="dropdown" class="dropdown-toggle">
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/tanggal.js"></script>
        </span>
    </li>
</ul>


<div class="pageheader">
    <!-- <form action="results.html" method="post" class="searchbar">
        <input type="text" name="keyword" placeholder="Cari..." />
    </form> -->
    <div class="pageicon">
        <?php if ($this->router->fetch_class() == "dashboard") { ?>
        <span class="iconfa-laptop"></span>
        <?php } elseif($this->router->fetch_class() == "articles") { ?>
        <span class="iconfa-pencil"></span>
        <?php } elseif($this->router->fetch_class() == "regulations") { ?>
        <span class="iconfa-file"></span>
        <?php } else { ?>
        <span class="iconfa-briefcase"></span>
        <?php } ?>
    </div>
    <div class="pagetitle">
        <h5><?php echo $subtitle; ?></h5>
        <h1><?php echo $title; ?></h1>
    </div>
</div><!--pageheader-->