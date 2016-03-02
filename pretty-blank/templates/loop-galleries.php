<?php
	global $post, $isMobile, $isTablet;

	$galleryIDs	= get_post_meta($post->ID, 'lmp_gallery_ids', true);

	if( empty( $galleryIDs ) ) continue;

	$galleryArray = explode(',', $galleryIDs );

?>

<div id="post-album-<?php the_ID(); ?>"  <?php post_class("grid-50 mobile-grid-100 albumItem"); ?>>

	<?php 

	echo '<a href="' . get_permalink( ) . '" class="albumImage">';

				if( has_post_thumbnail($post->ID) ) {
					echo get_the_post_thumbnail( $post->ID, 'gallery-thumb-medium-wide' ); 
				}else {
					echo wp_get_attachment_image( $galleryArray[0], 'gallery-thumb-medium-wide' );
				}	



				echo '<div class="albumInfo">';
					echo '<div>';
						the_title('<h2 class="name fitText">', '</h2>');
			
						echo '<p class="hide-on-mobile">';
							echo lmp_get_the_excerpt($post->ID);
						echo '</p>';
						
					echo '</div>';
				echo '</div>';

	echo '</a>';

	?>

</div>