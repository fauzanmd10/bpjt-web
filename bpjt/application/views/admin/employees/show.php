<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>


<div class="row-fluid">
	<div class="span4 profile-left">
		<div class="widgetbox profile-photo">
			<div class="headtitle">
				<h4 class="widgettitle">Photo Profil</h4>
			</div>
            <div class="widgetcontent">
				<div class="profilethumb">
					<?php if(!empty($employee->photo)): ?>
						<img src="<?php echo $this->employee->get_photo_by_style($employee->photo, 'sq177'); ?>" alt="" class="img-polaroid" />
					<?php else: ?>
						<img src="<?php echo base_url() ?>/assets/images/profilethumb.png" alt="" class="img-polaroid" />
					<?php endif; ?>
				</div><!--profilethumb-->
			</div>
		</div>
		<div class="widgetbox login-information">
			<h4 class="widgettitle">Informasi Kelahiran / Kematian</h4>
			<div class="widgetcontent">
			<p><label>Tempat lahir:</label><?php echo $employee->birthplace; ?></p>
			<p><label>Tanggal lahir:</label><?php echo $employee->birthdate; ?></p>
			<p><label>Akta lahir:</label><?php echo $employee->birth_certificate; ?></p>
			<p><label>Tanggal kematian:</label><?php echo $employee->date_of_death; ?></p>
			<p><label>Akta kematian:</label><?php echo $employee->dead_certificate; ?></p>
			</div>
		</div>
		<div class="widgetbox login-information">
			<h4 class="widgettitle">Informasi Tambahan</h4>
			<div class="widgetcontent">
			<p>
				<label>Status Pegawai:</label>
				<?php 
					if(!empty($employee->employee_status) && array_key_exists($employee->employee_status, $this->employee_status)) 
						echo $this->employee_status[$employee->employee_status];
				?>
			</p>
			<p><label>NIP:</label><?php echo $employee->nip; ?></p>
			<p><label>Taspen:</label><?php echo $employee->taspen; ?></p>
			<p><label>Askes:</label><?php echo $employee->askes; ?></p>
			<p><label>NPWP:</label><?php echo $employee->npwp; ?></p>
			<p><label>Status:</label><?php echo ucfirst($employee->status); ?></p>
			<p><label>Username:</label><?php echo $employee->username; ?></p>
			<p><label>User Group:</label><?php echo $user_groups[$employee->user_group_id]; ?></p>
			</div>
		</div>
	</div><!--span4-->
	<div class="span8">
	<div class="widgetbox personal-information">
		<h4 class="widgettitle">Informasi Pribadi</h4>
		<div class="widgetcontent">
		<p>
			<?php 
				$name = null;
				if(!empty($employee->front_title)) $name .= trim($employee->front_title, '.').'. '; 
				$name .= $employee->first_name;
				if(!empty($employee->middle_name)) $name .= ' '.$employee->middle_name;
				if(!empty($employee->last_name)) $name .= ' '.$employee->last_name;
				if(!empty($employee->back_title)) $name .= ' '.trim($employee->back_title).'.';
			?>
			<label>Nama: </label><?php echo $name; ?>
		</p>
		<p><label>Jenis Kelamin:</label><?php echo ucfirst($employee->gender)?></p>
		<p>
			<label>Agama:</label>
			<?php 
				if(!empty($employee->religion) && array_key_exists($employee->religion, $this->religion))
					echo $this->religion[$employee->religion];
			?>
		</p>	
		<p><label>Status Pernikahan:</label><?php echo ucfirst(str_replace("_", " ", $employee->marital_status)); ?></label></p>
		<p><label>Golongan Darah:</label><?php echo $employee->blood_type; ?></p>
		<p><label>Tentang Pegawai:</label><?php echo $employee->description; ?></p>
		</div>
		<div class="widgetbox login-information">
			<h4 class="widgettitle">Kontak</h4>
			<div class="widgetcontent">
				<p>
					<label>Status tempat tinggal:</label>
					<?php 
						if(!empty($employee->residence_status) && array_key_exists($employee->residence_status, $this->residence_status))
							echo $this->residence_status[$employee->residence_status];
					?>
				</p>
				<p><label>Alamat:</label><?php echo $employee->address; ?></p>
				<p>
					<label>Propinsi:</label>
					<?php 
						if(!empty($employee->province_id) && array_key_exists($employee->province_id, $provinces)) 
							echo $provinces[$employee->province_id];
					?>
				</p>
				<p>
					<label>Kabupaten:</label>
					<?php 
						if(!empty($employee->district_id) && array_key_exists($employee->district_id, $districts))
							echo $districts[$employee->district_id];
					?>
				</p>
				<p>
					<label>Kecamatan:</label>
					<?php 
						if(!empty($employee->subdistrict_id) && array_key_exists($employee->subdistrict_id, $subdistricts)) 
							echo $subdistricts[$employee->subdistrict_id];
					?>
				</p>
				<p><label>Kode Pos:</label><?php echo $employee->zipcode; ?></p>
				<p><label>Telepon:</label><?php echo $employee->telephone; ?></p>
				<p><label>Hp:</label><?php echo $employee->mobile; ?></p>
				<p><label>Email:</label><?php echo $employee->email; ?></p>
			</div>
		</div>
	</div>
	</div><!--span8-->
</div><!--row-fluid-->

<a href="<?php echo site_url('admin/employees'); ?>" id="btn-edit" class="btn">Kembali</a>
