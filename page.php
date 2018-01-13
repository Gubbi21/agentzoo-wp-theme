<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php if( have_rows('flex_content') ): ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
				</article>

			<?php endif; ?>	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
