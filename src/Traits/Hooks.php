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
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Service\User\UserCapabilities;
use ShippingAppointments\Service\User\UserRoles;

Trait Hooks {


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function defineAdminHooks() {


		/**
		 * AdminController
		 *
		 * Functions Hooked:
		 * @see AdminMenuPages::enqueueStyles()
		 * @see AdminMenuPages::enqueueScripts()
		 */
		$adminController = new AdminController( $this->getPluginName(), $this->getPluginDirUrl() );
		$this->loader->addAction( 'admin_enqueue_scripts', $adminController, 'enqueueStyles' );
		$this->loader->addAction( 'admin_enqueue_scripts', $adminController, 'enqueueScripts' );



		/**
		 * AdminMenuPages
		 *
		 * Functions Hooked:
		 * @see AdminMenuPages::registerAdminPages()
		 */
		$adminPages = new AdminMenuPages( $this->getPluginDirPath() );
		$this->loader->addAction( 'admin_menu', $adminPages, 'registerAdminPages' );



		/**
		 * Settings
		 *
		 * Functions Hooked:
		 * @see Settings::init()
		 * @see Settings::addSettingsMenu()
		 * @see Settings::addSettingsLink()
		 */
        $settings = new Settings( $this->getPluginName() );
        $this->loader->addAction( 'admin_init', $settings, 'init' );
        $this->loader->addAction( 'admin_menu', $settings, 'addSettingsMenu' );
        $this->loader->addFilter( 'plugin_action_links' , $settings, 'addSettingsLink', 10, 4 );



        /**
		 * Cron Jobs
		 *
		 * Functions Hooked:
		 * @see CronJobs::registerScheduledEvents()
		 */
        $cronJobs = new CronJobs( $this->loader );
        $this->loader->addAction( 'init', $cronJobs, 'registerScheduledEvents');
        $cronJobs->addCallbackHooks();


        /**
		 * User Roles
		 *
		 * Functions Hooked:
		 * @see UserRoles::registerUserRoles()
		 */
        $userRoles = new UserRoles();
        $this->loader->addAction( 'init', $userRoles, 'registerUserRoles');



        /**
		 * User Capabilities
		 *
		 * Functions Hooked:
		 * @see UserCapabilities::registerUserCapabilities()
		 */
        $userCapabilities = new UserCapabilities();
        $this->loader->addAction( 'init', $userCapabilities, 'registerUserCapabilities');


	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function definePublicHooks() {


		/**
		 * PublicController
		 *
		 * Functions Hooked:
		 * @see PublicController::enqueueStyles()
		 * @see PublicController::enqueueScripts()
		 * @see PublicController::pluginNameBodyClass()
		 */
		$publicController = new PublicController( $this->getPluginName(), $this->getPluginDirUrl() );
		$this->loader->addAction( 'wp_enqueue_scripts', $publicController, 'enqueueStyles' );
		$this->loader->addAction( 'wp_enqueue_scripts', $publicController, 'enqueueScripts' );
		$this->loader->addFilter( 'body_class', $publicController, 'pluginNameBodyClass' );



		/**
		 * PageTemplates
		 *
		 * Functions Hooked:
		 * @see PageTemplates::addNewTemplate()
		 * @see PageTemplates::registerTemplates()
		 * @see PageTemplates::includeTemplates()
		 */
		$pageTemplates = new PageTemplates( $this->getPluginDirPath() );
		$this->loader->addFilter( $pageTemplates->getPageTemplatesFilter(), $pageTemplates, 'addNewTemplate' );
		$this->loader->addFilter( 'wp_insert_post_data', $pageTemplates, 'registerTemplates' );
		$this->loader->addFilter( 'template_include', $pageTemplates, 'includeTemplates' );


		/**
		 * Shortcodes
		 *
		 * Functions Hooked:
		 * @see Shortcodes::registerShortcodes()
		 */
		$shortcodes = new Shortcodes( $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $shortcodes, 'registerShortcodes' );


		/**
		 * Widgets
		 *
		 * Functions Hooked:
		 * @see Widgets::registerWidgets()
		 */
		$widgets = new Widgets( $this->getPluginDirPath() );
		$this->loader->addAction( 'widgets_init', $widgets, 'registerWidgets' );



		/**
		 * Shipping Company Post hooks
		 *
		 * Functions Hooked:
		 * @see ShippingCompanyPost::registerPostType()
		 * @see ShippingCompanyPost::addMetaBoxes()
		 * @see ShippingCompanyPost::customPostTypeTemplateSingle()
		 * @see ShippingCompanyPost::customPostTypeTemplateArchive()
		 */
		$shippingCompanyPost = new ShippingCompanyPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $shippingCompanyPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $shippingCompanyPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $shippingCompanyPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $shippingCompanyPost,'customPostTypeTemplateArchive' );



		/**
		 * Supplier Company Post hooks
		 *
		 * Functions Hooked:
		 * @see SupplierCompanyPost::registerPostType()
		 * @see SupplierCompanyPost::addMetaBoxes()
		 * @see SupplierCompanyPost::customPostTypeTemplateSingle()
		 * @see SupplierCompanyPost::customPostTypeTemplateArchive()
		 */
		$supplierCompanyPost = new SupplierCompanyPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $supplierCompanyPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $supplierCompanyPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $supplierCompanyPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $supplierCompanyPost,'customPostTypeTemplateArchive' );


		/**
		 * Department Post Type hooks
		 *
		 * Functions Hooked:
		 * @see DepartmentPost::registerPostType()
		 * @see DepartmentPost::addMetaBoxes()
		 * @see DepartmentPost::customPostTypeTemplateSingle()
		 * @see DepartmentPost::customPostTypeTemplateArchive()
		 */
		$departmentPost = new DepartmentPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $departmentPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $departmentPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $departmentPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $departmentPost,'customPostTypeTemplateArchive' );



		/**
		 * Availability Post Type hooks
		 *
		 * Functions Hooked:
		 * @see AvailabilityPost::registerPostType()
		 * @see AvailabilityPost::addMetaBoxes()
		 * @see AvailabilityPost::customPostTypeTemplateSingle()
		 * @see AvailabilityPost::customPostTypeTemplateArchive()
		 */
		$availabilityPost = new AvailabilityPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $availabilityPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $availabilityPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $availabilityPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $availabilityPost,'customPostTypeTemplateArchive' );



		/**
		 * Appointment Post Type hooks
		 *
		 * Functions Hooked:
		 * @see AppointmentPost::registerPostType()
		 * @see AppointmentPost::addMetaBoxes()
		 * @see AppointmentPost::customPostTypeTemplateSingle()
		 * @see AppointmentPost::customPostTypeTemplateArchive()
		 */
		$appointmentPost = new AppointmentPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $appointmentPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $appointmentPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $appointmentPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $appointmentPost,'customPostTypeTemplateArchive' );

	}

}
