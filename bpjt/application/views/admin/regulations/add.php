<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>
<?php if ($this->session->flashdata('fail')) { ?>

	<div class="alert alert-error">
		<?php echo @$this->session->flashdata('fail'); ?>
	</div>
<?php } ?>
	<?php echo form_open_multipart('admin/regulations/create', array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Upload File Baru</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
						<!-- <li><a class="sub" data-toggle="tab" href="#inggris">Bahasa Inggris</a></li> -->
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Judul</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($document['title_id'])) ? $document['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								Deskripsi :
								<div>
									<textarea id="content-id" name="content_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce" ><?php echo isset($document['content_id']) ? $document['content_id'] : ""; ?></textarea>
								</div>
							</p>
							<div class="par">
					        	<label>File :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					           				<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Pilih File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
					        				<input name="file_id" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Deskripsi ukuran file dalam kb.</small>
							<p>
								<label>Type Peraturan</label>
								<span class="field">
	                                <?php $this->types[0] = '- Pilih Tipe Peraturan -'; ?>
	                                <?php echo form_dropdown('type_id', $this->types, (!empty($document)) ? $document['type_id'] : '', "class='uniformselect'"); ?>
								</span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (!empty($document)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($document['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($document['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
						</div>
						<div id="inggris" class="tab-pane">
							<p>
								<label>Title</label>
								<span class="field"><input type="text" name="title_en" id="title-en" class="input-xxlarge" placeholder="Title" value="<?php echo (!empty($document['title_en'])) ? $document['title_en'] : ''; ?>" /></span>
							</p>
							<p>
								Description :
								<div>
									<textarea id="content-en" name="content_en" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce" ><?php echo (!empty($document['content_en'])) ? $document['content_en'] : ""; ?></textarea>
								</div>
							</p>
							<div class="par">
					        	<label>File :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					            			<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Select File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Change</span>
					        				<input name="file_en" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Description of file size in kilobytes.</small>
							<p>
								<label>Regulation Type</label>
								<span class="field">
									<?php $this->types[0] = '- Choose Regulation Type -'; ?>
	                                <?php echo form_dropdown('type_en', $this->types, (!empty($document)) ? $document['type_en'] : '', "class='uniformselect'"); ?>
								</span>
							</p>                    
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<?php if (!empty($article)) { ?>
									<input type="radio" name="status_en" value='published' <?php echo ($document['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($document['status_en'] == 'draft') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/regulations'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 