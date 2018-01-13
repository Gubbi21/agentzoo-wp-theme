<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */
?>

<section id="<?php the_sub_field('id'); ?>" class="section--white" data-bgcolor="light">
		<div class="section__container--fullwidth">
			<h1 class="section__title underline"><?php the_sub_field('title'); ?></h1>
			<!-- <div class="breakline"></div> -->
				<?php
				$args = array(
						'post_type' => 'agentzoo_directors',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
						);
				$query = new WP_Query($args);
				if ( $query->have_posts() ) :?>
					<div class="director__flexcontainer">
					<?php /* Start the Loop */
					while ( $query->have_posts() ) : $query->the_post();
						get_template_part( 'template-parts/director', 'archive' );

					endwhile;?>
					</div>
				<?php else :

					//possible 404

				endif; ?>
		</div>
</section>
