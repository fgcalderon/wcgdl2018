<?php get_header(); ?>



<div class="container">


	<div class="row">
		<div class="col-md-12">
			<h1>Nuestros Libros</h1>
		</div>
	</div>


	<?php if (have_posts()) : ?>
			       <?php while (have_posts()) : the_post(); ?> 
			    <article id="post-<?php the_ID(); ?>">
			       <div class="row">
			       		<div class="col-md-8">
					       
					       		<h3><?php the_title(); ?></h3>
					       		<div class="excerpt">
					       			<?php the_excerpt(); ?>
					       		</div>
					       		<p>
					       			<a href="<?php the_permalink() ?>">Ver libro...</a>
					       		</p>					       
					     </div>

					     <div class="col-md-4">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="alignleft"><?php the_post_thumbnail('medium', array('class' => 'img-responsive' )); ?></div>										
								<?php  } ?>		
					     </div>

			       </div> 
			    </article>  	

			       <?php endwhile; ?>

	<?php else : ?>


	<div class="row">
		<div class="col-md-12">
			<p>No hay libros disponibles</p>
		</div>
	</div>


	<?php endif; ?>


</div>	



<?php get_footer(); ?>