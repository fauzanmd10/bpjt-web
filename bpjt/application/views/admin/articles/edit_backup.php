<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/articles/update/' . $id, array('class'=>'stdform')); ?>
	<input type="hidden" name="article_id" value="<?php echo $id; ?>" />
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
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">
							<?php echo ($article->lang == "id") ? "Bahasa Indonesia" : "Bahasa Inggris"; ?>
						</a></li>
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label><?php echo ($article->lang == "id") ? "Judul" : "Title"; ?> :</label>
								<span class="field"><input type="text" name="title" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo $article->title; ?>" /></span>
							</p>
							<p>
								<label><?php echo ($article->lang == "id") ? "Kategori" : "Category"; ?> </label>
								<span class="field">
	                                <?php echo form_dropdown('category', $categories, $article->article_category_id, "class='uniformselect' id='category-id'"); ?>
								</span>
							</p>
							<p>
								<label><?php echo ($article->lang == "id") ? "Sub Kategori" : "Sub Category"; ?></label>
								<span class="field">
	                                <?php echo form_dropdown('sub_category', $sub_categories, $article->article_sub_category_id, "class='uniformselect' id='sub-category-id'"); ?>
								</span>
							</p>
							<p>
								<?php echo ($article->lang == "id") ? "Konten" : "Content"; ?> :
								<div>
									<textarea id="content-id" name="content" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor" ><?php echo $article->content; ?></textarea>
								</div>
							</p>
							<p>
								<label><?php echo ($article->lang == "id") ? "Tanggal" : "Date"; ?></label>
								<span class="field">
									<input type="text" name="tgl_id" id="tgl_id" class="datepicker" value="<?php echo $article->created_at; ?>"/>
								</span>
							</p>
							<p>
								<label><?php echo ($article->lang == "id") ? "Terbitkan" : "Published"; ?> :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($article->status == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" id="status-id" value='draft' <?php echo ($article->status == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
								</span>
							</p>
						</div>
					</div>
	            </div>
			</div><!--tab-pane-->

			<div id="intro" class="tab-pane">
				<div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#intro1">
							<?php echo ($article->lang == "id") ? "Bahasa Indonesia" : "Bahasa Inggris"; ?>
						</a></li>
					</ul>
					<div class="tab-content">
				 		<div id="intro1" class="tab-pane active">
					        <p>
						        <label><?php echo ($article->lang == "id") ? "Pengantar" : "Introduction"; ?> :</label>
						        <span class="field">
				                	<textarea name="excerpt" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80"><?php echo $article->excerpt; ?></textarea>
				                </span> 
					        </p>
					        <div class="par">
					        	<label><?php echo ($article->lang == "id") ? "Gambar" : "Image"; ?> :</label>
					        	<div class="fileupload fileupload-new" data-provides="fileupload">
					        		<div class="input-append">
					        			<div class="uneditable-input span3">
					            			<i class="iconfa-file fileupload-exists"></i>
					           				<span class="fileupload-preview"></span>
					        			</div>
					        			<span class="btn btn-file">
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;<?php echo ($article->lang == "id") ? "Pilih File" : "Select File"; ?></span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;<?php echo ($article->lang == "id") ? "Ubah" : "Change"; ?></span>
					        				<input name="image" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;<?php echo ($article->lang == "id") ? "Hapus" : "Remove"; ?></a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image"><?php echo ($article->lang == "id") ? "Deskripsi ukuran lebar dan tinggi gambar dalam pixel." : "Description of image width and height in pixels."; ?></small>
					        <p>
								<label><?php echo ($article->lang == 'id') ? 'Tampilkan Gambar' : 'Show Image'; ?></label>
								<span class="formwrapper">
									<?php if ($show_image != "") { ?>
									<input type="radio" name="show_image" value='yes' <?php echo ($show_image == 'yes') ? 'checked' : ''; ?> /> <?php echo ($article->lang == 'id') ? 'Ya' : 'Yes'; ?> &nbsp; &nbsp;
									<input type="radio" name="show_image" id="show-image" value='no' <?php echo ($show_image == 'no') ? 'checked' : ''; ?> /> <?php echo ($article->lang == 'id') ? 'Tidak' : 'No'; ?>  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="show_image" value='yes' /> <?php echo ($article->lang == 'id') ? 'Ya' : 'Yes'; ?> &nbsp; &nbsp;
									<input type="radio" name="show_image" id="show-image" value='no' checked/> <?php echo ($article->lang == 'id') ? 'Tidak' : 'No'; ?>  &nbsp; &nbsp;
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
							<li class="active"><a class="sub" data-toggle="tab" href="#option1">
								<?php echo ($article->lang == "id") ? "Bahasa Indonesia" : "Bahasa Inggris"; ?>
							</a></li>
						</ul>
					  	<div class="tab-content">
					     	<div id="option1" class="tab-pane active">
								<p>
									<label><?php echo ($article->lang == "id") ? "Kata Kunci" : "Keywords"; ?> :</label>
									<span class="field">
										<textarea name="keywords" id="autoResizeTA" class="span5" style="resize: vertical; height: 115px;" rows="5" cols="80" placeholder="dipisahkan oleh koma"><?php echo $keywords; ?></textarea>
									</span>
								</p>
								<p>
									<label><?php echo ($article->lang == "id") ? "Izinkan Komentar" : "Allow Comment"; ?> :</label>
									<span class="formwrapper">
										<input type="radio" name="allow_comment" value="1" <?php echo ($allow_comment == '1') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
										<input type="radio" name="allow_comment" value="0" <?php echo ($allow_comment == '0') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
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
												<span class="fileupload-new"><i class="icon-file"></i>&nbsp;<?php echo ($article->lang == "id") ? "Pilih File" : "Select File"; ?></span>
												<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;<?php echo ($article->lang == "id") ? "Ubah" : "Change"; ?></span>
												<input name="file" type="file" />
											</span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;<?php echo ($article->lang == "id") ? "Hapus" : "Remove"; ?></a>
										</div>
									</div>
								</div>
								<div class="par">
									<label><?php echo ($article->lang == "id") ? "Sisipkan Video" : "Embed Video"; ?> :</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
						        		<div class="input-append">
						        			<div class="uneditable-input span3">
						            			<i class="iconfa-file fileupload-exists"></i>
						           				<span class="fileupload-preview"></span>
						        			</div>
						        			<span class="btn btn-file">
						        				<span class="fileupload-new"><i class="icon-file"></i>&nbsp;<?php echo ($article->lang == "id") ? "Pilih File" : "Select File"; ?></span>
												<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;<?php echo ($article->lang == "id") ? "Ubah" : "Change"; ?></span>
						        				<input name="video" type="file" />
						        			</span>
						        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
						        		</div>
						        	</div>
								</div>
								<p>
									<label><?php echo ($article->lang == 'id') ? 'Tampilkan Video' : 'Show Video'; ?></label>
									<span class="formwrapper">
										<?php if ($show_video != "") { ?>
										<input type="radio" name="show_video" value='yes' <?php echo ($show_video == 'yes') ? 'checked' : ''; ?> /> <?php echo ($article->lang == 'id') ? 'Ya' : 'Yes'; ?> &nbsp; &nbsp;
										<input type="radio" name="show_video" id="show-video" value='no' <?php echo ($show_video == 'no') ? 'checked' : ''; ?> /> <?php echo ($article->lang == 'id') ? 'Tidak' : 'No'; ?>  &nbsp; &nbsp;
										<?php } else { ?>
										<input type="radio" name="show_video" value='yes' /> <?php echo ($article->lang == 'id') ? 'Ya' : 'Yes'; ?> &nbsp; &nbsp;
										<input type="radio" name="show_video" id="show-video" value='no' checked/> <?php echo ($article->lang == 'id') ? 'Tidak' : 'No'; ?>  &nbsp; &nbsp;
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
		<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Ubah</button>
		<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
		<a href="<?php echo site_url('admin/articles'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 