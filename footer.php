<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agent_Zoo_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="footer blurable" role="contentinfo">
		<div class="footer__flexcontainer">
			<div class="address__container--footer">
			<dl class="address__list--footer">
				<dt>AgentZoo</dt>
				<?php if(have_rows('address','options')):
						while(have_rows('address','options')): the_row(); ?>
				<dd><?php the_sub_field('address_field','options');?></dd>
				<?php endwhile;endif; ?>		
			</dl>
			</div>
			<div class="contact__container--footer">
				<?php if(have_rows('contact_method','options')):
						while(have_rows('contact_method','options')): the_row(); ?>
				<a class="contact__link" href="<?php the_sub_field('link','options');?>"><?php the_sub_field('text','options');?></a>
				<?php endwhile;endif; ?>	
				 | 
				<?php if(have_rows('social_media','options')):
						while(have_rows('social_media','options')): the_row(); ?>
				<a class="socialicon--white <?php the_sub_field('class','options');?>" href="<?php the_sub_field('link','options');?>" target="_blank"><i class="fa <?php the_sub_field('icon','options');?>" aria-hidden="true"></i></a>
				<?php endwhile;endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->

	
	<div class="overlay overlay--dark"></div>
	<div class="video__modal" >
		<div class="video__wrapper" id="player">
		<button class="btn--close"><i class="fa fa-times" aria-hidden="true"></i> close</button>
		
		</div>
	</div>
</div><!-- #page -->
<script src="https://player.vimeo.com/api/player.js"></script><!-- TODO: move to enqueue scripts!!  -->
<?php wp_footer(); ?>

</body>
</html>
