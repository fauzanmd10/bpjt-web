<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>
<?php } 
?>

<?php echo form_open_multipart($form_url, array('class'=>'stdform')); ?>
	<div class="tabbable">
	    <ul class="nav nav-tabs buttons-icons">
	    	<li class="active"><a data-toggle="tab" href="#contents">Upload File Baru</a></li>
	    </ul>
		<div class="tab-content">
	    	<div id="contents" class="tab-pane active">
	    	    <div class="tabbable1">
					<ul class="nav nav-tabs buttons-icons">
						<li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Detail</a></li>
						<!-- <li><a class="sub" data-toggle="tab" href="#inggris">Bahasa Inggris</a></li> -->
					</ul>
					<div class="tab-content">
						<div id="indonesia" class="tab-pane active">					    
							<p>
								<label>Title</label>
								<span class="field"><input type="text" name="title_id" id="title-id" class="input-xxlarge" placeholder="Judul" value="<?php echo (isset($document->title)) ? $document->title : ''; ?>" required/></span>
							</p>
							<p>
								Description :
								<div>
									<textarea id="content-id" name="content_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce"><?php echo isset($document->caption) ? $document->caption : ""; ?></textarea>
								</div>
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
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Choose File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Edit</span>
					        				<input name="file_id" type="file" onchange="Filevalidation()" id="file_id" <?php echo (isset($document->id)) ? '' : 'required'; ?> accept=".pdf"/>
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Delete</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Maximum of file size 10 mb.</small>
							<p>
								<label>Document Type</label>
								<span class="field">
								<?php if($this->session->userdata('user_group_id')=='22'||$this->session->userdata('user_group_id')=='23' ) {
											$types = $this->types_rfp;
										}else{
											$types = $this->types;
										}
								?>
	                                <?php $types[0] = '- Choose Document Type -'; ?>
	                                <?php echo form_dropdown('type_id', $types, (!empty($document)) ? $document->sub_content_type : '', "class='uniformselect' required" . ((isset($document->id)) ? " disabled" : '')); ?>
								</span>
							</p>
							
						</div>
						<!-- <div id="inggris" class="tab-pane">
							<p>
								<label>Title</label>
								<span class="field"><input type="text" name="title_en" id="title-en" class="input-xxlarge" placeholder="Title" value="<?php echo (!empty($document->title_en)) ? $document->title_en : ''; ?>" /></span>
							</p>
							<p>
								Description :
								<div>
									<textarea id="content-en" name="content_en" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce" ><?php echo (!empty($document->content_en)) ? $document->content_en : ""; ?></textarea>
								</div>
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
					        				<span class="fileupload-new"><i class="icon-picture"></i>&nbsp;Select File</span>
					        				<span class="fileupload-exists"><i class="icon-edit"></i>&nbsp;Change</span>
					        				<input name="file_en" type="file" onchange="Filevalidation_en()" id="file_en"/>
					        			</span>
					        			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><i class="icon-remove"></i>&nbsp;Remove</a>
					        		</div>
					        	</div>
					        </div>
					        <small class="desc-image">Maximum of file size 5 mb.</small>
							<p>
								<label>Document Type</label>
								<span class="field">
									<?php //$this->types[0] = '- Choose Document Type -'; ?>
	                                <?php //echo form_dropdown('type_en', $this->types, (!empty($document)) ? $document->type_en : '', "class='uniformselect'"); ?>
								</span>
							</p>                    
							
						</div> -->
					</div>
	            </div>
			</div><!--tab-pane-->

	    </div><!--tabcontent-->
	</div><!--tabbable-->
	<br/>
	<p class="stdformbutton">
		<button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Save</button>
		<!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
		<a href="<?php echo site_url('admin/lelangdoc'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Close</a>
	</p>
<?php echo form_close(); ?> 
<script> 
    Filevalidation = () => { 
		const fi = document.getElementById('file_id');  
		var size_id = parseFloat(fi.files[0].size / 1024).toFixed(2);
		// console.log(size_id);
		if (size_id>30240) {
			alert("File too Big, please select a file less than 30 MB");
			document.getElementById("file_id").value ='';
		}
	} 
	
	Filevalidation_en = () => { 
		const fi_en = document.getElementById('file_en'); 
		var size_en = parseFloat(fi_en.files[0].size / 1024).toFixed(2);
		// console.log(size_en);
		if (size_en>30240) {
			alert("File too Big, please select a file less than 30 MB");
			document.getElementById("file_en").value ='';
		}
    }
</script> 