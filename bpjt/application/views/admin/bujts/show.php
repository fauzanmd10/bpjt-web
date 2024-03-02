<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $bujt->name; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($bujt->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/bujts'); ?>" id="btn-edit" class="btn">Kembali</a>
