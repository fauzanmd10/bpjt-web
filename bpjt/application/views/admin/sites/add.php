<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } elseif (!empty($flash_success)) { ?>
	<div class="alert alert-success">
		<p>Data sudah berhasil disimpan.</p>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/sites/create', array('class'=>'stdform')); ?>
	<input type="hidden" value="site" name="content_type" />
	<input type="hidden" value="" name="sub_content_type" />
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Tambah Situs Terkait</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Nama Situs</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($site['title_id'])) ? $site['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								<label>URL</label>
								<span class="field"><input type="text" name="content_id" id="content-id" class="input-xxlarge" placeholder="URL" value="<?php echo (isset($site['content_id'])) ? $site['content_id'] : ''; ?>" /></span>
							</p>
							<div class="par">
					        	<label>Logo :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					           				<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Pilih File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
					        				<input name="logo_id" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Deskripsi ukuran lebar dan tinggi gambar dalam pixel.</small>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (!empty($site)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($site['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($site['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
						</div>
					</div>
	            </div>
			</div><!--tab-pane-->
	    </div><!--tabcontent-->
	</div><!--tabbable-->
	<br/>

	<p class="stdformbutton">
		<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Simpan</button>
		<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
		<!-- <a href="<?php //echo site_url('admin/articles'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a> -->
	</p>
<?php echo form_close(); ?> 