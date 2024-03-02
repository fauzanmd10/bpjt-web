<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } elseif (!empty($flash_success)) { ?>
	<div class="alert alert-success">
		<p>Data sudah berhasil disimpan.</p>
	</div>
<?php } ?>

<?php echo form_open('admin/contents/cms/save', array('class'=>'stdform')); ?>
	<input type="hidden" value="<?php echo $content_type; ?>" name="content_type" />
	<input type="hidden" value="<?php echo $sub_content_type; ?>" name="sub_content_type" />

	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Konten</a></li>
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
								Konten :
								<div>
									<textarea id="content-id" name="content_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce" ><?php echo isset($content['content_id']) ? $content['content_id'] : ""; ?></textarea>
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
						</div>
						<div id="inggris" class="tab-pane">
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