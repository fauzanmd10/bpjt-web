<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php }
	if($this->session->flashdata('sukses')){ 
		echo '<script language="javascript">';
		echo 'alert("Registration Success");';
		// redirect("/");
		echo 'window.location.href="/";';
		echo '</script>';
}else if($this->session->flashdata('failed')){
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
		min-height:500px;
		border-radius:10px;
		margin-top:40px;
		padding-bottom:30px;
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
}
i{
	/* background */
}

#note{
	font-size:12px;
	font-family:italic;
}
</style>

<div id="content" class="container-fluid">
	<div class="row">
		<div class="col-md-12 row-out">
			<div class=""><img src="<?php echo base_url(); ?>assets/images/logo-bpjt-medium.png" alt="" /></div>
			<h4 class="lead" style="text-align: center;color: white;"><strong><u>PreQualification Registration</u></strong></h4>
			<h2 class="lead" style="text-align: center;color: white;"><strong>Investment</strong></h2>

		</div>
		<div class="col-md-12 row-in">
		<?php echo form_open_multipart('create_reg_user', array('class'=>'stdform')); ?>

			<input type="hidden" name="id" value="<?=$id?>">
			<input type="hidden" name="jenis" value="<?=$jenis?>">
				<div class="div-part">
					<h4 class="widgettitle">File</h4>
					<div class="widgetcontent">
						<p>
						<div >
						
							<span>Scan ID dan Surat Kuasa jika anda bukan CeO/Power of Attorney if you are not the CeO</span>
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="input-append">
									<div class="uneditable-input span3">
										<i class="iconfa-file fileupload-exists"></i>
										<span class="fileupload-preview"></span>
									</div>
									<span class="btn btn-file">
										<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Choose File</span>
										<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Edit</span>
										<input name="image" type="file" />
									</span>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Delete</a>
								</div>
							</div>
							<span>Note :</span><br>
							<span id="note"> Pastikan file surat kuasa yang diupload telah sesuai dengan tipe file pdf, setelah melakukan pengisian data akun diatas, petugas kami akan melakukan verifikasi kembali, peserta lelang dapat melakukan login dengan akun yang didaftarkan jika sudah dilakukan approval oleh petugas kami</span>
						</div>
						</p>
					</div>
				</div>

				<div class="div-part">
					<h4 class="widgettitle">Informasi Akun / Others </h4>
					<div class="widgetcontent">
					<p>
						<label>Username</label>
						<input type="text" name="username" id="username" class="input-xlarge" placeholder="Username" value="<?php echo (isset($user)) ? $user['username'] : ''; ?>" />
					</p>
					<p>
						<label>Password</label>
						<input type="password" name="password" id="password" class="input-xlarge" placeholder="Password" />
					</p>
					<p>
						<label>Confirmation Password</label>
						<input type="password" name="password_confirmation" id="password-confirmation" class="input-xlarge" placeholder="Konfirmasi Password" />
					</p>	
					</div>
				</div>

				<div class="div-btn text-center">
					<p class="">
						<button type="submit" id="btn-submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;&nbsp;Save</button>
						<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
						<a href="<?php echo site_url('admin'); ?>" class="btn btn-danger"><i class="iconfa-remove"></i>&nbsp;&nbsp;Close</a>
					</p>
				</div>
		
			</form>
			
		</div>
	</div>

</div>
