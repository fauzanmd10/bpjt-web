<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<div class="row-fluid">
	<?php echo form_open_multipart('admin/employees/create', array('class'=>'stdform')); ?>
	<input type="hidden" value="<?php echo $content_type; ?>" name="content_type" />
	<input type="hidden" value="<?php echo $sub_content_type; ?>" name="sub_content_type" />
	<div class="span10">
	<div class="widgetbox personal-information">
		<h4 class="widgettitle">Informasi Pribadi</h4>
		<div class="widgetcontent">
		<p>
			<label>Gelar Depan:</label>
			<input type="text" name="front_title" class="input-xlarge" value="<?php echo (isset($employee['front_title'])) ? $employee['front_title'] : ''; ?>"/>
		</p>
		<p>
			<label>Gelar Belakang:</label>
			<input type="text" name="back_title" class="input-xlarge" value="<?php echo (isset($employee['back_title'])) ? $employee['back_title'] : ''; ?>"/>
		</p>
		<p>
			<label>Nama Depan:</label>
			<input type="text" name="first_name" class="input-xlarge" value="<?php echo (isset($employee['first_name'])) ? $employee['first_name'] : ''; ?>"/>
		</p>
		<p>
			<label>Nama Tengah:</label>
			<input type="text" name="middle_name" class="input-xlarge" value="<?php echo (isset($employee['middle_name'])) ? $employee['middle_name'] : ''; ?>"/>
		</p>
		<p>
			<label>Nama Belakang:</label>
			<input type="text" name="last_name" class="input-xlarge" value="<?php echo (isset($employee['last_name'])) ? $employee['last_name'] : ''; ?>"/>
		</p>
		<p>
			<label>Jenis Kelamin:</label>
			<?php if (isset($employee['gender'])) { ?>
				<input type="radio" name="gender" value='pria' <?php echo ($employee['gender'] == 'pria') ? 'checked' : ''; ?> /> Pria &nbsp; &nbsp;
				<input type="radio" name="gender" value='wanita' <?php echo ($employee['gender'] == 'wanita') ? 'checked' : ''; ?> /> Wanita  &nbsp; &nbsp;
			<?php } else { ?>
				<input type="radio" name="gender" value="pria" /> Pria &nbsp; &nbsp;
				<input type="radio" name="gender" value="wanita" /> Wanita  &nbsp; &nbsp;
			<?php } ?>
		</p>
		<p>
			<label>Agama:</label>
			<?php echo form_dropdown('religion', $this->religion, (array_key_exists('religion', $employee)) ? $employee['religion'] : '', "class='uniformselect'"); ?>
		</p>
		<p>
			<label>Status Pernikahan:</label>
			<?php if (isset($employee['marital_status'])) { ?>
				<input type="radio" name="marital_status" value='menikah' <?php echo ($employee['marital_status'] == 'menikah') ? 'checked' : ''; ?> /> Menikah &nbsp; &nbsp;
				<input type="radio" name="marital_status" value='belum_menikah' <?php echo ($employee['marital_status'] == 'belum_menikah') ? 'checked' : ''; ?> /> Belum Menikah  &nbsp; &nbsp;
			<?php } else { ?>
				<input type="radio" name="marital_status" value="menikah" /> Menikah &nbsp; &nbsp;
			<input type="radio" name="marital_status" value="belum_menikah" /> Belum Menikah  &nbsp; &nbsp;
			<?php } ?>
		</p>
		<p>
			<label>Golongan darah:</label>
			<?php echo form_dropdown('blood_type', $this->blood_type, (array_key_exists('blood_type', $employee)) ? $employee['blood_type'] : '', "class='uniformselect'"); ?>
		</p>
		<p>
			<label>Tentang Pegawai:</label>
			<textarea name="description" class="span8" value="<?php echo (isset($employee['description'])) ? $employee['description'] : ''; ?>"></textarea>
		</p>
		<p>
			<div class="par">
				<label>Photo :</label>
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="input-append">
						<div class="uneditable-input span3">
							<i class="iconfa-file fileupload-exists"></i>
							<span class="fileupload-preview"></span>
						</div>
						<span class="btn btn-file">
							<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Pilih File</span>
							<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
							<input name="image" type="file" />
				 		</span>
						<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
					</div>
				</div>
			</div>
			<small class="desc-image">Deskripsi ukuran lebar dan tinggi gambar dalam pixel.</small>
		</p>
		</div>
		<div class="widgetbox login-information">
			<h4 class="widgettitle">Kontak</h4>
			<div class="widgetcontent">
			<p>
				<label>Status Tempat Tinggal:</label>
				<?php echo form_dropdown('residence_status', $this->residence_status, (array_key_exists('residence_status', $employee)) ? $employee['residence_status'] : '', "class='uniformselect'"); ?>
			</p><br />
			<p>
				<label>Alamat:</label>
				<textarea name="address" class="span8" value="<?php echo (isset($employee['address'])) ? $employee['address'] : ''; ?>"></textarea>
			</p>
			<p>
				<label>Propinsi:</label>
				<?php echo form_dropdown('province_id', $provinces, (array_key_exists('province_id', $employee)) ? $employee['province_id'] : '', "class='uniformselect'"); ?>
			</p>
			<p>
				<label>Kabupaten:</label>
				<?php echo form_dropdown('district_id', $districts, (array_key_exists('district_id', $employee)) ? $employee['district_id'] : '', "class='uniformselect'"); ?>
			</p>
			<p>
				<label>Kecamatan:</label>
				<?php echo form_dropdown('subdistrict_id', $subdistricts, (array_key_exists('subdistrict_id', $employee)) ? $employee['subdistrict_id'] : '', "class='uniformselect'"); ?>
			</p>
			<p>
				<label>Kode pos:</label>
				<input type="text" name="zipcode" class="input-xlarge" value="<?php echo (isset($employee['zipcode'])) ? $employee['zipcode'] : ''; ?>"/>
			</p>
			<p>
				<label>Telepon:</label>
				<input type="text" name="telephone" class="input-xlarge" value="<?php echo (isset($employee['telephone'])) ? $employee['telephone'] : ''; ?>"/>
			</p>
			<p>
				<label>Hp:</label>
				<input type="text" name="mobile" class="input-xlarge" value="<?php echo (isset($employee['mobile'])) ? $employee['mobile'] : ''; ?>"/>
			</p>
			<p>
				<label>Email:</label>
				<input type="text" name="email" class="input-xlarge" value="<?php echo (isset($employee['email'])) ? $employee['email'] : ''; ?>"/>
			</p>
			</div>
		</div>
	</div>
	<div class="widgetbox login-information">
		<h4 class="widgettitle">Informasi Kelahiran / Kematian</h4>
		<div class="widgetcontent">
		<p>
			<label>Tempat lahir:</label>
			<input type="text" name="birthplace" class="input-xlarge" value="<?php echo (isset($employee['birthplace'])) ? $employee['birthplace'] : ''; ?>"/>
		</p>
		<p>
			<label>Tanggal lahir:</label>
			<?php 
				$date[0] = "- Tanggal -";
				for($i = 1; $i <= 31; $i++) $date["0".$i] = $i;
				$month = array(
					"0" => "- Bulan -", "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", 
					"05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", 
					"10" => "Oktober", "11" => "November", "12" => "Desember"
				);
				echo form_dropdown('bdate', $date, '', "class='date'");
				echo form_dropdown('bmonth', $month, '', "class='month'");
			?>
			<input type="text" name="byear" class="year" placeholder="- Tahun -" />
		</p>
		<p>
			<label>Akta lahir:</label>
			<input type="text" name="birth_certificate" class="input-xlarge" />
		</p>

			<input type="hidden" name="ddate" value="00" />
			<input type="hidden" name="dmonth" value="00" />
			<input type="hidden" name="dyear" value="0000" />
			<input type="hidden" name="dead_certificate" value="" />
		</div>
	</div>
	<div class="widgetbox login-information">
		<h4 class="widgettitle">Informasi Tambahan</h4>
		<div class="widgetcontent">
		<p>
			<label>Status Pegawai:</label>
			<?php echo form_dropdown('employee_status', $this->employee_status, (array_key_exists('employee_status', $employee)) ? $employee['employee_status'] : '', "class='uniformselect'"); ?>
		</p>
		<p>
			<label>NIP:</label>
			<input type="text" name="nip" class="input-xlarge"  value="<?php echo (isset($employee['nip'])) ? $employee['nip'] : ''; ?>"/>
		</p>
		<p>
			<label>Taspen:</label>
			<input type="text" name="taspen" class="input-xlarge"  value="<?php echo (isset($employee['taspen'])) ? $employee['taspen'] : ''; ?>"/>
		</p>
		<p>
			<label>Askes:</label>
			<input type="text" name="askes" class="input-xlarge"  value="<?php echo (isset($employee['askes'])) ? $employee['askes'] : ''; ?>"/>
		</p>
		<p>
			<label>NPWP:</label>
			<input type="text" name="npwp" class="input-xlarge"  value="<?php echo (isset($employee['npwp'])) ? $employee['npwp'] : ''; ?>"/>
		</p>
		<p>
			<label>Username</label>
			<input type="text" name="username" id="username" class="input-xlarge" placeholder="Username" value="<?php echo (isset($user)) ? $user['username'] : ''; ?>" />
		</p>
		<p>
			<label>Password</label>
			<input type="password" name="password" id="password" class="input-xlarge" placeholder="Password" />
		</p>
		<p>
			<label>Konfirmasi Password</label>
			<input type="password" name="password_confirmation" id="password-confirmation" class="input-xlarge" placeholder="Konfirmasi Password" />
		</p>
		<p>
			<label>Grup Pengguna</label>
			<?php echo form_dropdown('user_group_id', $user_groups, (array_key_exists('user_group_id', $employee)) ? $employee['user_group_id'] : '', "class='uniformselect'"); ?>
		</p>		
		<p>
			<label>Terbitkan:</label>
			<?php if (isset($employee['status'])) { ?>
				<input type="radio" name="status" value='published' <?php echo ($employee['status'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
				<input type="radio" name="status" value='draft' <?php echo ($employee['status'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
			<?php } else { ?>
				<input type="radio" name="status" value='published' /> Ya &nbsp; &nbsp;
				<input type="radio" name="status" value='draft' checked/> Tidak  &nbsp; &nbsp;
			<?php } ?>
		</p>
		</div>
	</div>
	<p class="stdformbutton">
		<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Simpan</button>
		<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
		<a href="<?php echo site_url('admin/employees'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
	</div><!--span8-->
	</form>
</div><!--row-fluid-->
