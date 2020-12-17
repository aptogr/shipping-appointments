<?php


namespace ShippingAppointments\Includes;

use ShippingAppointments\Interfaces\PagesTemplatesInterface;

class PageTemplates implements PagesTemplatesInterface{

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;


	/**
	 * The templates files path
	 */
	protected $templates_path;


	/**
	 * The add page template filter
	 */
	protected $pageTemplatesFilter;



	/**
	 * Initializes the plugin by setting filters and administration functions.
	 *
	 * @param $pluginDirPath
	 */
	public function __construct( $pluginDirPath ) {

		$this->templates_path           = $pluginDirPath . self::TEMPLATES_FOLDER;
		$this->templates                = self::PAGE_TEMPLATES;
		$this->pageTemplatesFilter      = ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ? 'page_attributes_dropdown_pages_args' : 'theme_page_templates' );

	}



	/**
	 * Returns the filter hook name that will be used
	 * to add the new page templates to the site.
	 *
	 * The hook name is depended on the WordPress Version
	 *
	 * @return string
	 */
	public function getPageTemplatesFilter(){

		return $this->pageTemplatesFilter;
	}


	/**
	 * Adds our template to the page dropdown for v4.7+
	 * @param $posts_templates array
	 * @return array
	 */
	public function addNewTemplate( $posts_templates ) {

		return array_merge( $posts_templates, $this->templates );

	}


	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doesn't really exist.
	 * @param $atts array
	 * @return mixed
	 */
	public function registerTemplates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}


	/**
	 * Checks if the template is assigned to the page
	 *
	 * @param $template string
	 * @return string
	 */
	public function includeTemplates( $template ) {

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
			return $template;
		}

		$file = $this->templates_path. get_post_meta( $post->ID, '_wp_page_template', true  );

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

}
