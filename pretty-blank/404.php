<?php get_header(); ?>

<div id="siteContent" class="widespan">

	<div class="grid-container">

		<div class="grid-66">
		<?php
			
			echo '<div class="content main">';
		
				echo '<h1><span class="preNote">' . __('Error 404', 'lmp-textdomain') . '</span>&nbsp;' . __('The page could not be found', 'lmp-textdomain') . '</h1>';						

			echo '</div>';
			echo '<div class="clear"></div>';
			
		?>
		</div>

		<?php get_sidebar(); ?>

	</div> <!-- END : grid-container -->
</div> <!-- END : siteContent -->

	
<?php get_footer(); ?>


