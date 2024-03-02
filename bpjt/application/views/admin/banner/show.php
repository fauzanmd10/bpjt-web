<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Judul Banner:</strong></div>
<div><?php echo $banner->judul; ?></div>
<br />

<div><strong>Jenis:</strong></div>
<div><?php echo $banner->jenis; ?></div>
<br />

<div><strong>URL Video:</strong></div>
<div><?php echo $banner->url_video; ?></div>
<br />

<div><strong>Image:</strong></div>
<div>
	<img src="<?php echo $banner->url_video; ?>" style="width: 100px">
</div>
<br />


<a href="<?php echo site_url('admin/banner'); ?>" id="btn-edit" class="btn">Kembali</a>
