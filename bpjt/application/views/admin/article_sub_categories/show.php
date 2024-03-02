<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Nama:</strong></div>
<div><?php echo $sub_category->name; ?></div>
<br />

<div><strong>Kategori:</strong></div>
<div><?php echo $sub_category->category_name; ?></div>
<br />

<div><strong>Slug:</strong></div>
<div><?php echo $sub_category->slug; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($sub_category->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<div><strong>Bahasa:</strong></div>
<div><?php echo ($sub_category->lang == "id") ? "Indonesia" : "English"; ?></div>
<br />

<a href="<?php echo site_url('admin/article_sub_categories'); ?>" id="btn-edit" class="btn">Kembali</a>
