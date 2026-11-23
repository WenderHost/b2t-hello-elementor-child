<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

  add_theme_support( 'editor-styles' );
  add_editor_style( 'editor-styles.css' );	

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

/**
 * Print only one meta description per page.
 *
 * Hello Elementor prints the post excerpt as a meta description on every
 * singular page that has one, alongside Yoast's. On a course (product) with
 * its own Yoast description, that makes two tags, often with different
 * wording. Skip the theme's tag whenever Yoast has a description for the
 * page, and keep it where Yoast has none, since there the excerpt is the
 * page's only description.
 *
 * @param bool $enabled Whether Hello Elementor prints its description tag.
 * @return bool
 */
function b2t_skip_theme_description_when_yoast_has_one( $enabled ) {
	if ( ! $enabled || ! function_exists( 'YoastSEO' ) ) {
		return $enabled;
	}

	$description = YoastSEO()->meta->for_current_page()->description;

	return '' === trim( (string) $description );
}
add_filter( 'hello_elementor_description_meta_tag', 'b2t_skip_theme_description_when_yoast_has_one' );
