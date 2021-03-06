<?php get_header(); ?>

<div id="siteContent" class="widespan">

	<div class="grid-container">

		<div class="grid-66">
			<div class="content main">

				<?php 
					if (have_posts()) :
						while (have_posts()) : the_post();
					
							the_title('<h1>', '</h1>');
			
							the_content();
						
						endwhile;
					else:
						
						echo '<h1>' . __('There\'s no content on this page', 'lmp-textdomain') . '</h1>';

					endif; ?>
	            <div class="clear"></div>
			</div>
		
		</div>

		<?php get_sidebar(); ?>

	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

	
<?php get_footer(); ?>
