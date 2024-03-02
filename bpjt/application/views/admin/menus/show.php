<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $menu->name; ?></div>
<br />

<div><strong>Nama (Inggris):</strong></div>
<div><?php echo $menu->name_en; ?></div>
<br />

<div><strong>Parent:</strong></div>
<div>
	<a href="<?php echo site_url('admin/menus/show/'.$menu->parent_id); ?>">
		<?php echo $menu->parent_id; ?>
	</a>
</div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($menu->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/menus'); ?>" id="btn-edit" class="btn">Kembali</a>
