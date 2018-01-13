<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
				
				<div class="section__container--slim">
				    <h2 class="section__title"><?php esc_html_e( 'Oops...', 'agentzoo_theme' ); ?></h2>
                  
                   
                    <p><?php esc_html_e( 'We don&rsquo;t know how you found this page... but surely you seemed to have found the only page, we surely didn&rsquo;t want you to find. So please allow us to escort you back to our homepage, while we beat ourselves up about not having hidden it any better.', 'agentzoo_theme' ); ?></p>
                    
                
				</div>
				</header><!-- .page-header -->

				<div class="page-content">
					

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
