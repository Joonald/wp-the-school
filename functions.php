<?php
/**
 * wp-the-school functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-the-school
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_the_school_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wp-the-school, use a find and replace
		* to change 'wp-the-school' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wp-the-school', get_template_directory() . '/languages' );

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
	// custom image crip sizes
	add_image_size( 'tall-blog', 200, 300, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wp-the-school' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wp_the_school_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// adding default wp block styles
	add_theme_support( 'wp-block-styles' );
	
	// adding support for wide allignment
	add_theme_support( 'align-wide' );

	// adding support for full allignment
	add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', 'wp_the_school_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_the_school_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_the_school_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_the_school_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_the_school_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp-the-school' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-the-school' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_the_school_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_the_school_scripts() {
	wp_enqueue_style( 'wp-the-school-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wp-the-school-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wp-the-school-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_the_school_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * changing excerpt length to 35
 */
function wp_the_school_excerpt ( $length ) {
	if ( is_post_type_archive( 'wps-student' ) ) {
		return 25;
	} else {
		return 35;
	}
} add_filter('excerpt_length', 'wp_the_school_excerpt', 999);

/**
 * adding link to end of excerpt
 */
function wp_the_school_excerpt_more( $more ) {
	if ( is_post_type_archive( 'wps-student' ) ) {
		$more = '<br><a href="' . esc_url( get_permalink() ) .'">' . __( 'Read More about the Student', 'wp-the-school' ) . '</a>';
		return $more;
	} else { 
		$more = '... <a href="' . esc_url( get_permalink() ) . '">' . __( 'Continue Reading', 'wps-the-school' ) . '</a>';
    	return $more;
	}
} add_filter( 'excerpt_more', 'wp_the_school_excerpt_more' );

/**
 * Custom Post Types and Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

add_filter( 'get_the_archive_title_prefix', '__return_false' );