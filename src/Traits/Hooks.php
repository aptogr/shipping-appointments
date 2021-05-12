<?php

namespace ShippingAppointments\Traits;

use ShippingAppointments\Controller\Admin\AdminController;
use ShippingAppointments\Controller\Ajax\AjaxController;
use ShippingAppointments\Controller\Front\PublicController;
use ShippingAppointments\Controller\Save\SaveController;
use ShippingAppointments\Includes\PageTemplates;
use ShippingAppointments\Includes\Shortcodes;
use ShippingAppointments\Includes\Widgets;
use ShippingAppointments\Includes\Settings;
use ShippingAppointments\Includes\AdminMenuPages;
use ShippingAppointments\Includes\CronJobs;
use ShippingAppointments\Service\Auth\Authentication;
use ShippingAppointments\Service\Auth\AuthPermalinks;
use ShippingAppointments\Service\Auth\AutSettings;
use ShippingAppointments\Service\Auth\Login;
use ShippingAppointments\Service\Auth\LoginModal;
use ShippingAppointments\Service\Auth\Password;
use ShippingAppointments\Service\Dashboard\Access\DashboardAccessibility;
use ShippingAppointments\Service\Dashboard\Access\DashboardRedirects;
use ShippingAppointments\Service\Dashboard\Dashboard;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Service\Taxonomy\BrandTaxonomy;
use ShippingAppointments\Service\Taxonomy\CountryTaxonomy;
use ShippingAppointments\Service\Taxonomy\DepartmentType;
use ShippingAppointments\Service\Taxonomy\PortTaxonomy;
use ShippingAppointments\Service\Taxonomy\ProductType;
use ShippingAppointments\Service\User\UserCapabilities;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Service\User\UserRoles;
use ShippingAppointments\Service\User\UserTemplates;

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
        $this->loader->addAction( 'init', $pageTemplates, 'registerEndpoints' );


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
		 * @see DepartmentPost::changePermalinks()
		 */
		$departmentPost = new DepartmentPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $departmentPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $departmentPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $departmentPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'post_type_link', $departmentPost, 'changePermalinks', 5, 3);


        /**
         * Department Type Taxonomy hooks
         *
         * Functions Hooked:
         * @see DepartmentType::registerTaxonomy()
         */
        $departmentType = new DepartmentType( $this->getPluginName(), $this->getPluginDirPath() );
        $this->loader->addAction( 'init', $departmentType, 'registerTaxonomy' );



        /**
         * Product Type Taxonomy hooks
         *
         * Functions Hooked:
         * @see ProductType::registerTaxonomy()
         */
        $departmentType = new ProductType( $this->getPluginName(), $this->getPluginDirPath() );
        $this->loader->addAction( 'init', $departmentType, 'registerTaxonomy' );



        /**
         * Product Brand Taxonomy hooks
         *
         * Functions Hooked:
         * @see BrandTaxonomy::registerTaxonomy()
         */
        $brandTaxonomy = new BrandTaxonomy( $this->getPluginName(), $this->getPluginDirPath() );
        $this->loader->addAction( 'init', $brandTaxonomy, 'registerTaxonomy' );


        /**
         * Port Taxonomy hooks
         *
         * Functions Hooked:
         * @see PortTaxonomy::registerTaxonomy()
         */
        $portTaxonomy = new PortTaxonomy( $this->getPluginName(), $this->getPluginDirPath() );
        $this->loader->addAction( 'init', $portTaxonomy, 'registerTaxonomy' );



        /**
         * Department Type Taxonomy hooks
         *
         * Functions Hooked:
         * @see CountryTaxonomy::registerTaxonomy()
         * @see CountryTaxonomy::addCountries()
         */
        $countryTaxonomy = new CountryTaxonomy( $this->getPluginName(), $this->getPluginDirPath() );
        $this->loader->addAction( 'init', $countryTaxonomy, 'registerTaxonomy' );
//        $this->loader->addAction( 'init', $countryTaxonomy, 'addCountries' );



		/**
		 * Availability Post Type hooks
		 *
		 * Functions Hooked:
		 * @see AvailabilityPost::registerPostType()
		 * @see AvailabilityPost::addMetaBoxes()
		 */
		$availabilityPost = new AvailabilityPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $availabilityPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $availabilityPost, 'addMetaBoxes', 33, 1 );



		/**
		 * Appointment Post Type hooks
		 *
		 * Functions Hooked:
		 * @see AppointmentPost::registerPostType()
		 * @see AppointmentPost::addMetaBoxes()
		 * @see AppointmentPost::customPostTypeTemplateSingle()
		 */
		$appointmentPost = new AppointmentPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $appointmentPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $appointmentPost, 'addMetaBoxes', 33, 1 );
		$this->loader->addFilter( 'single_template', $appointmentPost,'customPostTypeTemplateSingle', 10, 1 );
		$this->loader->addFilter( 'archive_template', $appointmentPost,'customPostTypeTemplateArchive' );
		$this->loader->addFilter( 'manage_'.AppointmentPost::POST_TYPE_NAME.'_posts_columns', $appointmentPost, 'registerAdminColumns', 99, 1);
		$this->loader->addAction( 'manage_'.AppointmentPost::POST_TYPE_NAME.'_posts_custom_column', $appointmentPost, 'adminColumnDisplay', 10, 2);


		/**
		 * Appointment Post Type hooks
		 *
		 * Functions Hooked:
		 * @see AppointmentPost::registerPostType()
		 * @see AppointmentPost::addMetaBoxes()
		 */
		$shippingInvitationPost = new ShippingInvitationPost( $this->getPluginName(), $this->getPluginDirPath() );
		$this->loader->addAction( 'init', $shippingInvitationPost, 'registerPostType' );
		$this->loader->addAction( 'rwmb_meta_boxes', $shippingInvitationPost, 'addMetaBoxes', 33, 1 );


		/**
		 * User Fields
		 *
		 * Functions Hooked:
		 * @see UserFields::registerUserCapabilities()
		 */
		$userFields = new UserFields();
		$this->loader->addAction( 'rwmb_meta_boxes', $userFields, 'registerUserFields', 44, 1 );


		/**
		 * AuthPermalinks
		 *
		 * Functions Hooked:
		 * @see AuthPermalinks::registerUrl()
		 * @see AuthPermalinks::loginUrl()
		 */
		$authPermalinks = new AuthPermalinks();
		$this->loader->addFilter( 'register_url', $authPermalinks, 'registerUrl', 20, 2 );
		$this->loader->addFilter( 'login_url', $authPermalinks, 'loginUrl', 20, 2 );



		/**
		 * AuthPermalinks
		 *
		 * Functions Hooked:
		 * @see Authentication::registerNewUser()
		 * @see Authentication::authenticateLogin()
		 * @see Authentication::failedLogin()
		 * @see Authentication::showNewUserModalMessage()
		 */
		$homiAuthentication = new Authentication();
		$this->loader->addAction( 'wp_loaded', $homiAuthentication, 'registerNewUser' );
		$this->loader->addFilter( 'authenticate', $homiAuthentication, 'authenticateLogin', 31, 3 );
		$this->loader->addAction( 'wp_login_failed', $homiAuthentication, 'failedLogin', 31, 3 );
//        $this->loader->addAction( 'wp_footer', $homiAuthentication, 'showNewUserModalMessage' );


		/**
		 * Authentication Settings
		 *
		 * Functions Hooked:
		 * @see AutSettings::restrictWPAdminAccess()
		 * @see AuthPermalinks::disableAdminBar()
		 * @see AuthPermalinks::extendLoginSessionTime()
		 */
		$authSettings= new AutSettings();
		$this->loader->addAction( 'admin_init', $authSettings, 'restrictWPAdminAccess', 1);
		$this->loader->addAction( 'after_setup_theme', $authSettings, 'disableAdminBar');
		$this->loader->addFilter( 'auth_cookie_expiration', $authSettings, 'extendLoginSessionTime');
		add_filter( 'admin_email_check_interval', '__return_zero' );




		/**
		 * Login
		 *
		 * Functions Hooked:
		 * @see Login::redirectAfterFacebookLogin()
		 * @see Login::redirectAfterGoogleLogin()
		 * @see Login::redirectAfterEmailLogin()
		 * @see Login::redirectAfterLogout()
		 * @see Login::afterEmailLoginServices()
		 * @see Login::afterEmailRegisterServices()
		 * @see Login::afterSocialLoginServices()
		 * @see Login::afterSocialRegisterServices()
		 */
		$homiLogin = new Login();
		$this->loader->addFilter( 'login_redirect', $homiLogin, 'redirectAfterEmailLogin', 20, 3 );
		$this->loader->addFilter( 'wp_logout', $homiLogin, 'redirectAfterLogout', 20 );
		$this->loader->addAction( 'wp_login', $homiLogin, 'afterEmailLoginServices', 10, 2 );
		$this->loader->addAction( 'register_new_user', $homiLogin, 'afterEmailRegisterServices', 99, 1 );
		$this->loader->addAction( 'profenda_user_registered', $homiLogin, 'afterEmailRegisterServices', 99, 1 );
		remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
		remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10 );

//		$loginModal = new LoginModal();
//		$this->loader->addAction( 'wp_footer', $loginModal, 'displayLoginModal' );


		/**
		 * Password Services
		 *
		 * Functions Hooked:
		 * @see Password::set_content_type()
		 * @see Password::customLostPasswordPage()
		 * @see Password::resetPasswordEmailSubject()
		 * @see Password::resetPasswordEmailMessage()
		 * @see Password::customResetPasswordPage()
		 */
		$password = new Password();
		$this->loader->addFilter( 'wp_mail_content_type', $password, 'set_content_type', 10 , 1 );
		$this->loader->addAction( 'login_form_lostpassword', $password, 'customLostPasswordPage' );
		$this->loader->addFilter( 'retrieve_password_title', $password, 'resetPasswordEmailSubject', 10, 3 );
		$this->loader->addFilter( 'retrieve_password_message', $password, 'resetPasswordEmailMessage', 10, 4 );
		$this->loader->addAction( 'login_form_rp', $password, 'customResetPasswordPage' );
		$this->loader->addAction( 'login_form_resetpass', $password, 'customResetPasswordPage' );


		/**
		 * User Fields
		 *
		 * Functions Hooked:
		 * @see UserTemplates::changeAuthorBaseUrl()
		 * @see UserTemplates::customUserTemplate()
		 */
		$userTemplates = new UserTemplates(  $this->getPluginName(), $this->getPluginDirPath()  );
		$this->loader->addAction( 'init', $userTemplates, 'changeAuthorBaseUrl');
		$this->loader->addFilter( 'author_template', $userTemplates, 'customUserTemplate', 10, 1 );


		/**
		 * Dashboard Accessibility
		 *
		 * Functions Hooked:
		 * @see DashboardAccessibility::checkAccess()
		 */
		$dashboardAccess = new DashboardAccessibility();
		$this->loader->addAction( 'template_redirect', $dashboardAccess, 'checkAccess', 99 );


		/**
		 * Dashboard Pages Redirects
		 *
		 * Functions Hooked:
		 * @see DashboardRedirects::managementPagesRedirects()
		 */
		$dashboardRedirects = new DashboardRedirects();
		$this->loader->addAction( 'template_redirect', $dashboardRedirects, 'dashboardPageRedirect', 90 );



		/**
		 * User Fields
		 *
		 * Functions Hooked:
		 * @see SaveController::saveFields()
		 */
		$saveController = new SaveController();
		$this->loader->addAction('wp_loaded', $saveController, 'saveFields');


        /**
         * Ajax Controller
         *
         * Functions Hooked:
         * @see AjaxController
         */
        $ajaxController = new AjaxController();

        foreach( AjaxController::AJAX_ACTIONS as $ajaxAction => $ajaxData ){

            if( isset( $ajaxData['callback'] ) && method_exists( $ajaxController, $ajaxData['callback'] ) ){

                $this->loader->addAction( "wp_ajax_$ajaxAction", $ajaxController, $ajaxData['callback'] );

                if( $ajaxData['nopriv'] === true ){
                    $this->loader->addAction( "wp_ajax_nopriv_$ajaxAction", $ajaxController, $ajaxData['callback'] );
                }

            }

        }

	}

}
