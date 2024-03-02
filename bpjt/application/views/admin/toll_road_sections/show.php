<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $toll_road_section->name; ?></div>
<br />

<div><strong>Ruas Tol:</strong></div>
<div><?php echo $toll_road_section->constructing_toll_road_name; ?></div>
<br />

<div><strong>Panjang (KM):</strong></div>
<div><?php echo $toll_road_section->road_length; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($toll_road_section->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/toll_road_sections'); ?>" id="btn-edit" class="btn">Kembali</a>
