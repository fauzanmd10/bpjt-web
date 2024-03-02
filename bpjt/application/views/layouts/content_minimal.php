<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> -->
	<?php if (isset($stylesheets)) { ?>
		<?php foreach($stylesheets as $stylesheet) { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $stylesheet; ?>">
		<?php } ?>
	<?php } ?>
</head>
<body>	
	<?php echo $content; ?>

	<?php if (isset($jscripts)) { ?>
		<?php foreach($jscripts as $key => $value) { ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/<?php echo $value; ?>/<?php echo $key; ?>"></script>	
		<?php } ?>
	<?php } ?>
</body>
</html>
