<?php
/**
 * The file that automatically registers the shortcodes defined as classes
 * inside the folder of the $folderDirPath variable
 *
 * @link       https://www.apto.gr/
 * @since      1.0.0
 *
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/Includes
 */

namespace ShippingAppointments\Includes;

use ShippingAppointments\Traits\Core\ClassList;

class Shortcodes {

	/**
	 * Use the ClassList Trait in order to set the array
	 * of the Classes that are defined inside the $folderDirPath
	 *
	 * @see \ShippingAppointments\Traits\Core\ClassList
	 */
	use ClassList;



	/**
	 * Initialize the Shortcodes directory path and
	 * Detect the classes defined in that path to dynamically register
	 * the shortcodes
	 *
	 * @param $pluginDirPath string The plugin directory path
	 *
	 * @since    1.0.0
	 */
	public function __construct( $pluginDirPath ) {

		$this->folderDirPath = $pluginDirPath. 'src/Shortcodes/';
		$this->setClasses();

	}


	/**
	 *
	 * Registers dynamically the shortcodes of this Plugin
	 * It loops through the classes property define in the constructor
	 *
	 * It checks if the class found on each entry of the array exists
	 * and if it implements the @see \ShippingAppointments\Interfaces\ShortcodesInterface
	 *
	 */
	public function registerShortcodes(){

		if( is_array( $this->classes ) && !empty( $this->classes ) ){

			foreach( $this->classes as $shortcode ){

				if( class_exists( $shortcode ) ){

					$interfaces = class_implements( $shortcode );

					if ( isset( $interfaces['ShippingAppointments\Interfaces\ShortcodesInterface'] ) ) {

						/**
						 * @see \ShippingAppointments\Shortcodes\ShortcodeBoilerplate
						 * @see \ShippingAppointments\Interfaces\ShortcodesInterface
						 */
						$shortcodeObj = new $shortcode();
						add_shortcode( $shortcodeObj->getShortcodeName() , array( $shortcodeObj, 'display') );

					}
					else {

                        var_dump("The $shortcode class needs to implement the Shortcodes Interface.");

					}

				}
				else {

                    var_dump("Class: $shortcode is not defined in the $this->folderDirPath folder");

				}

			}

		}

	}

}
