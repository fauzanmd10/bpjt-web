<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>BPJT - Badan Pengatur Jalan Tol</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive-tables.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css">
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

<body class="loginpage">
    <div class="mainwrapper">
	<?php echo $content; ?>
	</div>
	

	<div class="loginfooter">
	    <p>&copy; 2022. BPJT - Badan Pengatur Jalan Tol. All Rights Reserved.</p>
	</div>

	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
				$('#tgl_id').datepicker({
				  format: 'yyyy-mm-dd',
				  autoclose: true
				});
				$('#tgl_en').datepicker({
				  format: 'yyyy-mm-dd',
				  autoclose: true
				});
	</script> 
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
	<script type="text/javascript" src="<?php echo site_url('assets/js/application/dashboard.js'); ?>"></script>
	
	<?php if (isset($jscripts)) { ?>
		<?php foreach($jscripts as $key => $value) { ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script>	
		<?php } ?>
	<?php } ?>
</body>
</html>
