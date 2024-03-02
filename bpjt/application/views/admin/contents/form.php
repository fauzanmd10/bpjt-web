<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } elseif (!empty($flash_success)) { ?>
	<div class="alert alert-success">
		<p>Data sudah berhasil disimpan.</p>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/contents/save', array('class'=>'stdform')); ?>
<input type="hidden" value="<?php echo $content_type; ?>" name="content_type" />
<input type="hidden" value="<?php echo $sub_content_type; ?>" name="sub_content_type" />
<input type="hidden" value="<?php /*echo $tokens;*/ ?>" name="tokens" />
<input type="hidden" value="BPJT" name="source" />

	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Konten</a></li>
	    	<li><a data-toggle="tab" href="#options">Pilihan</a></li>
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
								<label>Judul</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo $menu_name; ?>" readonly /></span>
							</p>
							<p>
								Konten :
								<div>
									<textarea id="content-id" name="content_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor" ><?php echo isset($content['content_id']) ? $content['content_id'] : ""; ?></textarea>
								</div>
							</p>                       
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (!empty($content)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($content['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($content['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
							<div class="par">
					        	<label>Gambar :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					           				<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Pilih File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
					        				<input name="image_id" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Deskripsi ukuran lebar dan tinggi gambar dalam pixel.</small>
					        <p>
								<label>Tampilkan Gambar :</label>
								<span class="formwrapper">
									<?php if (!empty($content['show_image_id'])) { ?>
									<input type="radio" name="show_image_id" value='yes' <?php echo ($content['show_image_id'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_id" id="show-image-id" value='no' <?php echo ($content['show_image_id'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="show_image_id" value='yes' /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_id" id="show-image-id" value='no' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
						</div>
						<div id="inggris" class="tab-pane">
							<p>
								<label>Title</label>
								<span class="field"><input type="text" name="title_en" id="title-en" class="input-xxlarge" placeholder="Title" value="<?php echo $en_menu_name; ?>" readonly /></span>
							</p>
							<p>
								Content :
								<div>
									<textarea id="content-en" name="content_en" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor" ><?php echo isset($content['content_en']) ? $content['content_en'] : ""; ?></textarea>
								</div>
							</p>                        
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<?php if (isset($content['status_en'])) { ?>
									<input type="radio" name="status_en" value='published' <?php echo ($content['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($content['status_en'] == 'draft') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_en" value='published' /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' checked/> No  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
							<div class="par">
					        	<label>Image :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					            			<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Select File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Change</span>
					        				<input name="image_en" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Description of image width and height in pixels.</small>
					        <p>
								<label>Show Image :</label>
								<span class="formwrapper">
									<?php if (!empty($content['show_image_en'])) { ?>
									<input type="radio" name="show_image_en" value='yes' <?php echo ($content['show_image_en'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_en" id="show-image-id" value='no' <?php echo ($content['show_image_en'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="show_image_en" value='yes' checked/> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_en" id="show-image-id" value='no'/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
						</div>
					</div>
	            </div>
			</div><!--tab-pane-->

            <div id="options" class="tab-pane">
        		<div class="row-fluid">
					<div class="tabbable1">
						<ul class="nav nav-tabs buttons-icons">
							<li class="active"><a class="sub" data-toggle="tab" href="#option1">Bahasa Indonesia</a></li>
							<li><a class="sub" data-toggle="tab" href="#option2">Bahasa Inggris</a></li>
						</ul>
					  	<div class="tab-content">
					     	<div id="option1" class="tab-pane active">
								<p>
									<label>Kata Kunci :</label>
									<span class="field">
										<textarea name="keywords_id" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80" placeholder="dipisahkan oleh koma"><?php echo isset($content['keywords_id']) ? $content['keywords_id'] : ""; ?></textarea>
									</span>
								</p>
								<p>
									<label>Izinkan Komentar :</label>
									<span class="formwrapper">
										<?php if (!empty($content)) { ?>
										<input type="radio" name="allow_comment_id" value="1" <?php echo ($content['allow_comment_id'] == '1') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="allow_comment_id" value="0" <?php echo ($content['allow_comment_id'] == '0') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="allow_comment_id" value="1" checked="checked" /> Ya &nbsp; &nbsp;
										<input type="radio" name="allow_comment_id" value="0"/> Tidak  &nbsp; &nbsp;
										<?php } ?>
									</span>
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
												<span class="fileupload-new"><i class="icon-file"></i>&nbsp;Pilih File</span>
												<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
												<input name="file_id" type="file" />
											</span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
										</div>
									</div>
								</div>
								<div class="par">
									<label>Sisipkan Video :</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
						        		<div class="input-append">
						        			<div class="uneditable-input span3">
						            			<i class="iconfa-file fileupload-exists"></i>
						           				<span class="fileupload-preview"></span>
						        			</div>
						        			<span class="btn btn-file">
						        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Pilih File</span>
						        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Ubah</span>
						        				<input name="video_id" type="file" />
						        			</span>
						        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
						        		</div>
						        		<?php if (!empty($content['video_id'])) { ?>
						        		<span class="video-url"><?php echo $content['video_id']; ?></span>
						        		<?php } ?>
						        	</div>
								</div>
								<p>
									<label>Tampilkan Video :</label>
									<span class="formwrapper">
										<?php if (!empty($content['show_video_id'])) { ?>
										<input type="radio" name="show_video_id" value='yes' <?php echo ($content['show_video_id'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_id" id="show-video-id" value='no' <?php echo ($content['show_video_id'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="show_video_id" value='yes' /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_id" id="show-video-id" value='no' checked/> Tidak  &nbsp; &nbsp;
										<?php } ?>
									</span>
								</p>
							</div>
					     	<div id="option2" class="tab-pane">
								<p>
									<label>Keywords :</label>
									<span class="field">
										<textarea name="keywords_en" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80" placeholder="separated by coma"><?php echo isset($content['keywords_en']) ? $content['keywords_en'] : ""; ?></textarea>
									</span>
								</p>
								<p>
									<label>Allow Comment :</label>
										<span class="formwrapper">
										<?php if (isset($content['allow_comment_en'])) { ?>
										<input type="radio" name="allow_comment_en" value="1" <?php echo ($content['allow_comment_en'] == '1') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
										<input type="radio" name="allow_comment_en" value="0" <?php echo ($content['allow_comment_en'] == '0') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="allow_comment_en" value="1" checked="checked" /> Yes &nbsp; &nbsp;
										<input type="radio" name="allow_comment_en" value="0"/> No  &nbsp; &nbsp;
										<?php } ?>
									</span>
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
												<span class="fileupload-new"><i class="icon-file"></i>&nbsp;Select File</span>
												<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Change</span>
												<input name="file_en" type="file" />
											</span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
										</div>
									</div>
								</div>
								<div class="par">
									<label>Embed Video :</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
						        		<div class="input-append">
						        			<div class="uneditable-input span3">
						            			<i class="iconfa-file fileupload-exists"></i>
						           				<span class="fileupload-preview"></span>
						        			</div>
						        			<span class="btn btn-file">
						        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Select File</span>
						        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Change</span>
						        				<input name="video_en" type="file" />
						        			</span>
						        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
						        		</div>
						        		<?php if (!empty($content['video_en'])) { ?>
						        		<span class="video-url"><?php echo $content['video_en']; ?></span>
						        		<?php } ?>
						        	</div>
								</div>
								<p>
									<label>Show Video :</label>
									<span class="formwrapper">
										<?php if (!empty($content['show_video_en'])) { ?>
										<input type="radio" name="show_video_en" value='yes' <?php echo ($content['show_video_en'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_en" id="show-video-en" value='no' <?php echo ($content['show_video_en'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="show_video_en" value='yes' /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_en" id="show-video-en" value='no' checked/> Tidak  &nbsp; &nbsp;
										<?php } ?>
									</span>
								</p>
					     	</div>
					  	</div>
					</div>
                </div><!--row-fluid-->
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
