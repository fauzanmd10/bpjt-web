<!-- Page Title
		============================================= -->
<section id="page-title">

	<div class="container clearfix">
		<h1><?php echo lang('galeri'); ?></h1>
		<span><?php echo lang('galeri-album-foto'); ?></span>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
			<li class="breadcrumb-item"><a href="<?php echo site_url(); ?>/galeri-foto"><?php echo lang('galeri-album-foto'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"></li>
		</ol>
	</div>

</section><!-- #page-title end -->

<section id="slider" class="slider-element">

	<div class="masonry-thumbs grid-container grid-6" data-big="3" data-lightbox="gallery">
            <?php foreach($medias as $media) { ?>
			<a class="grid-item" href="<?php echo $media->url; ?>" data-lightbox="gallery-item">
				<div class="grid-inner">
				
					<img src="<?php echo $media->url; ?>" alt="<?php echo $media->title; ?>"  title="<?php echo $media->title; ?>" onerror="this.src='/assets/images/no-image.jpg'" >
					<div class="bg-overlay">
						<div class="bg-overlay-content dark">
							<span class="overlay-trigger-icon bg-light text-dark" data-hover-animate="zoomIn" data-hover-animate-out="zoomOut" data-hover-speed="400"><i class="icon-line-image"></i></span>
						</div>
					</div>
				
				</div>
			</a>
			<?php } ?>

    </div> <!-- /masonry thumbs -->
	
</section>
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
		
			<div class="row gutter-40 col-mb-80">
				<ul class="pagination pagination-rounded pagination-sm">
				<?php for($i=1; $i<=$total_page; $i++) { ?>
					<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</section>
