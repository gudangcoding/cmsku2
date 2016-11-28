<?php template_header(); ?>

<section class="container">
	<div class="row">
		<div class="col-md-8 main">
		
			<?php
				$template_halaman = 
				'{breadcrumb}
				 <h3 class="page-header">{judul}</h3>
				 {gambar}<br><br>
				 <div class="konten-halaman">{konten}</div>';
				template_halaman($template_halaman, $_GET['id']);
			?>

		</div>
		<div class="col-md-4 sidebar">
			<div class="widget">
				<?php 
					$judul = '<h4 class="judul">{judul}</h4>';
					$awal_konten = '<div class="konten">';
					$akhir_konten = '</div>';
					template_widget($judul, $awal_konten, $akhir_konten); 
				?>
			</div>
		</div>
	</div>
</section>
<?php template_footer(); ?>
	