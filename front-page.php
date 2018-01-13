<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		                 
                            
			<header class="frontpage-header__container" data-bgcolor="dark">
                        
                 <?php    
                                $args = array(
                                'post_type' => 'agentzoo_videos',
                                'orderby' => 'rand',
                                'posts_per_page' => 1
                            );
            
                            $query = new WP_Query( $args );
                            
                            if($query->have_posts()):
                         
                    $oembed_endpoint = 'http://vimeo.com/api/oembed';
                    while($query->have_posts()):$query->the_post();
                
                    $video_url = get_field('vimeo_url');
					
					$xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url); // . '&width=640'
					$oembed = simplexml_load_string(curl_get($xml_url));

					//video_id	thumbnail_url
					$playerSRC = 'https://player.vimeo.com/video/' . $oembed->video_id . '?background=1';
				
                                endwhile; 
                
                                endif;
                
                        ?>
				
				<div class="frontpage-header__flexcontainer">
					<div class="logo__container--top">
						<?php include('img/AZ_Logo_negativ.svg'); ?>
					</div>
					<h2 class="frontpage-header__tagline"><?php echo get_bloginfo('description'); ?></h2>
					<div class="btn__container">
						<button class="btn btn--reverse-white" data-videomodal="true" data-vimeoid="<?php echo $oembed->video_id; ?>">Play Showreel <i class="fa fa-play" aria-hidden="true"></i></button>
						<a href="#directors" class="btn btn--reverse-white scrollToBtn">Meet the directors</a>
					</div>
				</div>
				
				<div id="bgplayer" class="frontpage-header__video">
					
					<iframe src="<?php echo $playerSRC; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					<div class="frontpage-header__videothumbnail" style="background-image: url(<?php echo $oembed->thumbnail_url; ?>)"></div>
				</div>
			        <?php wp_reset_postdata(); ?>        
			</header>

		<?php if( have_rows('flex_content') ): ?>
				<?php while(have_rows('flex_content')): the_row();
					if(get_row_layout() == 'text_block'):
						get_template_part( 'template-parts/flex', 'textblock' );

					elseif(get_row_layout() == 'text_columns'):
						get_template_part( 'template-parts/flex', 'columns' );
					
					elseif(get_row_layout() == 'directors'):
						get_template_part( 'template-parts/flex', 'posttype' );

					endif; ?>					
				<?php endwhile; ?>
			<?php endif; ?>	
			
		</article>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();