<?php get_header(); ?>

<div id="siteContent" class="widespan">

	<div class="grid-container">

		<div class="grid-66">
		<?php
			
			echo '<div class="content main">';
		
				if (have_posts()) :
				
				
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				
					while (have_posts()) : the_post();
					
						$link	= get_the_permalink();
			
						the_title('<h2><a href="' . $link . '">', '</a></h2>');
						
						echo '<p class="byline">' . get_the_time('j. F, Y') . ' &#183; <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author( ) . '</a></p>';

						lmp_the_excerpt( $post->ID );
						
						
						echo '<a class="btn readmore" href="' . $link . '" >' . __( 'Continue reading', 'lmp-textdomain' ) . '</a>';

						echo '<div class="clear"></div>';
						echo '<div class="seperator visual" ></div>';
					
					endwhile;
					
				else:
					echo '<h1><span class="preNote">' . __('Error 404', 'lmp-textdomain') . '</span>&nbsp;' . __('The page could not be found', 'lmp-textdomain') . '</h1>';						
				endif;
				
			echo '</div>';
			echo '<div class="clear"></div>';
			
		?>
		</div>

		<?php get_sidebar(); ?>

	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

	
<?php get_footer(); ?>
