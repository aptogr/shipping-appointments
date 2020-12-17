<?php


namespace ShippingAppointments\Includes;

use ShippingAppointments\Interfaces\AdminInterface;
use ShippingAppointments\Traits\AdminPages;

class AdminMenuPages implements AdminInterface {

	use AdminPages;

	protected $adminTemplatesPath;

	public function __construct( $pluginDirPath ){

		$this->adminTemplatesPath = $pluginDirPath . self::ADMIN_PAGES_FOLDER;
		$this->setAdminPages();

	}

	public function registerAdminPages(){

		$pages = $this->getAdminPages();
		if( is_array( $pages ) && !empty( $pages ) ){

			foreach( $pages as $page_slug => $menuPage ){

				add_menu_page(
					$menuPage['page_title'],
					$menuPage['menu_title'],
					$menuPage['capability'],
					$page_slug,
					array( $this, 'getTemplate'),
					( isset( $menuPage['icon'] ) ? $menuPage['icon'] : '' ),
					( isset( $menuPage['position'] ) ? $menuPage['position'] : null )
				);

				if( isset( $menuPage['subpages'] ) && is_array( $menuPage['subpages'] ) && !empty(  $menuPage['subpages']  ) ){

					foreach( $menuPage['subpages'] as $subpage_slug => $submenuPage ){

						add_submenu_page(
							$page_slug,
							$submenuPage['page_title'],
							$submenuPage['menu_title'],
							$submenuPage['capability'],
							$subpage_slug,
							array( $this, 'getTemplate')
						);

					}

				}

			}

		}



	}


	public function getTemplate(){

		if( isset( $_GET['page'] ) ){

			$pageSlug           = $_GET['page'];
			$adminPageTemplate  = $this->adminTemplatesPath . $pageSlug . '.php';

			if( file_exists( $adminPageTemplate ) ){

				if ( ! empty( $adminPageTemplate ) ) {

					require_once( "$adminPageTemplate" );

				}

			}
			else {

				echo "<div class='update-nag'>Template does not exist: <strong>$adminPageTemplate</strong>. You should create a <strong>$pageSlug.php</strong> file under the <strong>$this->adminTemplatesPath</strong> folder</div> ";
			}

		}


	}

}
