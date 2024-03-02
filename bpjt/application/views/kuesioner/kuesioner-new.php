	<style>
		.k-container{
			max-width: 800px;
			background: #fff;
			border: 1px solid #ccc;
			margin: 0 auto;
			border-radius: 10px;
			padding: 20px 30px;
			margin-bottom: 20px;
			color: #000;
		}

		.k-container.k-border-top{
			border-top: 10px solid #9E9E9E !important;
		}

		.k-container.k-no-background{
			background: none;
			padding: 0;
			border: none;
		}

		.k-container.k-required-box{
			border: 1px solid #f00;
		}

		.k-title{
			font-size: 32px;
			color: #333;
			margin-bottom: 10px;
		}

		.k-subtitle{
			font-size: 15px;
			color: #333;
			margin-bottom: 20px;
		}

		.k-note{
			font-size: 15px;
			color: #f00;
			margin-bottom: 20px;
		}

		.k-answer-item{
			width: 50%;
			padding-right: 20px;
			margin-bottom: 20px;
		}

		.k-answer-item .img{
			padding: 20px;
			text-align: center;
			border-radius: 6px;
			box-shadow: 0 0 2px 1px rgba(0,0,0,0.3);
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.k-answer-item.selected .img{
			box-shadow: 0 0 2px 2px rgba(0,0,0,0.6);
		}

		.k-answer-item img{
			width: 200px;
		}

		.k-answer-item label{
			text-transform: none;
			font-weight: 500;
			font-size: 14px;
			color: #000;
			font-family: 'Lato', sans-serif;
			width: 100%;
		}

		.k-button{
			background: #fff;
			border: none;
			padding: 7px 20px;
			border-radius: 3px;
			box-shadow: 1px 1px 2px 1px rgba(0,0,0,0.2);
			font-size: 15px;
			font-weight: 600;
			color: #666;
			margin-right: 20px;
		}
		.k-button:hover{
			background: #eee;
		}
		.k-button:active{
			background: #ccc;
		}

		.k-page-info{
			float: right;
			color: #444;
			padding-top: 5px;
		}

		.k-required-info{
			color: #f00;
			display: none;
		}
	</style>
	<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?php echo lang('kuesioner'); ?></h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url(''); ?>"><?php echo lang('home'); ?></a></li>
					<li class="breadcrumb-item"><a href="<?php echo site_url('kuesioner'); ?>"><?php echo lang('kuesioner'); ?></a></li>
					<li class="breadcrumb-item"><a href="<?php echo site_url('kuesioner'); ?>"><?php echo ucwords(str_replace('_', ' ', $kuesioner_type))?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="row gutter-40 col-mb-80" style="background: #F0F0F0;margin-bottom: 30px;padding: 20px;">

						<div class="k-container k-border-top">

							<div class="k-title">Survei Layanan Informasi Publik (<?php echo ucwords(str_replace('_', ' ', $kuesioner_type))?>)</div>
							<div class="k-subtitle">Badan Pengatur Jalan Tol | Kementerian Pekerjaan Umum dan Perumahan Rakyat</div>
							<?php
							if($this->input->get('success') == 'true'):
							?>
							<h4>Respon anda telah dicatat</h4>

							<a href="<?php echo base_url()?>kuesioner/individu">Kirim jawaban lain</a>
							<?php
							else:
							?>
							<div class="k-note">* Menunjukkan pertanyaan yang wajib diisi</div>
							<?php
							endif;
							?>
						</div>

						<?php
						if($this->input->get('success') != 'true'):
						?>
						
						<form action="<?php echo base_url()?>kuesioner/save" method="post">

						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type="hidden" name="type" value="<?php echo $kuesioner_type?>">

						<div class="k-container" id="k_container_question">


							<?php
							if($kuesioners):
								foreach($kuesioners as $idx => $kuesioner):
									$answers = json_decode($kuesioner->answer);
							?>
							<div class="row k-question-item k-question<?php echo $idx; ?>" style="display:none">
								<div>
									<?php echo $kuesioner->question?> <span style="color: #f00">*</span>
								</div>

								<?php
								if($kuesioner->type == 'radio' && $answers):
									foreach($answers as $idxans => $answer):
								?>
								<div class="col-6 k-answer-item k-answer<?php echo $idxans?>">
									<label for="ans<?php echo ($idx + 1); ?>_<?php echo ($idxans + 1); ?>" class="label-answer" data-class="k-answer<?php echo $idxans?>">
										<div class="img">
											<img src="<?php echo base_url()?>assets/images/kuesioner/<?php echo ($idxans + 1)?>.png">
										</div>
										<input type="radio" name="ans<?php echo ($idx + 1); ?>" id="ans<?php echo ($idx + 1); ?>_<?php echo ($idxans + 1); ?>" value="<?php echo ($idxans + 1)?>"> <?php echo $answer?>
									</label>
								</div>
								<?php
									endforeach;
								elseif($kuesioner->type == 'text'):
								?>
								<div style="padding: 0 10px;">
									<textarea class="form-control" name="ans<?php echo ($idx + 1); ?>"></textarea>
								</div>
								<?php
								endif;
								?>

								<div class="k-required-info" id="k_required_info<?php echo ($idx + 1); ?>">Pertanyaan ini wajib diisi</div>
							</div>

							<?php
								endforeach;
							endif;
							?>

						</div>

						<div class="k-container k-no-background">
							
							<button type="button" class="k-button" id="k_btn_back" style="display:none;">Kembali</button>
							<button type="button" class="k-button" id="k_btn_next">Berikutnya</button>
							<button type="submit" class="k-button" id="k_btn_send" style="display:none;">Kirim</button>

							<div class="k-page-info" id="k_page_info">
								Halaman 1 dari 10
							</div>

						</div>

						</form>

						<?php
						endif;
						?>
						
					</div>
				</div> <!-- /#collapse-profil -->

			</div>
		</section><!-- #content end --> <!-- /#content -->

		<script>
			$(document).ready(function(){
				let idxQuestion = 0;
				let answers = [];

				$('.k-question' + idxQuestion).show();
				// $('#k_btn_send').show();

				$('#k_btn_back').click(function(){
					if(idxQuestion > 0){
						idxQuestion--;
					}
					if(idxQuestion > 0){
						$('#k_btn_back').show();
					} else {
						$('#k_btn_back').hide();
					}
					$('.k-question-item').hide();
					$('.k-question' + idxQuestion).show();
					$('#k_page_info').html('Halaman '+ (idxQuestion + 1) +' dari 10');
				});

				$('#k_btn_next').click(function(){
					$('.k-required-info').hide();
					$('#k_container_question').removeClass('k-required-box');
					
					if(!$("input[name=ans"+ (idxQuestion + 1) +"]:checked").val()){
						$('#k_container_question').addClass('k-required-box');
						$('.k-required-info').show();

						return;
					}

					if(idxQuestion < 9){
						idxQuestion++;
					}
					if(idxQuestion > 0){
						$('#k_btn_back').show();
					} else {
						$('#k_btn_back').hide();
					}
					if(idxQuestion < 9){
						$('#k_btn_next').show();
						$('#k_btn_send').hide();
					} else {
						$('#k_btn_next').hide();
						$('#k_btn_send').show();
					}
					$('.k-question-item').hide();
					$('.k-question' + idxQuestion).show();
					$('#k_page_info').html('Halaman '+ (idxQuestion + 1) +' dari 10');
				});

				$('.label-answer').click(function(){
					let selectedClass = $(this).attr('data-class');
					console.log(selectedClass);
					$('.k-answer-item').removeClass('selected');
					$('.' + selectedClass).addClass('selected');
				});
			});
		</script>