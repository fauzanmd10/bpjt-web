<?php if (validation_errors()) { ?>
    <div class="alert alert-error">
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>

<?php echo form_open('admin/announcements/update/' . $id, array('class' => 'stdform')); ?>
<div class="tabbable">
    <ul class="nav nav-tabs buttons-icons">
        <li class="active"><a data-toggle="tab" href="#contents">Ubah Pengumuman</a></li>
    </ul>
    <div class="tab-content">
        <div id="contents" class="tab-pane active">
            <div class="tabbable1">
                <ul class="nav nav-tabs buttons-icons">
                    <?php if ($announcement->lang == "id") { ?>
                        <li class="active"><a class="sub" data-toggle="tab" href="#indonesia">Bahasa Indonesia</a></li>
                    <?php } else { ?>
                        <li class="active"><a class="sub" data-toggle="tab" href="#inggris">Bahasa Inggris</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <?php if ($announcement->lang == "id") { ?>
                        <div id="indonesia" class="tab-pane active">
                            <p>
                                Pengumuman :
                            <div>
                                <textarea id="announcement" name="announcement" rows="15" cols="80" style="width: 80%; height: 262px;" class="tinymce"><?php echo $announcement->content; ?></textarea>
                            </div>
                            </p>
                            <p>
                                <label>Terbitkan :</label>
                                <span class="formwrapper">
                                    <input type="radio" name="status" value='published' <?php echo ($announcement->status == "published") ? "checked" : ""; ?> /> Ya &nbsp; &nbsp;
                                    <input type="radio" name="status" value='draft' <?php echo ($announcement->status == "draft") ? "checked" : ""; ?> /> Tidak &nbsp; &nbsp;
                                </span>
                            </p>
                        </div>
                    <?php } else { ?>
                        <div id="inggris" class="tab-pane active">
                            <p>
                                Announcement :
                            <div>
                                <textarea id="announcement" name="announcement" rows="15" cols="80" style="width: 80%; height: 262px;" class="ckeditor"><?php echo $announcement->content; ?></textarea>
                            </div>
                            </p>
                            <p>
                                <label>Published :</label>
                                <span class="formwrapper">
                                    <input type="radio" name="status" value='published' <?php echo ($announcement->status == "published") ? "checked" : ""; ?> /> Yes &nbsp; &nbsp;
                                    <input type="radio" name="status" value='draft' <?php echo ($announcement->status == "draft") ? "checked" : ""; ?> /> No &nbsp; &nbsp;
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
    <a href="<?php echo site_url('admin/announcements'); ?>" class="btn"><i class="iconfa-remove"></i>&nbsp;&nbsp;Tutup</a>
</p>
<?php echo form_close(); ?>