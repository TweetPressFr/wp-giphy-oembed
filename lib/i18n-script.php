<?php
defined( 'ABSPATH' ) || die( 'No direct load !' );

/**
 * Returns Jed-formatted localization data.
 *
 * @since 1.0.0
 *
 * @param  string $domain Translation domain.
 *
 * @return array
 */
function goe_get_jed_locale_data( $domain ) {
	$translations = get_translations_for_domain( $domain );

	$locale = array(
		'' => array(
			'domain' => $domain,
			'lang'   => is_admin() ? get_user_locale() : get_locale(),
		),
	);

	if ( ! empty( $translations->headers['Plural-Forms'] ) ) {
		$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
	}

	foreach ( $translations->entries as $msgid => $entry ) {
		$locale[ $msgid ] = $entry->translations;
	}

	return $locale;
}

/**
 * Registers the i18n script
 *
 * @since 1.0.0
 */
function goe_i18n_register() {
	$locale_data = goe_get_jed_locale_data( 'goe' );
	$content     = 'wp.i18n.setLocaleData( ' . wp_json_encode( $locale_data ) . ', "goe" );';

	wp_register_script(
		'goe-i18n',
		goe_url() . 'scripts/i18n/build/index.js',
		array( 'wp-i18n' ),
		filemtime( goe_dir_path() . 'scripts/i18n/build/index.js' )
	);
	wp_add_inline_script( 'goe-i18n', $content );
}

add_action( 'init', 'goe_i18n_register' );


/**
 * Load plugin text domain for translations.
 *
 * @since 1.0.0
 */
function goe_load_plugin_textdomain() {
	load_plugin_textdomain(
		'goe',
		false,
		plugin_basename( goe_dir_path() ) . '/languages/'
	);
}

add_action( 'plugins_loaded', 'goe_load_plugin_textdomain' );
