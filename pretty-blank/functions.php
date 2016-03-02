<?php


/* --------------------
----- Theme Setup -----
-------------------- */


// --- Load translation, Textdomain --- //

if(!function_exists('lmp_add_languages')) :

	function lmp_add_languages(){
		load_theme_textdomain( 'lmp-textdomain', get_template_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'lmp_add_languages' );

endif; // END function exists : lmp_add_languages




// --- Images --- //

function lmp_image_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'lmp_image_setup' );




// --- Menus --- //


if ( !function_exists('lmp_register_menus') ) :
	
	function lmp_register_menus() {
		register_nav_menus( array(
			'primary-menu'		=> __( 'Primary menu', 'lmp-textdomain'),
			'auxiliary-menu'	=> __( 'Auxiliary menu', 'lmp-textdomain'), // ancillary
			'footer-menu'		=> __( 'Footer menu', 'lmp-textdomain'),
			'mobile-menu'		=> __( 'Mobile menu', 'lmp-textdomain')
		));
	}	

	add_action( 'init', 'lmp_register_menus' );

endif; // function exists : lmp_register_menus



// --- Sidebar --- //


if ( !function_exists('lmp_register_sidebar')) :

	function lmp_register_sidebar(){

		register_sidebar( array(
		    'id'			=> 'widget-right',
		    'name'			=> __( 'Right Widget', 'lmp-textdomain'),
		    'description'	=> __( 'Widget for right sidebar.', 'lmp-textdomain'),
			'before_widget'	=> '<div>',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1>',
			'after_title'	=> '</h1>',
		));
	} 

	add_action('widgets_init', 'lmp_register_sidebar');

endif; // function exists : lmp_register_menus






/* --------------------
----- Stylesheets -----
-------------------- */


if ( !function_exists('lmp_register_styles')) :

	function lmp_register_styles() {

		// Theme Info : theme root style
		wp_register_style(
			'theme-info', // Kaldenavn (skal være unik)
			get_template_directory_uri() . '/style.css', // URL til css filen
			array(), // Dependencies (afhængige styles), angiv de stylesheets der skal hentes før dette.
			false, // Version
			'all' // Media, indstiller medietypen
		);
		wp_enqueue_style( 'theme-info' );



		// Menus
		wp_register_style(
			'menus',
			get_template_directory_uri() . '/css/menus.css',
			array( 'theme-info', 'unsemantic-responsive', 'unsemantic-responsive-tablet' ),
			false,
			'all'
		);
		wp_enqueue_style( 'menus' );



		// General CSS
		wp_register_style(
			'basic-frontend',
			get_template_directory_uri() . '/css/basic-frontend.css',
			array( 'theme-info', 'menus', 'unsemantic-responsive', 'unsemantic-responsive-tablet' ),
			false,
			'all'
		);
		wp_enqueue_style( 'basic-frontend' );





		// --- Unsemantic : CSS grid --- //


		// Responsive 
		wp_enqueue_style(
			'unsemantic-responsive',
			get_template_directory_uri() . '/addons/unsemantic/unsemantic-grid-responsive.css',
			array( 'theme-info' ),
			false,
			'all'
		);


		// Tablet
		wp_enqueue_style(
			'unsemantic-responsive-tablet',
			get_template_directory_uri() . '/addons/unsemantic/unsemantic-grid-responsive-tablet.css',
			array( 'unsemantic-responsive' ),
			false,
			'all'
		);


		// IE
		wp_register_style(
			'unsemantic-ie9',
			get_template_directory_uri() . '/addons/unsemantic/ie.css',
			array('unsemantic-responsive'),
			false,
			'all'
		);



		// --- Conditional tags --- //


		global $wp_styles;
		
		// IE, lt IE9
		$wp_styles->add_data( 
			'unsemantic-ie9', //handle 
			'conditional',  //is a conditional comment 
			'(lt IE 9) & (!IEMobile)' //the conditional comment 
		);

		$wp_styles->enqueue(
			array(
				'unsemantic-ie9'
			)	
		);


	}

	add_action( 'wp_enqueue_scripts', 'lmp_register_styles' );

endif; // function exists : lmp_register_styles






/* -------------------
----- Javascript -----
------------------- */


// Register Javascript frontend
function lmp_register_frontend_scripts(){

	wp_register_script( 
		'lmp-frontend', // Kaldenavn (skal være unik)
		get_template_directory_uri() . '/js/basic-frontend.js', // URL til .js filen
		array('jquery'), // Dependencies (afhængige scripts), angiv de scripts der skal hentes før dette
		'1.0.0', // version 
		true // Indsæt script, true: hentes i footeren, false: hentes i headeren
	);
	wp_enqueue_script('lmp-frontend');


	wp_register_script(
		'lmp-analytics',
		get_template_directory_uri() . '/js/ga.js',
		array(),
		'1.0.0', 
		true
	);
	wp_enqueue_script('lmp-analytics');

}

add_action('wp_enqueue_scripts', 'lmp_register_frontend_scripts');



// Register Javascript admin
function lmp_register_admin_scripts(){

	wp_register_script( 
		'lmp-admin',
		get_template_directory_uri() . '/js/basic-admin.js',
		array('jquery'),
		'1.0.0',
		true
	);
	wp_enqueue_script('lmp-admin');
	
}

add_action('admin_enqueue_scripts', 'lmp_register_admin_scripts');



// Javascript with Conditional tag : load HTML5 for lt IE8 
add_action( 'wp_head', function() {
   echo '<!--[if lt IE 9]><script src="' . get_template_directory_uri() . '/js/html5.js' . '"></script><![endif]-->';
} );






/* ------------------------
----- CPT and Options -----
------------------------ */

// Coworkers
//include get_template_directory() . '/inc/cpt-coworkers.php';


// Galleries
include get_template_directory() . '/inc/cpt-galleries.php';






/* ----------------------
----- Theme options -----
---------------------- */


// Set linked pages
function lmp_setup_theme_admin_menus() {

	// Options menu
	$parent_slug	= 'options-general.php';
	$page_title		= __( 'Theme Links', 'lmp-textdomain' );
	$menu_title		= __( 'Theme links', 'lmp-textdomain' );
	$capability		= 'manage_options';
	$menu_slug		= 'setup_theme_links';
	$function		= 'lmp_link_setup_settings';

	add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);


	// Page markup
	function lmp_link_setup_settings() {

		if (!current_user_can('manage_options')) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'lmp-textdomain' ) );
		}else{
			include( get_template_directory() . '/inc/admin-theme-links.php' );
		}
	}
}

// add_action('admin_menu', 'lmp_setup_theme_admin_menus');





/* ----------------------
----- Miscellaneous -----
---------------------- */



// --- Mobile detection --- //

function lmp_is_mobile( $checkTablet = false ){

	// Mobile Detect
	require_once get_template_directory() . '/addons/mobile-detect.php'; 

	$md = new Mobile_Detect;

	if( !$checkTablet ){
		$divice	= $md->isMobile();
	}else {
		$divice	= $md->isTablet();
	}

	return $divice;
}

$isMobile = lmp_is_mobile();
$isTablet = lmp_is_mobile( true );




// Returns an excerpt from get_content
if ( !function_exists( 'lmp_get_the_excerpt' ) ) :

	function lmp_get_the_excerpt($postID, $textLimit = 195, $cutWord = false) {
	
		if( empty( $postID ) ){
			return;
		}
	
		$thePost = get_post( $postID );
		$excerpt = $thePost->post_excerpt;
		$content = $thePost->post_content;
	
		if( !empty( $excerpt ) ){
			
			$excerpt	= apply_filters( 'the_content', $excerpt );
			$excerpt	= str_replace( ']]>', ']]&gt;', $excerpt );
			
			return $excerpt;
		}
	
		$content = strip_tags( $content );
	
		if(strlen( $content ) > $textLimit) {
	
			if( $cutWord ){
				$display_arr_content = substr( $content, 0, $textLimit ) . '...';
			}else{
				$temp_arr_content = explode(" ", substr( strip_tags( $content ), 0, $textLimit ) ); 
				$temp_arr_content[count($temp_arr_content)-1] = ""; 
				$display_arr_content = implode(" ", $temp_arr_content) . ' ...';
			}
	
		}else {
			$display_arr_content = $content;
		}


		$display_arr_content	= apply_filters( 'the_content', $display_arr_content );
		$display_arr_content	= str_replace( ']]>', ']]&gt;', $display_arr_content );

		return  $display_arr_content;
				
	} // END function

endif;


if( !function_exists( 'lmp_the_excerpt' ) ) :

	function lmp_the_excerpt( $postID, $textLimit = 195, $cutWord = false ) {
		
		$excerpt	= lmp_get_the_excerpt($postID, $textLimit, $cutWord);
	
		echo $excerpt;
	
	}

endif;




// Byline : Bottom left
if (!function_exists('lmp_admin_footer_byline')) :
	
	function lmp_admin_footer_byline($text) {
		$link = '<a href="http://letsmakeitpretty.co.uk/">M.Hansen - letsmakeitpretty</a>';
	    $text = sprintf( __('Wordpress theme by %s', 'lmp-textdomain'), $link );
	    return $text;
	};
	
	add_filter('admin_footer_text', 'lmp_admin_footer_byline');

endif; // END function exists : lmp_admin_footer_byline






/* -------------------------
----- Disable Comments -----
------------------------- */

/*
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');
*/