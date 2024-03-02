<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/toll_road_sections/update/'.$id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah Segment Ruas Tol</a></li>
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
								<span class="field"><input type="text" name="name" id="name-id" class="input-xxlarge" placeholder="Nama" value="<?php echo (isset($toll_road_section)) ? $toll_road_section->name : ''; ?>" /></span>
							</p>
							<p>
								<label>Ruas Tol</label>
								<span class="field">
	                                <?php echo form_dropdown('constructing_toll_road_id', $constructing_toll_roads, (isset($toll_road_section)) ? $toll_road_section->constructing_toll_road_id : '', "class='uniformselect' id='inventory-type-id'"); ?>
								</span>
							</p>
							<p>
								<label>Panjang (KM)</label>
								<span class="field"><input type="text" name="road_length" id="road-length-id" class="input-xxlarge" placeholder="Panjang (KM)" value="<?php echo (isset($toll_road_section)) ? $toll_road_section->road_length : ''; ?>" /></span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (isset($toll_road_section)) { ?>
									<input type="radio" name="status" value='published' <?php echo ($toll_road_section->status == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" id="status-id" value='draft' <?php echo ($toll_road_section->status == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/toll_road_sections'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 