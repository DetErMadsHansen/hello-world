<?php get_header(); ?>

<div id="siteContent" class="widespan">
	<div class="grid-container grid-parent">

		<div class="grid-66 grid-parent">
			<div class="grid-100">
				<div class="content">

					<?php 
						if (have_posts()) :
							while (have_posts()) : the_post();
						
								the_title('<h1>', '</h1>');
				
								the_content();
							
							endwhile;
						else:

							_e('There\'s no content on this page', 'lmp-textdomain');

						endif; ?>
		            <div class="clear"></div>
				</div>
			</div>
		
		</div>

		<?php get_sidebar(); ?>

	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

	
<?php get_footer(); ?>