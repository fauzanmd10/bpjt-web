<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/photo_albums/create', array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Tambah Album Foto</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
						<li><a class="sub" data-toggle="tab" href="#inggris">Bahasa Inggris</a></li>
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Nama</label>
								<span class="field"><input type="text" name="name_id" id="name-id" class="input-xxlarge" placeholder="Nama" value="<?php echo (isset($album)) ? $album['name_id'] : ''; ?>" /></span>
							</p>
							<p>
					        	<label>Deskripsi :</label>
					        	<span class="field">
					                <textarea name="description_id" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80"><?php echo isset($album['description_id']) ? $album['description_id'] : ""; ?></textarea>
				                </span> 
					        </p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (isset($album)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($album['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($album['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
						</div>
						<div id="inggris" class="tab-pane">
							<p>
								<label>Name</label>
								<span class="field"><input type="text" name="name_en" id="name-en" class="input-xxlarge" placeholder="Name" value="<?php echo (isset($album)) ? $album['title_en'] : ''; ?>" /></span>
							</p>
							<p>
					        	<label>Description :</label>
					        	<span class="field">
					                <textarea name="description_en" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80"><?php echo isset($album['description_en']) ? $album['description_en'] : ""; ?></textarea>
				                </span> 
					        </p>
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<?php if (isset($album)) { ?>
									<input type="radio" name="status_en" value='published' <?php echo ($album['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($album['status_en'] == 'draft') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_en" value='published' /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' checked/> No  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/photo_albums'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 