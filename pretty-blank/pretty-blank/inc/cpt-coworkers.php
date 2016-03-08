<?php



/* ------------------------------------------
----- Templates Path : Custom Post Type ----- 
------------------------------------------ */


// Archive templates
function lmp_coworkers_plugin_template_archive( $archive_template ) {
	global $post;

	if ( is_post_type_archive( 'lmp_coworkers' ) || get_post_type() == 'lmp_coworkers' ) {
		$archive_template = get_template_part( 'templates/archive', 'coworkers' ); //get_template_directory() . '/templates/archive-cpt_coworkers.php';
	}

	return $archive_template;
}

add_filter( 'archive_template', 'lmp_coworkers_plugin_template_archive' );
add_filter( 'category_template', 'lmp_coworkers_plugin_template_archive' );




// Single templates
function lmp_coworkers_plugin_template_single( $single_template ) {
	global $post;

	if ( is_singular( 'lmp_coworkers' ) ) {
		$single_template = get_template_part( 'templates/single', 'coworkers' ); //get_template_directory() . '/templates/single-cpt_coworkers.php';
	}

	return $single_template;
}

add_filter( 'single_template', 'lmp_coworkers_plugin_template_single' );







/* ------------------------
----- Coworkers : CPT -----
------------------------ */



// --- Setup Custom Post Type --- //

function lmp_setup_coworkers() {
	$labels = array(
		'name'					=> _x( 'Coworkers', 'post type general name', 'lmp-textdomain' ),
		'singular_name'			=> _x( 'Coworker', 'post type singular name', 'lmp-textdomain' ),
		'menu_name'				=> _x( 'Coworkers', 'admin menu', 'lmp-textdomain' ),
		'name_admin_bar'		=> _x( 'Coworker', 'add new on admin bar', 'lmp-textdomain' ),
		'add_new'				=> __( 'Add Coworker', 'lmp-textdomain' ),
		'add_new_item'			=> __( 'Add New Coworker', 'lmp-textdomain' ),
		'new_item'				=> __( 'New Coworker', 'lmp-textdomain' ),
		'edit_item'				=> __( 'Edit Coworker', 'lmp-textdomain' ),
		'view_item'				=> __( 'View Coworker', 'lmp-textdomain' ),
		'all_items'				=> __( 'All Coworkers', 'lmp-textdomain' ),
		'search_items'			=> __( 'Search Coworkers', 'lmp-textdomain' ),
		'parent_item_colon'		=> null,//__( 'Parent Coworker:', 'lmp-textdomain' ),
		'not_found'				=> __( 'No coworkers listed', 'lmp-textdomain' ),
		'not_found_in_trash'	=> __( 'No items found in Trash.', 'lmp-textdomain' )
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'query_var'				=> true,
		'rewrite'				=> array( 'slug' => _x('medarbejder', 'Coworker URL', 'lmp-textdomain') ),
		'capability_type'		=> 'post',
		'has_archive'			=> true,
		'hierarchical'			=> false,
		'menu_position'			=> null,
		'supports'				=> array( 'title', 'editor', 'thumbnail' ),
		'exclude_from_search'	=> false
//		, 'menu_icon'			=> 'url'
	);

	register_post_type( 'lmp_coworkers', $args );
}

add_action( 'init', 'lmp_setup_coworkers' );







/* -------------------------------
----- Taxonomy for Coworkers -----
------------------------------- */


// Register taxonomies
function lmp_coworkers_taxonomies() {


	// --- Departments --- //

	$departmentLabels = array(
		'name'              => __('Departments', 'lmp-textdomain'),
		'singular_name'     => __('Department', 'lmp-textdomain'),
		'search_items'      => __('Search Departments', 'lmp-textdomain'),
		'all_items'         => __('All Departments', 'lmp-textdomain'),
		'parent_item'       => __('Parent Department', 'lmp-textdomain'),
		'parent_item_colon' => __('Parent Department:', 'lmp-textdomain'),
		'edit_item'         => __('Edit Department', 'lmp-textdomain'),
		'update_item'       => __('Update Department', 'lmp-textdomain'),
		'add_new_item'      => __('Add New Department', 'lmp-textdomain'),
		'new_item_name'     => __('New Department Name', 'lmp-textdomain'),
		'menu_name'         => __('Edit Departments', 'lmp-textdomain'),
	);

	$departmentArgs = array(
		'labels'				=> $departmentLabels,
		'hierarchical'			=> true,
		'query_var'				=> true,
		'sort'					=> true,
		'show_admin_column'		=> true,
		'show_ui'				=> true,
		'update_count_callback'	=> '_update_generic_term_count',
		'query_var'				=> true,
		'rewrite'				=> array(
			'slug' => 'afdeling'
		)
	);

	register_taxonomy( 'lmp_coworkers_departments', array('lmp_coworkers'), $departmentArgs );




	// --- Job functions --- //

	$jobfunctionLabels = array(
		'name'              => __('Job functions', 'lmp-textdomain'),
		'singular_name'     => __('Job function', 'lmp-textdomain'),
		'search_items'      => __('Search Job functions', 'lmp-textdomain'),
		'all_items'         => __('All Job functions', 'lmp-textdomain'),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __('Edit Job function', 'lmp-textdomain'),
		'update_item'       => __('Update Job function', 'lmp-textdomain'),
		'add_new_item'      => __('Add New Job function', 'lmp-textdomain'),
		'new_item_name'     => __('New Job function Name', 'lmp-textdomain'),
		'menu_name'         => __('Edit Job functions', 'lmp-textdomain'),
	);

	$jobfunctionArgs = array(
		'labels'				=> $jobfunctionLabels,
		'hierarchical'			=> false,
		'query_var'				=> true,
		'sort'					=> true,
		'show_admin_column'		=> true,
		'show_ui'				=> true,
		'update_count_callback'	=> '_update_generic_term_count',
		'query_var'				=> true,
		'rewrite'				=> array(
			'slug' => 'jobfunktion'
		)
	);

	register_taxonomy( 'lmp_coworkers_jobfunctions', array('lmp_coworkers'), $jobfunctionArgs );


} // END function

add_action('init', 'lmp_coworkers_taxonomies');







/* ------------------
----- Metaboxes -----
------------------ */



// Opret meta boxe til custom post type
function lmp_coworkers_add_metabox() {
	add_meta_box('lmp_coworkers_contact', __('Contact and Jobtitle', 'lmp-textdomain'), 'lmp_coworkers_contact_markup', 'lmp_coworkers', 'side', 'low' );
//	add_meta_box('lmp_slider_gallery', __('Imageslider', 'lmp-textdomain'), 'lmp_slideshow_markup', 'lmp_coworkers', 'advanced', 'default' );
//	add_meta_box('lmp_slider_gallery_pages', __('Imageslider', 'lmp-textdomain'), 'lmp_slideshow_markup', 'page', 'advanced', 'default' );
}
add_action('add_meta_boxes', 'lmp_coworkers_add_metabox');





// --- Phone --- //


// HTML output for backend meta box	
function lmp_coworkers_contact_markup($post) {

//	$noValue = get_post_meta($post->ID, 'lmp_download_sort_number', true);

	// Nonce
	echo '<input type="hidden" name="lmp_coworkers_contact_nonce" value="'. wp_create_nonce('lmp_coworkers_contact'). '" />';


	$phone		= get_post_meta($post->ID, 'lmp_coworkers_phone', true);
	$email		= get_post_meta($post->ID, 'lmp_coworkers_email', true);
	$jobtitle	= get_post_meta($post->ID, 'lmp_coworkers_jobtitle', true);



	// Phone
	echo '<label for="lmp-phone" class="left">' . __( 'Phone', 'lmp-textdomain' ) . '</label>';
	echo '<input type="text" id="lmp-phone" class="right" name="lmp_coworkers_phone" value="' . $phone . '" />';
	echo '<div class="clear"></div>';


	// Email
	echo '<label for="lmp-email" class="left">' . __( 'Email', 'lmp-textdomain' ) . '</label>';
	echo '<input type="text" id="lmp-email" class="right" name="lmp_coworkers_email" value="' . $email . '" />';
	echo '<div class="clear"></div>';


	// Jobtitle
	echo '<label for="lmp-jobtitle" class="left">' . __( 'Jobtitle', 'lmp-textdomain' ) . '</label>';
	echo '<input type="text" id="lmp-jobtitle" class="right" name="lmp_coworkers_jobtitle" value="' . $jobtitle . '" />';
	echo '<div class="clear"></div>';
}


// Gem input data
function lmp_coworkers_contact_save($post_id) {

	// Check nonce
	if (!isset($_POST['lmp_coworkers_contact_nonce']) || !wp_verify_nonce($_POST['lmp_coworkers_contact_nonce'], 'lmp_coworkers_contact')) {
		return $post_id;
	}


	// check capabilities
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	
	// exit on autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// Update Phone
	if(isset($_POST['lmp_coworkers_phone']) && ! empty($_POST['lmp_coworkers_phone']) ) {
		update_post_meta($post_id, 'lmp_coworkers_phone', $_POST['lmp_coworkers_phone']);
	} else {
		delete_post_meta($post_id, 'lmp_coworkers_phone');
	}

	// Update Email
	if(isset($_POST['lmp_coworkers_email']) && ! empty($_POST['lmp_coworkers_email']) ) {
		update_post_meta($post_id, 'lmp_coworkers_email', $_POST['lmp_coworkers_email']);
	} else {
		delete_post_meta($post_id, 'lmp_coworkers_email');
	}

	// Update Jobtitle
	if(isset($_POST['lmp_coworkers_jobtitle']) && ! empty($_POST['lmp_coworkers_jobtitle']) ) {
		update_post_meta($post_id, 'lmp_coworkers_jobtitle', $_POST['lmp_coworkers_jobtitle']);
	} else {
		delete_post_meta($post_id, 'lmp_coworkers_jobtitle');
	}

	
}
add_action('save_post', 'lmp_coworkers_contact_save');

?>