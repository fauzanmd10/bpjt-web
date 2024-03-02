<div class="mediaWrapper row-fluid">
<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>
<?php if (!empty($this->session->flashdata('lelang_user_success'))) { ?>
    <div class="alert alert-success">
    Berhasil ubah data peserta
</div>
<?php } ?>
<?php if (!empty($this->session->flashdata('lelang_user_failed'))) { ?>
<div class="alert alert-danger">
	Gagal ubah data peserta
</div>
<?php } ?>

	<div class="span7 imgdetails">
    	<?php if ($this->user_access->edit) { ?>
    	<?php echo form_open_multipart('admin/lelangs/update/' . $lelang->id); ?>
    	<?php } ?>
	    	<p>
	        	<label>Nama Ruas / Toll Road :</label>
	            <input type="text" class="input-block-level" value="<?php echo $lelang->ruas; ?>" readonly/>
	        </p>
	        <!--<p>
	        	<label>Alt Text:</label>
	            <input type="text" class="input-block-level" value="imagesatu" />
	        </p>-->
	        <p>
	        	<label>Nama Perusahaan / Company Name :</label>
	            <textarea name="company_name" class="input-block-level"><?php echo strip_tags($lelang->company_name); ?></textarea>
	        </p>
	        <p>
	        	<label>Nama Direktur Utama / CEO:</label>
	            <input type="text" name="ceo_name" class="input-block-level" value="<?php echo strip_tags($lelang->ceo_name); ?>" />
	        </p>
	        <p>
	        	<label>Dokumen Pendukung (Dokumen yang dapat menunjukan status jabatan):</label>
				<?php
				if($lelang->doc_jabatan):
				?>
	            <a href="https://bpjt.pu.go.id/uploads/lelangs/<?php echo $lelang->id . '/' . $lelang->doc_jabatan?>" target="_blank">
					<img src="https://bpjt.pu.go.id/assets/images/thumbs/doc.png" alt="" width="125" id="medialist2">
				</a>
				<br>
				<?php
				if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
				?>
				<input type="file" name="doc_jabatan" class="input-xlarge" accept=".pdf"/>
				<?php
				}
				?>
				<?php
				else:
				?>
					Tidak ada file
					<br>
					<?php
					if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
					?>
					<input type="file" name="doc_jabatan" class="input-xlarge" accept=".pdf"/>
					<?php
					}
					?>
				<?php
				endif;
				?>
	        </p>
	        <p>
	        	<label>Nama Kontak / Contact name:</label>
	            <input name="contact_name" type="text" class="input-block-level" value="<?php echo strip_tags($lelang->contact_name); ?>" />
	        </p>
	        <p>
	        	<label>ID Number (KTP, SIM, or Passport):</label>
	            <input name="nik" type="text" class="input-block-level" value="<?php echo strip_tags($lelang->nik); ?>" />
	        </p>
	        <p>
	        	<label>Alamat / Address:</label>
	            <textarea name="address" class="input-block-level"><?php echo strip_tags($lelang->address); ?></textarea>
	        </p>
	        <p>
	        	<label>Telepon / Phone:</label>
	            <input name="telephone" type="text" class="input-block-level" value="<?php echo strip_tags($lelang->telephone); ?>" />
	        </p>
	        <p>
	        	<label>Handphone:</label>
	            <input name="mobile" type="text" class="input-block-level" value="<?php echo strip_tags($lelang->mobile); ?>" />
	        </p>
	        <p>
	        	<label>Email:</label>
	            <input type="text" name="email" class="input-block-level" value="<?php echo strip_tags($lelang->email); ?>" />
	        </p>
			<p>
	        	<label>Dokumen (KTP, SIM, Passport) Direktur Utama:</label>
				<?php
				if($lelang->doc_ktp_direktur):
				?>
	            <a href="https://bpjt.pu.go.id/uploads/lelangs/<?php echo $lelang->id . '/' . $lelang->doc_ktp_direktur?>" target="_blank">
					<img src="https://bpjt.pu.go.id/assets/images/thumbs/doc.png" alt="" width="125" id="medialist2">
				</a>
				<br>
				<?php
				if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
				?>
				<input type="file" name="doc_ktp_direktur" class="input-xlarge" accept=".pdf"/>
				<?php
				}
				?>
				<?php
				else:
				?>
					Tidak ada file
					<br>
					<?php
					if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
					?>
					<input type="file" name="doc_ktp_direktur" class="input-xlarge" accept=".pdf"/>
					<?php
					}
					?>
				<?php
				endif;
				?>
	        </p>
			<p>
	        	<label>Dokumen (KTP, SIM, Passport) Pihak yang Mendaftar:</label>
				<?php
				if($lelang->doc_ktp_pendaftar):
				?>
	            <a href="https://bpjt.pu.go.id/uploads/lelangs/<?php echo $lelang->id . '/' . $lelang->doc_ktp_pendaftar?>" target="_blank">
					<img src="https://bpjt.pu.go.id/assets/images/thumbs/doc.png" alt="" width="125" id="medialist2">
				</a>
				<br>
				<?php
				if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
				?>
				<input type="file" name="doc_ktp_pendaftar" class="input-xlarge" accept=".pdf"/>
				<?php
				}
				?>
				<?php
				else:
				?>
					Tidak ada file
					<br>
					<?php
					if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
					?>
					<input type="file" name="doc_ktp_pendaftar" class="input-xlarge" accept=".pdf"/>
					<?php
					}
					?>
				<?php
				endif;
				?>
	        </p>
			<p>
	        	<label>Dokumen Surat Kuasa:</label>
				<?php
				if($lelang->doc_surat_kuasa):
				?>
	            <a href="https://bpjt.pu.go.id/uploads/lelangs/<?php echo $lelang->id . '/' . $lelang->doc_surat_kuasa?>" target="_blank">
					<img src="https://bpjt.pu.go.id/assets/images/thumbs/doc.png" alt="" width="125" id="medialist2">
				</a>
				<br>
				<?php
				if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
				?>
				<input type="file" name="doc_surat_kuasa" class="input-xlarge" accept=".pdf"/>
				<?php
				}
				?>
				<?php
				else:
				?>
					Tidak ada file
					<br>
					<?php
					if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
					?>
					<input type="file" name="doc_surat_kuasa" class="input-xlarge" accept=".pdf"/>
					<?php
					}
					?>
				<?php
				endif;
				?>
	        </p>
	        
			<p>
	        	<label>Username :</label>
	            <input name="username" type="text" class="input-block-level" value="<?php echo strip_tags($lelang->username); ?>" />
	        </p>
			<?php
			if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {
			?>
	        <p>
	        	<label>Password :</label>
	            <input name="password" type="password" class="input-block-level" value="" />
	        </p>
	        <p>
	        	<label>Konfirmasi Password :</label>
	            <input name="password_confirmation" type="password" class="input-block-level" value="" />
	        </p>
			<?php
			}
			?>
			<p>
	        	<label>Terakhir Update :</label>
	            <div><?php echo date('Y-m-d H:i:s', strtotime($lelang->updated_at) + (3600 * 7)); ?></div>
	        </p>

	        <br />
	        <p>
	        	<?php if ($this->user_access->edit) { ?>
	        	<button class="btn btn-primary"><span class="icon-ok icon-white"></span> Simpan Perubahan</button>
	        	<?php } ?>

				<!-- <?php if ($this->user_access->destroy) { ?>
				<a href="#" class="btn" id="btn-destroy" data-id="<?php echo $lelang->id; ?>"><span class="icon-trash"></span> Hapus</a>
				<?php } ?>
				<input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_hash(); ?>" /> -->
	        </p>

			<a href="<?php echo site_url('auctions_list'); ?>" id="btn-edit" class="btn">Kembali</a>

	    <?php if ($this->user_access->edit) { ?>
	    <?php echo form_close(); ?>
	    <?php } ?>
    </div><!--span3-->
</div><!--imageWrapper-->
