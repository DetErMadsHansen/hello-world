<?php
	
get_header();

lmp_gallery_script_dependencies();

?>


<div id="siteContent" class="widespan">
	<div class="grid-container">

		<div class="grid-75">
			<div class="content">

					<?php 
						if (have_posts()) :

							while (have_posts()) : the_post();

								global $post;

								echo '<div class="grid-100">';
									the_title('<h1>', '</h1>');
									
									the_content();
								echo '</div>';

								get_template_part( 'templates/loop', 'single-galleries' );
/*
								echo '<div class="grid-100">';
								the_title('<h1>', '</h1>');

								the_content();
								echo '</div>';

								$galleryIDs	= get_post_meta($post->ID, 'lmp_gallery_ids', true);

								$galleryArray = explode(',', $galleryIDs );

								echo '<div class="albumItems" itemscope itemtype="http://schema.org/ImageGallery">';


								foreach( $galleryArray as $imageID ){

									$imageInfo	= get_post( $imageID );
									$imageAttr	= wp_get_attachment_image_src( $imageID, 'full' );
									$imageDesc	=( !empty($imageInfo->post_excerpt) ) ? ' - ' . $imageInfo->post_excerpt : '';

									echo '<div class="albumItem grid-25 mobile-grid-50" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
										echo '<a href="' . $imageAttr[0] . '" itemprop="contentUrl" data-size="' . $imageAttr[1] . 'x' . $imageAttr[2] . '">';
											echo wp_get_attachment_image( $imageID, 'gallery-medium' );
										echo '</a>';
									//	echo '<figcaption itemprop="caption description">' . $imageInfo->post_excerpt . '</figcaption>';
									echo '</div>';
								}

								echo '</div>';
*/
							endwhile;

						else:

							_e('There\'s no content on this page', 'lmp-textdomain');

						endif; ?>
				<div class="clear"></div>
			</div>
		</div>

		<?php get_sidebar(); ?>

		<div class="clear" ></div>
	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

	
<?php get_footer(); ?>