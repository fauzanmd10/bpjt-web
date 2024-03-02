<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>

<?php echo form_open_multipart('admin/toll_roads/update/'.$id, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Ubah Ruas Jalan Tol</a></li>
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
								<span class="field"><input type="text" name="name" class="input-xxlarge" placeholder="Judul" value="<?php echo $road->name; ?>" /></span>
							</p>
							<p>
								<label>Pengelola</label>
								<span class="field"><input type="text" name="developer" class="input-xxlarge" placeholder="Pengelola" value="<?php echo $road->developer; ?>" /></span>
							</p>
							<p>
								<label>Panjang (KM)</label>
								<span class="field"><input type="text" name="road_length" class="input-xxlarge" placeholder="Panjang (KM)" value="<?php echo $road->road_length; ?>" /></span>
							</p>
							<p>
								<label>Terbitkan :</label>
								<span class="formwrapper">
									<input type="radio" name="status" value='published' <?php echo ($road->status == "published") ? "checked" : "";?> /> Ya &nbsp; &nbsp;
									<input type="radio" name="status" value='draft' <?php echo ($road->status == "draft") ? "checked" : ""; ?>/> Tidak  &nbsp; &nbsp;
								</span>
							</p>
							<!-- <div class="par">
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
					        				<input name="image" type="file" />
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Hapus</a>
					        		</div>
					        	</div>
					        </div> -->
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
		<a href="<?php echo site_url('admin/toll_roads'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
	</p>
<?php echo form_close(); ?> 