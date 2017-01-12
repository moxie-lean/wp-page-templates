<?php namespace Lean;

/**
 * Class to provide page template functions.
 */
class PageTemplates {
	/**
	 * An array for storage of the new templates
	 *
	 * @var array
	 */
	protected static $templates = [];
	/**
	 * Register a page template
	 *
	 * @param string $slug The slug
	 * @param string $name The name
	 */
	public static function register( $slug, $name ) {
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			self::old_register( $slug, $name );
		} else {
			self::$templates[ $slug ] = $name;
			add_filter( 'theme_page_templates', [ __CLASS__, 'register_template' ] );
		}
	}

	/**
	 * Filter to add custom page templates
	 *
	 * @param array $templates An array with the current templates.
	 */
	protected static function register_template( $templates ) {
		return array_merge( $templates, self::$templates );
	}

	protected static function old_register( $slug, $name ) {
		// Create the key used for the themes cache.
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. If it doesn't exist, or it's empty prepare an array.
		$templates = wp_cache_get( $cache_key, 'themes' );
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// Since we've updated the cache, we need to delete the old cache.
		wp_cache_delete( $cache_key , 'themes' );

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, [
			$slug  => $name,
		]);

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates.
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
	}
}
