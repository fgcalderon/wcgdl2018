<?php get_header(); ?>

<div class="container">
	
	<!-- Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1><?php the_title() ?></h1>
			</div>
		</div>
	</div>


	<!-- Content -->
	<div class="row">
		
		<!-- Primary Loop -->
		<div class="col-sm-9">
			<?php if (have_posts()) : ?>
			       <?php while (have_posts()) : the_post(); ?>    
			       <article id="post-<?php the_ID(); ?>">
			       		<div class="content">
			       			<?php the_content(); ?>
			       		</div>
			       </article>
			       <hr>
			       <?php endwhile; ?>
			<?php endif; ?>

			<!-- Comments -->
			<?php comments_template(); ?>	
		</div>

		<!-- Sidebar -->
		<div class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>