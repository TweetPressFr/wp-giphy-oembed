<?php
defined( 'ABSPATH' ) || die( 'No direct load !' );

/**
 * Registers the script
 *
 * @since 1.0.0
 */
function goe_scripts_register() {
	wp_register_script(
		'goe-main',
		goe_url() . 'scripts/main/build/index.js',
		array(
			'wp-plugins',
			'wp-element',
			'wp-edit-post',
			'wp-i18n',
			'wp-api-request',
			'wp-data',
			'wp-components',
			'wp-blocks',
			'wp-editor',
			'goe-i18n',
		),
		filemtime( goe_dir_path() . 'scripts/main/build/index.js' ),
		true
	);
}

add_action( 'init', 'goe_scripts_register' );

function goe_scripts_enqueue() {
	wp_enqueue_script( 'goe-main' );
}

add_action( 'enqueue_block_editor_assets', 'goe_scripts_enqueue' );
