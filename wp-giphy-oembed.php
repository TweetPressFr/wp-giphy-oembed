<?php
/*
 * Plugin name: WP Giphy oEmbed
 * Description: simple oembed with amazing giphy.com gifs
 * Version: 0.5
 * Author: Julien Maury
 * Author URI: https://dev73.tweetpress.fr
 */
/*
Copyright (C) 2016-2018, Julien Maury - contact@tweetpress.fr
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
defined( 'ABSPATH' ) || die( 'No direct load !' );

require_once plugin_dir_path(__FILE__ ) . 'lib/common.php';
require_once goe_dir_path() . 'lib/i18n-script.php';
require_once goe_dir_path() . 'lib/scripts.php';
require_once goe_dir_path() . 'lib/content.php';

add_action( 'plugins_loaded', function() {
	if ( ! function_exists( 'gutenberg_init' ) ) {
		/**
		 * Run the oEmbed thing
		 * if not gutenberg
		 */
		WP_Giphy_Oembed::init();
	}
} );

