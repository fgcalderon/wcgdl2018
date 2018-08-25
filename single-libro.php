<?php get_header(); ?>







<div class="container">
	<?php if (have_posts()) : ?>
			       <?php while (have_posts()) : the_post(); ?> 
			    <article id="post-<?php the_ID(); ?>">

			    	<div class="row">
			    		<div class="col-md-12">
			    			<?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail('full', array('class' => 'img-responsive' )); ?>								
								<?php  } ?>		
			    		</div>
			    	</div>

			       <div class="row">
			       		<div class="col-md-8">
					       
					       		<h3><?php the_title(); ?></h3>
					       		<div class="excerpt">
					       			<?php the_content(); ?>
					       		</div>
					       		<p>
					       			<a href="<?php the_permalink() ?>">Ver libro...</a>
					       		</p>					       
					     </div>

					     <div class="col-md-4">
								<a class="btn btn-success">Comprar</a>
					     </div>

			       </div> 
			    </article>  	

			       <?php endwhile; ?>
	<?php endif; ?>


</div>	



<?php get_footer(); ?>