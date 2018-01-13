<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */
$buttons = get_sub_field('buttons');

?>

<section id="<?php the_sub_field('id'); ?>" class="section--grey" data-bgcolor="light">
	<div class="section__container--slim">
		<h1 class="section__title underline"><?php the_sub_field('title');?></h1>
		<!-- <div class="breakline"></div> -->
		<?php the_sub_field('text');?>

		<?php if ($buttons): ?>
			<div class="btn__container">
				<?php foreach ($buttons as $button):?>	
				<?php if( $button['type'] == 'link'): ?>
					<a href="<?php echo $button['link']; ?>" class="<?php echo $button['style']; ?>" target="_blank"><?php echo $button['text']; ?></a>
				<?php elseif ($button['type'] == 'page'): ?>
					<a href="<?php echo $button['page']; ?>" class="<?php echo $button['style']; ?>"><?php echo $button['button_text']; ?></a>
				<?php elseif ($button['type'] == 'scroll_to'): ?>
					<a href="#<?php echo $button['scroll_to']; ?>" class="<?php echo $button['style']; ?> scrollToBtn" data-scrollto="<?php echo $button['scroll_to']; ?>"><?php echo $button['button_text'];?></a>
				<?php endif;?>	
				<?php endforeach; ?>	
			</div>
		<?php endif; ?>	

		
	</div>
</section>