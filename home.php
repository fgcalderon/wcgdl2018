<?php get_header(); ?>

<div class="container">
	
	<!-- Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1><?php fc_the_title(); ?></h1>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="row">
		
		<!-- Primary Loop -->
		<div class="col-sm-12">
				<?php if (have_posts()) : ?>
			       <?php while (have_posts()) : the_post(); ?>    
			       <article id="post-<?php the_ID(); ?>">
			       		<h3><?php the_title(); ?></h3>

						<?php if ( has_post_thumbnail() ) { ?>
							<div class="alignleft"><?php the_post_thumbnail('medium', array('class' => 'img-responsive' )); ?></div>										
						<?php  } ?>				       		
			       		
			       		<div class="excerpt">
			       			<?php the_excerpt(); ?>
			       		</div>
			       		<p>
			       			<a href="<?php the_permalink() ?>">Read more...</a>
			       		</p>
			       </article>
			       <div class="clearfix"></div>		
			       <hr>
			       <?php endwhile; ?>
			<?php endif; ?>
		</div>

		
	</div>
</div>

<?php get_footer(); ?>