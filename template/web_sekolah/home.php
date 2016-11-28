<?php template_header(); ?>

<section id="slideshow" class="hidden-xs">
	<div  class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="carousel" class="carousel slide">
					<div class="carousel-inner">
						<?php
							$folder_template = web_info('url').'/'.folder_template();
							for($i=1; $i<=3; $i++){
								echo '<div class="item';
								if($i==1) echo ' active';
								echo '">
										<img src="'.$folder_template.'/images/'.$i.'.jpg" width="100%">
									</div>';
							}
						?>		
					</div>
					
					<a class="left carousel-control" href="#carousel"  data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<br>

<?php template_footer(); ?>