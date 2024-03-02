<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>BPJT - Badan Pengatur Jalan Tol</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive-tables.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/prettify.css">

	<?php if (isset($stylesheets)) { ?>
		<?php foreach($stylesheets as $stylesheet) { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $stylesheet; ?>">
		<?php } ?>
	<?php } ?>

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png">
</head>

<body>

	<div class="mainwrapper">
	    
	    <div class="header">
	        <div class="logo">
	            <a href="<?php echo site_url('admin/dashboard'); ?>"><img src="<?php echo base_url(); ?>assets/images/logo-bpjt-medium.png" alt="" /></a>
	        </div>
	        <div class="headerinner">
	            <ul class="headmenu">
	            	<!--
	                <li class="">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                    <a class="dropdown-toggle" href="<?php //echo site_url('admin/comments'); ?>">
	                        <span class="count badge badge-warning"><?php //echo ($unread_comments > 0) ? $unread_comments : ""; ?></span>
	                        <span class="head-icon head-message"></span>
	                        <span class="headmenu-label">Pesan</span>
	                    </a>
	                    <ul class="dropdown-menu">
	                        <li class="nav-header">Pesan</li>
	                        <li><a href=""><span class="icon-envelope"></span> Pesan baru dari <strong>Heru</strong> <small class="muted"> - 19 hours ago</small></a></li>
	                        <li><a href=""><span class="icon-envelope"></span> Pesan baru dari <strong>Dani</strong> <small class="muted"> - 2 days ago</small></a></li>
	                        <li class="viewmore"><a href="messages.html">Tampilkan lagi pesan</a></li>
	                    </ul>
	                </li>
	            	-->
	                <!--
	                <li>
	                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
	                    <span class="count badge badge-warning">5</span>
	                    <span class="head-icon head-users"></span>
	                    <span class="headmenu-label">User Baru</span>
	                    </a>
	                    <ul class="dropdown-menu newusers">
	                        <li class="nav-header">User Baru</li>
	                        <li>
	                            <a href="">
	                                <img src="<?php //echo base_url(); ?>assets/images/photos/thumb.png" alt="" class="userthumb" />
	                                <strong>Wasba Ditya Saputra</strong>
	                                <small>April 20, 2013</small>
	                            </a>
	                        </li>
	                        <li>
	                            <a href="">
	                                <img src="<?php //echo base_url(); ?>assets/images/photos/thumb2.png" alt="" class="userthumb" />
	                                <strong>Desi</strong>
	                                <small>April 19, 2013</small>
	                            </a>
	                        </li>
	                        <li>
	                            <a href="">
	                                <img src="<?php //echo base_url(); ?>assets/images/photos/thumb3.png" alt="" class="userthumb" />
	                                <strong>Ahmad</strong>
	                                <small>April 19, 2013</small>
	                            </a>
	                        </li>
	                        <li>
	                            <a href="">
	                                <img src="<?php //echo base_url(); ?>assets/images/photos/thumb4.png" alt="" class="userthumb" />
	                                <strong>Heri</strong>
	                                <small>April 18, 2013</small>
	                            </a>
	                        </li>
	                        <li>
	                            <a href="">
	                                <img src="<?php //echo base_url(); ?>assets/images/photos/thumb5.png" alt="" class="userthumb" />
	                                <strong>Mawar</strong>
	                                <small>April 16, 2013</small>
	                            </a>
	                        </li>
	                    </ul>
	                </li> 
	            	-->
	                
	                <li class="">
	                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
	                    <span class="head-icon head-config"></span>
	                    <span class="headmenu-label">Pengaturan</span>
	                    </a>
	                    <ul class="dropdown-menu">
	                       
	                        <li><a href="<?php echo site_url('admin/user_groups'); ?>"><span class="iconfa-user-md"></span> &nbsp;Group Pengguna</a>
	                        	<!--
	                            <ul>
	                                <li><a href="group-parent.html">Group Parent</a></li>
	                                <li><a href="group-child.html">Group Child</a></li>
	                            </ul>
	                        	-->
	                        </li>
	                        <!--<li><a href="menu.html"><span class="iconfa-tasks"></span> &nbsp;Menu</a></li>-->
	                        <li><a href="<?php echo site_url('admin/user_accesses'); ?>"><span class="iconfa-cog"></span> &nbsp;Hak Akses Pengguna</a></li>
	                        <li><a href="<?php echo site_url('admin/employees'); ?>"><span class="iconfa-user"></span> &nbsp;Pengguna</a></li>
	                        <li><a href="<?php echo site_url('/'); ?>"><span class="iconfa-globe"></span> &nbsp;Site</a></li>
	                    </ul>
	                </li>
	                
	                <li class="right">
	                    <div class="userloggedinfo">
	                    	<?php $user_photo = $this->session->userdata('photo'); ?>
	                    	<?php if (empty($user_photo)) { ?>
	                        <img src="<?php echo base_url(); ?>assets/images/photos/thumb.png" alt="" />
	                        <?php } else { ?>
	                        <img src="<?php echo $this->employee->get_photo_by_style($user_photo, 'sq100'); ?>" alt="" />
	                        <?php } ?>
	                        <div class="userinfo">
	                            <h5><?php echo $this->session->userdata('fullname') ?><small>- <?php echo $this->session->userdata('email') ?></small></h5>
	                            <ul>
	                            	<li><a href="<?php echo site_url('/admin/employees/edit/'.$this->session->userdata('user_id')); ?>"><i class="iconfa-user"></i>&nbsp;&nbsp;Edit Profil Diri</a></li>
	                                <!--li><a href=""><i class="iconfa-cog"></i>&nbsp;&nbsp;Pengaturan Akun</a></li-->
	                                <li><a href="<?php echo site_url('/admin/home/logout'); ?>"><i class="iconfa-signout"></i>&nbsp;&nbsp;Keluar</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                </li>
	            </ul><!--headmenu-->
	        </div>
	    </div>
	    
	    <div class="leftpanel">

	    	<?php echo $menu; ?>
	        
	    </div><!-- leftpanel -->
	    
	    <div class="rightpanel">

	    	<?php echo $content_head; ?>	        
	             
	        <div class="maincontent">
	            <div class="maincontentinner">
	                
	                <?php echo $content; ?>
	                
	                <div class="footer">
	                    <div class="footer-left">
	                        <span>&copy;  2013. BPJT - Badan Pengatur Jalan Tol. All Rights Reserved.</span>
	                    </div>
	                    <div class="footer-right">
	                        <span>Indonesia Toll Road Authority Ministry of Public Works</span>
	                    </div>
	                </div><!--footer-->
	                
	            </div><!--maincontentinner-->
	        </div><!--maincontent-->
	        
	    </div><!--rightpanel-->
	    
	</div><!--mainwrapper-->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-ui-1.9.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/modernizr.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/responsive-tables.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/application/dashboard.js"></script>

	<?php if (isset($jscripts)) { ?>
		<?php foreach($jscripts as $key => $value) { ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script>	
		<?php } ?>
	<?php } ?>
</body>
</html>
