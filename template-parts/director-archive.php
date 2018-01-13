<?php
/**
 * Template part for director archive block
 */
$portraitObject =  get_field('portrait');
$portraitURL = $portraitObject['url'];


?>

<a href="<?php echo get_permalink(); ?>" class="director__single">
	<div class="director__wrapper">
		<div class="director__content">
			<h2 class="director__name"><?php the_title(); ?></h2>
			<div class="breakline--white breakline--small"></div>
			<span class="director__text--more">see work</span>
		</div>
		<?php print wp_get_attachment_image($portraitObject['id'],'portrait_archive','',array('class' => 'director__portrait') ); ?>
	</div>
</a>
