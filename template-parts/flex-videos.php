<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */
$videos = get_sub_field('video');
if($videos):
?>
		<section id="<?php the_sub_field('id'); ?>" class="section--white" data-bgcolor="light">
				<div class="section__container--director">
					<h1 class="section__title"><?php the_sub_field('title'); ?></h1>
					<!-- <div class="breakline"></div> -->
					<div class="video__flexcontainer">
					<?php
					$oembed_endpoint = 'http://vimeo.com/api/oembed';
					foreach ($videos as $video):
						//Vimeo oEmbed API fetch
						$video_url = $video['vimeo_url']; //insert ACF
						$xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url); // . '&width=640'

						$oembed = simplexml_load_string(curl_get($xml_url));

						//check if video is featured, and then append the variance
						if( $video['type'] == 'featured'): $variance = '--featured'; else: $variance = ''; endif;?>

						<?php //the video block ?>
						<a href="<?php echo $video_url; ?>" target="_blank" class="video__container<?php echo $variance; ?>" data-videomodal="true" data-vimeoid="<?php echo $oembed->video_id; ?>">
							<div class="video_innerflexcontainer<?php echo $variance; ?>">
								<div class="video__content<?php echo $variance; ?>">
									<?php if($variance):?> <span class="video__title<?php echo $variance; ?>">Featured video</span> <?php endif; ?>
									<h3 class="video__title--brand"><?php echo $video['brand']; ?></h3>
									<h2 class="video__title"><?php echo $video['title']; ?></h2>
									<button class="btn--video">Play <i class="fa fa-play" aria-hidden="true"></i></button>
								</div>
							</div>
							<div class="video__thumbnail" style="background-image: url(<?php echo $oembed->thumbnail_url; ?>)"></div>
						</a>
						<?php endforeach;?>
					</div>

					
				</div>
			</section>
<?php endif; ?>