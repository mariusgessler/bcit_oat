<?php
/**
 * bcit-oat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bcit-oat
 */

if ( ! function_exists( 'bcit_oat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bcit_oat_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bcit-oat, use a find and replace
		 * to change 'bcit-oat' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bcit-oat', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'bcit-oat' ),
			'footer-students' => esc_html__( 'Footer Menu Students', 'bcit-oat' ),
			'footer-program' => esc_html__( 'Footer Menu Program', 'bcit-oat' )
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
		add_theme_support( 'custom-background', apply_filters( 'bcit_oat_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		if( function_exists('acf_add_options_page')){
			acf_add_options_page(array(
				'page_title'	=>	'Contact Information Settings',
				'menu_title'	=>	'Contact Information',
				'menu_slug'		=>	'contact-information-settings',
				'capability'	=>	'edit_posts',
				'redirect'		=> 	false,
			));
		}
	}
endif;
add_action( 'after_setup_theme', 'bcit_oat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bcit_oat_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bcit_oat_content_width', 640 );
}
add_action( 'after_setup_theme', 'bcit_oat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bcit_oat_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bcit-oat' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bcit-oat' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bcit_oat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bcit_oat_scripts() {
	wp_enqueue_style( 'bcit-oat-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bcit-oat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bcit-oat-schedule', get_template_directory_uri() . '/js/schedule.js', array(), '20191001', true );

	wp_enqueue_script( 'bcit-oat-swiper', get_template_directory_uri() . '/js/swiper.js', array(), '20190930', true );

	wp_enqueue_script( 'bcit-oat-swiper-settings', get_template_directory_uri() . '/js/swiper-settings.js', array(), '20190930', true );
		
	wp_enqueue_script( 'bcit-oat-schedule', get_template_directory_uri() . '/js/schedule.js', array(), '20191005', true );

	wp_enqueue_script('bcit-oat-slideToggle', get_template_directory_uri() . '/js/slideToggle.js', array(), '20191005', true);

	wp_enqueue_script( 'bcit-oat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bcit_oat_scripts' );


/**
 * ScrollReveal Scripts
*/

function oat_scroll_reveal() {
	wp_enqueue_script ('scrollreveal', get_stylesheet_directory_uri() . '/js/scrollreveal.js', array( 'jquery' ),'20191015',true );
}
add_action( 'wp_enqueue_scripts', 'oat_scroll_reveal' );


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
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/register-cpt.php';

/**
 * Post Order By Menu Order
 */
require get_template_directory() . '/inc/post-menu-order.php';

/**
 * Customize Dashboard Widget
 */
require get_template_directory() . '/inc/dashboard-widget.php';

/**
 * Customize Admin menu
 */
require get_template_directory() . '/inc/custom-admin-menu.php';