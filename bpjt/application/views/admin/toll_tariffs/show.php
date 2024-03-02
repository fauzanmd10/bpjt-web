<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Ruas Tol:</strong></div>
<div><?php echo $toll_tariff->toll_road_name; ?></div>
<br />

<div><strong>Gerbang Masuk:</strong></div>
<div><?php echo $toll_tariff->enter_toll_gate_name; ?></div>
<br />

<div><strong>Gerbang Keluar:</strong></div>
<div><?php echo $toll_tariff->exit_toll_gate_name; ?></div>
<br />

<div><strong>Golongan:</strong></div>
<div><?php echo $toll_tariff->vehicle_group_name; ?></div>
<br />

<div><strong>Tarif:</strong></div>
<div><?php echo $toll_tariff->tariff; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($toll_tariff->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<a href="<?php echo site_url('admin/toll_tariffs'); ?>" id="btn-edit" class="btn">Kembali</a>
