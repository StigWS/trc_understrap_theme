<?php

/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ($understrap_includes as $file) {
	require_once get_theme_file_path($understrap_inc_dir . $file);
}

function register_my_menus()
{
	register_nav_menus(
		array(
			'footer-menu' => __('Footer Menu')
		)
	);
}
add_action('init', 'register_my_menus');

if (is_admin()) {
	require_once get_template_directory() . '/framework/tgm-config.php';
}


remove_filter('wp_trim_excerpt', 'understrap_all_excerpts_get_more_link');
add_filter('excerpt_more', 'replace_understrap_all_excerpts_get_more_link');

if (!function_exists('replace_understrap_all_excerpts_get_more_link')) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function replace_understrap_all_excerpts_get_more_link($post_excerpt)
	{
		if (!is_admin()) {
			$post_excerpt = $post_excerpt . ' <a class="understrap-read-more-link" href="' . esc_url(get_permalink(get_the_ID())) . '">(' . __(
				'Read More...',
				'understrap'
			) . ')</a>';
		}
		return $post_excerpt;
	}
}
