<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php }
	if($this->input->get('sukses')){ 
		echo '<script language="javascript">';
		echo 'alert("Registration Success");';
		// redirect("/");
		// echo 'window.location.href="/";';
		echo '</script>';
}else if($this->input->get('failed')){
		echo '<script language="javascript">';
		echo 'alert("Registration Failed");';
		// echo ' window.location = "/register';
		echo '</script>';
} ?>
<style>
	.container-fluid {
    padding-right: 15%;
    padding-left: 15%;
}
	.row-in {
		/* border: 1px solid white; */
		padding:auto;
		background:white;
		padding-top:30px;
		min-height:400px;
		border-radius:10px;
		margin-top:40px;
		padding-bottom:30px;
		align-content:center;
}
.row-out{
	margin-top:20px;
	margin-bottom:50px;
}
body{
	/* background:white !important; */
}
.div-part{
	padding-left:20px;
	padding-right:20px;

}

.widgettitle{
	border-top-left-radius:10px;
	border-top-right-radius:10px;
}

.widgetcontent{
	/* border:1px solid tranparent; */
	border-bottom-left-radius:10px; 
	border-bottom-right-radius:10px; 
}

.par{
	padding-bottom:50px;
}

.btn{
	border-radius:5px;	
	color: #fff !important;
}
i{
	/* background */
}
a{
	color: #fff;
}
.text-center{
	text-align: center;
}
#btn-utama{
	margin-left:5px;
	margin-right:5px;
}
</style>

<div id="content" class="container-fluid">
	<div class="row">
		<div class="col-md-12 row-out">
			<div class=""><img src="<?php echo base_url(); ?>assets/images/logo-bpjt-medium.png" alt="" /></div>
		</div>
		<div class="col-md-12 text-center">
			<?=$isi?>
			<?php if ($utama) { ?>
				<a href="<?php echo $utama?>" id="btn-utama" class="btn btn-success">Halaman Utama</a>
			<?php } ?>
			
			<?php if ($return) { ?>
				<a href="<?php echo $return?>" class="btn btn-danger">Kembali</a>
			<?php } ?>
			
			
		</div>
	</div>

</div>
