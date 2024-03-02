<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/menus/update/' . $id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah Menu</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">					
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Nama</label>
								<span class="field"><input type="text" name="name_id" id="name-id" class="input-xxlarge" placeholder="Nama" value="<?php echo (isset($menu->name)) ? $menu->name : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama (Inggris)</label>
								<span class="field"><input type="text" name="name_en" id="name-id" class="input-xxlarge" placeholder="Nama (Inggris)" value="<?php echo (isset($menu->name_en)) ? $menu->name_en : ''; ?>" /></span>
							</p>
					        <p>
								<label>Parent</label>
								<span class="field">
	                                <?php 
	                                	echo form_dropdown('parent_id', $parents, (array_key_exists('parent_id', $menu)) ? $menu->parent_id : '', "class='uniformselect'"); 
									?>
								</span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<?php if (isset($menu->status)) { ?>
									<input type="radio" name="status_id" value='published' <?php echo ($menu->status == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($menu->status == 'draft') ? 'checked' : ''; ?> /> Tidak  &nbsp; &nbsp;
									<?php } else { ?>
									<input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
									<input type="radio" name="status_id" id="status-id" value='draft' checked/> Tidak  &nbsp; &nbsp;
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
		<a href="<?php echo site_url('admin/menus'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 