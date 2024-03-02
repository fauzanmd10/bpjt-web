<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $road->name; ?></div>
<br />

<div><strong>Pengelola:</strong></div>
<div><?php echo $road->developer; ?></div>
<br />

<div><strong>Panjang (KM):</strong></div>
<div><?php echo $road->road_length; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($road->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/toll_roads'); ?>" id="btn-edit" class="btn">Kembali</a>
