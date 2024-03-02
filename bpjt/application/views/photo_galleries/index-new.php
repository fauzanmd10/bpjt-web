	<section id="content">
			<div class="content-wrap">	
		
		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('galeri'); ?></h1>
				<span><?php echo lang('galeri-album-foto'); ?></span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo lang('galeri'); ?></a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo lang('galeri-album-foto'); ?></li>
				</ol>
			</div>

		</section><!-- #page-title end -->
		
		
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				
				<h3><?php echo lang('operasi'); ?></h3>
				<?php $operasii = $this->media->get_galeri_operasi(); ?>
					<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
					<?php foreach($operasii as $operasi) { ?>
						<a class="grid-item" href="<?php echo $operasi->url;?>" data-lightbox="gallery-item"><img src="<?php echo $operasi->url;?>" alt="<?php echo $operasi->title;?>"></a>
						<?php }?>
					</div>

					<div class="divider divider-left">
						<a href="galeri-foto/album-foto/<?php echo lang('operasi'); ?>"  class="button text-end"><?php echo lang('lihat'); ?>
						<?php echo lang('selengkapnya'); ?><i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
		
		<!-- Content Kegiatan
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				
				<h3><?php echo lang('kegiatan-bpjt'); ?></h3>
				<?php $operasii = $this->media->get_galeri_kegiatan(); ?>
					<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
					<?php foreach($operasii as $operasi) { ?>
						<a class="grid-item" href="<?php echo $operasi->url;?>" data-lightbox="gallery-item"><img src="<?php echo $operasi->url;?>" alt="<?php echo $operasi->title;?>"></a>
						<?php }?>
					</div>

					<div class="divider divider-left">
						<a href="galeri-foto/album-foto/kegiatan-bpjt"  class="button text-end"><?php echo lang('lihat'); ?>
						<?php echo lang('selengkapnya'); ?><i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</section><!-- #content end -->

		<!-- Content Konstruksi
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				
				<h3><?php echo lang('kontruksi'); ?></h3>
				<?php $operasii = $this->media->get_galeri_konstruksi(); ?>
					<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
					<?php foreach($operasii as $operasi) { ?>
						<a class="grid-item" href="<?php echo $operasi->url;?>" data-lightbox="gallery-item"><img src="<?php echo $operasi->url;?>" alt="<?php echo $operasi->title;?>"></a>
						<?php }?>
					</div>

					<div class="divider divider-left">
						<a href="galeri-foto/album-foto/<?php echo lang('kontruksi'); ?>"  class="button text-end"><?php echo lang('lihat'); ?>
						<?php echo lang('selengkapnya'); ?><i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
		
		<!-- Content Infografis
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				
				<h3><?php echo lang('infografis'); ?></h3>
				<?php $operasii = $this->media->get_galeri_infografis(); ?>
					<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
					<?php foreach($operasii as $operasi) { ?>
						<a class="grid-item" href="<?php echo $operasi->url;?>" data-lightbox="gallery-item"><img src="<?php echo $operasi->url;?>" alt="<?php echo $operasi->title;?>"></a>
						<?php }?>
					</div>

					<div class="divider divider-left">
						<a href="galeri-foto/album-foto/<?php echo lang('infografis'); ?>"  class="button text-end"><?php echo lang('lihat'); ?>
						<?php echo lang('selengkapnya'); ?><i class="icon-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
            
		</div>
</section>		