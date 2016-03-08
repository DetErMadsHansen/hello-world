<?php
	
get_header();

wp_enqueue_script('ttp-coworkers');

echo '<div class="grid-66 grid-parent">';

	$colorHEX		= ttp_get_term_color( $post->ID );
	$single_title	= single_term_title( '', false);

	echo '<div class="grid-100">';
		echo '<h1 class="pageTitle" style="border-color: ' . $colorHEX . ';">';
			echo ( !empty( $single_title ) ) ? $single_title : post_type_archive_title('', false);
		echo '</h1>';
	echo '</div>';


	if ( have_posts ()) {

		while ( have_posts () ) {
			the_post ();

			get_template_part( 'templates/loop', 'coworkers' ); // include get_template_directory() . '/templates/loop-cpt_coworkers.php';
		}

		echo '<div class="clear"></div>';
	
	} else {
	//	get_template_part ( 'content-none' );
	}

echo '</div>';

get_sidebar();
get_footer();
?>