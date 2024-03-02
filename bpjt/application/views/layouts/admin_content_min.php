<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php if (isset($stylesheets)) { ?>
		<?php foreach($stylesheets as $stylesheet) { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $stylesheet; ?>">
		<?php } ?>
	<?php } ?>
</head>
<body>
	<?php echo $content; ?>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-ui-1.9.2.min.js"></script>
	<?php if (isset($jscripts)) { ?>
		<?php foreach($jscripts as $key => $value) { ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script>	
		<?php } ?>
	<?php } ?>
</body>
</html>