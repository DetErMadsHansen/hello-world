<?php get_header(); ?>
<div class="content">
	<?php if (have_posts()) : ?>

		<h1 class="dim"><?php echo sprintf( __( 'Search results for "%s"', 'lmp-textdomain'), $_GET['s'] ); ?></h1>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2><?php the_title(); ?></h2>

				<div class="entry">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink() ?>" class="more"><?php _e( 'Read more', 'lmp-textdomain' ); ?></a>
				</div>

			</div>

		<?php endwhile; ?>

	<?php else : ?>

	<h1><?php _e('Your search didn\'t return anything', 'lmp-textdomain'); ?></h1>
	<div id="question-search">
		<?php get_search_form(); ?>
	</div>


	<?php endif; ?>

</div>

<?php get_footer(); ?>