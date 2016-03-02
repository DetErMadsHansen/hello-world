<?php get_header(); ?>

<div id="siteContent" class="widespan">
	<div class="grid-container">

		<div class="grid-75">
			<div class="content">

					<?php
						
						if (have_posts()) :

							while (have_posts()) : 
								the_post();

								get_template_part( 'templates/loop', 'galleries' ); 
								//include get_template_directory() . '/templates/loop-galleries.php';
								//the_title();
							
							endwhile;
							
						else:

							_e('There\'s no content on this page', 'lmp-textdomain');

						endif;
						
						
						wp_reset_postdata();
						
						?>
				<div class="clear"></div>
			</div>
		</div>

		<?php get_sidebar(); ?>

		<div class="clear" ></div>
	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

<?php get_footer(); ?>