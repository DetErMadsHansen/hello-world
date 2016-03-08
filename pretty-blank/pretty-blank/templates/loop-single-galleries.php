<?php

	global $isMobile;

	$galleryIDs	= get_post_meta($post->ID, 'lmp_gallery_ids', true);
	
	$galleryArray = explode(',', $galleryIDs );
	
echo '<div id="albumItems" itemscope itemtype="http://schema.org/ImageGallery">';
	
	
	$i = 1;
	
	foreach( $galleryArray as $imageID ){

		$gridWide	= 'grid-66 mobile-grid-100';
		$gridNarrow	= 'grid-33 mobile-grid-50';	


		$imageInfo	= get_post( $imageID );
		$imageAttr	= wp_get_attachment_image_src( $imageID, 'gallery-large' );
		$imageDesc	=( !empty($imageInfo->post_excerpt) ) ? ' - ' . $imageInfo->post_excerpt : '';

		// Portrait or Landscape
		$format	= ( $imageAttr[1] >= $imageAttr[2] ) ? 'landscape' : 'portrait';

		$grid	= /*( $imageSizes[$key] == 'gallery-small' ) ? 'grid-33' :*/ $gridWide;
		$grid	= ( $i == 1 ) ? $gridWide : $grid;
		$grid	= ( $i >= 2 && $i <= 9 ) ? $gridNarrow : $grid;
		$grid	= ( $i >= 10 && $i <= 11 ) ? $gridWide : $grid;
		$grid	= ( $format == 'portrait' && $i != 1 ) ? $gridNarrow : $grid;


		if( $isMobile ) {

			$grid	= ( $i >= 2 && $i <= 6 ) ? $gridNarrow : $grid;
			$grid	= ( $i >= 6 && $i <= 7 ) ? $gridWide : $grid;

			if( $i >= 6  ) {
				$i = 2;
			}else {
				$i++;
			}

		}else {

			if( $i >= 10  ) {
				$i = 2;
			}else {
				$i++;
			}

		}


		


		echo '<div class="albumItem ' . $grid . ' ' . $format . '" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
						
			echo '<a href="' . $imageAttr[0] . '" itemprop="contentUrl" data-size="' . $imageAttr[1] . 'x' . $imageAttr[2] . '">';
				echo wp_get_attachment_image( $imageID, 'gallery-medium' );
			echo '</a>';
		//	echo '<figcaption itemprop="caption description">' . $imageInfo->post_excerpt . '</figcaption>';
		echo '</div>';
	}

echo '</div>';	
?>