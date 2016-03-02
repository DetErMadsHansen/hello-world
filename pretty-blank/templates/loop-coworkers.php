<div id="post-coworkers<?php the_ID(); ?>"  <?php post_class("grid-50 mobile-grid-100 grid-parent"); ?>>
	<div class="archivePostWrap element grid-100">
<?php 

	global $post;

	$coPhone	= get_post_meta($post->ID, 'ttp_coworkers_phone', true);
	$coEmail	= get_post_meta($post->ID, 'ttp_coworkers_email', true);
	$coJobtitle	= get_post_meta($post->ID, 'ttp_coworkers_jobtitle', true);
	
	$coEmail	= str_replace('@', '[a]', $coEmail);


	echo '<div class="xarchivePostItem coworkers">';
	
		// Post image
		echo '<div class="contactImage grid-50 mobile-grid-50 grid-parent">';
			echo ( has_post_thumbnail($post->ID) ) ? get_the_post_thumbnail( $post->ID, 'ttp-post-preview' ) : '&nbsp;';
		echo '</div>';

		echo '<div class="contactDesc grid-50 mobile-grid-50 grid-parent">';

			// Name
			the_title('<h2 class="name">', '</h2>');

			// Job title
			if( !empty( $coJobtitle ) )
				echo '<p class="jobtitle">' . $coJobtitle . '</p>';

			// Email
			if( !empty( $coEmail ) )
				echo '<p class="email" rel="' . $coEmail . '">' . $coEmail . '</p>';

			// Phone
			if( !empty( $coPhone ) )
				echo '<p class="phone">' . $coPhone . '</p>';


		echo '</div>'; // END : contactDesc

		echo '<div class="clear"></div>';
	echo '</div>';

//	$colorRGBA	= null;
//	$imgTxt		= null;
	?>
	</div>
</div>