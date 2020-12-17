<?php

namespace ShippingAppointments\Traits;

use ShippingAppointments\Controller\Admin\AdminController;
use ShippingAppointments\Controller\Front\PublicController;
use ShippingAppointments\Includes\PageTemplates;
use ShippingAppointments\Includes\Shortcodes;
use ShippingAppointments\Includes\Widgets;
use ShippingAppointments\Includes\Settings;
use ShippingAppointments\Includes\AdminMenuPages;
use ShippingAppointments\Includes\CronJobs;

Trait Hooks {


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function defineAdminHooks() {

		$adminController = new AdminController( $this->getPluginName(), $this->getPluginDirUrl() );
		$this->loader->addAction( 'admin_enqueue_scripts', $adminController, 'enqueueStyles' );
		$this->loader->addAction( 'admin_enqueue_scripts', $adminController, 'enqueueScripts' );

		$adminPages = new AdminMenuPages( $this->getPluginDirPath() );
		$this->loader->addAction( 'admin_menu', $adminPages, 'registerAdminPages' );

        $settings = new Settings( $this->getPluginName() );
        $this->loader->addAction( 'admin_init', $settings, 'init' );
        $this->loader->addAction( 'admin_menu', $settings, 'addSettingsMenu' );
        $this->loader->addFilter( 'plugin_action_links' , $settings, 'addSettingsLink', 10, 4 );

        $cronJobs = new CronJobs( $this->loader );
        $this->loader->addAction( 'init', $cronJobs, 'registerScheduledEvents');
        $cronJobs->addCallbackHooks();


	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function definePublicHooks() {

		$publicController = new PublicController( $this->getPluginName(), $this->getPluginDirUrl() );
		$this->loader->addAction( 'wp_enqueue_scripts', $publicController, 'enqueueStyles' );
		$this->loader->addAction( 'wp_enqueue_scripts', $publicController, 'enqueueScripts' );
		$this->loader->addFilter( 'body_class', $publicController, 'pluginNameBodyClass' );

		$pageTemplates = new PageTemplates( $this->getPluginDirPath() );
		$this->loader->addFilter( $pageTemplates->getPageTemplatesFilter(), $pageTemplates, 'addNewTemplate' );
		$this->loader->addFilter( 'wp_insert_post_data', $pageTemplates, 'registerTemplates' );
		$this->loader->addFilter( 'template_include', $pageTemplates, 'includeTemplates' );

		$shortcodes = new Shortcodes( $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $shortcodes, 'registerShortcodes' );

		$widgets = new Widgets( $this->getPluginDirPath() );
		$this->loader->addAction( 'widgets_init', $widgets, 'registerWidgets' );

	}

}
