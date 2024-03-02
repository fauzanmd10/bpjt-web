<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $toll_gate->name; ?></div>
<br />

<div><strong>Ruas Tol:</strong></div>
<div><?php echo $toll_gate->toll_road_name; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($toll_gate->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/toll_gates'); ?>" id="btn-edit" class="btn">Kembali</a>
