<div class="mediaWrapper row-fluid">
	<div class="span5 imginfo">
    	<p style="margin-top: 10px;">
    		<?php if ($this->user_access->edit) { ?>
        	<span id="upload-image" class="btn btn-small fileinput-button" data-token="<?php echo $this->security->get_csrf_hash(); ?>" data-id="<?php echo $document->id; ?>">
				<i class="icon-pencil" title="Upload an Image"></i> Edit File
				<input id="fileuploader" type="file" name="file">
			</span>
			<?php } ?>
			<!--<a href="" class="btn btn-small"><span class="icon-pencil"></span> Edit Gambar</a>-->
			<a href="<?php echo $document->url; ?>" target="_blank" class="btn btn-small"><span class="icon-eye-open"></span> Lihat File </a> 
		  </p>
        <p>
        	<strong>Filename:</strong> <?php echo basename($document->url); ?> <br />
        	<strong>File Type:</strong> application/pdf <br />
        	<strong>Upload Date:</strong> <?php echo $document->created_at; ?> <br />
        	<!--<strong>Resolution:</strong> 500x450 <br />
        	<strong>Uploaded by:</strong> <a href="">Admin</a>-->
        </p>
    </div><!--span3-->
    <div class="span7 imgdetails">
    	<?php if ($this->user_access->edit) { ?>
    	<?php echo form_open('admin/regulations/update/' . $document->id); ?>
    	<?php } ?>
	    	<p>
	        	<label>Nama:</label>
	            <input name="title" type="text" class="input-block-level" value="<?php echo $document->title; ?>" />
	        </p>
	        <!--<p>
	        	<label>Alt Text:</label>
	            <input type="text" class="input-block-level" value="imagesatu" />
	        </p>-->
	        <p>
	        	<label>Deskripsi:</label>
	            <textarea name="caption" class="input-block-level"><?php echo strip_tags($document->caption); ?></textarea>
	        </p>
	        <p>
	        	<label>Link URL:</label>
	            <input type="text" class="input-block-level" value="<?php echo $document->url; ?>" readonly />
	        </p>
	        <br />
	        <p>
	        	<?php if ($this->user_access->edit) { ?>
	        	<button class="btn btn-primary"><span class="icon-ok icon-white"></span> Simpan Perubahan</button>
	        	<?php } ?>

	        	<?php if ($this->user_access->destroy) { ?>
				<a href="#" class="btn" id="btn-destroy" data-id="<?php echo $document->id; ?>"><span class="icon-trash"></span> Hapus</a>
				<?php } ?>
				<input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	        </p>

	    <?php if ($this->user_access->edit) { ?>
	    <?php echo form_close(); ?>
	    <?php } ?>
    </div><!--span3-->
</div><!--imageWrapper-->
