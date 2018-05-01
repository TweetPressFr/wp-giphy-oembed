<?php
if ( ! class_exists( 'WP_Giphy_Oembed' ) ) {

	final class WP_Giphy_Oembed {
		protected static $poster_prefix = 'https://media.giphy.com/media/';
		protected static $poster_suffix = '200_s.gif';

		public static function init() {

			/**
			 * example: https://giphy.com/gifs/miley-cyrus-follow-for-back-NhotWsBwuu7jq
			 */
			wp_embed_register_handler(
				'embed-giphy',
				apply_filters( 'giphy_oembed/regex', '~https?://(?|media\.giphy\.com/media/([^ /]+)/giphy\.gif|i\.giphy\.com/([^ /]+)\.gif|giphy\.com/gifs/(?:.*-)?([^ /]+))~i' ),
				array( __CLASS__, 'register_handler' )
			);
		}

		/**
		 * Handle handler ^^
		 *
		 * @param $matches
		 *
		 * @author Julien Maury
		 * @return string
		 */
		public static function register_handler( $matches ) {

			$url    = self::$poster_prefix . trailingslashit( $matches[1] ) . 'giphy.mp4';
			$poster = self::$poster_prefix . trailingslashit( $matches[1] ) . self::$poster_suffix;
			$w      = apply_filters( 'giphy-oembed/width', 500 );
			$h      = apply_filters( 'giphy-oembed/height', 281 );

			/**
			 * most install would discourage usage of iFrame in visual editor
			 */
			return '<video poster=" ' . esc_url( $poster ) . ' " style="margin:0;padding:0" width="' . $w . '" height="' . $h . '" autoplay loop>
            <source src="' . esc_url( $url ) . '" type="video/mp4"></source>
            Your browser does not support the mp4 video codec.
        	</video>
			<p><a href="' . esc_url( $matches[0] ) . '">via GIPHY</a></p>';
		}
	}
}
