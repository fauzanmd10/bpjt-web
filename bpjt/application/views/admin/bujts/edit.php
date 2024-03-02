<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/bujts/update/'.$id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah BUJT</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Nama</label>
								<span class="field"><input type="text" name="name" class="input-xxlarge" placeholder="Judul" value="<?php echo $bujt->name; ?>" /></span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($bujt->status == "published") ? "checked" : "";?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" value='draft' <?php echo ($bujt->status == "draft") ? "checked" : ""; ?>/> Tidak  &nbsp; &nbsp;
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
		<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Ubah</button>
		<!-- <button type="reset" id="btn-reset-edit" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
		<a href="<?php echo site_url('admin/bujts'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 