<?php
/**
 * Template Name: Single Director template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php while ( have_posts() ) : the_post();?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-header">
				<?php get_template_part( 'template-parts/director', 'top' );?>
			</div>
			
			<div class="entry-content">
				<?php while(have_rows('flex_content')): the_row();
						if(get_row_layout() == 'text_block'):
							get_template_part( 'template-parts/flex', 'textblock' );

						elseif(get_row_layout() == 'text_columns'):
							get_template_part( 'template-parts/flex', 'columns' );
						
						elseif(get_row_layout() == 'directors'):
							get_template_part( 'template-parts/flex', 'posttype' );

						elseif(get_row_layout() == 'videos'):
							get_template_part( 'template-parts/flex', 'videos' );

						endif; ?>					
					<?php endwhile; ?>
					
			</div>
		



			
		</article>
		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
