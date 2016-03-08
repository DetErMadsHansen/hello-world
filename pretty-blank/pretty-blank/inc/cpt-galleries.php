<?php


/* ------------------
----- Functions -----
------------------ */

if( !function_exists( 'lmp_gallery_images' ) ) {

	function lmp_gallery_images() {
		add_image_size( 'gallery-thumb-medium', 230, 230, true );
		add_image_size( 'gallery-thumb-medium-wide', 400, 230, true );
		add_image_size( 'gallery-thumb-full', 770, 230, true );
		add_image_size( 'gallery-large', 1800, '9999' );
		add_image_size( 'gallery-medium', 770, '9999' );
		add_image_size( 'gallery-small', 385, '9999' );
	}
	
	add_action( 'after_setup_theme', 'lmp_gallery_images' );

}



// PhotoSwipe Markup
function lmp_gallery_markup() {
?>

	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="pswp__bg"></div>
	    <div class="pswp__scroll-wrap">
	 
	        <div class="pswp__container">
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	        </div>
	 
	        <div class="pswp__ui pswp__ui--hidden">
	            <div class="pswp__top-bar">
	                <div class="pswp__counter"></div>
	                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
	                <button class="pswp__button pswp__button--share" title="Share"></button>
	                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
	                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
	                <div class="pswp__preloader">
	                    <div class="pswp__preloader__icn">
	                      <div class="pswp__preloader__cut">
	                        <div class="pswp__preloader__donut"></div>
	                      </div>
	                    </div>
	                </div>
	            </div>
	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
	                <div class="pswp__share-tooltip"></div> 
	            </div>
	            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
	            </button>
	            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
	            </button>
	            <div class="pswp__caption">
	                <div class="pswp__caption__center"></div>
	            </div>
	        </div>
	    </div>
	</div>

<?php

}



// Script activate PhotoSwipe and Masonry
function lmp_get_gallery_script_dependencies() {
	
	ob_start();

	?>

	<script type="text/javascript" >
	//<![CDATA[
	
	jQuery('document').ready(function(){
	
	
		// --- Masonry --- //
	
		jQuery('#albumItems').masonry({
			singleMode: true,
			itemSelector: '.albumItem',
//			isFitWidth: true,
			columnWidth: '.grid-33',
			percentPosition: true
		}).imagesLoaded(function() {
			jQuery('#albumItems').masonry('reload');
		});
	
	

		// --- PhotoSwipe --- //
	
		// Tut : http://webdesign.tutsplus.com/tutorials/the-perfect-lightbox-using-photoswipe-with-jquery--cms-23587
		jQuery('#albumItems').each( function() {
	
			var $pic     = jQuery(this);
			var getItems = function() {
				var items = [];
				$pic.find('a').each(function() {
					var $href   = jQuery(this).attr('href'),
					$size   = jQuery(this).data('size').split('x'),
					$width  = $size[0],
					$height = $size[1];
					
					var item = {
						src : $href,
						w   : $width,
						h   : $height
					}
					
					items.push(item);
				});
	
				return items;
			}
	 
		    var items = getItems();
			var $pswp = jQuery('.pswp')[0];
	
			$pic.on('click', '.albumItem', function(event) {
				event.preventDefault();
				
				var $index = jQuery(this).index();
				var options = {
					index: $index,
					bgOpacity: 0.9,
					showHideOpacity: true
				}
				
				// Initialize PhotoSwipe
				var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
				gallery.init();
			});
	   
		});
	
	});	
	//]]>
	</script>

	<?php	
	
	$output = ob_get_contents();
	
	ob_end_clean();


	add_action( 'wp_footer', 'lmp_gallery_markup' );

	return $output;

}


function lmp_gallery_script_dependencies() {
	echo lmp_get_gallery_script_dependencies();
}




// --- Columns --- //



// Gallery : Register the column
function lmp_gallery_shortcode_column_register( $columns ) {
    $columns['shortcode'] = 'Shortcode';

    return $columns;
}

add_filter( 'manage_edit-lmp_galleries_columns', 'lmp_gallery_shortcode_column_register' );
add_filter('manage_edit-lmp_galleries_categories_columns', 'lmp_gallery_shortcode_column_register');


// Gallery : Display the column content
function lmp_gallery_shortcode_column_display( $column_name, $post_id ) {
    
    if ( 'shortcode' != $column_name )
        return;


	global $post;

	echo '<pre class="shortcode-table"><code>';
		echo '[lmp-gallery name=' . $post->post_name . ']';
	echo '</code></pre>';

}

add_action( 'manage_lmp_galleries_posts_custom_column', 'lmp_gallery_shortcode_column_display', 10, 2 );



function add_book_place_column_content($content,$column_name,$term_id){
	$term= get_term($term_id, 'lmp_galleries_categories');

	switch ($column_name) {
		case 'shortcode':
			$content	= '<pre class="shortcode-table"><code>';
			$content	.= '[lmp-gallery category=' . $term->slug . ']';
			$content	.= '</code></pre>';
			break;
		default:
			$content = 'Ingen shortcode';
			break;
	}

	return $content;
}
add_filter('manage_lmp_galleries_categories_custom_column', 'add_book_place_column_content',10,3);





/* -------------------
----- Shortcodes -----
------------------- */


// Galleri
function lmp_gallery_list( $atts ) {

	$atts = shortcode_atts( array(
		'name'		=> null,
		'category'	=> null
	), $atts, 'lmp-gallery' );




	$taxQuery	= array();

	if( $atts['category'] !== null ) {
		$taxQuery	= array(
			array(
				'taxonomy' => 'lmp_galleries_categories',
				'field'    => 'slug',
				'terms'    => $atts['category'],
			),
		);
	}
	


	$args = array(
		'post_type' => 'lmp_galleries',
		'tax_query' => $taxQuery,
		'name'		=> $atts['name']
	);
	
	$query = new WP_Query( $args );


	ob_start();

	if ($query->have_posts()) :

		lmp_gallery_script_dependencies();

		while ($query->have_posts()) : $query->the_post();

			global $post;

			get_template_part( 'templates/loop', 'single-galleries' );

		endwhile;

	endif;


	$output	= ob_get_contents();

	ob_end_clean();


	return $output;
}

add_shortcode( 'lmp-gallery', 'lmp_gallery_list' );






/* --------------------
----- Stylesheets -----
-------------------- */


if ( !function_exists('lmp_gallery_frontend_styles')) :

	function lmp_gallery_frontend_styles() {

		// PhotoSwipe CSS
		wp_register_style(
			'lmp-photoswipe',
			get_template_directory_uri() . '/addons/photoswipe/photoswipe.css',
			array(),
			false,
			'all'
		);
		wp_enqueue_style( 'lmp-photoswipe' );



		// PhotoSwipe Skin CSS
		wp_register_style(
			'lmp-photoswipe-skin',
			get_template_directory_uri() . '/addons/photoswipe/default-skin/default-skin.css',
			array( 'lmp-photoswipe' ),
			false,
			'all'
		);
		wp_enqueue_style( 'lmp-photoswipe-skin' );


	}

	add_action( 'wp_enqueue_scripts', 'lmp_gallery_frontend_styles' );

endif; // function exists






/* -------------------
----- Javascript -----
------------------- */


// Register Javascript frontend
function lmp_gallery_frontend_scripts(){

	wp_register_script( 
		'lmp-photoswipe',
		get_template_directory_uri() . '/addons/photoswipe/photoswipe.min.js',
		array(),
		false, 
		true
	);
	wp_enqueue_script('lmp-photoswipe');


	wp_register_script( 
		'lmp-photoswipe-ui',
		get_template_directory_uri() . '/addons/photoswipe/photoswipe-ui-default.min.js',
		array(),
		false, 
		true
	);
	wp_enqueue_script('lmp-photoswipe-ui');
	

	wp_enqueue_script('jquery-masonry');

	wp_enqueue_script(
		'ttp-imagesloaded',
		get_template_directory_uri() . '/addons/imagesloaded.pkgd.min.js',
		array( 'jquery-masonry' ),
		'3.1.8',
		false
	);


}

add_action('wp_enqueue_scripts', 'lmp_gallery_frontend_scripts');



// Register Javascript admin
function lmp_gallery_admin_scripts(){

	wp_register_script( 
		'lmp-gallery-admin',
		get_template_directory_uri() . '/js/galleries-admin.js',
		array('jquery'),
		'1.0.0',
		true
	);
	wp_enqueue_script('lmp-gallery-admin');
	
}

add_action('admin_enqueue_scripts', 'lmp_gallery_admin_scripts');







/* ------------------------------------------
----- Templates Path : Custom Post Type ----- 
------------------------------------------ */


// Archive templates
function lmp_galleries_template_archive( $archive_template ) {
	global $post;

	if ( is_post_type_archive( 'lmp_galleries' ) || get_post_type() == 'lmp_galleries' ) {
		$archive_template = /*get_template_part( 'templates/archive', 'galleries' );*/ get_template_directory() . '/templates/archive-galleries.php';
	}

	return $archive_template;
}

add_filter( 'archive_template', 'lmp_galleries_template_archive' );
add_filter( 'category_template', 'lmp_galleries_template_archive' );




// Single templates
function lmp_galleries_template_single( $single_template ) {
	global $post;

	if ( is_singular( 'lmp_galleries' ) ) {
		$single_template = /* get_template_part( 'templates/single', 'galleries' ); */ get_template_directory() . '/templates/single-galleries.php';
	}

	return $single_template;
}

add_filter( 'single_template', 'lmp_galleries_template_single' );







/* ----------------------
----- Gallery : CPT -----
---------------------- */



// --- Setup Custom Post Type --- //

function lmp_setup_galleries() {
	$labels = array(
		'name'					=> _x( 'Galleries', 'post type general name', 'lmp-textdomain' ),
		'singular_name'			=> _x( 'Gallery', 'post type singular name', 'lmp-textdomain' ),
		'menu_name'				=> _x( 'Galleries', 'admin menu', 'lmp-textdomain' ),
		'name_admin_bar'		=> _x( 'Gallery', 'add new on admin bar', 'lmp-textdomain' ),
		'add_new'				=> __( 'Add Gallery', 'lmp-textdomain' ),
		'add_new_item'			=> __( 'Add New Gallery', 'lmp-textdomain' ),
		'new_item'				=> __( 'New Gallery', 'lmp-textdomain' ),
		'edit_item'				=> __( 'Edit Gallery', 'lmp-textdomain' ),
		'view_item'				=> __( 'View Gallery', 'lmp-textdomain' ),
		'all_items'				=> __( 'All Galleries', 'lmp-textdomain' ),
		'search_items'			=> __( 'Search Galleries', 'lmp-textdomain' ),
		'parent_item_colon'		=> null,//__( 'Parent Coworker:', 'lmp-textdomain' ),
		'not_found'				=> __( 'No galleries listed', 'lmp-textdomain' ),
		'not_found_in_trash'	=> __( 'No items found in Trash.', 'lmp-textdomain' )
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'query_var'				=> true,
		'rewrite'				=> array( 'slug' => _x('fotos', 'Gallery URL', 'lmp-textdomain') ),
		'capability_type'		=> 'post',
		'has_archive'			=> true,
		'hierarchical'			=> false,
		'menu_position'			=> null,
		'supports'				=> array( 'title', 'editor', 'thumbnail' ),
		'exclude_from_search'	=> false
		, 'menu_icon'			=> 'dashicons-format-gallery'
	);

	register_post_type( 'lmp_galleries', $args );
}

add_action( 'init', 'lmp_setup_galleries' );







/* -------------------
----- Taxonomies -----
------------------- */


// Register taxonomies
function lmp_galleries_taxonomies() {


	// --- Categories --- //

	$categoryLabels = array(
		'name'              => __('Categories', 'lmp-textdomain'),
		'singular_name'     => __('Category', 'lmp-textdomain'),
		'search_items'      => __('Search Categories', 'lmp-textdomain'),
		'all_items'         => __('All Categories', 'lmp-textdomain'),
		'parent_item'       => __('Parent Category', 'lmp-textdomain'),
		'parent_item_colon' => __('Parent Category:', 'lmp-textdomain'),
		'edit_item'         => __('Edit Category', 'lmp-textdomain'),
		'update_item'       => __('Update Category', 'lmp-textdomain'),
		'add_new_item'      => __('Add New Category', 'lmp-textdomain'),
		'new_item_name'     => __('New Category Name', 'lmp-textdomain'),
		'menu_name'         => __('Edit Categories', 'lmp-textdomain'),
	);

	$categoryArgs = array(
		'labels'				=> $categoryLabels,
		'hierarchical'			=> true,
		'query_var'				=> true,
		'sort'					=> true,
		'show_admin_column'		=> true,
		'show_ui'				=> true,
		'update_count_callback'	=> '_update_generic_term_count',
		'query_var'				=> true,
		'rewrite'				=> array(
			'slug' => 'fotokategori'
		)
	);

	register_taxonomy( 'lmp_galleries_categories', array('lmp_galleries'), $categoryArgs );



} // END function

add_action('init', 'lmp_galleries_taxonomies');







/* ------------------
----- Metaboxes -----
------------------ */


// Register meta boxes to custom post type
function lmp_gallery_metaboxes() {

	// Gallery to gallery CPT
	add_meta_box('lmp_gallery', __('Gallery', 'lmp-textdomain'), 'lmp_galley_markup', 'lmp_galleries', 'advanced', 'default' );

	// Shortcode name
	add_meta_box( 'lmp_shortcodename', __('Shortcode', 'lmp-textdomain'), 'lmp_shortcode_name', 'lmp_galleries', 'advanced', 'default' );

}

add_action('add_meta_boxes', 'lmp_gallery_metaboxes');





// --- Image Gallery --- //

// HTML output for backend meta box	
function lmp_galley_markup($post) {

	// Nonce
	echo '<input type="hidden" name="lmp_gallery_nonce" value="'. wp_create_nonce('lmp_gallery'). '" />';

	// Output images as thumbnails
	$images = get_post_meta($post->ID, 'lmp_gallery_ids', true);

	echo '<div id="lmp-slideshow-thumbs">';
	if( !empty( $images ) ){
		$imageArray = explode(',', $images);
		foreach($imageArray as $imageID){
			echo wp_get_attachment_image( $imageID, 'thumbnail' );
		}
		
	}
	echo '</div>';

	echo '<div class="clear seperator"></div>';
//	echo '<br />';
	echo '<input type="hidden" name="lmp_gallery_ids" id="lmp-imageids" value="' . get_post_meta($post->ID, 'lmp_gallery_ids', true) . '" />';
	echo '<input type= "button" class="button" name="image_button" id="image_button" value="' . __('Add Images', 'lmp-textdomain' ) . '" />';
	if( !empty( $images ) ){
		echo '<div class="clear seperator-low"></div>';
		echo '<a href="#" class="clear-images" >' . __('Remove all photos', 'lmp-textdomain') . '</a>';
	}
}



// Gem input data
function lmp_gallery_save($post_id) {

	// Check nonce
	if (!isset($_POST['lmp_gallery_nonce']) || !wp_verify_nonce($_POST['lmp_gallery_nonce'], 'lmp_gallery')) {
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
	

	// Update Gallery Images
	if(isset($_POST['lmp_gallery_ids']) && ! empty($_POST['lmp_gallery_ids']) ) {
		update_post_meta($post_id, 'lmp_gallery_ids', $_POST['lmp_gallery_ids']);
	} else {
		delete_post_meta($post_id, 'lmp_gallery_ids');
	}
	
} // END : Save

add_action('save_post', 'lmp_gallery_save');




// AJAX get change images
function lmp_ajax_image_change() {

	$images = $_POST['imageids'];

	// Output images as thumbnails
	//$images = get_post_meta($postID, 'fstscharts_gallery_urls', true);

	if( !empty( $images ) ){
		$imageArray = explode(',', $images);
		foreach($imageArray as $imageID){
			echo wp_get_attachment_image( $imageID, 'thumbnail' );
		}
		
	}

	exit;
}

add_action( 'wp_ajax_image_change', 'lmp_ajax_image_change' );




// Shortcode name
function lmp_shortcode_name($post){

	echo '<p>';
	_e('Use this shortcode to show the gallery in a post or on a page.', 'lmp-textdomain');
	echo '</p>';
	
	echo '<pre><code>';
	echo '[lmp-gallery name=' . $post->post_name . ']';
	echo '</code></pre>';
}


?>