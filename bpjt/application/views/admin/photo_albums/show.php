<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $album->name; ?></div>
<br />

<div><strong>Deskripsi:</strong></div>
<div><?php echo $album->description; ?></div>
<br />

<div><strong>Slug:</strong></div>
<div><?php echo $album->slug; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($album->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<div><strong>Bahasa:</strong></div>
<div><?php echo ($album->lang == "id") ? "Indonesia" : "English"; ?></div>
<br />

<a href="<?php echo site_url('admin/photo_albums'); ?>" id="btn-edit" class="btn">Kembali</a>
