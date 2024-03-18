<?php if (validation_errors()) { ?>
    <div class="alert alert-error">
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>

<?php echo form_open('admin/announcements/create', array('class' => 'stdform')); ?>
<div class="tabbable">
    <ul class="nav nav-tabs buttons-icons">
        <li class="active"><a data-toggle="tab" href="#contents">Tambah Pengumuman</a></li>
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
                            Pengumuman :
                        <div>
                            <textarea id="announcement-id" name="announcement_id" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor"><?php echo isset($announcement['announcement_id']) ? $announcement['announcement_id'] : ""; ?></textarea>
                        </div>
                        </p>
                        <p>
                            <label>Terbitkan :</label>
                            <span class="formwrapper">
                                <?php if (isset($announcement)) { ?>
                                    <input type="radio" name="status_id" value='published' <?php echo ($announcement['status_id'] == 'published') ? 'checked' : ''; ?> /> Ya &nbsp; &nbsp;
                                    <input type="radio" name="status_id" id="status-id" value='draft' <?php echo ($announcement['status_id'] == 'draft') ? 'checked' : ''; ?> /> Tidak &nbsp; &nbsp;
                                <?php } else { ?>
                                    <input type="radio" name="status_id" value='published' /> Ya &nbsp; &nbsp;
                                    <input type="radio" name="status_id" id="status-id" value='draft' checked /> Tidak &nbsp; &nbsp;
                                <?php } ?>
                            </span>
                        </p>
                    </div>
                    <div id="inggris" class="tab-pane">
                        <p>
                            Announcement :
                        <div>
                            <textarea id="announcement-en" name="announcement_en" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor"><?php echo isset($announcement['announcement_en']) ? $announcement['announcement_en'] : ""; ?></textarea>
                        </div>
                        </p>
                        <p>
                            <label>Published :</label>
                            <span class="formwrapper">
                                <?php if (isset($category)) { ?>
                                    <input type="radio" name="status_en" value='published' <?php echo ($category['status_en'] == 'published') ? 'checked' : ''; ?> /> Yes &nbsp; &nbsp;
                                    <input type="radio" name="status_en" id="status-en" value='draft' <?php echo ($category['status_en'] == 'draft') ? 'checked' : ''; ?> /> No &nbsp; &nbsp;
                                <?php } else { ?>
                                    <input type="radio" name="status_en" value='published' /> Yes &nbsp; &nbsp;
                                    <input type="radio" name="status_en" id="status-en" value='draft' checked /> No &nbsp; &nbsp;
                                <?php } ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div><!--tab-pane-->
    </div><!--tabcontent-->
</div><!--tabbable-->
<br />
<p class="stdformbutton">
    <button type="submit" id="btn-submit" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Simpan</button>
    <!-- <button type="reset" id="btn-reset-add" class="btn"><i class="icon-refresh"></i>&nbsp;&nbsp;Reset</button> -->
    <a href="<?php echo site_url('admin/announcements'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
</p>
<?php echo form_close(); ?>