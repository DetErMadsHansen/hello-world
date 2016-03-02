<?php
/*
Template Name: Frontpage
*/
?>

<?php
	get_header();



if( !ttp_is_mobile() || ttp_is_mobile( true ) ) :

	$galleryImages	= get_post_meta($post->ID, 'ttp_slideshow_urls', true);


	if( !empty( $galleryImages ) && function_exists( 'ttp_imageslider' ) ) : 

		echo '<div class="grid-100 imageslider categoryList">';
			echo ttp_imageslider( $galleryImages );
		echo '</div>';
	endif;

endif; // is mobile/tablet 

?>

	<div class="grid-66 grid-parent">
	<?php
	if( function_exists( 'ttp_rand_posts' ) ) :
		echo ttp_rand_posts(8);
	endif;
	?>
	</div>

<?php
	get_sidebar();
	
	get_footer();
?>