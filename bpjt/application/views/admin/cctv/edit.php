<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open('admin/cctv/update/' . $id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah CCTV</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">					
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>ID Ruas</label>
								<span class="field"><input type="text" name="id_ruas" id="id_ruas" class="input-xxlarge" placeholder="ID Ruas" value="<?php echo (isset($cctv->id_ruas)) ? $cctv->id_ruas : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama Ruas</label>
								<span class="field"><input type="text" name="nama_ruas" id="nama_ruas" class="input-xxlarge" placeholder="Nama Ruas" value="<?php echo (isset($cctv->nama_ruas)) ? $cctv->nama_ruas : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama CCTV</label>
								<span class="field"><input type="text" name="nama_cctv" id="nama_cctv" class="input-xxlarge" placeholder="Nama CCTV" value="<?php echo (isset($cctv->nama_cctv)) ? $cctv->nama_cctv : ''; ?>" /></span>
							</p>
							<p>
								<label>BUJT</label>
								<span class="field"><input type="text" name="bujt" id="bujt" class="input-xxlarge" placeholder="BUJT" value="<?php echo (isset($cctv->bujt)) ? $cctv->bujt : ''; ?>" /></span>
							</p>
							<p>
								<label>Nama BUJT</label>
								<span class="field"><input type="text" name="bujt_nama" id="bujt_nama" class="input-xxlarge" placeholder="Nama BUJT" value="<?php echo (isset($cctv->bujt_nama)) ? $cctv->bujt_nama : ''; ?>" /></span>
							</p>
							<p>
								<label>Stream URL</label>
								<span class="field"><input type="text" name="stream" id="stream" class="input-xxlarge" placeholder="Stream URL" value="<?php echo (isset($cctv->stream)) ? $cctv->stream : ''; ?>" /></span>
							</p>
							<p>
								<label>Protocol</label>
								<span class="field">
	                                <?php 
										echo form_dropdown('protocol', [
											'' => 'Pilih protocol',
											'm3u8' => 'm3u8',
											'rtsp' => 'rtsp',
											'mjpg' => 'mjpg',
											'embedded' => 'embedded'
										], ($cctv->protocol ? $cctv->protocol : ''), "class='uniformselect'");
									?>
								</span>
							</p>
							<p>
								<label>Status</label>
								<span class="formwrapper">
									<input type="radio" name="status" value="online" <?php echo ($cctv->status == 'online') ? 'checked' : ''; ?> /> Online &nbsp; &nbsp;
									<input type="radio" name="status" value="offline" <?php echo ($cctv->status == 'offline') ? 'checked' : ''; ?> /> Offline  &nbsp; &nbsp;
								</span>
							</p>
							<p>
								<label>Lat</label>
								<span class="field"><input type="text" name="lat" id="lat" class="input-xxlarge" placeholder="Lat" value="<?php echo (isset($cctv->lat)) ? $cctv->lat : ''; ?>" /></span>
							</p>
							<p>
								<label>Long</label>
								<span class="field"><input type="text" name="long" id="long" class="input-xxlarge" placeholder="Long" value="<?php echo (isset($cctv->long)) ? $cctv->long : ''; ?>" /></span>
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
		<a href="<?php echo site_url('admin/cctv'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 