<?php


namespace ShippingAppointments\Includes;

use ShippingAppointments\Traits\Core\ClassList;

class Widgets {

	use ClassList;

	public function __construct( $pluginDirPath ) {

		$this->folderDirPath = $pluginDirPath. 'src/Widgets/';
		$this->setClasses();

	}

	public function registerWidgets(){

		if( is_array( $this->classes ) && !empty( $this->classes ) ) {

			foreach ( $this->classes as $widget ) {

				if ( class_exists( $widget ) ) {

					register_widget( $widget );

				} else {

                    var_dump( "Class: $widget is not defined in the $this->folderDirPath folder" );

				}

			}

		}

	}

}
