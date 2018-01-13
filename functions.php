<?php
//update_option('siteurl','http://localhost/agentzoo');
//update_option('home','http://localhost/agentzoo');

/**
 * Agent Zoo Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agent_Zoo_Theme
 */

if ( ! function_exists( 'agentzoo_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agentzoo_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agent Zoo Theme, use a find and replace
	 * to change 'agentzoo_theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'agentzoo_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'agentzoo_theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'agentzoo_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'agentzoo_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function agentzoo_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agentzoo_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'agentzoo_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agentzoo_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'agentzoo_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'agentzoo_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'agentzoo_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agentzoo_theme_scripts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Open+Sans:600,700' );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Raleway"' );
	wp_enqueue_style( 'agentzoo_theme-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'agentzoo_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script('agentzoo_theme-script', get_template_directory_uri() . '/js/scripts.min.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agentzoo_theme_scripts' );

/**
 * Image size
 */

add_image_size('portrait_archive',500,500, array('center','center'));

add_action( 'pre_get_posts', 'custom_query_vars' );
function custom_query_vars( $query ) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( is_post_type_archive('agentzoo_directors') ){
    	$query->set( 'posts_per_page', -1 );
      	$query->set( 'orderby', 'title' );
      	$query->set( 'order', 'ASC' );
    } 
  }
  return $query;
}

//Options side
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

//For Vimeo oEmbed
add_action('after_setup_theme', 'curl_get');
function curl_get($url) {
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	    $return = curl_exec($curl);
	    curl_close($curl);
	    return $return;
}