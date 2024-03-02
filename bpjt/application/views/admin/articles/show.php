<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
	Data sudah berhasil disimpan.
</div>
<?php } ?>

<div><strong>Judul:</strong></div>
<div><?php echo $article->title; ?></div>
<br />

<div><strong>Kategori:</strong></div>
<div><?php echo $article->category_name; ?></div>
<br />

<div><strong>Sub Kategori:</strong></div>
<div><?php echo $article->sub_category_name; ?></div>
<br />

<div><strong>Status:</strong></div>
<div><?php echo ($article->status == "published") ? "Published" : "Draft"; ?></div>
<br />

<div><strong>Bahasa:</strong></div>
<div><?php echo ($article->lang == "id") ? "Indonesia" : "English"; ?></div>
<br />

<div><strong>Pengantar:</strong></div>
<div><?php echo $article->excerpt; ?></div>
<br />

<div><strong>Gambar:</strong></div>
<div><?php echo (empty($article->image_name)) ? "-" : $article->image_name; ?></div>
<br />

<div><strong>Kata Kunci:</strong></div>
<div><?php echo (empty($keywords)) ? "-" : $keywords; ?></div>
<br />

<div><strong>Izinkan Komentar:</strong></div>
<div><?php echo ($allow_comment == "1") ? "Ya" : "Tidak"; ?></div>
<br />

<div><strong>Video:</strong></div>
<div><?php echo (empty($video)) ? "-" : $video; ?></div>
<br />

<div><strong>File:</strong></div>
<div>-</div>
<br />

<a href="<?php echo site_url('admin/articles'); ?>" id="btn-edit" class="btn">Kembali</a>
