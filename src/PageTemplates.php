<?php namespace Leean;

/**
 * Class to provide page template functions.
 */
class PageTemplates
{
	/**
	 * Register a page template
	 *
	 * @param string $slug The slug
	 * @param string $name The name
	 */
	public static function register( $slug, $name ) {
		// Create the key used for the themes cache.
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. If it doesn't exist, or it's empty prepare an array
		$templates = wp_cache_get( $cache_key, 'themes' );
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// Since we've updated the cache, we need to delete the old cache
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, [
				$slug  => $name,
			]
		);

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
	}
}
