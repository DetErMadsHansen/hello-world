<?php 
	
get_header();
?>

	<div class="grid-66 grid-parent shadow">
<?php
while( have_posts() ) : the_post();

?>
		<div class="grid-100">
			<div class="content">
				<?php
					the_title( '<h1 class="pageTitle" >', '</h1>' );
					if( function_exists( 'ttp_content_strip_galleries' ) ) {
						ttp_content_strip_galleries( $post->ID, '<p>', '</p>' );
					}else{
						the_content( '<p>', '</p>' );
					}
				?>

				<div class="clear"></div>
			</div>
		</div>
<?php
	
	if( function_exists( 'ttp_show_extract_galleries' ) ) {
		echo '<div class="grid-100 grid-parent">';
			echo '<div class="content grid-parent">';
				ttp_show_extract_galleries( $post->ID, $rel = 'ttp-gallery' );
			echo '</div>';
		echo '</div>';
	}


endwhile;
if( function_exists( 'ttp_rand_posts' ) ) :
	echo '<div class="grid-100 grid-parent">';
		echo '<div class="content listForSingle" >';
			echo ttp_rand_posts( 8, $post->ID );
		echo '</div>';
	echo '</div>';
endif;

?>
	</div>

<?php
get_sidebar();
get_footer();

?>