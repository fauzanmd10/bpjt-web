<div class="mediaWrapper row-fluid">
	<div class="span5 imginfo">
    	<img src="<?php echo $media->url; ?>" alt="" width="249" class="imgpreview img-polaroid" id="preview-image" />
        <p style="margin-top: 10px;">
        	<?php if ($this->user_access->edit) { ?>
        	<span id="upload-image" class="btn btn-small fileinput-button" data-token="<?php echo $this->security->get_csrf_hash(); ?>" data-id="<?php echo $media->id; ?>">
				<i class="icon-pencil" title="Upload an Image"></i> Edit Gambar
				<input id="fileuploader" type="file" name="file">
			</span>
			<?php } ?>
			<!--<a href="" class="btn btn-small"><span class="icon-pencil"></span> Edit Gambar</a>-->
			<a href="<?php echo $media->url; ?>" target="_blank" class="btn btn-small"><span class="icon-eye-open"></span> Tampilkan Ukuran Asli</a> 
		</p>
        <p>
        	<strong>Filename:</strong> <?php echo basename($media->url); ?> <br />
        	<strong>File Type:</strong> image/png <br />
        	<strong>Upload Date:</strong> <?php $timestamp = strtotime($media->created_at); echo date('d M Y', $timestamp); ?> <br />
        	<!--<strong>Resolution:</strong> 500x450 <br />
        	<strong>Uploaded by:</strong> <a href="">Admin</a>-->
        </p>
    </div><!--span3-->
    <div class="span7 imgdetails">
    	<?php if ($this->user_access->edit) { ?>
    	<?php echo form_open('admin/photo_galleries/update/' . $media->id); ?>
    	<?php } ?>
	    	<p>
	        	<label>Nama:</label>
	            <input type="text" class="input-block-level" name="title" value="<?php echo $media->title; ?>" />
	        </p>
	        <!--<p>
	        	<label>Alt Text:</label>
	            <input type="text" class="input-block-level" value="imagesatu" />
	        </p>-->
	        <p>
	        	<label>Deskripsi:</label>
	            <textarea name="caption" class="input-block-level"><?php echo strip_tags($media->caption); ?></textarea>
	        </p>
	        <p>
	        	<label>Link URL:</label>
	            <input type="text" class="input-block-level" value="<?php echo $media->url; ?>" readonly />
	        </p>
	        <p>
	        	<label>Tampilkan:</label>
	        	<span class="formwrapper">
		            <input type="radio" name="status" value='published' <?php echo ($media->status == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
					<input type="radio" name="status" value='draft' <?php echo ($media->status == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
				</span>
	        </p>
	        <br />
	        <p>
	        	<?php if ($this->user_access->edit) { ?>
	        	<button class="btn btn-primary"><span class="icon-ok icon-white"></span> Simpan Perubahan</button>
	        	<?php } ?>

	        	<?php if ($this->user_access->destroy) { ?>
				<a href="#" class="btn" id="btn-destroy" data-id="<?php echo $media->id; ?>"><span class="icon-trash"></span> Hapus</a>
				<?php } ?>
				<input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
    			<input type="hidden" id="token-value" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			</p>

	    <?php if ($this->user_access->edit) { ?>
	    <?php echo form_close(); ?>
	    <?php } ?>
    </div><!--span3-->
</div><!--imageWrapper-->
