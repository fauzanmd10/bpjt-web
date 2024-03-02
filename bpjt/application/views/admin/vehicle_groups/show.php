<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $vehicle_group->name; ?></div>
<br />

<div><strong>Deskripsi:</strong></div>
<div><?php echo $vehicle_group->description; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($vehicle_group->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/vehicle_groups'); ?>" id="btn-edit" class="btn">Kembali</a>
