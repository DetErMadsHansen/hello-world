<div class="grid-33">
	<div class="content sidebar">

    	<?php get_search_form(); ?>

    		<div class="seperator visual"></div>

		<?php
		
		
		$catquery = new WP_Query( 'category_name=nyheder&posts_per_page=3' );

		if( !empty( $catquery->post_count != 0 ) ){

			echo '<div class="newsholder">';
			
				while($catquery->have_posts()) : $catquery->the_post();
					
					the_title('<h3><a href="' . get_the_permalink() . '">', '</a></h3>');
					
					echo '<p>' . lmp_get_the_excerpt( $post->ID, 110, true ) . '</p>'; //the_content();
					echo '<p class="moreLink"><a href="' . get_the_permalink() . '">' . __('Read more', 'lmp-textdomain') . '</a></p>';
					echo '<div class="clear"></div>';
				endwhile;
			
			echo '</div>';
			
			echo '<div class="seperator visual"></div>';
		}
		
	
		
		// MailChimp Signup
		if( function_exists( 'lmp_mc_signup_form' ) ){
			echo lmp_mc_signup_form();
			echo '<div class="seperator"></div>';
		}
		
		
		?>

		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-right')) : endif; ?>


<?php

	// Contact from
	if( function_exists( 'lmp_form_contact' ) ) {
		echo '<div class="msgholder">';
		echo lmp_form_contact();
		echo '<div class="seperator"></div>';
		echo '</div>';
		
		echo '<div class="seperator visual"></div>';
	}

?>


	</div> <!-- END : content sidebar -->
</div>