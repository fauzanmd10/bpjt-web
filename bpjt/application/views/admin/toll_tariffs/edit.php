<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/toll_tariffs/update/' . $id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Tambah Tarif Tol</a></li>
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
								<label>Ruas Tol</label>
								<span class="field">
	                                <?php echo form_dropdown('toll_road_id', $toll_roads, (isset($toll_tariff)) ? $toll_tariff->toll_road_id : '', "class='uniformselect' id='inventory-type-id'"); ?>
								</span>
							</p>
							<p>
								<label>Gerbang Masuk</label>
								<span class="field">
	                                <?php echo form_dropdown('enter_toll_gate_id', $toll_gates, (isset($toll_tariff)) ? $toll_tariff->enter_toll_gate_id : '', "class='uniformselect' id='inventory-type-id'"); ?>
								</span>
							</p>
							<p>
								<label>Gerbang Keluar</label>
								<span class="field">
	                                <?php echo form_dropdown('exit_toll_gate_id', $toll_gates, (isset($toll_tariff)) ? $toll_tariff->exit_toll_gate_id : '', "class='uniformselect' id='inventory-type-id'"); ?>
								</span>
							</p>
							<p>
								<label>Golongan</label>
								<span class="field">
	                                <?php echo form_dropdown('vehicle_group_id', $vehicle_groups, (isset($toll_tariff)) ? $toll_tariff->vehicle_group_id : '', "class='uniformselect' id='inventory-type-id'"); ?>
								</span>
							</p>
							<p>
								<label>No. Kepmen</label>
								<span class="field"><input type="text" name="kepmen" id="kepmen" class="input-xxlarge" placeholder="No. Kepmen" value="<?php echo $kepmen; ?>" /></span>
							</p>
							<p>
								<label>Tarif</label>
								<span class="field"><input type="text" name="tariff" id="tariff-id" class="input-xxlarge" placeholder="Nama" value="<?php echo (isset($toll_tariff)) ? $toll_tariff->tariff : ''; ?>" /></span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($toll_tariff->status == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" id="status-id" value='draft' <?php echo ($toll_tariff->status == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/toll_tariffs'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 