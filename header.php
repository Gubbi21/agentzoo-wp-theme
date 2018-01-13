<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agent_Zoo_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$meta_description = get_field('meta_description');
if($meta_description == ''){$meta_description = get_field('meta_description','options');}
$seo_image = get_field('seo_image');
if($seo_image == ''){$seo_image = get_field('seo_image','options');}

?>
<meta name="description" content="<?php echo $meta_description; ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<script src="https://use.fontawesome.com/065b7ad0a6.js"></script>

<?php wp_head(); ?>

<!--  Open Graph -->
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $meta_description; ?>" />
<meta property="og:image" content="<?php echo $seo_image; ?>" />




</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a href="<?php echo get_site_url(); ?>" class="title--site"><h1>AgentZoo</h1></a>
			<button class="navigation__toggle menuToggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i> <span class="toggleText">Menu</span></button>

			<div class="navigation__container">
				<a href="<?php echo get_site_url(); ?>" class="logo__container--menu">
						<?php include('img/AZ_Logo.svg'); ?>
				</a>

				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'navigation__list', 'container' => false ) ); ?>
				<div class="navigation__contact">
					<h4>Contact info</h4>
					<div class="contact__container">
						<?php if(have_rows('contact_method','options')):
						while(have_rows('contact_method','options')): the_row(); ?>
						<a class="contact__link" href="<?php the_sub_field('link','options');?>"><?php the_sub_field('text','options');?></a>
						<?php endwhile;endif; ?>	
						 | 
						<?php if(have_rows('social_media','options')):
								while(have_rows('social_media','options')): the_row(); ?>
						<a class="socialicon--black <?php the_sub_field('class','options');?>" href="<?php the_sub_field('link','options');?>" target="_blank"><i class="fa <?php the_sub_field('icon','options');?>" aria-hidden="true"></i></a>
						<?php endwhile;endif; ?>
					</div>
				</div>
			</div>
			
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content blurable">
