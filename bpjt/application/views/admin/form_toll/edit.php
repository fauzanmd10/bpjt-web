<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/article_sub_categories/update/' . $id, array('class' => 'stdform')); ?>
<div class="tabbable">
	<ul class="nav nav-tabs buttons-icons">
		<li class="active"><a data-toggle="tab" href="#contents">Ubah Sub Kategori</a></li>
	</ul>
	<div class="tab-content">
		<div id="contents" class="tab-pane active">
			<div class="tabbable1">
				<ul class="nav nav-tabs buttons-icons">
					<?php if ($sub_category->lang == "id") { ?>
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
					<?php } else { ?>
						<li class="active"><a class="sub" data-toggle="tab" href="#inggris">Bahasa Inggris</a></li>
					<?php } ?>
				</ul>
				<div class="tab-content">
					<?php if ($sub_category->lang == "id") { ?>
						<div id="indonesia" class="tab-pane active">
							<p>
								<label>Nama Ruas</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($sub_category)) ? $sub_category['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama Perusahaan</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Nama Direktur Utama</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Nama Kontak</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>ID Number</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Alamat</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Telepon</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Handphone</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Email</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($sub_category->status == "published") ? "checked" : ""; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" value='draft' <?php echo ($sub_category->status == "draft") ? "checked" : ""; ?> /> Tidak &nbsp; &nbsp;
								</span>
							</p>
						</div>
					<?php } else { ?>
						<div id="inggris" class="tab-pane active">
							<p>
								<label>Nama Ruas</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($sub_category)) ? $sub_category['title_id'] : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama Perusahaan</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Nama Direktur Utama</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Nama Kontak</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>ID Number</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Alamat</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Telepon</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Handphone</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Email</label>
								<span class="field">
									<input type="text">
								</span>
							</p>
							<p>
								<label>Published :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($sub_category->status == "published") ? "checked" : ""; ?> /> Yes &nbsp; &nbsp;
									<input type="radio" name="status" value='draft' <?php echo ($sub_category->status == "draft") ? "checked" : ""; ?> /> No &nbsp; &nbsp;
								</span>
							</p>
						</div>
					<?php } ?>
				</div>
			</div>
		</div><!--tab-pane-->
	</div><!--tabcontent-->
</div><!--tabbable-->
<br />
<p class="stdformbutton">
	<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Ubah</button>
	<!-- <button type="reset" id="btn-reset-edit" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
	<a href="<?php echo site_url('admin/article_sub_categories'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
</p>
<?php echo form_close(); ?>