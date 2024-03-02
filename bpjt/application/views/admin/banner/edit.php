<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/banner/update/' . $id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah Banner</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">					
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Judul Banner</label>
								<span class="field"><input type="text" name="judul" id="judul" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($banner->judul)) ? $banner->judul : ''; ?>" /></span>
							</p>
							<p>
								<label>Deskripsi Banner</label>
								<span class="field"><textarea name="deskripsi" id="deskripsi" class="input-xxlarge" placeholder="Deskripsi"><?php echo (isset($banner->deskripsi)) ? $banner->deskripsi : ''; ?></textarea></span>
							</p>
							<p>
								<label>Jenis</label>
								<span class="field">
									<select name="jenis" id="jenis" class="uniformselect">
										<option value="image">Image</option>
										<option value="video">Video</option>
									</select>
								</span>
							</p>
							<p>
								<label>URL Video</label>
								<span class="field"><input type="text" name="url_video" id="url_video" class="input-xxlarge" placeholder="URL Video" value="<?php echo (isset($banner->url_video)) ? $banner->url_video : ''; ?>" /></span>
							</p>
							<p>
								<label>Image</label>
								<span class="field"><input name="image" type="file" accept=".jpg" /></span>
								<small class="desc-image" style="margin-top: 20px;">Ukuran maksimal gambar 1MB.</small>
							</p>
							<p>
								<label>Status</label>
								<span class="formwrapper">
									<input type="radio" name="status" value="aktif" <?php echo ($banner->status ?? '' == 'aktif') ? 'checked' : ''; ?> /> Aktif &nbsp; &nbsp;
									<input type="radio" name="status" value="draft" <?php echo (($banner->status ?? '' == 'draft') || ($banner->status ?? '' == '')) ? 'checked' : ''; ?> /> Draft  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/banner'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 