<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>ID Ruas:</strong></div>
<div><?php echo $cctv->id_ruas; ?></div>
<br />

<div><strong>Nama Ruas:</strong></div>
<div><?php echo $cctv->nama_ruas; ?></div>
<br />

<div><strong>Nama CCTV:</strong></div>
<div><?php echo $cctv->nama_cctv; ?></div>
<br />

<div><strong>BUJT:</strong></div>
<div><?php echo $cctv->bujt; ?></div>
<br />

<div><strong>Nama BUJT:</strong></div>
<div><?php echo $cctv->bujt_nama; ?></div>
<br />

<div><strong>Stream URL:</strong></div>
<div><?php echo $cctv->stream; ?></div>
<br />

<div><strong>Protocol:</strong></div>
<div><?php echo $cctv->protocol ? $cctv->protocol : '-'; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($cctv->status == "online") ? "Online" : "Offline"; ?></div>
<br />

<div><strong>Lat:</strong></div>
<div><?php echo $cctv->lat; ?></div>
<br />

<div><strong>Long:</strong></div>
<div><?php echo $cctv->long; ?></div>
<br />


<a href="<?php echo site_url('admin/cctv'); ?>" id="btn-edit" class="btn">Kembali</a>
