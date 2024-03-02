<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $category->name; ?></div>
<br />

<div><strong>Slug:</strong></div>
<div><?php echo $category->slug; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($category->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<div><strong>Bahasa:</strong></div>
<div><?php echo ($category->lang == "id") ? "Indonesia" : "English"; ?></div>
<br />

<a href="<?php echo site_url('admin/article_categories'); ?>" id="btn-edit" class="btn">Kembali</a>
