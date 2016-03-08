<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />

	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

	<?php echo ( is_search() ) ? '<meta name="robots" content="noindex, nofollow" />' : ''; ?>

	<title><?php 
		$titleSeperator = '&#183;';
		
		if(is_front_page()) : 
			bloginfo('name');
			echo '&nbsp;' . $titleSeperator . '&nbsp;';
			bloginfo('description');
		else :
			wp_title($titleSeperator, true, 'right');
			bloginfo('name'); 
		endif;
	?></title>
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

	global $isMobile, $isTablet;



if( !$isMobile || $isTablet ) {


	// --- Auxiliary menu --- //

	if( has_nav_menu( 'auxiliary-menu' ) ) {

		$menuAuxiliary = array(
			'theme_location'  => 'auxiliary-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'grid-100',
			'container_id'    => 'menu-auxiliary',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
	}


	// --- Primary menu --- //

	if( has_nav_menu( 'primary-menu' ) ) {

		$menuPrimary = array(
			'theme_location'  => 'primary-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'grid-80',
			'container_id'    => 'menu-primary',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
	}

}else {


	// --- Mobile menu --- //

	if( has_nav_menu( 'mobile-menu' ) ) {

		$menuMobile = array(
			'theme_location'  => 'mobile-menu',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => 'grid-100',
			'container_id'    => 'siteMenuTop',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
	}
} // END : if/else mobile
?>


	<!-- Top Menu -->

	<div id="top-banner" class="widespan">
		<div class="grid-container grid-parent">
			<?php if( isset($menuAuxiliary) ) wp_nav_menu( $menuAuxiliary ); ?>
		</div>
	</div>


	<!-- Primary menu -->

	<div id="header" class="widespan">
		<div class="grid-container grid-parent">

			<div id="logo" class="grid-20 mobile-grid-70">
				<a href="<?php echo get_home_url(); ?>"></a>
			</div>

			<?php if( isset($menuPrimary) ) wp_nav_menu( $menuPrimary ); ?>

		</div>
	</div>
