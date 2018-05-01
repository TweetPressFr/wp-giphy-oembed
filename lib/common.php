<?php
defined( 'ABSPATH' ) || die( 'No direct load !' );

/**
 * Retrieves the root plugin path.
 *
 * @return string Root path to the drop it plugin.
 *
 * @since 1.0.0
 */
function goe_dir_path() {
	return plugin_dir_path( dirname( __FILE__ ) );
}

/**
 * Retrieves a URL to a file in the drop it plugin.
 *
 * @return string       Fully qualified URL pointing to the desired file.
 *
 * @since 1.0.0
 */
function goe_url() {
	return plugin_dir_url( dirname( __FILE__ ) );
}
