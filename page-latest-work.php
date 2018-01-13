<?php
/**
 * Template Name: Latest Work template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="section--white" data-bgcolor="light">
				<div class="section__container--director">
					<h1 class="section__title"><?php the_title(); ?></h1>
					<div class="breakline"></div>
						<?php
                            $args = array(
                                'post_type' => 'agentzoo_videos',
                                'posts_per_page' => 10
                            );
                    
                            $query = new WP_Query( $args );
                    
                            if($query->have_posts()):?>
                                <div class="video__flexcontainer">
                                
                                <?php
                                $oembed_endpoint = 'http://vimeo.com/api/oembed';

                                while($query->have_posts()):$query->the_post();
                                    //Vimeo oEmbed API fetch
                                    
                                    
                                    $video_url = get_field('vimeo_url'); //insert ACF
                                    $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url); // . '&width=640'

                                    $oembed = simplexml_load_string(curl_get($xml_url));
                                    

                                    

                                   //the video block ?>
                                    <a href="<?php echo $video_url; ?>" target="_blank" class="video__container video__container--latest-work" data-videomodal="true" data-vimeoid="<?php echo $oembed->video_id; ?>">
                                        <div class="video_innerflexcontainer">
                                            <div class="video__content">
<!--                                                <h3 class="video__title--brand"> <?php the_field('Director'); ?></h3>-->
                                                <?php
                                                $director_object = get_field('director');
                                                $director_name = $director_object->post_title;
                                                ?>
                                                <h3 class="video__title--brand"><?php echo $director_name; ?></h3>
                                                <h2 class="video__title"><?php the_field('title'); ?></h2>
                                                <button class="btn--video">Play <i class="fa fa-play" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <div class="video__thumbnail" style="background-image: url(<?php echo $oembed->thumbnail_url; ?>)"></div>
                                    </a>
					
					

                               <?php endwhile;?>
                    
                                </div>
                           <?php endif;?>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
