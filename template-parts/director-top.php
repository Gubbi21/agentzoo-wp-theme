<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agent_Zoo_Theme
 */

?>
		<header class="director-header__container" data-bgcolor="dark">
				<?php
				$portraitObject =  get_field('portrait');
				$portraitURL = $portraitObject['url'];
				?>
				<div class="director__portrait--header" style="background-image: url(<?php echo $portraitURL; ?>)"></div>
				<div class="director-header__flexcontainer">
					<div class="director-header__content">
						<h1 class="director-header__title"><?php the_title(); ?></h1>
						
						<?php the_field('description'); ?>

						<?php $awards = get_field('awards');

						if($awards): // show awards if there are any added ?>
							<h4 class="director-header__awardtitle">Awards</h4>
							<ul class="director-header__awardlist" >
							<?php foreach ($awards as $award) {
								echo '<li>' . $award['award'] . '</li>';
							} ?>
							</ul>
						<?php endif;?>	

						<div class="btn__container">
							<a href="#selectedwork" class="btn btn--reverse-white scrollToBtn">Selected work</i></a >
							<a href="mailto:mb@agentzoo.tv?subject=Regarding <?php the_title(); ?>" class="btn btn--reverse-white">Contact</a>
						</div>
					</div>
				</div>

				
			</header>
