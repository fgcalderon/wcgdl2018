<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<title> <?php fc_the_title(); ?></title>
	
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php GravatarAsFavicon('16'); ?>" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>
	<body class="<?php fc_body_class() ?>">
		<header>
			<div class="container">	
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo HOMELINK ?>">
								<img src="<?php echo IMAGES ?>/logo.jpg" alt="<?php echo SITENAME ?>"  style="max-width: 90px;">
							</a>
						</div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-8 col-xs-12">
									<div  id ="redes" class="margin-top-md pull-right ">
										<span><a href="https://www.facebook.com/" target="_blank"><img src="<?php echo IMAGES ?>/facebook.png" alt="Facebook"></a></span>
										<span><a href="https://www.twitter.com/ufmedu" target="_blank"><img src="<?php echo IMAGES ?>/twitter.png" alt="Twitter"></a></span>
										<span class='st_sharethis_custom' displayText=''><img src="<?php echo IMAGES ?>/share.png" alt="Compartir"></span>							
			    					</div>
								</div>
								
								<div class="col-md-4 col-xs-12">
									<div class="margin-top-md">
										<?php get_search_form(); ?>
									</div>								
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="pull-right font-small">
									<a href="/" target="_blank" class="text-white">Home</a> <span class="text-white">|</span>
									<a href="<?php echo HOMELINK ?>contactenos" class="text-white">Contáctenos</a>
									</div>
								</div>
							</div>

						</div>
					</div>	
			</div>
		</header>

		<!-- Primary Menu -->
		<nav>
			<div class="container">
				<div class="row margin-top-lg">
					<div class="col-md-12">
						<?php 
							//Arguments for primary menu
							$args = array(
								'theme_location'    =>  'main_menu',
								'container'         =>  'div',
								'container_class'   =>  'main-menu',
								'menu_class'        =>  'nav nav-pills',
								'menu_id'           =>  'main-nav',
								'walker' => new wp_bootstrap_navwalker()
							);

							//Show menu
							if(has_nav_menu( 'main_menu' )){					
									wp_nav_menu( $args ); 
							}			
						?> 
					</div>
				</div>
			</div>
		</nav>		


