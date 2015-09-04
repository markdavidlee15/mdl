<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package MDL
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function mdl_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'mdl_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function mdl_jetpack_setup
add_action( 'after_setup_theme', 'mdl_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function mdl_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function mdl_infinite_scroll_render
