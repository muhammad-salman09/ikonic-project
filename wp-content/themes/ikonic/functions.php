<?php
/**
 * ikonic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ikonic
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
function ikonic_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ikonic, use a find and replace
		* to change 'ikonic' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ikonic', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ikonic' ),
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
			'ikonic_custom_background_args',
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
}
add_action( 'after_setup_theme', 'ikonic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ikonic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ikonic_content_width', 640 );
}
add_action( 'after_setup_theme', 'ikonic_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ikonic_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ikonic' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ikonic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ikonic_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ikonic_scripts() {
	wp_enqueue_style( 'ikonic-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ikonic-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ikonic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ikonic_scripts' );

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
function mytheme_enqueue_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
function redirect_on_ip() {
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];
    // Check if the IP address starts with 77.29
    if (strpos($user_ip, '77.29.') === 0) {
        // Redirect the user to a specific URL
        wp_redirect('https://ikonicsolution.com/');
        exit();
    }
}

add_action('init', 'redirect_on_ip');
function custom_post_type_projects() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Add New', 'project', 'textdomain' ),
        'add_new_item'       => __( 'Add New Project', 'textdomain' ),
        'new_item'           => __( 'New Project', 'textdomain' ),
        'edit_item'          => __( 'Edit Project', 'textdomain' ),
        'view_item'          => __( 'View Project', 'textdomain' ),
        'all_items'          => __( 'All Projects', 'textdomain' ),
        'search_items'       => __( 'Search Projects', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent Projects:', 'textdomain' ),
        'not_found'          => __( 'No projects found.', 'textdomain' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'custom_post_type_projects' );

// Register custom taxonomy
function custom_taxonomy_project_type() {
    $labels = array(
        'name'                       => _x( 'Project Types', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Project Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Project Types', 'textdomain' ),
        'popular_items'              => __( 'Popular Project Types', 'textdomain' ),
        'all_items'                  => __( 'All Project Types', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Project Type', 'textdomain' ),
        'update_item'                => __( 'Update Project Type', 'textdomain' ),
        'add_new_item'               => __( 'Add New Project Type', 'textdomain' ),
        'new_item_name'              => __( 'New Project Type Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate project types with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove project types', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used project types', 'textdomain' ),
        'not_found'                  => __( 'No project types found.', 'textdomain' ),
        'menu_name'                  => __( 'Project Types', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-type' ),
    );

    register_taxonomy( 'project_type', 'projects', $args );
}
function ikonc_register_ajax_endpoint() {
    add_action('wp_ajax_nopriv_get_projects', 'ikonic_ajax_get_projects');
    add_action('wp_ajax_get_projects', 'ikonic_ajax_get_projects');
}

function ikonic_ajax_get_projects() {
    include 'projects-from-ajax.php';
}
add_action('init', 'ikonc_register_ajax_endpoint');
function hs_give_me_coffee() {
    // URL of the Random Coffee API
    $api_url = 'https://api.example.com/random-coffee'; 
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return 'Sorry, could not fetch the coffee data.';
    }
    $data = wp_remote_retrieve_body($response);
    $coffee_data = json_decode($data, true);
    if (!$coffee_data || !isset($coffee_data['coffee_link'])) {
        return 'Sorry, something went wrong while processing the coffee data.';
    }

    return $coffee_data['coffee_link'];
}