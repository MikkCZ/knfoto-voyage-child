<?php
/**
 * KN-foto Voyage Theme functions and definitions
 *
 * @package voyage
 * @subpackage voyage
 * @since Voyage 1.3.9.1
 */

function voyage_setup() {

	/* Set the content width based on the theme's design and stylesheet. */
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 1000;
	// Post Format support
//	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'quote', 'image' ) );
	//add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'audio', 'chat' ) );
	// This theme uses post thumbnails i.e. Feathered Image
//	add_theme_support( 'post-thumbnails' );
	// Add default posts and comments RSS feed links to head
//	add_theme_support( 'automatic-feed-links' );
	// Voyage supports woocommerce
//	add_theme_support( 'woocommerce' );

	// Make theme available for translation
	load_theme_textdomain( 'voyage', get_stylesheet_directory() . '/languages' );

	// style the visual editor.
	add_editor_style();
	// This theme uses wp_nav_menu() in thee locations.
	register_nav_menus( array(
		/*'top-menu' => __( 'Top Menu', 'voyage' ),*/
		'section-menu' => __( 'Section Menu', 'voyage' ),
		'subsection-menu' => __( 'Subsection Menu', 'voyage' ),
		'footer-menu' => __( 'Footer Menu', 'voyage' ),
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', array(
		'default-color' => '', //Default background color
	) );
	global $voyage_options;
	
	$voyage_options = voyage_get_options();
	// The custom header business starts here.
	$custom_header_support = array(
		'default-image'		=> get_stylesheet_directory_uri() . '/images/kn-foto-logo.png',
		'flex-width'        => true,
		'flex-height'		=> true,
	    'header-text'		=> true,
		'default-text-color' => '000000',		
		// The height and width of our custom header.
		'width' 			=> apply_filters( 'voyage_header_image_width', 140 ),
		'height' 			=> apply_filters( 'voyage_header_image_height', 36	 ),
		// Callback for styling the header.
		'wp-head-callback' => 'voyage_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'voyage_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'voyage_admin_header_image',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );
	
/*	Will not support Deprecated function 			
	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
		define( 'HEADER_IMAGE', $custom_header_support['default-image'] );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( '', $custom_header_support['admin-head-callback'] );
		add_custom_background();
	} */

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'header' => array(
			'url' => '%s/images/kn-foto-logo.png',
			'thumbnail_url' => '%s/images/kn-foto-logo.png',
			/* translators: header image description */
			'description' => __( 'Logo', 'voyage' )
		),
	) );
	
	remove_filter('term_description','wpautop');
}

function add_favicon() {
	printf( '<link rel="shortcut icon" href="%s/images/favicon.ico'.'" />', get_stylesheet_directory_uri() );
}
add_action( 'wp_head', 'add_favicon' );

/* JPEG compression */
function jpeg_quality_callback( $arg ) {
	return (int)75;
}
add_filter( 'jpeg_quality', 'jpeg_quality_callback' );

/* Remove unnecessary header information */
function remove_header_info() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'remove_header_info' );

/* Remove wp version meta tag and from rss feed */
add_filter('the_generator', '__return_false');

/* Remove wp version param from any enqueued scripts */
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 10, 2 );
add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 10, 2 );

/* Disable ping back scanner and complete xmlrpc class. */
add_filter( 'wp_xmlrpc_server_class', '__return_false' );
add_filter( 'xmlrpc_enabled', '__return_false' );

/* Remove xpingback header */
function remove_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'remove_x_pingback' );

function disable_images_contextmenu() {
	wp_enqueue_script(
		'disable_images_contextmenu',
		get_stylesheet_directory_uri() . '/js/disable-images-contextmenu.js',
		array( 'jquery' ),
		false,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'disable_images_contextmenu' );

/*
function revert_nextgen_sort() {
	wp_enqueue_script(
		'revert_nextgen_sort',
		get_stylesheet_directory_uri() . '/js/revert-nextgen-sort.js',
		array( 'jquery' ),
		false,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'revert_nextgen_sort' );
*/

