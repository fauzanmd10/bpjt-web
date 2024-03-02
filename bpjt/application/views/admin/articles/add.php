
<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/articles2/create', array('class'=>'stdform')); ?>

	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Konten</a></li>
	    	<li><a data-toggle="tab" href="#intro">Intro</a></li>
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
							<input type="hidden" id="token-name" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<p>
								<label>Judul</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($article['title_id'])) ? $article['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Kategori</label>
								<span class="field">
	                                <?php echo form_dropdown('category_id', $category_ids, (isset($article)) ? $article['category_id'] : '', "class='uniformselect' id='category-id'"); ?>
								</span>
							</p>
							<p>
								<label>Sub Kategori</label>
								<span class="field">
	                                <?php echo form_dropdown('sub_category_id', $sub_category_ids, (isset($article)) ? $article['sub_category_id'] : '', "class='uniformselect' id='sub-category-id'"); ?>
								</span>
							</p>
							<p>
								Konten :
								<div>
									<textarea id="content-id" name="content_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor" ><?php echo isset($article['content_id']) ? $article['content_id'] : ""; ?></textarea>
								</div>
							</p> 
							<p>
								<label>Tanggal</label>
								<span class="field">
									<input type="text" name="tgl_id" id="tgl_id" class="datepicker" value="<?php echo (isset($article['tgl_id'])) ? $article['tgl_id'] : ''; ?>"/>
									<span><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
								</span>
							</p>			
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (isset($article)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($article['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($article['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
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
								<span class="field"><input type="text" name="title_en" id="title-en" class="input-xxlarge" placeholder="Title" value="<?php echo (isset($article['title_en'])) ? $article['title_en'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Category</label>
								<span class="field">
									<?php echo form_dropdown('category_en', $category_ens, (isset($article)) ? $article['category_en'] : '', "class='uniformselect' id='category-en'"); ?>
								</span>
							</p>
							<p>
								<label>Sub Category</label>
								<span class="field">
									<?php echo form_dropdown('sub_category_en', $sub_category_ens, (isset($article)) ? $article['sub_category_en'] : '', "class='uniformselect' id='sub-category-en'"); ?>
								</span>
							</p>
							<p>
								Content :
								<div>
									<textarea id="content-en" name="content_en" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor" ><?php echo isset($article['content_en']) ? $article['content_en'] : ""; ?></textarea>
								</div>
							</p> 
							<p>
								<label>Date</label>
								<span class="field">
									<input type="text" name="tgl_en" id="tgl_en" class="datepicker" value="<?php echo (isset($article['tgl_en'])) ? $article['tgl_en'] : ''; ?>"/>
								</span>
							</p>							
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<?php if (isset($article)) { ?>
									<input type="radio" name="status_en" value='published' <?php echo ($article['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($article['status_en'] == 'draft') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
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

			<div id="intro" class="tab-pane">
				<div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#intro1">Bahasa Indonesia</a></li>
						<li><a class="sub" data-toggle="tab" href="#intro2">Bahasa Inggris</a></li>
					</ul>
					<div class="tab-content">
				 		<div id="intro1" class="tab-pane active">
					        <p>
						        <label>Pengantar :</label>
						        <span class="field">
				                	<textarea name="excerpt_id" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80"><?php echo isset($article['excerpt_id']) ? $article['excerpt_id'] : ""; ?></textarea>
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
								<label>Tampilkan Gambar</label>
								<span class="formwrapper">
									<?php if (!empty($article['show_image_id'])) { ?>
									<input type="radio" name="show_image_id" value='yes' <?php echo ($article['show_image_id'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_id" id="show-image-id" value='no' <?php echo ($article['show_image_id'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="show_image_id" value='yes' /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_id" id="show-image-id" value='no' checked/> Tidak  &nbsp; &nbsp;
									<?php } ?>
								</span>
							</p>
				 		</div>
				 		<div id="intro2" class="tab-pane">
					        <p>
					        	<label>Introduction :</label>
					        	<span class="field">
					                <textarea name="excerpt_en" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80"><?php echo isset($article['excerpt_en']) ? $article['excerpt_en'] : ""; ?></textarea>
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
								<label>Show Image</label>
								<span class="formwrapper">
									<?php if (!empty($article['show_image_en'])) { ?>
									<input type="radio" name="show_image_en" value='yes' <?php echo ($article['show_image_en'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_en" id="show-image-en" value='no' <?php echo ($article['show_image_en'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="show_image_en" value='yes' /> Ya &nbsp; &nbsp;
									<input type="radio" name="show_image_en" id="show-image-en" value='no' checked/> Tidak  &nbsp; &nbsp;
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
										<textarea name="keywords_id" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80" placeholder="dipisahkan oleh koma"><?php echo isset($article['keywords_id']) ? $article['keywords_id'] : ""; ?></textarea>
									</span>
								</p>
								<p>
									<label>Izinkan Komentar :</label>
									<span class="formwrapper">
										<?php if (isset($article)) { ?>
										<input type="radio" name="allow_comment_id" value="1" <?php echo ($article['allow_comment_id'] == '1') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="allow_comment_id" value="0" <?php echo ($article['allow_comment_id'] == '0') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
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
						        	</div>
								</div>
								<p>
									<label>Tampilkan Video</label>
									<span class="formwrapper">
										<?php if (!empty($article['show_video_id'])) { ?>
										<input type="radio" name="show_video_id" value='yes' <?php echo ($article['show_video_id'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_id" id="show-image-id" value='no' <?php echo ($article['show_video_id'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="show_video_id" value='yes' /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_id" id="show-image-id" value='no' checked/> Tidak  &nbsp; &nbsp;
										<?php } ?>
									</span>
								</p>
							</div>
					     	<div id="option2" class="tab-pane">
								<p>
									<label>Keywords :</label>
									<span class="field">
										<textarea name="keywords_en" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80" placeholder="separated by coma"><?php echo isset($article['keywords_en']) ? $article['keywords_en'] : ""; ?></textarea>
									</span>
								</p>
								<p>
									<label>Allow Comment :</label>
										<span class="formwrapper">
										<?php if (isset($article)) { ?>
										<input type="radio" name="allow_comment_en" value="1" <?php echo ($article['allow_comment_en'] == '1') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
										<input type="radio" name="allow_comment_en" value="0" <?php echo ($article['allow_comment_en'] == '0') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
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
						        	</div>
								</div>
								<p>
									<label>Show Video</label>
									<span class="formwrapper">
										<?php if (!empty($article['show_video_en'])) { ?>
										<input type="radio" name="show_video_en" value='yes' <?php echo ($article['show_video_en'] == 'yes') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_en" id="show-image-en" value='no' <?php echo ($article['show_video_en'] == 'no') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="show_video_en" value='yes' /> Ya &nbsp; &nbsp;
										<input type="radio" name="show_video_en" id="show-image-en" value='no' checked/> Tidak  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/articles'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 