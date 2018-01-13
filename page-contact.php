<?php
/**
 * Template Name: contact template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="section--white" data-bgcolor="light">
				<div class="section__container">
					<h1 class="section__title">Contact</h1>
					<div class="breakline"></div>
					<div class="contact__flexcontainer">
						<div class="contact__flexelement">
							<h2>Where to find us</h2>
							<dl class="contact__list">
								<dt>AgentZoo</dt>
								<?php if(have_rows('address','options')):
										while(have_rows('address','options')): the_row(); ?>
								<dd><?php the_sub_field('address_field','options');?></dd>
								<?php endwhile;endif; ?>
								<dd><a href="<?php the_field('maps', 'options'); ?>" class="btn btn--primary"><i class="fa fa-map" aria-hidden="true"></i> Google Maps</a></dd>
							</dl>

						</div>
						<div class="contact__flexelement">
							<h2>How to get in touch</h2>
							<dl class="contact__list">
								<dt>call us</dt>
								<dd><a class="contact__link" href="tel:+4527112022">+45 27 11 20 22</a></dd>
								<dt>write to us</dt>
								<dd><a class="contact__link" href="mailto:mb@agentzoo.tv">mb@agentzoo.tv</a></dd>
								<dd><a href="mailto:mb@agentzoo.tv" class="btn btn--primary"><i class="fa fa-envelope" aria-hidden="true"></i> Write an email</a></dd>
							</dl>
						</div>

					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
