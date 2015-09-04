<?php
/**
 * MDL functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package MDL
 */

if ( ! function_exists( 'mdl_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mdl_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MDL, use a find and replace
	 * to change 'mdl' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mdl', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'mdl' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mdl_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mdl_setup
add_action( 'after_setup_theme', 'mdl_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mdl_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mdl_content_width', 640 );
}
add_action( 'after_setup_theme', 'mdl_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mdl_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mdl' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mdl_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mdl_scripts() {
	wp_enqueue_style( 'mdl-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'mdl-g-font', '//fonts.googleapis.com/css?family=Open+Sans:400,300,700|Montserrat:700|Droid+Serif' );
	
	//wp_enqueue_style( 'mdl-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' );

	wp_enqueue_style( 'mdl-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	wp_enqueue_script( 'mdl-jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '0915', true );
	
	wp_enqueue_script( 'mdl-js', get_template_directory_uri() . '/js/custom.js', array(), '0915', true );

	wp_enqueue_script( 'mdl-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mdl-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mdl_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//CUSTOMIZING SEARCH

function my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform col-10" action="' . home_url( '/' ) . '" >
	<input type="text" value="' . get_search_query() . '" name="s" id="s" style="opacity: 0"/>
	<button type="submit" class="btn-search">
		<i class="fa fa-search"></i>
	</button>
	</form>';
	return $form;
}

add_filter( 'get_search_form', 'my_search_form' );
