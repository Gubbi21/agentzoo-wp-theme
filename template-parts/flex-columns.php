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
	<div class="section__container--slim">
		<h1 class="section__title underline"><?php the_sub_field('title'); ?></h1>
		<!-- <div class="breakline"></div> -->
		<div class="columns__container">
			<?php the_sub_field('text'); ?>
		</div>
		
	</div>
</section>

