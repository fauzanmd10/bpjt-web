<div class="mediamgr">
    <?php if (!empty($flash_success)) { ?>
    <div class="alert alert-success">
        Data sudah berhasil disimpan.
    </div>
    <?php } elseif (!empty($flash_fail)) { ?>
    <div class="alert alert-error">
        Data tidak berhasil disimpan karena ada kesalahan pada sistem.
    </div>
    <?php } ?>

	<div class="mediamgr_left">
    	<div class="mediamgr_head">
        	<ul class="mediamgr_menu">
            	<li>
                    <?php if ($page == 1) { ?>
                    <a href="#" class="btn prev prev_disabled"><span class="icon-chevron-left"></span></a>
                    <?php } else { ?>
                    <a href="?page=<?php echo ($page-1); ?>" class="btn prev"><span class="icon-chevron-left"></span></a>
                    <?php } ?>
                </li>
                <li>
                    <?php if ($page < $total_page) { ?>
                    <a href="?page=<?php echo ($page+1); ?>" class="btn next"><span class="icon-chevron-right"></span></a>
                    <?php } else { ?>
                    <a href="#" class="btn next next_disabled"><span class="icon-chevron-right"></span></a>
                    <?php } ?>
                </li>
                <!--<li class="marginleft15"><a class="btn selectall"><span class="icon-check"></span> Pilih Semua</a></li>-->
                <!--<li class="marginleft15 newfoldbtn"><a class="btn newfolder" title="Add New Folder"><span class="icon-folder-open"></span></a></li>-->
                <!--<li class="marginleft5 trashbtn"><a class="btn trash" title="Trash"><span class="icon-trash"></span></a></li>-->
                <li class="marginleft15 filesearch">
                	<form>
                		<input type="text" id="filekeyword" class="filekeyword" name="filename" placeholder="Cari file" value="<?php echo (isset($_GET['filename'])) ? clean_str($_GET['filename']) : ''; ?>" />
                    </form>
                </li>
                <?php if ($this->user_access->add) { ?>
                <li class="right newfilebtn"><a href="<?php echo site_url('admin/regulations/add'); ?>" class="btn btn-primary">Upload File Baru</a></li>
                <?php } ?>
            </ul>
            <span class="clearall"></span>
        </div><!--mediamgr_head-->
        
        <div class="mediamgr_category">
        <ul id="mediafilter">
            	<li class="current"><a href="all">Semua</a></li>
                <?php foreach($this->types as $key => $type) { ?>
                <?php if($key != '0') {?>
                <li><a href="type-<?php echo $key; ?>"><?php echo $type; ?></a></li>
                <?php } ?>
                <?php } ?>
                <li class="right"><span class="pagenuminfo">Tampil <?php echo $offset; ?> - <?php echo $offset - 1 + count($documents); ?> dari <?php echo $count_documents; ?></span></li>
            </ul>
        </div><!--mediamgr_category-->
        <div class="mediamgr_content">

            <ul id="medialist" class="listfile">
                <?php foreach($documents as $document) { ?>
                <?php if (empty($document->sub_content_type)) { ?>
                <li>
                <?php } else { ?>
                <li class="type-<?php echo $document->sub_content_type; ?>">
                <?php } ?>
                    <a href="<?php echo site_url('admin/regulations/show/' . $document->id); ?>"><img src="<?php echo site_url('assets/images/thumbs/doc.png'); ?>" alt="" width="125" /></a>
                    <span class="filename"><?php echo $document->title; ?></span>
                </li>
                <?php } ?>
            </ul>
            
            <br class="clearall" />
            
        </div><!--mediamgr_content-->
        
    </div><!--mediamgr_left -->
</div>