<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="section--white" data-bgcolor="light">
				<div class="section__container--fullwidth">
					<h1 class="section__title">Our Directors</h1>
					<div class="breakline"></div>
						<?php
						if ( have_posts() ) :?>
							<div class="director__flexcontainer">
							<?php /* Start the Loop */
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/director', 'archive' );

							endwhile;?>
							</div>
						<?php else :

							//possible 404

						endif; ?>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
