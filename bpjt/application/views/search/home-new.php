	<!-- Page Title
		============================================= -->
		<section id="page-title">
			<?php $lang = $this->session->userdata('lang'); ?>
			<div class="container clearfix">
				<h1><?php echo lang('hasil-pencarian'); ?></h1>
                <span><i class="icon-info-sign"></i> <?php echo lang('hasil-pencarian'); ?><strong>"<?php echo clean_str($_GET['keyword']); ?>"</strong> &nbsp;<?php echo lang('ditemukan'); ?> <?php echo lang('dalam')?> <strong>"<?php echo $found_articles; ?>"</strong> <?php echo lang('berita'); ?>
                dan <strong>"<?php echo $count_regulations; ?>"</strong> <?php echo lang('dokumen'); ?></span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="#"><?php echo lang('cari2'); ?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->



				<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
            
                <!-- Artikel -->
                <div class="row col-mb-50">

				    <div class="col-md-7">
				        <?php foreach($articles as $article) { ?>

                            <div class="entry-title title-sm">
                                <h3><a href="<?php echo site_url('berita/' . $article->slug); ?>"><?php echo $article->title; ?></a></h3>
                            </div>
                            <div class="entry-meta">
                                <ul>
                                    <li><span class="badge bg-warning text-dark py-1 px-2"><?php echo $article->category_name; ?></span></li>
                                    <li><a href="#"><i class="icon-calendar3"></i> <?php echo print_casual_date($article->created_at); ?></a></li>

                                </ul>
                            </div>
                            <div class="entry-content">
                                <p><?php echo $article->excerpt; ?>
                                <a href="<?php echo site_url('berita/' . $article->slug); ?>">... <?php echo lang('selengkapnya'); ?></a></p>
                            </div>
                            <div class="line my-5"></div>

                        <?php } ?> 
					    <div> <?php echo lang('halaman'); ?> <?php echo $page; ?> <?php echo lang('dari'); ?> <?php echo $total_page; ?>  <?php echo lang('halaman-berita'); ?>
                        </div>
                        
					        <ul class="pagination pagination-sm" style="max-width:50%;">
							<?php $dot?>
						        <?php for($i=1; $i<=$total_page; $i++) { ?>
									<?php if ($i <=1 ) { 
										$dot=$i;?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
									<?php }elseif($i <=3 && $page < 5) { 
										$dot=$i;?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
									<?php }elseif ($i == $page) {?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
											
									<?php }else if(($page - 1 ==$i) || ($page - 2 ==$i) || ($page - 3 ==$i)){
										if (($i-$dot) != 1) {
											echo '<div style="border:1px solid white;padding:5px;color:#c11717"><<</div>';
										}
										$dot=$i;
										?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
									<?php }else if(($page + 1 ==$i) || ($page + 2 ==$i) || ($page + 3 ==$i)){?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
									<?php }else if(($total_page==$i)){
										if (($i-$dot) != 1) {
											echo '<div style="border:1px solid white;padding:5px;color:#c11717">>></div>';
										}
										$dot=$i;?>
										<li <?php echo ($i==$page) ? "class='page-item active'" : ""; ?>><a href="?keyword=<?php echo clean_str($_GET['keyword']); ?>&page=<?php echo $i; ?>" <?php echo ($i==$page) ? "class='page-link'" : ""; ?> class="page-link"><?php echo $i; ?></a></li>
									
									<?php }?>
								<?php } ?>
					        </ul>
				    </div>

				    <div class="col-md-5">
				    <?php if (empty($content_type)) { ?>	
				    <?php } ?>
					<?php foreach($regulations as $regulation) { ?>
                        
                        <div class="feature-box fbox-effect">
                            <div class="fbox-icon mb-4">
                                <i class="icon-book3 i-alt"></i>
                            </div>
                            <div class="fbox-content">
                                <h5><a href="<?php echo site_url('peraturan/dokumen/' . $regulation->slug); ?>"><?php echo $regulation->title; ?></a></h5>
                                <p class="tanggal"><span class="label label-primary"><?php echo $regulation->sub_content_type; ?></span> <?php echo $formatted_text = str_replace(['<p>', '</p>'], '', $regulation->caption); ?> </p>
                            </div>
                        </div>
                        <div class="line my-5"></div>
					<?php } ?> 
					
					<div> <?php echo lang('halaman'); ?> <?php echo $doc; ?> <?php echo lang('dari'); ?> <?php echo $total_doc; ?>  <?php echo lang('halaman-doc'); ?>
                    </div>
				    <nav>
						
					    <ul class="pagination pagination-sm">
						<?php for($i=1; $i<=$total_doc; $i++) { ?>
							<!-- <li class="page-item active"><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li> -->
							
						<?php }  ?>

							<?php $dot?>
							<?php for($i=1; $i<=$total_doc; $i++) { ?>
								<?php if ($i <=1 ) { 
									$dot=$i;?>
									<li <?php echo ($i==$doc) ? "class='page-item active'" : ""; ?>><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
								<?php }elseif($i <=3 && $doc < 5) { 
									$dot=$i;?>
									<li <?php echo ($i==$doc) ? "class='page-item active'" : ""; ?>><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
								<?php }elseif ($i == $doc) {?>
							 		<li class="page-item active"><a href="?doc=<?php echo $i . $query_vars; ?>"  class="page-link"><?php echo $i; ?></a></li>
										
								<?php }else if(($doc - 1) ==$i || ($doc - 2) ==$i || ($doc - 3) ==$i){
									if (($i-$dot) != 1) {
										echo '<div style="border:1px solid white;padding:5px;color:#c11717"><<</div>';
									}
									$dot=$i;
									?>
									<li <?php echo ($i==$doc) ? "class='page-item active'" : ""; ?>><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
								<?php }else if(($doc + 1 ==$i) || ($doc + 2 ==$i) || ($doc + 3 ==$i)){?>
									<li <?php echo ($i==$doc) ? "class='page-item active'" : ""; ?>><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
								<?php }else if(($total_doc==$i)){
									if (($i-$dot) != 1) {
										echo '<div style="border:1px solid white;padding:5px;color:#c11717">>></div>';
									}
									$dot=$i;?>
									<li <?php echo ($i==$doc) ? "class='page-item active'" : ""; ?>><a href="?doc=<?php echo $i . $query_vars; ?>" <?php echo ($i==$doc) ? "class='page-item'" : ""; ?>  class="page-link"><?php echo $i; ?></a></li>
								
								<?php }?>
							<?php } ?>
				    </nav>
				</div>
            
            </div>
            </div>
</section>
