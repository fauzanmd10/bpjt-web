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
		margin-bottom:40px;
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

.stdform label{
	width:25% !important;
}

.stdform textarea{
	width:70%;
}
.uniformselect{
	width: 35%;
	min-width: 200px;
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
			<?php echo form_open_multipart($form_url, array('class'=>'stdform')); ?>
				<div class="div-part">
					<h4 class="widgettitle">Informasi Ruas Lelang Jalan Tol / Toll Road PreQualification</h4>
					<div class="widgetcontent">
					<p>
						<label>Nama Ruas / Toll Road<span style="color: #f00;">*</span> </label>
						<!-- <input type="text" name="company_name" class="input-xlarge" value="<?php echo (isset($lelang['company_name'])) ? $lelang['company_name'] : ''; ?>"/> -->
						<?php echo form_dropdown('lelang_jt', $ruas, (array_key_exists('lelang_jt', $ruas)) ? $ruas['lelang_jt'] : '', "class='uniformselect'"); ?>
					</p>
					</div>
				</div>

				<div class="div-part">
					<h4 class="widgettitle">Informasi Perusahaan / Company Information</h4>
					<div class="widgetcontent">
					<p>
						<label>Nama Perusahaan / Company Name<span style="color: #f00;">*</span> </label>
						<input type="text" name="company_name" class="input-xlarge" value="<?php echo (isset($lelang['company_name'])) ? $lelang['company_name'] : ''; ?>"/>
					</p>
					<p>
						</br>
					</p>
					<p>
						<label>Nama Direktur Utama / CEO<span style="color: #f00;">*</span></label>
						<input type="text" name="ceo_name" class="input-xlarge" value="<?php echo (isset($lelang['ceo_name'])) ? $lelang['ceo_name'] : ''; ?>"/>
					</p>
					<p>
						<label>Dokumen Pendukung (Dokumen yang dapat menunjukan status jabatan)<span style="color: #f00;">*</span></label>
						<input type="file" name="doc_jabatan" class="input-xlarge" accept=".pdf"/>
					</p>
					
					</div>
				</div>

				
				<div class="div-part">
					<h4 class="widgettitle">Pihak yang melakukan Pendaftaran</h4>
					<div class="widgetcontent">
						<p>
							<label>Nama Kontak / Contact name<span style="color: #f00;">*</span></label>
							<input type="text" name="contact_name" class="input-xlarge" value="<?php echo (isset($employee['contact_name'])) ? $employee['contact_name'] : ''; ?>"/>
						</p>
						<br>
						<p>
							<label>ID Number (KTP, SIM, or Passport)<span style="color: #f00;">*</span></label>
							<input type="text" name="nik" class="input-xlarge"  value="<?php echo (isset($employee['nik'])) ? $employee['nik'] : ''; ?>"/>
						</p>
						<br>

						<p>
							<label>Alamat / Address<span style="color: #f00;">*</span></label>
							<textarea name="address" class="span8" value="<?php echo (isset($lelang['address'])) ? $lelang['address'] : ''; ?>"></textarea>
						</p>
						<p>
							<label>Telepon / Phone<span style="color: #f00;">*</span></label>
							<input type="text" name="telephone" class="input-xlarge" value="<?php echo (isset($lelang['telephone'])) ? $lelang['telephone'] : ''; ?>"/>
						</p>
						<p>
							<label>Handphone<span style="color: #f00;">*</span> </label>
							<input type="text" name="mobile" class="input-xlarge" value="<?php echo (isset($lelang['mobile'])) ? $lelang['mobile'] : ''; ?>"/>
						</p>
						<p>
							<label>Email<span style="color: #f00;">*</span></label>
							<input type="text" name="email" class="input-xlarge" value="<?php echo (isset($lelang['email'])) ? $lelang['email'] : ''; ?>"/>
						</p>
						<p>
							<label>Username<span style="color: #f00;">*</span></label>
							<input type="text" name="username" class="input-xlarge" value="<?php echo (isset($lelang['username'])) ? $lelang['username'] : ''; ?>"/>
						</p>
						<p>
							<label>Password<span style="color: #f00;">*</span></label>
							<input type="password" name="password" class="input-xlarge" value=""/>
						</p>
						<p>
							<label>Konfirmasi Password<span style="color: #f00;">*</span></label>
							<input type="password" name="password_confirmation" class="input-xlarge" value=""/>
						</p>
						
					</div>
				</div>

				<div class="div-part">
					<h4 class="widgettitle">Dokumen Pendukung </h4>
					<div class="widgetcontent">
						<div style="width: 100%;float:left;">
							<label>Apakah Anda Direktur Utama?: <br><br></label>
							<input type="radio" name="is_direktur" value="ya" onchange="selectDirektur()" class="input-xlarge" checked/> Ya<br>
							<input type="radio" name="is_direktur" value="tidak" onchange="selectDirektur()" class="input-xlarge"/> Tidak<br>
						</div>
						<div style="width: 100%;float:left;">
							<label>Upload file (KTP, SIM, Passport) Direktur Utama<span style="color: #f00;">*</span>: <br><br></label>
							<input type="file" name="doc_ktp_direktur" class="input-xlarge" accept=".pdf"/>
						</div>
						<div style="width: 100%;float:left;display:none;" class="form-non-direktur">
							<label>Upload file (KTP, SIM, Passport) Pihak yang Mendaftar<span style="color: #f00;">*</span>: <br>
								<small>* Jika Pihak yang mendaftar merupakan perwakilan dari Direktur Utama</small>
							</label>
							<input type="file" name="doc_ktp_pendaftar" class="input-xlarge" accept=".pdf"/>
						</div>
						<div style="width: 100%;float:left;display:none;" class="form-non-direktur">
							<label>Upload file Surat Kuasa<span style="color: #f00;">*</span>:<br> 
								<small>* Jika Pihak yang mendaftar merupakan perwakilan dari Direktur Utama</small>
							</label>
							<input type="file" name="doc_surat_kuasa" class="input-xlarge" accept=".pdf"/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="div-part">
					Keterangan: <span style="color: #f00;">*</span> wajib diisi
				</div>
				
				<div class="div-btn text-center">
					<input type="hidden" name="reg" value="invest">
					<p class="">
						<button type="submit" id="btn-submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;&nbsp;Save</button>
						<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
						<a href="<?php echo site_url('admin'); ?>" class="btn btn-danger"><i class="iconfa-remove"></i>&nbsp;&nbsp;Close</a>
					</p>
				</div>
				
<!-- 
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
				</div> -->

				
		
			</form>
			
		</div>
	</div>

</div>

<script>
	function selectDirektur(){
		var is_direktur = jQuery('input[name="is_direktur"]:checked').val();
		if(is_direktur == 'ya'){
			jQuery('.form-non-direktur').hide();
		} else {
			jQuery('.form-non-direktur').show();
		}
	}
</script>
