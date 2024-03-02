<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama Situs:</strong></div>
<div><?php echo $site->title; ?></div>
<br />

<div><strong>URL:</strong></div>
<div><?php echo $site->content; ?></div>
<br />

<div><strong>Logo:</strong></div>
<?php if (empty($logo)) { ?>
<div>-</div>
<?php } else { ?>
<div><img src="<?php echo $logo[0]->meta_value; ?>" width="58" /></div>
<?php } ?>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($site->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/sites'); ?>" id="btn-edit" class="btn">Kembali</a>
