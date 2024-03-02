<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/article_sub_categories/create', array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Tambah Sub Kategori</a></li>
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
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($sub_category)) ? $sub_category['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Kategori</label>
								<span class="field">
	                                <?php echo form_dropdown('category_id', $category_ids, (isset($sub_category)) ? $sub_category['category_id'] : '', "class='uniformselect'"); ?>
								</span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (isset($sub_category)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($sub_category['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($sub_category['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
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
								<span class="field"><input type="text" name="title_en" id="title-en" class="input-xxlarge" placeholder="Title" value="<?php echo (isset($sub_category)) ? $sub_category['title_en'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Category</label>
								<?php echo form_dropdown('category_en', $category_ens, (isset($sub_category)) ? $sub_category['category_en'] : '', "class='uniformselect'"); ?>
							</p>                          
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<?php if (isset($sub_category)) { ?>
									<input type="radio" name="status_en" value='published' <?php echo ($sub_category['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($sub_category['status_en'] == 'draft') ? 'checked' : ''; ?> /> No  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/article_categories'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 